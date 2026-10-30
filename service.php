<?php
require __DIR__ . '/includes/bootstrap.php';
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? ''));
if (in_array($slug, ['ebook-publishing-services', 'amazon-publishing-services'], true)) { header('Location: ' . url('/services/publishing-services'), true, 301); exit; }
$d = sub_by_slug($slug);
if (!$d) { http_response_code(404); include __DIR__ . '/404.php'; exit; }
$cat    = cat_by_key($d['cat']);
$help   = help_for($d);
$beyond = array_values(array_filter(array_map('sub_by_slug', $d['beyond']['slugs'] ?? [])));
$tel    = tel_href();
$meta = [
    'title' => $d['title'],
    'description' => $d['desc'],
    'path' => '/services/' . $d['slug'], 'nav' => 'services', 'cat' => $d['cat'],
    'schema' => [
        breadcrumb_schema([['Home', '/'], ['Services', '/services'], ...($d['name'] === $cat['t'] ? [[$d['name'], null]] : [[$cat['t'], '/services#cat-' . $cat['k']], [$d['name'], null]])]),
        ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $d['name'], 'description' => plain($d['short']), 'serviceType' => $d['name'],
         'url' => abs_url('/services/' . $d['slug']), 'areaServed' => 'Worldwide',
         'provider' => ['@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'telephone' => site('phone')],
         'offers' => ['@type' => 'Offer', 'priceCurrency' => 'USD', 'price' => preg_replace('/[^\d.]/', '', $d['price']), 'description' => 'Starting price. Written quote before work begins.']],
        faq_schema($d['faq']),
    ],
];
$meta['sv'] = true;
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sv.php';

$seed  = crc32($d['slug']) % 11;
$quote = 'Interested in: ' . $d['t'];
$F = 'Fourparts/'; $J = 'From first idea to finished book/'; $SF = 'Cinematic Sci-Fi Book Cover Showcase.png';

/* Each service: hero background, intro visual (photo or book object), its own order of sections.
   proc: pin|rows|track · proof: shelf|clients|stores|none · get = "what you get" bento (key services) */
$plans = [
    'ghostwriting-services'            => ['bg' => $F . 'Crafting Stories at the Writing Desk.png', 'vis' => 'page',   'proc' => 'pin',   'proof' => 'clients', 'order' => ['sig', 'intro', 'get', 'cta', 'types', 'proc', 'proof', 'faq', 'more']],
    'ebook-writing-services'           => ['bg' => $J . 'Book Project Proposal Workspace.png',      'vis' => 'kindle', 'proc' => 'track', 'proof' => 'shelf',   'order' => ['sig', 'get', 'intro', 'types', 'cta', 'proc', 'proof', 'faq', 'more']],
    'fiction-writing-services'         => ['bg' => $SF,                                             'vis' => 'fan',    'proc' => 'rows',  'proof' => 'shelf',   'order' => ['sig', 'intro', 'proof', 'cta', 'proc', 'faq', 'more']],
    'nonfiction-writing-services'      => ['bg' => $J . 'Book Project Proposal Workspace.png',      'vis' => $F . 'Crafting Stories at the Writing Desk.png', 'proc' => 'pin', 'proof' => 'clients', 'order' => ['intro', 'sig', 'cta', 'proc', 'proof', 'faq', 'more']],
    'memoir-writing-services'          => ['bg' => $F . 'Crafting Stories at the Writing Desk.png', 'vis' => $J . 'Remote Project Discussion on Google Meet.png', 'proc' => 'rows', 'proof' => 'clients', 'order' => ['sig', 'intro', 'proof', 'cta', 'proc', 'faq', 'more']],
    'novel-ghostwriting-services'      => ['bg' => $SF,                                             'vis' => 'books',  'proc' => 'track', 'proof' => 'shelf',   'order' => ['intro', 'sig', 'proof', 'cta', 'proc', 'faq', 'more']],
    'biography-writing-services'       => ['bg' => $J . 'Remote Project Discussion on Google Meet.png', 'vis' => $J . 'Book Project Proposal Workspace.png', 'proc' => 'rows', 'proof' => 'clients', 'order' => ['intro', 'sig', 'cta', 'proc', 'proof', 'faq', 'more']],
    'autobiography-writing-services'   => ['bg' => $F . 'Crafting Stories at the Writing Desk.png', 'vis' => 'page',   'proc' => 'track', 'proof' => 'clients', 'order' => ['sig', 'intro', 'cta', 'proc', 'proof', 'faq', 'more']],
    'publishing-services'              => ['bg' => $J . 'Author Workspace with KDP Publishing Dashboard.png', 'vis' => $F . 'Self-Publishing Dashboard Workspace.png', 'proc' => 'pin', 'proof' => 'shelf', 'order' => ['sig', 'proof', 'sig2', 'intro', 'get', 'types', 'cta', 'proc', 'faq', 'more']],
    'book-editing-services'            => ['bg' => $F . 'Cozy Manuscript Editing Workspace.png',    'vis' => $F . 'Cozy Manuscript Editing Workspace.png', 'proc' => 'rows', 'proof' => 'clients', 'order' => ['sig', 'get', 'intro', 'types', 'cta', 'proc', 'proof', 'faq', 'more']],
    'proofreading-services'            => ['bg' => $J . 'Book Project Proposal Workspace.png',      'vis' => 'marks',  'proc' => 'track', 'proof' => 'none',    'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'faq', 'more']],
    'book-formatting-services'         => ['bg' => $J . 'Cozy InDesign Book Layout Workspace.png',  'vis' => 'kindle', 'proc' => 'rows',  'proof' => 'shelf',   'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'proof', 'faq', 'more']],
    'book-marketing-services'          => ['bg' => $F . 'Self-Publishing Dashboard Workspace.png',  'vis' => 'books',  'proc' => 'pin',   'proof' => 'stores',  'order' => ['sig', 'get', 'intro', 'types', 'cta', 'proc', 'proof', 'faq', 'more']],
    'audiobook-services'               => ['bg' => $F . 'Cinematic Book Design Workspace.png',      'vis' => 'wave',   'proc' => 'track', 'proof' => 'none',    'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'faq', 'more']],
    'blog-writing-services'            => ['bg' => $F . 'Crafting Stories at the Writing Desk.png', 'vis' => 'doc',    'proc' => 'rows',  'proof' => 'none',    'order' => ['intro', 'sig', 'types', 'cta', 'proc', 'faq', 'more']],
    'website-content-writing-services' => ['bg' => $J . 'Remote Project Discussion on Google Meet.png', 'vis' => 'browser', 'proc' => 'track', 'proof' => 'none', 'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'faq', 'more']],
    'book-cover-design-services'       => ['bg' => $F . 'Cinematic Book Design Workspace.png',      'vis' => 'fan',    'proc' => 'rows',  'proof' => 'shelf',   'order' => ['sig', 'proof', 'get', 'intro', 'types', 'cta', 'proc', 'faq', 'more']],
    'video-book-trailer-services'      => ['bg' => $SF,                                             'vis' => $SF, 'proc' => 'track', 'proof' => 'shelf',   'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'faq', 'more']],
    'author-website-design-services'   => ['bg' => $J . 'Cozy InDesign Book Layout Workspace.png',  'vis' => 'browser', 'proc' => 'rows', 'proof' => 'clients', 'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'proof', 'faq', 'more']],
    'article-writing-services'         => ['bg' => $J . 'Book Project Proposal Workspace.png',      'vis' => 'doc',    'proc' => 'track', 'proof' => 'none',    'order' => ['sig', 'intro', 'types', 'cta', 'proc', 'faq', 'more']],
];
$P = $plans[$d['slug']] ?? ['bg' => $F . 'Crafting Stories at the Writing Desk.png', 'vis' => 'books', 'proc' => 'rows', 'proof' => 'none', 'order' => ['intro', 'sig', 'types', 'cta', 'proc', 'faq', 'more']];
if ($P['proc'] === 'pin' && count($d['process']['steps']) > 8) $P['proc'] = 'track';
// Services linked from copy we no longer show (about / why / compare) join the related list, so internal links are kept.
$have = array_merge([$d['slug']], array_column($beyond, 'slug'));
preg_match_all('/\[\[([a-z0-9-]+)\|/', json_encode([$d['about'] ?? null, $d['why'] ?? null, $d['compare'] ?? null]), $m);
foreach (array_unique($m[1]) as $sl) if (!in_array($sl, $have, true) && ($x = sub_by_slug($sl))) { $beyond[] = $x; $have[] = $sl; }
$typesMode = !empty($d['types']) && count($d['types']['items']) > 8 ? 'picker' : 'rows';
$flip = (bool)($seed % 2);

$blocks = [
    'intro' => fn() => sv_intro($d, $P['vis'], $flip, $seed),
    'sig'   => fn() => sv_sig($d['slug'], $seed),
    'sig2'  => fn() => str_replace('sv-sig', 'sv-sig2', sv_sig($d['slug'] . '#2', $seed)),
    'get'   => fn() => sv_get($d['slug'], $seed),
    'types' => fn() => sv_types($d, $typesMode),
    'proc'  => fn() => sv_process($d, $P['proc'], $quote, $help),
    'cta'   => fn() => sv_cta(sv_em($d['cta1']), '', $quote, $help, 'orange', $seed),
    'proof' => fn() => sv_proof($P['proof']),
    'faq'   => fn() => sv_faq($d),
    'more'  => fn() => sv_more($d, $beyond),
];
?>
<div class="page active svx svx-<?= e($d['cat']) ?>" data-page="service">
<?= sv_hero($d, $cat, $P['bg'], $quote, $help) ?>
<?php foreach ($P['order'] as $b) echo $blocks[$b](); ?>
<?= sv_close($d, $quote, $help, $seed) ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
