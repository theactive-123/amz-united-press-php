// Two-step generation engine: Writer (Step A) -> Editor (Step B) -> automatic checks -> targeted fix.
//
// Why so many steps? A single AI call often breaks rules (too long for X, invents a discount,
// uses a cliche). The Editor catches most of that; the automatic checks below catch the rest
// with plain code (which can count characters perfectly, unlike an AI), and only the posts
// that still have problems are sent back for one more fix.
import "server-only";

import { z } from "zod";
import { AIError } from "./errors";
import { PLATFORM_RULES } from "./platformRules";
import { buildEditorPrompt, buildFixPrompt, buildWriterPrompt, CLICHES, type PromptPair } from "./prompts";
import { allBannedWords } from "@/lib/validate";
import { countChars, postLength } from "@/lib/postText";
import { PLATFORMS, type GenerateInput, type Platform, type Post } from "@/types";

/** Any function that sends a prompt to an AI provider and returns its raw text. */
export type CallAI = (prompt: PromptPair) => Promise<string>;

/** Hooks so the caller can see which step is running (used for logging/tests). */
export interface GenerateOptions {
  onStep?: (step: "writer" | "editor" | "fix", ms: number) => void;
}

// ---------------------------------------------------------------------------
// JSON parsing and validation
// ---------------------------------------------------------------------------

const AIPostSchema = z.object({
  platform: z.enum(PLATFORMS),
  variation: z.coerce.number().int().optional(),
  text: z.string().min(1),
  hashtags: z.array(z.string()).nullish().transform((v) => v ?? []),
  thread: z.array(z.string()).nullish().transform((v) => v ?? []),
  videoIdea: z.string().nullish().transform((v) => v ?? ""),
});
const AIOutputSchema = z.object({ posts: z.array(AIPostSchema).min(1) });
type AIPost = z.infer<typeof AIPostSchema>;

function extractJson(raw: string): unknown {
  const cleaned = raw.replace(/^\s*```(?:json)?/i, "").replace(/```\s*$/, "");
  const start = cleaned.indexOf("{");
  const end = cleaned.lastIndexOf("}");
  if (start === -1 || end <= start) throw new Error("no JSON object found");
  return JSON.parse(cleaned.slice(start, end + 1));
}

/**
 * Parses the AI output and makes sure every requested platform has the right number of
 * variations. Returns null if the output is unusable.
 */
function parseOutput(raw: string, expected: { platform: Platform; count: number }[]): AIPost[] | null {
  let parsed;
  try {
    parsed = AIOutputSchema.safeParse(extractJson(raw));
  } catch {
    return null;
  }
  if (!parsed.success) return null;

  const result: AIPost[] = [];
  for (const { platform, count } of expected) {
    const forPlatform = parsed.data.posts
      .filter((p) => p.platform === platform)
      .sort((a, b) => (a.variation ?? 0) - (b.variation ?? 0));
    if (forPlatform.length < count) return null;
    forPlatform.slice(0, count).forEach((p, i) => result.push({ ...p, variation: i + 1 }));
  }
  return result;
}

/** Calls the AI and validates the JSON. If it's invalid, retries once (as the spec requires). */
async function callForPosts(
  callAI: CallAI,
  prompt: PromptPair,
  expected: { platform: Platform; count: number }[],
): Promise<AIPost[]> {
  for (let attempt = 1; attempt <= 2; attempt++) {
    const raw = await callAI(prompt);
    const posts = parseOutput(raw, expected);
    if (posts) return posts;
    console.warn(`[generate] invalid JSON from AI (attempt ${attempt}): ${raw.slice(0, 200)}`);
  }
  throw new AIError("invalid_output", "AI returned invalid JSON twice");
}

// ---------------------------------------------------------------------------
// Deterministic clean-up (things code can do perfectly)
// ---------------------------------------------------------------------------

const EMOJI_RE = /\p{Extended_Pictographic}(\uFE0F|\u200D\p{Extended_Pictographic})*/gu;
const HASHTAG_RE = /(^|\s)#[\p{L}\p{N}_]+/gu;

function normalizeHashtag(tag: string): string {
  const body = tag.trim().replace(/^#+/, "").replace(/[^\p{L}\p{N}_]/gu, "");
  return body ? `#${body}` : "";
}

function tidyText(text: string): string {
  return text
    .replace(/[ \t]+\n/g, "\n")
    .replace(/\n{3,}/g, "\n\n")
    .replace(/[ \t]{2,}/g, " ")
    .trim();
}

function cleanPost(post: AIPost, input: GenerateInput): AIPost {
  let { text, hashtags } = post;
  let thread = post.thread.filter((t) => t.trim());
  let videoIdea = post.videoIdea;

  if (input.includeHashtags) {
    // Move hashtags sitting at the very end of the text into the hashtags list.
    const trailing = text.match(/(?:(?:^|\s+)#[\p{L}\p{N}_]+)+\s*$/u);
    if (trailing) {
      hashtags = [...(trailing[0].match(/#[\p{L}\p{N}_]+/gu) ?? []), ...hashtags];
      text = text.slice(0, trailing.index);
    }
    // Hashtags used naturally inside a sentence stay there and aren't repeated at the bottom.
    const seen = new Set((text.match(/#[\p{L}\p{N}_]+/gu) ?? []).map((h) => h.toLowerCase()));
    hashtags = hashtags
      .map(normalizeHashtag)
      .filter((h) => h && !seen.has(h.toLowerCase()) && seen.add(h.toLowerCase()))
      .slice(0, PLATFORM_RULES[post.platform].hashtags.max);
  } else {
    hashtags = [];
    text = text.replace(HASHTAG_RE, "$1");
    thread = thread.map((t) => t.replace(HASHTAG_RE, "$1"));
  }

  if (!input.includeEmojis) {
    text = text.replace(EMOJI_RE, "");
    thread = thread.map((t) => t.replace(EMOJI_RE, ""));
    videoIdea = videoIdea.replace(EMOJI_RE, "");
  }

  return {
    ...post,
    text: tidyText(text),
    hashtags,
    thread: post.platform === "x" ? thread.map(tidyText) : [],
    videoIdea: post.platform === "tiktok" ? tidyText(videoIdea) : "",
  };
}

// ---------------------------------------------------------------------------
// Automatic quality checks
// ---------------------------------------------------------------------------

function escapeRegex(s: string): string {
  return s.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

function containsPhrase(haystack: string, phrase: string): boolean {
  return new RegExp(`(^|[^\\p{L}\\p{N}])${escapeRegex(phrase)}`, "iu").test(haystack);
}

/** All text the user typed, used to check that numbers/links in posts came from the user. */
function briefText(input: GenerateInput): string {
  return [input.brandName, input.description, input.audience, input.topic, input.offer, input.date, input.link, input.cta, input.keywords]
    .filter(Boolean)
    .join("\n")
    .toLowerCase();
}

const MONEY_OR_PERCENT_RE = /(?:[$€£¥₹]\s?\d[\d,.]*|\d[\d,.]*\s?(?:%|percent\b|usd\b|eur\b|gbp\b|dollars?\b|euros?\b|pounds?\b))/giu;
const URL_RE = /\bhttps?:\/\/[^\s)]+|\bwww\.[^\s)]+/gi;

function digitsOnly(s: string): string {
  return s.replace(/[^\d.]/g, "").replace(/\.$/, "");
}

export function findIssues(post: AIPost, input: GenerateInput, banned: string[]): string[] {
  const rules = PLATFORM_RULES[post.platform];
  const issues: string[] = [];
  const all = [post.text, ...post.thread, post.videoIdea].join("\n");
  const brief = briefText(input);
  const briefDigits = (brief.match(/\d[\d,.]*/g) ?? []).map(digitsOnly);

  const length = postLength({ ...post, hashtags: post.hashtags });
  if (length > rules.charLimit) {
    issues.push(
      `Too long: ${length} characters but the limit is ${rules.charLimit}${rules.hashtagsCountTowardsLimit && post.hashtags.length ? " (including hashtags)" : ""}. Shorten it to fit with some margin.`,
    );
  }
  post.thread.forEach((t, i) => {
    const n = countChars(t, "x");
    if (n > 280) issues.push(`Thread post ${i + 1} is ${n} characters; it must be 280 or fewer.`);
  });
  if (post.platform === "x" && post.thread.length && (post.thread.length < 3 || post.thread.length > 5)) {
    issues.push(`The thread has ${post.thread.length} posts; use 3-5 posts or an empty thread.`);
  }

  if (rules.words) {
    const words = post.text.split(/\s+/).filter(Boolean).length;
    if (words > rules.words.max) issues.push(`Too wordy: ${words} words; aim for ${rules.words.min}-${rules.words.max - 20} words.`);
    if (words < rules.words.min - 10) issues.push(`Too short: ${words} words; aim for ${rules.words.min}-${rules.words.max - 20} words.`);
  }

  if (input.includeHashtags && post.hashtags.length < rules.hashtags.min) {
    issues.push(`Needs ${rules.hashtags.min}-${rules.hashtags.max} relevant hashtags (has ${post.hashtags.length}).`);
  }
  if (input.includeEmojis) {
    const emojis = (post.text.match(EMOJI_RE) ?? []).length;
    if (emojis > rules.maxEmojis) issues.push(`Uses ${emojis} emojis; use at most ${rules.maxEmojis}.`);
  }

  for (const word of banned) {
    if (containsPhrase(all, word)) issues.push(`Contains the banned word/phrase "${word}". Remove it completely.`);
  }
  for (const cliche of CLICHES) {
    // Skip if the user used the phrase themselves (e.g. a brand literally called "Unlock").
    if (containsPhrase(all, cliche) && !brief.includes(cliche)) {
      issues.push(`Contains the cliche "${cliche}". Rewrite that sentence in plain, specific words.`);
    }
  }

  for (const match of all.match(MONEY_OR_PERCENT_RE) ?? []) {
    const num = digitsOnly(match);
    if (num && !briefDigits.includes(num)) {
      issues.push(`Mentions "${match.trim()}", which is not in the brief. Remove invented prices/percentages.`);
    }
  }
  for (const url of all.match(URL_RE) ?? []) {
    const normalized = url.replace(/[.,!?]+$/, "").toLowerCase();
    if (!input.link || !normalized.includes(input.link.toLowerCase().replace(/^https?:\/\//, "").replace(/\/$/, ""))) {
      issues.push(`Contains the link "${url}", which is not the link in the brief. ${input.link ? `Use exactly ${input.link}.` : "Remove it."}`);
    }
  }
  // The user's own offer and date must appear word-for-word (spacing and capitals may differ).
  const squash = (v: string) => v.toLowerCase().replace(/\s+/g, " ");
  for (const [label, value] of [["offer", input.offer], ["date", input.date]] as const) {
    if (value && !squash(all).includes(squash(value))) {
      issues.push(`Must include the ${label} exactly as written in the brief: "${value}".`);
    }
  }

  if (post.platform === "tiktok" && post.videoIdea.length < 30) {
    issues.push("Missing the suggested 15-second video idea/script.");
  }
  return issues;
}

// ---------------------------------------------------------------------------
// Main entry point
// ---------------------------------------------------------------------------

export async function generatePosts(
  input: GenerateInput,
  callAI: CallAI,
  examples: string[] = input.examplePosts ?? [],
  options: GenerateOptions = {},
): Promise<Post[]> {
  const banned = allBannedWords(input);
  const expected = input.platforms.map((platform) => ({ platform, count: input.variations }));
  const timed = async <T,>(step: "writer" | "editor" | "fix", fn: () => Promise<T>): Promise<T> => {
    const t = Date.now();
    const out = await fn();
    options.onStep?.(step, Date.now() - t);
    return out;
  };

  // Step A — Writer
  const drafts = await timed("writer", () =>
    callForPosts(callAI, buildWriterPrompt(input, banned, examples), expected),
  );

  // Step B — Editor. If the editor's output is unusable, fall back to the drafts (still checked below).
  let edited: AIPost[];
  try {
    edited = await timed("editor", () =>
      callForPosts(callAI, buildEditorPrompt(input, banned, examples, { posts: drafts }), expected),
    );
  } catch (err) {
    if (!(err instanceof AIError) || err.code !== "invalid_output") throw err;
    edited = drafts;
  }

  let posts = edited.map((p) => cleanPost(p, input));

  // Automatic checks, then one targeted fix for posts that still have problems.
  const problems = posts
    .map((post, index) => ({ index, post, issues: findIssues(post, input, banned) }))
    .filter((p) => p.issues.length);

  if (problems.length) {
    try {
      const fixed = await timed("fix", () =>
        callForPosts(
          callAI,
          buildFixPrompt(input, banned, problems),
          [...new Set(problems.map((p) => p.post.platform))].map((platform) => ({
            platform,
            count: problems.filter((p) => p.post.platform === platform).length,
          })),
        ),
      );
      // Match fixed posts back to their originals by platform + order.
      const queues = new Map<Platform, AIPost[]>();
      for (const f of fixed) queues.set(f.platform, [...(queues.get(f.platform) ?? []), f]);
      posts = posts.map((post, index) => {
        const problem = problems.find((p) => p.index === index);
        if (!problem) return post;
        const replacement = queues.get(post.platform)?.shift();
        if (!replacement) return post;
        const cleaned = cleanPost({ ...replacement, variation: post.variation }, input);
        // Keep the fix only if it actually reduced the number of problems.
        return findIssues(cleaned, input, banned).length < problem.issues.length ? cleaned : post;
      });
    } catch (err) {
      // A failed fix isn't fatal: we still have good edited posts, so keep them.
      console.warn(`[generate] fix step skipped: ${(err as Error).message}`);
    }
  }

  return posts.map((post) => {
    const warnings = findIssues(post, input, banned);
    return {
      id: crypto.randomUUID(),
      platform: post.platform,
      variation: post.variation ?? 1,
      text: post.text,
      hashtags: post.hashtags,
      ...(post.platform === "x" && post.thread.length ? { thread: post.thread } : {}),
      ...(post.platform === "tiktok" ? { videoIdea: post.videoIdea } : {}),
      ...(warnings.length ? { warnings } : {}),
    };
  });
}
