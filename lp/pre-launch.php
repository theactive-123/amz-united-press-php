<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';

$G = '$6,000';   // minimum sales target in the guarantee
$st = data('stats');
$w = data('work');
$FAQ = [
    ['Do I need to have a manuscript ready?', 'No. We handle the whole process: market research, outlining, writing, editing, cover design, formatting and publishing. You approve the topics and the finished books.'],
    ['How many books will be launched?', 'Three books every month for four months: 12 books over 120 days, each researched, written, designed, published and advertised.'],
    ['Whose account are the books published on?', 'Yours. Every book goes live on your own Amazon KDP account, under your name or pen name. You keep 100% of the rights and every royalty Amazon pays.'],
    ['Do you only publish the books?', 'No. We handle the complete workflow: research, writing, editing, design, KDP setup, positioning, Amazon Ads and ongoing optimization.'],
    ['Do I need to manage writers or designers?', 'No. You get one team and one project manager instead of a string of freelancers.'],
    ['What happens after the books go live?', 'We keep tracking and optimizing listings, pricing and Amazon Ads throughout the 120-day roadmap, and plan the next stage with you.'],
    ['How does the guarantee work?', 'The program includes a minimum ' . $G . ' sales target within the agreed guarantee period. If it isn’t reached, your investment is refunded according to the guarantee terms, which you receive in writing before you start.'],
    ['Is ad spend included?', 'Your Amazon Ads budget is set by you and paid directly to Amazon from your own account. We agree the budget together before launch, and our management is part of the program.'],
];
$meta = [
    'lp' => true, 'ad' => true, 'ad_btn' => 'Book a Free Call', 'ad_strip' => 'Minimum ' . $G . ' sales target · 12 books in 120 days · Published on your own KDP account',
    'title' => '12 Books in 120 Days, Minimum ' . $G . ' in Sales | KDP Portfolio Program | AMZ United Press',
    'description' => 'We research, write, publish and advertise 3 books a month for 120 days on your KDP account. Minimum ' . $G . ' in sales or your money back. Book a free strategy call.',
    'path' => '/lp/pre-launch', 'nav' => '',
    'schema' => lp_schema('120-Day KDP Portfolio Program', 'A done-for-you Amazon KDP program: 12 books researched, written, designed, published and advertised over 120 days.', '/lp/pre-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-pre-launch">

<!-- 1. Hero -->
<section class="ad-hero" aria-labelledby="lp-h1">
  <?= ad_float_books() ?>
  <div class="ad-w ad-hero-in">
    <div>
      <?= ad_kick('The 120-day KDP portfolio program') ?>
      <h1 class="ad-h1" id="lp-h1">12 books on Amazon in 120 days. <em>Minimum <?= e($G) ?> in sales, or your money back.*</em></h1>
      <p class="ad-lead">Stop betting everything on one book. We research the market, write, design, publish and advertise three books every month, on your own KDP account, so you build a catalog that earns instead of a single title that hopes.</p>
      <ul class="ad-hero-ticks">
        <li><?= ad_i('check') ?><span>Done for you: research, writing, design, publishing and ads</span></li>
        <li><?= ad_i('check') ?><span>Published on your KDP account. 100% of royalties to you</span></li>
        <li><?= ad_i('check') ?><span>Minimum <?= e($G) ?> sales target, backed by a written guarantee</span></li>
      </ul>
      <?= ad_proof('<b>' . e($st[0][0] . $st[0][1]) . ' books</b> published for <b>' . e($st[1][0] . $st[1][1]) . ' authors</b> by the AMZ United Press team.') ?>
    </div>
    <?= ad_form('lp-form', 'Book your free KDP strategy call', 'Tell us where you are. We’ll map out your 12-book plan on a free 30-minute call.', 7, 'Book My Free Strategy Call', 'Limited spots each month') ?>
  </div>
</section>

<?= ad_logos('Your books, live on') ?>

<!-- 2. Video -->
<section class="ad-sec white" aria-labelledby="vd-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('See the program in 20 seconds', true) ?><h2 class="ad-h2" id="vd-h">One team. Four months. <em>Twelve books.</em></h2></div>
  <div class="ad-vgrid">
    <?= ad_video('prelaunch', '120-day program · 20 sec', 'Short video: the four months of the 120-day KDP portfolio program') ?>
    <?= ad_vstats([['Books launched', '12', 'Three new titles every month for four months.'], ['Program length', '120 days', 'Research to ads, with a clear roadmap.'], ['Sales target', $G, 'Minimum, backed by a written guarantee.*']]) ?>
  </div>
</div></section>

<!-- 3. Problem -->
<section class="ad-sec sand" aria-labelledby="pr-h"><div class="ad-w ad-split">
  <div class="ad-rv">
    <?= ad_kick('The problem') ?>
    <h2 class="ad-h2" id="pr-h">One book is not a <em>publishing strategy.</em></h2>
    <p class="ad-lead" style="margin-bottom:12px">Most authors spend months on one book, publish it, and only then discover the real work. They still need to figure out:</p>
    <ul class="ad-chips"><li>Which keywords to target</li><li>Which categories to enter</li><li>How to price the book</li><li>How to get reviews</li><li>How to run Amazon Ads</li><li>How to improve the listing</li><li>What to publish next</li></ul>
    <p class="ad-lead" style="margin-top:24px">By then the book is already live, and every mistake is public. <b style="color:#141413">One title gives you one chance. A portfolio gives you data, momentum and many chances to win.</b></p>
  </div>
  <div class="ad-photo ad-rv" style="--d:1"><?= ad_img('dashboard', 'A self-publishing dashboard showing a single book') ?><span class="badge"><i>LIVE</i>1 book · no plan for what’s next</span></div>
</div></section>

<!-- 4. 120-day plan -->
<section class="ad-sec sand" style="padding-top:0" aria-labelledby="pl-h"><div class="ad-w">
  <div class="ad-head">
    <?= ad_kick('The 120-day plan') ?><h2 class="ad-h2" id="pl-h">3 books every month. <em>12 books across 120 days.</em></h2>
    <p class="ad-lead">Each month builds on the last. Early sales data shapes the next titles, so the portfolio gets stronger as it grows.</p></div>
  <div class="ad-months">
  <?php $M = [['Books 1–3', 'Research & first launches', ['Research niches, competitors and demand', 'Write and design the first three titles', 'Launch with the right keywords and categories']], ['Books 4–6', 'Learn from real data', ['Launch the next three titles', 'Review early sales and reader response', 'Improve listings and ad campaigns']], ['Books 7–9', 'Double down on winners', ['Expand into the strongest niches', 'Optimize based on market response', 'Grow reviews and visibility']], ['Books 10–12', 'Complete the portfolio', ['Finish the 12-book catalog', 'Strengthen Amazon Ads across titles', 'Plan your next stage of growth']]];
  foreach ($M as $i => $m): ?>
    <article class="ad-month ad-rv" style="--d:<?= $i ?>"><span class="dot"><?= $i + 1 ?></span><div class="card"><small>Month <?= $i + 1 ?></small><h3><?= e($m[0]) ?></h3>
      <div class="stack" aria-hidden="true"><?php for ($k = 0; $k < 3; $k++): ?><img src="<?= e(ad_cover($w[($i * 3 + $k) % count($w)])) ?>" alt="" loading="lazy"><?php endfor; ?></div>
      <p style="font-weight:700;margin:0 0 6px"><?= e($m[1]) ?></p><ul><?php foreach ($m[2] as $x): ?><li><?= e($x) ?></li><?php endforeach; ?></ul></div></article>
  <?php endforeach; ?>
  </div>
  <div class="ad-endnote ad-rv"><b>12</b><p><strong>At the end of 120 days</strong>You don’t have one book sitting on Amazon. You have a complete, advertised portfolio of 12 books, and the data to decide what comes next.</p></div>
</div></section>

<!-- 5. What we handle -->
<section class="ad-sec white" aria-labelledby="wh-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Other companies give you one piece', true) ?><h2 class="ad-h2" id="wh-h">We handle <em>the whole launch.</em></h2>
    <p class="ad-lead">No hiring one person for writing, another for design and someone else for ads. One team runs the complete publishing journey for every book.</p></div>
  <?= ad_zz([
      ['proposal', 'search', 'Niche & market research', 'Research before we write a word', 'We study demand, competitors, pricing and keywords to choose topics with real buyers, then agree the list with you.', ['Niche and competitor analysis', 'Topic selection you approve']],
      ['writing', 'pen', 'Writing & editing', 'Professional writing and editing', 'Experienced writers draft each book and editors polish every page, so the catalog reads like it came from a publishing house.', ['Scripting and book writing', 'Editing and content refinement']],
      ['design', 'book', 'Covers & formatting', 'Covers that win the click', 'Genre-right covers, clean interiors and A+ content that make shoppers stop scrolling and start reading.', ['Cover design and interior formatting', 'A+ content where eligible']],
      ['dashboard', 'trend', 'Publishing, ads & growth', 'Launched with ads, then optimized', 'KDP setup, titles, descriptions, keywords, categories and pricing, then Amazon Ads and ongoing optimization as data comes in.', ['KDP setup and positioning', 'Amazon Ads and listing optimization', 'Performance tracking and price testing']],
  ]) ?>
</div></section>

<!-- 6. Case studies -->
<section class="ad-sec dark" aria-labelledby="cs-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Case studies', true) ?><h2 class="ad-h2" id="cs-h">Real numbers from <em>Amazon Ads accounts we run.</em></h2></div>
  <div class="ad-cases">
    <?= ad_case(['tag' => 'Peak-month performance', 'kpis' => [['$54,424', 'Spend'], ['$131,604', 'Sales'], ['3,849', 'Orders'], ['40.58%', 'ACOS']], 'a' => [12, 16, 14, 22, 18, 30, 26, 38, 32, 46, 42, 60, 74], 'b' => [8, 10, 9, 12, 11, 15, 18, 22, 28, 40, 58, 74, 92],
        'title' => 'Built slow. Scaled fast.', 'big' => '3,849 books sold. $131K in sales.', 'text' => 'A smart pre-launch setup, patient testing early on, and aggressive scaling once the winners were clear.', 'tiles' => [['3,849', 'Books sold'], ['$131K', 'Sales'], ['$52K+', 'Peak-month ad sales']]]) ?>
    <?= ad_case(['tag' => 'Long-term scale', 'kpis' => [['$209,035', 'Spend'], ['$497,054', 'Sales'], ['14,052', 'Orders'], ['41.58%', 'ACOS']], 'a' => [34, 48, 40, 56, 44, 54, 42, 62, 50, 66, 58, 76, 86], 'b' => [26, 32, 38, 30, 44, 40, 50, 42, 52, 60, 56, 70, 82],
        'title' => 'From one book to a KDP portfolio', 'big' => '14,052 books sold. $497K in sales.', 'text' => 'Keyword research, a strong pre-launch setup and scaling the winning campaigns turned ads into real sales across a catalog.', 'tiles' => [['14,052', 'Books sold'], ['$497K', 'Sales'], ['$282K+', 'Ad-attributed sales']]]) ?>
  </div>
  <p class="ad-disc">Figures from Amazon Ads dashboards of catalogs we manage. Results vary by niche, books and budget, and are not a promise of earnings.</p>
</div></section>

<!-- 7. Compare -->
<section class="ad-sec sand" aria-labelledby="cp-h"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('The difference', true) ?><h2 class="ad-h2" id="cp-h">From publish &amp; hope to <em>a complete KDP system.</em></h2></div>
  <?= ad_compare(['On your own', 'Publish and hope', [['One book', false], ['Multiple freelancers', false], ['Random keyword research', false], ['Guessing categories', false], ['Ads added later, if ever', false], ['No clear roadmap', false], ['No minimum target', false]]],
                 ['AMZ United Press', 'The 120-day program', [['12 books', true], ['One team, one manager', true], ['Research before publishing', true], ['Keywords & categories planned', true], ['Amazon Ads built into every launch', true], ['A 120-day roadmap', true], ['Minimum ' . $G . ' sales target', true]]]) ?>
</div></section>

<!-- 8. Guarantee -->
<section class="ad-sec white" id="guarantee" aria-labelledby="gu-h"><div class="ad-w">
  <div class="ad-guar ad-rv">
    <div class="ad-seal"><div><small>Minimum sales target</small><b><?= e($G) ?></b><small>or your money back*</small></div></div>
    <div>
      <?= ad_kick('The guarantee') ?><h2 class="ad-h2" id="gu-h">We put a target <em>behind the work.</em></h2>
      <p class="ad-lead">Most publishing services stop once your book is uploaded. We don’t. If the agreed minimum of <?= e($G) ?> in sales isn’t reached within the guarantee period, your investment is refunded according to the guarantee terms.</p>
      <p style="font-weight:700;margin:0">Why can we stand behind it? Because we’re not betting everything on:</p>
      <div class="ad-not"><span>One book</span><span>One launch day</span><span>One ad</span><span>One keyword</span></div>
      <p class="ad-lead" style="margin:0 0 24px">We’re building, and optimizing, a whole portfolio.</p>
      <?= ad_cta('Show me how the guarantee works') ?>
    </div>
  </div>
</div></section>

<!-- 9. Authors -->
<section class="ad-sec sand" aria-labelledby="au-h" style="padding-bottom:clamp(90px,10vw,140px)"><div class="ad-w">
  <div class="ad-head ad-c"><?= ad_kick('Our author community', true) ?><h2 class="ad-h2" id="au-h">Authors who published <em>with our team.</em></h2></div>
  <?= ad_authors(10) ?>
</div></section>

<?= ad_next('Here’s exactly <em>what happens next.</em>', 'A free 30-minute strategy call. No pitch deck, no pressure.',
    [['Tell us your goals', 'Fill in the short form so we understand where you are and what you want from KDP.'], ['We map your 12 books', 'We walk you through likely niches, the 120-day plan and how the ' . $G . ' target works.'], ['You decide', 'If the program fits, we start. If it doesn’t, we’ll tell you, and point you to something that does.']],
    'We take on a limited number of portfolios each month, <em>so every catalog gets real attention.</em>', 'Book my free KDP strategy call') ?>

<?= ad_faq('The questions people ask <em>right before they start.</em>', $FAQ) ?>

<?= ad_final('120 days from now', 'Where do you <em>want to be?</em>', 'Still trying to finish and launch one book, or looking at 12 professionally built titles live on Amazon, with ads running and data guiding what’s next?',
    ['12 books in 120 days, done for you', 'Minimum ' . $G . ' sales target*', 'Your account, your rights, your royalties'], ['Book your free KDP strategy call', 'Limited spots each month. We reply within one business day.', 7, 'Book My Free Strategy Call']) ?>
<p style="max-width:900px;margin:0 auto;padding:26px 20px 40px;font-size:.8rem;color:#77726A;text-align:center">*The minimum sales target and refund apply subject to the eligibility requirements and guarantee terms provided in writing before you start. Amazon Ads spend is paid by you directly to Amazon.</p>

<?= ad_dock('Book a call') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
