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
    'lp' => true, 'ad' => true, 'adx' => 'light', 'ad_btn' => 'Get a Free Quote',
    'title' => 'Book Publishing Services: Publish on Amazon from ' . $from . ' | AMZ United Press',
    'description' => 'Your book professionally published on Amazon KDP and 10+ stores: proofreading, formatting, free 3D cover, ISBN and upload. From ' . $from . '. Keep 100% of your royalties.',
    'path' => '/lp/book-publishing', 'nav' => '',
    'schema' => lp_schema('Book Publishing Packages', 'Professional book publishing on Amazon KDP and other stores, including proofreading, formatting, cover design, ISBN and upload.', '/lp/book-publishing', $FAQ, $from),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-book-publishing">

<!-- 1. Hero: headline between real book covers -->
<section class="x-bhero" aria-labelledby="lp-h1">
  <div class="x-bks" aria-hidden="true">
  <?php foreach ([['1%', '14%', -10, 0], ['10%', '52%', 8, 3], ['-2%', '70%', -4, 6], ['84%', '8%', 9, 1], ['91%', '44%', -8, 4], ['80%', '64%', 6, 7]] as $b): ?>
    <img src="<?= e(ad_cover($w[$b[3] % count($w)])) ?>" alt="" style="left:<?= $b[0] ?>;top:<?= $b[1] ?>;transform:rotate(<?= $b[2] ?>deg)">
  <?php endforeach; ?>
  </div>
  <div class="x-w x-nw">
    <p class="x-eyebrow" style="color:var(--x-or2)">Done-for-you book publishing</p>
    <h1 class="x-h1" id="lp-h1">All the support of a publishing house. <span class="a">None of the downside.</span></h1>
    <p class="x-sub">Work with a full publishing team (editors, designers and KDP specialists) and keep 100% of your rights, your royalties and your creative control.</p>
    <?= x_cta('Get my free publishing quote', '<b>Packages from ' . e($from) . '.</b> One-time fee, written quote first.') ?>
  </div>
  <div class="x-w x-blogos"><?= x_logos('Your book on the stores readers use') ?></div>
</section>

<!-- 2. Numbers + video -->
<section class="x-lsec" aria-labelledby="vd-h"><div class="x-w">
  <div class="x-head"><h2 class="x-h2" id="vd-h">Your book. Published professionally. <span class="a x-acc">In as little as 2 weeks.</span></h2></div>
  <div class="x-stats">
    <div class="col">
      <div class="x-stat big ad-rv"><small>Books published</small><b><?= e($st[0][0] . $st[0][1]) ?></b><p>Fiction, nonfiction, memoir, children’s books and more, across <?= e($st[2][0]) ?> genres.</p></div>
      <div class="row">
        <div class="x-stat ad-rv" style="--d:1"><small>Authors served</small><b><?= e($st[1][0] . $st[1][1]) ?></b><p>First-time authors and seasoned self-publishers.</p></div>
        <div class="x-stat ad-rv" style="--d:2"><small>Your royalties</small><b>100%</b><p>Paid by Amazon straight to you. We never take a cut.</p></div>
      </div>
    </div>
    <?= ad_video('publishing', 'How it works · 20 sec', 'Short video: how AMZ United Press takes a manuscript from proofreading to a live Amazon listing') ?>
  </div>
</div></section>

<!-- 3. Traditional vs us -->
<section class="x-lsec sand" aria-labelledby="cp-h"><div class="x-w">
  <div class="x-head"><p class="x-eyebrow">Why AMZ United Press</p><h2 class="x-h2" id="cp-h">The best of traditional publishing. <span class="a">Without the worst of it.</span></h2>
    <p class="x-sub">Traditional and vanity publishers often take your rights, a share of your royalties and the final say on your cover. We give you the same professional team, with the freedom of self-publishing.</p></div>
  <?= ad_compare(['Traditional publisher', 'What they give you', [['Professional editing', true], ['Cover design', true], ['Formatting', true], ['Distribution', true], ['You keep your rights', false], ['You keep 100% of royalties', false], ['Final say on your cover', false], ['Published in weeks, not years', false]]],
                 ['AMZ United Press', 'What we give you', [['Professional editing', true], ['Cover design', true], ['Formatting', true], ['Distribution to 10+ stores', true], ['You keep your rights', true], ['You keep 100% of royalties', true], ['Final say on everything', true], ['Live in as little as 1–2 weeks', true]]]) ?>
  <p class="x-quote">“You’ve worked too hard on your story to hand it, and its earnings, to someone else.”</p>
  <?= x_cta('Get my free quote', 'No commitment. Just clarity and a written price.') ?>
</div></section>

<!-- 4. Author success plan -->
<section class="x-dsec" aria-labelledby="pl-h"><div class="x-w">
  <div class="x-head"><h2 class="x-h2" id="pl-h">Your author <span class="a i x-acc">success plan.</span></h2>
    <p class="x-sub">Whether your manuscript is finished, still being edited, or you published a book that isn’t selling, we have a plan for you.</p></div>
  <div class="x-plan">
  <?php $C = [['pen', 'Proofreading & editing', 'Spelling, grammar, consistency and flow checked line by line, so reviewers talk about your story, not your typos.'], ['layout', 'Formatting & typesetting', 'Kindle, EPUB, paperback and hardcover interiors with the right trim size, margins and chapter styling.'], ['book', 'Cover design', 'A free 3D cover designed for your genre, readable as a tiny thumbnail and sharp as a printed wrap.'], ['tag', 'ISBN, keywords & categories', 'ISBN and barcode, title, subtitle, description, categories and keywords researched for discoverability.'], ['globe', 'Amazon KDP & 10+ stores', 'We set up or connect your accounts and publish on Amazon, Apple Books, Barnes & Noble, Kobo and more.']];
  foreach ($C as $i => $c): ?><div class="ad-rv" style="--d:<?= $i % 3 ?>"><?= ad_i($c[0]) ?><h3><?= e($c[1]) ?></h3><p><?= e($c[2]) ?></p></div><?php endforeach; ?>
    <div class="hl ad-rv" style="--d:2"><?= ad_i('users') ?><h3>One project manager, start to finish</h3><p>A real person who keeps you updated, answers your questions and makes sure nothing slips.</p><a href="#book" data-lp-cta>Get my free quote</a></div>
  </div>
</div></section>

<!-- 5. The problem -->
<section class="x-lsec" aria-labelledby="pr-h"><div class="x-w ad-split">
  <div class="ad-photo ad-rv"><?= ad_img('writing', 'An author’s desk with a finished manuscript') ?><span class="badge"><i>DRAFT</i>manuscript_final_v7.docx</span></div>
  <div class="ad-rv" style="--d:1">
    <p class="x-eyebrow">Sound familiar?</p>
    <h2 class="x-h2" id="pr-h" style="text-align:left">The book is written. <span class="a x-acc">Now what?</span></h2>
    <p class="x-sub" style="margin-left:0">Finishing a manuscript feels like the finish line. Then you open the KDP dashboard and a whole new list of questions appears:</p>
    <ul class="ad-chips" style="margin-top:16px"><li>Which trim size?</li><li>EPUB or KPF?</li><li>Why was my file rejected?</li><li>Do I need an ISBN?</li><li>Which categories?</li><li>What keywords?</li><li>How do I price it?</li></ul>
    <p class="x-sub" style="margin-left:0">Most authors lose weeks here, or publish a book that looks home-made next to the competition. <b style="color:var(--tx)">You don’t have to.</b></p>
  </div>
</div></section>

<!-- 6. Books -->
<section class="x-dsec" aria-labelledby="bk-h"><div class="x-w">
  <div class="x-head"><h2 class="x-h2" id="bk-h">Published by <span class="a i x-acc">AMZ United Press</span> authors.</h2>
    <p class="x-sub">Real books, real authors, real readers. <b class="x-strong">Will yours be next?</b></p></div>
  <div class="x-shelf">
  <?php foreach (array_slice($w, 0, 6) as $i => $b): $rv = (int)($b['reviews'] ?? 0); ?>
    <figure class="ad-rv" style="--d:<?= $i ?>"><img src="<?= e(ad_cover($b)) ?>" alt="<?= e($b['t'] . ' by ' . $b['by']) ?>" loading="lazy"><figcaption><b style="margin-top:14px"><?= e($b['t']) ?></b><?= e($b['by']) ?><?= $rv ? ' · ' . e(number_format($rv)) . ($rv === 1 ? ' Amazon review' : ' Amazon reviews') : '' ?></figcaption></figure>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- 7. Packages -->
<section class="x-lsec sand" id="packages" aria-labelledby="pk-h"><div class="x-w">
  <div class="x-head"><p class="x-eyebrow">Publishing packages</p><h2 class="x-h2" id="pk-h">Simple pricing. <span class="a x-acc">No royalty splits.</span></h2>
    <p class="x-sub">One-time fees, everything listed. Pick a package or ask us which one fits your book.</p></div>
  <?= ad_plans() ?>
  <p class="x-c" style="margin-top:34px;color:var(--tx2)">Not sure which one fits? <a href="#book" data-lp-cta style="font-weight:700">Get a free recommendation</a> or call <a href="tel:<?= e(tel_href()) ?>" data-lp-call style="font-weight:700"><?= e(site('phone')) ?></a>.</p>
</div></section>

<!-- 8. What happens next -->
<section class="x-dsec" aria-labelledby="nx-h"><div class="x-w">
  <div class="x-head"><p class="x-eyebrow" style="color:var(--x-or2)">Ready to get started?</p><h2 class="x-h2" id="nx-h">Here’s exactly <span class="a i x-acc">what happens next.</span></h2>
    <p class="x-sub">No pitch decks. No pressure. Just an honest conversation about your book and the clearest path to publishing it.</p></div>
  <ol class="x-next">
  <?php foreach ([['Tell us about your book', 'Fill in the short form. It takes about a minute and no preparation is needed.'], ['We map out your path', 'A publishing specialist reviews your goals and recommends the right package, with a written quote.'], ['Decide what’s right for you', 'No hard close and no follow-up pressure. If we’re a fit, we start. The next move is always yours.']] as $i => $s): ?>
    <li class="ad-rv" style="--d:<?= $i ?>"><span class="n"><?= $i + 1 ?></span><h3><?= e($s[0]) ?></h3><p><?= e($s[1]) ?></p></li>
  <?php endforeach; ?>
  </ol>
  <p class="x-promise">If AMZ United Press is the right fit, we’ll tell you which package makes sense and why. <em>If it isn’t, we’ll tell you that too.</em></p>
  <?= x_cta('Get my free publishing quote', 'No obligation. Honest advice.') ?>
</div></section>

<!-- 9. FAQ -->
<section class="x-lsec" aria-labelledby="fq-h"><div class="x-w">
  <div class="x-head"><h2 class="x-h2" id="fq-h">Questions authors ask <span class="a x-acc">before they publish.</span></h2></div>
  <?= x_faq($FAQ) ?>
</div></section>

<!-- 10. Form -->
<section class="x-lsec sand" aria-labelledby="qt-h"><div class="x-w">
  <?= x_formsec('qt-h', 'Let’s get your book <span class="a x-acc">on Amazon.</span>', 'Tell us about your manuscript and where you want to sell it. We’ll reply within one business day with a recommended package and a written quote.',
      ['Packages from ' . $from . ', one-time fee', 'Free 3D cover, ISBN and barcode', '100% of your rights and royalties', 'Live in as little as 1–2 weeks'],
      ['lp-form', 'Get your free publishing quote', 'Tell us about your book. We’ll recommend the right package and send a written quote.', 3]) ?>
</div></section>

<?= ad_dock('Free quote') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
