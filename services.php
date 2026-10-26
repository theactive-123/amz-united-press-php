<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Ebook Writing, Editing & Design Services | AMZ United Press',
    'description' => 'Ten specialist ebook services across writing, editing, cover design and publishing. Choose one, combine several, or let us manage it all. Written quote first.',
    'path' => '/services', 'nav' => 'services',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Services', null]])],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="services">
<?php
$nav = '<div class="cat-nav" id="cat-nav">';
foreach (data('cats') as $c) $nav .= '<a href="' . e(url('/services#cat-' . $c['k'])) . '">' . e($c['t']) . '</a>';
echo page_hero(['Services'], 'Ten specialist services, one <span class="mk">friendly</span> team.', 'Across writing, editing, design and publishing. Choose one, combine several, or let us manage the whole journey.', 'services', $nav . '</div>');
?>
<section class="wrap" id="svc-all" aria-label="All services">
<?php foreach (data('cats') as $i => $c): $subs = subs_of($c['k']); $cp = photos()['cat'][$c['k']]; ?>
  <section class="cat" id="cat-<?= e($c['k']) ?>" aria-labelledby="h-<?= e($c['k']) ?>">
    <div class="cat-intro"><span class="eyebrow">0<?= $i + 1 ?> · <?= count($subs) ?> services</span><h2 id="h-<?= e($c['k']) ?>"><?= e($c['t']) ?></h2><p class="lead"><?= e($c['d']) ?></p><div class="art"><?= photo($cp[0], 900, $cp[1], 'aph') ?></div></div>
    <div class="sub-list">
    <?php foreach ($subs as $j => $x): ?>
      <a class="sub-row" href="<?= e(url('/services/' . $x['slug'])) ?>"><span class="num">0<?= $j + 1 ?></span><div><h3><?= e($x['t']) ?></h3><p><?= e($x['short']) ?></p><div class="chips"><span class="chip o">From <?= e($x['price']) ?></span><span class="chip"><?= e($x['time']) ?></span></div></div><span class="go"><?= ic('arrow') ?></span></a>
    <?php endforeach; ?>
    </div>
  </section>
<?php endforeach; ?>
</section>
<?= cta_band('Not sure which service you need?', 'Most authors aren’t at first. Tell us where you are and we’ll recommend the simplest route.', 'Get free advice', '/contact', 'How pricing works', '/pricing') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
