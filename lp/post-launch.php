<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lx.php';

$FAQ = [
    ['Is this service for authors who already have books published?', 'Yes. The Revive & Scale System is designed for authors and publishers with existing books available on Amazon.'],
    ['Can you help if my book has very few sales?', 'Yes. We assess its discoverability, listing conversion, advertising, pricing and market position to determine whether there is a realistic opportunity for improvement.'],
    ['Do you only optimize existing books?', 'No. We also develop portfolio expansion strategies, including additional titles, new topics, series and future releases. Production of additional books can be scoped separately.'],
    ['Will you manage my Amazon Ads?', 'Amazon Ads setup, restructuring, management and ongoing optimization can be included based on the program selected and your account’s needs.'],
    ['Can you guarantee a certain number of sales?', 'No credible consultant can guarantee a specific sales volume or Amazon ranking. Our focus is on research-led improvements, measurable performance indicators and transparent reporting.'],
    ['What happens during the free audit?', 'We assess your current publishing performance, identify priority improvement opportunities, discuss your goals and outline a practical growth roadmap. A full implementation engagement is optional.'],
    ['Do I keep control of my KDP account?', 'Yes. Your books, account, rights and royalties stay yours. We work with the access you choose to give us, and every change is explained before it is made.'],
];
$meta = [
    'lp' => true, 'lx' => true,
    'title' => 'KDP Book Marketing for Published Authors: Revive & Scale | AMZ United Press',
    'description' => 'Your book is live but not selling? Our 90-day Revive & Scale System fixes keywords, listings and Amazon Ads, then plans your next books. Free KDP growth audit.',
    'path' => '/lp/post-launch', 'nav' => '',
    'schema' => lp_schema('KDP Revive & Scale System', 'A 90-day growth program for published Amazon KDP authors: performance audit, listing and conversion optimization, Amazon Ads management and portfolio expansion.', '/lp/post-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page lx" data-page="lp-post-launch">

<!-- Hero -->
<section class="lx-hero" aria-labelledby="lp-h1"><span class="lx-grid-bg" aria-hidden="true"></span><span class="lx-glow" aria-hidden="true"></span>
  <div class="w lx-hero-in">
    <div>
      <?= lx_kick('For published Amazon KDP authors & publishers') ?>
      <h1 class="lx-h1" id="lp-h1">Your book is published. <em>But is it actually selling?</em></h1>
      <p class="lx-lead"><b style="color:var(--tx)">Turn underperforming KDP books into a stronger, scalable publishing portfolio.</b> Low visibility, weak listings, ineffective advertising and poor positioning could be holding back your sales. The KDP Revive &amp; Scale System is a 90-day growth program that optimizes your existing books, improves their sales performance and builds a plan for expanding your catalog.</p>
      <?= lx_cta('Book my free KDP growth audit') ?>
      <ul class="lx-promise" style="margin-top:22px"><li><?= lx_i('check') ?>30-minute consultation</li><li><?= lx_i('check') ?>Personal account review</li><li><?= lx_i('check') ?>No obligation</li></ul>
      <?= lx_faces('Trusted by authors with <b>' . e(data('stats')[0][0] . data('stats')[0][1]) . ' books</b> on Amazon.') ?>
    </div>
    <?= lp_form('lp-form', 'Claim your free KDP growth audit', 'A $500 value. Tell us about your book and we’ll set up your 30-minute review.', 4, 'Book My Free Audit') ?>
  </div>
</section>

<?= lp_trust('We grow books on') ?>

<!-- Problems -->
<section class="lx-sec lx-alt" aria-labelledby="pb-h"><div class="w">
  <div class="lx-head"><?= lx_kick('Why sales stall') ?><h2 class="lx-h2" id="pb-h">You published your book. <em>So why aren’t the sales coming?</em></h2>
    <p class="lx-sub">Publishing is only the first step. Getting discovered, turning browsers into buyers and keeping momentum takes an ongoing strategy.</p></div>
  <div class="lx-probs">
  <?php $P = [['search', 'Your book is buried in Amazon search', 'Your keywords, categories and positioning may not be helping your book reach the right readers.'], ['eye', 'People see your book, but don’t buy', 'Your cover, description, pricing, reviews or product page may not give readers enough reason to purchase.'], ['chart', 'Your Amazon Ads aren’t delivering', 'You’re spending on advertising without a clear view of which campaigns generate profitable sales.'], ['layers', 'Your portfolio isn’t growing', 'You have published books, but no structured plan to improve existing titles and expand into new opportunities.']];
  foreach ($P as $i => $p): ?>
    <article class="lx-prob lx-rv" style="--d:<?= $i ?>"><span class="n" aria-hidden="true">0<?= $i + 1 ?></span><span class="lx-ib"><?= lx_i($p[0]) ?></span><h3><?= e($p[1]) ?></h3><p><?= e($p[2]) ?></p></article>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- System -->
<section class="lx-sec lx-light" aria-labelledby="sy-h"><div class="w lx-split">
  <div class="lx-sticky"><?= lx_kick('Introducing') ?><h2 class="lx-h2" id="sy-h">The KDP Revive &amp; Scale <em>System.</em></h2>
    <p class="lx-sub"><b style="color:#141413">One complete system to optimize existing books and build your next stage of growth.</b> We don’t simply run ads or change a few keywords. We look at the whole performance of your publishing business and fix what matters most.</p>
    <?= lx_cta('Get my free KDP growth audit') ?></div>
  <ol class="lx-pillars one">
  <?php $S = [['Complete KDP performance audit', 'Analyze sales, royalties, visibility, advertising performance, reader demand and catalog performance to find the biggest growth limits.'], ['Amazon listing & conversion optimization', 'Improve keywords, categories, descriptions, metadata, A+ Content where eligible, and cover positioning for discoverability and conversion.'], ['Amazon Ads strategy & management', 'Build or restructure campaigns, refine targeting, cut inefficient spend and optimize using performance data.'], ['Pricing, positioning & competitive research', 'Evaluate pricing, competing titles, market demand and reader expectations to find stronger opportunities.'], ['Review & reader engagement strategy', 'Amazon-compliant approaches that encourage authentic reader feedback and strengthen author credibility.'], ['Kindle portfolio expansion strategy', 'Spot opportunities for new books, related topics, series and categories using market research and your existing results.'], ['Performance tracking & reporting', 'Monitor sales, royalties, ad efficiency, keyword visibility and portfolio performance, so every big decision is backed by data.'], ['Strategic relaunch & ongoing optimization', 'Where the data supports it, run a structured relaunch and keep refining listings, ads and positioning.']];
  foreach ($S as $i => $s): ?>
    <li class="lx-rv"><span class="n">0<?= $i + 1 ?></span><div><h3><?= e($s[0]) ?></h3><p><?= e($s[1]) ?></p></div></li>
  <?php endforeach; ?>
  </ol>
</div></section>

<!-- Roadmap -->
<section class="lx-sec lx-alt" aria-labelledby="rm-h"><div class="w">
  <div class="lx-head"><?= lx_kick('Your 90-day roadmap') ?><h2 class="lx-h2" id="rm-h">From stalled sales to a <em>stronger publishing business.</em></h2></div>
  <ol class="lx-road">
  <?php $R = [['Days 1–15', 'Diagnose & discover', 'What is limiting your growth?', 'We audit your existing books, find performance gaps, assess market opportunities and set your highest-priority growth moves.'], ['Days 16–30', 'Rebuild the foundation', 'Is your foundation ready to grow?', 'We optimize listings, keywords, categories, positioning and conversion elements before increasing ad spend.'], ['Days 31–60', 'Optimize & build momentum', 'What is driving better performance?', 'We launch or refine Amazon Ads, monitor results, test improvements and build sustainable ways to grow sales.'], ['Days 61–90', 'Scale & expand', 'Ready to scale what works?', 'We double down on the best-performing strategies, evaluate new book opportunities and build your expansion plan.']];
  foreach ($R as $i => $r): ?>
    <li class="lx-rv" style="--d:<?= $i ?>"><span class="dot"><?= $i + 1 ?></span><div class="card"><small><?= e($r[0]) ?></small><h3><?= e($r[1]) ?></h3><em><?= e($r[2]) ?></em><p><?= e($r[3]) ?></p></div></li>
  <?php endforeach; ?>
  </ol>
  <p class="lx-goal lx-rv"><b>The goal:</b> a publishing business with stronger fundamentals, clearer performance data and a repeatable strategy for growth.</p>
  <p style="text-align:center;margin-top:30px"><?= lx_cta('Plan my KDP portfolio growth') ?></p>
</div></section>

<!-- Compare -->
<section class="lx-sec" aria-labelledby="vs-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('The difference', true) ?><h2 class="lx-h2" id="vs-h">Most KDP services fix one piece. We look at <em>why the whole book stalled.</em></h2></div>
  <div class="lx-vs">
    <div class="bad lx-rv"><h3>Typical KDP services</h3><ul><?php foreach (['Change a few keywords', 'Run ads on the listing you already have', 'Focus on traffic without checking conversion', 'Treat reviews, pricing and ads separately', 'Send reports without saying what matters first', 'Make changes without a recovery sequence', 'Move on when the first work is done'] as $x): ?><li><?= lx_i('x') ?><?= e($x) ?></li><?php endforeach; ?></ul></div>
    <div class="good lx-rv" style="--d:1"><h3>AMZ United Press Revive</h3><ul><?php foreach (['Start with a complete recovery audit', 'Rebuild keywords, categories and listing first', 'Repair the review pipeline', 'Build or rebuild Amazon Ads', 'Test pricing and positioning against real response', 'Follow a structured 90-day sequence', 'Track rank, reviews and revenue against your starting point'] as $x): ?><li><?= lx_i('check') ?><?= e($x) ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>

<!-- Approach -->
<section class="lx-sec lx-light" aria-labelledby="ap-h"><div class="w">
  <div class="lx-head"><?= lx_kick('How we work') ?><h2 class="lx-h2" id="ap-h">Your publishing business needs more than <em>another service provider.</em></h2>
    <p class="lx-sub">It needs a team that understands how book discovery, conversion, advertising and portfolio strategy work together.</p></div>
  <ol class="lx-steps c2">
  <?php $A = [['Discovery', 'We diagnose before we recommend', 'Every engagement starts with your current performance, market position and realistic growth potential.'], ['Strategy', 'We focus on the whole publishing business', 'From listings and advertising to portfolio planning, our advice links each book to your long-term goals.'], ['Analysis', 'We build around your actual data', 'We don’t apply one strategy to every author. Priorities depend on your books, audience, competition and performance.'], ['Execution', 'We give you a clear execution plan', 'You’ll know what needs improving, why it matters and how it fits your 90-day roadmap.']];
  foreach ($A as $i => $a): ?>
    <li class="lx-rv" style="--d:<?= $i % 2 ?>"><span class="n">0<?= $i + 1 ?></span><small>Step 0<?= $i + 1 ?> / <?= e($a[0]) ?></small><h3><?= e($a[1]) ?></h3><p><?= e($a[2]) ?></p></li>
  <?php endforeach; ?>
  </ol>
</div></section>

<!-- Case studies -->
<section class="lx-sec lx-alt" aria-labelledby="cs-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('Case studies', true) ?><h2 class="lx-h2" id="cs-h">Stalled books, <em>turned around.</em></h2></div>
  <div class="lx-cases">
    <?= lx_case(['tag' => 'Peak-month performance', 'title' => 'From 10 sales to 4,530', 'big' => '$52K in ad sales in a single month', 'text' => 'A sharper ad structure and a better-converting listing pushed one December past 4,500 orders while keeping ACOS well under 27%.', 'metrics' => [['26.64%', 'ACOS'], ['$52K+', 'Ad-attributed sales'], ['4,530', 'Orders in one month']], 'points' => [4, 4, 5, 6, 8, 11, 15, 22, 30, 44, 60, 78, 96]]) ?>
    <?= lx_case(['tag' => 'Long-term scale', 'title' => 'From stuck to scaling', 'big' => '24,456 book orders from Amazon Ads', 'text' => 'A structured ad strategy took a KDP account from slow, steady sales to a profitable, scalable machine, turning ad spend into real orders.', 'metrics' => [['34.15%', 'ACOS'], ['$282K+', 'Ad-attributed sales'], ['24,456', 'Orders']], 'points' => [20, 22, 21, 24, 26, 32, 38, 46, 52, 61, 70, 82, 92]]) ?>
  </div>
  <p class="lx-note lx-c">Figures from Amazon Ads dashboards of catalogs we manage. Results vary by book, niche and budget.</p>
</div></section>

<!-- Audit -->
<section class="lx-sec lx-light" aria-labelledby="au-h"><div class="w">
  <div class="lx-head"><?= lx_kick('Before you spend more on ads') ?><h2 class="lx-h2" id="au-h">Find out what’s <em>holding you back.</em></h2>
    <p class="lx-sub"><span class="lx-value">Free 30-minute KDP growth &amp; portfolio audit · <s>$500 value</s></span></p>
    <p class="lx-sub">During your consultation, we’ll review:</p></div>
  <div class="lx-audit">
  <?php $U = [['eye', 'Visibility gaps', 'Where keywords, categories or positioning may be limiting discovery.'], ['target', 'Listing conversion', 'What could be stopping readers from buying your books.'], ['chart', 'Advertising performance', 'Where campaigns may be inefficient or missing opportunities.'], ['trend', 'Sales & profitability', 'How current performance compares with your growth goals.'], ['layers', 'Portfolio opportunities', 'Whether more titles, series or categories make strategic sense.'], ['map', 'Your 90-day roadmap', 'The priority actions we recommend for your next stage of growth.']];
  foreach ($U as $i => $u): ?>
    <div class="lx-rv" style="--d:<?= $i % 3 ?>"><b><?= lx_i($u[0]) ?><?= e($u[1]) ?></b><p><?= e($u[2]) ?></p></div>
  <?php endforeach; ?>
  </div>
  <p class="lx-sub">We’ll also tell you honestly whether we’re the right partner to make those improvements. No pressure, no unrealistic promises: just an informed look at your publishing business.</p>
  <?= lx_cta('Book my free KDP growth audit') ?><span class="lx-btn-note">Limited consultation capacity so we have time for each account review.</span>
</div></section>

<?= lx_faq('Frequently asked <em>questions.</em>', $FAQ) ?>

<?= lx_final('Your next step', 'Your book is already live. Now give it <em>a strategy.</em>', 'Whether your books are struggling for visibility, your ads aren’t delivering, or you’re ready to grow your catalog, it starts with understanding your current performance. We’ll review your books, find your strongest opportunities and build a clear 90-day plan.',
    ['Free 30-minute growth audit ($500 value)', 'Personal review of your books and ads', 'No obligation'],
    ['Book your free KDP growth audit', 'For published KDP authors ready to grow. We reply within one business day.', 4, 'Book My Free Audit']) ?>

</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
