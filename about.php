<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'About AMZ United Press | Ebook Writing & Publishing Team',
    'description' => 'Meet the editors, ghostwriters and designers behind AMZ United Press. One team, one clear plan, and honest advice at every stage of your book.',
    'path' => '/about', 'nav' => 'about',
    'schema' => [breadcrumb_schema([['Home', '/'], ['About', null]])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="about">
<?= page_hero(['About'], 'We help good ideas become <span class="mk">well-made</span> books.', 'AMZ United Press is an ebook writing, editing and publishing service for authors of every experience level.', 'about') ?>
<section class="section"><div class="wrap split">
  <div class="imgbox rv" style="aspect-ratio:4/3.3"><?php $t = photos()['team']; echo photo($t[0], 1100, $t[1]); ?></div>
  <div class="rv"><span class="eyebrow">Our story</span><h2>Handing over a book is a big decision. We take it seriously.</h2>
    <p>It’s personal, and it has probably taken you a long time. So we promise to listen first, to be honest about what your book needs, and never to push you toward a service you don’t want.</p>
    <p>AMZ United Press was founded by a small group of editors and designers who saw first-time authors struggling with jargon, hidden fees and slow replies. We built the service we wished existed: one team, one clear plan, and honest advice at every stage.</p>
    <?= ph_note('Placeholder story text. Replace with your real company history before launch.') ?></div>
</div></section>
<section class="section bg-white"><div class="wrap"><div class="sec-head center rv"><span class="eyebrow">Our principles</span><h2>How we work.</h2></div>
  <div class="grid-4 rv" id="values"><?php foreach (data('values') as $v): ?><div class="factor"><div class="ic-sq"><?= ic($v[0]) ?></div><h3><?= e($v[1]) ?></h3><p><?= e($v[2]) ?></p></div><?php endforeach; ?></div></div></section>
<section class="section"><div class="wrap"><div class="sec-head rv"><span class="eyebrow">The team</span><h2>The specialists behind your book.</h2><p class="lead">Every project is handled by people who do one thing really well.</p></div>
  <div class="team rv" id="team"><?php foreach (data('team') as $r): ?><div class="person"><div class="av" style="--c:<?= e($r[3]) ?>"><?= e($r[0]) ?></div><h3><?= e($r[1]) ?></h3><p><?= e($r[2]) ?></p></div><?php endforeach; ?></div></div></section>
<?= cta_band('Let’s talk about your book.', 'Free advice, no obligation.', 'Get started') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
