<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$amz = sub_by_slug('amazon-publishing-services');
$ebk = sub_by_slug('ebook-publishing-services');
$FAQ = [
    ['How much do your book publishing services cost?', 'Amazon publishing starts from ' . $amz['price'] . ' and multi-store ebook publishing from ' . $ebk['price'] . '. The final price depends on what your book needs, for example whether it also needs editing, a cover or formatting. You get a written quote before we start, and there are no royalty splits or hidden fees.'],
    ['What are self-publishing services?', 'Self-publishing services give you the professional help of a publisher while you stay the publisher of record. We prepare and upload your book, but it is published in your own accounts, under your name, and you keep full control of the price, the rights and every royalty.'],
    ['Can you publish my ebook on Amazon?', 'Yes. Amazon publishing through Kindle Direct Publishing is our most popular service. We set up your Kindle ebook and paperback, research keywords and categories, write the description and submit everything for approval in your own KDP account.'],
    ['Do I keep my rights and royalties?', 'Yes, all of them. Your book is published under your own name and your own Amazon KDP and store accounts. We never take a percentage of your sales, and you can update, reprice or unpublish the book whenever you like.'],
    ['How long does it take to publish my book?', 'Once your files are ready, most books go live on Amazon within one to two weeks, and on the other major stores within two to three. If your book still needs editing, formatting or a cover, we include that in your timeline.'],
    ['Can you publish both an ebook and a paperback?', 'Yes. We prepare the Kindle ebook, the paperback and, if you want one, a hardcover, each with the right files, trim size and cover so they appear together on the same Amazon page.'],
    ['Do I need an ISBN?', 'Not for Kindle ebooks, which use Amazon’s own ASIN. For paperbacks and other stores you can use a free ISBN from the platform or buy your own so that you are listed as the publisher. We explain both options and set up whichever you choose.'],
    ['Which stores will my book be sold in?', 'Amazon Kindle and Amazon paperback as standard, and on request Apple Books, Barnes & Noble, Kobo, Google Play Books, IngramSpark and other ebook retailers and library platforms.'],
    ['What do I need to send you?', 'Your manuscript, and a cover if you already have one. If you don’t, our designers and formatters can create everything else. We handle the metadata, categories, keywords and upload.'],
    ['Will you help me sell the book after launch?', 'Yes. Optional book marketing covers your Amazon listing copy, launch plan, reviews outreach and advertising, so readers can find your book once it is live.'],
];
$meta = [
    'lp' => true,
    'title' => 'Book Publishing Services | Amazon KDP & Ebook | AMZ United Press',
    'description' => 'Self-publishing services for authors: publish your book or ebook on Amazon KDP, Apple Books, Kobo and more. Keep 100% of your royalties. Free quote.',
    'path' => '/lp/publishing-services', 'nav' => '',
    'schema' => lp_schema('Book Publishing Services', 'Self-publishing services for authors: Amazon KDP publishing and multi-store ebook publishing, with formatting, metadata, ISBN guidance and upload handled.', '/lp/publishing-services', $FAQ, $amz['price']),
];
include dirname(__DIR__) . '/includes/header.php';
$w = data('work');
$cover = fn($i, $r) => '<img src="' . e(url(implode('/', array_map('rawurlencode', explode('/', $w[$i]['image']))))) . '" alt="' . e($w[$i]['t']) . '" style="--r:' . $r . 'deg" loading="eager">';
?>
<div class="page active" data-page="lp-publishing">

<!-- 1. Hero: centred, with the form on a book "stage" -->
<section class="lph-center lp-hero-dark" aria-labelledby="lp-h1">
  <?= lp_mosaic() ?>
  <div class="lp-w">
    <p class="lp-kick">Book publishing services</p>
    <h1 id="lp-h1">Self-publish your book on Amazon <em>and every major store.</em></h1>
    <p class="lp-lead">AMZ United Press handles the whole publishing process for you: formatting, cover files, ISBN, metadata, categories and upload to Amazon Kindle Direct Publishing (KDP), Apple Books, Kobo and more. Your book goes live under your name, and you keep 100% of your royalties.</p>
    <?= lp_ctas() ?>
    <?= lp_assure(['Live in as little as 1–2 weeks', 'No royalty splits', 'Written quote first']) ?>
    <div class="lph-stage">
      <div class="lph-books" aria-hidden="true"><?= $cover(2, -6) . $cover(4, 3) ?></div>
      <?= lp_form('lp-form', 'Get your free publishing quote', 'Tell us about your book and where you want to sell it.', 3) ?>
      <div class="lph-books r" aria-hidden="true"><?= $cover(6, -3) . $cover(7, 6) ?></div>
    </div>
  </div>
  <div class="lph-floor"></div>
</section>

<?= lp_platform_strip('Stores we publish to') ?>

<!-- 2. Two ways to publish -->
<section class="lp-sec" aria-labelledby="op-h">
  <div class="lp-w">
    <div class="rv lp-head c"><h2 class="lp-h2" id="op-h">Two affordable self-publishing services, <em>both done for you.</em></h2><p class="lp-lead">Start with Amazon, where most ebooks sell, or go wide across every major store from day one.</p></div>
    <div class="rv lp-cards c2">
      <div class="lp-card hov"><span class="lp-ico"><?= ic('publish') ?></span><h3><?= e($amz['name']) ?></h3><p>Everything you need to publish on Amazon KDP: Kindle ebook and paperback set-up, categories, keywords, pricing and A+ ready files, all in your own account.</p>
        <ul class="lp-checks one" style="margin:6px 0 8px"><?php foreach (['Kindle ebook + paperback set-up', 'Keyword and category research', 'Book description that sells', 'Pricing and royalty guidance'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <div class="lp-price"><span>Starting from</span><b><?= e($amz['price']) ?></b></div>
        <div class="lp-ctas"><a class="btn btn-primary" href="#lp-form" data-lp-cta>Publish on Amazon <?= ic('arrow') ?></a></div>
        <a class="lp-more" href="<?= e(url('/services/' . $amz['slug'])) ?>">Amazon publishing details <?= ic('arrow') ?></a></div>
      <div class="lp-card feat hov"><span class="lp-tag">Widest reach</span><span class="lp-ico"><?= ic('globe') ?></span><h3><?= e($ebk['name']) ?></h3><p>Your ebook on Amazon plus Apple Books, Kobo, Barnes &amp; Noble, Google Play and library platforms, converted and checked for every device and store.</p>
        <ul class="lp-checks one" style="margin:6px 0 8px"><?php foreach (['EPUB and Kindle conversion', 'Multi-store metadata and upload', 'ISBN guidance and set-up', 'Listing checks on every store'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <div class="lp-price"><span>Starting from</span><b><?= e($ebk['price']) ?></b></div>
        <div class="lp-ctas"><a class="btn btn-primary" href="#lp-form" data-lp-cta>Publish everywhere <?= ic('arrow') ?></a></div>
        <a class="lp-more" href="<?= e(url('/services/' . $ebk['slug'])) ?>">Ebook publishing details <?= ic('arrow') ?></a></div>
    </div>
  </div>
</section>

<?= lp_strip('Publish on Amazon and every major store, with 100% of your royalties.') ?>

<!-- 3. Where your book goes -->
<section class="lp-sec alt" aria-labelledby="pl-h" style="padding-top:clamp(100px,10vw,140px)">
  <div class="lp-w lp-split">
    <div><h2 class="lp-h2" id="pl-h">One upload. <em>Readers everywhere.</em></h2><p class="lp-lead">We prepare your files to each store’s exact standards and publish them in your own accounts, so your ebook and paperback reach readers in every major market without you wrestling with dashboards, file errors or rejected uploads.</p><?= lp_ctas('#lp-form', 'Publish my book') ?></div>
    <ul class="lp-checks">
      <?php foreach (['Amazon Kindle (KDP)', 'Amazon paperback & hardcover', 'Apple Books', 'Barnes & Noble', 'Rakuten Kobo', 'Google Play Books', 'IngramSpark bookstores', 'Library platforms'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- 4. Everything handled -->
<section class="lp-sec" aria-labelledby="in-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><h2 class="lp-h2" id="in-h">Every publishing task, <em>handled.</em></h2><p class="lp-lead">Self-publishing should mean you own your book, not that you do everything yourself. Here’s what our book publishing team takes care of.</p><a class="btn btn-primary" href="#lp-form" data-lp-cta>Get my quote <?= ic('arrow') ?></a></div>
    <ul class="lp-checks">
      <li><?= ic('check') ?><span><b>Manuscript review</b>We check your files and flag anything that would cause a store to reject them.</span></li>
      <li><?= ic('check') ?><span><b>Ebook &amp; print formatting</b>Clean Kindle, EPUB and print-ready PDF files that look right on every device.</span></li>
      <li><?= ic('check') ?><span><b>Cover files</b>Ebook, paperback and hardcover covers sized to each platform’s specs.</span></li>
      <li><?= ic('check') ?><span><b>ISBN &amp; copyright</b>Free or owned ISBNs explained, plus copyright page set-up.</span></li>
      <li><?= ic('check') ?><span><b>Keywords &amp; categories</b>Research that helps readers find your book in search.</span></li>
      <li><?= ic('check') ?><span><b>Book description</b>A store description written to turn browsers into buyers.</span></li>
      <li><?= ic('check') ?><span><b>Pricing strategy</b>Price points and royalty options explained in plain English.</span></li>
      <li><?= ic('check') ?><span><b>Upload &amp; approval</b>We submit, fix any issues and confirm every listing is live.</span></li>
      <li><?= ic('check') ?><span><b>Author Central page</b>Your author profile set up so readers can follow you.</span></li>
      <li><?= ic('check') ?><span><b>Launch support</b>Optional marketing, reviews outreach and ads to start sales.</span></li>
    </ul>
  </div>
</section>

<?= lp_authors() ?>

<!-- 5. Steps -->
<section class="lp-sec alt" aria-labelledby="st-h">
  <div class="lp-w lp-split top">
    <div><h2 class="lp-h2" id="st-h">Our book publishing process: manuscript to <em>“Buy now”</em> in six steps.</h2><p class="lp-lead">You approve every file and listing before it goes live. We do the technical work.</p><?= lp_ctas('#lp-form', 'Start publishing', false) ?></div>
    <ol class="lp-vsteps">
      <li><div><h3>Free consultation</h3><p>We talk through your book, your goals and where you want to sell, then send a written quote.</p></div></li>
      <li><div><h3>File review</h3><p>We review your manuscript and cover and recommend any editing, design or formatting it needs.</p></div></li>
      <li><div><h3>Formatting &amp; cover files</h3><p>Your ebook and print files are prepared to each store’s specifications and sent for your approval.</p></div></li>
      <li><div><h3>Metadata &amp; pricing</h3><p>We write your description, research keywords and categories, and agree your price and royalty options.</p></div></li>
      <li><div><h3>Upload &amp; go live</h3><p>We publish in your own accounts, resolve any store queries and confirm every listing is correct.</p></div></li>
      <li><div><h3>Launch &amp; earn</h3><p>Your book is on sale, the royalties go straight to you, and optional marketing helps readers find it.</p></div></li>
    </ol>
  </div>
</section>

<!-- 6. Comparison -->
<section class="lp-sec" aria-labelledby="cp-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="cp-h">Publish with help, <em>without giving up control.</em></h2></div>
    <div class="rv lp-tablewrap"><table class="lp-table">
      <thead><tr><th scope="col"></th><th scope="col">Traditional publishers</th><th scope="col">Doing it alone</th><th scope="col" class="us">AMZ United Press</th></tr></thead>
      <tbody>
        <tr><th scope="row">Your royalties</th><td>Typically a small share</td><td>100%</td><td class="us y">✓ 100%</td></tr>
        <tr><th scope="row">Rights &amp; creative control</th><td>Often signed over</td><td>Yours</td><td class="us y">✓ Yours, always</td></tr>
        <tr><th scope="row">Time to publication</th><td>Often 12–24 months</td><td>Weeks of trial and error</td><td class="us">1–3 weeks once files are ready</td></tr>
        <tr><th scope="row">Formatting, files &amp; metadata</th><td>Included</td><td class="n">You learn it all</td><td class="us y">✓ Done for you</td></tr>
        <tr><th scope="row">Upfront cost</th><td>None, but hard to get accepted</td><td>Your time</td><td class="us">From <?= e($amz['price']) ?>, quoted in writing</td></tr>
      </tbody>
    </table></div>
  </div>
</section>

<?= lp_strip('Your book could be on sale in two weeks.' . lp_offer_suffix()) ?>

<!-- 7. Reviews -->
<section class="lp-sec alt" aria-labelledby="rv-h">
  <div class="lp-w">
    <div class="rv lp-head c"><h2 class="lp-h2" id="rv-h">Published, <em>and proud of it.</em></h2></div>
    <div class="rv lp-quotes"><?= lp_quotes() ?></div>
    <div class="lp-stats" style="margin-top:56px"><?= lp_stats() ?></div>
  </div>
</section>

<!-- 8. FAQ -->
<section class="lp-sec" aria-labelledby="fq-h">
  <div class="lp-w" style="max-width:960px">
    <div class="rv lp-head c"><h2 class="lp-h2" id="fq-h">Book publishing <em>questions,</em> answered.</h2></div>
    <div class="faq lp-faq"><?= faq_html($FAQ, true) ?></div>
  </div>
</section>

<!-- 9. Final CTA -->
<section class="lp-sec lp-final" aria-labelledby="fn-h">
  <div class="lp-w lp-split">
    <div><p class="lp-kick">Ready when you are</p><h2 class="lp-h2" id="fn-h">Let’s get your book <em>on the shelf.</em></h2><p class="lp-lead">Tell us about your book and where you want to sell it. You’ll get honest advice and a written quote within one business day.</p><?= lp_promises() ?></div>
    <?= lp_form('lp-form2', 'Publish my book', 'Takes about a minute. We reply within one business day.', 3) ?>
  </div>
</section>

</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
