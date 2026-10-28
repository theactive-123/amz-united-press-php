<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'Ebook Cover & Book Portfolio by Genre | AMZ United Press',
    'description' => 'Browse books our ghostwriters, editors and cover designers helped bring to life, across fiction, nonfiction, memoir and more. See authors and reviews.',
    'path' => '/portfolio', 'nav' => 'portfolio',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Portfolio', null]])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active svx" data-page="portfolio">
<?= sv_page_hero('Portfolio', 'Covers and books across every <em>genre</em>.', 'Select any cover to see the author and review count.', 'fan') ?>
  <section class="x-shelf list-ch svx-shelf" aria-label="Book portfolio">
    <div class="list-track" id="list-track" data-works="home" role="region" aria-roledescription="carousel" aria-label="Book covers across all genres" tabindex="0"></div>
    <div class="x-w list-foot">
      <div class="arrows"><button type="button" id="list-prev" aria-label="Previous covers"><svg class="ic" aria-hidden="true" style="transform:scaleX(-1)"><use href="#i-arrow"/></svg></button><button type="button" id="list-next" aria-label="Next covers"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
    </div>
  </section>
<section class="svx-figs" aria-label="AMZ United Press in numbers"><div class="x-w"><div class="hm-stats" role="list"><?= render_stats() ?></div></div></section>
<?= sv_proof('clients') ?>
<?= sv_close_form('Your book next', 'Want to see your book <em>here</em>?', 'Tell us about it. Free advice, no obligation.', 'port', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'portfolio', 'Get started') ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
