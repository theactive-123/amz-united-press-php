// POST /api/generate — runs on the server only, so API keys never reach the browser.
import { AIError, FRIENDLY_MESSAGES } from "@/lib/ai/errors";
import { callGemini } from "@/lib/ai/gemini";
import { generatePosts } from "@/lib/ai/generate";
import { validateInput } from "@/lib/validate";
import type { GenerateResult } from "@/types";

// Two AI calls (plus an occasional fix call and retries) can take a while.
// 300 seconds is the maximum on Vercel's free (Hobby) plan.
export const maxDuration = 300;

const MAX_BODY_BYTES = 60_000;

export async function POST(request: Request) {
  const raw = await request.text();
  if (raw.length > MAX_BODY_BYTES) {
    return Response.json({ error: "That's too much text. Please shorten your inputs or example posts." }, { status: 413 });
  }

  let body: unknown;
  try {
    body = JSON.parse(raw);
  } catch {
    return Response.json({ error: "The request was not valid. Please reload the page and try again." }, { status: 400 });
  }

  const validation = validateInput(body);
  if (!validation.ok) return Response.json({ error: validation.message }, { status: 400 });

  try {
    const posts = await generatePosts(validation.data, callGemini, undefined, {
      onStep: (step, ms) => console.log(`[api/generate] ${step} step took ${ms} ms`),
    });
    const result: GenerateResult = { posts, provider: "gemini", createdAt: new Date().toISOString() };
    return Response.json(result);
  } catch (err) {
    const code = err instanceof AIError ? err.code : "unknown";
    // Full detail goes to the server log only (never includes the API key).
    console.error(`[api/generate] ${code}: ${(err as Error).message}`);
    const status = code === "rate_limit" ? 429 : code === "timeout" ? 504 : 502;
    return Response.json({ error: FRIENDLY_MESSAGES[code] }, { status });
  }
}
