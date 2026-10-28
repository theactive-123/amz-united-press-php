<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'Ebook Publishing FAQ: Cost, Rights, Timing | AMZ United Press',
    'description' => 'Straight answers to the questions authors ask most: how much ebook publishing costs, who owns the rights, how long it takes and where your book is sold.',
    'path' => '/faq', 'nav' => 'faq',
    'schema' => [breadcrumb_schema([['Home', '/'], ['FAQ', null]]), faq_schema(array_merge(...array_values(data('faq'))))],
];
include __DIR__ . '/includes/header.php';
$groups = data('faq'); $gi = ['Getting started' => 'compass', 'Cost & timing' => 'coins', 'Your book & rights' => 'lock', 'Publishing' => 'rocket'];
$side = '<div class="ix-ph-art ix-art-chat" aria-hidden="true"><span class="ix-glow"></span>'
      . '<span class="ix-bubble q">Do I keep my rights?</span><span class="ix-bubble a">Yes. 100% of your rights and royalties stay with you.</span>'
      . '<span class="ix-bubble q q2">How long does it take?</span><span class="ix-bubble a a2"><span class="ix-typing"><i></i><i></i><i></i></span></span>'
      . ix_book(5, 'b1') . ix_float('chat', count($groups) . ' topics', 'Straight answers', 'f1') . '</div>';
?>
<div class="page active ix" data-page="faq">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['FAQ'], 'Your questions, answered <span class="mk">plainly</span>.', 'Straight answers to the questions authors ask us most.', $side) ?>

<section class="ix-sec ix-faqpage" aria-label="Frequently asked questions">
  <div class="ix-w ix-faqpage-in" id="faq-groups">
    <aside class="ix-faq-side">
      <nav class="ix-faq-nav" aria-label="FAQ topics"><?php $n = 0; foreach ($groups as $g => $items): $n++; ?><a href="#faq-g<?= $n ?>"><?= ix_icon($gi[$g] ?? 'chat') ?><span><?= e($g) ?></span><small><?= count($items) ?></small></a><?php endforeach; ?></nav>
      <div class="ix-faq-cta"><span class="ix-faq-cta-ic" aria-hidden="true"><?= ix_icon('chat') ?></span><b class="ix-faq-cta-t">Can’t find your answer?</b>
        <button type="button" class="ix-btn ix-btn-primary" data-quote="">Ask a question <?= ix_icon('arrow') ?></button>
        <a class="ix-faq-tel" href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><?= ix_icon('phone') ?><?= e(site('phone')) ?></a></div>
    </aside>
    <div class="ix-faq-groups">
    <?php $n = 0; foreach ($groups as $g => $items): $n++; ?>
      <div class="ix-faq-group ix-rv" id="faq-g<?= $n ?>"><div class="ix-faq-gh"><span class="ix-why-ic" aria-hidden="true"><?= ix_icon($gi[$g] ?? 'chat') ?></span><h2><?= e($g) ?></h2></div><div class="faq ix-faq" data-ix-faq><?= faq_html($items) ?></div></div>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<?= ix_band('Still have a question?', 'Ask us. A real person will answer.', 'Ask a question', '/contact', '', '', 4) ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
