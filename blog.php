<?php
require __DIR__ . '/includes/bootstrap.php';
$posts = blog_posts();
$meta = [
    'title' => 'Self-Publishing Blog: Guides for Authors | ' . site('name'),
    'description' => 'Practical self-publishing guides from the AMZ United Press team: costs, Amazon KDP, editing, covers, formatting and book marketing.',
    'path' => '/blog', 'nav' => 'blog', 'blog' => true,
    'schema' => [
        ['@context' => 'https://schema.org', '@type' => 'Blog', 'name' => site('name') . ' Blog', 'url' => abs_url('/blog'),
         'blogPost' => array_map(fn($p) => ['@type' => 'BlogPosting', 'headline' => $p['h1_plain'], 'url' => abs_url('/blog/' . $p['slug']), 'datePublished' => $p['date']], $posts)],
        breadcrumb_schema([['Home', '/'], ['Blog', null]]),
    ],
];
include __DIR__ . '/includes/header.php';
$first = $posts[0] ?? null;
?>
<div class="page active bp" data-page="blog">
<header class="bp-hero bp-hero-index">
  <div class="bp-w">
    <nav class="bp-crumbs" aria-label="Breadcrumb"><a href="<?= e(url('/')) ?>">Home</a><span aria-hidden="true">/</span><span>Blog</span></nav>
    <p class="bp-cat">The AMZ United Press blog</p>
    <h1 class="bp-h1">Self-publishing, <em>explained plainly.</em></h1>
    <p class="bp-excerpt">Honest, practical guides on writing, publishing and selling your book on Amazon, from the team that does it every week.</p>
  </div>
</header>

<section class="bp-w bp-list" aria-label="Articles">
<?php if ($first): ?>
  <a class="bp-feature" href="<?= e(url('/blog/' . $first['slug'])) ?>">
    <figure><img src="<?= e(url($first['image'])) ?>" alt="<?= e($first['image_alt']) ?>" width="1200" height="630"></figure>
    <div><p class="bp-cat"><?= e($first['category']) ?> · <?= e(date('F j, Y', strtotime($first['date']))) ?></p><h2><?= e($first['h1_plain']) ?></h2><p><?= e($first['excerpt']) ?></p><span class="bp-more">Read the guide <svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></span></div>
  </a>
<?php endif; ?>
<?php if (count($posts) > 1): ?>
  <div class="bp-cards">
  <?php foreach (array_slice($posts, 1) as $p): ?>
    <a class="bp-card" href="<?= e(url('/blog/' . $p['slug'])) ?>"><figure><img src="<?= e(url($p['image'])) ?>" alt="" loading="lazy"></figure><p class="bp-cat"><?= e($p['category']) ?></p><h2><?= e($p['h1_plain']) ?></h2><p><?= e($p['excerpt']) ?></p></a>
  <?php endforeach; ?>
  </div>
<?php endif; ?>
</section>

<?= cta_band('Ready to publish your book?', 'Packages from $199. You keep 100% of your rights and royalties.', 'Get a free quote', '/contact', 'See packages', '/pricing') ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
