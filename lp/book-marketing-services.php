<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$mk = sub_by_slug('book-marketing-services');
$FAQ = [
    ['What is book marketing?', 'Book marketing is everything that helps the right readers discover, trust and buy your book: a strong Amazon listing, advertising, reviews, social media, email, press and an author brand readers can follow. Good marketing starts before launch day and keeps working long after it.'],
    ['How do you market a self-published book?', 'Start with the foundations: a professional cover, a description that sells and the right Amazon keywords and categories. Then build visibility through editorial reviews, targeted Amazon and social ads, a reader email list and outreach to bloggers, podcasts and media. Our book marketing services for self-published authors cover each of these steps.'],
    ['Can I hire someone to market my book?', 'Yes. When you hire a book marketer at AMZ United Press, a dedicated marketing team plans and runs your campaign while you approve the strategy, the budget and every piece of content that goes out in your name.'],
    ['How much do book marketing services cost?', 'Our book marketing services start from ' . $mk['price'] . '. The final price depends on the channels you choose, your timeline and any advertising budget, which you control and pay directly to the platform. You get a written plan and quote before anything starts.'],
    ['Do you guarantee sales or bestseller status?', 'No honest book promotion agency can guarantee sales or rankings, and we never will. What we do promise is a clear strategy, proven tactics, transparent reporting and a team that adjusts the campaign based on real results.'],
    ['How do you market a book launch?', 'We plan the launch six to eight weeks ahead: advance reader copies for early reviews, a pre-order or launch-week price strategy, an email and social countdown, media and blogger outreach, and Amazon ads timed to go live on launch day.'],
    ['Can I use your marketing if I published elsewhere?', 'Yes. You can hire us only for book marketing, whether your book was published by you, by us or by another company. We just need access to your listing and any accounts you want us to manage.'],
    ['How do books get popular?', 'Books grow through visibility and word of mouth: readers have to find the book, trust it enough to buy, and enjoy it enough to recommend it. Reviews, a compelling listing, consistent promotion and an author brand readers connect with all feed that cycle.'],
];
$meta = [
    'lp' => true,
    'title' => 'Book Marketing Services | Book Promotion Agency | AMZ United Press',
    'description' => 'Book marketing services for self-published authors: Amazon ads, editorial reviews, social media, email and PR. Hire a book marketer today. Free strategy call.',
    'path' => '/lp/book-marketing-services', 'nav' => '',
    'schema' => lp_schema('Book Marketing Services', 'Book marketing and book promotion services for self-published and independent authors: Amazon optimisation and ads, editorial reviews, social media, email marketing, media outreach and author branding.', '/lp/book-marketing-services', $FAQ, $mk['price']),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page active" data-page="lp-marketing">

<!-- 1. Hero: orange, with the form -->
<section class="lph-mk" aria-labelledby="lp-h1">
  <div class="lp-w lph-grid">
    <div>
      <p class="lp-kick">Book marketing services</p>
      <h1 id="lp-h1">Book marketing that gets your book <em>noticed, and bought.</em></h1>
      <p class="lp-lead">You wrote a great book. Now readers need to find it. Our book marketing experts build and run a promotion plan around your book and your budget: Amazon ads and listing optimisation, editorial reviews, social media, email and media outreach, with clear reports so you always see what’s working.</p>
      <?= lp_ctas('#lp-form', 'Get a Free Marketing Plan') ?>
      <?= lp_assure(['Free strategy call', 'You control the ad budget', 'No long contracts']) ?>
    </div>
    <?= lp_form('lp-form', 'Get your free marketing plan', 'Tell us about your book and your goals. We reply within one business day.', 4, 'Get My Free Plan') ?>
  </div>
  <div class="lp-w"><ul class="lph-mk-channels" aria-label="Marketing channels"><?php foreach (['Amazon Ads', 'Amazon SEO', 'Editorial reviews', 'Goodreads', 'Facebook &amp; Instagram', 'TikTok &amp; BookTok', 'Email marketing', 'Press &amp; podcasts', 'Author website'] as $c): ?><li><?= $c ?></li><?php endforeach; ?></ul></div>
</section>

<?= lp_authors('Authors who trusted us with their books') ?>

<!-- 2. The problem -->
<section class="lp-sec" aria-labelledby="pb-h">
  <div class="lp-w lp-split">
    <div><h2 class="lp-h2" id="pb-h">Great books don’t <em>sell themselves.</em></h2><p class="lp-lead" style="margin:0">Millions of titles compete for attention on Amazon alone. Without a plan, even a brilliant book can sit unseen on page twenty of the search results. Professional book promotion puts it in front of the readers most likely to love it.</p></div>
    <div class="rv lp-pg" style="grid-template-columns:1fr">
      <div class="pain"><h3>Without a marketing plan</h3><ul>
        <li><i>✕</i>Launch week comes and goes with a handful of sales</li>
        <li><i>✕</i>Too few reviews for new readers to take a chance</li>
        <li><i>✕</i>Ad spend wasted on the wrong keywords and audiences</li>
      </ul></div>
      <div class="gain"><h3>With AMZ United Press</h3><ul>
        <li><i>✓</i>A launch plan that builds momentum before release day</li>
        <li><i>✓</i>Honest editorial reviews and advance reader outreach</li>
        <li><i>✓</i>Targeted campaigns, tracked and improved every week</li>
      </ul></div>
    </div>
  </div>
</section>

<!-- 3. Channels -->
<section class="lp-sec dark" aria-labelledby="ch-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="ch-h">Book promotion services across <em>every channel</em> that sells books.</h2><p class="lp-lead" style="margin:0">Pick the channels that fit your genre and budget, or let our book marketers recommend the mix most likely to work for your readers.</p></div>
    <div class="rv lp-cards c3">
      <?php foreach ([
        ['tag', 'Amazon optimisation', 'Keywords, categories, a description that converts and A+ content, so your listing ranks and persuades.'],
        ['publish', 'Amazon & BookBub ads', 'Targeted ad campaigns built around your genre’s readers, with daily budgets you set and control.'],
        ['check', 'Editorial reviews', 'Advance reader copies and outreach to genuine reviewers and bloggers. We never buy ratings.'],
        ['users', 'Social media marketing', 'Content and ads on Facebook, Instagram and TikTok that grow a real readership around your book.'],
        ['globe', 'Goodreads visibility', 'Author profile, giveaways and reader engagement on the world’s largest community of book lovers.'],
        ['mail', 'Email marketing', 'A reader magnet, sign-up page and launch sequence that turn one-time buyers into loyal fans.'],
        ['headset', 'Media & podcast outreach', 'Pitches to journalists, podcasts and book bloggers who cover your genre or subject.'],
        ['layout', 'Video promotion', 'Book trailers and short social videos that make your story stop the scroll.'],
        ['pen', 'Author brand building', 'A clear author identity, bio and website that readers recognise and follow from book to book.'],
      ] as $c): ?>
      <div class="lp-card"><span class="lp-ico"><?= ic($c[0]) ?></span><h3><?= e($c[1]) ?></h3><p><?= e($c[2]) ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 4. Choose your goal -->
<section class="lp-sec" aria-labelledby="gl-h">
  <div class="lp-w">
    <div class="rv lp-head c"><h2 class="lp-h2" id="gl-h">Marketing built around <em>where your book is now.</em></h2><p class="lp-lead">Every campaign starts with a free strategy call. Here are the three plans authors choose most.</p></div>
    <div class="rv lp-tiers">
      <div class="lp-tier"><h3>Launch a new book</h3><p>For books releasing in the next few months.</p><span class="lp-from">From</span><div class="lp-amt"><?= e($mk['price']) ?></div>
        <ul><?php foreach (['Launch plan and timeline', 'Amazon listing optimisation', 'Advance reader copy campaign', 'Launch-week Amazon ads', 'Email and social countdown'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <a class="btn btn-outline" href="#lp-form" data-lp-cta>Plan my launch</a></div>
      <div class="lp-tier feat"><span class="lp-tag">Most chosen</span><h3>Revive an existing book</h3><p>For published books that deserve more readers.</p><span class="lp-from">Quoted for</span><div class="lp-amt" style="font-size:2.2rem">Your book</div>
        <ul><?php foreach (['Listing and keyword audit', 'Cover and description review', 'Ongoing Amazon ad management', 'Review and Goodreads outreach', 'Monthly performance reports'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <a class="btn btn-primary" href="#lp-form" data-lp-cta>Boost my sales <?= ic('arrow') ?></a></div>
      <div class="lp-tier"><h3>Build your author brand</h3><p>For authors planning a series or a career.</p><span class="lp-from">Quoted for</span><div class="lp-amt" style="font-size:2.2rem">Your goals</div>
        <ul><?php foreach (['Author website and bio', 'Reader email list set-up', 'Social media content plan', 'Media and podcast pitching', 'Series and backlist strategy'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <a class="btn btn-outline" href="#lp-form" data-lp-cta>Build my brand</a></div>
    </div>
    <p class="note-small" style="text-align:center;margin-top:24px">Advertising budgets are separate, set by you and paid directly to the platform.</p>
  </div>
</section>

<section class="lp-band" aria-label="Get started">
  <div class="lp-w"><div><h2>Find out what would sell your book.</h2><p>Book a free strategy call with a book marketing expert.</p></div><?= lp_ctas('#lp-form2', 'Get My Free Plan', false) ?></div>
</section>

<!-- 5. Process -->
<section class="lp-sec alt" aria-labelledby="ps-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><h2 class="lp-h2" id="ps-h">A clear plan, <em>then steady results.</em></h2><p class="lp-lead">You approve the strategy and the budget. We do the work, track the numbers and keep improving.</p><?= lp_ctas('#lp-form', 'Start with a free call', false) ?></div>
    <ol class="lp-vsteps">
      <li><div><h3>Free strategy call</h3><p>We learn about your book, your readers, your goals and your budget.</p></div></li>
      <li><div><h3>Book &amp; market audit</h3><p>We review your cover, listing and reviews and study the best-selling books in your category.</p></div></li>
      <li><div><h3>Your marketing plan</h3><p>You get a written plan with channels, timeline, budget and the results we will track.</p></div></li>
      <li><div><h3>Listing &amp; brand set-up</h3><p>We optimise your Amazon page, author profile and website before driving traffic to them.</p></div></li>
      <li><div><h3>Campaigns go live</h3><p>Ads, review outreach, social content, email and media pitches launch on schedule.</p></div></li>
      <li><div><h3>Track, report &amp; improve</h3><p>Clear reports show what is working, and we move budget towards the channels that sell.</p></div></li>
    </ol>
  </div>
</section>

<?= lp_strip('Want more readers this month? Get a free marketing plan.') ?>

<!-- 6. Amazon focus -->
<section class="lp-sec" aria-labelledby="az-h">
  <div class="lp-w lp-split">
    <div class="lp-covers" style="--n:3"><?= lp_covers(3, 7) ?></div>
    <div><h2 class="lp-h2" id="az-h">Most books are sold on Amazon. <em>We make yours stand out.</em></h2><p class="lp-lead">Your Amazon page is your shop window. Before we spend a dollar on ads, we make sure it is ready to convert.</p>
      <ul class="lp-checks"><?php foreach (['Keyword and category research', 'Description written to sell', 'A+ content and author page', 'Price and promotion strategy', 'Sponsored product ads', 'Review and rating growth'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
    </div>
  </div>
</section>

<!-- 7. Compare -->
<section class="lp-sec soft" aria-labelledby="cp-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="cp-h">Why hire a book marketer <em>at AMZ United Press?</em></h2></div>
    <div class="rv lp-tablewrap"><table class="lp-table">
      <thead><tr><th scope="col"></th><th scope="col">Marketing it yourself</th><th scope="col">Large PR agencies</th><th scope="col" class="us">AMZ United Press</th></tr></thead>
      <tbody>
        <tr><th scope="row">Cost</th><td>Your time, plus trial-and-error ad spend</td><td>Often thousands per month</td><td class="us">From <?= e($mk['price']) ?>, quoted in writing</td></tr>
        <tr><th scope="row">Book-industry specialists</th><td class="n">—</td><td>Not always book-focused</td><td class="us y">✓ Books only</td></tr>
        <tr><th scope="row">Amazon ads &amp; listing expertise</th><td>Learn as you go</td><td>Often not included</td><td class="us y">✓ Core service</td></tr>
        <tr><th scope="row">You control the ad budget</th><td>Yes</td><td>Sometimes</td><td class="us y">✓ Always</td></tr>
        <tr><th scope="row">Clear, regular reporting</th><td class="n">—</td><td>Varies</td><td class="us y">✓ Every month</td></tr>
        <tr><th scope="row">Long contracts</th><td>None</td><td>Often required</td><td class="us y">✓ None required</td></tr>
      </tbody>
    </table></div>
  </div>
</section>

<!-- 8. Reviews -->
<section class="lp-sec" aria-labelledby="rv-h">
  <div class="lp-w">
    <div class="rv lp-head c"><h2 class="lp-h2" id="rv-h">Authors who <em>found their readers.</em></h2></div>
    <div class="rv lp-quotes"><?= lp_quotes() ?></div>
    <div class="lp-stats" style="margin-top:56px"><?= lp_stats() ?></div>
  </div>
</section>

<?= lp_strip('Book marketing that finds your readers.' . lp_offer_suffix()) ?>

<!-- 9. FAQ -->
<section class="lp-sec alt" aria-labelledby="fq-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><h2 class="lp-h2" id="fq-h">Book marketing <em>questions,</em> answered.</h2><p class="lp-lead">Want to talk it through? Call <a href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>" data-lp-call><?= e(site('phone')) ?></a>.</p><a class="btn btn-primary" href="#lp-form2" data-lp-cta>Ask a book marketer <?= ic('arrow') ?></a></div>
    <div class="faq lp-faq"><?= faq_html($FAQ, true) ?></div>
  </div>
</section>

<!-- 10. Final CTA -->
<section class="lp-sec lp-final" aria-labelledby="fn-h">
  <div class="lp-w lp-split">
    <div><p class="lp-kick">Free strategy call</p><h2 class="lp-h2" id="fn-h">Let’s get your book <em>in front of readers.</em></h2><p class="lp-lead">Tell us about your book and what success looks like for you. A book marketing expert will reply within one business day with ideas and a written plan.</p><?= lp_promises() ?></div>
    <?= lp_form('lp-form2', 'Get my free marketing plan', 'Takes about a minute. No obligation.', 4, 'Get My Free Plan') ?>
  </div>
</section>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
