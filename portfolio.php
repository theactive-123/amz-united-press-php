<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'Ebook Cover & Book Portfolio by Genre | AMZ United Press',
    'description' => 'Browse books our ghostwriters, editors and cover designers helped bring to life, across fiction, nonfiction, memoir and more. See authors and reviews.',
    'path' => '/portfolio', 'nav' => 'portfolio',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Portfolio', null]])],
];
include __DIR__ . '/includes/header.php';
$side = '<div class="ix-ph-art ix-art-shelf" aria-hidden="true"><span class="ix-glow"></span><div class="ix-fan">'
      . ix_book(0, 'f0') . ix_book(1, 'f1b') . ix_book(2, 'f2b') . ix_book(3, 'f3b') . ix_book(4, 'f4b') . '</div>'
      . ix_float('layers', count(data('stats')) ? data('stats')[2][0] . ' genres' : 'Every genre', 'Fiction to memoir', 'f1') . ix_float('star', 'Real covers', 'From real authors', 'f2') . '</div>';
?>
<div class="page active ix" data-page="portfolio">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['Portfolio'], 'Covers and books across every <span class="mk">genre</span>.', 'Select any cover to see the author and review count.', $side, ix_ctas('Start your book', '', -1, true)) ?>

  <section class="ix-sec ix-shelf" aria-label="Book portfolio">
    <div class="ix-w"><div class="ix-shelf-head ix-rv" aria-hidden="true"><span class="ix-eyebrow">The shelf</span><span class="ix-shelf-hint"><?= ix_icon('arrow') ?>Drag, scroll or use the arrows</span></div></div>
    <div class="x-shelf list-ch">
    <div class="list-track" id="list-track" data-works="home" role="region" aria-roledescription="carousel" aria-label="Book covers across all genres" tabindex="0"></div>
    <div class="x-w list-foot">
      <div class="arrows"><button type="button" id="list-prev" aria-label="Previous covers"><svg class="ic" aria-hidden="true" style="transform:scaleX(-1)"><use href="#i-arrow"/></svg></button><button type="button" id="list-next" aria-label="Next covers"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
    </div>
    </div>
  </section>

<section class="ix-milestones" aria-label="AMZ United Press in numbers">
  <span class="ix-mile-bg" aria-hidden="true"><?= ix_book(6, 'm1') . ix_book(8, 'm2') ?></span>
  <div class="ix-w"><?= ix_stats() ?></div>
</section>

<?= ix_band('Want to see your book here?', 'Tell us about it. Free advice, no obligation.', 'Get started', '/contact', '', '', 6) ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
