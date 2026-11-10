<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/ad.php';
require dirname(__DIR__) . '/includes/adx.php';

$G = '$6,000';   // minimum sales target in the guarantee
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
    'lp' => true, 'ad' => true, 'adx' => 'dark', 'ad_btn' => 'Book Free Call',
    'title' => '12 Books in 120 Days, Minimum ' . $G . ' in Sales | KDP Portfolio Program | AMZ United Press',
    'description' => 'We research, write, publish and advertise 3 books a month for 120 days on your KDP account. Minimum ' . $G . ' in sales or your money back. Book a free strategy call.',
    'path' => '/lp/pre-launch', 'nav' => '',
    'schema' => lp_schema('120-Day KDP Portfolio Program', 'A done-for-you Amazon KDP program: 12 books researched, written, designed, published and advertised over 120 days.', '/lp/pre-launch', $FAQ),
];
$w = data('work');
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-pre-launch">

<!-- 1. Hero: headline, video, call to action -->
<section class="x-hero" aria-labelledby="lp-h1">
  <?= x_deco() ?>
  <div class="x-w x-nw">
    <p class="x-label">The 120-day KDP portfolio program</p>
    <h1 class="x-h1" id="lp-h1">Minimum <?= e($G) ?> in book sales guaranteed. <span class="a">Or we’ll refund you.*</span></h1>
    <p class="x-sub">We launch 3 books every month for 120 days, on your own Amazon KDP account. From research and writing to publishing and advertising, we handle it all.</p>
    <span class="x-hl x-acc">12 books. 120 days. One team.</span>
    <p class="x-pill"><?= ad_i('shield') ?>Hit <?= e($G) ?> in sales or get 100% of your money back.*</p>
  </div>
  <div class="x-w">
    <div class="x-frame"><?= ad_video('prelaunch', '120-day program · 20 sec', 'Short video: the four months of the 120-day KDP portfolio program') ?></div>
    <?= x_cta('Book my free KDP strategy call', '<b>Free 30-minute call.</b> See how the 120-day portfolio plan works before you publish your next book.') ?>
  </div>
</section>

<!-- 2. The problem -->
<section class="x-sec b2" aria-labelledby="pr-h"><div class="x-w">
  <?= x_head('pr-h', 'One book is not a <span class="a">publishing strategy.</span>', 'The problem') ?>
  <div class="x-prob">
    <div class="ad-rv">
      <p class="lead">Most authors spend months creating one book.</p>
      <p>Then they publish it. <span class="hi">Then the real work starts.</span> They realize they still need to figure out:</p>
      <ul class="x-chips"><li>Which keywords to target</li><li>Which categories to enter</li><li>How to price the book</li><li>How to get reviews</li><li>How to run Amazon Ads</li><li>How to improve the listing</li><li>What to publish next</li></ul>
    </div>
    <div class="x-live ad-rv" style="--d:1"><i>LIVE</i><h3>And by then, the book is <span>already live.</span></h3></div>
  </div>
</div></section>

<!-- 3. Not just publishing -->
<section class="x-sec line" aria-labelledby="sy-h"><div class="x-w x-c">
  <?= x_head('sy-h', 'The problem isn’t just publishing. <span class="a">It’s publishing without a system.</span>', '', '<b class="x-strong">One title gives you one chance.</b> A portfolio gives you more data, more opportunities and more ways to find what readers actually respond to. <b class="x-strong">AMZ United Press builds the portfolio, and the system around it.</b>') ?>
  <?= x_cta('Show me the 120-day plan', '', '#plan') ?>
</div></section>

<!-- 4. 120-day plan -->
<section class="x-sec b2" id="plan" aria-labelledby="pl-h"><div class="x-w">
  <?= x_head('pl-h', '3 books every month. <span class="a">12 books across 120 days.</span>', '', 'Each month builds on the last. Early sales data shapes the next titles, so the portfolio gets stronger as it grows.', 'l') ?>
  <div class="x-months">
  <?php $M = [['Books 1–3', ['Research the market', 'Write and design the first titles', 'Launch with the right keywords and categories']], ['Books 4–6', ['Launch the next titles', 'Review early sales data', 'Improve listings and campaigns']], ['Books 7–9', ['Expand the portfolio', 'Find the strongest niches and titles', 'Optimize on real market response']], ['Books 10–12', ['Complete the 12-book portfolio', 'Strengthen Amazon Ads', 'Build the next growth plan']]];
  foreach ($M as $i => $m): ?>
    <article class="x-month ad-rv" style="--d:<?= $i ?>"><div class="x-bars" aria-hidden="true"><?php for ($k = 0; $k < 12; $k++): ?><i<?= $k < ($i + 1) * 3 ? ' class="on"' : '' ?>></i><?php endfor; ?></div>
      <small>Month <?= $i + 1 ?></small><h3><?= e($m[0]) ?></h3><ul><?php foreach ($m[1] as $x): ?><li><?= e($x) ?></li><?php endforeach; ?></ul></article>
  <?php endforeach; ?>
  </div>
  <div class="x-band ad-rv"><h3>At the end of 120 days:</h3><p>You don’t have one book sitting on Amazon. You have a complete portfolio of 12 launched books, with ads running and the data to decide what comes next.</p></div>
</div></section>

<!-- 5. Case studies -->
<section class="x-sec glow line" aria-labelledby="cs-h"><span class="x-edge" aria-hidden="true"></span><div class="x-w">
  <?= x_head('cs-h', 'Case <span class="a i">studies</span>', '', 'Real numbers from Amazon Ads accounts we run.') ?>
  <div class="x-cases">
    <?= x_case(['tag' => 'Peak-month performance', 'kpis' => [['$54,424', 'Spend'], ['$131,604', 'Sales'], ['3,849', 'Orders'], ['40.58%', 'ACOS']], 'a' => [12, 16, 14, 22, 18, 30, 26, 38, 32, 46, 42, 60, 74], 'b' => [8, 10, 9, 12, 11, 15, 18, 22, 28, 40, 58, 74, 92],
        'title' => 'Built slow. Scaled fast.', 'big' => '3,849 books sold. $131K in sales.', 'text' => 'A smart pre-launch setup, patient testing early on, and aggressive scaling once the winners were clear.', 'tiles' => [['3,849', 'Books sold'], ['$52K+', 'Peak-month ad sales'], ['$131K', 'Sales']]]) ?>
    <?= x_case(['tag' => 'Long-term scale', 'kpis' => [['$209,035', 'Spend'], ['$497,054', 'Sales'], ['14,052', 'Orders'], ['41.58%', 'ACOS']], 'a' => [34, 48, 40, 56, 44, 54, 42, 62, 50, 66, 58, 76, 86], 'b' => [26, 32, 38, 30, 44, 40, 50, 42, 52, 60, 56, 70, 82],
        'title' => 'From a single book to a KDP portfolio', 'big' => '14,052 books sold. $497K in sales.', 'text' => 'Keyword research, a strong pre-launch setup and scaling the winning campaigns turned ads into real sales across a catalog.', 'tiles' => [['14,052', 'Books sold'], ['$282K+', 'Ad-attributed sales'], ['$497K', 'Sales']]]) ?>
  </div>
  <p class="x-disc">Figures from Amazon Ads dashboards of catalogs we manage. Results vary by niche, books and budget, and are not a promise of earnings.</p>
</div></section>

<!-- 6. We handle the whole launch -->
<section class="x-sec b2" aria-labelledby="wh-h"><div class="x-w">
  <?= x_head('wh-h', 'Other companies give you one piece. <span class="a">We handle the whole launch.</span>', '', 'You shouldn’t have to hire one person for writing, another for editing, another for design and someone else for Amazon Ads. <b class="x-strong">AMZ United Press manages the complete publishing journey.</b>') ?>
  <div class="x-steps">
  <?php $S = [['Research', 'Niche research, competitor analysis, topic selection and market opportunity.'], ['Content', 'Outlining, book writing, editing and content refinement.'], ['Design', 'Cover design, interior formatting and A+ content.'], ['Publishing', 'KDP setup, title and subtitle, description, keywords, categories and pricing.'], ['Launch', 'Review strategy, launch preparation, Amazon Ads and listing optimization.'], ['Growth', 'Performance tracking, ad optimization, pricing adjustments and portfolio planning.']];
  foreach ($S as $i => $s): ?>
    <div class="x-step ad-rv" style="--d:<?= $i % 3 ?>"><div class="n"><b>0<?= $i + 1 ?></b><i></i></div><small>Step 0<?= $i + 1 ?></small><h3 class="x-h3"><?= e($s[0]) ?></h3><p><?= e($s[1]) ?></p></div>
  <?php endforeach; ?>
  </div>
</div></section>

<!-- 7. Book a call (form) -->
<section class="x-sec glow line" id="book-sec" aria-labelledby="bk-h"><div class="x-w">
  <?= x_formsec('bk-h', 'Let’s build your <span class="a">12-book portfolio.</span>', 'Book a free call to explore your 12-book launch strategy and the ' . e($G) . ' sales target. See if AMZ United Press is the right fit.',
      ['A free 30-minute strategy call', 'Likely niches and your 120-day roadmap', 'How the ' . $G . ' sales target works', 'No obligation and no pressure'],
      ['lp-form', 'Book your free KDP strategy call', 'Tell us where you are. We’ll map out your 12-book plan on the call.', 7, 'Book My Free Strategy Call', 'Limited spots each month'], 'Free strategy call') ?>
</div></section>

<!-- 8. Without / with -->
<section class="x-sec b2" aria-labelledby="cp-h"><div class="x-w">
  <?= x_head('cp-h', 'From publish &amp; hope to <span class="a">a complete KDP system.</span>', '', 'One book, a handful of freelancers and a guess at the keywords is how most launches stall. Here’s the difference a system makes.') ?>
  <?= x_vs(['Typical approach', 'Without AMZ United Press', ['One book', 'Multiple freelancers', 'Random keyword research', 'Guessing categories', 'Cover designed separately', 'Ads added later', 'No clear roadmap', 'No portfolio strategy', 'Constant trial and error']],
           ['The 120-day program', 'With AMZ United Press', ['12 books', 'One team', 'Research before publishing', 'Professional writing & design', 'Keywords & categories planned', 'Amazon Ads built into the launch', '120-day roadmap', 'Ongoing optimization', 'Minimum ' . $G . ' sales target']]) ?>
</div></section>

<!-- 9. A publishing business -->
<section class="x-sec line" aria-labelledby="bz-h"><span class="x-edge" aria-hidden="true"></span><div class="x-w">
  <?= x_head('bz-h', 'We don’t just help you publish. <span class="a">We help you build a publishing business.</span>') ?>
  <div class="x-feats">
  <?php $F = [['One team', 'No chasing multiple freelancers. Writing, editing, design, publishing and marketing are managed under one system.'], ['Three books every month', 'Instead of putting all your expectations on one title, we create multiple opportunities to find what works.'], ['Strategy before publishing', 'Keywords, categories, pricing, positioning and launch planning happen before the books go live.'], ['Marketing after publishing', 'We don’t disappear after launch day. Amazon Ads and optimization continue as we collect data.'], ['Portfolio-level thinking', 'We use the performance of the full portfolio to make better publishing decisions.'], ['120-day roadmap', 'You know what is being built, launched and optimized at every stage of the program.']];
  foreach ($F as $i => $f): ?><div class="x-feat ad-rv" style="--d:<?= $i % 3 ?>"><h3><?= e($f[0]) ?></h3><p><?= e($f[1]) ?></p></div><?php endforeach; ?>
  </div>
</div></section>

<!-- 10. Authors -->
<section class="x-sec b2" aria-labelledby="au-h"><div class="x-w">
  <?= x_head('au-h', 'Authors who published <span class="a">with our team.</span>', '', 'Real authors holding the books our team researched, wrote, designed and published.') ?>
  <div class="x-authors"><?php foreach (array_slice(ad_authors_list(), 0, 10) as $i => $a): ?><img class="ad-rv" style="--d:<?= $i % 5 ?>" src="<?= e(ad_src($a . '.webp')) ?>" alt="An AMZ United Press author holding their published book" loading="lazy"><?php endforeach; ?></div>
</div></section>

<!-- 11. FAQ -->
<section class="x-sec line" aria-labelledby="fq-h"><div class="x-w">
  <?= x_head('fq-h', 'The questions people ask <span class="a">right before they start.</span>') ?>
  <?= x_faq($FAQ) ?>
</div></section>

<!-- 12. Guarantee -->
<section class="x-sec b2 glow" id="guarantee" aria-labelledby="gu-h"><div class="x-w x-c">
  <?= x_head('gu-h', 'We’re confident enough to put <span class="a">a target behind the work.</span>', '', 'Most publishing services stop once your book is uploaded. <b class="x-strong">We don’t.</b>') ?>
  <div class="x-guar" style="text-align:left">
    <div class="ad-rv"><small>The program combines</small><ul><?php foreach (['12 books', 'Market research', 'Professional production', 'Amazon positioning', 'Amazon Ads', '120 days of optimization'] as $x): ?><li><?= ad_i('check') ?><span><?= e($x) ?></span></li><?php endforeach; ?></ul><p>That gives us more than one opportunity to generate results.</p></div>
    <div class="t ad-rv" style="--d:1"><small>Our target</small><b class="x-acc"><?= e($G) ?></b><strong>Minimum in sales</strong><span>within the agreed guarantee period</span><p>If the agreed minimum target isn’t achieved, your investment is refunded according to the terms of the guarantee.*</p></div>
  </div>
  <h3 class="x-h3" style="margin-top:44px;font-size:1.5rem">Why can we stand behind it?</h3>
  <p style="color:var(--x-tx3);margin:0">Because we’re not betting everything on:</p>
  <div class="x-not"><span>One book</span><span>One launch day</span><span>One ad</span><span>One keyword</span></div>
  <p class="x-strong" style="margin:0">We’re building, and optimizing, a whole portfolio.</p>
  <?= x_cta('Show me how the guarantee works') ?>
</div></section>

<!-- 13. Final -->
<section class="x-sec" aria-labelledby="fn-h"><div class="x-w">
  <?= x_final('120 days from now, where do you <span class="a">want to be?</span>', 'Still trying to finish and launch one book? Or looking at a portfolio of 12 professionally built titles live on Amazon?',
      ['Research', 'Writing', 'Editing', 'Design', 'Publishing', 'Positioning', 'Amazon Ads', 'Optimization'], '12 books. 120 days. End-to-end. Minimum ' . e($G) . ' sales target.*', 'Book my free KDP strategy call', 'So you can focus on building the business, <b>not managing freelancers.</b>') ?>
</div></section>
<p class="x-foot-note">*The minimum sales target and refund apply subject to the eligibility requirements and guarantee terms provided in writing before you start. Amazon Ads spend is paid by you directly to Amazon.</p>

<?= ad_dock('Book a call') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
