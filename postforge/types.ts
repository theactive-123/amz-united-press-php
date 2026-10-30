// Shared types used by both the browser (components) and the server (lib/ai, API routes).

export const PLATFORMS = ["instagram", "linkedin", "x", "facebook", "tiktok"] as const;
export type Platform = (typeof PLATFORMS)[number];

export const TONES = [
  "professional",
  "friendly",
  "funny",
  "luxury",
  "bold",
  "educational",
  "inspirational",
] as const;
export type Tone = (typeof TONES)[number];

export const GOALS = [
  "sales",
  "engagement",
  "announcement",
  "lead generation",
  "brand awareness",
  "education",
] as const;
export type Goal = (typeof GOALS)[number];

/** Everything the user fills in on the form. */
export interface GenerateInput {
  brandName: string;
  description: string;
  audience: string;
  tone: Tone;
  platforms: Platform[];
  goal: Goal;
  topic: string;
  offer?: string;
  date?: string;
  link?: string;
  cta?: string;
  keywords?: string;
  avoidWords?: string;
  language: string;
  variations: 1 | 2 | 3;
  includeHashtags: boolean;
  includeEmojis: boolean;
  /** Banned words from the brand profile (merged with avoidWords on the server). */
  bannedWords?: string[];
  /** Example posts the user likes, used as few-shot style references. */
  examplePosts?: string[];
}

/** One finished post for one platform. */
export interface Post {
  id: string;
  platform: Platform;
  /** Main caption / post text. */
  text: string;
  /** Hashtags without the leading "#" are normalised to include it. */
  hashtags: string[];
  /** X only: optional thread of 3-5 posts (each <= 280 chars). */
  thread?: string[];
  /** TikTok only: suggested 15-second video idea / script. */
  videoIdea?: string;
}

export interface GenerateResult {
  posts: Post[];
  provider: "gemini" | "groq";
  createdAt: string;
}

/** A saved brand profile (stored in the browser's localStorage). */
export interface BrandProfile {
  id: string;
  brandName: string;
  description: string;
  audience: string;
  tone: Tone;
  bannedWords: string[];
  examplePosts: string[];
  /** Posts the user gave a thumbs-up; reused as few-shot examples. */
  goodExamples: { platform: Platform; text: string }[];
}
