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
    ['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'logo' => abs_url('/assets/img/logo.png'), 'description' => 'Ebook writing, editing, cover design and publishing for authors and founders.'],
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
<link rel="stylesheet" href="<?= e(asset('css/base.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/theme.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/home.css')) ?>">
<link rel="stylesheet" href="<?= e(asset('css/pages.css')) ?>">
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

<header class="site-header">
  <div class="head-pill">
    <a class="logo" href="<?= e(url('/')) ?>" aria-label="<?= e(site('name')) ?> — home"><img src="<?= e(asset('img/logo.png')) ?>" width="491" height="213" alt="<?= e(site('name')) ?>"></a>
    <nav class="nav" id="nav" aria-label="Main">
      <ul>
        <li class="has-sub">
          <a href="<?= e(url('/services')) ?>"<?= $meta['nav'] === 'services' ? ' aria-current="page"' : '' ?>>Services</a>
          <div class="mega" id="mega"><div class="wrap"><div class="mega-in">
            <?php foreach (data('cats') as $c): ?>
            <div><a class="mh" href="<?= e(url('/services#cat-' . $c['k'])) ?>"><?= e($c['t']) ?></a><ul>
              <?php foreach (subs_of($c['k']) as $s): ?><li><a href="<?= e(url('/services/' . $s['slug'])) ?>"><?= e($s['t']) ?></a></li><?php endforeach; ?>
            </ul></div>
            <?php endforeach; ?>
          </div><div class="mfoot"><span>Not sure which service you need?</span><a href="<?= e(url('/services')) ?>">View all services <?= ic('arrow') ?></a></div></div></div>
        </li>
        <?php foreach ([['portfolio','Portfolio'],['how-it-works','How it works'],['pricing','Pricing'],['about','About'],['contact','Contact']] as $n): ?>
        <li><a href="<?= e(url('/' . $n[0])) ?>"<?= $meta['nav'] === $n[0] ? ' aria-current="page"' : '' ?>><?= e($n[1]) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <button type="button" class="btn btn-primary m-cta" data-quote>Get a free quote</button>
    </nav>
    <button type="button" class="btn btn-primary btn-sm head-btn" data-quote>Request a quote</button>
    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><svg class="ic" aria-hidden="true"><use href="#i-menu"/></svg></button>
  </div>
</header>
<main id="main" tabindex="-1">
