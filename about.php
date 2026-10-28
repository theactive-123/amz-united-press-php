<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'About AMZ United Press | Ebook Writing & Publishing Team',
    'description' => 'Meet the editors, ghostwriters and designers behind AMZ United Press. One team, one clear plan, and honest advice at every stage of your book.',
    'path' => '/about', 'nav' => 'about',
    'schema' => [breadcrumb_schema([['Home', '/'], ['About', null]])],
];
include __DIR__ . '/includes/header.php';
$t = photos()['team'];
?>
<div class="page active svx" data-page="about">
<?= sv_page_hero('About', 'We help good ideas become <em>well-made</em> books.', 'AMZ United Press is an ebook writing, editing and publishing service for authors of every experience level.', 'Fourparts/Crafting Stories at the Writing Desk.png', sv_actions('About your book', -1, 'Talk to our team')) ?>
<section class="svx-sec svx-story" aria-labelledby="ab-story"><div class="x-w">
  <?= sv_kick('book', 'Our story') ?><h2 class="x-h2 svx-h2 rv" id="ab-story">Handing over a book is a big decision. We take it <em>seriously.</em></h2>
  <div class="svx-ed-grid">
    <div class="svx-ed-p"><p class="svx-big">It’s personal, and it has probably taken you a long time. So we promise to listen first, to be honest about what your book needs, and never to push you toward a service you don’t want.</p>
    <p>AMZ United Press was founded by a small group of editors and designers who saw first-time authors struggling with jargon, hidden fees and slow replies. We built the service we wished existed: one team, one clear plan, and honest advice at every stage.</p>
    <?= ph_note('Placeholder story text. Replace with your real company history before launch.') ?></div>
    <figure class="x-frame svx-story-img rv"><?= photo($t[0], 1100, $t[1]) ?></figure>
  </div>
</div></section>
<section class="svx-sec svx-values" aria-labelledby="ab-values"><div class="x-w">
  <?= sv_kick('spark', 'Our principles') ?><h2 class="x-h2 svx-h2 rv" id="ab-values">How we <em>work.</em></h2>
  <ol class="svx-fourcol" id="values"><?php foreach (data('values') as $i => $v): ?><li class="rv"><span class="svx-big-n">0<?= $i + 1 ?></span><h3><?= e($v[1]) ?></h3><p><?= e($v[2]) ?></p></li><?php endforeach; ?></ol>
</div></section>
<section class="svx-figs" aria-label="AMZ United Press in numbers"><div class="x-w"><div class="hm-stats" role="list"><?= render_stats() ?></div></div></section>
<section class="svx-sec svx-team" aria-labelledby="ab-team"><div class="x-w svx-split top">
  <div class="svx-sticky"><?= sv_kick('chat', 'The team') ?><h2 class="x-h2 svx-h2 rv" id="ab-team">The specialists behind your <em>book.</em></h2><p class="x-sub">Every project is handled by people who do one thing really well.</p></div>
  <ul class="svx-index" id="team"><?php foreach (data('team') as $j => $r): ?><li class="rv"><div class="svx-index-row"><span class="svx-rn"><?= e($r[0]) ?></span><span><h3><?= e($r[1]) ?></h3><p><?= e($r[2]) ?></p></span></div></li><?php endforeach; ?></ul>
</div></section>
<?= sv_proof('clients') ?>
<?= sv_close_form('Get started', 'Let’s talk about your <em>book.</em>', 'Free advice, no obligation.', 'about', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'about', 'Get started') ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
