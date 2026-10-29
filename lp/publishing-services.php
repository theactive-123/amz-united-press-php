<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

// Both routes are covered on one page: /services/publishing-services.
$amz = ['name' => 'Amazon Publishing Services', 'price' => '$349', 'slug' => 'publishing-services'];
$ebk = ['name' => 'Ebook Publishing Services', 'price' => '$399', 'slug' => 'publishing-services'];
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
?>
<div class="page" data-page="lp-publishing">

<?= lp_hero([
    'eyebrow' => 'Book publishing services',
    'h1' => 'Self-publish your book on Amazon <em>and every major store.</em>',
    'lead' => 'AMZ United Press handles the whole publishing process for you: formatting, cover files, ISBN, metadata, categories and upload to Amazon Kindle Direct Publishing (KDP), Apple Books, Kobo and more. Your book goes live under your name, and you keep 100% of your royalties.',
    'ticks' => ['Live in as little as 1–2 weeks', 'No royalty splits', 'Written quote first'],
    'extra' => lp_hero_shelf(),
    'form' => ['Get your free publishing quote', 'Tell us about your book and where you want to sell it.', 3],
]) ?>

<?= lp_trust('Stores we publish to') ?>

<section class="sec bg-white" aria-labelledby="op-h">
  <div class="w">
    <?= lp_head('Choose your route', 'Two affordable self-publishing services, <em>both done for you.</em>', 'Start with Amazon, where most ebooks sell, or go wide across every major store from day one.', true, 'op-h') ?>
    <div class="grid g2 rv">
      <div class="card">
        <span class="card-ic"><?= ic('publish') ?></span>
        <h3 class="h3"><?= e($amz['name']) ?></h3>
        <p>Everything you need to publish on Amazon KDP: Kindle ebook and paperback set-up, categories, keywords, pricing and A+ ready files, all in your own account.</p>
        <?= lp_checks(['Kindle ebook + paperback set-up', 'Keyword and category research', 'A book description that sells', 'Pricing and royalty guidance']) ?>
        <div class="card-foot"><span>Starting from</span><b><?= e($amz['price']) ?></b></div>
        <div class="ctas"><a class="btn btn-primary" href="#lp-form" data-lp-cta>Publish on Amazon <?= ic('arrow') ?></a><a href="<?= e(url('/services/' . $amz['slug'])) ?>">Amazon publishing details</a></div>
      </div>
      <div class="card feat">
        <span class="tag">Widest reach</span>
        <span class="card-ic"><?= ic('globe') ?></span>
        <h3 class="h3"><?= e($ebk['name']) ?></h3>
        <p>Your ebook on Amazon plus Apple Books, Kobo, Barnes &amp; Noble, Google Play and library platforms, converted and checked for every device and store.</p>
        <?= lp_checks(['EPUB and Kindle conversion', 'Multi-store metadata and upload', 'ISBN guidance and set-up', 'Listing checks on every store']) ?>
        <div class="card-foot"><span>Starting from</span><b><?= e($ebk['price']) ?></b></div>
        <div class="ctas"><a class="btn btn-primary" href="#lp-form" data-lp-cta>Publish everywhere <?= ic('arrow') ?></a><a href="<?= e(url('/services/' . $ebk['slug'])) ?>">Ebook publishing details</a></div>
      </div>
    </div>
  </div>
</section>

<?= lp_band('Publish on Amazon and every major store, with 100% of your royalties.', 'Get a free, written publishing quote today.') ?>

<section class="sec bg-sand" aria-labelledby="in-h">
  <div class="w split split-57 top">
    <div class="sticky"><span class="eyebrow">What’s included</span><h2 class="h2" id="in-h">Every publishing task, <em>handled.</em></h2><p class="lead">Self-publishing should mean you own your book, not that you do everything yourself. We prepare your files to each store’s exact standards and publish them in your own accounts.</p><?= lp_ctas('Get my quote', '#lp-form', false) ?></div>
    <?= lp_checks([
        ['Manuscript review', 'We check your files and flag anything a store would reject.'],
        ['Ebook & print formatting', 'Clean Kindle, EPUB and print-ready PDF files.'],
        ['Cover files', 'Ebook, paperback and hardcover covers sized to each platform.'],
        ['ISBN & copyright', 'Free or owned ISBNs explained, plus copyright page set-up.'],
        ['Keywords & categories', 'Research that helps readers find your book in search.'],
        ['Book description', 'A store description written to turn browsers into buyers.'],
        ['Pricing strategy', 'Price points and royalty options in plain English.'],
        ['Upload & approval', 'We submit, fix any issues and confirm every listing is live.'],
        ['Author Central page', 'Your author profile set up so readers can follow you.'],
        ['Launch support', 'Optional marketing, review outreach and ads to start sales.'],
    ], true) ?>
  </div>
</section>

<?= lp_authors() ?>

<section class="sec bg-white" aria-labelledby="st-h">
  <div class="w split split-57 top">
    <div class="sticky"><span class="eyebrow">How it works</span><h2 class="h2" id="st-h">Our book publishing process: manuscript to <em>“Buy now”</em> in six steps.</h2><p class="lead">You approve every file and listing before it goes live. We do the technical work.</p><?= lp_ctas('Start publishing', '#lp-form', false) ?></div>
    <?= lp_steps([
        ['Free consultation', 'We talk through your book, your goals and where you want to sell, then send a written quote.'],
        ['File review', 'We review your manuscript and cover and recommend any editing, design or formatting it needs.'],
        ['Formatting & cover files', 'Your ebook and print files are prepared to each store’s specifications and sent for your approval.'],
        ['Metadata & pricing', 'We write your description, research keywords and categories, and agree your price and royalty options.'],
        ['Upload & go live', 'We publish in your own accounts, resolve any store queries and confirm every listing is correct.'],
        ['Launch & earn', 'Your book is on sale, the royalties go straight to you, and optional marketing helps readers find it.'],
    ]) ?>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="cp-h">
  <div class="w">
    <?= lp_head('Know your options', 'Publish with help, <em>without giving up control.</em>', '', false, 'cp-h') ?>
    <?= lp_table(['Traditional publishers', 'Doing it alone', 'AMZ United Press'], [
        ['Your royalties', 'Typically a small share', '100%', '✓ 100%'],
        ['Rights & creative control', 'Often signed over', 'Yours', '✓ Yours, always'],
        ['Time to publication', 'Often 12–24 months', 'Weeks of trial and error', '1–3 weeks once files are ready'],
        ['Formatting, files & metadata', 'Included', '— You learn it all', '✓ Done for you'],
        ['Upfront cost', 'None, but hard to get accepted', 'Your time', 'From ' . $amz['price'] . ', quoted in writing'],
    ]) ?>
  </div>
</section>

<?= lp_band('Your book could be on sale in two weeks.' . lp_offer_suffix(), 'Send us your manuscript details for a free publishing quote.') ?>

<section class="sec bg-white" aria-labelledby="rv-h">
  <div class="w">
    <?= lp_head('Authors say', 'Published, <em>and proud of it.</em>', '', true, 'rv-h') ?>
    <?= lp_quotes() ?>
    <div class="mt"><?= lp_stats() ?></div>
  </div>
</section>

<?= lp_faq('bg-sand', 'Book publishing <em>questions,</em> answered.', $FAQ) ?>

<?= lp_final('Ready when you are', 'Let’s get your book <em>on the shelf.</em>', 'Tell us about your book and where you want to sell it. You’ll get honest advice and a written quote within one business day.', ['No royalty splits', 'Your own accounts', 'Written quote first'], ['Publish my book', 'Takes about a minute. We reply within one business day.', 3]) ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
