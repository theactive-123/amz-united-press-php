<?php
/**
 * Global header: <head> (SEO, icons, styles), skip link, SVG icons, top navigation.
 * Each page sets $meta before including this file:
 *   title, description, path (like '/services'), nav (menu item to highlight), image (optional),
 *   schema (optional list of JSON-LD arrays), noindex (optional true), og_type (optional)
 */
$meta = array_merge(['title' => site('name'), 'description' => '', 'path' => '/', 'nav' => '', 'image' => '/assets/img/og-image.jpg', 'schema' => [], 'noindex' => false, 'og_type' => 'website'], $meta ?? []);
$canonical = abs_url($meta['path'] === '/' ? '/' : $meta['path']);
$ogImage   = str_starts_with($meta['image'], 'http') ? $meta['image'] : abs_url($meta['image']);
$schemas   = array_merge([
    ['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'logo' => abs_url('/assets/img/logo.png'), 'description' => 'Ghostwriting, ebook writing, book editing, cover design, publishing and book marketing services for authors and businesses.', 'telephone' => site('phone'), 'email' => site('email')],
    ['@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => site('name'), 'url' => abs_url('/')],
], $meta['schema']);
header('X-Content-Type-Options: nosniff');
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($meta['title']) ?></title>
<meta name="description" content="<?= e($meta['description']) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="robots" content="<?= $meta['noindex'] ? 'noindex, follow' : 'index, follow, max-image-preview:large' ?>">
<meta name="theme-color" content="#F29102">

<!-- Social sharing -->
<meta property="og:site_name" content="<?= e(site('name')) ?>">
<meta property="og:type" content="<?= e($meta['og_type']) ?>">
<meta property="og:title" content="<?= e($meta['title']) ?>">
<meta property="og:description" content="<?= e($meta['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($ogImage) ?>">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($meta['title']) ?>">
<meta name="twitter:description" content="<?= e($meta['description']) ?>">
<meta name="twitter:image" content="<?= e($ogImage) ?>">

<!-- Icons and app manifest -->
<link rel="apple-touch-icon" sizes="180x180" href="<?= e(url('/apple-touch-icon.png')) ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= e(url('/favicon-32x32.png')) ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= e(url('/favicon-16x16.png')) ?>">
<link rel="shortcut icon" href="<?= e(url('/favicon.ico')) ?>">
<link rel="manifest" href="<?= e(url('/site.webmanifest')) ?>">

<!-- Fonts and styles -->
<link rel="preload" href="<?= e(asset('fonts/inter-100-900.woff2')) ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?= e(asset('fonts/instrument-serif-italic-400.woff2')) ?>" as="font" type="font/woff2" crossorigin>
<link rel="preconnect" href="https://images.unsplash.com" crossorigin>
<link rel="stylesheet" href="<?= e(asset('css/fonts.css')) ?>">
<?php if (!empty($meta['lp'])): /* landing pages: one standalone stylesheet */ ?>
<link rel="stylesheet" href="<?= e(asset('css/lp.css')) ?>">
<?php else: ?>
<link rel="stylesheet" href="<?= e(asset('css/base.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/theme.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/home.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/pages.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/site.css')) ?>">
<?php endif; ?>
<script>document.documentElement.classList.add('js');</script>

<?php foreach ($schemas as $s): ?>
<script type="application/ld+json"><?= json_encode($s, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endforeach; ?>
<?php if (cfg('ga4_id')): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(cfg('ga4_id')) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config','<?= e(cfg('ga4_id')) ?>');</script>
<?php endif; ?>
</head>
<body>
<a class="skip" href="#main">Skip to main content</a>
<div class="progress" id="progress" aria-hidden="true"></div>
<?php readfile(__DIR__ . '/../partials/sprite.svg'); ?>

<?php
$tel = preg_replace('/[^\d+]/', '', site('phone'));
$resources = [['/portfolio', 'Portfolio', 'portfolio'], ['/how-it-works', 'How It Works', 'how-it-works'], ['/faq', 'FAQs', 'faq'], ['/pricing', 'Pricing', 'pricing'], ['/about', 'About Us', 'about'], ['/contact', 'Contact Us', 'contact']];
$curCat = $meta['cat'] ?? '';
?>
<?php if (!empty($meta['lp'])): ?>
<header class="lph">
  <div class="lph-in">
    <a class="logo" href="<?= e(url('/')) ?>" aria-label="<?= e(site('name')) ?> — home"><img src="<?= e(asset('img/logo.png')) ?>" width="491" height="213" alt="<?= e(site('name')) ?>"></a>
    <p class="lph-note"><?= ic('shield') ?>You keep 100% of your rights &amp; royalties</p>
    <div class="lph-acts">
      <a class="lph-tel" href="tel:<?= e($tel) ?>" data-lp-call aria-label="Call <?= e(site('phone')) ?>"><?= ic('phone') ?><span><?= e(site('phone')) ?></span></a>
      <a class="btn btn-primary" href="#lp-form" data-lp-cta>Get a Free Quote</a>
    </div>
  </div>
</header>
<?php else: ?>
<header class="site-header hdr">
  <div class="hdr-in">
    <a class="logo" href="<?= e(url('/')) ?>" aria-label="<?= e(site('name')) ?> — home"><img src="<?= e(asset('img/logo.png')) ?>" width="491" height="213" alt="<?= e(site('name')) ?>"></a>
    <div class="hdr-right">
      <nav class="hdr-nav" id="nav" aria-label="Main">
        <ul class="hdr-menu">
          <li><a class="hdr-top" href="<?= e(url('/')) ?>"<?= $meta['nav'] === 'home' ? ' aria-current="page"' : '' ?>>Home</a></li>
          <?php foreach (data('cats') as $c): ?>
          <li class="hdr-dd">
            <a class="hdr-top" href="<?= e(url('/services#cat-' . $c['k'])) ?>"<?= $curCat === $c['k'] ? ' aria-current="true"' : '' ?>><?= e($c['t']) ?></a>
            <button type="button" class="dd-tog" aria-expanded="false" aria-label="Show <?= e($c['t']) ?>"><?= ic('arrow') ?></button>
            <ul class="dd">
              <?php foreach (subs_of($c['k']) as $s): ?><li><a href="<?= e(url('/services/' . $s['slug'])) ?>"<?= ($meta['path'] ?? '') === '/services/' . $s['slug'] ? ' aria-current="page"' : '' ?>><?= e($s['t']) ?></a></li><?php endforeach; ?>
            </ul>
          </li>
          <?php endforeach; ?>
          <li class="hdr-dd hdr-dd-end">
            <button type="button" class="hdr-top hdr-top-btn"<?= in_array($meta['nav'], array_column($resources, 2), true) ? ' data-current' : '' ?>>Resources</button>
            <button type="button" class="dd-tog" aria-expanded="false" aria-label="Show Resources"><?= ic('arrow') ?></button>
            <ul class="dd">
              <?php foreach ($resources as $i => $r): ?><li<?= $i === 4 ? ' class="dd-sep"' : '' ?>><a href="<?= e(url($r[0])) ?>"<?= $meta['nav'] === $r[2] ? ' aria-current="page"' : '' ?>><?= e($r[1]) ?></a></li><?php endforeach; ?>
            </ul>
          </li>
        </ul>
        <div class="hdr-acts hdr-acts-m">
          <a class="btn btn-outline" href="tel:<?= e($tel) ?>"><?= ic('phone') ?><?= e(site('phone')) ?></a>
          <button type="button" class="btn btn-primary" data-quote>Get a Quote</button>
        </div>
      </nav>
      <div class="hdr-acts">
        <a class="hdr-phone" href="tel:<?= e($tel) ?>"><?= ic('phone') ?><span><?= e(site('phone')) ?></span></a>
        <button type="button" class="btn btn-dark" data-quote="I’d like to book a call to discuss my book.">Book a Call</button>
        <button type="button" class="btn btn-primary" data-quote>Get a Quote</button>
        <button type="button" class="btn btn-outline" data-chat>Live Chat</button>
      </div>
    </div>
    <a class="hdr-call-m" href="tel:<?= e($tel) ?>" aria-label="Call <?= e(site('phone')) ?>"><?= ic('phone') ?></a>
    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><svg class="ic" aria-hidden="true"><use href="#i-menu"/></svg></button>
  </div>
</header>
<?php endif; ?>
<main id="main" tabindex="-1">
