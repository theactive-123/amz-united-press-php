<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';
require dirname(__DIR__) . '/includes/adx.php';

$PL = data('prices');
$from = $PL[0]['p'];
$w = data('work');
$reviews = data('lp_reviews') ?? [];
// Real Amazon review counts on client books in the portfolio (from data.php).
$withRev = array_values(array_filter($w, fn($b) => (int)($b['reviews'] ?? 0) > 0));
usort($withRev, fn($a, $b) => (int)$b['reviews'] <=> (int)$a['reviews']);
$revTotal = array_sum(array_map(fn($b) => (int)$b['reviews'], $withRev));
$revRound = number_format((int)(floor($revTotal / 1000) * 1000)) . '+';
$star = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9z"/></svg>';

$FAQ = [
    ['I’m not good with computers. Can you still help me?', 'Yes, and many of our authors feel the same way. You don’t need any technical skills. You send us your manuscript (a Word file is fine, and we can help if it’s typed up from paper), and we handle everything else. A real person explains each step in plain English, by phone or email.'],
    ['What will it cost in total? Are there hidden fees?', 'Our packages start at ' . $from . ' as a one-time fee. Before any work starts, you get a written quote that lists exactly what’s included. There are no monthly fees, no royalty splits and no surprise charges later.'],
    ['Will I still own my book?', 'Yes, completely. Your book is published under your name, on accounts in your name, and you keep 100% of the rights and 100% of the royalties. We never take a share of your sales.'],
    ['How long until my book is on Amazon?', 'Once your manuscript is ready, most books go live on Amazon within one to two weeks. Other stores, such as Apple Books and Barnes & Noble, usually take two to three weeks.'],
    ['Do I get to see the book before it’s published?', 'Always. You review the inside pages, the cover and the Amazon listing before anything goes live. If you’d like changes, we make them. Nothing is published without your approval.'],
    ['Can I get printed copies of my book?', 'Yes. Your book is available as a paperback (and hardcover in some packages), so you can order printed copies for family, friends or events. The Author Bestseller package includes complimentary author copies.'],
    ['My manuscript isn’t perfect. Is that a problem?', 'Not at all. Every package includes professional proofreading. If your book needs more help, such as deeper editing or help finishing it, we can include that in your quote.'],
    ['Will you help me sell my book after it’s published?', 'The Author Bestseller package includes press releases and social media page creation. We also offer book marketing and Amazon Ads management that can be added to any package.'],
];
$meta = [
    'lp' => true, 'ad' => true, 'adx' => 'dark', 'ad_btn' => 'Free Quote',
    'title' => 'Book Publishing Services: Publish on Amazon from ' . $from . ' | AMZ United Press',
    'description' => 'Finished your book? We edit, format, design your cover and publish it on Amazon and 10+ stores. From ' . $from . '. You keep 100% of your royalties.',
    'path' => '/lp/book-publishing', 'nav' => '',
    'schema' => lp_schema('Book Publishing Packages', 'Professional book publishing on Amazon KDP and other stores, including proofreading, formatting, cover design, ISBN and upload.', '/lp/book-publishing', $FAQ, $from),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page x-big" data-page="lp-book-publishing">

<!-- 1. Hero: centred, with the video close under the headline -->
<section class="x-hero x-hero3" aria-labelledby="lp-h1">
  <?= x_deco() ?>
  <div class="x-w x-nw">
    <p class="x-label">For authors with a finished book</p>
    <h1 class="x-h1" id="lp-h1">Finished your book? We’ll publish it for you. <span class="a">You keep every royalty.</span></h1>
    <p class="x-sub x-sub-d">We proofread, format and design your cover, then put your book on Amazon and other stores, under your name. No tech skills needed.</p>
  </div>
  <div class="x-w">
    <p class="x-watch"><?= ad_i('play') ?>Watch: how it works (1 minute)</p>
    <div class="x-frame"><?= x_vsl('vsl-publishing-vo', 'Video: how AMZ United Press publishes your book, in four simple steps') ?></div>
    <p class="x-sub x-sub-m">We proofread, format and design your cover, then put your book on Amazon and other stores, under your name. No tech skills needed.</p>
    <ul class="x-hticks">
      <li><?= ad_i('check') ?><span>Live on Amazon in as little as 2 weeks</span></li>
      <li><?= ad_i('check') ?><span>Free 3D cover, ISBN and barcode included</span></li>
      <li><?= ad_i('check') ?><span>From <?= e($from) ?>, one-time fee, written quote first</span></li>
    </ul>
    <?= x_cta('Get my free publishing quote', '<b>Free, no obligation.</b> A real person replies within one business day.') ?>
    <p class="x-call x-c">Prefer to talk? Call <a href="tel:<?= e(tel_href()) ?>" data-lp-call><?= e(site('phone')) ?></a></p>
  </div>
</section>

<section class="x-logos"><div class="x-w"><?= x_logos('Your book on the stores readers use') ?></div></section>

<!-- 2. The problem -->
<section class="x-sec lt" aria-labelledby="pr-h"><div class="x-w">
  <?= x_head('pr-h', 'The book is written. <span class="a">Now what?</span>', 'Sound familiar?') ?>
  <div class="x-prob">
    <div class="ad-rv">
      <p class="lead">Finishing your manuscript feels like the finish line.</p>
      <p>Then you try to publish it, and <span class="hi">a whole list of new questions appears:</span></p>
      <ul class="x-qlist"><li><i>?</i>Which book size should I choose?</li><li><i>?</i>Do I need an ISBN?</li><li><i>?</i>Why was my file rejected?</li><li><i>?</i>How do I make a cover?</li><li><i>?</i>Which categories and keywords?</li><li><i>?</i>How should I price it?</li></ul>
      <p style="margin-top:22px">Many authors lose months here, or publish a book that looks home-made. <b class="x-strong">You don’t have to. We do all of this for you.</b></p>
    </div>
    <figure class="x-photo ad-rv" style="--d:1;margin:0"><?= ad_img('writing', 'An author’s desk with a finished manuscript') ?><i>manuscript_final_v7.docx</i></figure>
  </div>
</div></section>

<!-- 3. Who it's for -->
<section class="x-sec b2" aria-labelledby="fo-h"><div class="x-w">
  <?= x_head('fo-h', 'Made for authors <span class="a">just like you.</span>', '', 'Whether this is your first book or your fifth, we make publishing simple.') ?>
  <div class="x-for">
  <?php foreach ([['pen', 'First-time authors', 'You’ve written your book but have never published one. We guide you from start to finish.'], ['book', 'Memoirs & family stories', 'Share your life story or family history with your children, grandchildren and readers everywhere.'], ['users', 'Experts & business owners', 'Turn your knowledge into a professional book that builds trust and opens doors.'], ['refresh', 'Stuck with KDP?', 'Tried to upload it yourself and got stuck or rejected? We fix it and get it live.']] as $i => $f): ?>
    <div class="ad-rv" style="--d:<?= $i ?>"><?= ad_i($f[0]) ?><h3><?= e($f[1]) ?></h3><p><?= e($f[2]) ?></p></div>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- 4. How it works -->
<section class="x-sec glow line" aria-labelledby="hw-h"><div class="x-w">
  <?= x_head('hw-h', 'Published in <span class="a">4 simple steps.</span>', '', 'You stay in control. We do the hard work.') ?>
  <ol class="x-flow">
  <?php $F = [['Free call', 'Tell us about your book', 'A friendly, no-pressure chat about your book and goals. You get a written quote and timeline.'], ['We prepare it', 'Proofread, formatted, designed', 'Editors check every page, designers create your cover, and we build every file.'], ['You approve', 'Review everything', 'You see the pages, cover and listing first. Ask for changes, and we make them.'], ['Published', 'Live on Amazon', 'Your book goes live under your name. Royalties go straight to you.']];
  foreach ($F as $i => $f): ?><li class="ad-rv" style="--d:<?= $i ?>"><b>0<?= $i + 1 ?></b><small><?= e($f[0]) ?></small><h3><?= e($f[1]) ?></h3><p><?= e($f[2]) ?></p></li><?php endforeach; ?>
  </ol>
  <?= x_cta('Start with a free call') ?>
</div></section>

<!-- 5. What's included -->
<section class="x-sec lt sand" aria-labelledby="wh-h"><div class="x-w">
  <?= x_head('wh-h', 'Everything your book needs, <span class="a">in one place.</span>', 'What we handle', 'One team, one point of contact, and no running around between freelancers.') ?>
  <?= ad_cards([
      ['editing', 'Proofreading', 'Clean, professional pages', 'Spelling, grammar and consistency checked line by line, so readers focus on your story.'],
      ['layout', 'Formatting', 'Looks like a real published book', 'Ebook, paperback and hardcover files with the right size, margins and chapter styles.'],
      ['showcase', 'Cover design', 'A cover that gets noticed', 'A free 3D cover designed for your genre, sharp on a phone screen and on the shelf.'],
      ['proposal', 'ISBN & listing', 'Easy for readers to find', 'ISBN, barcode, book description, categories and keywords, all set up for you.'],
      ['kdp', 'Publishing', 'Amazon and 10+ stores', 'Published under your name on Amazon, Apple Books, Barnes & Noble, Kobo and more.'],
      ['call', 'Your project manager', 'One real person, start to finish', 'Someone who knows your book, keeps you updated and answers your questions.'],
  ]) ?>
</div></section>

<!-- 6. Reviews and real authors -->
<section class="x-sec lt" aria-labelledby="rv-h"><div class="x-w">
  <?= x_head('rv-h', 'Real books. Real readers. <span class="a">Real reviews.</span>', 'Proof, not promises', 'Books we’ve worked on, with the reviews readers have left on Amazon.') ?>
  <div class="x-rev">
    <div class="x-rev-sum ad-rv">
      <p class="x-tag" style="margin:0;border-color:rgba(255,255,255,.2);color:#F5F2EA;background:rgba(255,255,255,.05)">On Amazon</p>
      <b class="x-acc"><?= e($revRound) ?></b>
      <p><strong style="color:#fff">Amazon reader reviews</strong></p>
      <p>across <?= count($withRev) ?> of the client books in our portfolio.</p>
      <p style="font-size:.95rem;margin-top:14px">Review counts as shown on Amazon. Results vary by book.</p>
    </div>
    <div>
      <?php if ($reviews): ?>
      <div class="x-rev-grid" style="margin-bottom:16px">
      <?php foreach ($reviews as $i => $r): $rt = max(1, min(5, (int)($r['rating'] ?? 5))); ?>
        <figure class="x-tcard ad-rv" style="--d:<?= $i % 2 ?>;margin:0"><div class="x-tiles" role="img" aria-label="<?= $rt ?> out of 5 stars"><?php for ($s = 1; $s <= 5; $s++): ?><i<?= $s > $rt ? ' class="off"' : '' ?>><?= $star ?></i><?php endfor; ?></div>
          <q><?= e($r['quote']) ?></q><figcaption class="who"><?php if (!empty($r['photo'])): ?><img src="<?= e(ad_src($r['photo'])) ?>" alt="" loading="lazy"><?php endif; ?><div><?= e($r['name']) ?><?php if (!empty($r['book'])): ?><span>Author of <?= e($r['book']) ?></span><?php endif; ?></div></figcaption></figure>
      <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <div class="x-rev-grid">
      <?php foreach (array_slice($withRev, 0, 6) as $i => $b): ?>
        <article class="x-rcard ad-rv" style="--d:<?= $i % 2 ?>"><img class="c" src="<?= e(ad_cover($b)) ?>" alt="<?= e($b['t'] . ' by ' . $b['by']) ?>" loading="lazy"><div><h3><?= e($b['t']) ?></h3><p class="by">by <?= e($b['by']) ?></p><p class="n"><?= e(number_format((int)$b['reviews'])) ?> <small><?= (int)$b['reviews'] === 1 ? 'Amazon review' : 'Amazon reviews' ?></small></p></div></article>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
  <div class="x-faces">
  <?php foreach (array_slice(ad_authors_list(), 0, 10) as $i => $a): ?><figure class="ad-rv" style="--d:<?= $i % 5 ?>"><img src="<?= e(ad_src($a . '.webp')) ?>" alt="An author holding their book published with AMZ United Press" loading="lazy"></figure><?php endforeach; ?>
  </div>
  <p class="x-faces-cap">Real authors we’ve worked with, holding their published books.</p>
</div></section>

<!-- 7. Publisher vs us -->
<section class="x-sec b2 glow" aria-labelledby="cp-h"><span class="x-edge" aria-hidden="true"></span><div class="x-w">
  <?= x_head('cp-h', 'The help of a publisher. <span class="a">Without giving up your book.</span>', '', 'Traditional and vanity publishers often keep your rights and a share of your royalties. <b class="x-strong">With us, the book stays yours.</b>') ?>
  <?= x_vs(['Traditional publisher', 'What they take', ['Your rights, often for years', 'A share of every royalty', 'The final say on your cover', 'Control of your price', 'Months or years to publish']],
           ['AMZ United Press', 'What you keep', ['100% of your rights', '100% of your royalties', 'Final approval on everything', 'Your price, your accounts', 'Live in as little as 1–2 weeks']]) ?>
</div></section>

<!-- 8. Our promises -->
<section class="x-sec" aria-labelledby="pm-h"><div class="x-w">
  <?= x_head('pm-h', 'Our promises <span class="a i">to you.</span>') ?>
  <div class="x-prom">
  <?php foreach ([['doc', 'A written quote first', 'You know the full price before any work starts. No hidden fees.'], ['eye', 'Nothing without your OK', 'You approve the pages, cover and listing before anything goes live.'], ['shield', 'Your book stays yours', 'Your name, your accounts, 100% of your rights and royalties.'], ['chat', 'Plain English, always', 'No jargon. If we use a publishing term, we explain it.'], ['clock', 'Fast, friendly replies', 'A real person replies within one business day.'], ['lock', 'Your work is private', 'We’re happy to sign an NDA before you share your manuscript.']] as $i => $p): ?>
    <div class="ad-rv" style="--d:<?= $i % 3 ?>"><?= ad_i($p[0]) ?><div><h3><?= e($p[1]) ?></h3><p><?= e($p[2]) ?></p></div></div>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- 9. Packages -->
<section class="x-sec lt sand" id="packages" aria-labelledby="pk-h"><div class="x-w">
  <?= x_head('pk-h', 'Simple, honest pricing. <span class="a">One-time fee.</span>', 'Publishing packages', 'Everything is listed. No monthly fees and no royalty splits. Not sure which one? We’ll help you choose.') ?>
  <?= ad_plans() ?>
  <p class="x-c" style="margin-top:34px">Not sure which one fits? <a href="#book" data-lp-cta style="font-weight:700;color:var(--tx)">Get a free recommendation</a> or call <a href="tel:<?= e(tel_href()) ?>" data-lp-call style="font-weight:700;color:var(--tx)"><?= e(site('phone')) ?></a>.</p>
</div></section>

<!-- 10. Quote form -->
<section class="x-sec line glow" aria-labelledby="qt-h"><div class="x-w">
  <?= x_formsec('qt-h', 'Get your free <span class="a">publishing quote.</span>', 'Tell us a little about your book. A real person will reply within one business day with the right package and a written price.',
      ['Takes about one minute', 'Free, with no obligation', 'A written quote before any work starts', 'Your details stay private'],
      ['lp-form', 'Get your free publishing quote', 'Tell us about your book. We’ll recommend the right package and send a written quote.', 3], 'Free quote') ?>
</div></section>

<!-- 11. FAQ -->
<section class="x-sec lt" aria-labelledby="fq-h"><div class="x-w">
  <?= x_head('fq-h', 'Your questions, <span class="a">answered.</span>', '', 'Can’t see yours? Call <a href="tel:' . e(tel_href()) . '" data-lp-call style="color:var(--ord);font-weight:700">' . e(site('phone')) . '</a> and ask a real person.') ?>
  <?= x_faq($FAQ) ?>
</div></section>

<!-- 12. Final -->
<section class="x-sec" aria-labelledby="fn-h"><div class="x-w">
  <?= x_final('Your story deserves <span class="a">to be read.</span>', 'You’ve done the hard part by writing it. Let us handle the rest, while you keep every right and every royalty.',
      ['Proofreading', 'Formatting', 'Free 3D cover', 'ISBN & barcode', 'Amazon & 10+ stores'], 'Packages from ' . e($from) . '. One-time fee. 100% of royalties to you.', 'Get my free publishing quote', 'Or call <b>' . e(site('phone')) . '</b>. A real person will answer.') ?>
</div></section>

<?= ad_dock('Free quote') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
