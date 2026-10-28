<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'How Ebook Publishing Works: Four Clear Steps | AMZ United Press',
    'description' => 'From first conversation to published ebook in four plain-English steps. See what you do, what we do, and how long each stage typically takes.',
    'path' => '/how-it-works', 'nav' => 'how-it-works',
    'schema' => [breadcrumb_schema([['Home', '/'], ['How it works', null]])],
];
include __DIR__ . '/includes/header.php';
$c = photos()['consult'];
?>
<div class="page active svx" data-page="how-it-works">
<?= sv_page_hero('How it works', 'A clear path from idea to <em>published</em> book.', 'Four steps, each explained in plain English. You’ll know what happens next at every stage.', 'From first idea to finished book/Cozy InDesign Book Layout Workspace.png', 'hero', 'how-it-works', 'Start step one') ?>
<section class="svx-sec svx-hiw" aria-label="The four steps"><div class="x-w" id="process-detail">
<?php foreach (data('steps') as $i => $s): ?>
  <article class="svx-hstep rv">
    <span class="svx-hn">0<?= $i + 1 ?></span>
    <div><h2><?= e($s['t']) ?></h2><p class="svx-hd"><?= e($s['d']) ?></p><span class="svx-mono">Typical time: <?= e($s['time']) ?></span></div>
    <dl class="svx-youwe"><div><dt>What you do</dt><dd><?= e($s['you']) ?></dd></div><div class="we"><dt>What we do</dt><dd><?= e($s['we']) ?></dd></div></dl>
  </article>
<?php endforeach; ?>
</div></section>
<section class="svx-sec svx-intro" aria-labelledby="hw-ready"><div class="x-w svx-split">
  <figure class="x-frame svx-intro-img rv"><?= photo($c[0], 1100, $c[1]) ?></figure>
  <div><?= sv_kick('check', 'Before we talk') ?><h2 class="x-h2 svx-h2 rv" id="hw-ready">What to have <em>ready</em></h2>
    <p class="svx-big">Nothing is required to get in touch. If you have any of these, we can give you sharper advice:</p>
    <ul class="x-commit one">
      <?php foreach (['A rough idea of what your book is about', 'Any notes, outlines or drafts you’ve already written', 'Who you’d like to read it, and why', 'A rough budget and timeline, if you have one'] as $x): ?>
      <li class="rv"><b><?= sv_i('check') ?></b><span><?= e($x) ?></span></li>
      <?php endforeach; ?>
    </ul></div>
</div></section>
<?= sv_close_form('Ready for step <em>one</em>?', 'It takes about a minute and costs nothing.', 'Step one', 6) ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
