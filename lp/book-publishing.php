<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';

$PL = data('prices');
$from = $PL[0]['p'];
$st = data('stats');
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
    'lp' => true, 'ad' => true, 'ad_btn' => 'Get My Free Quote',
    'title' => 'Book Publishing Services: Publish on Amazon from ' . $from . ' | AMZ United Press',
    'description' => 'Your book professionally published on Amazon KDP and 10+ stores: proofreading, formatting, free 3D cover, ISBN and upload. From ' . $from . '. Keep 100% of your royalties.',
    'path' => '/lp/book-publishing', 'nav' => '',
    'schema' => lp_schema('Book Publishing Packages', 'Professional book publishing on Amazon KDP and other stores, including proofreading, formatting, cover design, ISBN and upload.', '/lp/book-publishing', $FAQ, $from),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-book-publishing">

<!-- 1. Hero -->
<section class="ad-hero" aria-labelledby="lp-h1">
  <?= ad_float_books() ?>
  <div class="ad-w ad-hero-in">
    <div>
      <?= ad_kick('Done-for-you book publishing') ?>
      <h1 class="ad-h1" id="lp-h1">Your book, professionally published. <em>Every royalty stays yours.</em></h1>
      <p class="ad-lead">Get the full team of a publishing house (editors, designers and KDP specialists) without signing away your rights. We prepare, publish and list your book on Amazon and 10+ stores, under your name.</p>
      <ul class="ad-hero-ticks">
        <li><?= ad_i('check') ?><span>Live on Amazon in as little as 1–2 weeks</span></li>
        <li><?= ad_i('check') ?><span>Free 3D cover, ISBN and barcode in every package</span></li>
        <li><?= ad_i('check') ?><span>Packages from <?= e($from) ?>, one-time fee, written quote first</span></li>
      </ul>
      <?= ad_proof('<b>' . e($st[0][0] . $st[0][1]) . ' books</b> published for <b>' . e($st[1][0] . $st[1][1]) . ' authors</b> across ' . e($st[2][0]) . ' genres.') ?>
    </div>
    <?= ad_form('lp-form', 'Get your free publishing quote', 'Tell us about your book. We’ll recommend the right package and send a written quote.', 3) ?>
  </div>
</section>

<?= ad_logos('Your book on the stores readers use') ?>

<!-- 2. Video + numbers -->
<section class="ad-sec white" aria-labelledby="vd-h"><div class="ad-w">
  <div class="ad-head ad-c"><h2 class="ad-h2" id="vd-h">Your book. Published professionally. <em>In as little as 2 weeks.</em></h2></div>
  <div class="ad-vgrid">
    <?= ad_video('publishing', 'How it works · 20 sec', 'Short video: how AMZ United Press takes a manuscript from proofreading to a live Amazon listing') ?>
    <?= ad_vstats([['Books published', $st[0][0] . $st[0][1], 'Fiction, nonfiction, memoir, children’s books and more.'], ['Authors served', $st[1][0] . $st[1][1], 'First-time authors and seasoned self-publishers alike.'], ['Your royalties', '100%', 'Paid by Amazon straight to you. We never take a cut.']]) ?>
  </div>
</div></section>

<!-- 3. Compare -->
<section class="ad-sec sand" aria-labelledby="cp-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Why AMZ United Press', true) ?><h2 class="ad-h2" id="cp-h">Everything a publisher gives you. <em>Without giving up your book.</em></h2>
    <p class="ad-lead">Traditional and vanity publishers often take your rights, a share of your royalties and the final say on your cover. We give you the same professional team, and you stay the publisher.</p></div>
  <?= ad_compare(['Traditional publisher', 'What they give you', [['Professional editing', true], ['Cover design', true], ['Formatting', true], ['Distribution', true], ['You keep your rights', false], ['You keep 100% of royalties', false], ['Final say on your cover', false], ['Published in weeks, not years', false]]],
                 ['AMZ United Press', 'What we give you', [['Professional editing', true], ['Cover design', true], ['Formatting', true], ['Distribution to 10+ stores', true], ['You keep your rights', true], ['You keep 100% of royalties', true], ['Final say on everything', true], ['Live in as little as 1–2 weeks', true]]]) ?>
  <p class="ad-quote">“You’ve spent months, maybe years, on this book. Its earnings should be yours too.”</p>
  <div class="ad-c" style="text-align:center"><?= ad_cta('Get my free quote', 'No commitment. Just a clear plan and a written price.') ?></div>
</div></section>

<!-- 4. Problem -->
<section class="ad-sec white" aria-labelledby="pr-h"><div class="ad-w ad-split">
  <div class="ad-photo ad-rv"><?= ad_img('writing', 'An author’s desk with a finished manuscript') ?><span class="badge"><i>DRAFT</i>manuscript_final_v7.docx</span></div>
  <div class="ad-rv" style="--d:1">
    <?= ad_kick('Sound familiar?') ?>
    <h2 class="ad-h2" id="pr-h">The book is written. <em>Now what?</em></h2>
    <p class="ad-lead" style="margin-bottom:10px">Finishing a manuscript feels like the finish line. Then you open the KDP dashboard and a whole new list of questions appears:</p>
    <ul class="ad-chips"><li>Which trim size?</li><li>EPUB or KPF?</li><li>Why was my file rejected?</li><li>Do I need an ISBN?</li><li>Which categories?</li><li>What keywords?</li><li>How do I price it?</li></ul>
    <p class="ad-lead" style="margin-top:24px">Most authors lose weeks here, or publish a book that looks home-made next to the competition. <b style="color:#141413">You don’t have to.</b></p>
  </div>
</div></section>

<!-- 5. What we handle -->
<section class="ad-sec sand" aria-labelledby="wh-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('What we handle', true) ?><h2 class="ad-h2" id="wh-h">A complete publishing team, <em>working for you.</em></h2>
    <p class="ad-lead">Everything between your manuscript and a live listing, handled by specialists and managed by one person who knows your book.</p></div>
  <?= ad_cards([
      ['editing', 'Proofreading & editing', 'A clean, professional read', 'Spelling, grammar, consistency and flow checked line by line, so reviewers talk about your story, not your typos.'],
      ['layout', 'Formatting & typesetting', 'Files that pass review', 'Kindle, EPUB, paperback and hardcover interiors with the right trim size, margins and chapter styling.'],
      ['showcase', 'Cover design', 'A cover that sells', 'A free 3D cover designed for your genre, readable as a tiny thumbnail and sharp as a printed wrap.'],
      ['proposal', 'ISBN & metadata', 'Built to be found', 'ISBN and barcode, title, subtitle, description, categories and keywords researched for discoverability.'],
      ['kdp', 'Amazon KDP & 10+ stores', 'Published in your name', 'We set up or connect your accounts and publish on Amazon, Apple Books, Barnes & Noble, Kobo and more.'],
      ['call', 'Dedicated project manager', 'One person, start to finish', 'A real person who keeps you updated, answers your questions and makes sure nothing slips.'],
  ]) ?>
</div></section>

<!-- 6. Process -->
<section class="ad-sec white" aria-labelledby="ps-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('How it works', true) ?><h2 class="ad-h2" id="ps-h">From manuscript to Amazon <em>in four steps.</em></h2></div>
  <?= ad_zz([
      ['call', 'chat', 'Free 30-minute call', 'Tell us about your book', 'A short call about your manuscript, your goals and where you want to sell. You get a written quote and a timeline, and nothing starts until you say yes.', ['Free and no obligation', 'Written quote and timeline']],
      ['editing', 'pen', 'Proofread & formatted', 'We prepare your book', 'Our editors proofread your manuscript, our designers create your 3D cover, and our formatters build every file: Kindle, EPUB, paperback and hardcover.', ['Professional proofreading', 'Free 3D cover design', 'Print and ebook files']],
      ['layout', 'eye', 'You approve everything', 'You review and approve', 'You see the interior, the cover and the full listing before anything goes live. Ask for changes, and we make them.', ['Nothing published without your OK', 'Revisions included']],
      ['kdp', 'send', 'Live on Amazon', 'We publish, you earn', 'We publish on Amazon and the stores in your package, check every listing and send you the live links. Royalties go straight to your account.', ['Published under your name', '100% of royalties to you']],
  ]) ?>
</div></section>

<!-- 7. Packages -->
<section class="ad-sec sand" id="packages" aria-labelledby="pk-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Publishing packages', true) ?><h2 class="ad-h2" id="pk-h">Simple pricing. <em>No royalty splits.</em></h2>
    <p class="ad-lead">One-time fees, everything listed. Pick a package or ask us which one fits your book.</p></div>
  <?= ad_plans() ?>
  <p class="ad-c" style="text-align:center;margin-top:34px;color:#4D4943">Not sure which one fits? <a href="#book" data-lp-cta style="font-weight:700">Get a free recommendation</a> or call <a href="tel:<?= e(tel_href()) ?>" data-lp-call style="font-weight:700"><?= e(site('phone')) ?></a>.</p>
</div></section>

<!-- 8. Books -->
<section class="ad-sec white" aria-labelledby="bk-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Our authors’ books', true) ?><h2 class="ad-h2" id="bk-h">Published with <em>AMZ United Press.</em></h2>
    <p class="ad-lead">Real books, real authors, real readers. <b style="color:#141413">Will yours be next?</b></p></div>
  <?= ad_shelf(6) ?>
</div></section>

<!-- 9. Authors -->
<section class="ad-sec sand" aria-labelledby="au-h" style="padding-bottom:clamp(90px,10vw,140px)"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Our author community', true) ?><h2 class="ad-h2" id="au-h">Authors holding <em>the books we published.</em></h2></div>
  <?= ad_authors(10) ?>
</div></section>

<!-- 10. What happens next -->
<?= ad_next('Here’s exactly <em>what happens next.</em>', 'No pressure and no sales script. Just an honest conversation about your book and the clearest path to publishing it.',
    [['Tell us about your book', 'Fill in the short form. It takes about a minute and no preparation is needed.'], ['We map out your path', 'A publishing specialist reviews your goals and recommends the right package, with a written quote.'], ['You decide', 'No hard close and no follow-up pressure. If we’re a fit, we start. The next move is always yours.']],
    'If AMZ United Press is the right fit, we’ll tell you which package makes sense and why. <em>If it isn’t, we’ll tell you that too.</em>', 'Get my free publishing quote') ?>

<?= ad_faq('Questions authors ask <em>before they publish.</em>', $FAQ) ?>

<?= ad_final('Ready when you are', 'Let’s get your book <em>on Amazon.</em>', 'Tell us about your manuscript and where you want to sell it. We’ll reply within one business day with a recommended package and a written quote.',
    ['Packages from ' . $from . ', one-time fee', 'Free 3D cover, ISBN and barcode', '100% of your rights and royalties'], ['Get your free publishing quote', 'A real person replies within one business day.', 3]) ?>

<?= ad_dock('Free quote') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
