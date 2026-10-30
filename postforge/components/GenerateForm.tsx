"use client";

import { useEffect, useState } from "react";
import { PLATFORM_RULES } from "@/lib/ai/platformRules";
import { GOALS, PLATFORMS, TONES, type GenerateInput, type Platform } from "@/types";

const DRAFT_KEY = "postforge-form-draft";

export const EMPTY_FORM: GenerateInput = {
  brandName: "",
  description: "",
  audience: "",
  tone: "friendly",
  platforms: ["instagram", "linkedin"],
  goal: "engagement",
  topic: "",
  offer: "",
  date: "",
  link: "",
  cta: "",
  keywords: "",
  avoidWords: "",
  language: "English",
  variations: 1,
  includeHashtags: true,
  includeEmojis: true,
};

const inputClass =
  "w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 dark:border-zinc-700 dark:bg-zinc-950";
const labelClass = "mb-1 block text-sm font-medium";
const capitalize = (s: string) => s.charAt(0).toUpperCase() + s.slice(1);

interface Props {
  loading: boolean;
  onSubmit: (input: GenerateInput) => void;
}

export default function GenerateForm({ loading, onSubmit }: Props) {
  const [form, setForm] = useState<GenerateInput>(EMPTY_FORM);
  const [error, setError] = useState("");

  // Restore the last thing the user typed, so a page refresh doesn't lose their work.
  useEffect(() => {
    try {
      const saved = localStorage.getItem(DRAFT_KEY);
      // eslint-disable-next-line react-hooks/set-state-in-effect -- localStorage is only available after mounting
      if (saved) setForm({ ...EMPTY_FORM, ...JSON.parse(saved) });
    } catch {
      // Ignore broken or blocked storage.
    }
  }, []);

  function update<K extends keyof GenerateInput>(key: K, value: GenerateInput[K]) {
    setForm((prev) => {
      const next = { ...prev, [key]: value };
      try {
        localStorage.setItem(DRAFT_KEY, JSON.stringify(next));
      } catch {
        // Storage can be full or blocked; the form still works.
      }
      return next;
    });
  }

  function togglePlatform(p: Platform) {
    update("platforms", form.platforms.includes(p) ? form.platforms.filter((x) => x !== p) : [...form.platforms, p]);
  }

  function handleSubmit(e: React.FormEvent) {
    e.preventDefault();
    if (!form.brandName.trim() || !form.description.trim() || !form.audience.trim() || !form.topic.trim()) {
      setError("Please fill in brand name, what it does, target audience and topic.");
      return;
    }
    if (!form.platforms.length) {
      setError("Please choose at least one platform.");
      return;
    }
    setError("");
    onSubmit(form);
  }

  return (
    <form onSubmit={handleSubmit} className="space-y-5">
      <div className="grid gap-4 sm:grid-cols-2">
        <div className="sm:col-span-2">
          <label htmlFor="brandName" className={labelClass}>Brand / business name *</label>
          <input id="brandName" className={inputClass} maxLength={100} value={form.brandName}
            onChange={(e) => update("brandName", e.target.value)} placeholder="e.g. Crumb & Co." />
        </div>
        <div className="sm:col-span-2">
          <label htmlFor="description" className={labelClass}>What it sells or does *</label>
          <textarea id="description" className={inputClass} rows={2} maxLength={600} value={form.description}
            onChange={(e) => update("description", e.target.value)}
            placeholder="e.g. Neighbourhood sourdough bakery in Leeds, baking everything before 6am" />
        </div>
        <div className="sm:col-span-2">
          <label htmlFor="audience" className={labelClass}>Target audience *</label>
          <input id="audience" className={inputClass} maxLength={300} value={form.audience}
            onChange={(e) => update("audience", e.target.value)} placeholder="e.g. Local families and remote workers" />
        </div>
        <div>
          <label htmlFor="tone" className={labelClass}>Tone</label>
          <select id="tone" className={inputClass} value={form.tone}
            onChange={(e) => update("tone", e.target.value as GenerateInput["tone"])}>
            {TONES.map((t) => <option key={t} value={t}>{capitalize(t)}</option>)}
          </select>
        </div>
        <div>
          <label htmlFor="goal" className={labelClass}>Goal</label>
          <select id="goal" className={inputClass} value={form.goal}
            onChange={(e) => update("goal", e.target.value as GenerateInput["goal"])}>
            {GOALS.map((g) => <option key={g} value={g}>{capitalize(g)}</option>)}
          </select>
        </div>
      </div>

      <fieldset>
        <legend className={labelClass}>Platforms *</legend>
        <div className="flex flex-wrap gap-2">
          {PLATFORMS.map((p) => {
            const checked = form.platforms.includes(p);
            return (
              <label key={p}
                className={`cursor-pointer rounded-full border px-3 py-1.5 text-sm transition select-none ${
                  checked
                    ? "border-brand-600 bg-brand-600 text-white"
                    : "border-zinc-300 hover:border-brand-500 dark:border-zinc-700"
                }`}>
                <input type="checkbox" className="sr-only" checked={checked} onChange={() => togglePlatform(p)} />
                {PLATFORM_RULES[p].label}
              </label>
            );
          })}
        </div>
      </fieldset>

      <div>
        <label htmlFor="topic" className={labelClass}>Topic or key message *</label>
        <textarea id="topic" className={inputClass} rows={3} maxLength={800} value={form.topic}
          onChange={(e) => update("topic", e.target.value)}
          placeholder="e.g. Launching our pumpkin & sage sourdough, weekends only" />
      </div>

      <details className="group rounded-lg border border-zinc-200 p-4 dark:border-zinc-800" open>
        <summary className="cursor-pointer text-sm font-medium">Extra details (optional)</summary>
        <p className="mt-1 text-xs text-zinc-500">Offer, date and link are copied into posts exactly as you type them.</p>
        <div className="mt-4 grid gap-4 sm:grid-cols-2">
          <div>
            <label htmlFor="offer" className={labelClass}>Offer / discount</label>
            <input id="offer" className={inputClass} maxLength={300} value={form.offer}
              onChange={(e) => update("offer", e.target.value)} placeholder="e.g. 20% off all loaves" />
          </div>
          <div>
            <label htmlFor="date" className={labelClass}>Date</label>
            <input id="date" className={inputClass} maxLength={100} value={form.date}
              onChange={(e) => update("date", e.target.value)} placeholder="e.g. Saturday 2 November" />
          </div>
          <div>
            <label htmlFor="link" className={labelClass}>Link</label>
            <input id="link" className={inputClass} maxLength={300} value={form.link}
              onChange={(e) => update("link", e.target.value)} placeholder="https://..." />
          </div>
          <div>
            <label htmlFor="cta" className={labelClass}>Call to action</label>
            <input id="cta" className={inputClass} maxLength={200} value={form.cta}
              onChange={(e) => update("cta", e.target.value)} placeholder="e.g. Pre-order online" />
          </div>
          <div>
            <label htmlFor="keywords" className={labelClass}>Keywords</label>
            <input id="keywords" className={inputClass} maxLength={300} value={form.keywords}
              onChange={(e) => update("keywords", e.target.value)} placeholder="comma separated" />
          </div>
          <div>
            <label htmlFor="avoidWords" className={labelClass}>Words to avoid</label>
            <input id="avoidWords" className={inputClass} maxLength={300} value={form.avoidWords}
              onChange={(e) => update("avoidWords", e.target.value)} placeholder="comma separated" />
          </div>
        </div>
      </details>

      <div className="grid gap-4 sm:grid-cols-2">
        <div>
          <label htmlFor="language" className={labelClass}>Language</label>
          <input id="language" className={inputClass} maxLength={40} value={form.language}
            onChange={(e) => update("language", e.target.value)} />
        </div>
        <div>
          <label htmlFor="variations" className={labelClass}>Variations per platform</label>
          <select id="variations" className={inputClass} value={form.variations}
            onChange={(e) => update("variations", Number(e.target.value) as 1 | 2 | 3)}>
            {[1, 2, 3].map((n) => <option key={n} value={n}>{n}</option>)}
          </select>
        </div>
      </div>

      <div className="flex flex-wrap gap-6 text-sm">
        <label className="flex items-center gap-2">
          <input type="checkbox" className="h-4 w-4 accent-brand-600" checked={form.includeHashtags}
            onChange={(e) => update("includeHashtags", e.target.checked)} />
          Include hashtags
        </label>
        <label className="flex items-center gap-2">
          <input type="checkbox" className="h-4 w-4 accent-brand-600" checked={form.includeEmojis}
            onChange={(e) => update("includeEmojis", e.target.checked)} />
          Include emojis
        </label>
      </div>

      {error && (
        <p role="alert" className="rounded-lg bg-red-50 p-3 text-sm text-red-700 dark:bg-red-950/50 dark:text-red-300">
          {error}
        </p>
      )}

      <button type="submit" disabled={loading}
        className="w-full rounded-lg bg-brand-600 px-4 py-3 font-medium text-white transition hover:bg-brand-700 disabled:cursor-not-allowed disabled:opacity-60">
        {loading ? "Writing your posts..." : "Generate posts"}
      </button>
    </form>
  );
}
