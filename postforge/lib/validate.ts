// Server-side validation and cleaning of everything the browser sends.
// Never trust the browser: anyone can send any request to the API directly.

import { z } from "zod";
import { GOALS, PLATFORMS, TONES, type GenerateInput } from "@/types";

/** Removes invisible control characters and trims; keeps normal line breaks. */
function clean(value: string): string {
  return value
    .replace(/[\u0000-\u0008\u000B\u000C\u000E-\u001F\u007F\u200B-\u200F\u2028\u2029\uFEFF]/g, "")
    .replace(/\r\n?/g, "\n")
    .replace(/\n{3,}/g, "\n\n")
    .trim();
}

const text = (label: string, max: number) =>
  z
    .string({ error: `${label} must be text.` })
    .transform(clean)
    .pipe(z.string().max(max, `${label} must be ${max} characters or fewer.`));

const required = (label: string, max: number) =>
  text(label, max).pipe(z.string().min(1, `${label} is required.`));

/** Optional text: missing, null or empty all become `undefined`. */
const optional = (label: string, max: number, check?: (v: string) => boolean, message?: string) =>
  text(label, max)
    .refine((v) => !v || !check || check(v), message)
    .nullish()
    .transform((v) => (v ? v : undefined))
    .optional();

export const InputSchema = z.object({
  brandName: required("Brand name", 100),
  description: required("What it sells or does", 600),
  audience: required("Target audience", 300),
  tone: z.enum(TONES, { error: "Please choose a tone." }),
  platforms: z
    .array(z.enum(PLATFORMS), { error: "Please choose at least one platform." })
    .min(1, "Please choose at least one platform.")
    .transform((list) => [...new Set(list)]),
  goal: z.enum(GOALS, { error: "Please choose a goal." }),
  topic: required("Topic or key message", 800),
  offer: optional("Offer / discount", 300),
  date: optional("Date", 100),
  link: optional(
    "Link",
    300,
    (v) => /^(https?:\/\/)?[a-z0-9-]+(\.[a-z0-9-]+)+(:\d+)?(\/\S*)?$/i.test(v),
    "Link must look like a web address, e.g. https://example.com",
  ),
  cta: optional("Call to action", 200),
  keywords: optional("Keywords", 300),
  avoidWords: optional("Words to avoid", 300),
  language: text("Language", 40).transform((v) => v || "English"),
  variations: z.coerce
    .number()
    .int()
    .min(1, "Variations must be between 1 and 3.")
    .max(3, "Variations must be between 1 and 3.") as z.ZodType<1 | 2 | 3>,
  includeHashtags: z.boolean().default(true),
  includeEmojis: z.boolean().default(true),
  bannedWords: z.array(text("Banned word", 60)).max(50).default([])
    .transform((list) => list.filter(Boolean)),
  examplePosts: z.array(text("Example post", 2500)).max(10).default([])
    .transform((list) => list.filter(Boolean)),
});

export type ValidationResult =
  | { ok: true; data: GenerateInput }
  | { ok: false; message: string };

export function validateInput(body: unknown): ValidationResult {
  const parsed = InputSchema.safeParse(body);
  if (!parsed.success) {
    const messages = [...new Set(parsed.error.issues.map((i) => i.message))];
    return { ok: false, message: messages.slice(0, 3).join(" ") };
  }
  return { ok: true, data: parsed.data };
}

/** Banned words from the profile plus the comma-separated "words to avoid" field. */
export function allBannedWords(input: GenerateInput): string[] {
  const fromField = (input.avoidWords ?? "").split(/[,\n]/).map((w) => w.trim());
  return [...new Set([...(input.bannedWords ?? []), ...fromField].filter(Boolean))];
}
