<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'Book Writing, Editing & Publishing Services | AMZ United Press',
    'description' => 'Ghostwriting, ebook writing, book editing, Amazon publishing, cover design and book marketing services under one roof. Get a free written quote today.',
    'path' => '/services', 'nav' => 'services',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Services', null]]),
        ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => 'AMZ United Press services', 'itemListElement' => array_map(fn($s, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $s['name'], 'url' => abs_url('/services/' . $s['slug'])], data('subs'), array_keys(data('subs')))]],
];
include __DIR__ . '/includes/header.php';
$catpics = ['write' => ['Fourparts/Crafting Stories at the Writing Desk.png', 'Writing desk with a manuscript in progress'], 'publish' => ['Fourparts/Self-Publishing Dashboard Workspace.png', 'Self-publishing dashboard on a desktop screen'], 'edit' => ['Fourparts/Cozy Manuscript Editing Workspace.png', 'Manuscript being edited at a desk'], 'other' => ['Fourparts/Cinematic Book Design Workspace.png', 'Book cover and marketing design workspace']];
$cicon = ['write' => 'pen', 'publish' => 'rocket', 'edit' => 'fileedit', 'other' => 'sparkles'];
$nav = '<div class="cat-nav ix-catnav" id="cat-nav">';
foreach (data('cats') as $c) $nav .= '<a href="' . e(url('/services#cat-' . $c['k'])) . '">' . ix_icon($cicon[$c['k']]) . e($c['t']) . '</a>';
$nav .= '</div>';
$side = '<div class="ix-ph-art ix-art-svc" aria-hidden="true"><span class="ix-glow"></span><div class="ix-svc-tiles">';
foreach (data('cats') as $i => $c) $side .= '<span class="ix-svc-tile t' . $i . '">' . ix_icon($cicon[$c['k']]) . '<b>' . count(subs_of($c['k'])) . '</b><small>' . e($c['t']) . '</small></span>';
$side .= '</div>' . ix_book(1, 'b1') . ix_float('check', 'One team', 'From idea to launch', 'f1') . '</div>';
?>
<div class="page active ix" data-page="services">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['Services'], 'Self-publishing services for <span class="mk">authors</span>, under one roof.', 'Writing, publishing, editing and promotion: ' . count(data('subs')) . ' services from one team at AMZ United Press. Choose one, combine several, or let us manage your whole book from first idea to launch.', $side, $nav) ?>

<section id="svc-all" aria-label="All services">
<?php foreach (data('cats') as $i => $c): $subs = subs_of($c['k']); ?>
  <section class="ix-sec ix-catsec<?= $i % 2 ? ' alt' : '' ?>" id="cat-<?= e($c['k']) ?>" aria-labelledby="h-<?= e($c['k']) ?>">
    <div class="ix-w ix-cat-in">
      <div class="ix-cat-intro">
        <span class="ix-eyebrow">0<?= $i + 1 ?> · <?= count($subs) ?> services</span>
        <h2 id="h-<?= e($c['k']) ?>" class="ix-h2"><?= e($c['t']) ?></h2>
        <p class="ix-lead"><?= e($c['d']) ?></p>
        <div class="ix-frame ix-cat-art"><?= ix_img($catpics[$c['k']][0], $catpics[$c['k']][1], 900) ?><span class="ix-cat-badge" aria-hidden="true"><?= ix_icon($cicon[$c['k']]) ?></span></div>
      </div>
      <div class="ix-svc-list">
      <?php foreach ($subs as $j => $x): ?>
        <a class="ix-svc-row ix-spot ix-rv" style="--d:<?= ($j % 4) * 60 ?>ms" href="<?= e(url('/services/' . $x['slug'])) ?>">
          <span class="ix-svc-ic"><?= ix_icon(ix_service_icon($x['slug'])) ?></span>
          <div><span class="ix-svc-n"><?= str_pad((string)($j + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= e($x['name']) ?></h3><p><?= e(plain($x['short'])) ?></p>
            <div class="ix-svc-meta"><span class="o">From <?= e($x['price']) ?></span><span><?= ix_icon('clock') ?><?= e($x['time']) ?></span></div></div>
          <span class="ix-svc-go"><?= ix_icon('arrow') ?></span>
        </a>
      <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endforeach; ?>
</section>

<section class="ix-milestones" aria-label="AMZ United Press in numbers">
  <span class="ix-mile-bg" aria-hidden="true"><?= ix_book(4, 'm1') . ix_book(7, 'm2') ?></span>
  <div class="ix-w"><?= ix_stats() ?></div>
</section>

<?= ix_band('Not sure which service you need?', 'Most authors aren’t at first. Tell us where you are and we’ll recommend the simplest route.', 'Get free advice', '/contact', 'How pricing works', '/pricing', 2) ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
