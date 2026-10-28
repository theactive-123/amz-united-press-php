<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Ebook Cover & Book Portfolio by Genre | AMZ United Press',
    'description' => 'Browse books our ghostwriters, editors and cover designers helped bring to life, across fiction, nonfiction, memoir and more. See authors and reviews.',
    'path' => '/portfolio', 'nav' => 'portfolio',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Portfolio', null]])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="portfolio">
<?= page_hero(['Portfolio'], 'Covers and books across every <span class="mk">genre</span>.', 'Select any cover to see the author and review count.', 'portfolio') ?>
  <section class="x-shelf list-ch" aria-label="Book portfolio">

    <div class="list-track" id="list-track" data-works="home" role="region" aria-roledescription="carousel" aria-label="Book covers across all genres" tabindex="0"></div>
    <div class="x-w list-foot">
      <div class="arrows"><button type="button" id="list-prev" aria-label="Previous covers"><svg class="ic" aria-hidden="true" style="transform:scaleX(-1)"><use href="#i-arrow"/></svg></button><button type="button" id="list-next" aria-label="Next covers"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
    </div>
  </section>



<?= cta_band('Want to see your book here?', 'Tell us about it. Free advice, no obligation.', 'Get started') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
