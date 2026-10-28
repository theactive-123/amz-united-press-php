<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Ebook Pricing: Clear Written Quotes, No Surprises | AMZ United Press',
    'description' => 'Starting prices for ghostwriting, ebook writing, editing, cover design, Amazon publishing and book marketing, plus what affects your written quote.',
    'path' => '/pricing', 'nav' => 'pricing',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Pricing', null]]), faq_schema(data('faq')['Cost & timing'])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="pricing">
<?= page_hero(['Pricing'], 'Clear, written pricing. <span class="mk">No surprises.</span>', 'Every book is different, so we give you a written quote before any work begins. Here’s how we work out the price.', 'pricing') ?>
<section class="section"><div class="wrap">
  <div class="sec-head rv"><span class="eyebrow">What affects your quote</span><h2>Four things shape the price.</h2></div>
  <div class="grid-4 rv">
    <div class="factor"><h3>Length</h3><p>The number of words or pages in your book.</p></div>
    <div class="factor"><h3>Services</h3><p>Which of writing, editing, design and publishing you need.</p></div>
    <div class="factor"><h3>Starting point</h3><p>An idea, rough notes or a completed draft.</p></div>
    <div class="factor"><h3>Timeline</h3><p>How soon you’d like your book to be published.</p></div>
  </div></div></section>
<section class="section bg-white"><div class="wrap">
  <div class="sec-head center rv"><span class="eyebrow">Ways to work with us</span><h2>Choose the approach that fits your book.</h2><p class="note-small">Starting prices shown. Your written quote is based on your book.</p></div>
  <div class="xp-grid is-page rv" id="price-page"><?= render_plans() ?></div>
</div></section>
<section class="section"><div class="wrap">
  <div class="sec-head rv"><span class="eyebrow">Starting prices by service</span><h2>What each service costs.</h2><p class="lead" style="margin:0">Starting prices for every AMZ United Press service. Your final price depends on your book, and you always get it in writing first.</p></div>
  <div class="pr-cats">
  <?php foreach (data('cats') as $c): ?>
    <div class="pr-cat"><h3><?= e($c['t']) ?></h3><ul>
      <?php foreach (subs_of($c['k']) as $x): ?><li><a href="<?= e(url('/services/' . $x['slug'])) ?>"><span><?= e($x['name']) ?></span><b>From <?= e($x['price']) ?></b></a></li><?php endforeach; ?>
    </ul></div>
  <?php endforeach; ?>
  </div>
  <?= ph_note('Sample starting prices. Replace with your real prices before launch.') ?>
</div></section>
<section class="section"><div class="wrap split top">
  <div class="rv"><span class="eyebrow">Pricing questions</span><h2>Before you ask…</h2><p class="lead">Most projects are paid in two or three stages, and we offer a full refund of any stage we have not started.</p></div>
  <div class="faq rv" data-faq="pricing"><?= faq_html(data('faq')['Cost & timing'], true) ?></div>
</div></section>
<?= cta_band('Request your free quote.', 'Tell us about your book and we’ll reply with next steps.', 'Request a quote') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
