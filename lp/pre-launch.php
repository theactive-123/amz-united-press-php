<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lx.php';

$G = '$6,000';   // minimum sales target in the guarantee
$FAQ = [
    ['Do I need to have my manuscript ready?', 'No. AMZ United Press can support the process from research and scripting through writing, editing, design and publishing.'],
    ['How many books will be launched?', 'The program is structured around 3 books per month, for a total of 12 books over 120 days.'],
    ['Do you only publish the books?', 'No. We handle the complete workflow, including research, writing, editing, design, KDP setup, positioning, Amazon Ads and optimization.'],
    ['Do I need to manage writers or designers?', 'No. The service is designed to give you one team instead of multiple freelancers.'],
    ['What happens after the books go live?', 'We continue tracking and optimizing listings, pricing and Amazon Ads throughout the roadmap.'],
    ['How does the guarantee work?', 'The program includes a minimum ' . $G . ' sales target, subject to the agreed eligibility requirements and guarantee terms. If the agreed minimum is not reached within the guarantee period, your investment is refunded according to those terms.'],
    ['Do I keep the rights and royalties?', 'Yes. Every book is published on your own Amazon KDP account, under your name. You keep 100% of the rights and every royalty Amazon pays.'],
];
$meta = [
    'lp' => true, 'lx' => true,
    'title' => 'Amazon KDP Pre-Launch Program: 12 Books in 120 Days | AMZ United Press',
    'description' => 'We research, write, design, publish and advertise 3 books a month for 120 days: a 12-book Amazon KDP portfolio with a minimum ' . $G . ' sales target. Book a free strategy call.',
    'path' => '/lp/pre-launch', 'nav' => '',
    'schema' => lp_schema('120-Day KDP Portfolio Program', 'A done-for-you Amazon KDP program: 12 books researched, written, designed, published and advertised over 120 days.', '/lp/pre-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page lx" data-page="lp-pre-launch">

<!-- Hero -->
<section class="lx-hero" aria-labelledby="lp-h1"><span class="lx-grid-bg" aria-hidden="true"></span><span class="lx-glow" aria-hidden="true"></span>
  <div class="w lx-hero-in">
    <div>
      <p class="lx-pill"><b>120 DAYS</b>12 books. One team. Everything handled.</p>
      <h1 class="lx-h1" id="lp-h1">Minimum <?= e($G) ?> in book sales guaranteed. <em>Or we’ll refund you.</em></h1>
      <p class="lx-lead">We launch 3 books every month for 120 days. From research to publishing and advertising, AMZ United Press handles it all, for authors, founders and new KDP publishers who are done putting everything on one title.</p>
      <ul class="lx-promise"><li><?= lx_i('check') ?>12 books in 120 days</li><li><?= lx_i('check') ?>Amazon Ads built in</li><li><?= lx_i('check') ?>Hit <?= e($G) ?> or get 100% back*</li></ul>
      <?= lx_cta('Book my free KDP strategy call') ?>
      <span class="lx-btn-note">See how the 120-Day KDP Portfolio Engine works before you publish your next book.</span>
      <?= lx_faces('<b>' . e(data('stats')[0][0] . data('stats')[0][1]) . ' books</b> published for authors who keep 100% of their royalties.') ?>
    </div>
    <?= lp_form('lp-form', 'Book your free strategy call', 'Tell us where you are. We reply within one business day to set up your call.', 7, 'Book My Free Call') ?>
  </div>
</section>

<?= lp_trust('Your books, live on') ?>

<!-- The problem -->
<section class="lx-sec lx-alt" aria-labelledby="pr-h"><div class="w lx-split" style="align-items:center">
  <div class="lx-rv">
    <?= lx_kick('The problem') ?>
    <h2 class="lx-h2" id="pr-h">One book is not a <em>publishing strategy.</em></h2>
    <div class="lx-story"><p><b>Most authors spend months creating one book.</b></p><p>Then they publish it.</p><p>Then the real work starts. They realize they still need to figure out:</p></div>
    <ul class="lx-chips"><li>Which keywords to target</li><li>Which categories to enter</li><li>How to price the book</li><li>How to get reviews</li><li>How to run Amazon Ads</li><li>How to improve the listing</li><li>What to publish next</li></ul>
  </div>
  <div class="lx-live lx-rv" style="--d:2">
    <span class="lx-live-tag">LIVE</span>
    <h3>And by then, the book is <em>already live.</em></h3>
    <div class="lx-live-row"><img src="<?= e(lp_img(data('work')[3]['image'])) ?>" alt="" loading="lazy"><span><b>Your one title</b><small>No keywords plan · no ads · no next book</small></span><span class="lx-live-bars" aria-hidden="true"><i style="height:30%"></i><i style="height:22%"></i><i style="height:18%"></i><i style="height:12%"></i><i style="height:10%"></i><i style="height:8%"></i></span></div>
  </div>
</div></section>

<!-- The system -->
<section class="lx-sec lx-state" aria-labelledby="sy-h"><span class="lx-glow" aria-hidden="true"></span><div class="w">
  <?= lx_kick('The fix', true) ?>
  <h2 class="lx-h2 lx-rv" id="sy-h">The problem isn’t just publishing. It’s publishing <em>without a system.</em></h2>
  <div class="lx-state-grid">
    <div class="lx-rv"><span class="lx-ib"><?= lx_i('book') ?></span><b>One title, one chance</b><p>Everything rides on a single launch day, keyword and ad.</p></div>
    <div class="lx-rv" style="--d:1"><span class="lx-ib"><?= lx_i('layers') ?></span><b>A portfolio gives you data</b><p>More books mean more opportunities and more ways to find what readers respond to.</p></div>
    <div class="lx-rv" style="--d:2"><span class="lx-ib"><?= lx_i('target') ?></span><b>We build both</b><p>AMZ United Press builds the portfolio and the system around it.</p></div>
  </div>
  <?= lx_cta('Show me the 120-day plan', '#plan') ?>
</div></section>

<!-- 120-day plan -->
<section class="lx-sec lx-alt" id="plan" aria-labelledby="pl-h"><div class="w">
  <div class="lx-head"><?= lx_kick('The 120-day plan') ?><h2 class="lx-h2" id="pl-h">3 books every month. <em>12 books across 120 days.</em></h2></div>
  <div class="lx-months">
  <?php $M = [
      ['Books 1–3', ['Research the market.', 'Build the first titles.', 'Launch with the right positioning, keywords and categories.']],
      ['Books 4–6', ['Launch the next titles.', 'Review early sales data.', 'Improve listings and campaigns.']],
      ['Books 7–9', ['Expand the portfolio.', 'Identify stronger niches and titles.', 'Optimize based on real market response.']],
      ['Books 10–12', ['Complete the 12-book portfolio.', 'Improve existing titles.', 'Strengthen Amazon Ads.', 'Build the next growth plan.']],
  ];
  foreach ($M as $i => $m): ?>
    <article class="lx-month lx-rv" style="--d:<?= $i ?>"><div class="lx-bar" aria-hidden="true"><?php for ($k = 0; $k < 12; $k++): ?><i<?= $k < ($i + 1) * 3 ? ' class="on"' : '' ?>></i><?php endfor; ?></div>
      <small>Month <?= $i + 1 ?></small><h3><?= e($m[0]) ?></h3><ul><?php foreach ($m[1] as $x): ?><li><?= e($x) ?></li><?php endforeach; ?></ul></article>
  <?php endforeach; ?>
  </div>
  <div class="lx-endnote lx-rv"><b>12</b><p><strong>At the end of 120 days</strong>You don’t have one book sitting on Amazon. You have a complete portfolio of 12 launched books.</p></div>
</div></section>

<!-- Case studies -->
<section class="lx-sec" aria-labelledby="cs-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('Case studies', true) ?><h2 class="lx-h2" id="cs-h">Real numbers from <em>live Amazon Ads accounts.</em></h2></div>
  <div class="lx-cases">
    <?= lx_case(['tag' => 'Peak-month performance', 'title' => 'Built slow. Scaled fast.', 'big' => '3,849 books sold. $131K in sales.', 'text' => 'A smart pre-launch setup, patient testing early on, and aggressive scaling once the winners were clear.', 'metrics' => [['26.64%', 'ACOS'], ['$52K+', 'Ad-attributed sales'], ['4,530', 'Orders in one month']], 'points' => [6, 8, 7, 12, 10, 16, 22, 20, 34, 46, 58, 82, 94]]) ?>
    <?= lx_case(['tag' => 'Long-term scale', 'title' => 'From a single book to an established KDP portfolio', 'big' => '14,052 books sold. $497K in sales.', 'text' => 'Smart pre-launch setup, keyword research, and scaling winning campaigns turned ads into real sales.', 'metrics' => [['34.15%', 'ACOS'], ['$282K+', 'Ad-attributed sales'], ['24,456', 'Orders']], 'points' => [10, 14, 18, 24, 30, 28, 38, 44, 52, 60, 66, 78, 90]]) ?>
  </div>
  <p class="lx-note lx-c">Figures from Amazon Ads dashboards of catalogs we manage. Results vary by book, niche and budget.</p>
</div></section>

<!-- Whole launch -->
<section class="lx-sec lx-light" aria-labelledby="wl-h"><div class="w">
  <div class="lx-head"><?= lx_kick('Other companies give you one piece') ?><h2 class="lx-h2" id="wl-h">We handle <em>the whole launch.</em></h2>
    <p class="lx-sub">You shouldn’t have to hire one person for writing, another for editing, another for design and someone else for Amazon Ads. AMZ United Press manages the complete publishing journey.</p></div>
  <ol class="lx-steps">
  <?php $S = [['Research', 'Niche research, competitor analysis, topic selection, market opportunity.'], ['Content', 'Scripting, book writing, editing, content refinement.'], ['Design', 'Cover design, interior formatting, A+ content.'], ['Publishing', 'KDP setup, title & subtitle, book description, keywords, categories, pricing.'], ['Launch', 'Review strategy, launch preparation, Amazon Ads, listing optimization.'], ['Growth', 'Performance tracking, ad optimization, pricing adjustments, portfolio optimization.']];
  foreach ($S as $i => $s): ?>
    <li class="lx-rv" style="--d:<?= $i % 3 ?>"><span class="n">0<?= $i + 1 ?></span><small>Step 0<?= $i + 1 ?></small><h3><?= e($s[0]) ?></h3><p><?= e($s[1]) ?></p></li>
  <?php endforeach; ?>
  </ol>
</div></section>

<!-- Band -->
<section class="lx-sec lx-light" style="padding-top:0" aria-labelledby="bd-h"><div class="w"><div class="lx-band lx-rv">
  <div><h2 id="bd-h">Let’s build your 12-book portfolio.</h2><p>Book a free call to explore your 12-book launch strategy and <?= e($G) ?> sales target, and see if we’re the right fit.</p><?= lx_cta('Book my free strategy call') ?></div>
  <?= lx_covers([2, 4, 6, 7, 8]) ?>
</div></div></section>

<!-- With / without -->
<section class="lx-sec lx-alt" aria-labelledby="vs-h"><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('The difference', true) ?><h2 class="lx-h2" id="vs-h">From publish &amp; hope to a <em>complete KDP system.</em></h2>
    <p class="lx-sub">Most authors publish one book, hire separate freelancers and add ads later. Here is what changes when one team runs the whole portfolio.</p></div>
  <div class="lx-vs">
    <div class="bad lx-rv"><h3>Without a system</h3><ul><?php foreach (['One book', 'Multiple freelancers', 'Random keyword research', 'Guessing categories', 'Cover designed separately', 'Ads added later', 'No clear roadmap', 'No portfolio strategy', 'Constant trial and error'] as $x): ?><li><?= lx_i('x') ?><?= e($x) ?></li><?php endforeach; ?></ul></div>
    <div class="good lx-rv" style="--d:1"><h3>With AMZ United Press</h3><ul><?php foreach (['12 books', 'One team', 'Research before publishing', 'Professional writing & design', 'Keywords & categories planned', 'Amazon Ads built into the launch', '120-day roadmap', 'Ongoing optimization', 'Minimum sales target'] as $x): ?><li><?= lx_i('check') ?><?= e($x) ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>

<!-- Business -->
<section class="lx-sec lx-light" aria-labelledby="bz-h"><div class="w">
  <div class="lx-head"><?= lx_kick('Why it works') ?><h2 class="lx-h2" id="bz-h">We don’t just help you publish. We help you <em>build a publishing business.</em></h2></div>
  <div class="lx-values">
  <?php $V = [['users', 'One team', 'No chasing multiple freelancers. Writing, editing, design, publishing and marketing are managed under one system.'], ['book', 'Three books every month', 'Instead of putting all your expectations on one title, we create multiple opportunities to find what works.'], ['target', 'Strategy before publishing', 'Keywords, categories, pricing, positioning and launch planning happen before the books go live.'], ['trend', 'Marketing after publishing', 'We don’t disappear after launch day. Amazon Ads and optimization continue as we collect data.'], ['layers', 'Portfolio-level thinking', 'We use the performance of the full portfolio to make better publishing decisions.'], ['map', '120-day roadmap', 'You know what is being built, launched and optimized throughout the program.']];
  foreach ($V as $i => $v): ?>
    <article class="lx-rv" style="--d:<?= $i % 3 ?>"><span class="lx-ib"><?= lx_i($v[0]) ?></span><h3><?= e($v[1]) ?></h3><p><?= e($v[2]) ?></p></article>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- Guarantee -->
<section class="lx-sec" id="guarantee" aria-labelledby="gu-h"><span class="lx-glow" aria-hidden="true"></span><div class="w">
  <div class="lx-head lx-c"><?= lx_kick('The guarantee', true) ?><h2 class="lx-h2" id="gu-h">We’re confident enough to put <em>a target behind the work.</em></h2>
    <p class="lx-sub">Most publishing services stop once your book is uploaded. We don’t.</p></div>
  <div class="lx-guar">
    <div class="lx-rv"><small class="lx-kick" style="margin:0">The program combines</small><ul><?php foreach (['12 books', 'Market research', 'Professional production', 'Amazon positioning', 'Amazon Ads', '120 days of optimization'] as $x): ?><li><?= lx_i('check') ?><?= e($x) ?></li><?php endforeach; ?></ul><p class="lx-sub" style="margin:14px 0 0">That gives us more than one opportunity to generate results.</p></div>
    <div class="big lx-rv" style="--d:1"><small>Our target: minimum</small><b><?= e($G) ?></b><p><strong>in sales</strong> within the agreed guarantee period.</p><p>If the agreed minimum target is not achieved, your investment is refunded according to the terms of the guarantee.</p></div>
  </div>
  <h3 class="lx-h3 lx-c" style="text-align:center;margin-top:48px">Why can we stand behind it? Because we’re not betting everything on:</h3>
  <div class="lx-not"><span>One book</span><span>One launch day</span><span>One ad</span><span>One keyword</span></div>
  <p class="lx-sub lx-c" style="text-align:center"><b style="color:var(--tx)">We’re building and optimizing a portfolio.</b></p>
  <p style="text-align:center;margin-top:26px"><?= lx_cta('Show me how the guarantee works') ?></p>
</div></section>

<?= lx_faq('The questions people ask <em>right before they buy.</em>', $FAQ) ?>

<?= lx_final('120 days from now', 'Where do you want <em>to be?</em>', 'Still trying to finish and launch one book? Or looking at a portfolio of 12 professionally built titles live on Amazon? We handle research, writing, editing, design, publishing, positioning, Amazon Ads and optimization, so you can focus on building the business, not managing freelancers.',
    ['12 books in 120 days, end-to-end', 'Minimum ' . $G . ' sales target*', 'You keep 100% of rights and royalties'],
    ['Book my free KDP strategy call', 'A real person replies within one business day.', 7, 'Book My Free Call']) ?>
<p class="lx-fine" style="padding:0 20px 40px">*The minimum sales target applies subject to the agreed eligibility requirements and guarantee terms, provided in writing before you start.</p>

</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
