<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Ebook Publishing FAQ: Cost, Rights, Timing | AMZ United Press',
    'description' => 'Straight answers to the questions authors ask most: how much ebook publishing costs, who owns the rights, how long it takes and where your book is sold.',
    'path' => '/faq', 'nav' => 'faq',
    'schema' => [breadcrumb_schema([['Home', '/'], ['FAQ', null]]), faq_schema(array_merge(...array_values(data('faq'))))],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="faq">
<?= page_hero(['FAQ'], 'Your questions, answered <span class="mk">plainly</span>.', 'Straight answers to the questions authors ask us most.', 'faq') ?>
<section class="section"><div class="wrap" id="faq-groups" style="max-width:900px">
<?php foreach (data('faq') as $g => $items): ?>
  <h2 style="font-size:1.9rem;margin:1.6em 0 .6em"><?= e($g) ?></h2><div class="faq"><?= faq_html($items) ?></div>
<?php endforeach; ?>
</div></section>
<?= cta_band('Still have a question?', 'Ask us. A real person will answer.', 'Ask a question') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
