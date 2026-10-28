<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'Ebook Pricing: Clear Written Quotes, No Surprises | AMZ United Press',
    'description' => 'Starting prices for ghostwriting, ebook writing, editing, cover design, Amazon publishing and book marketing, plus what affects your written quote.',
    'path' => '/pricing', 'nav' => 'pricing',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Pricing', null]]), faq_schema(data('faq')['Cost & timing'])],
];
include __DIR__ . '/includes/header.php';
$factors = [['Length', 'The number of words or pages in your book.'], ['Services', 'Which of writing, editing, design and publishing you need.'], ['Starting point', 'An idea, rough notes or a completed draft.'], ['Timeline', 'How soon you’d like your book to be published.']];
?>
<div class="page active svx" data-page="pricing">
<?= sv_page_hero('Pricing', 'Clear, written pricing. <em>No surprises.</em>', 'Every book is different, so we give you a written quote before any work begins. Here’s how we work out the price.', '', sv_actions('Pricing question', -1, 'Get my written quote')) ?>
<section class="svx-sec svx-factors" aria-labelledby="pr-f"><div class="x-w">
  <?= sv_kick('list', 'What affects your quote') ?><h2 class="x-h2 svx-h2 rv" id="pr-f">Four things shape the <em>price</em>.</h2>
  <ol class="svx-fourcol"><?php foreach ($factors as $i => $f): ?><li class="rv"><span class="svx-big-n">0<?= $i + 1 ?></span><h3><?= e($f[0]) ?></h3><p><?= e($f[1]) ?></p></li><?php endforeach; ?></ol>
</div></section>
<section class="x-rates svx-rates" aria-labelledby="pr-plans"><div class="x-w">
  <?= sv_kick('book', 'Ways to work with us') ?><h2 class="x-h2 svx-h2 rv" id="pr-plans">Choose the approach that fits your <em>book</em>.</h2>
  <p class="x-sub note-small">Starting prices shown. Your written quote is based on your book.</p>
  <div class="xp-grid is-page" id="price-page"><?= render_plans() ?></div>
</div></section>
<section class="svx-sec svx-pricelist" aria-labelledby="pr-cats"><div class="x-w">
  <?= sv_kick('list', 'Starting prices by service') ?><h2 class="x-h2 svx-h2 rv" id="pr-cats">What each service <em>costs</em>.</h2>
  <p class="x-sub">Starting prices for every AMZ United Press service. Your final price depends on your book, and you always get it in writing first.</p>
  <div class="svx-price-cols">
  <?php foreach (data('cats') as $c): ?>
    <div class="svx-price-col rv"><h3><?= e($c['t']) ?></h3><ul>
      <?php foreach (subs_of($c['k']) as $x): ?><li><a href="<?= e(url('/services/' . $x['slug'])) ?>"><span><?= e($x['name']) ?></span><b>From <?= e($x['price']) ?></b></a></li><?php endforeach; ?>
    </ul></div>
  <?php endforeach; ?>
  </div>
  <?= ph_note('Sample starting prices. Replace with your real prices before launch.') ?>
</div></section>
<section class="x-faq svx-faq" aria-labelledby="pr-faq"><div class="x-w x-faq-grid"><div class="x-faq-side">
  <?= sv_kick('q', 'Pricing questions') ?><h2 class="x-h2 rv" id="pr-faq">Before you <em>ask</em>…</h2>
  <p class="svx-faq-p">Most projects are paid in two or three stages, and we offer a full refund of any stage we have not started.</p></div>
  <div class="faq" data-faq="pricing"><?= faq_html(data('faq')['Cost & timing'], true) ?></div></div></section>
<?= sv_close_form('Request a quote', 'Request your free <em>quote</em>.', 'Tell us about your book and we’ll reply with next steps.', 'price', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'pricing', 'Request a quote') ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
