<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/kx.php';

$FAQ = [
    ['Is this service for authors who already have books published?', 'Yes. The REVIVE & SCALE System is specifically designed for authors and publishers with existing books available on Amazon.'],
    ['Can you help if my book has very few sales?', 'Yes. We can assess its discoverability, listing conversion, advertising, pricing, and market position to determine whether there is a realistic opportunity for improvement.'],
    ['Do you only optimize existing books?', 'No. We also develop portfolio expansion strategies, including opportunities for additional titles, new topics, series, and future releases. Production of additional books can be scoped separately.'],
    ['Will you manage my Amazon Ads?', 'Amazon Ads setup, restructuring, management, and ongoing optimization can be included based on the program selected and your account’s needs.'],
    ['Can you guarantee a certain number of sales?', 'No credible consultant can guarantee a specific sales volume or Amazon ranking. Our focus is on research-led improvements, measurable performance indicators, and transparent reporting.'],
    ['What happens during the free audit?', 'We assess your current publishing performance, identify priority improvement opportunities, discuss your goals, and outline a practical growth roadmap. A complete implementation engagement is optional.'],
];
$meta = [
    'lp' => true, 'kx' => true, 'kx_btn' => 'Book Now',
    'title' => 'Your Book Is Published. Is It Selling? KDP Revive & Scale | AMZ United Press',
    'description' => 'Turn underperforming KDP books into a stronger, scalable publishing portfolio. A 90-day growth program for published authors. Book your free KDP growth audit.',
    'path' => '/lp/post-launch', 'nav' => '',
    'schema' => lp_schema('KDP Revive & Scale System', 'A 90-day growth program for published Amazon KDP authors: performance audit, listing and conversion optimization, Amazon Ads management and portfolio expansion.', '/lp/post-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-post-launch">

<!-- Hero -->
<section class="kx-hero" aria-labelledby="lp-h1">
  <?= kx_stars() ?><?= kx_ring() ?>
  <div class="kx-w kx-hero-split">
    <div>
      <p class="kx-kick">For published Amazon KDP authors &amp; publishers</p>
      <h1 class="kx-h1" id="lp-h1">Your book is published. But is it actually <span class="lime">selling?</span></h1>
      <p class="kx-hero-p" style="font-weight:600">Turn underperforming KDP books into a stronger, scalable publishing portfolio.</p>
      <p class="kx-hero-p sm">Low visibility, weak listings, ineffective advertising and poor positioning could be holding back your sales. The <b>KDP Revive &amp; Scale System</b> is a 90-day growth program that optimizes your existing books, improves their sales and builds a strategy for expanding your Kindle portfolio.</p>
      <div class="kx-hero-cta"><a class="kx-btn" href="#book" data-lp-cta>Book my free KDP growth audit — $500 value</a>
        <p class="kx-ticks">✔ 30-minute consultation · Personal account review · No obligation</p></div>
      <?= kx_faces('Trusted by authors with <b>' . e(data('stats')[0][0] . data('stats')[0][1]) . ' books</b> on Amazon.') ?>
    </div>
    <div class="kx-hero-vis">
      <?= kx_media('Fourparts/Self-Publishing Dashboard Workspace.png', '', 'KDP Revive & Scale System') ?>
      <span class="kx-hero-float f1" aria-hidden="true"><i><?= kx_i('trend') ?></i><span><b>90 days</b><small>to a stronger portfolio</small></span></span>
      <span class="kx-hero-float f2" aria-hidden="true"><i><?= kx_i('search') ?></i><span><b>Free audit</b><small>$500 value</small></span></span>
    </div>
  </div>
</section>

<!-- Why sales aren't coming -->
<section class="kx-sec glow-r" style="background:linear-gradient(180deg,#071722,#06141A)" aria-labelledby="pb-h"><div class="kx-w">
  <h2 class="kx-h2 l" id="pb-h" style="font-size:clamp(1.7rem,3vw,2.5rem);line-height:1.5">You published your book. So why<br>aren’t the <span class="lime">sales coming?</span></h2>
  <p class="kx-p" style="text-align:left;margin:0;color:#fff;max-width:42em">Publishing A Book Is Only The First Step. Getting It Discovered, Converting Browsers Into Buyers, And Maintaining Sales Momentum Requires An Ongoing Strategy.</p>
  <div class="kx-probs">
  <?php $P = [['Your Book Is Buried in Amazon Search', 'Your keywords, categories, and positioning may not be helping your book reach the right readers.'], ['People See Your Book, But Don’t Buy', 'Your cover, description, pricing, reviews, or product page may not be giving readers enough reason to purchase.'], ['Your Amazon Ads Aren’t Delivering', 'You’re spending on advertising without a clear understanding of which campaigns generate profitable sales.'], ['Your Publishing Portfolio Isn’t Growing', 'You have published books, but no structured plan to improve existing titles and expand into new opportunities.']];
  foreach ($P as $i => $p): ?><article class="kx-rv" style="--d:<?= $i ?>"><span class="kx-circ">0<?= $i + 1 ?></span><h3><?= e($p[0]) ?></h3><p><?= e($p[1]) ?></p></article><?php endforeach; ?>
  </div>
</div></section>

<!-- System -->
<section class="kx-sec" style="background:#070F0E" aria-labelledby="sy-h"><div class="kx-w">
  <div class="kx-center"><p class="kx-kick">Introducing</p></div><h2 class="kx-h2" id="sy-h">The KDP <span class="lime">Revive &amp; Scale</span> System.</h2>
  <p class="kx-p" style="color:#fff;font-weight:700;font-size:1.15rem">One Complete System to Optimize Existing Books and Build Your Next Stage of Growth.</p>
  <p class="kx-p">We don’t simply run ads or change a few keywords. We evaluate the complete performance of your publishing business and identify the improvements that matter most.</p>
  <?= kx_bento([['search', 'Complete KDP performance audit', 'Analyze book sales, royalties, visibility, advertising performance, reader demand and existing catalog performance to identify the biggest growth limitations.'], ['target', 'Amazon listing & conversion optimization', 'Improve keywords, categories, book descriptions, metadata, A+ Content where eligible, and cover positioning to strengthen discoverability and conversion.'], ['chart', 'Amazon Ads strategy & management', 'Build or restructure campaigns, refine targeting, eliminate inefficient spend and optimize using performance data.'], ['opt', 'Pricing, positioning & competitive research', 'Evaluate pricing, competing titles, market demand and reader expectations to find stronger opportunities.'], ['star', 'Review & reader engagement strategy', 'Amazon-compliant approaches to encourage authentic reader feedback and strengthen author credibility.'], ['layers', 'Kindle portfolio expansion strategy', 'Identify opportunities for additional books, related topics, series and new categories.'], ['doc', 'Performance tracking & reporting', 'Monitor sales, royalties, ad efficiency, keyword visibility and portfolio performance, so every decision is backed by data.'], ['refresh', 'Strategic relaunch & ongoing optimization', 'Where the data supports it, run a structured relaunch and keep refining listings, ads and positioning.']]) ?>
  <div class="kx-center" style="margin-top:36px"><a class="kx-btn" href="#book" data-lp-cta>Get My Free KDP Growth Audit</a></div>
</div></section>

<!-- Roadmap -->
<section class="kx-sec glow-r" style="background:linear-gradient(180deg,#0A1E16,#071419)" aria-labelledby="rm-h"><div class="kx-w">
  <h2 class="kx-h2" id="rm-h" style="font-size:clamp(1.6rem,2.8vw,2.4rem);line-height:1.5">Your 90-day roadmap from stalled sales to a<br><span class="lime">stronger publishing business</span></h2>
  <ol class="kx-road">
  <?php $R = [['chart', 'Days 1–15', 'Diagnose & Discover', 'What is limiting your growth?', 'We audit your existing books, identify performance gaps, assess market opportunities and establish your highest-priority growth opportunities.'], ['doc', 'Days 16–30', 'Rebuild the Foundation', 'Is your foundation ready to grow?', 'We optimize listings, keywords, categories, positioning and conversion elements before increasing your advertising investment.'], ['opt', 'Days 31–60', 'Optimize & Build Momentum', 'What is driving better performance?', 'We launch or refine Amazon Ads, monitor performance, test improvements and develop sustainable opportunities to increase sales.'], ['map', 'Days 61–90', 'Scale & Expand', 'Ready to scale what works?', 'We strengthen the best-performing strategies, evaluate additional book opportunities and build your next-stage portfolio expansion plan.']];
  foreach ($R as $i => $r): ?><li class="kx-rv" style="--d:<?= $i ?>"><span class="ib"><?= kx_i($r[0]) ?></span><h3><?= e($r[1]) ?><br><?= e($r[2]) ?></h3><em><?= e($r[3]) ?></em><p><?= e($r[4]) ?></p></li><?php endforeach; ?>
  </ol>
  <p class="kx-goal">The Goal: Build a publishing business with stronger fundamentals, better performance visibility, and a repeatable strategy for growth.</p>
  <div class="kx-center"><a class="kx-btn" href="#book" data-lp-cta>Plan My KDP Portfolio Growth</a></div>
</div></section>

<!-- Compare -->
<section class="kx-sec" style="background:#06141A" aria-labelledby="vs-h"><div class="kx-w">
  <h2 class="kx-h2" id="vs-h" style="font-size:clamp(1.6rem,2.8vw,2.4rem);line-height:1.5">Most KDP services fix one piece.<br>AMZ United Press looks at why the whole <span class="lime">book stalled.</span></h2>
  <div class="kx-cmp">
    <div class="kx-rv" data-t="Typical KDP Services"><ul><?php foreach (['Change a few keywords', 'Run ads on the listing you already have', 'Focus on traffic without checking conversion', 'Treat reviews, pricing and PPC separately', 'Send reports without telling you what matters first', 'Make changes without a clear recovery sequence', 'Move on when the initial work is finished'] as $x): ?><li><span class="ib" style="--c:#E5484D"><?= kx_i('x') ?></span><?= e($x) ?></li><?php endforeach; ?></ul></div>
    <div class="kx-rv" style="--d:1" data-t="AMZ United Press Revive"><ul><?php foreach (['Start with a complete Recovery Audit', 'Rebuild keywords, categories and listing first', 'Repair the review pipeline', 'Build or rebuild Amazon Ads', 'Test pricing and positioning against real response', 'Follow a structured 90-day recovery sequence', 'Track rank, reviews and revenue against your starting point'] as $x): ?><li><span class="ib" style="--c:#F29102"><?= kx_i('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>

<!-- How we work -->
<section class="kx-sec glow-r" style="background:linear-gradient(180deg,#071A1C,#06141A)" aria-labelledby="ap-h"><div class="kx-w">
  <h2 class="kx-h2" id="ap-h" style="font-size:clamp(1.6rem,2.8vw,2.4rem);line-height:1.5">Your publishing business needs more<br>than another <span class="lime">service provider</span></h2>
  <p class="kx-p" style="color:#fff;font-size:1.1rem">It needs a team that understands how book discovery, conversion, advertising, and portfolio strategy work together.</p>
  <ol class="kx-vt">
  <?php $A = [['Discovery', 'We Diagnose Before We Recommend', 'Every engagement begins with understanding your existing performance, market position, and realistic growth potential.'], ['Strategy', 'We Focus on the Complete Publishing Business', 'From listing optimization and advertising to portfolio planning, our recommendations connect individual book performance with long-term business objectives.'], ['Analysis', 'We Build Around Your Actual Data', 'We don’t apply the same strategy to every author. Your priorities depend on your books, audience, competition, and current performance.'], ['Execution', 'We Give You a Clear Execution Plan', 'You’ll know what needs improvement, why it matters, and how those improvements fit into your 90-day roadmap.']];
  foreach ($A as $i => $a): ?><li class="kx-rv"><span class="dot">0<?= $i + 1 ?></span><div class="body"><small>Step 0<?= $i + 1 ?> / <?= e($a[0]) ?></small><h3><?= e($a[1]) ?></h3><p><?= e($a[2]) ?></p></div></li><?php endforeach; ?>
  </ol>
  <div class="kx-vt-end"><span>Your 90-day roadmap</span></div>
</div></section>

<!-- Audit -->
<section class="kx-sec" style="background:#030B10" aria-labelledby="au-h"><div class="kx-w kx-center">
  <h2 class="kx-h2" id="au-h" style="font-size:clamp(1.6rem,2.8vw,2.4rem);line-height:1.5">Before you spend more on <span class="lime">Amazon Ads<br>or publish another book</span><br>find out what’s holding you back.</h2>
  <p class="kx-claim">Claim your <span class="lime">FREE</span> 30-Minute KDP Growth &amp; Portfolio Audit <b>$500 Value</b></p>
  <h3 style="font-family:var(--sg);font-weight:600;font-size:1.4rem;margin:0 0 10px">During your consultation, we’ll review:</h3>
  <ul class="kx-tilt">
  <?php $U = [['Visibility Gaps', 'Where your keywords, categories, or positioning may be limiting discovery.', -2], ['Listing Conversion', 'What could be preventing readers from purchasing your books.', 1], ['Advertising Performance', 'Where campaigns may be inefficient or missing opportunities.', -1], ['Sales & Profitability', 'How current performance compares with your growth objectives.', 2], ['Portfolio Opportunities', 'Whether additional titles, series, or categories make strategic sense.', -1.5], ['Your 90-Day Roadmap', 'The priority actions we recommend for your next stage of growth.', 1.5]];
  foreach ($U as $i => $u): ?><li class="kx-rv" style="--r:<?= $u[2] ?>deg;--d:<?= $i % 3 ?>"><h3><?= e($u[0]) ?></h3><p><?= e($u[1]) ?></p></li><?php endforeach; ?>
  </ul>
  <h3 style="font-family:var(--sg);font-weight:600;font-size:clamp(1.2rem,2vw,1.55rem);max-width:30em;margin:10px auto 18px">We’ll also determine whether <span class="lime">AMZ United Press</span> is the right partner to help implement those improvements.</h3>
  <p class="kx-p" style="color:#C8D0CD;font-size:1.06rem">No pressure. No unrealistic promises. Just an informed assessment of your publishing business.</p>
  <a class="kx-btn" href="#book" data-lp-cta>Book My Free KDP Growth Audit</a>
  <p class="kx-note">Limited consultation capacity to allow time for individual account reviews.</p>
</div></section>

<!-- Authors -->
<section class="kx-proof" aria-labelledby="ar-h"><div class="kx-w">
  <h2 class="kx-h2" id="ar-h" style="font-size:clamp(1.6rem,2.8vw,2.4rem);margin:0;line-height:1.5">Authors who trusted<br><span class="lime">AMZ United Press</span></h2></div>
  <?= kx_authors() ?>
</section>

<!-- Case studies -->
<section class="kx-cases" aria-labelledby="cs-h"><div class="kx-w">
  <h2 class="kx-h2" id="cs-h">Case <span class="lime">studies.</span></h2>
  <div class="kx-case-grid">
    <?= kx_case(['pill' => 'Peak-month performance', 'kpis' => [['US$13,999', 'Spend'], ['US$52,546', 'Sales'], ['4,530', 'Orders'], ['26.64%', 'ACOS']], 'a' => [6, 10, 8, 14, 12, 20, 16, 30, 26, 44, 50, 66, 82], 'b' => [4, 6, 6, 8, 10, 12, 18, 22, 30, 40, 48, 58, 74],
        'title' => 'From 10 Sales to 4,530', 'big' => '$52K in Ad Sales in a Single Month', 'p' => ['A sharper ad structure and a better-converting listing pushed one December past 4,500 orders while keeping ACOS well under 27%.'], 'tiles' => [['4,530', 'Orders in one month'], ['$52K+', 'Ad-attributed sales'], ['26.64%', 'ACOS']]], 'laptop') ?>
    <?= kx_case(['pill' => 'Long-term scale', 'kpis' => [['US$96,476', 'Spend'], ['US$282,512', 'Sales'], ['24,456', 'Orders'], ['34.15%', 'ACOS']], 'a' => [20, 26, 22, 30, 28, 36, 32, 40, 38, 48, 46, 60, 70], 'b' => [16, 20, 24, 22, 28, 30, 34, 32, 40, 44, 50, 56, 66],
        'title' => 'From Stuck to Scaling', 'big' => '24,456 Book Orders from Amazon Ads', 'p' => ['A structured ad strategy took a KDP account from slow, steady sales to a profitable, scalable machine, turning ad spend into real orders.'], 'tiles' => [['24,456', 'Orders'], ['$282K+', 'Ad-attributed sales'], ['34.15%', 'ACOS']]], 'laptop') ?>
  </div>
</div></section>

<!-- Booking -->
<?= kx_book('Ready to Revive &amp; Scale Your KDP Business?', 'Book your free 30-minute growth audit and discover what’s holding back your book sales.', 'Book your free KDP growth audit', 'A $500 value. Tell us about your book and we’ll set up your 30-minute review.', 4, 'Book My Free Audit',
    ['A 30-minute review of your books and Amazon Ads', 'Your visibility, conversion and advertising gaps', 'A practical 90-day growth roadmap', 'No pressure and no obligation']) ?>

<!-- FAQ -->
<?= kx_faqsec('Frequently asked <span class="lime">questions.</span>', $FAQ, '#0F0E0C') ?>

<!-- Final -->
<section class="kx-sec" style="background:#04111A;padding-top:0" aria-labelledby="fn-h"><div class="kx-w"><div class="kx-final kx-rv">
  <h2 class="kx-h2" id="fn-h" style="font-size:clamp(1.5rem,2.6vw,2.2rem);line-height:1.5">Your book is already live. Now give it a<br><span class="lime">strategy for what comes next.</span></h2>
  <p class="kx-p" style="max-width:40em">Whether your books are struggling to gain visibility, your advertising isn’t delivering, or you’re ready to expand your publishing portfolio, the next step starts with understanding your current performance.</p>
  <p class="kx-p" style="color:#fff;max-width:34em;margin-bottom:26px">Let AMZ United Press review your existing books, identify your strongest opportunities, and build a clear 90-day roadmap for improvement.</p>
  <a class="kx-btn big" href="#book" data-lp-cta>Book My Free KDP Growth Audit — $500 Value</a>
  <p class="kx-note" style="font-style:normal;color:#8A9592;font-size:.8rem">For published Amazon KDP authors and publishers ready to improve existing books and explore sustainable portfolio growth.</p>
</div></div></section>

<?= kx_dock('Free audit') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
