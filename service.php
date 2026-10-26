<?php
require __DIR__ . '/includes/bootstrap.php';
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? ''));
$d = sub_by_slug($slug);
if (!$d) { http_response_code(404); include __DIR__ . '/404.php'; exit; }
$cat  = cat_by_key($d['cat']);
$same = subs_of($d['cat']);
$rel  = array_values(array_filter(array_map('sub_by_slug', $d['rel'])));
$meta = [
    'title' => $d['t'] . ' for Ebooks | AMZ United Press',
    'description' => $d['short'] . ' From ' . $d['price'] . '. Written quote first.',
    'path' => '/services/' . $d['slug'], 'nav' => 'services',
    'schema' => [
        breadcrumb_schema([['Home', '/'], ['Services', '/services'], [$d['t'], null]]),
        ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $d['t'], 'description' => $d['short'], 'serviceType' => $cat['t'],
         'provider' => ['@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/')], 'areaServed' => 'Worldwide'],
        faq_schema($d['faq']),
    ],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="service">
<?php
$chips = '<div class="chips" style="margin-top:26px"><span class="chip">From ' . e($d['price']) . '</span><span class="chip">Typical time ' . e($d['time']) . '</span><span class="chip">Written quote first</span></div>';
$cp = photos()['cat'][$d['cat']];
$p = photos()['hero']['services'];
?>
<section class="page-hero"><div class="wrap ph-grid"><div>
  <p class="crumbs"><a href="<?= e(url('/')) ?>">Home</a> / <a href="<?= e(url('/services')) ?>">Services</a> / <a href="<?= e(url('/services#cat-' . $cat['k'])) ?>"><?= e($cat['t']) ?></a> / <?= e($d['t']) ?></p>
  <h1><?= e($d['t']) ?></h1><p class="lead"><?= e($d['short']) ?></p><?= $chips ?></div>
  <div class="ph-art" aria-hidden="true"><?= photo($cp[0], 1800, '', 'aph', true) ?></div></div></section>
<section class="section"><div class="wrap sv-grid"><div class="sv-main">
  <h2>Overview</h2><p class="lead"><?= e($d['intro']) ?></p><p><?= e($d['intro2']) ?></p>
  <h2>What’s included</h2>
  <div class="inc-grid">
  <?php foreach ([array_slice($d['inc'], 0, 3), array_slice($d['inc'], 3)] as $col): ?>
    <ul class="checks"><?php foreach ($col as $x): ?><li><span class="tick"><?= ic('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul>
  <?php endforeach; ?>
  </div>
  <h2>How it works</h2>
  <ol class="vsteps"><?php foreach ($d['steps'] as $x): ?><li><div><h3><?= e($x[0]) ?></h3><p><?= e($x[1]) ?></p></div></li><?php endforeach; ?></ol>
  <h2>What you receive</h2>
  <div class="recv"><ul class="checks"><?php foreach ($d['get'] as $x): ?><li><span class="tick"><?= ic('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul></div>
  <h2>Who it’s for</h2>
  <div class="grid-3" style="gap:20px"><?php foreach ($d['who'] as $x): ?><div class="factor"><h3><?= e($x[0]) ?></h3><p><?= e($x[1]) ?></p></div><?php endforeach; ?></div>
  <h2>Common questions</h2>
  <div class="faq"><?= faq_html($d['faq'], true) ?></div>
</div>
<aside class="sv-side" aria-label="Pricing and timing">
  <div class="side-card"><span class="eyebrow">Starting from</span><div class="big"><?= e($d['price']) ?></div>
    <p class="note-small" style="margin:0">Your final price depends on your book’s length and needs. You’ll always get a written quote first.</p>
    <dl><div><dt>Typical time</dt><dd><?= e($d['time']) ?></dd></div><div><dt>Quote</dt><dd>In writing, free</dd></div><div><dt>Reply</dt><dd>Within 1 business day</dd></div></dl>
    <button type="button" class="btn btn-primary" data-quote="Interested in: <?= e($d['t']) ?>" data-help="<?= (int)$cat['help'] ?>">Get a free quote</button>
    <a class="call" href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><?= ic('phone') ?><span><?= e(site('phone')) ?></span></a></div>
  <div class="side-links"><h4>More in <?= e($cat['t']) ?></h4>
    <?php foreach ($same as $x): ?><a href="<?= e(url('/services/' . $x['slug'])) ?>"<?= $x['slug'] === $d['slug'] ? ' aria-current="page"' : '' ?>><?= e($x['t']) ?><?= ic('arrow') ?></a><?php endforeach; ?>
    <a href="<?= e(url('/services')) ?>" style="font-weight:800">All services<?= ic('arrow') ?></a></div>
</aside></div></section>
<section class="section bg-white"><div class="wrap"><div class="sec-head"><span class="eyebrow">Often paired with</span><h2>Related services</h2></div>
  <div class="grid-3"><?php foreach ($rel as $x): $rp = photos()['cat'][$x['cat']]; ?>
    <a class="post" href="<?= e(url('/services/' . $x['slug'])) ?>"><div class="thumb"><?= photo($rp[0], 900, $rp[1], 'aph') ?></div><div class="body"><small><?= e(cat_by_key($x['cat'])['t']) ?></small><h3><?= e($x['t']) ?></h3><p><?= e($x['short']) ?></p></div></a>
  <?php endforeach; ?></div></div></section>
<section class="final-cta section" id="svc-quote"><div class="wrap cta-grid" style="align-items:start"><div>
  <span class="eyebrow">Free quote</span><h2 style="font-size:clamp(2.2rem,4.6vw,3.6rem)">Get a quote for <?= e(strtolower($d['t'])) ?>.</h2>
  <p class="lead">Tell us a little about your book. We’ll reply personally with the next steps and a clear price.</p>
  <ul class="checks" style="margin-top:24px"><li><span class="tick"><?= ic('check') ?></span>Free, with no obligation</li><li><span class="tick"><?= ic('check') ?></span>Written quote before any work starts</li><li><span class="tick"><?= ic('check') ?></span>A real person replies within one business day</li></ul></div>
  <div class="postcard"><?= render_form('svc', 'Get a quote for ' . $d['t'], 'Takes about a minute. We reply within one business day.', 'service', 'Send my request', (int)$cat['help']) ?></div></div></section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
