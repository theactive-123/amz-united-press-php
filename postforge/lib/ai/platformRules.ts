// Platform rules that are injected into the AI prompts.
// Edit these freely: the Writer and Editor prompts both read from this file,
// and the results screen uses `charLimit` for the live character counter.

import type { Platform } from "@/types";

export interface PlatformRule {
  label: string;
  /** Hard character limit for the main text (used for the red counter and server checks). */
  charLimit: number;
  /** Rules written as plain instructions for the AI. */
  rules: string[];
  hashtags: { min: number; max: number };
}

export const PLATFORM_RULES: Record<Platform, PlatformRule> = {
  instagram: {
    label: "Instagram",
    charLimit: 2200,
    hashtags: { min: 5, max: 10 },
    rules: [
      "The first line is a strong hook that makes people stop scrolling.",
      "Use short lines with line breaks between ideas.",
      "Use at most 3-8 relevant emojis in total (only if emojis are allowed).",
      "End with a clear call to action.",
      "Ideal length is 100-200 words; never exceed 2,200 characters.",
      "Put 5-10 relevant hashtags in the hashtags list (they are shown at the bottom).",
    ],
  },
  linkedin: {
    label: "LinkedIn",
    charLimit: 3000,
    hashtags: { min: 0, max: 3 },
    rules: [
      "The first 2 lines are a hook (this is what shows before 'see more').",
      "Use short paragraphs of 1-3 sentences.",
      "Share a story or a specific insight, then one clear takeaway.",
      "End with a question that invites comments.",
      "Use 0-3 hashtags. No emoji spam (0-2 emojis max).",
    ],
  },
  x: {
    label: "X (Twitter)",
    charLimit: 280,
    hashtags: { min: 0, max: 2 },
    rules: [
      "The main post must be 280 characters or fewer INCLUDING hashtags. Count carefully.",
      "Punchy and direct. One idea per post.",
      "Use 0-2 hashtags.",
      "If the topic is long, also provide a thread of 3-5 posts, each 280 characters or fewer. Otherwise leave the thread empty.",
    ],
  },
  facebook: {
    label: "Facebook",
    charLimit: 63206,
    hashtags: { min: 1, max: 3 },
    rules: [
      "Conversational, like talking to a neighbour.",
      "40-80 words.",
      "Exactly one clear call to action.",
      "Use 1-3 hashtags.",
    ],
  },
  tiktok: {
    label: "TikTok",
    charLimit: 150,
    hashtags: { min: 3, max: 5 },
    rules: [
      "The caption is under 150 characters (hashtags are counted separately) and opens with a hook.",
      "Provide 3-5 hashtags.",
      "Also provide a suggested 15-second video idea/script with rough timings (e.g. 0-3s hook, 3-12s body, 12-15s CTA).",
    ],
  },
};
