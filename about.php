<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'About AMZ United Press | Ebook Writing & Publishing Team',
    'description' => 'Meet the editors, ghostwriters and designers behind AMZ United Press. One team, one clear plan, and honest advice at every stage of your book.',
    'path' => '/about', 'nav' => 'about',
    'schema' => [breadcrumb_schema([['Home', '/'], ['About', null]])],
];
include __DIR__ . '/includes/header.php';
$t = photos()['team'];
$side = '<div class="ix-ph-art ix-art-about" aria-hidden="true"><span class="ix-glow"></span>'
      . '<div class="ix-frame p1">' . ix_img('Fourparts/Crafting Stories at the Writing Desk.png', '', 700, true) . '</div>'
      . '<div class="ix-frame p2">' . ix_img('Fourparts/Cozy Manuscript Editing Workspace.png', '', 600, true) . '</div>'
      . ix_book(3, 'b1') . ix_float('users', 'One team', 'Writers · editors · designers', 'f1') . ix_float('shield', 'Honest advice', 'At every stage', 'f2') . '</div>';
?>
<div class="page active ix" data-page="about">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['About'], 'We help good ideas become <span class="mk">well-made</span> books.', 'AMZ United Press is an ebook writing, editing and publishing service for authors of every experience level.', $side, ix_ctas('Talk to our team', '', -1, true)) ?>

<section class="ix-sec ix-about ix-story" aria-labelledby="ab-story">
  <div class="ix-w ix-about-in">
    <div class="ix-about-art ix-rv">
      <div class="ix-frame a1"><?= photo($t[0], 1100, $t[1]) ?></div>
      <div class="ix-frame a2" aria-hidden="true"><?= ix_img('From first idea to finished book/Book Project Proposal Workspace.png', '', 600) ?></div>
      <span class="ix-float f1" aria-hidden="true"><?= ix_icon('heart') ?><span><b>We listen first</b><small>Then we plan</small></span></span>
    </div>
    <div class="ix-about-copy">
      <span class="ix-eyebrow ix-rv">Our story</span>
      <h2 id="ab-story" class="ix-h2 ix-rv">Handing over a book is a big decision. We take it seriously.</h2>
      <p class="ix-rv ix-pull">It’s personal, and it has probably taken you a long time. So we promise to listen first, to be honest about what your book needs, and never to push you toward a service you don’t want.</p>
      <p class="ix-rv">AMZ United Press was founded by a small group of editors and designers who saw first-time authors struggling with jargon, hidden fees and slow replies. We built the service we wished existed: one team, one clear plan, and honest advice at every stage.</p>
      <?= ph_note('Placeholder story text. Replace with your real company history before launch.') ?>
      <ul class="ix-promise-row ix-rv"><li><?= ix_icon('lock') ?>100% rights &amp; royalties</li><li><?= ix_icon('coins') ?>Written quote first</li><li><?= ix_icon('clock') ?>Reply in 1 business day</li></ul>
    </div>
  </div>
</section>

<section class="ix-sec ix-why" aria-labelledby="ab-values">
  <div class="ix-w">
    <?= ix_head('Our principles', '<span id="ab-values">How we work.</span>', '', 'h2', 'c') ?>
    <div class="ix-whygrid n4" id="values">
      <?php foreach (data('values') as $i => $v): ?>
      <article class="ix-why-card ix-spot ix-rv<?= $i === 0 ? ' lead' : '' ?>" style="--d:<?= $i * 80 ?>ms">
        <span class="ix-why-ic"><?= ix_icon(['pen', 'shield', 'clock', 'fileedit'][$i % 4]) ?></span>
        <span class="ix-why-n" aria-hidden="true">0<?= $i + 1 ?></span>
        <h3><?= e($v[1]) ?></h3><p><?= e($v[2]) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="ix-milestones" aria-label="AMZ United Press in numbers">
  <span class="ix-mile-bg" aria-hidden="true"><?= ix_book(2, 'm1') . ix_book(5, 'm2') ?></span>
  <div class="ix-w"><?= ix_stats() ?></div>
</section>

<section class="ix-sec ix-team" aria-labelledby="ab-team">
  <div class="ix-w ix-team-in">
    <div class="ix-team-side">
      <span class="ix-eyebrow ix-rv">The team</span>
      <h2 id="ab-team" class="ix-h2 ix-rv">The specialists behind your book.</h2>
      <p class="ix-lead ix-rv">Every project is handled by people who do one thing really well.</p>
      <div class="ix-team-flow ix-rv" aria-hidden="true"><?php foreach (data('team') as $i => $r): ?><span><?= e($r[1]) ?></span><?php if ($i < 3): ?><?= ix_icon('arrow') ?><?php endif; endforeach; ?></div>
    </div>
    <div class="ix-team-grid" id="team">
      <?php foreach (data('team') as $i => $r): ?>
      <article class="ix-person ix-spot ix-rv" style="--d:<?= $i * 80 ?>ms">
        <span class="ix-person-av" aria-hidden="true"><?= ix_icon(['pen', 'fileedit', 'palette', 'package'][$i % 4]) ?><b><?= e($r[0]) ?></b></span>
        <h3><?= e($r[1]) ?></h3><p><?= e($r[2]) ?></p>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= ix_band('Let’s talk about your book.', 'Free advice, no obligation.', 'Get started', '/contact', '', '', 1) ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
