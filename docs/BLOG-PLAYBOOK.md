# AMZ United Press — daily blog playbook

Used by the daily scheduled blog task. Follow it exactly; it keeps every article consistent.

## How the blog works
- One file per article: `includes/posts/{slug}.php`, returning an array. Copy the structure of
  `includes/posts/how-much-does-it-cost-to-self-publish-a-book.php` (keys: slug, title, h1, h1_plain,
  description, excerpt, date, updated, category, keyword, keywords, image, image_alt, related, faq, body).
- New files appear automatically on `/blog`, at `/blog/{slug}`, and in `/sitemap.xml`.
- Styles available in the body: `bp-answer` (quick answer), `bp-keys` (key takeaways), `bp-table-wrap` +
  `bp-table`, `bp-tip`, `bp-fig`, `bp-math`, `bp-ol`, `bp-flags`, `bp-budgets`, `bp-cta` (in-article CTA box).
- Featured image: 1200×630 JPG in `assets/img/blog/{slug}.jpg`, rendered in brand style (ink background,
  orange gradient accent, Inter headline with an Instrument Serif italic line, logo-light.png bottom-left).
  Also save a WebP copy next to it (`assets/img/blog/{slug}.webp`, quality ~80): pages serve the WebP automatically,
  while the JPG stays for social sharing. Reuse images from `assets/img/lp/` inside the article where they genuinely fit.

## Topic selection
- Check `docs/blog-log.md` and existing `includes/posts/` first. Never repeat a primary keyword or cover
  the same search intent twice.
- Audience: authors who want to write, publish or market a book on Amazon KDP and other stores.
- Prefer keywords with clear intent that lead to a service: ghostwriting, ebook writing, editing,
  proofreading, formatting, cover design, publishing, Amazon KDP, book marketing, audiobooks, author websites.
- Research with web search: who ranks, what they cover, what they miss, People Also Ask questions.
  Be honest that exact search volume needs a paid tool; pick by intent and competition.

## Writing rules
- 1,800–3,000 words, original, practical, plain English. No fluff, no invented statistics, testimonials,
  or claims. Verify facts (Amazon KDP, Bowker, etc.) and link official sources.
- Primary keyword in: title tag (≤ 60 chars), meta description (140–155 chars), H1, slug, first 100 words.
- One H1 (set by the template). Logical H2/H3 structure with `id` attributes. Quick-answer box first.
- 4–8 internal links to relevant `/services/...`, `/pricing`, `/contact`, and earlier blog posts.
- 5–8 FAQs. One in-article CTA box. Brand voice: honest, helpful, "you keep 100% of your rights and royalties".
- Real prices only: publishing packages $199 / $499 / $899 (data.php `prices`), service "from" prices in
  `includes/services/*.php`. Phone and email come from data.php; never hard-code them.

## QA before pushing
- `php -l` on new files; page returns 200 with no PHP warnings; title/description lengths; one H1;
  BlogPosting + FAQPage + BreadcrumbList JSON-LD present; all internal links return 200; images have alt text;
  no horizontal overflow at 1440 / 768 / 390 / 360 px (Playwright is preinstalled).
- Add a line to `docs/blog-log.md`: date | slug | primary keyword | category.
- Commit to `main` with a clear message and push. Do not touch any other part of the site.
