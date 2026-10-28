<?php
require __DIR__ . '/includes/bootstrap.php';
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? ''));
$d = sub_by_slug($slug);
if (!$d) { http_response_code(404); include __DIR__ . '/404.php'; exit; }
$cat    = cat_by_key($d['cat']);
$help   = help_for($d);
$beyond = array_values(array_filter(array_map('sub_by_slug', $d['beyond']['slugs'] ?? [])));
$tel    = preg_replace('/[^\d+]/', '', site('phone'));
$meta = [
    'title' => $d['title'],
    'description' => $d['desc'],
    'path' => '/services/' . $d['slug'], 'nav' => 'services', 'cat' => $d['cat'],
    'schema' => [
        breadcrumb_schema([['Home', '/'], ['Services', '/services'], [$cat['t'], '/services#cat-' . $cat['k']], [$d['name'], null]]),
        ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $d['name'], 'description' => plain($d['short']), 'serviceType' => $d['name'],
         'url' => abs_url('/services/' . $d['slug']), 'areaServed' => 'Worldwide',
         'provider' => ['@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'telephone' => site('phone'), 'email' => site('email')],
         'offers' => ['@type' => 'Offer', 'priceCurrency' => 'USD', 'price' => preg_replace('/[^\d.]/', '', $d['price']), 'description' => 'Starting price. Written quote before work begins.']],
        faq_schema($d['faq']),
    ],
];
include __DIR__ . '/includes/header.php';
$ctaBtns = '<div class="sv-btns"><button type="button" class="btn btn-primary" data-quote="Interested in: ' . e($d['t']) . '" data-help="' . $help . '">Get a Quote</button>'
         . '<button type="button" class="btn btn-outline" data-chat>Live Chat</button>'
         . '<a class="sv-tel" href="tel:' . e($tel) . '">' . ic('phone') . e(site('phone')) . '</a></div>';
?>
<div class="page active" data-page="service">

<!-- 1. Hero + sign-up form -->
<section class="svh" aria-labelledby="svh-h1">
  <div class="wrap svh-grid">
    <div class="svh-copy">
      <p class="crumbs"><a href="<?= e(url('/')) ?>">Home</a> / <a href="<?= e(url('/services#cat-' . $cat['k'])) ?>"><?= e($cat['t']) ?></a> / <?= e($d['t']) ?></p>
      <h1 id="svh-h1"><?= e($d['h1']) ?></h1>
      <p class="lead"><?= rich($d['lead']) ?></p>
      <?= $ctaBtns ?>
      <div class="chips"><span class="chip">From <?= e($d['price']) ?></span><span class="chip">Typical time <?= e($d['time']) ?></span><span class="chip">Written quote first</span></div>
    </div>
    <div class="svh-form"><?= render_form('svc', 'Sign Up Now!', 'Tell us about your project. A real person replies within one business day.', 'service', 'Get My Free Quote', $help) ?></div>
  </div>
</section>

<!-- 2. Intro -->
<section class="sv-sec" aria-labelledby="sv-intro">
  <div class="wrap sv-intro">
    <div>
      <span class="eyebrow"><?= e($d['name']) ?></span>
      <h2 id="sv-intro"><?= e($d['intro']['h2']) ?></h2>
    </div>
    <div>
      <?php foreach ($d['intro']['p'] as $p): ?><p><?= rich($p) ?></p><?php endforeach; ?>
      <ul class="checks"><?php foreach ($d['intro']['list'] as $x): ?><li><span class="tick"><?= ic('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul>
    </div>
  </div>
</section>

<?php if (!empty($d['types'])): ?>
<!-- 3. Genres / features -->
<section class="sv-sec sv-alt" aria-labelledby="sv-types">
  <div class="wrap">
    <div class="sv-head"><h2 id="sv-types"><?= e($d['types']['h2']) ?></h2><p><?= rich($d['types']['p']) ?></p></div>
    <div class="sv-cards">
      <?php foreach ($d['types']['items'] as $i => $x): ?>
      <article class="sv-card"><span class="sv-n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= e($x[0]) ?></h3><p><?= rich($x[1]) ?></p></article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 4. Process -->
<section class="sv-sec" aria-labelledby="sv-proc">
  <div class="wrap">
    <div class="sv-head"><h2 id="sv-proc"><?= e($d['process']['h2']) ?></h2><p><?= rich($d['process']['p']) ?></p></div>
    <ol class="sv-steps">
      <?php foreach ($d['process']['steps'] as $i => $x): ?>
      <li><span class="sv-step-n">Step <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= e($x[0]) ?></h3><p><?= rich($x[1]) ?></p></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- 5. Mid-page call to action -->
<section class="sv-band" aria-label="Get started">
  <div class="wrap sv-band-in"><h2><?= e($d['cta1']) ?></h2><?= $ctaBtns ?></div>
</section>

<!-- 6. About + why choose us -->
<section class="sv-sec" aria-labelledby="sv-about">
  <div class="wrap">
    <div class="sv-about">
      <div><span class="eyebrow">About us</span><h2 id="sv-about"><?= e($d['about']['h3']) ?></h2></div>
      <div><?php foreach ($d['about']['p'] as $p): ?><p><?= rich($p) ?></p><?php endforeach; ?></div>
    </div>
    <div class="sv-why">
      <div class="sv-head"><h2><?= e($d['why']['h3']) ?></h2><p><?= rich($d['why']['p']) ?></p></div>
      <div class="sv-why-grid">
        <?php foreach ($d['why']['items'] as $x): ?><article class="sv-why-card"><span class="tick"><?= ic('check') ?></span><h3><?= e($x[0]) ?></h3><p><?= rich($x[1]) ?></p></article><?php endforeach; ?>
      </div>
      <div class="sv-stats" role="list"><?= render_stats() ?></div>
    </div>
  </div>
</section>

<?php if (!empty($d['compare'])): $cmp = $d['compare']; ?>
<!-- 7. Old way vs our way -->
<section class="sv-sec sv-alt" aria-labelledby="sv-cmp">
  <div class="wrap">
    <div class="sv-head"><h2 id="sv-cmp"><?= e($cmp['h3']) ?></h2><p><?= rich($cmp['p']) ?></p></div>
    <div class="sv-cmp">
      <div class="sv-cmp-old"><h3>The usual way</h3>
        <?php foreach ($cmp['old'] as $o): ?>
        <div class="sv-cmp-col"><h4><?= e($o[0]) ?></h4><dl><?php foreach ($cmp['rows'] as $k => $r): ?><div><dt><?= e($r) ?></dt><dd><?= e($o[1][$k] ?? '') ?></dd></div><?php endforeach; ?></dl></div>
        <?php endforeach; ?>
      </div>
      <span class="sv-vs" aria-hidden="true">VS</span>
      <div class="sv-cmp-ours"><h3>Our way</h3>
        <div class="sv-cmp-col"><h4><?= e($cmp['ours'][0]) ?></h4><dl><?php foreach ($cmp['rows'] as $k => $r): ?><div><dt><?= e($r) ?></dt><dd><?= e($cmp['ours'][1][$k] ?? '') ?></dd></div><?php endforeach; ?></dl></div>
        <button type="button" class="btn btn-primary" data-quote="Interested in: <?= e($d['t']) ?>" data-help="<?= $help ?>">Get a Quote</button>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 8. FAQs -->
<section class="sv-sec" aria-labelledby="sv-faq">
  <div class="wrap sv-faq">
    <div><span class="eyebrow">FAQs</span><h2 id="sv-faq">Frequently Asked Questions</h2><p>Straight answers about our <?= e(strtolower($d['name'])) ?>. Can’t see your question? <a href="<?= e(url('/contact')) ?>">Ask us directly</a>.</p>
      <div class="sv-faq-cta"><h3><?= e($d['faq_cta']) ?></h3><button type="button" class="btn btn-primary" data-quote="Interested in: <?= e($d['t']) ?>" data-help="<?= $help ?>">Get a Quote</button></div></div>
    <div class="faq"><?= faq_html($d['faq'], true) ?></div>
  </div>
</section>

<!-- 9. Other services -->
<?php if ($beyond): ?>
<section class="sv-sec sv-alt" aria-labelledby="sv-more">
  <div class="wrap">
    <div class="sv-head"><h2 id="sv-more"><?= e($d['beyond']['h2']) ?></h2></div>
    <div class="sv-more">
      <?php foreach ($beyond as $x): ?><a class="sv-more-card" href="<?= e(url('/services/' . $x['slug'])) ?>"><small><?= e(cat_by_key($x['cat'])['t']) ?></small><h3><?= e($x['name']) ?></h3><p><?= e(plain($x['short'])) ?></p><span class="x-link">Learn more <?= ic('arrow') ?></span></a><?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 10. Closing call to action -->
<section class="sv-band sv-band-end" aria-labelledby="sv-end">
  <div class="wrap sv-band-in"><div><h2 id="sv-end"><?= e($d['cta2']['h3']) ?></h2><p><?= rich($d['cta2']['p']) ?></p></div><?= $ctaBtns ?></div>
</section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
