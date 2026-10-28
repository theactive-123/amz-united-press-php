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
require __DIR__ . '/includes/inner.php';
$meta['inner'] = true;
include __DIR__ . '/includes/header.php';
$k = $d['cat'];
$seed = crc32($d['slug']);
$pics = [
    'write'   => ['Fourparts/Crafting Stories at the Writing Desk.png', 'From first idea to finished book/Book Project Proposal Workspace.png'],
    'publish' => ['Fourparts/Self-Publishing Dashboard Workspace.png', 'From first idea to finished book/Author Workspace with KDP Publishing Dashboard.png'],
    'edit'    => ['Fourparts/Cozy Manuscript Editing Workspace.png', 'From first idea to finished book/Book Project Proposal Workspace.png'],
    'other'   => ['Fourparts/Cinematic Book Design Workspace.png', 'From first idea to finished book/Cozy InDesign Book Layout Workspace.png'],
][$k];
$img = fn($rel, $alt, $w = 900) => '<img src="' . e(url('/assets/img/' . implode('/', array_map('rawurlencode', explode('/', $rel))))) . '" alt="' . e($alt) . '" loading="lazy" decoding="async" width="' . $w . '" height="' . $w . '">';
$quote = 'Interested in: ' . $d['t'];
$flip = in_array($k, ['publish', 'other'], true);
?>
<div class="page active ix ix-cat-<?= e($k) ?>" data-page="service">
<div class="ix-progress" aria-hidden="true"><i></i></div>

<!-- 1. Hero: copy + multi-step form over layered publishing artwork -->
<section class="ix-hero" aria-labelledby="svh-h1">
  <span class="ix-hero-grid" aria-hidden="true"></span>
  <div class="ix-w ix-hero-in">
    <div class="ix-hero-copy">
      <p class="ix-crumbs"><a href="<?= e(url('/')) ?>">Home</a> <span aria-hidden="true">/</span> <a href="<?= e(url('/services#cat-' . $cat['k'])) ?>"><?= e($cat['t']) ?></a> <span aria-hidden="true">/</span> <?= e($d['t']) ?></p>
      <h1 id="svh-h1" class="ix-h1 ix-rise"><?= e($d['h1']) ?></h1>
      <p class="ix-hero-lead ix-rise" style="--d:120ms"><?= rich($d['lead']) ?></p>
      <div class="ix-rise" style="--d:220ms"><?= ix_ctas('Get a Quote', $quote, $help, true) ?></div>
      <div class="ix-chips ix-rise" style="--d:300ms"><span><?= ix_icon('coins') ?>From <?= e($d['price']) ?></span><span><?= ix_icon('clock') ?>Typical time <?= e($d['time']) ?></span><span><?= ix_icon('shield') ?>Written quote first</span></div>
      <div class="ix-rise" style="--d:380ms"><?= ix_journey() ?></div>
    </div>
    <div class="ix-hero-side">
      <?= ix_hero_art($k, $d['slug'], $seed) ?>
      <?= ix_form('svc', 'Sign Up Now!', 'Tell us about your project. A real person replies within one business day.', 'service', $help, 'Get My Free Quote') ?>
    </div>
  </div>
</section>

<!-- 2. Intro: editorial split with an image composition -->
<section class="ix-sec ix-intro<?= $flip ? ' flip' : '' ?>" aria-labelledby="sv-intro">
  <div class="ix-w ix-intro-in">
    <div class="ix-intro-art ix-rv" aria-hidden="true">
      <div class="ix-frame"><?= $img($pics[0], '') ?></div>
      <?= ix_book($seed + 2, 'ix-intro-book') ?>
      <span class="ix-badge-round"><b><?= e($d['price']) ?></b><small>starting price</small></span>
    </div>
    <div class="ix-intro-copy">
      <span class="ix-eyebrow ix-rv"><?= e($d['name']) ?></span>
      <h2 id="sv-intro" class="ix-h2 ix-rv"><?= e($d['intro']['h2']) ?></h2>
      <?php foreach ($d['intro']['p'] as $i => $p): ?><p class="ix-rv<?= $i === 0 ? ' ix-first' : '' ?>"><?= rich($p) ?></p><?php endforeach; ?>
      <ul class="ix-benefits ix-rv"><?php foreach ($d['intro']['list'] as $i => $x): ?><li style="--d:<?= $i * 70 ?>ms"><span><?= ix_icon('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul>
    </div>
  </div>
</section>

<?php if (!empty($d['types'])): $items = $d['types']['items']; ?>
<!-- 3. What we cover: bento grid with icons and a cursor spotlight -->
<section class="ix-sec ix-types" aria-labelledby="sv-types">
  <div class="ix-w">
    <div class="ix-types-top">
      <?= ix_head('What we cover', e($d['types']['h2']), $d['types']['p']) ?>
      <div class="ix-types-count ix-rv" aria-hidden="true"><b><?= count($items) ?></b><span><?= $k === 'write' || $k === 'publish' ? 'genres &amp; formats' : 'specialist services' ?></span></div>
    </div>
    <div class="ix-bento n<?= min(count($items), 17) ?>">
      <?php foreach ($items as $i => $x): ?>
      <article class="ix-tile ix-spot ix-rv<?= $i === 0 ? ' big' : '' ?>" style="--d:<?= ($i % 6) * 60 ?>ms">
        <span class="ix-tile-ic"><?= ix_icon(ix_icon_for($x[0], 'book')) ?></span>
        <span class="ix-tile-n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
        <h3><?= e($x[0]) ?></h3>
        <p><?= rich($x[1]) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 4. Process: sticky, scroll-driven timeline -->
<?php $steps = $d['process']['steps']; ?>
<section class="ix-sec ix-proc" aria-labelledby="sv-proc">
  <div class="ix-w ix-proc-in">
    <div class="ix-proc-side">
      <span class="ix-eyebrow">How it works</span>
      <h2 id="sv-proc" class="ix-h2"><?= e($d['process']['h2']) ?></h2>
      <p class="ix-lead"><?= rich($d['process']['p']) ?></p>
      <div class="ix-proc-now" aria-hidden="true">
        <svg viewBox="0 0 36 36" class="ix-ring"><circle cx="18" cy="18" r="15.9" pathLength="100"/><circle cx="18" cy="18" r="15.9" pathLength="100" data-proc-ring/></svg>
        <span class="ix-proc-num"><b data-proc-num>01</b><small>of <?= str_pad((string)count($steps), 2, '0', STR_PAD_LEFT) ?></small></span>
        <span class="ix-proc-title" data-proc-title><?= e($steps[0][0]) ?></span>
      </div>
      <button type="button" class="ix-btn ix-btn-primary" data-quote="<?= e($quote) ?>" data-help="<?= $help ?>">Start step one <?= ix_icon('arrow') ?></button>
    </div>
    <ol class="ix-proc-list">
      <?php foreach ($steps as $i => $x): ?>
      <li class="ix-pstep ix-rv" data-title="<?= e($x[0]) ?>">
        <span class="ix-pstep-ic"><?= ix_icon(ix_icon_for($x[0], 'check')) ?></span>
        <div><span class="ix-pstep-n">Step <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= e($x[0]) ?></h3><p><?= rich($x[1]) ?></p></div>
      </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- 5. Mid-page call to action: dark panel with fanned book covers -->
<section class="ix-sec-s" aria-label="Get started">
  <div class="ix-w">
    <div class="ix-cta-dark ix-rv">
      <div class="ix-cta-fan" aria-hidden="true"><?= ix_book($seed, 'c1') . ix_book($seed + 1, 'c2') . ix_book($seed + 2, 'c3') ?></div>
      <div class="ix-cta-copy"><h2 class="ix-h2"><?= e($d['cta1']) ?></h2><?= ix_ctas('Get a Quote', $quote, $help, true) ?></div>
    </div>
  </div>
</section>

<!-- 6. About: overlapping images with floating promise cards -->
<section class="ix-sec ix-about" aria-labelledby="sv-about">
  <div class="ix-w ix-about-in">
    <div class="ix-about-art ix-rv" aria-hidden="true">
      <div class="ix-frame a1"><?= $img($pics[1], '') ?></div>
      <div class="ix-frame a2"><?= $img($pics[0], '') ?></div>
      <span class="ix-float f1"><?= ix_icon('shield') ?><span><b>Signed NDA</b><small>From the first call</small></span></span>
      <span class="ix-float f2"><?= ix_icon('users') ?><span><b>One project manager</b><small>Start to finish</small></span></span>
    </div>
    <div class="ix-about-copy">
      <span class="ix-eyebrow ix-rv">About us</span>
      <h2 id="sv-about" class="ix-h2 ix-rv"><?= e($d['about']['h3']) ?></h2>
      <?php foreach ($d['about']['p'] as $i => $p): ?><p class="ix-rv<?= $i === 0 ? ' ix-pull' : '' ?>"><?= rich($p) ?></p><?php endforeach; ?>
      <ul class="ix-promise-row ix-rv"><li><?= ix_icon('lock') ?>100% rights &amp; royalties</li><li><?= ix_icon('coins') ?>Written quote first</li><li><?= ix_icon('clock') ?>Reply in 1 business day</li></ul>
    </div>
  </div>
</section>

<!-- 7. Why choose us: bento feature cards -->
<?php $why = $d['why']['items']; ?>
<section class="ix-sec ix-why" aria-labelledby="sv-why">
  <div class="ix-w">
    <?= ix_head('Why choose us', e($d['why']['h3']), $d['why']['p'], 'h2', 'c') ?>
    <div class="ix-whygrid n<?= count($why) ?>">
      <?php foreach ($why as $i => $x): ?>
      <article class="ix-why-card ix-spot ix-rv<?= $i === 0 ? ' lead' : '' ?>" style="--d:<?= $i * 80 ?>ms">
        <span class="ix-why-ic"><?= ix_icon(ix_icon_for($x[0], 'star')) ?></span>
        <span class="ix-why-n" aria-hidden="true"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
        <h3><?= e($x[0]) ?></h3>
        <p><?= rich($x[1]) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 8. Milestones -->
<section class="ix-milestones" aria-label="AMZ United Press in numbers">
  <span class="ix-mile-bg" aria-hidden="true"><?= ix_book($seed + 3, 'm1') . ix_book($seed + 5, 'm2') ?></span>
  <div class="ix-w"><?= ix_stats() ?></div>
</section>

<?php if (!empty($d['compare'])): $cmp = $d['compare']; ?>
<!-- 9. Old way vs our way -->
<section class="ix-sec ix-vs" aria-labelledby="sv-cmp">
  <div class="ix-w">
    <?= ix_head('Compare your options', e($cmp['h3']), $cmp['p']) ?>
    <div class="ix-vs-grid">
      <div class="ix-vs-old ix-rv"><h3>The usual way</h3>
        <?php foreach ($cmp['old'] as $o): ?>
        <div class="ix-vs-card"><h4><?= e($o[0]) ?></h4><dl><?php foreach ($cmp['rows'] as $ri => $r): ?><div><dt><?= e($r) ?></dt><dd><?= e($o[1][$ri] ?? '') ?></dd></div><?php endforeach; ?></dl></div>
        <?php endforeach; ?>
      </div>
      <span class="ix-vs-mid" aria-hidden="true">VS</span>
      <div class="ix-vs-ours ix-rv" style="--d:120ms"><h3>Our way</h3>
        <div class="ix-vs-card"><h4><?= e($cmp['ours'][0]) ?></h4><dl><?php foreach ($cmp['rows'] as $ri => $r): ?><div><dt><?= e($r) ?></dt><dd><?= ix_icon('check') ?><?= e($cmp['ours'][1][$ri] ?? '') ?></dd></div><?php endforeach; ?></dl>
          <button type="button" class="ix-btn ix-btn-primary" data-quote="<?= e($quote) ?>" data-help="<?= $help ?>">Get a Quote <?= ix_icon('arrow') ?></button></div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 10. FAQs -->
<section class="ix-sec ix-faqs" aria-labelledby="sv-faq">
  <div class="ix-w ix-faqs-in">
    <aside class="ix-faq-side">
      <span class="ix-eyebrow">FAQs</span>
      <h2 id="sv-faq" class="ix-h2">Frequently Asked Questions</h2>
      <p>Straight answers about our <?= e(strtolower($d['name'])) ?>. Can’t see your question? <a href="<?= e(url('/contact')) ?>">Ask us directly</a>.</p>
      <div class="ix-faq-cta">
        <span class="ix-faq-cta-ic" aria-hidden="true"><?= ix_icon('chat') ?></span>
        <h3><?= e($d['faq_cta']) ?></h3>
        <button type="button" class="ix-btn ix-btn-primary" data-quote="<?= e($quote) ?>" data-help="<?= $help ?>">Get a Quote <?= ix_icon('arrow') ?></button>
        <a class="ix-faq-tel" href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><?= ix_icon('phone') ?><?= e(site('phone')) ?></a>
      </div>
    </aside>
    <?= ix_faq_list($d['faq']) ?>
  </div>
</section>

<?php if ($beyond): ?>
<!-- 11. Other services -->
<section class="ix-sec ix-more" aria-labelledby="sv-more">
  <div class="ix-w">
    <?= ix_head('Keep going', e($d['beyond']['h2'])) ?>
    <div class="ix-more-grid">
      <?php foreach ($beyond as $i => $x): ?>
      <a class="ix-more-card ix-spot ix-rv" style="--d:<?= $i * 60 ?>ms" href="<?= e(url('/services/' . $x['slug'])) ?>">
        <span class="ix-more-ic"><?= ix_icon(ix_service_icon($x['slug'])) ?></span>
        <small><?= e(cat_by_key($x['cat'])['t']) ?></small>
        <h3><?= e($x['name']) ?></h3>
        <p><?= e(plain($x['short'])) ?></p>
        <span class="ix-more-go">Learn more <?= ix_icon('arrow') ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 12. Closing call to action: orange panel with a book stack -->
<section class="ix-sec-s ix-end" aria-labelledby="sv-end">
  <div class="ix-w">
    <div class="ix-cta-orange ix-rv">
      <span class="ix-cta-rings" aria-hidden="true"></span>
      <div class="ix-cta-copy"><h2 id="sv-end" class="ix-h2"><?= e($d['cta2']['h3']) ?></h2><p><?= rich($d['cta2']['p']) ?></p><?= ix_ctas('Get a Quote', $quote, $help) ?></div>
      <div class="ix-cta-stack" aria-hidden="true"><?= ix_kindle($seed + 4, 'k') . ix_book($seed + 6, 's1') ?></div>
    </div>
  </div>
</section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
