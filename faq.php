<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'Ebook Publishing FAQ: Cost, Rights, Timing | AMZ United Press',
    'description' => 'Straight answers to the questions authors ask most: how much ebook publishing costs, who owns the rights, how long it takes and where your book is sold.',
    'path' => '/faq', 'nav' => 'faq',
    'schema' => [breadcrumb_schema([['Home', '/'], ['FAQ', null]]), faq_schema(array_merge(...array_values(data('faq'))))],
];
include __DIR__ . '/includes/header.php';
$groups = data('faq');
?>
<div class="page active svx" data-page="faq">
<?= sv_page_hero('FAQ', 'Your questions, answered <em>plainly</em>.', 'Straight answers to the questions authors ask us most.') ?>
<section class="svx-sec svx-faqpage" aria-label="Questions by topic"><div class="x-w svx-faqpage-in" id="faq-groups">
  <nav class="svx-topics" aria-label="FAQ topics"><span class="svx-mono">Topics</span><?php $n = 0; foreach ($groups as $g => $items): $n++; ?><a href="#faq-g<?= $n ?>"><span><?= e($g) ?></span><small><?= count($items) ?></small></a><?php endforeach; ?></nav>
  <div>
  <?php $n = 0; foreach ($groups as $g => $items): $n++; ?>
    <div class="svx-faqgroup" id="faq-g<?= $n ?>"><h2 class="svx-gh rv"><span class="svx-rn">0<?= $n ?></span><?= e($g) ?></h2><div class="faq x-faq-list"><?= faq_html($items) ?></div></div>
  <?php endforeach; ?>
  </div>
</div></section>
<?= sv_close_form('Ask us', 'Still have a <em>question</em>?', 'Ask us. A real person will answer.', 'faqp', 'Ask a question', 'We reply within one business day.', 'faq', 'Ask a question') ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
