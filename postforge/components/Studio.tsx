"use client";

import { useState } from "react";
import type { GenerateInput, GenerateResult, Platform } from "@/types";
import GenerateForm from "./GenerateForm";
import ResultsPanel from "./ResultsPanel";

/** The main screen: form on the left, results on the right (stacked on mobile). */
export default function Studio() {
  const [result, setResult] = useState<GenerateResult | null>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [pending, setPending] = useState<Platform[]>([]);

  async function generate(input: GenerateInput) {
    setLoading(true);
    setError("");
    setPending(input.platforms);
    try {
      const res = await fetch("/api/generate", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(input),
      });
      const data = await res.json().catch(() => null);
      if (!res.ok || !data?.posts) {
        setError(data?.error ?? "Something went wrong. Please try again.");
        return;
      }
      setResult(data as GenerateResult);
    } catch {
      setError("Couldn't reach the server. Check your internet connection and try again.");
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="grid gap-6 lg:grid-cols-[minmax(0,5fr)_minmax(0,6fr)]">
      <section className="rounded-2xl border border-zinc-200 bg-white p-5 sm:p-6 dark:border-zinc-800 dark:bg-zinc-900 lg:self-start">
        <h1 className="text-2xl font-semibold">Create social posts</h1>
        <p className="mb-6 mt-1 text-sm text-zinc-600 dark:text-zinc-400">
          Describe your business and message. PostForge writes and edits posts for each platform.
        </p>
        <GenerateForm loading={loading} onSubmit={generate} />
      </section>
      <section>
        <ResultsPanel result={result} loading={loading} error={error} pendingPlatforms={pending} />
      </section>
    </div>
  );
}
