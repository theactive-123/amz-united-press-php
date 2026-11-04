<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lx.php';

$PL = data('prices');
$from = $PL[0]['p'];
$FAQ = [
    ['How much does it cost to publish my book?', 'Our publishing packages start at ' . $from . '. The Economical Author Package covers proofreading, formatting, an ebook and paperback on Amazon, a 3D cover, ISBN and barcode. You get a written quote before we start, with no royalty splits or hidden fees.'],
    ['How long does it take to publish my book?', 'Once your manuscript and cover are ready, most books go live on Amazon within one to two weeks. Wider distribution to other stores usually takes two to three weeks.'],
    ['Do I keep my rights and royalties?', 'Yes, 100%. Your book is published under your own name, on your own KDP and store accounts. We never take a percentage of your sales.'],
    ['Do I need a finished manuscript?', 'For publishing, yes. If you only have an idea or a draft, we also offer ghostwriting and editing, and can include them in your quote.'],
    ['What if I don’t have a cover?', 'Every package includes a free 3D book cover design. The Author Choice and Author Bestseller packages include unlimited revisions.'],
    ['Which stores will my book be sold in?', 'Amazon in every package. Author Choice publishes on the top 5 platforms and Author Bestseller on 10+ platforms, including Apple Books, Barnes & Noble, Kobo and Google Play.'],
    ['Do you help me sell the book after launch?', 'The Author Bestseller package includes press releases and social media page creation. Book marketing and Amazon Ads can be added to any package.'],
];
$meta = [
    'lp' => true, 'lx' => true,
    'title' => 'Publish Your Book on Amazon from ' . $from . ' | AMZ United Press',
    'description' => 'Professional book publishing on Amazon KDP and 10+ stores: proofreading, formatting, cover, ISBN and upload. Packages from ' . $from . '. Keep 100% of your royalties.',
    'path' => '/lp/book-publishing', 'nav' => '',
    'schema' => lp_schema('Book Publishing Packages', 'Book publishing on Amazon KDP and other stores, including proofreading, formatting, cover design, ISBN and upload.', '/lp/book-publishing', $FAQ, $from),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page lx" data-page="lp-book-publishing">

<!-- Hero: offer, proof, form -->
<section class="lx-hero" aria-labelledby="lp-h1"><span class="lx-grid-bg" aria-hidden="true"></span><span class="lx-glow" aria-hidden="true"></span>
  <div class="w lx-hero-in">
    <div>
      <p class="lx-pill"><b>FROM <?= e($from) ?></b>Amazon publishing, done for you</p>
      <h1 class="lx-h1" id="lp-h1">Publish your book on Amazon. <em>Keep 100% of your royalties.</em></h1>
      <p class="lx-lead">We proofread, format, design your cover and publish your ebook and paperback on Amazon KDP and other leading stores, under your name. One project manager, one clear price, and your book live in as little as 1–2 weeks.</p>
      <ul class="lx-promise"><li><?= lx_i('check') ?>Free 3D cover design</li><li><?= lx_i('check') ?>ISBN &amp; barcode included</li><li><?= lx_i('check') ?>100% ownership rights</li></ul>
      <?= lx_covers([2, 4, 6, 7, 8]) ?>
      <?= lx_faces('<b>' . e(data('stats')[0][0] . data('stats')[0][1]) . ' books</b> published for <b>' . e(data('stats')[1][0] . data('stats')[1][1]) . ' authors</b>, under their own names.') ?>
    </div>
    <?= lp_form('lp-form', 'Get your free publishing quote', 'Tell us about your book. A real person replies within one business day.', 3) ?>
  </div>
</section>

<?= lp_trust('We publish on') ?>

<!-- Packages -->
<section class="lx-sec lx-light" id="packages" aria-labelledby="pk-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('Publishing packages', true) ?><h2 class="lx-h2" id="pk-h">Choose the package that’s right for <em>your book.</em></h2>
    <p class="lx-sub">Clear prices, everything listed. You keep every right and every royalty.</p></div>
  <div class="lx-plans">
  <?php foreach ($PL as $i => $p): ?>
    <article class="lx-plan<?= $p['f'] ? ' hot' : '' ?> lx-rv" style="--d:<?= $i ?>">
      <?php if ($p['f']): ?><span class="tag">Most popular</span><?php endif; ?>
      <h3><?= e($p['t']) ?></h3><p class="price"><?= e($p['p']) ?></p>
      <ul><?php foreach ($p['l'] as $x): ?><li><?= lx_i('check') ?><span><?= e($x) ?></span></li><?php endforeach; ?></ul>
      <a class="btn btn-primary" href="#lp-form" data-lp-cta data-pkg="<?= e($p['t']) ?>">Get Started</a>
    </article>
  <?php endforeach; ?>
  </div>
  <p class="lx-plans-note">Not sure which one fits? <a href="#lp-form" data-lp-cta style="color:#141413;font-weight:700">Ask for a free recommendation</a> or call <a href="tel:<?= e(tel_href()) ?>" data-lp-call style="color:#141413;font-weight:700"><?= e(site('phone')) ?></a>.</p>
</div></section>

<!-- What's included -->
<section class="lx-sec lx-alt" aria-labelledby="in-h"><div class="w">
  <div class="lx-head"><?= lx_kick('What we handle') ?><h2 class="lx-h2" id="in-h">Everything between your manuscript and <em>a live listing.</em></h2></div>
  <div class="lx-state-grid lx-feat">
  <?php $I = [['pen', 'Proofreading & editing', 'Spelling, grammar and consistency checked so readers and reviewers see a clean book.'], ['layout', 'Formatting & typesetting', 'Kindle, EPUB, paperback and hardcover files that pass every store’s review.'], ['book', '3D cover design', 'A genre-right cover that reads well as a thumbnail and as a printed wrap.'], ['tag', 'ISBN & barcode', 'Set up in your name so your book can be sold in print and in stores.'], ['send', 'KDP & store upload', 'Title, description, keywords, categories and pricing entered and submitted for you.'], ['shield', 'Dedicated project manager', 'One person who knows your book and keeps you updated until launch day.']];
  foreach ($I as $i => $x): ?>
    <div class="lx-rv" style="--d:<?= $i % 3 ?>"><span class="lx-ib"><?= lx_i($x[0]) ?></span><b><?= e($x[1]) ?></b><p><?= e($x[2]) ?></p></div>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- Steps -->
<section class="lx-sec lx-light" aria-labelledby="st-h"><div class="w">
  <div class="lx-head"><?= lx_kick('How it works') ?><h2 class="lx-h2" id="st-h">Live on Amazon in <em>four simple steps.</em></h2></div>
  <ol class="lx-steps c4">
  <?php $S = [['Free consultation', 'Tell us about your book. You get a written quote and timeline.'], ['Prepare the book', 'We proofread, format and design your cover and files.'], ['You approve', 'Review the interior, cover and listing. Nothing goes live without your OK.'], ['Publish & earn', 'We publish on Amazon and other stores. Royalties go straight to you.']];
  foreach ($S as $i => $s): ?>
    <li class="lx-rv" style="--d:<?= $i ?>"><span class="n">0<?= $i + 1 ?></span><h3><?= e($s[0]) ?></h3><p><?= e($s[1]) ?></p></li>
  <?php endforeach; ?>
  </ol>
  <div class="lx-band lx-rv" style="margin-top:clamp(40px,5vw,64px)">
    <div><h2>Your book could be on Amazon in 1–2 weeks.</h2><p>Packages from <?= e($from) ?>. Free consultation, written quote, no royalty splits.</p><?= lx_cta('Get my free quote') ?></div>
    <?= lx_covers([0, 1, 3, 5, 9]) ?>
  </div>
</div></section>

<!-- Why us -->
<section class="lx-sec" aria-labelledby="vs-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('Why authors choose us', true) ?><h2 class="lx-h2" id="vs-h">Publishing alone vs. <em>publishing with a team.</em></h2></div>
  <div class="lx-vs">
    <div class="bad lx-rv"><h3>Doing it yourself</h3><ul><?php foreach (['Learning KDP settings from scratch', 'Rejected files and formatting errors', 'A cover that looks home-made', 'Guessing keywords and categories', 'Hiring separate freelancers', 'Weeks lost to trial and error'] as $x): ?><li><?= lx_i('x') ?><?= e($x) ?></li><?php endforeach; ?></ul></div>
    <div class="good lx-rv" style="--d:1"><h3>With AMZ United Press</h3><ul><?php foreach (['Files that pass review first time', 'Professional 3D cover included', 'Researched keywords & categories', 'One team and one project manager', 'Live in as little as 1–2 weeks', '100% of your rights and royalties'] as $x): ?><li><?= lx_i('check') ?><?= e($x) ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>

<!-- Shelf -->
<section class="lx-sec lx-alt" aria-labelledby="sh-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('Our authors’ books', true) ?><h2 class="lx-h2" id="sh-h">Real books, <em>published for real authors.</em></h2></div>
  <?= lp_books(6, 0) ?>
</div></section>

<?= lx_faq('Questions before you <em>publish.</em>', $FAQ) ?>

<?= lx_final('Ready when you are', 'Let’s get your book <em>on Amazon.</em>', 'Tell us about your manuscript and where you want to sell it. We’ll recommend the right package and send a written quote within one business day.',
    ['Packages from ' . $from, 'Free 3D cover, ISBN & barcode', 'You keep 100% of rights and royalties'],
    ['Get your free publishing quote', 'A real person replies within one business day.', 3]) ?>

</div>
<script>
/* Package buttons pre-fill the form with the chosen package. */
document.querySelectorAll('[data-pkg]').forEach(function(b){b.addEventListener('click',function(){var t=document.getElementById('lp-form-project');if(t&&!t.value)t.value='Interested in: '+b.getAttribute('data-pkg')})});
</script>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
