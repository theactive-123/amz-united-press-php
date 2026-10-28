<?php
require __DIR__ . '/includes/bootstrap.php';
$slug = preg_replace('/[^a-z0-9-]/', '', strtolower($_GET['slug'] ?? ''));
$d = sub_by_slug($slug);
if (!$d) { http_response_code(404); include __DIR__ . '/404.php'; exit; }
$cat    = cat_by_key($d['cat']);
$help   = help_for($d);
$beyond = array_values(array_filter(array_map('sub_by_slug', $d['beyond']['slugs'] ?? [])));
$tel    = preg_replace('/[^\d+]/', '', site('phone'));
$meta = [
    'title' => $d['title'],
    'description' => $d['desc'],
    'path' => '/services/' . $d['slug'], 'nav' => 'services', 'cat' => $d['cat'],
    'schema' => [
        breadcrumb_schema([['Home', '/'], ['Services', '/services'], [$cat['t'], '/services#cat-' . $cat['k']], [$d['name'], null]]),
        ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $d['name'], 'description' => plain($d['short']), 'serviceType' => $d['name'],
         'url' => abs_url('/services/' . $d['slug']), 'areaServed' => 'Worldwide',
         'provider' => ['@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'telephone' => site('phone'), 'email' => site('email')],
         'offers' => ['@type' => 'Offer', 'priceCurrency' => 'USD', 'price' => preg_replace('/[^\d.]/', '', $d['price']), 'description' => 'Starting price. Written quote before work begins.']],
        faq_schema($d['faq']),
    ],
];
$meta['sv'] = true;
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sv.php';

$seed  = crc32($d['slug']) % 11;
$quote = 'Interested in: ' . $d['t'];
$F = 'Fourparts/'; $J = 'From first idea to finished book/';

/* Each service has its own hero object, section order and signature section.
   intro: [layout, image]; types: rows|picker; proc: pin|rows|track; proof: shelf|clients|stores|none */
$plans = [
    'ghostwriting-services'            => ['art' => 'page',    'intro' => ['left', $F . 'Crafting Stories at the Writing Desk.png'], 'proc' => 'pin',   'proof' => 'clients', 'order' => ['intro', 'sig', 'types', 'band', 'proc', 'proof', 'faq', 'more']],
    'ebook-writing-services'           => ['art' => 'kindle',  'intro' => ['editorial'],                                        'proc' => 'track', 'proof' => 'shelf',   'order' => ['sig', 'intro', 'types', 'proc', 'band', 'proof', 'faq', 'more']],
    'fiction-writing-services'         => ['art' => 'fan',     'intro' => ['right', 'Cinematic Sci-Fi Book Cover Showcase.png'],  'proc' => 'rows',  'proof' => 'shelf',   'order' => ['sig', 'intro', 'proof', 'proc', 'band', 'faq', 'more']],
    'nonfiction-writing-services'      => ['art' => $J . 'Book Project Proposal Workspace.png', 'intro' => ['editorial'],         'proc' => 'pin',   'proof' => 'clients', 'order' => ['intro', 'sig', 'proc', 'band', 'proof', 'faq', 'more']],
    'memoir-writing-services'          => ['art' => $F . 'Crafting Stories at the Writing Desk.png', 'intro' => ['editorial'],    'proc' => 'rows',  'proof' => 'clients', 'order' => ['sig', 'intro', 'proof', 'proc', 'band', 'faq', 'more']],
    'novel-ghostwriting-services'      => ['art' => 'books',   'intro' => ['left', $F . 'Cinematic Book Design Workspace.png'],  'proc' => 'track', 'proof' => 'shelf',   'order' => ['intro', 'sig', 'proc', 'proof', 'band', 'faq', 'more']],
    'biography-writing-services'       => ['art' => $J . 'Remote Project Discussion on Google Meet.png', 'intro' => ['right', $J . 'Book Project Proposal Workspace.png'], 'proc' => 'rows', 'proof' => 'clients', 'order' => ['intro', 'sig', 'band', 'proc', 'proof', 'faq', 'more']],
    'autobiography-writing-services'   => ['art' => 'page',    'intro' => ['editorial'],                                        'proc' => 'track', 'proof' => 'clients', 'order' => ['sig', 'intro', 'proc', 'band', 'proof', 'faq', 'more']],
    'ebook-publishing-services'        => ['art' => 'kindle',  'intro' => ['left', $F . 'Self-Publishing Dashboard Workspace.png'], 'proc' => 'rows', 'proof' => 'stores', 'order' => ['proof', 'sig', 'intro', 'types', 'proc', 'band', 'faq', 'more']],
    'amazon-publishing-services'       => ['art' => $J . 'Author Workspace with KDP Publishing Dashboard.png', 'intro' => ['editorial'], 'proc' => 'pin', 'proof' => 'shelf', 'order' => ['intro', 'sig', 'proc', 'band', 'proof', 'faq', 'more']],
    'book-editing-services'            => ['art' => $F . 'Cozy Manuscript Editing Workspace.png', 'intro' => ['editorial'],        'proc' => 'rows',  'proof' => 'clients', 'order' => ['sig', 'intro', 'types', 'proc', 'band', 'proof', 'faq', 'more']],
    'proofreading-services'            => ['art' => 'marks',   'intro' => ['right', $F . 'Cozy Manuscript Editing Workspace.png'], 'proc' => 'track', 'proof' => 'none',   'order' => ['sig', 'intro', 'types', 'band', 'proc', 'faq', 'more']],
    'book-formatting-services'         => ['art' => $J . 'Cozy InDesign Book Layout Workspace.png', 'intro' => ['editorial'],      'proc' => 'rows',  'proof' => 'shelf',   'order' => ['intro', 'sig', 'types', 'proc', 'proof', 'band', 'faq', 'more']],
    'book-marketing-services'          => ['art' => 'books',   'intro' => ['left', $F . 'Self-Publishing Dashboard Workspace.png'], 'proc' => 'pin',  'proof' => 'stores',  'order' => ['intro', 'sig', 'types', 'proc', 'band', 'proof', 'faq', 'more']],
    'audiobook-services'               => ['art' => 'wave',    'intro' => ['editorial'],                                        'proc' => 'track', 'proof' => 'none',    'order' => ['sig', 'intro', 'types', 'proc', 'band', 'faq', 'more']],
    'blog-writing-services'            => ['art' => 'doc',     'intro' => ['right', $F . 'Crafting Stories at the Writing Desk.png'], 'proc' => 'rows', 'proof' => 'none', 'order' => ['intro', 'sig', 'types', 'band', 'proc', 'faq', 'more']],
    'website-content-writing-services' => ['art' => 'browser', 'intro' => ['editorial'],                                        'proc' => 'track', 'proof' => 'none',    'order' => ['sig', 'intro', 'types', 'proc', 'band', 'faq', 'more']],
    'book-cover-design-services'       => ['art' => 'fan',     'intro' => ['left', $F . 'Cinematic Book Design Workspace.png'], 'proc' => 'rows',  'proof' => 'shelf',   'order' => ['sig', 'proof', 'intro', 'types', 'proc', 'band', 'faq', 'more']],
    'video-book-trailer-services'      => ['art' => 'screen',  'intro' => ['editorial'],                                        'proc' => 'track', 'proof' => 'shelf',   'order' => ['sig', 'intro', 'types', 'proc', 'band', 'faq', 'more']],
    'author-website-design-services'   => ['art' => 'browser', 'intro' => ['right', $J . 'Cozy InDesign Book Layout Workspace.png'], 'proc' => 'rows', 'proof' => 'clients', 'order' => ['intro', 'sig', 'types', 'band', 'proc', 'proof', 'faq', 'more']],
    'article-writing-services'         => ['art' => 'doc',     'intro' => ['editorial'],                                        'proc' => 'track', 'proof' => 'none',    'order' => ['sig', 'intro', 'types', 'proc', 'band', 'faq', 'more']],
];
$P = $plans[$d['slug']] ?? ['art' => 'books', 'intro' => ['editorial'], 'proc' => 'rows', 'proof' => 'none', 'order' => ['intro', 'sig', 'types', 'proc', 'band', 'faq', 'more']];
if ($P['proc'] === 'pin' && count($d['process']['steps']) > 8) $P['proc'] = 'track';
$typesMode = !empty($d['types']) && count($d['types']['items']) > 8 ? 'picker' : 'rows';
$bandDark = in_array($d['cat'], ['edit', 'other'], true);

$blocks = [
    'intro' => fn() => sv_intro($d, $P['intro'][0], $P['intro'][1] ?? ''),
    'sig'   => fn() => sv_sig($d['slug'], $seed),
    'types' => fn() => sv_types($d, $typesMode),
    'proc'  => fn() => sv_process($d, $P['proc'], $quote, $help),
    'band'  => fn() => sv_band($d['cta1'], $quote, $help, $bandDark),
    'proof' => fn() => sv_proof($P['proof']),
    'faq'   => fn() => sv_faq($d),
    'more'  => fn() => sv_more($d, $beyond),
];
?>
<div class="page active svx svx-<?= e($d['cat']) ?>" data-page="service">
<?= sv_hero($d, $cat, $P['art'], $seed, $quote, $help) ?>
<?php foreach ($P['order'] as $b) echo $blocks[$b](); ?>
<?= sv_close($d, $help) ?>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
