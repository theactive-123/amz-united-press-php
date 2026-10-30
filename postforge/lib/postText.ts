// Character counting shared by the browser (live counter) and the server (quality checks),
// so both always agree on whether a post is over the limit.

import { PLATFORM_RULES } from "@/lib/ai/platformRules";
import type { Platform, Post } from "@/types";

/** The text that gets published: caption plus hashtags on their own line. */
export function publishText(post: Pick<Post, "text" | "hashtags">): string {
  return post.hashtags.length ? `${post.text}\n\n${post.hashtags.join(" ")}` : post.text;
}

/** The part of the post that counts towards the platform's character limit. */
export function countedText(post: Pick<Post, "text" | "hashtags" | "platform">): string {
  return PLATFORM_RULES[post.platform].hashtagsCountTowardsLimit ? publishText(post) : post.text;
}

const URL_RE = /https?:\/\/\S+/g;

/**
 * Counts characters the way each platform does.
 * X is special: every link counts as 23 characters and emojis / most non-Latin characters count as 2.
 */
export function countChars(text: string, platform: Platform): number {
  const segmenter = new Intl.Segmenter(undefined, { granularity: "grapheme" });
  if (platform !== "x") return Array.from(segmenter.segment(text)).length;

  let count = 0;
  const withoutUrls = text.replace(URL_RE, () => {
    count += 23;
    return "";
  });
  for (const { segment } of segmenter.segment(withoutUrls)) {
    const cp = segment.codePointAt(0) ?? 0;
    const light =
      segment.length === 1 &&
      (cp <= 0x10ff ||
        (cp >= 0x2000 && cp <= 0x200d) ||
        (cp >= 0x2010 && cp <= 0x201f) ||
        (cp >= 0x2032 && cp <= 0x2037));
    count += light ? 1 : 2;
  }
  return count;
}

export function postLength(post: Pick<Post, "text" | "hashtags" | "platform">): number {
  return countChars(countedText(post), post.platform);
}
