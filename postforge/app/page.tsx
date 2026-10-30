import { PLATFORM_RULES } from "@/lib/ai/platformRules";

// Stage 1 placeholder: the real form arrives in Stage 2 and the results screen in Stage 4.
export default function Home() {
  return (
    <div className="grid gap-6 lg:grid-cols-2">
      <section className="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
        <h1 className="text-2xl font-semibold">Create social posts</h1>
        <p className="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
          Describe your business and your message. PostForge will write posts for each platform.
        </p>
        <p className="mt-6 rounded-lg bg-brand-50 p-4 text-sm text-brand-700 dark:bg-zinc-800 dark:text-zinc-200">
          The input form will appear here in Stage 2.
        </p>
      </section>

      <section className="rounded-2xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">
        <h2 className="text-lg font-semibold">Supported platforms</h2>
        <ul className="mt-4 space-y-2 text-sm">
          {Object.values(PLATFORM_RULES).map((p) => (
            <li key={p.label} className="flex justify-between border-b border-zinc-100 pb-2 dark:border-zinc-800">
              <span>{p.label}</span>
              <span className="text-zinc-500">{p.charLimit.toLocaleString("en-US")} character limit</span>
            </li>
          ))}
        </ul>
      </section>
    </div>
  );
}
