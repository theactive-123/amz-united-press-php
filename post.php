<?php
require __DIR__ . '/includes/bootstrap.php';
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? ''));
$p = blog_post($slug);
if (!$p) { http_response_code(404); include __DIR__ . '/404.php'; exit; }

// Root-relative links in the article respect the site's base path.
$body = preg_replace_callback('/(href|src)="\/(?!\/)([^"]*)"/', fn($m) => $m[1] . '="' . e(url('/' . html_entity_decode($m[2]))) . '"', $p['body']);
// Table of contents from the article's H2 headings.
preg_match_all('/<h2[^>]*id="([^"]+)"[^>]*>(.*?)<\/h2>/s', $body, $hm, PREG_SET_ORDER);
$toc = array_map(fn($m) => [$m[1], trim(strip_tags($m[2]))], $hm);
$toc[] = ['faq', 'Frequently asked questions'];
$words = str_word_count(strip_tags($body . ' ' . implode(' ', array_merge(...array_map(fn($f) => [$f[0], $f[1]], $p['faq'])))));
$mins  = max(1, (int)round($words / 230));
$url   = '/blog/' . $p['slug'];
$fmt   = fn($d) => date('F j, Y', strtotime($d));

$meta = [
    'title' => $p['title'],  // kept under ~60 characters so Google shows it in full
    'description' => $p['description'],
    'path' => $url, 'nav' => 'blog', 'blog' => true, 'og_type' => 'article', 'image' => $p['image'],
    'schema' => [
        ['@context' => 'https://schema.org', '@type' => 'BlogPosting', 'headline' => $p['h1_plain'], 'description' => $p['description'],
         'image' => [abs_url($p['image'])], 'datePublished' => $p['date'] . 'T09:00:00-06:00', 'dateModified' => $p['updated'] . 'T09:00:00-06:00',
         'author' => ['@type' => 'Organization', 'name' => site('name') . ' Editorial Team', 'url' => abs_url('/about')],
         'publisher' => ['@type' => 'Organization', 'name' => site('name'), 'logo' => ['@type' => 'ImageObject', 'url' => abs_url('/assets/img/logo.png')]],
         'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => abs_url($url)], 'articleSection' => $p['category'],
         'keywords' => implode(', ', array_merge([$p['keyword']], $p['keywords'])), 'wordCount' => $words, 'inLanguage' => 'en-US'],
        faq_schema($p['faq']),
        breadcrumb_schema([['Home', '/'], ['Blog', '/blog'], [$p['h1_plain'], null]]),
    ],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active bp" data-page="post">

<header class="bp-hero">
  <div class="bp-w">
    <nav class="bp-crumbs" aria-label="Breadcrumb"><a href="<?= e(url('/')) ?>">Home</a><span aria-hidden="true">/</span><a href="<?= e(url('/blog')) ?>">Blog</a><span aria-hidden="true">/</span><span><?= e($p['category']) ?></span></nav>
    <p class="bp-cat"><?= e($p['category']) ?></p>
    <h1 class="bp-h1"><?= $p['h1'] ?></h1>
    <p class="bp-excerpt"><?= e($p['excerpt']) ?></p>
    <div class="bp-meta">
      <span class="bp-by"><img src="<?= e(asset('img/logo.png')) ?>" alt="" width="60" height="26"><span>By the <b><?= e(site('name')) ?> Editorial Team</b></span></span>
      <span><?= e('Published ' . $fmt($p['date'])) ?></span>
      <?php if ($p['updated'] !== $p['date']): ?><span><?= e('Updated ' . $fmt($p['updated'])) ?></span><?php endif; ?>
      <span><?= $mins ?> min read</span>
    </div>
  </div>
  <figure class="bp-w bp-cover"><img src="<?= e(url($p['image'])) ?>" alt="<?= e($p['image_alt']) ?>" width="1200" height="630" fetchpriority="high"></figure>
</header>

<div class="bp-w bp-layout">
  <aside class="bp-side" aria-label="In this article">
    <nav class="bp-toc"><p class="bp-toc-k">In this article</p><ol><?php foreach ($toc as $t): ?><li><a href="#<?= e($t[0]) ?>" data-bp-toc><?= e($t[1]) ?></a></li><?php endforeach; ?></ol></nav>
    <div class="bp-side-cta"><p><b>Publish your book the right way.</b> Packages from $199, and you keep 100% of your royalties.</p><button type="button" class="btn btn-primary" data-quote="Blog: <?= e($p['h1_plain']) ?>" data-help="3">Get a free quote</button></div>
  </aside>

  <article class="bp-article">
    <?= $body ?>

    <section class="bp-faq" aria-labelledby="faq">
      <h2 id="faq">Frequently asked questions</h2>
      <div class="faq"><?= faq_html($p['faq'], true) ?></div>
    </section>

    <div class="bp-author">
      <img src="<?= e(asset('img/logo.png')) ?>" alt="<?= e(site('name')) ?>" width="120" height="52">
      <div><p class="bp-author-n">Written by the <?= e(site('name')) ?> Editorial Team</p>
        <p>Our editors, designers and KDP specialists publish books for independent authors every week. This guide reflects the prices and Amazon rules we work with daily, and we update it when they change. <a href="<?= e(url('/about')) ?>">More about us</a>.</p></div>
    </div>
  </article>
</div>

<section class="bp-related" aria-labelledby="rel-h"><div class="bp-w">
  <h2 id="rel-h">Services mentioned in this guide</h2>
  <div class="bp-rel-grid">
  <?php foreach (array_filter(array_map('sub_by_slug', ['publishing-services', 'book-editing-services', 'book-cover-design-services', 'book-formatting-services'])) as $s): ?>
    <a class="bp-rel" href="<?= e(url('/services/' . $s['slug'])) ?>"><small>From <?= e($s['price']) ?></small><b><?= e($s['name']) ?></b><span><?= e(plain($s['short'])) ?></span></a>
  <?php endforeach; ?>
  </div>
</div></section>

<?= cta_band('Get a written quote for your book.', 'Tell us about your manuscript. A real person replies within one business day.', 'Get my free quote', '/contact', 'See packages', '/pricing') ?>
</div>
<script src="<?= e(asset('js/blog.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
