// Errors from AI providers, each with a plain-English message that is safe to show users.
// Raw provider responses are only logged on the server, never sent to the browser.

export type AIErrorCode =
  | "not_configured"
  | "auth"
  | "model_not_found"
  | "rate_limit"
  | "timeout"
  | "unavailable"
  | "blocked"
  | "invalid_output"
  | "unknown";

export const FRIENDLY_MESSAGES: Record<AIErrorCode, string> = {
  not_configured: "The AI service isn't set up yet. Add GEMINI_API_KEY to .env.local (or to Vercel's environment variables) and restart.",
  auth: "The AI service rejected the API key. Check that the key in .env.local is correct and still active.",
  model_not_found: "The AI model name isn't recognised. Check GEMINI_MODEL in .env.local.",
  rate_limit: "The free AI quota is used up for the moment. Please wait a minute and try again.",
  timeout: "The AI took too long to answer. Please try again.",
  unavailable: "The AI service is temporarily unavailable. Please try again in a moment.",
  blocked: "The AI declined to write this post. Try rephrasing the topic or details.",
  invalid_output: "The AI returned something we couldn't read. Please try again.",
  unknown: "Something went wrong while writing your posts. Please try again.",
};

export class AIError extends Error {
  constructor(
    public code: AIErrorCode,
    /** Internal detail for server logs only. */
    detail?: string,
  ) {
    super(detail ?? code);
    this.name = "AIError";
  }
}

/** Maps an HTTP status from a provider to an error code. */
export function codeFromStatus(status: number): AIErrorCode {
  if (status === 429) return "rate_limit";
  if (status === 401 || status === 403) return "auth";
  if (status === 404) return "model_not_found";
  if (status >= 500) return "unavailable";
  return "unknown";
}
