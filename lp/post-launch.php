<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';
require dirname(__DIR__) . '/includes/adx.php';

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
    'lp' => true, 'ad' => true, 'adx' => 'dark', 'ad_btn' => 'Free Audit',
    'title' => 'Book Not Selling on Amazon? Free KDP Growth Audit | AMZ United Press',
    'description' => 'Your book is live but not selling? We fix keywords, listings and Amazon Ads in a 90-day Revive & Scale program. Book your free 30-minute KDP growth audit ($500 value).',
    'path' => '/lp/post-launch', 'nav' => '',
    'schema' => lp_schema('KDP Revive & Scale System', 'A 90-day growth program for published Amazon KDP authors: performance audit, listing and conversion optimization, Amazon Ads management and portfolio expansion.', '/lp/post-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-post-launch">

<!-- 1. Hero -->
<section class="x-hero" aria-labelledby="lp-h1">
  <?= x_deco() ?>
  <div class="x-w x-nw">
    <p class="x-label">For published Amazon KDP authors &amp; publishers</p>
    <h1 class="x-h1" id="lp-h1">Your book is published. <span class="a">But is it actually selling?</span></h1>
    <span class="x-hl x-acc" style="text-transform:none;letter-spacing:0">Turn underperforming KDP books into a stronger, scalable publishing portfolio.</span>
    <p class="x-sub">Your book is already live on Amazon. But low visibility, weak listings, ineffective advertising and poor positioning could be holding its sales back. Introducing the <b class="x-strong">Revive &amp; Scale System</b>: a 90-day growth program that improves your existing books and builds a plan for what comes next.</p>
  </div>
  <div class="x-w">
    <div class="x-frame"><?= ad_video('postlaunch', 'Revive & Scale · 20 sec', 'Short video: the 90-day Revive and Scale System for published KDP books') ?></div>
    <?= x_cta('Book my free KDP growth audit, a $500 value', '') ?>
    <div class="x-ticks-line"><span><?= ad_i('check') ?>30-minute consultation</span><span><?= ad_i('check') ?>Personal account review</span><span><?= ad_i('check') ?>No obligation</span></div>
  </div>
</section>

<!-- 2. Why aren't sales coming -->
<section class="x-sec b2" aria-labelledby="pr-h"><div class="x-w">
  <?= x_head('pr-h', 'You published your book. <span class="a">So why aren’t the sales coming?</span>', '', 'Publishing a book is only the first step. Getting it discovered, turning browsers into buyers and keeping sales momentum takes an ongoing strategy.', 'l') ?>
  <div class="x-circles">
  <?php $P = [['Your book is buried in Amazon search', 'Your keywords, categories and positioning may not be putting the book in front of the right readers.'], ['People see your book, but don’t buy', 'Your cover, description, price, reviews or product page may not give browsers a reason to buy.'], ['Your Amazon Ads aren’t delivering', 'You’re spending on ads without a clear picture of which campaigns, if any, are profitable.'], ['Your publishing portfolio isn’t growing', 'You have published books, but no structured plan to improve them or expand into new titles.']];
  foreach ($P as $i => $p): ?><div class="x-circle ad-rv" style="--d:<?= $i ?>"><span class="n">0<?= $i + 1 ?></span><h3><?= e($p[0]) ?></h3><p><?= e($p[1]) ?></p></div><?php endforeach; ?>
  </div>
</div></section>

<!-- 3. The system -->
<section class="x-sec glow line" aria-labelledby="sm-h"><div class="x-w">
  <?= x_head('sm-h', 'Introducing the <span class="a i">Revive &amp; Scale</span> system', '', '<b class="x-strong">One complete system to optimize your existing books and build your next stage of growth.</b> We don’t just run ads or change a few keywords. We look at the whole performance of your publishing business and fix what matters most.') ?>
  <div class="x-grid">
  <?php $Y = [['Complete KDP performance audit', 'Sales, royalties, visibility, ads, reader demand and catalog performance reviewed to find your biggest growth limits.'], ['Listing & conversion optimization', 'Keywords, categories, descriptions, metadata, A+ content and cover positioning rebuilt to convert.'], ['Amazon Ads strategy & management', 'Campaigns built or restructured, targeting refined and wasted spend cut using real performance data.'], ['Pricing & competitive research', 'Prices, competing titles, market demand and reader expectations checked to find stronger positioning.'], ['Review & reader engagement', 'Amazon-compliant ways to earn honest reviews, strengthen author credibility and improve the reader experience.'], ['Portfolio expansion planning', 'New titles, series and categories evaluated against market research and your existing books.'], ['Performance tracking & reporting', 'Sales, royalties, ad efficiency, keyword visibility and portfolio performance tracked, so every decision has data behind it.'], ['Strategic relaunch & ongoing optimization', 'Where the data supports it, a structured relaunch, then continuous refinement of listings and ads.'], ['Your 90-day growth roadmap', 'A clear plan of what changes, when, and why, so you always know what comes next.']];
  foreach ($Y as $i => $y): ?><div class="ad-rv" style="--d:<?= $i % 3 ?>"><b>0<?= $i + 1 ?></b><h3><?= e($y[0]) ?></h3><p><?= e($y[1]) ?></p></div><?php endforeach; ?>
  </div>
  <?= x_cta('Get my free KDP growth audit') ?>
</div></section>

<!-- 4. 90-day roadmap -->
<section class="x-sec b2" aria-labelledby="rm-h"><div class="x-w">
  <?= x_head('rm-h', 'Your 90-day roadmap from stalled sales to a <span class="a">stronger publishing business.</span>') ?>
  <div class="x-road">
  <?php $R = [['search', 'Days 1–15', 'Diagnose & discover', 'What is limiting your growth?', 'We audit your books, find performance gaps, assess market opportunities and set your highest-priority moves.'], ['refresh', 'Days 16–30', 'Rebuild the foundation', 'Is your foundation ready to grow?', 'We optimize listings, keywords, categories, positioning and conversion before increasing ad spend.'], ['chart', 'Days 31–60', 'Optimize & build momentum', 'What is driving better performance?', 'We launch or refine Amazon Ads, monitor performance, test improvements and build sustainable sales.'], ['trend', 'Days 61–90', 'Scale & expand', 'Ready to scale what works?', 'We double down on the best-performing strategies, evaluate new book opportunities and plan your next stage.']];
  foreach ($R as $i => $r): ?><div class="ad-rv" style="--d:<?= $i ?>"><span class="ic-b"><?= ad_i($r[0]) ?></span><h3><?= e($r[1]) ?></h3><h4><?= e($r[2]) ?></h4><p class="q"><?= e($r[3]) ?></p><p><?= e($r[4]) ?></p></div><?php endforeach; ?>
  </div>
  <p class="x-goal">The goal: a publishing business with <span class="x-acc">stronger fundamentals, better performance visibility</span> and a repeatable strategy for growth.</p>
  <?= x_cta('Plan my KDP portfolio growth') ?>
</div></section>

<!-- 5. Compare -->
<section class="x-sec line" aria-labelledby="cp-h"><div class="x-w">
  <?= x_head('cp-h', 'Most KDP services fix one piece. <span class="a">We look at why the whole book stalled.</span>') ?>
  <?= x_vs(['Typical KDP services', 'Patch one thing', ['Change a few keywords', 'Run ads on the listing you already have', 'Focus on traffic without checking conversion', 'Treat reviews, pricing and ads separately', 'Send reports without telling you what matters first', 'Make changes without a clear recovery sequence', 'Move on when the first work is finished']],
           ['AMZ United Press', 'Revive & Scale', ['Start with a complete recovery audit', 'Rebuild keywords, categories and listing first', 'Repair the review pipeline', 'Build or rebuild Amazon Ads', 'Test pricing and positioning against real response', 'Follow a structured 90-day recovery sequence', 'Track rank, reviews and revenue against your starting point']]) ?>
</div></section>

<!-- 6. How we work: timeline -->
<section class="x-sec b2 glow" aria-labelledby="tl-h"><div class="x-w">
  <?= x_head('tl-h', 'Your publishing business needs more than <span class="a">another service provider.</span>', '', 'It needs a team that understands how book discovery, conversion, advertising and portfolio strategy work together.') ?>
  <ol class="x-tl">
  <?php $T = [['Discovery', 'We diagnose before we recommend', 'Every engagement starts with understanding your current performance, market position and realistic growth potential.'], ['Strategy', 'We focus on the whole publishing business', 'From listing optimization to portfolio planning, our recommendations connect each book’s performance with your long-term goals.'], ['Analysis', 'We build around your actual data', 'We don’t apply the same playbook to every author. Priorities depend on your books, audience, competition and numbers.'], ['Execution', 'We give you a clear execution plan', 'You’ll know what needs improving, why it matters, and how each change fits into your 90-day roadmap.']];
  foreach ($T as $i => $t): ?><li class="ad-rv"><span class="dot"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><div><small>Step 0<?= $i + 1 ?> / <?= e($t[0]) ?></small><h3><?= e($t[1]) ?></h3><p><?= e($t[2]) ?></p></div></li><?php endforeach; ?>
  </ol>
</div></section>

<!-- 7. Free audit -->
<section class="x-sec line" aria-labelledby="au-h"><div class="x-w x-c">
  <?= x_head('au-h', 'Before you spend more on Amazon Ads or publish another book, <span class="a">find out what’s holding you back.</span>', '', 'Claim your <b class="x-strong">free</b> 30-minute KDP growth &amp; portfolio audit. <b class="x-acc">$500 value.</b> During your consultation, we’ll review:') ?>
  <ul class="x-tilt">
  <?php $U = [['Visibility gaps', 'Where your keywords, categories or positioning may be limiting discovery.'], ['Listing conversion', 'What could be stopping readers from buying your books.'], ['Advertising performance', 'Where campaigns may be inefficient or missing opportunities.'], ['Sales & profitability', 'How current performance compares with your growth goals.'], ['Portfolio opportunities', 'Whether additional titles, series or categories make strategic sense.'], ['Your 90-day roadmap', 'The priority actions we recommend for your next stage of growth.']];
  foreach ($U as $i => $u): ?><li class="ad-rv" style="--d:<?= $i % 3 ?>"><b><?= e($u[0]) ?></b><p><?= e($u[1]) ?></p></li><?php endforeach; ?>
  </ul>
  <p class="x-goal" style="font-size:1.3rem">We’ll also tell you whether AMZ United Press is the right partner to help <span class="x-acc">implement those improvements.</span></p>
  <p style="color:var(--x-tx3);margin:12px 0 0">No pressure. No unrealistic promises. Just an informed look at your publishing business.</p>
  <?= x_cta('Book my free KDP growth audit', 'Limited audits each week, so every account gets a real review.') ?>
</div></section>

<!-- 8. Case studies -->
<section class="x-sec b2 glow" aria-labelledby="cs-h"><span class="x-edge" aria-hidden="true"></span><div class="x-w">
  <?= x_head('cs-h', 'Case <span class="a i">studies</span>', '', 'Stalled books, turned around. Real numbers from Amazon Ads accounts we manage.') ?>
  <div class="x-cases">
    <?= x_case(['tag' => 'Peak-month performance', 'kpis' => [['$13,999', 'Spend'], ['$52,546', 'Sales'], ['4,530', 'Orders'], ['26.64%', 'ACOS']], 'a' => [6, 8, 7, 10, 12, 16, 14, 24, 30, 44, 56, 74, 94], 'b' => [4, 5, 6, 8, 9, 12, 16, 20, 28, 38, 50, 66, 84],
        'title' => 'From 10 sales to 4,530', 'big' => '$52K in ad sales in a single month', 'text' => 'A sharper ad structure and a better-converting listing pushed one December past 4,500 orders while keeping ACOS under 27%.', 'tiles' => [['4,530', 'Orders in one month'], ['$52K+', 'Ad-attributed sales'], ['26.64%', 'ACOS']]]) ?>
    <?= x_case(['tag' => 'Long-term scale', 'kpis' => [['$96,476', 'Spend'], ['$282,512', 'Sales'], ['24,456', 'Orders'], ['34.15%', 'ACOS']], 'a' => [22, 28, 24, 32, 30, 38, 34, 44, 42, 52, 50, 64, 76], 'b' => [18, 22, 26, 24, 30, 32, 36, 34, 42, 46, 52, 60, 70],
        'title' => 'From stuck to scaling', 'big' => '24,456 book orders from Amazon Ads', 'text' => 'A structured ad strategy took a KDP account from slow, steady sales to a profitable, scalable machine.', 'tiles' => [['24,456', 'Orders'], ['$282K+', 'Ad-attributed sales'], ['34.15%', 'ACOS']]]) ?>
  </div>
  <p class="x-disc">Figures from Amazon Ads dashboards of accounts we manage. Results vary by book, niche and budget.</p>
</div></section>

<!-- 9. Form -->
<section class="x-sec line" aria-labelledby="bk-h"><div class="x-w">
  <?= x_formsec('bk-h', 'Ready to revive &amp; scale <span class="a">your KDP business?</span>', 'Book your free 30-minute growth audit and find out what’s holding back your book sales. Add your Amazon book link in the project box.',
      ['Personal review of your listing, keywords and ads', 'The biggest fixes for your book, in plain English', 'A 90-day growth roadmap', 'Free, a $500 value, no obligation'],
      ['lp-form', 'Claim your free KDP growth audit', 'Tell us about your book. Add your Amazon link in the project box.', 4, 'Get My Free Audit', 'Free audit · $500 value'], 'Free growth audit') ?>
</div></section>

<!-- 10. FAQ -->
<section class="x-sec b2" aria-labelledby="fq-h"><div class="x-w">
  <?= x_head('fq-h', 'Frequently asked <span class="a i">questions</span>') ?>
  <?= x_faq($FAQ) ?>
</div></section>

<!-- 11. Final -->
<section class="x-sec" aria-labelledby="fn-h"><div class="x-w">
  <?= x_final('Your book is already live. <span class="a">Now give it a strategy for what comes next.</span>', 'Whether your books are struggling to be found, your advertising isn’t delivering or you’re ready to grow your catalog, the next step starts with understanding where you are today. We’ll review your books, find your strongest opportunities and build a clear 90-day plan.',
      ['Listing review', 'Keywords & categories', 'Amazon Ads', 'Pricing', 'Reviews', 'Portfolio growth'], '', 'Book my free KDP growth audit, $500 value', 'For published Amazon KDP authors and publishers ready to grow existing books.') ?>
</div></section>

<?= ad_dock('Free audit') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
