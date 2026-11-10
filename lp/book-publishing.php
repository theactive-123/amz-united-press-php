<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';
require dirname(__DIR__) . '/includes/adx.php';

$PL = data('prices');
$from = $PL[0]['p'];
$st = data('stats');
$w = data('work');
$FAQ = [
    ['How much does it cost to publish my book?', 'Our publishing packages start at ' . $from . ' as a one-time fee. The Economical Author Package covers proofreading, formatting, an ebook and paperback on Amazon, a free 3D cover, ISBN and barcode. You get a written quote before we start. There are no royalty splits and no hidden fees.'],
    ['Do I keep my rights and royalties?', 'Yes, 100% of both. Your book is published under your name, on KDP and store accounts registered to you, and Amazon pays royalties straight to you. We never take a percentage of your sales.'],
    ['How long does it take to publish my book?', 'Once your manuscript is ready, most books go live on Amazon within one to two weeks. Wider distribution to other stores usually takes two to three weeks. You approve every file before anything is submitted.'],
    ['Do I need a finished manuscript?', 'For publishing, yes. If you only have an idea, notes or a first draft, we also offer ghostwriting and editing, and we can include them in your quote.'],
    ['What if I don’t have a cover yet?', 'Every package includes a free 3D book cover design. The Author Choice and Author Bestseller packages include unlimited revisions until you love it.'],
    ['Which stores will my book be sold in?', 'Every package publishes on Amazon. Author Choice publishes on the top 5 platforms and Author Bestseller on 10+ platforms, including Apple Books, Barnes & Noble, Kobo and Google Play.'],
    ['Why not just upload it to KDP myself?', 'You can, and uploading is free. What you pay us for is getting it right the first time: files that pass review, a professional cover, researched keywords and categories, and a listing built to sell, without weeks of trial and error.'],
    ['Will you help me sell the book after launch?', 'The Author Bestseller package includes press releases and social media page creation. Book marketing and Amazon Ads management can be added to any package.'],
];
$meta = [
    'lp' => true, 'ad' => true, 'adx' => 'dark', 'ad_btn' => 'Free Quote',
    'title' => 'Book Publishing Services: Publish on Amazon from ' . $from . ' | AMZ United Press',
    'description' => 'Your book professionally published on Amazon KDP and 10+ stores: proofreading, formatting, free 3D cover, ISBN and upload. From ' . $from . '. Keep 100% of your royalties.',
    'path' => '/lp/book-publishing', 'nav' => '',
    'schema' => lp_schema('Book Publishing Packages', 'Professional book publishing on Amazon KDP and other stores, including proofreading, formatting, cover design, ISBN and upload.', '/lp/book-publishing', $FAQ, $from),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-book-publishing">

<!-- 1. Hero (dark) -->
<section class="x-hero" aria-labelledby="lp-h1">
  <?= x_deco() ?>
  <div class="x-w x-nw">
    <p class="x-label">Done-for-you book publishing</p>
    <h1 class="x-h1" id="lp-h1">Your book, professionally published. <span class="a">Every royalty stays yours.</span></h1>
    <p class="x-sub">The full team of a publishing house (editors, designers and KDP specialists) without signing away your rights. We prepare, publish and list your book on Amazon and 10+ stores, under your name.</p>
    <span class="x-hl x-acc">Live on Amazon in as little as 2 weeks.</span>
    <p class="x-pill"><?= ad_i('tag') ?>Packages from <?= e($from) ?> · one-time fee · written quote first</p>
  </div>
  <div class="x-w">
    <div class="x-frame"><?= ad_video('publishing', 'How it works · 20 sec', 'Short video: how AMZ United Press takes a manuscript from proofreading to a live Amazon listing') ?></div>
    <div class="x-nums"><div><b class="x-acc"><?= e($st[0][0] . $st[0][1]) ?></b><span>Books published</span></div><div><b class="x-acc"><?= e($st[1][0] . $st[1][1]) ?></b><span>Authors served</span></div><div><b class="x-acc">10+</b><span>Stores</span></div><div><b class="x-acc">100%</b><span>Royalties to you</span></div></div>
    <?= x_cta('Get my free publishing quote', '<b>Free and no obligation.</b> A real person replies within one business day.') ?>
  </div>
</section>

<section class="x-logos"><div class="x-w"><?= x_logos('Your book on the stores readers use') ?></div></section>

<!-- 2. The problem (light) -->
<section class="x-sec lt" aria-labelledby="pr-h"><div class="x-w">
  <?= x_head('pr-h', 'The book is written. <span class="a">Now what?</span>', 'Sound familiar?') ?>
  <div class="x-prob">
    <div class="ad-rv">
      <p class="lead">Finishing a manuscript feels like the finish line.</p>
      <p>Then you open the KDP dashboard, and <span class="hi">a whole new list of questions appears:</span></p>
      <ul class="x-chips"><li>Which trim size?</li><li>EPUB or KPF?</li><li>Why was my file rejected?</li><li>Do I need an ISBN?</li><li>Which categories?</li><li>What keywords?</li><li>How do I price it?</li></ul>
      <p style="margin-top:22px">Most authors lose weeks here, or publish a book that looks home-made next to the competition. <b class="x-strong">You don’t have to.</b></p>
    </div>
    <figure class="x-photo ad-rv" style="--d:1;margin:0"><?= ad_img('writing', 'An author’s desk with a finished manuscript') ?><i>manuscript_final_v7.docx</i></figure>
  </div>
</div></section>

<!-- 3. Publisher vs us (dark) -->
<section class="x-sec b2 glow" aria-labelledby="cp-h"><span class="x-edge" aria-hidden="true"></span><div class="x-w">
  <?= x_head('cp-h', 'Everything a publisher gives you. <span class="a">Without giving up your book.</span>', '', 'Traditional and vanity publishers often take your rights, a share of your royalties and the final say on your cover. <b class="x-strong">We give you the same professional team, and you stay the publisher.</b>') ?>
  <?= x_vs(['Traditional publisher', 'What they take', ['Your rights, often for years', 'A share of every royalty', 'The final say on your cover', 'Control of your price', 'Months or years to publish']],
           ['AMZ United Press', 'What you keep', ['100% of your rights', '100% of your royalties', 'Final approval on every file', 'Your price, your accounts', 'Live in as little as 1–2 weeks']]) ?>
  <?= x_cta('Get my free quote', 'You’ve spent months, maybe years, on this book. <b>Its earnings should be yours.</b>') ?>
</div></section>

<!-- 4. What we handle (light) -->
<section class="x-sec lt sand" aria-labelledby="wh-h"><div class="x-w">
  <?= x_head('wh-h', 'A complete publishing team, <span class="a">working for you.</span>', 'What we handle', 'Everything between your manuscript and a live listing, done by specialists and managed by one person who knows your book.') ?>
  <?= ad_cards([
      ['editing', 'Proofreading & editing', 'A clean, professional read', 'Spelling, grammar, consistency and flow checked line by line, so reviewers talk about your story, not your typos.'],
      ['layout', 'Formatting & typesetting', 'Files that pass review', 'Kindle, EPUB, paperback and hardcover interiors with the right trim size, margins and chapter styling.'],
      ['showcase', 'Cover design', 'A cover that sells', 'A free 3D cover designed for your genre, readable as a tiny thumbnail and sharp as a printed wrap.'],
      ['proposal', 'ISBN & metadata', 'Built to be found', 'ISBN and barcode, title, subtitle, description, categories and keywords researched for discoverability.'],
      ['kdp', 'Amazon KDP & 10+ stores', 'Published in your name', 'We set up or connect your accounts and publish on Amazon, Apple Books, Barnes & Noble, Kobo and more.'],
      ['call', 'Project manager', 'One person, start to finish', 'A real person who keeps you updated, answers your questions and makes sure nothing slips.'],
  ]) ?>
</div></section>

<!-- 5. How it works (dark) -->
<section class="x-sec" aria-labelledby="hw-h"><div class="x-w">
  <?= x_head('hw-h', 'From manuscript to Amazon <span class="a">in four steps.</span>') ?>
  <ol class="x-flow">
  <?php $F = [['Free 30-minute call', 'Tell us about your book', 'Your manuscript, your goals and where you want to sell. You get a written quote and timeline, and nothing starts until you say yes.'], ['Proofread & formatted', 'We prepare your book', 'Editors proofread, designers create your 3D cover, and formatters build every file: Kindle, EPUB, paperback and hardcover.'], ['You approve everything', 'You review the files', 'You see the interior, cover and full listing before anything goes live. Ask for changes, and we make them.'], ['Live on Amazon', 'We publish, you earn', 'We publish on the stores in your package, check every listing and send you the live links. Royalties go straight to you.']];
  foreach ($F as $i => $f): ?><li class="ad-rv" style="--d:<?= $i ?>"><b>0<?= $i + 1 ?></b><small><?= e($f[0]) ?></small><h3><?= e($f[1]) ?></h3><p><?= e($f[2]) ?></p></li><?php endforeach; ?>
  </ol>
  <?= x_cta('Start with a free call') ?>
</div></section>

<!-- 6. Packages (light) -->
<section class="x-sec lt" id="packages" aria-labelledby="pk-h"><div class="x-w">
  <?= x_head('pk-h', 'Simple pricing. <span class="a">No royalty splits.</span>', 'Publishing packages', 'One-time fees, everything listed. Pick a package or ask us which one fits your book.') ?>
  <?= ad_plans() ?>
  <p class="x-c" style="margin-top:34px">Not sure which one fits? <a href="#book" data-lp-cta style="font-weight:700;color:var(--tx)">Get a free recommendation</a> or call <a href="tel:<?= e(tel_href()) ?>" data-lp-call style="font-weight:700;color:var(--tx)"><?= e(site('phone')) ?></a>.</p>
</div></section>

<!-- 7. Books & authors (dark) -->
<section class="x-sec b2 glow" aria-labelledby="bk-h"><span class="x-edge" aria-hidden="true"></span><div class="x-w">
  <?= x_head('bk-h', 'Real books. Real authors. <span class="a">Will yours be next?</span>', '', 'Books published with AMZ United Press, with their real Amazon review counts.') ?>
  <div class="x-shelf">
  <?php foreach (array_slice($w, 0, 6) as $i => $b): $rv = (int)($b['reviews'] ?? 0); ?>
    <figure class="ad-rv" style="--d:<?= $i ?>"><img src="<?= e(ad_cover($b)) ?>" alt="<?= e($b['t'] . ' by ' . $b['by']) ?>" loading="lazy"><figcaption><b style="margin-top:14px"><?= e($b['t']) ?></b><?= e($b['by']) ?><?= $rv ? ' · ' . e(number_format($rv)) . ($rv === 1 ? ' Amazon review' : ' Amazon reviews') : '' ?></figcaption></figure>
  <?php endforeach; ?>
  </div>
  <div class="x-authors" style="margin-top:clamp(40px,5vw,60px)"><?php foreach (array_slice(ad_authors_list(), 0, 5) as $i => $a): ?><img class="ad-rv" style="--d:<?= $i ?>" src="<?= e(ad_src($a . '.webp')) ?>" alt="An AMZ United Press author holding their published book" loading="lazy"><?php endforeach; ?></div>
</div></section>

<!-- 8. Quote form (dark) -->
<section class="x-sec line" aria-labelledby="qt-h"><div class="x-w">
  <?= x_formsec('qt-h', 'Let’s get your book <span class="a">on Amazon.</span>', 'Tell us about your manuscript and where you want to sell it. We’ll reply within one business day with a recommended package and a written quote.',
      ['Packages from ' . $from . ', one-time fee', 'Free 3D cover, ISBN and barcode', '100% of your rights and royalties', 'Nothing published without your approval'],
      ['lp-form', 'Get your free publishing quote', 'Tell us about your book. We’ll recommend the right package and send a written quote.', 3], 'Free quote') ?>
</div></section>

<!-- 9. FAQ (light) -->
<section class="x-sec lt sand" aria-labelledby="fq-h"><div class="x-w">
  <?= x_head('fq-h', 'Questions authors ask <span class="a">before they publish.</span>') ?>
  <?= x_faq($FAQ) ?>
</div></section>

<!-- 10. Final (dark) -->
<section class="x-sec" aria-labelledby="fn-h"><div class="x-w">
  <?= x_final('Your book deserves <span class="a">to be read.</span>', 'You’ve done the hard part. Let a professional team handle the rest, while you keep every right and every royalty.',
      ['Proofreading', 'Formatting', 'Free 3D cover', 'ISBN & barcode', 'Amazon KDP', '10+ stores'], 'Packages from ' . e($from) . '. One-time fee. 100% of royalties to you.', 'Get my free publishing quote', 'No obligation. <b>A written quote before anything starts.</b>') ?>
</div></section>

<?= ad_dock('Free quote') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
