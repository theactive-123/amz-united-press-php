"use client";

import { PLATFORM_RULES } from "@/lib/ai/platformRules";
import type { GenerateResult, Platform } from "@/types";
import PostCard from "./PostCard";

interface Props {
  result: GenerateResult | null;
  loading: boolean;
  error: string;
  pendingPlatforms: Platform[];
}

function Skeleton() {
  return (
    <div className="animate-pulse rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900">
      <div className="mb-4 h-3 w-24 rounded bg-zinc-200 dark:bg-zinc-800" />
      <div className="space-y-2">
        <div className="h-3 rounded bg-zinc-200 dark:bg-zinc-800" />
        <div className="h-3 w-11/12 rounded bg-zinc-200 dark:bg-zinc-800" />
        <div className="h-3 w-4/5 rounded bg-zinc-200 dark:bg-zinc-800" />
        <div className="h-3 w-2/3 rounded bg-zinc-200 dark:bg-zinc-800" />
      </div>
    </div>
  );
}

export default function ResultsPanel({ result, loading, error, pendingPlatforms }: Props) {
  if (loading) {
    return (
      <div className="space-y-6" aria-busy="true" aria-live="polite">
        <p className="text-sm text-zinc-500">Writing drafts, then editing them. This usually takes 20-40 seconds...</p>
        {pendingPlatforms.map((p) => (
          <section key={p}>
            <h3 className="mb-2 font-semibold">{PLATFORM_RULES[p].label}</h3>
            <Skeleton />
          </section>
        ))}
      </div>
    );
  }

  if (error) {
    return (
      <p role="alert" className="rounded-xl bg-red-50 p-4 text-sm text-red-700 dark:bg-red-950/50 dark:text-red-300">
        {error}
      </p>
    );
  }

  if (!result) {
    return (
      <div className="grid h-full min-h-60 place-items-center rounded-xl border border-dashed border-zinc-300 p-6 text-center text-sm text-zinc-500 dark:border-zinc-700">
        Your posts will appear here.
      </div>
    );
  }

  const platforms = [...new Set(result.posts.map((p) => p.platform))];
  return (
    <div className="space-y-8">
      {platforms.map((platform) => (
        <section key={platform}>
          <h3 className="mb-2 font-semibold">{PLATFORM_RULES[platform].label}</h3>
          <div className="space-y-3">
            {result.posts.filter((p) => p.platform === platform).map((post) => <PostCard key={post.id} post={post} />)}
          </div>
        </section>
      ))}
    </div>
  );
}
