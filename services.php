<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Book Writing, Editing & Publishing Services | AMZ United Press',
    'description' => 'Ghostwriting, ebook writing, book editing, Amazon publishing, cover design and book marketing services under one roof. Get a free written quote today.',
    'path' => '/services', 'nav' => 'services',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Services', null]]),
        ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => 'AMZ United Press services', 'itemListElement' => array_map(fn($s, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $s['name'], 'url' => abs_url('/services/' . $s['slug'])], data('subs'), array_keys(data('subs')))]],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="services">
<?php
$nav = '<div class="cat-nav" id="cat-nav">';
foreach (data('cats') as $c) $nav .= '<a href="' . e(url('/services#cat-' . $c['k'])) . '">' . e($c['t']) . '</a>';
echo page_hero(['Services'], 'Self-publishing services for <span class="mk">authors</span>, under one roof.', 'Writing, publishing, editing and promotion: ' . count(data('subs')) . ' services from one team at AMZ United Press. Choose one, combine several, or let us manage your whole book from first idea to launch.', 'services', $nav . '</div>');
?>
<section class="wrap" id="svc-all" aria-label="All services">
<?php foreach (data('cats') as $i => $c): $subs = subs_of($c['k']); $cp = photos()['cat'][$c['k']]; ?>
  <section class="cat" id="cat-<?= e($c['k']) ?>" aria-labelledby="h-<?= e($c['k']) ?>">
    <div class="cat-intro"><span class="eyebrow">0<?= $i + 1 ?> · <?= count($subs) ?> services</span><h2 id="h-<?= e($c['k']) ?>"><?= e($c['t']) ?></h2><p class="lead"><?= e($c['d']) ?></p><div class="art"><?= photo($cp[0], 900, $cp[1], 'aph') ?></div></div>
    <div class="sub-list">
    <?php foreach ($subs as $j => $x): ?>
      <a class="sub-row" href="<?= e(url('/services/' . $x['slug'])) ?>"><span class="num"><?= str_pad((string)($j + 1), 2, '0', STR_PAD_LEFT) ?></span><div><h3><?= e($x['name']) ?></h3><p><?= e(plain($x['short'])) ?></p><div class="chips"><span class="chip o">From <?= e($x['price']) ?></span><span class="chip"><?= e($x['time']) ?></span></div></div><span class="go"><?= ic('arrow') ?></span></a>
    <?php endforeach; ?>
    </div>
  </section>
<?php endforeach; ?>
</section>
<?= cta_band('Not sure which service you need?', 'Most authors aren’t at first. Tell us where you are and we’ll recommend the simplest route.', 'Get free advice', '/contact', 'How pricing works', '/pricing') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
