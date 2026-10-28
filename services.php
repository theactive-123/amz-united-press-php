<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'Book Writing, Editing & Publishing Services | AMZ United Press',
    'description' => 'Ghostwriting, ebook writing, book editing, Amazon publishing, cover design and book marketing services under one roof. Get a free written quote today.',
    'path' => '/services', 'nav' => 'services',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Services', null]]),
        ['@context' => 'https://schema.org', '@type' => 'ItemList', 'name' => 'AMZ United Press services', 'itemListElement' => array_map(fn($s, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $s['name'], 'url' => abs_url('/services/' . $s['slug'])], data('subs'), array_keys(data('subs')))]],
];
include __DIR__ . '/includes/header.php';
$ci = ['write' => 'pen', 'publish' => 'send', 'edit' => 'edit', 'other' => 'spark'];
$nav = '<div class="svx-catnav" id="cat-nav">';
foreach (data('cats') as $c) $nav .= '<a href="' . e(url('/services#cat-' . $c['k'])) . '">' . e($c['t']) . '</a>';
$nav .= '</div>';
?>
<div class="page active svx" data-page="services">
<?= sv_page_hero('Services', 'Self-publishing services for <em>authors</em>, under one roof.', 'Writing, publishing, editing and promotion: ' . count(data('subs')) . ' services from one team at AMZ United Press. Choose one, combine several, or let us manage your whole book from first idea to launch.', 'fan', $nav) ?>
<section id="svc-all" aria-label="All services">
<?php foreach (data('cats') as $i => $c): $subs = subs_of($c['k']); ?>
  <section class="svx-sec svx-cat<?= $i % 2 ? ' alt' : '' ?>" id="cat-<?= e($c['k']) ?>" aria-labelledby="h-<?= e($c['k']) ?>">
    <div class="x-w svx-split top">
      <div class="svx-sticky">
        <?= sv_kick($ci[$c['k']], '0' . ($i + 1) . ' · ' . count($subs) . ' services') ?>
        <h2 id="h-<?= e($c['k']) ?>" class="x-h2 svx-h2 rv"><?= sv_em($c['t']) ?></h2>
        <p class="x-sub"><?= e($c['d']) ?></p>
        <button type="button" class="btn btn-primary" data-quote="Interested in: <?= e($c['t']) ?>" data-help="<?= (int)$c['help'] ?>">Get a Free Quote</button>
      </div>
      <ul class="svx-index">
      <?php foreach ($subs as $j => $x): ?>
        <li class="rv"><a href="<?= e(url('/services/' . $x['slug'])) ?>"><span class="svx-rn"><?= str_pad((string)($j + 1), 2, '0', STR_PAD_LEFT) ?></span><span><h3><?= e($x['name']) ?></h3><p><?= e(plain($x['short'])) ?></p></span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li>
      <?php endforeach; ?>
      </ul>
    </div>
  </section>
<?php endforeach; ?>
</section>
<?= sv_proof('clients') ?>
<?= sv_close_form('Not sure where to start?', 'Not sure which service you <em>need</em>?', 'Most authors aren’t at first. Tell us where you are and we’ll recommend the simplest route.', 'svcs', 'Get free advice', 'Takes about a minute. We reply within one business day.', 'services', 'Get free advice', [['/pricing', 'How pricing works'], ['/contact', 'Contact page']]) ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
