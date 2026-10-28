<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'How Ebook Publishing Works: Four Clear Steps | AMZ United Press',
    'description' => 'From first conversation to published ebook in four plain-English steps. See what you do, what we do, and how long each stage typically takes.',
    'path' => '/how-it-works', 'nav' => 'how-it-works',
    'schema' => [breadcrumb_schema([['Home', '/'], ['How it works', null]])],
];
include __DIR__ . '/includes/header.php';
$steps = data('steps'); $si = ['chat', 'pen', 'fileedit', 'rocket'];
$side = '<div class="ix-ph-art ix-art-steps" aria-hidden="true"><span class="ix-glow"></span><div class="ix-mini-steps">';
foreach ($steps as $i => $s) $side .= '<span class="ix-mini-step s' . $i . '">' . ix_icon($si[$i % 4]) . '<b>0' . ($i + 1) . '</b><small>' . e($s['t']) . '</small></span>';
$side .= '</div>' . ix_kindle(2, 'k1') . ix_float('clock', 'Next step', 'Always explained', 'f1') . '</div>';
$c = photos()['consult'];
?>
<div class="page active ix" data-page="how-it-works">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['How it works'], 'A clear path from idea to <span class="mk">published</span> book.', 'Four steps, each explained in plain English. You’ll know what happens next at every stage.', $side, ix_ctas('Start step one', '', -1, true)) ?>

<section class="ix-sec ix-proc ix-proc-big" aria-label="Our four-step process">
  <div class="ix-w ix-proc-in" id="process-detail">
    <div class="ix-proc-side">
      <span class="ix-eyebrow">The process</span>
      <p class="ix-proc-kicker">From idea to published book in <?= count($steps) ?> stages.</p>
      <div class="ix-proc-now" aria-hidden="true">
        <svg viewBox="0 0 36 36" class="ix-ring"><circle cx="18" cy="18" r="15.9" pathLength="100"/><circle cx="18" cy="18" r="15.9" pathLength="100" data-proc-ring/></svg>
        <span class="ix-proc-num"><b data-proc-num>01</b><small>of 0<?= count($steps) ?></small></span>
        <span class="ix-proc-title" data-proc-title><?= e($steps[0]['t']) ?></span>
      </div>
      <button type="button" class="ix-btn ix-btn-primary" data-quote="">Start the conversation <?= ix_icon('arrow') ?></button>
    </div>
    <ol class="ix-proc-list">
    <?php foreach ($steps as $i => $s): ?>
      <li class="ix-pstep ix-rv" data-title="<?= e($s['t']) ?>">
        <span class="ix-pstep-ic"><?= ix_icon($si[$i % 4]) ?></span>
        <div><span class="ix-pstep-n">Step 0<?= $i + 1 ?> · Typical time: <?= e($s['time']) ?></span><h2><?= e($s['t']) ?></h2><p><?= e($s['d']) ?></p>
          <div class="ix-youwe"><div><h4><?= ix_icon('users') ?>What you do</h4><p><?= e($s['you']) ?></p></div><div class="we"><h4><?= ix_icon('check') ?>What we do</h4><p><?= e($s['we']) ?></p></div></div></div>
      </li>
    <?php endforeach; ?>
    </ol>
  </div>
</section>

<section class="ix-sec ix-intro flip" aria-labelledby="hw-ready">
  <div class="ix-w ix-intro-in">
    <div class="ix-intro-art ix-rv"><div class="ix-frame"><?= photo($c[0], 1100, $c[1]) ?></div><span class="ix-badge-round" aria-hidden="true"><b>Free</b><small>first call</small></span></div>
    <div class="ix-intro-copy">
      <span class="ix-eyebrow ix-rv">Before we talk</span>
      <h2 id="hw-ready" class="ix-h2 ix-rv">What to have ready</h2>
      <p class="ix-rv ix-lead">Nothing is required to get in touch. If you have any of these, we can give you sharper advice:</p>
      <ul class="ix-benefits one ix-rv">
        <?php foreach (['A rough idea of what your book is about', 'Any notes, outlines or drafts you’ve already written', 'Who you’d like to read it, and why', 'A rough budget and timeline, if you have one'] as $x): ?>
        <li><span><?= ix_icon('check') ?></span><?= e($x) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?= ix_band('Ready for step one?', 'It takes about a minute and costs nothing.', 'Start the conversation', '/contact', '', '', 5) ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
