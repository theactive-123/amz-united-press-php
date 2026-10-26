<?php
/** Dynamic XML sitemap, served at /sitemap.xml (see .htaccess). Add a page to sitemap_pages() in includes/functions.php to list it. */
require __DIR__ . '/includes/bootstrap.php';
header('Content-Type: application/xml; charset=utf-8');
$today = date('Y-m-d');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach (sitemap_pages() as [$path, $prio, $freq]): ?>
  <url><loc><?= e(abs_url($path)) ?></loc><lastmod><?= $today ?></lastmod><changefreq><?= $freq ?></changefreq><priority><?= $prio ?></priority></url>
<?php endforeach; ?>
</urlset>
