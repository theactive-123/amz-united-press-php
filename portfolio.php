<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Ebook Cover & Book Portfolio by Genre | AMZ United Press',
    'description' => 'Browse sample ebook covers across romance, horror, cookbooks, children’s books, health, history and more. Concept designs showing our range of styles.',
    'path' => '/portfolio', 'nav' => 'portfolio',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Portfolio', null]])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="portfolio">
<?= page_hero(['Portfolio'], 'Covers and books across every <span class="mk">genre</span>.', 'Browse by genre and select any cover to see how we work.', 'portfolio') ?>
<section class="section"><div class="wrap">
  <div class="tabs" role="tablist" aria-label="Browse portfolio by genre" data-tabs="full"></div>
  <div class="works" data-works="full" role="tabpanel" aria-live="polite"></div>
  <noscript><p class="note-small">Turn on JavaScript to browse the cover gallery.</p></noscript>
  <p class="note-small" style="margin-top:52px">Sample covers designed to show our range of styles.</p>
</div></section>
<?= cta_band('Want to see your book here?', 'Tell us about it. Free advice, no obligation.', 'Get started') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
