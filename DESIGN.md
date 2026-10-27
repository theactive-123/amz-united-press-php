# DESIGN.md — AMZ United Press landing pages (/lp/*)

> Look like a working publishing house, not a template: real authors, real books, print-shop craft.

Scope: the five ad landing pages in `/lp/`. They load only `fonts.css` and the standalone `assets/css/lp.css`, and every section is rendered by a component in `includes/lp.php`. The sections are hero, trust bar, before/after panels, cards, steps, books, author marquee, CTA band, tiers, table, quotes, FAQ and final form. All of them share one 1200px container, one gutter and one section-spacing scale. Full-bleed sections are the hero, trust bar, CTA bands, author marquee and the ink sections; their content always sits inside the container. The logo, the brand orange and the ink black stay as they are. This file is not served on the web (`.htaccess` blocks it).

## 1. Visual Theme & Atmosphere

**Chosen direction (approved):** close to the reference agency landing pages (the screenshots the client shared), but in AMZ United Press colours and with real assets.

**Style**: Publishing-agency direct response
**Keywords**: bold, dense, trustworthy, book-filled, offer-led, form-first, real faces
**Tone**: a busy, successful publishing agency that wants your call — NOT a minimal SaaS template, NOT "AI landing page"
**Feel**: walking into a publisher's office with books on every wall and someone already reaching for the phone.

**Why the old pages read as AI-made:**
1. One formula repeated 8–10 times per page: mono dot-label, giant tight heading with one italic-serif "accent" word, grey paragraph, grid of equal cards.
2. Gradient icon tiles in every card and round-check bullets on every list.
3. No real people or objects. The real author photos and covers were barely used.
4. Uniform soft 18px radii, blurred glows, gradient pill buttons, identical rhythm.

**How this design fixes it (agency style):**
- **A dark hero built from the client's real book covers** (a tilted cover mosaic behind an ink overlay), with the sign-up form on the right and a "50% OFF" offer sticker on the form, as in the reference.
- **Bold, plain sans headlines** (Inter 800, normal tracking). Emphasis is an orange phrase, not an italic serif word.
- **Boxy buttons** (6px corners, solid fills, no glow), plus a CTA strip after most sections: Get a Quote | Live Chat | phone.
- **Real imagery in every scroll:** 3D book mockups from the real covers, an "Our authors with their books" photo strip of real client photos, and store logos.
- **Denser content and varied blocks:** alternating white, light grey, ink and orange bands; numbered process with arrows; packages; comparison; two-column FAQ.
- **Icons are plain orange line icons**, with no gradient tiles.

**Interaction Tier**: L2 (light), because ad landing pages must load fast on mobile.
**Dependencies**: CSS + one small vanilla script (IntersectionObserver). No GSAP or WebGL.

## 2. Color Palette & Roles

```css
:root {
  /* Backgrounds */
  --lp-paper: #FBF7EF;          --lp-paper-rgb: 251,247,239;   /* page */
  --lp-sheet: #FFFFFF;                                          /* cards, forms */
  --lp-kraft: #EFE6D4;          --lp-kraft-rgb: 239,230,212;   /* alternate sections */
  --lp-ink: #141413;            --lp-ink-rgb: 20,20,19;        /* dark sections, text */
  --lp-ink-2: #23211E;                                          /* card on dark */

  /* Borders */
  --lp-rule: #141413;                                           /* hard rules and borders */
  --lp-rule-soft: #D9CFBC;                                      /* hairlines on paper */
  --lp-rule-dark: rgba(251,247,239,.18);                        /* hairlines on ink */

  /* Text */
  --lp-text: #141413;
  --lp-text-2: #4A463F;                                         /* body on paper */
  --lp-text-3: #7A7468;                                         /* captions */
  --lp-text-inv: #FBF7EF;   --lp-text-inv-2: #CFC8BA;           /* on ink */

  /* Accent (brand) */
  --lp-orange: #F29102;         --lp-orange-rgb: 242,145,2;
  --lp-orange-deep: #B04A00;                                    /* accent text on paper (AA) */
  --lp-marker: rgba(242,145,2,.38);                             /* highlighter */

  /* Semantic */
  --lp-yes: #1E7A3C;  --lp-no: #B3261E;  --lp-warn: #A86A00;
}
```

**Color rules:**
- Use colours only through these variables.
- Orange is for action and emphasis only: primary buttons, the marker underline, the stamp, numbers. Never use it as a section background.
- No gradients anywhere, except the paper-grain texture overlay.
- Orange text on paper uses `--lp-orange-deep`, never `--lp-orange`, to pass contrast.

## 3. Typography Rules

Fonts are self-hosted (`/assets/fonts`, declared in `fonts.css`), with no extra network requests.

```css
--lp-sans: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
```

| Role | Font | Size | Weight | Line height | Letter spacing |
|---|---|---|---|---|---|
| Hero H1 | Inter | clamp(2.4rem, 4.8vw, 4rem) | 800 | 1.08 | -0.02em |
| Section H2 | Inter | clamp(1.8rem, 3.2vw, 2.6rem) | 800 | 1.15 | -0.015em |
| H3 | Inter | 1.15–1.3rem | 700 | 1.3 | -0.005em |
| Body | Inter | 1.02rem | 400 | 1.7 | 0 |
| Lead | Inter | 1.12rem | 400 | 1.65 | 0 |
| Sub-heading over H2 | Inter | .95rem | 600 | 1.3 | 0, sentence case, orange-deep |
| Numbers (stats, steps) | Inter | 2.4–3.4rem | 800 | 1 | -0.02em |

**Rules:**
- Emphasis inside a heading is a plain orange phrase (`<em>` is styled as normal-weight orange, not italic).
- No gradient or shadowed text.
- **Never use on landing pages**: JetBrains Mono labels, the italic Instrument Serif accent word, or Bebas.

## 4. Component Stylings

### Buttons
```css
.btn-primary{background:var(--lp-orange);color:var(--lp-ink);border:2px solid var(--lp-orange);border-radius:6px;min-height:50px;padding:13px 24px;font:700 1rem/1.2 var(--lp-sans)}
.btn-primary:hover{background:var(--lp-orange-deep);border-color:var(--lp-orange-deep);color:#fff}
.btn-primary:active{transform:translateY(1px)}
.btn-outline{background:transparent;border:2px solid currentColor;color:inherit;border-radius:6px}
.btn-outline:hover{background:var(--lp-ink);color:#fff;border-color:var(--lp-ink)}
.btn:focus-visible{outline:3px solid var(--lp-orange);outline-offset:3px}
.btn[disabled]{opacity:.5;pointer-events:none}
```
There are no pill shapes, gradients or glows.

### Cards
White, 1px light border, 8px radius, a 3px orange top rule and one soft shadow (`0 10px 30px -18px rgba(ink,.35)`). On hover the card lifts 3px and the border turns ink. Icons are 32px orange line icons, with no tile.

### Offer sticker
A shield-shaped badge on the hero form: small "SUPER SALE" line, big "50% OFF", and a small "limited time" or end-date line. The text comes from `data.php → site.offer` and is hidden when the offer is switched off.

### 3D book mockup
A real cover image with a CSS spine, page edges and `rotateY(-18deg)`. It straightens on hover.

### Author photo strip
Square real photos of authors with their books, captioned "Our authors, holding the books we helped them publish". A CSS marquee scrolls it and pauses on hover. Photos are **never paired with sample testimonial names**.

### CTA strip
An orange band with a heading on the left and Get a Quote / Live Chat / phone on the right. It repeats every two to three sections, as in the reference.

### Navigation
Landing header: logo, rights note, phone and primary button. Sticky.

### Tags / chips
1.5px border, 6px radius, Inter 600. On hover they fill with ink.

## 5. Layout Principles
- Container: 1200px max, padding 20px on mobile and 32px on desktop.
- Section padding: 80–104px on desktop, 56–72px on mobile. Bands are denser than minimal SaaS pages.
- Surfaces alternate white → `--lp-kraft` light grey → ink → orange CTA strip.
- Headings may be centred (agency convention), but splits use asymmetric 7/5 layouts.

## 6. Depth & Elevation
- Cards and forms use one soft shadow: `0 10px 30px -18px rgba(var(--lp-ink-rgb),.35)`. The hero form uses `0 30px 60px -30px rgba(0,0,0,.6)`.
- 3D books use a contact shadow.
- No glows, no `backdrop-filter`, no offset print shadows.

## 7. Animation & Interaction (L2, light)

| Category | Effect | Where |
|---|---|---|
| Hero H1 | Line fade-up stagger on load (CSS, 500ms) | H1 |
| Section H2 | Fade-up on view (IntersectionObserver, once) | H2 |
| Body / label | Fade-up on view | Section intros |
| Element | Card lift and border change; 3D book straightens on hover; offer sticker wiggles once on load | Cards, books, sticker |
| Component | Author-photo marquee and store-logo marquee (CSS translateX) | Proof strips |
| Background | Real-cover mosaic behind the hero (static, ink overlay) | Hero |

```css
@media (prefers-reduced-motion: reduce){ *{animation:none!important;transition:none!important} .rv{opacity:1!important;transform:none!important} }
```

## 8. Do's and Don'ts

**Do**
1. Show real covers and real author photos in the hero or first scroll of every page.
2. Keep the form visible above the fold on desktop, with the offer sticker on it.
3. Repeat the CTA strip (Get a Quote | Live Chat | phone) every two to three sections.
4. Use specific copy: prices, timelines, what happens next.
5. Keep the orange for buttons, emphasis phrases, numbers and the sticker.

**Don't**
1. Don't use mono dot-labels above headings.
2. Don't use the italic-serif accent word in headings.
3. Don't use gradient icon tiles, gradient or pill buttons, or glowing shadows.
4. Don't put more than two equal-card grids on a page.
5. Don't use emoji, and don't repeat star-glyph strings as decoration.
6. Don't use AI-rendered "workspace" scenes.
7. Don't pair real author photos with sample or unverified testimonials.
8. Don't show a discount that isn't real or a countdown timer that resets.

## 9. Responsive Behavior

- Breakpoints: 1100px (splits become stacked where needed), 900px (single column, the form moves under the hero copy), 600px (mobile).
- Mobile: the sticky bottom bar (Call / Free quote) stays, the hero photo collage shrinks to two photos, and tables scroll horizontally inside a frame.
- Touch targets are at least 44×44px, and there's no horizontal overflow at 360px.
- Book mockups and the cover mosaic scale down; the author strip keeps scrolling.
