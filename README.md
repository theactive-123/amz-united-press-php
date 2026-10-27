# AMZ United Press: PHP website

A multi-page, server-rendered PHP site (PHP 8.0+, Apache with mod_rewrite). All forms use POST to one handler, send email through SMTP (PHPMailer), and work with or without JavaScript.

## Folder structure

```
/
├── index.php, services.php, service.php, portfolio.php, how-it-works.php,
│   pricing.php, about.php, faq.php, contact.php, privacy.php, terms.php   ← pages (one file per URL)
├── thank-you.php, 404.php                  ← form success page, error page
├── sitemap.php  → served at /sitemap.xml   ← built automatically from the page list
├── robots.txt, .htaccess                   ← search rules, clean URLs, security, caching
├── favicon.ico, favicon-16x16.png, favicon-32x32.png, apple-touch-icon.png,
│   android-chrome-192x192.png, android-chrome-512x512.png, site.webmanifest
├── forms/submit.php                        ← the ONE handler every form posts to
├── includes/
│   ├── config.php      ← SMTP email settings, secret key, site URL  (EDIT THIS)
│   ├── data.php        ← site text: menus, prices, FAQ, team, contact details (EDIT THIS)
│   ├── services/       ← one content file per service page (EDIT THIS)
│   ├── header.php      ← global <head> (SEO, icons), logo, navigation
│   ├── footer.php      ← global footer, quote pop-up, scripts
│   ├── functions.php, forms.php, sections.php, Mailer.php, bootstrap.php
│   └── lib/PHPMailer/  ← email library (bundled, nothing to install)
├── partials/sprite.svg                     ← icon set
├── assets/css, assets/js, assets/fonts, assets/img   ← styles, scripts, fonts, logo
└── storage/            ← logs and rate-limit files (private, created automatically)
```

## 1. Set up email (SMTP)

Open `includes/config.php` and fill in:

- `site_url`: your live address, e.g. `https://www.yourdomain.com` (used for canonical links, the sitemap and social previews)
- `mail.host`, `port`, `encryption`, `username`, `password`: from your hosting or email provider (cPanel → Email Accounts → Connect Devices shows them). Usual values: port 587 with `tls`, or port 465 with `ssl`.
- `mail.from_email`: an address on your own domain
- `mail.to_email`: where enquiries should arrive
- `security.secret`: replace with a long random text

Every submission is also saved to `storage/submissions.log`, so nothing is lost if email fails. Email errors go to `storage/mail-error.log`. Set `mail.debug` to `true` while testing.

## 2. Deploy

1. Upload everything (including the hidden `.htaccess` files) to the web root, usually `public_html`.
2. Make sure `storage/` is writable by PHP (permissions 755 or 775).
3. In `.htaccess`, uncomment the HTTPS and `www` redirect lines once your SSL certificate is active.
4. In `robots.txt`, replace `www.example.com` with your domain.
5. Visit `/sitemap.xml` and submit it in Google Search Console.

Sub-folder install (e.g. `/demo`): set `base_path` in `config.php` to `/demo` and `RewriteBase` in `.htaccess` to `/demo/`.

## 3. Edit content

- Text, prices, services, FAQ, team, contact details: `includes/data.php`
- Page title and meta description of each page: the `$meta` block at the top of that page's PHP file (keep titles under about 60 characters and descriptions under 160)
- Logo: replace `assets/img/logo.png` (dark text) and `assets/img/logo-light.png` (for the footer)
- Social preview image: `assets/img/og-image.jpg` (1200×630)
- Photos are Unsplash placeholders listed in `photos()` in `includes/functions.php`. Replace with your own licensed photos before launch.
- Set `show_placeholder_notes` to `false` in `data.php` to hide the grey "placeholder" notes.
- Service pages: each of the 21 services has its own content file in `includes/services/{slug}.php` (title, meta description, hero, sections, FAQs). To add a service, copy one of these files, then add its slug to the right menu list under `cats` in `data.php`. Its page, menu link, footer link and sitemap entry appear automatically.
- Inside service copy, `[[book-editing-services|book editing]]` becomes an internal link to that service, and `[[/pricing|our prices]]` links to a page.
- The header's **Live Chat** button opens Tawk.to, LiveChat, Tidio, Crisp or Zendesk if one is installed (paste its embed code before `</body>` in `includes/footer.php`); otherwise it opens the quote form.

## 4. Run on your own computer

```
cd amz-united-press-php
php -S localhost:8000
```
Open http://localhost:8000. Note: PHP's built-in server does not read `.htaccess`, so clean URLs such as `/pricing` need Apache (XAMPP, MAMP, Laragon or real hosting). Home, `/index.php` links and form posting work either way.

## How forms work

Every form posts (POST) to `forms/submit.php`, which checks: CSRF token, hidden honeypot field, signed timestamp (rejects bots that submit instantly), per-visitor rate limit, and field validation. Then it emails you and a confirmation to the visitor. With JavaScript the page shows the result in place; without it, the visitor is redirected to `/thank-you` or back to the form with the errors. A GET request to the handler just redirects to `/contact`.

## Before launch checklist

- [ ] SMTP details and `secret` filled in, test form sent
- [ ] Real phone, email, address in `data.php`
- [ ] Privacy and Terms text reviewed by a lawyer (they are templates)
- [ ] Placeholder photos, story text and sample covers replaced or confirmed
- [ ] HTTPS redirect enabled, `site_url` and `robots.txt` domain updated
- [ ] Optional: add your Google Analytics 4 ID as `ga4_id` in `config.php`
# amz-united-press-php
