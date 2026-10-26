<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'How Ebook Publishing Works: Four Clear Steps | AMZ United Press',
    'description' => 'From first conversation to published ebook in four plain-English steps. See what you do, what we do, and how long each stage typically takes.',
    'path' => '/how-it-works', 'nav' => 'how-it-works',
    'schema' => [breadcrumb_schema([['Home', '/'], ['How it works', null]])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="how-it-works">
<?= page_hero(['How it works'], 'A clear path from idea to <span class="mk">published</span> book.', 'Four steps, each explained in plain English. You’ll know what happens next at every stage.', 'how-it-works') ?>
<section class="section"><div class="wrap" id="process-detail">
<?php foreach (data('steps') as $i => $s): ?>
  <div class="stepcard rv"><div class="no">0<?= $i + 1 ?></div><div><h2 style="font-size:2rem"><?= e($s['t']) ?></h2><p class="lead" style="margin-bottom:14px"><?= e($s['d']) ?></p><span class="chip o">Typical time: <?= e($s['time']) ?></span></div><div><h4>What you do</h4><p><?= e($s['you']) ?></p><h4>What we do</h4><p style="margin:0"><?= e($s['we']) ?></p></div></div>
<?php endforeach; ?>
</div></section>
<section class="section bg-white"><div class="wrap split">
  <div class="rv"><span class="eyebrow">Before we talk</span><h2>What to have ready</h2><p class="lead">Nothing is required to get in touch. If you have any of these, we can give you sharper advice:</p>
    <ul class="checks" style="margin-top:24px">
      <?php foreach (['A rough idea of what your book is about', 'Any notes, outlines or drafts you’ve already written', 'Who you’d like to read it, and why', 'A rough budget and timeline, if you have one'] as $x): ?>
      <li><span class="tick"><?= ic('check') ?></span><?= e($x) ?></li>
      <?php endforeach; ?>
    </ul></div>
  <div class="imgbox rv" style="aspect-ratio:4/3"><?php $c = photos()['consult']; echo photo($c[0], 1100, $c[1]); ?></div>
</div></section>
<?= cta_band('Ready for step one?', 'It takes about a minute and costs nothing.', 'Start the conversation') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
