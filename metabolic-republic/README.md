# Metabolic Republic: static site (single master file)

This folder builds the Figma page **"Client Feedback v3 (legal updates)"** (file `XMoXC5e65Jw6ZGHJvG6EkC`) in plain HTML, CSS and vanilla JS. As requested, every page lives in **one master HTML file**.

## Files

| File | What it is |
|---|---|
| `metabolic-republic-master.html` | **The deliverable.** One self-contained file: all 15 pages, CSS, JS, fonts link and every image embedded (about 5.8 MB). Double-click it to open it in a browser, with no server needed. |
| `index.html` | The same master file, except images load from `assets/`. It is lighter (about 220 KB plus images) and better for hosting. |
| `css/styles.css`, `js/main.js` | The shared CSS and JS as separate files, for reference when rebuilding in Webflow. |
| `assets/img`, `assets/icons` | Photos and SVGs exported from Figma. |
| `src/` | The source the build assembles: `shell.html` (head, nav, menu and footer), `pages/*.html` (one per page), `partials/`, `styles.css` and `main.js`. |
| `build.py` | Run `python3 build.py` after editing anything in `src/` (needs Pillow). |

## Pages (hash routes inside the one file)

| Route | Figma frame |
|---|---|
| `#/` | Home |
| `#/about` | About |
| `#/classes` | Classes |
| `#/membership` | Membership (Option A: pricing tiers) |
| `#/membership-b` | Membership (Option B: lead capture) |
| `#/contact` | Contact |
| `#/consultation` | Consultation |
| `#/landing` | Landing |
| `#/new-client` | New Client |
| `#/interview` | Interview |
| `#/billing` | Billing (noindex) |
| `#/provider-redirect` | Provider Redirect (noindex, no nav or footer) |
| `#/provider-login` | Provider Portal Login (noindex, no nav or footer) |
| `#/privacy`, `#/terms` | Placeholder pages ("Policy coming soon") |

The router swaps the `<title>`, meta description, Open Graph tags and `robots` for each page. Links like `about.html` also resolve: `#/about.html` maps to `#/about`. Each page is a `<div class="page" data-route="…">` block, so splitting it back into separate files for Webflow is a copy-paste job.

## Connecting the forms

The constants are at the top of `src/main.js`:

```js
var FORM_ENDPOINT = '';   // POST endpoint (JSON body). Empty = demo mode.
var PROVIDER_URL = '#';   // OakTree Allied provider portal URL.
```

- When `FORM_ENDPOINT` is empty, a form shows its success message and logs the data to the console.
- When it is set, every form POSTs JSON: the fields plus `form` (an identifier) and `page`.
- Each form has a hidden honeypot field (`company`). If a bot fills it in, the form shows success but sends nothing.
- Form identifiers:
  - `waitlist`, `footer-waitlist`, `contact-waitlist`
  - `contact`
  - `callback` (Membership B)
  - `interview`
  - `provider-login` (placeholder: it always shows "The provider portal is coming soon.")

## Class data (single source of truth)

The `CLASSES` object in `main.js` renders three things: the Home carousel, the class library and the timetable (`TIMETABLE`). Class names and durations live in one place only:

Strength Foundations 50, Strength & Balance 50, Core & Posture 40, Low-impact Cardio 40, Mobility Flow 45, Breathwork 30, Restore 45, Personal coaching 60.

## Placeholders the client still needs to supply

- **Club phone number** (Contact page). It currently shows "Shared before opening day".
- **Privacy Policy and Terms.** `#/privacy` and `#/terms` are placeholder pages.
- **OakTree Allied website and provider portal URL.** `PROVIDER_URL` is `"#"`, and the redirect page does not auto-redirect.
- **Social links** (Instagram, Facebook, TikTok). All are `"#"`.
- **Opening hours.** These show "Hours announced soon" and "Published before opening day", as in Figma.
- **Form backend.** `FORM_ENDPOINT` is empty.
- **FAQ answers 2–6** (Membership A). These have no answer copy in Figma, so a visible placeholder is shown.
- **Annual prices** (Membership A toggle). Figma shows the toggle but no annual prices; selecting Annual shows "Annual price to be confirmed".
- **Contact topic options.** Figma shows only "Choose a topic". The options (Membership, Coaching, Visiting the club, Something else) come from the hero copy and should be confirmed.
- **Trainer names and photos** (Landing). These are labelled "Trainer name" and "Placeholder photo" in Figma.
- **Map** (Contact). This is a placeholder card, as in Figma.
- **Open Graph image.** It uses `assets/img/hero-home.jpg` and needs an absolute URL once hosted.
