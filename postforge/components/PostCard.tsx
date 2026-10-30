"use client";

import { useState } from "react";
import { PLATFORM_RULES } from "@/lib/ai/platformRules";
import { postLength, publishText } from "@/lib/postText";
import type { Post } from "@/types";

/** One generated post. Stage 4 adds editing, rewrite buttons and thumbs up/down. */
export default function PostCard({ post }: { post: Post }) {
  const [copied, setCopied] = useState(false);
  const rules = PLATFORM_RULES[post.platform];
  const length = postLength(post);
  const over = length > rules.charLimit;

  async function copy() {
    const parts = [publishText(post)];
    if (post.thread?.length) parts.push(post.thread.map((t, i) => `${i + 1}/ ${t}`).join("\n\n"));
    await navigator.clipboard.writeText(parts.join("\n\n---\n\n"));
    setCopied(true);
    setTimeout(() => setCopied(false), 1500);
  }

  return (
    <article className="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900">
      <header className="mb-3 flex items-center justify-between gap-2">
        <span className="text-xs font-medium uppercase tracking-wide text-zinc-500">Variation {post.variation}</span>
        <span className={`text-xs tabular-nums ${over ? "font-semibold text-red-600" : "text-zinc-500"}`}>
          {length.toLocaleString("en-US")} / {rules.charLimit.toLocaleString("en-US")}
        </span>
      </header>

      <p className="whitespace-pre-wrap text-sm leading-relaxed">{post.text}</p>
      {post.hashtags.length > 0 && (
        <p className="mt-3 text-sm text-brand-600 dark:text-brand-500">{post.hashtags.join(" ")}</p>
      )}

      {post.thread && post.thread.length > 0 && (
        <div className="mt-4 space-y-2 border-l-2 border-zinc-200 pl-3 dark:border-zinc-700">
          <p className="text-xs font-medium uppercase tracking-wide text-zinc-500">Thread</p>
          {post.thread.map((t, i) => (
            <p key={i} className="whitespace-pre-wrap text-sm">
              <span className="text-zinc-400">{i + 1}/ </span>{t}
            </p>
          ))}
        </div>
      )}

      {post.videoIdea && (
        <div className="mt-4 rounded-lg bg-zinc-50 p-3 dark:bg-zinc-800/60">
          <p className="mb-1 text-xs font-medium uppercase tracking-wide text-zinc-500">15-second video idea</p>
          <p className="whitespace-pre-wrap text-sm">{post.videoIdea}</p>
        </div>
      )}

      {post.warnings && post.warnings.length > 0 && (
        <ul className="mt-3 list-disc space-y-1 rounded-lg bg-amber-50 p-3 pl-6 text-xs text-amber-800 dark:bg-amber-950/40 dark:text-amber-300">
          {post.warnings.map((w) => <li key={w}>{w}</li>)}
        </ul>
      )}

      <footer className="mt-4 flex gap-2">
        <button type="button" onClick={copy}
          className="rounded-lg border border-zinc-300 px-3 py-1.5 text-sm hover:bg-zinc-100 dark:border-zinc-700 dark:hover:bg-zinc-800">
          {copied ? "Copied!" : "Copy"}
        </button>
      </footer>
    </article>
  );
}
