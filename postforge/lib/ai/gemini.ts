// Google Gemini client (primary AI provider). Server-only: the API key never reaches the browser.
import "server-only";

import { AIError, codeFromStatus } from "./errors";
import type { PromptPair } from "./prompts";

export const DEFAULT_GEMINI_MODEL = "gemini-3.6-flash";
/**
 * Backup models, tried in order when the main one is busy, slow or out of free quota.
 * Google counts free-tier quota separately per model, so each backup adds extra free requests per day.
 * Override with GEMINI_FALLBACK_MODELS (comma separated) or set it to empty to disable.
 */
export const DEFAULT_GEMINI_FALLBACK_MODELS = "gemini-3.5-flash-lite,gemini-3.1-flash-lite";
const TIMEOUT_MS = 45_000;

/** Models that reported "daily quota used up", and until when (kept in server memory). */
const exhaustedUntil = new Map<string, number>();

interface GeminiResponse {
  candidates?: {
    content?: { parts?: { text?: string; thought?: boolean }[] };
    finishReason?: string;
  }[];
  promptFeedback?: { blockReason?: string };
}

export function geminiConfigured(): boolean {
  return Boolean(process.env.GEMINI_API_KEY);
}

function modelList(): string[] {
  const primary = process.env.GEMINI_MODEL?.trim() || DEFAULT_GEMINI_MODEL;
  const backups = (process.env.GEMINI_FALLBACK_MODELS ?? DEFAULT_GEMINI_FALLBACK_MODELS)
    .split(",")
    .map((m) => m.trim())
    .filter(Boolean);
  return [...new Set([primary, ...backups])];
}

/**
 * Sends one prompt to Gemini and returns the raw JSON text it produced.
 * Tries the main model first, then each backup model, skipping models whose daily quota is used up.
 * If every model was only "busy", it waits briefly and tries once more.
 */
export async function callGemini(prompt: PromptPair): Promise<string> {
  const models = modelList();
  let lastError: AIError = new AIError("rate_limit", "all Gemini models are out of quota");
  let anyBusy = false;

  for (const model of models) {
    if ((exhaustedUntil.get(model) ?? 0) > Date.now()) continue;
    try {
      return await callGeminiOnce(prompt, model);
    } catch (err) {
      if (!(err instanceof AIError) || !["unavailable", "timeout", "rate_limit"].includes(err.code)) throw err;
      console.warn(`[gemini] ${model} failed (${err.code}); trying the next model`);
      lastError = err;
      anyBusy ||= err.code !== "rate_limit";
    }
  }

  if (anyBusy) {
    await new Promise((r) => setTimeout(r, 2000));
    const available = models.find((m) => (exhaustedUntil.get(m) ?? 0) <= Date.now());
    if (available) return callGeminiOnce(prompt, available);
  }
  throw lastError;
}

/** Remembers a model as exhausted when Google says to retry much later (the daily quota). */
function rememberQuota(model: string, body: string) {
  const delay = Number(body.match(/"retryDelay":\s*"(\d+)s"/)?.[1] ?? 0);
  if (delay > 120) exhaustedUntil.set(model, Date.now() + delay * 1000);
}

async function callGeminiOnce({ system, user }: PromptPair, model: string): Promise<string> {
  const key = process.env.GEMINI_API_KEY;
  if (!key) throw new AIError("not_configured", "GEMINI_API_KEY missing");

  let res: Response;
  try {
    res = await fetch(
      `https://generativelanguage.googleapis.com/v1beta/models/${encodeURIComponent(model)}:generateContent`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json", "x-goog-api-key": key },
        body: JSON.stringify({
          systemInstruction: { parts: [{ text: system }] },
          contents: [{ role: "user", parts: [{ text: user }] }],
          generationConfig: { responseMimeType: "application/json" },
        }),
        signal: AbortSignal.timeout(TIMEOUT_MS),
        cache: "no-store",
      },
    );
  } catch (err) {
    const name = (err as Error).name;
    throw new AIError(name === "TimeoutError" || name === "AbortError" ? "timeout" : "unavailable", `Gemini fetch failed: ${name}`);
  }

  if (!res.ok) {
    const body = await res.text().catch(() => "");
    if (res.status === 429) rememberQuota(model, body);
    throw new AIError(codeFromStatus(res.status), `Gemini ${model} HTTP ${res.status}: ${body.slice(0, 300)}`);
  }

  const data = (await res.json()) as GeminiResponse;
  if (data.promptFeedback?.blockReason) throw new AIError("blocked", `Gemini blocked: ${data.promptFeedback.blockReason}`);
  const candidate = data.candidates?.[0];
  if (candidate?.finishReason === "SAFETY" || candidate?.finishReason === "PROHIBITED_CONTENT") {
    throw new AIError("blocked", `Gemini finishReason ${candidate.finishReason}`);
  }
  const text = (candidate?.content?.parts ?? [])
    .filter((p) => !p.thought && p.text)
    .map((p) => p.text)
    .join("");
  if (!text) throw new AIError("invalid_output", `Gemini empty response (finishReason ${candidate?.finishReason})`);
  return text;
}
