<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';

$st = data('stats');
$w = data('work');
$FAQ = [
    ['Is this for authors who already have books published?', 'Yes. The Revive & Scale System is built for authors and publishers with books already live on Amazon, whether you have one title or a whole catalog.'],
    ['Can you help if my book has very few sales?', 'Yes. We assess discoverability, listing conversion, advertising, pricing and market position to see whether there’s a realistic opportunity, and we’ll tell you honestly if there isn’t.'],
    ['What do I get from the free audit?', 'A 30-minute review of your books, listing and ads, the biggest gaps we find, and a practical 90-day roadmap. A full implementation engagement is optional.'],
    ['Will you manage my Amazon Ads?', 'Yes, if it’s right for your account. Ads setup, restructuring and ongoing optimization can be included. Your ad budget is set by you and paid directly to Amazon.'],
    ['Do I have to give you my KDP login?', 'No. We work with the access you choose to give, and Amazon Ads can be managed through a separate user role. Your account, books and royalties stay yours.'],
    ['Do you only optimize existing books?', 'No. We also plan portfolio growth: additional titles, series and new categories. Production of new books is scoped separately.'],
    ['Can you guarantee a certain number of sales?', 'No credible consultant can guarantee a specific sales number or Amazon rank. We focus on research-led improvements, measurable indicators and transparent reporting.'],
];
$meta = [
    'lp' => true, 'ad' => true, 'ad_btn' => 'Get My Free Audit', 'ad_strip' => 'Free 30-minute KDP growth audit ($500 value) · For published Amazon authors',
    'title' => 'Book Not Selling on Amazon? Free KDP Growth Audit | AMZ United Press',
    'description' => 'Your book is live but not selling? We fix keywords, listings and Amazon Ads in a 90-day Revive & Scale program. Book your free 30-minute KDP growth audit ($500 value).',
    'path' => '/lp/post-launch', 'nav' => '',
    'schema' => lp_schema('KDP Revive & Scale System', 'A 90-day growth program for published Amazon KDP authors: performance audit, listing and conversion optimization, Amazon Ads management and portfolio expansion.', '/lp/post-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-post-launch">

<!-- 1. Hero -->
<section class="ad-hero" aria-labelledby="lp-h1">
  <?= ad_float_books() ?>
  <div class="ad-w ad-hero-in">
    <div>
      <?= ad_kick('For published Amazon KDP authors') ?>
      <h1 class="ad-h1" id="lp-h1">Your book is on Amazon. <em>So why isn’t it selling?</em></h1>
      <p class="ad-lead">Most books don’t fail because they’re bad. They fail because readers never find them, or find them and don’t buy. Get a free 30-minute KDP growth audit and we’ll show you exactly what’s holding your book back.</p>
      <ul class="ad-hero-ticks">
        <li><?= ad_i('check') ?><span>Personal review of your listing, keywords and ads</span></li>
        <li><?= ad_i('check') ?><span>The 3 biggest fixes for your book, in plain English</span></li>
        <li><?= ad_i('check') ?><span>A 90-day growth roadmap. Free, no obligation</span></li>
      </ul>
      <?= ad_proof('Trusted by authors with <b>' . e($st[0][0] . $st[0][1]) . ' books</b> published through our team.') ?>
    </div>
    <?= ad_form('lp-form', 'Claim your free KDP growth audit', 'A $500 value. Tell us about your book. Add your Amazon link in the project box.', 4, 'Get My Free Audit', 'Free audit · $500 value') ?>
  </div>
</section>

<?= ad_logos('We grow books on') ?>

<!-- 2. Symptoms -->
<section class="ad-sec white" aria-labelledby="sy-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Does this sound like your book?', true) ?><h2 class="ad-h2" id="sy-h">Publishing was the easy part. <em>Selling is where it stalls.</em></h2></div>
  <ul class="ad-sym">
    <li class="ad-rv"><?= ad_i('search') ?><div><b>It’s buried in Amazon search</b><p>Your keywords, categories and positioning aren’t putting the book in front of the right readers.</p></div></li>
    <li class="ad-rv" style="--d:1"><?= ad_i('eye') ?><div><b>People see it, but don’t buy</b><p>The cover, description, price or reviews aren’t giving browsers a reason to click “Buy now”.</p></div></li>
    <li class="ad-rv" style="--d:2"><?= ad_i('chart') ?><div><b>Your Amazon Ads burn money</b><p>You’re spending on ads without knowing which campaigns, if any, are actually profitable.</p></div></li>
    <li class="ad-rv" style="--d:3"><?= ad_i('layers') ?><div><b>Nothing is growing</b><p>You have a book (or several) but no plan to improve them, or to decide what to publish next.</p></div></li>
  </ul>
</div></section>

<!-- 3. Video + diagnosis -->
<section class="ad-sec sand" aria-labelledby="vd-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('The Revive & Scale System', true) ?><h2 class="ad-h2" id="vd-h">We fix the listing first. <em>Then we buy traffic.</em></h2>
    <p class="ad-lead">Sending ads to a listing that doesn’t convert just burns budget. We diagnose the whole book, rebuild the foundations, then scale what works.</p></div>
  <div class="ad-vgrid">
    <?= ad_video('postlaunch', 'Revive & Scale · 20 sec', 'Short video: the 90-day Revive and Scale System for published KDP books') ?>
    <?= ad_vstats([['Program length', '90 days', 'A structured sequence, not random tweaks.'], ['Best managed ACOS', '26.64%', 'On a peak month of a managed account.'], ['Your free audit', '$500', 'Value, at no cost and no obligation.']]) ?>
  </div>
</div></section>

<!-- 4. Listing audit -->
<section class="ad-sec white" aria-labelledby="la-h"><div class="ad-w ad-split">
  <div class="ad-rv">
    <div class="ad-amz" aria-hidden="true">
      <img src="<?= e(ad_cover($w[7])) ?>" alt="">
      <div><h4><?= e($w[7]['t']) ?></h4><p class="by">by <?= e($w[7]['by']) ?> (Author)</p><p class="rk">Best Sellers Rank: #184,322 in Kindle Store</p><div class="bar"></div><div class="bar"></div><div class="bar s"></div><div class="bar"></div><div class="bar s"></div></div>
      <span class="ad-flag f1"><i>1</i>Cover doesn’t read at thumbnail size</span>
      <span class="ad-flag f2"><i>2</i>Subtitle has no keywords</span>
      <span class="ad-flag f3"><i>3</i>Wrong categories</span>
      <span class="ad-flag f4"><i>4</i>Description buries the hook</span>
    </div>
  </div>
  <div class="ad-rv" style="--d:1">
    <?= ad_kick('What an audit finds') ?>
    <h2 class="ad-h2" id="la-h">Small fixes on the page. <em>Big changes in sales.</em></h2>
    <p class="ad-lead">An example of the kind of issues we flag on a real listing review. Each one quietly costs clicks, conversions or both, and most can be fixed within days.</p>
    <ul class="ad-ticks"><li><?= ad_i('check') ?><span>Keywords, title, subtitle and categories</span></li><li><?= ad_i('check') ?><span>Cover positioning against bestsellers in your niche</span></li><li><?= ad_i('check') ?><span>Description, A+ content, price and reviews</span></li><li><?= ad_i('check') ?><span>Which ad campaigns to scale, fix or stop</span></li></ul>
  </div>
</div></section>

<!-- 5. System -->
<section class="ad-sec sand" aria-labelledby="sm-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('What’s included', true) ?><h2 class="ad-h2" id="sm-h">One complete system <em>for your existing books.</em></h2></div>
  <?= ad_cards([
      ['kdp', 'Step 1', 'Complete KDP performance audit', 'Sales, royalties, visibility, ads and catalog performance reviewed to find your biggest growth limits.'],
      ['editing', 'Step 2', 'Listing & conversion optimization', 'Keywords, categories, descriptions, metadata, A+ content and cover positioning rebuilt to convert.'],
      ['dashboard', 'Step 3', 'Amazon Ads strategy & management', 'Campaigns built or restructured, targeting refined and wasted spend cut using real data.'],
      ['proposal', 'Step 4', 'Pricing & competitive research', 'Prices, competing titles and reader expectations checked to find stronger positioning.'],
      ['call', 'Step 5', 'Reviews & reader engagement', 'Amazon-compliant ways to earn honest reviews and strengthen your author credibility.'],
      ['writing', 'Step 6', 'Relaunch & portfolio growth', 'A structured relaunch where data supports it, plus a plan for new titles and series.'],
  ]) ?>
</div></section>

<!-- 6. Roadmap -->
<section class="ad-sec white" aria-labelledby="rm-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Your 90-day roadmap', true) ?><h2 class="ad-h2" id="rm-h">From stalled sales to <em>a stronger publishing business.</em></h2></div>
  <?= ad_zz([
      ['kdp', 'search', 'Days 1–15', 'Diagnose & discover', 'We audit your books, find the performance gaps, assess market opportunities and set your highest-priority moves.', ['What is limiting your growth?']],
      ['editing', 'refresh', 'Days 16–30', 'Rebuild the foundation', 'Listings, keywords, categories, positioning and conversion elements are optimized before ad spend goes up.', ['Is your listing ready to convert?']],
      ['dashboard', 'chart', 'Days 31–60', 'Optimize & build momentum', 'We launch or refine Amazon Ads, monitor results, test improvements and build sustainable sales growth.', ['What is driving better performance?']],
      ['proposal', 'trend', 'Days 61–90', 'Scale & expand', 'We double down on the strategies that work, evaluate new book opportunities and plan your next stage.', ['Ready to scale what works?']],
  ]) ?>
</div></section>

<!-- 7. Case studies -->
<section class="ad-sec dark" aria-labelledby="cs-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Case studies', true) ?><h2 class="ad-h2" id="cs-h">Stalled books, <em>turned around.</em></h2></div>
  <div class="ad-cases">
    <?= ad_case(['tag' => 'Peak-month performance', 'kpis' => [['$13,999', 'Spend'], ['$52,546', 'Sales'], ['4,530', 'Orders'], ['26.64%', 'ACOS']], 'a' => [6, 8, 7, 10, 12, 16, 14, 24, 30, 44, 56, 74, 94], 'b' => [4, 5, 6, 8, 9, 12, 16, 20, 28, 38, 50, 66, 84],
        'title' => 'From 10 sales to 4,530', 'big' => '$52K in ad sales in a single month', 'text' => 'A sharper ad structure and a better-converting listing pushed one December past 4,500 orders while keeping ACOS under 27%.', 'tiles' => [['4,530', 'Orders in one month'], ['$52K+', 'Ad-attributed sales'], ['26.64%', 'ACOS']]]) ?>
    <?= ad_case(['tag' => 'Long-term scale', 'kpis' => [['$96,476', 'Spend'], ['$282,512', 'Sales'], ['24,456', 'Orders'], ['34.15%', 'ACOS']], 'a' => [22, 28, 24, 32, 30, 38, 34, 44, 42, 52, 50, 64, 76], 'b' => [18, 22, 26, 24, 30, 32, 36, 34, 42, 46, 52, 60, 70],
        'title' => 'From stuck to scaling', 'big' => '24,456 book orders from Amazon Ads', 'text' => 'A structured ad strategy took a KDP account from slow, steady sales to a profitable, scalable machine.', 'tiles' => [['24,456', 'Orders'], ['$282K+', 'Ad-attributed sales'], ['34.15%', 'ACOS']]]) ?>
  </div>
  <p class="ad-disc">Figures from Amazon Ads dashboards of accounts we manage. Results vary by book, niche and budget.</p>
</div></section>

<!-- 8. Compare -->
<section class="ad-sec sand" aria-labelledby="cp-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('The difference', true) ?><h2 class="ad-h2" id="cp-h">Most KDP services fix one piece. <em>We fix why the book stalled.</em></h2></div>
  <?= ad_compare(['Typical KDP services', 'Patch one thing', [['Change a few keywords', false], ['Run ads on the listing you already have', false], ['Focus on traffic, not conversion', false], ['Treat reviews, pricing and ads separately', false], ['Send reports without priorities', false], ['Move on when the first work is done', false]]],
                 ['AMZ United Press', 'Revive & Scale', [['Start with a complete recovery audit', true], ['Rebuild the listing before buying traffic', true], ['Repair the review pipeline', true], ['Build or rebuild Amazon Ads', true], ['Test pricing against real response', true], ['Track rank, reviews and revenue over 90 days', true]]]) ?>
</div></section>

<!-- 9. Audit deliverables -->
<section class="ad-sec dark" aria-labelledby="au-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Your free audit', true) ?><h2 class="ad-h2" id="au-h">Before you spend more on ads, <em>find out what’s holding you back.</em></h2>
    <p class="ad-lead"><span class="ad-value">Free 30-minute KDP growth audit · <s>$500 value</s></span></p></div>
  <ul class="ad-audit">
  <?php $U = [['search', 'Visibility gaps', 'Where keywords, categories or positioning limit discovery.'], ['eye', 'Listing conversion', 'What could be stopping readers from buying.'], ['chart', 'Advertising performance', 'Which campaigns waste money or miss opportunities.'], ['trend', 'Sales & profitability', 'How your numbers compare with your goals.'], ['layers', 'Portfolio opportunities', 'Whether new titles, series or categories make sense.'], ['map', 'Your 90-day roadmap', 'The priority actions for your next stage of growth.']];
  foreach ($U as $i => $u): ?><li class="ad-rv" style="--d:<?= $i % 3 ?>"><?= ad_i($u[0]) ?><b><?= e($u[1]) ?></b><p><?= e($u[2]) ?></p></li><?php endforeach; ?>
  </ul>
  <p class="ad-promise">No pressure and no unrealistic promises. <em>Just an honest look at your publishing business.</em></p>
  <div class="ad-c" style="text-align:center"><?= ad_cta('Book my free KDP growth audit', 'Limited audits each week so every account gets a real review.') ?></div>
</div></section>

<!-- 10. Books -->
<section class="ad-sec white" aria-labelledby="bk-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Books from our authors', true) ?><h2 class="ad-h2" id="bk-h">Real books, <em>real Amazon reviews.</em></h2></div>
  <?= ad_shelf(6, 5) ?>
</div></section>

<?= ad_faq('Frequently asked <em>questions.</em>', $FAQ) ?>

<?= ad_final('Your next step', 'Your book is live. Now give it <em>a strategy.</em>', 'Whether your book is invisible, your ads aren’t delivering or you’re ready to grow a catalog, it starts with understanding where you are. We’ll review your book and build a clear 90-day plan.',
    ['Free 30-minute growth audit ($500 value)', 'Personal review of your listing and ads', 'No obligation, no pressure'], ['Claim your free KDP growth audit', 'For published KDP authors. We reply within one business day.', 4, 'Get My Free Audit']) ?>

<?= ad_dock('Free audit') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
