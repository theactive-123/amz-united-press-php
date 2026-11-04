<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/kx.php';

$PL = data('prices');
$from = $PL[0]['p'];
$FAQ = [
    ['How much does it cost to publish my book?', 'Our publishing packages start at ' . $from . '. The Economical Author Package covers proofreading, formatting, an ebook and paperback on Amazon, a free 3D cover, ISBN and barcode. You get a written quote before we start, with no royalty splits or hidden fees.'],
    ['How long does it take to publish my book?', 'Once your manuscript is ready, most books go live on Amazon within one to two weeks. Wider distribution to other stores usually takes two to three weeks.'],
    ['Do I keep my rights and royalties?', 'Yes, 100%. Your book is published under your own name, on your own KDP and store accounts. We never take a percentage of your sales.'],
    ['Do I need a finished manuscript?', 'For publishing, yes. If you only have an idea or a draft, we also offer ghostwriting and editing, and can include them in your quote.'],
    ['What if I don’t have a cover?', 'Every package includes a free 3D book cover design. The Author Choice and Author Bestseller packages include unlimited revisions.'],
    ['Which stores will my book be sold in?', 'Amazon in every package. Author Choice publishes on the top 5 platforms and Author Bestseller on 10+ platforms, including Apple Books, Barnes & Noble, Kobo and Google Play.'],
];
$meta = [
    'lp' => true, 'kx' => true, 'kx_btn' => 'Get Free Quote',
    'title' => 'Publish Your Book on Amazon from ' . $from . ' | AMZ United Press',
    'description' => 'Professional book publishing on Amazon KDP and 10+ stores: proofreading, formatting, free 3D cover, ISBN and upload. Packages from ' . $from . '. Keep 100% of your royalties.',
    'path' => '/lp/book-publishing', 'nav' => '',
    'schema' => lp_schema('Book Publishing Packages', 'Book publishing on Amazon KDP and other stores, including proofreading, formatting, cover design, ISBN and upload.', '/lp/book-publishing', $FAQ, $from),
];
$w = data('work');
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-book-publishing">

<!-- Hero: offer + form above the fold -->
<section class="kx-hero" aria-labelledby="lp-h1">
  <?= kx_stars() ?><?= kx_ring() ?>
  <div class="kx-w">
    <p class="kx-kick">Book publishing packages from <?= e($from) ?></p>
    <h1 class="kx-h1" id="lp-h1">Publish your book on Amazon.<br><span class="lime">Keep 100% of your royalties.</span></h1>
    <p class="kx-hero-p">We Proofread, Format, Design Your Cover And Publish Your Ebook And Paperback On Amazon KDP And 10+ Stores, Under Your Name.</p>
    <p class="kx-sub" style="font-family:Inter,sans-serif;font-weight:700;text-transform:uppercase">Free 3D Cover. ISBN Included. Live In 1–2 Weeks.</p>
    <div class="kx-hsplit">
      <div class="kx-media kx-rv" style="padding:12px"><div class="kx-media-in" style="background:radial-gradient(60% 60% at 50% 40%,rgba(184,232,46,.25),transparent 70%),#0B1418">
        <div class="kx-shelf" aria-hidden="true"><?php foreach ([[2, -10, 18, 1], [4, -4, 4, 2], [6, 0, -8, 3], [7, 5, 4, 2], [8, 10, 18, 1]] as $b): ?><span style="--r:<?= $b[1] ?>deg;--y:<?= $b[2] ?>px;--z:<?= $b[3] ?>"><img src="<?= e(lp_img($w[$b[0]]['image'])) ?>" alt=""></span><?php endforeach; ?></div>
        <span class="kx-media-badge">Real books we published</span></div></div>
      <div class="kx-form kx-rv" style="--d:1" id="book"><?= render_form('lp-form', 'Get your free publishing quote', 'Tell us about your book. A real person replies within one business day.', 'landing', 'Get My Free Quote', 3) ?></div>
    </div>
    <?= kx_logos() ?>
  </div>
</section>
<div class="kx-bar" aria-hidden="true"></div>

<!-- Packages -->
<section class="kx-sec" id="packages" aria-labelledby="pk-h"><div class="kx-w">
  <div class="kx-center"><p class="kx-kick">Publishing packages</p></div>
  <h2 class="kx-h2" id="pk-h" style="margin-top:20px">Choose the package that’s right<br><span class="lime">for your book.</span></h2>
  <p class="kx-p">Clear prices, everything listed. You keep every right and every royalty.</p>
  <div class="kx-plans">
  <?php foreach ($PL as $i => $p): ?>
    <article class="kx-plan<?= $p['f'] ? ' hot' : '' ?> kx-rv" style="--d:<?= $i ?>">
      <?php if ($p['f']): ?><span class="tag">Most popular</span><?php endif; ?>
      <h3><?= e($p['t']) ?></h3><p class="price"><?= e($p['p']) ?></p>
      <ul><?php foreach ($p['l'] as $x): ?><li><?= kx_i('check') ?><span><?= e($x) ?></span></li><?php endforeach; ?></ul>
      <a class="kx-btn" href="#book" data-lp-cta data-pkg="<?= e($p['t']) ?>">Get Started</a>
    </article>
  <?php endforeach; ?>
  </div>
  <p class="kx-p" style="margin-top:34px">Not sure which one fits? <a href="#book" data-lp-cta style="color:var(--lime)">Ask for a free recommendation</a> or call <a href="tel:<?= e(tel_href()) ?>" data-lp-call style="color:var(--lime)"><?= e(site('phone')) ?></a>.</p>
</div></section>

<!-- Problem -->
<section class="kx-sec" aria-labelledby="pr-h" style="padding-top:0"><div class="kx-w">
  <hr class="kx-rule" style="margin-bottom:clamp(50px,6vw,80px)">
  <div class="kx-center"><p class="kx-kick">Why authors get stuck</p></div>
  <h2 class="kx-h2" id="pr-h" style="margin-top:20px">Writing the book was hard.<br><span class="lime">Publishing it shouldn’t be.</span></h2>
  <div class="kx-prob kx-w kx-narrow" style="padding:0">
    <div class="kx-prob-txt kx-rv">
      <h3>You finished your manuscript.</h3>
      <p>Then you open the KDP dashboard.</p>
      <p class="lime">And the questions start.</p>
      <p>Suddenly you need to figure out:</p>
      <ul class="kx-chips"><?php foreach (['Trim size and margins' => -2, 'EPUB vs. Kindle files' => 1.5, 'A cover that fits the template' => -1.5, 'ISBN and barcode' => 1, 'Keywords and categories' => -1, 'Pricing and royalties' => 1.5, 'Why the upload got rejected' => -1] as $c => $r): ?><li style="--r:<?= $r ?>deg"><?= e($c) ?></li><?php endforeach; ?></ul>
    </div>
    <div class="kx-live kx-rv" style="--d:1"><span class="kx-stamp" style="color:#3BA55C;border-color:#3BA55C">LIVE</span><h3>We handle all of it. Your book goes <span class="lime">live in 1–2 weeks.</span></h3></div>
  </div>
</div></section>

<!-- Steps -->
<section class="kx-sec n2" aria-labelledby="st-h"><div class="kx-w">
  <h2 class="kx-h2" id="st-h" style="font-size:clamp(1.8rem,3.4vw,2.6rem);margin-bottom:10px">From manuscript to Amazon.</h2>
  <p class="kx-h2" style="margin-bottom:20px"><span class="lime">One team, one clear price.</span></p>
  <?= kx_rows([['Free consultation', 'Tell us about your book. You get a written quote and timeline.'], ['Proofreading & editing', 'Spelling, grammar and consistency checked so readers see a clean book.'], ['Formatting & cover', 'Kindle, EPUB and print files, plus a free 3D cover sized for every store.'], ['ISBN & listing', 'ISBN and barcode, title, description, keywords, categories and pricing.'], ['You approve', 'Review the interior, cover and listing. Nothing goes live without your OK.'], ['Publish & earn', 'We publish on Amazon and other stores. Royalties go straight to you.']]) ?>
</div></section>

<!-- With / without -->
<section class="kx-sec n2" aria-labelledby="vs-h" style="padding-top:0"><span class="kx-glowdome" aria-hidden="true"></span><div class="kx-w" style="padding-top:clamp(100px,10vw,150px)">
  <h2 class="kx-h2 nc" id="vs-h" style="font-size:clamp(1.8rem,3vw,2.5rem)">From doing it alone to a<br><span class="lime">professional launch</span></h2>
  <div class="kx-vs">
    <div class="kx-rv"><h3>Doing it yourself</h3><ul><?php foreach (['Learning KDP settings from scratch', 'Rejected files and formatting errors', 'A cover that looks home-made', 'Guessing keywords and categories', 'Hiring separate freelancers', 'Weeks lost to trial and error'] as $x): ?><li><span class="x" aria-hidden="true">✕</span><?= e($x) ?></li><?php endforeach; ?></ul></div>
    <div class="kx-rv" style="--d:1"><h3>With AMZ United Press</h3><ul><?php foreach (['Files that pass review first time', 'Free professional 3D cover', 'Researched keywords & categories', 'One team, one project manager', 'Live in as little as 1–2 weeks', '100% of your rights and royalties'] as $x): ?><li><span class="ok"><?= kx_i('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>
<div class="kx-bar" aria-hidden="true"></div>

<!-- Authors -->
<section class="kx-proof" aria-labelledby="ar-h"><div class="kx-w">
  <h2 class="kx-h2" id="ar-h" style="font-size:clamp(1.6rem,2.8vw,2.3rem);margin:0">Authors who published<br><span class="lime">with AMZ United Press</span></h2></div>
  <?= kx_authors() ?>
</section>

<!-- FAQ -->
<?= kx_faqsec('The questions authors ask right before they <span class="lime">publish.</span>', $FAQ) ?>

<!-- Final -->
<section class="kx-sec blk" aria-labelledby="fn-h"><div class="kx-w"><div class="kx-final kx-rv">
  <h2 class="kx-h2 nc xl" id="fn-h" style="font-weight:700">Your book could be on Amazon <span class="lime">in 1–2 weeks.</span></h2>
  <p class="kx-hero-p" style="max-width:40em;font-weight:600">Tell Us About Your Manuscript And We’ll Recommend The Right Package With A Written Quote Within One Business Day.</p>
  <div class="kx-dots"><span>Proofreading</span><span>Formatting</span><span>3D cover</span><span>ISBN &amp; barcode</span><span>Amazon KDP</span><span>10+ stores</span><span>Project manager</span></div>
  <p class="kx-lead">Packages from <?= e($from) ?>. 100% Rights &amp; Royalties.</p>
  <a class="kx-btn nc" href="#book" data-lp-cta><?= kx_i('arrow') ?>Get my free publishing quote</a>
  <p class="kx-note b" style="font-style:normal;font-size:.8rem">Or call <?= e(site('phone')) ?></p>
</div></div></section>

<?= kx_dock('Free quote') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
