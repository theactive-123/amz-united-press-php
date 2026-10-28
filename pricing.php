<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'Ebook Pricing: Clear Written Quotes, No Surprises | AMZ United Press',
    'description' => 'Starting prices for ghostwriting, ebook writing, editing, cover design, Amazon publishing and book marketing, plus what affects your written quote.',
    'path' => '/pricing', 'nav' => 'pricing',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Pricing', null]]), faq_schema(data('faq')['Cost & timing'])],
];
include __DIR__ . '/includes/header.php';
$o = site('offer');
$side = '<div class="ix-ph-art ix-art-quote" aria-hidden="true"><span class="ix-glow"></span>'
      . '<div class="ix-quote-card"><span class="ix-quote-top"><b>Written quote</b><small>Prepared for your book</small></span>'
      . '<span class="ix-quote-row"><i>Scope</i><span class="ix-lines"><i></i></span></span><span class="ix-quote-row"><i>Timeline</i><span class="ix-lines"><i></i></span></span>'
      . '<span class="ix-quote-row"><i>Price</i><span class="ix-lines"><i></i></span></span><span class="ix-quote-row"><i>Stages</i><span class="ix-lines"><i></i></span></span>'
      . '<span class="ix-quote-ok">' . ix_icon('check') . 'Approved by you before work starts</span></div>'
      . (!empty($o['on']) ? '<span class="ix-offer ix-offer-float">' . e($o['big']) . '<small>' . e($o['note'] ?? '') . '</small></span>' : '')
      . ix_book(2, 'b1') . ix_float('shield', 'No hidden fees', 'Every cost in writing', 'f1') . '</div>';
$factors = [['Length', 'The number of words or pages in your book.', 'scroll'], ['Services', 'Which of writing, editing, design and publishing you need.', 'layers'], ['Starting point', 'An idea, rough notes or a completed draft.', 'compass'], ['Timeline', 'How soon you’d like your book to be published.', 'calendar']];
?>
<div class="page active ix" data-page="pricing">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['Pricing'], 'Clear, written pricing. <span class="mk">No surprises.</span>', 'Every book is different, so we give you a written quote before any work begins. Here’s how we work out the price.', $side, ix_ctas('Get my written quote', '', -1, true)) ?>

<section class="ix-sec ix-factors" aria-labelledby="pr-f">
  <div class="ix-w">
    <div class="ix-types-top"><?= ix_head('What affects your quote', '<span id="pr-f">Four things shape the price.</span>') ?>
      <div class="ix-types-count ix-rv" aria-hidden="true"><b>4</b><span>price factors</span></div></div>
    <div class="ix-factor-grid">
      <?php foreach ($factors as $i => $f): ?>
      <div class="ix-factor ix-spot ix-rv" style="--d:<?= $i * 80 ?>ms"><span class="ix-factor-n" aria-hidden="true">0<?= $i + 1 ?></span><span class="ix-why-ic"><?= ix_icon($f[2]) ?></span><h3><?= e($f[0]) ?></h3><p><?= e($f[1]) ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="ix-sec ix-plans" aria-labelledby="pr-plans">
  <div class="ix-w">
    <div class="ix-head ix-rv c"><span class="ix-eyebrow">Ways to work with us</span><h2 id="pr-plans" class="ix-h2">Choose the approach that fits your book.</h2><p class="note-small ix-lead">Starting prices shown. Your written quote is based on your book.</p></div>
    <div class="xp-grid is-page" id="price-page"><?= render_plans() ?></div>
  </div>
</section>

<section class="ix-sec ix-prices" aria-labelledby="pr-cats">
  <div class="ix-w">
    <div class="ix-head ix-rv"><span class="ix-eyebrow">Starting prices by service</span><h2 id="pr-cats" class="ix-h2">What each service costs.</h2><p class="ix-lead">Starting prices for every AMZ United Press service. Your final price depends on your book, and you always get it in writing first.</p></div>
    <div class="ix-price-grid">
    <?php $ci = ['write' => 'pen', 'publish' => 'rocket', 'edit' => 'fileedit', 'other' => 'sparkles']; foreach (data('cats') as $i => $c): ?>
      <div class="ix-price-cat ix-rv<?= $i === 0 ? ' big' : '' ?>" style="--d:<?= $i * 80 ?>ms"><div class="ix-price-h"><span class="ix-why-ic"><?= ix_icon($ci[$c['k']]) ?></span><h3><?= e($c['t']) ?></h3></div><ul>
        <?php foreach (subs_of($c['k']) as $x): ?><li><a href="<?= e(url('/services/' . $x['slug'])) ?>"><span><?= e($x['name']) ?></span><b>From <?= e($x['price']) ?></b></a></li><?php endforeach; ?>
      </ul></div>
    <?php endforeach; ?>
    </div>
    <?= ph_note('Sample starting prices. Replace with your real prices before launch.') ?>
  </div>
</section>

<section class="ix-sec ix-faqs" aria-labelledby="pr-faq">
  <div class="ix-w ix-faqs-in">
    <aside class="ix-faq-side">
      <span class="ix-eyebrow">Pricing questions</span>
      <h2 id="pr-faq" class="ix-h2">Before you ask…</h2>
      <p>Most projects are paid in two or three stages, and we offer a full refund of any stage we have not started.</p>
      <div class="ix-faq-cta" aria-hidden="true"><span class="ix-faq-cta-ic"><?= ix_icon('coins') ?></span><b class="ix-faq-cta-t">Pay in stages</b><div class="ix-stages"><span>Stage 1</span><span>Stage 2</span><span>Stage 3</span></div></div>
    </aside>
    <div class="faq ix-faq" data-ix-faq data-faq="pricing"><?= faq_html(data('faq')['Cost & timing'], true) ?></div>
  </div>
</section>

<?= ix_band('Request your free quote.', 'Tell us about your book and we’ll reply with next steps.', 'Request a quote', '/contact', '', '', 3) ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
