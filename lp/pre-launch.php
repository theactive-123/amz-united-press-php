<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';
require dirname(__DIR__) . '/includes/kx.php';

$G = '$6,000';   // minimum sales target in the guarantee
$FAQ = [
    ['Do I need to have my manuscript ready?', 'No. AMZ United Press can support the process from research and scripting through writing, editing, design and publishing.'],
    ['How many books will be launched?', 'The program is structured around 3 books per month, for a total of 12 books over 120 days.'],
    ['Do you only publish the books?', 'No. AMZ United Press handles the complete workflow, including research, writing, editing, design, KDP setup, positioning, Amazon Ads and optimization.'],
    ['Do I need to manage writers or designers?', 'No. The service is designed to give you one team instead of multiple freelancers.'],
    ['What happens after the books go live?', 'We continue tracking and optimizing listings, pricing and Amazon Ads throughout the roadmap.'],
    ['How does the guarantee work?', 'The program includes a minimum ' . $G . ' sales target, subject to the agreed eligibility requirements and guarantee terms.'],
];
$meta = [
    'lp' => true, 'kx' => true, 'kx_btn' => 'Book Free Session',
    'title' => 'Minimum ' . $G . ' in Book Sales Guaranteed | 12 Books in 120 Days | AMZ United Press',
    'description' => 'We launch 3 books every month for 120 days. Research, writing, publishing and Amazon Ads handled. Hit ' . $G . ' in sales or get 100% of your money back.',
    'path' => '/lp/pre-launch', 'nav' => '',
    'schema' => lp_schema('120-Day KDP Portfolio Engine', 'A done-for-you Amazon KDP program: 12 books researched, written, designed, published and advertised over 120 days.', '/lp/pre-launch', $FAQ),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-pre-launch">

<!-- Hero -->
<section class="kx-hero" aria-labelledby="lp-h1">
  <?= kx_stars() ?><?= kx_ring() ?>
  <div class="kx-w kx-hero-split">
    <div>
      <p class="kx-kick">12 books · 120 days · one team</p>
      <h1 class="kx-h1" id="lp-h1">Minimum <?= e($G) ?> in book sales guaranteed. <span class="lime">Or we’ll refund you.</span></h1>
      <p class="kx-hero-p">We launch 3 books every month for 120 days. From research to publishing and advertising, we handle it all.</p>
      <p class="kx-hero-box">Hit $6K or get 100% of your money back.*</p>
      <div class="kx-hero-cta"><a class="kx-btn" href="#book" data-lp-cta>Book my free KDP strategy call <?= kx_i('arrow') ?></a>
        <p class="kx-note">See how the 120-Day KDP Portfolio Engine works before you publish your next book.</p></div>
      <?= kx_faces('<b>' . e(data('stats')[0][0] . data('stats')[0][1]) . ' books</b> published for authors who keep 100% of their royalties.') ?>
    </div>
    <div class="kx-hero-vis">
      <?= kx_media('From first idea to finished book/Author Workspace with KDP Publishing Dashboard.png', '', '120-Day KDP Portfolio Engine') ?>
      <span class="kx-hero-float f1" aria-hidden="true"><i><?= kx_i('book') ?></i><span><b>12 books</b><small>launched in 120 days</small></span></span>
      <span class="kx-hero-float f2" aria-hidden="true"><i><?= kx_i('trend') ?></i><span><b><?= e($G) ?></b><small>minimum sales target</small></span></span>
    </div>
  </div>
</section>
<div class="kx-bar" aria-hidden="true"></div>

<!-- The problem -->
<section class="kx-sec" aria-labelledby="pr-h"><div class="kx-w">
  <div class="kx-center"><p class="kx-kick">The problem</p></div>
  <h2 class="kx-h2" id="pr-h" style="margin-top:20px">One book is not a <span class="lime">publishing strategy.</span></h2>
  <div class="kx-prob kx-w kx-narrow" style="padding:0">
    <div class="kx-prob-txt kx-rv">
      <h3>Most authors spend months creating one book.</h3>
      <p>Then they publish it.</p>
      <p class="lime">Then the real work starts.</p>
      <p>They realize they still need to figure out:</p>
      <ul class="kx-chips"><?php foreach (['Which keywords to target' => -2, 'Which categories to enter' => 1.5, 'How to price the book' => -1.5, 'How to get reviews' => 1, 'How to run Amazon Ads' => -1, 'How to improve the listing' => 1.5, 'What to publish next' => -1] as $c => $r): ?><li style="--r:<?= $r ?>deg"><?= e($c) ?></li><?php endforeach; ?></ul>
    </div>
    <div class="kx-live kx-rv" style="--d:1"><span class="kx-stamp">LIVE</span><h3>And by then, the book is <span class="lime">already live.</span></h3></div>
  </div>
</div></section>
<hr class="kx-rule">

<!-- No system -->
<section class="kx-sec" style="padding-top:clamp(40px,5vw,60px)" aria-labelledby="sy-h"><div class="kx-w kx-center">
  <h2 class="kx-h2" id="sy-h" style="font-size:clamp(1.5rem,2.6vw,2.4rem)">The problem isn’t just publishing.<br><span class="lime">It’s publishing without a system.</span></h2>
  <p class="kx-p" style="color:#fff;font-weight:700">One title gives you one chance.</p>
  <p class="kx-p">A portfolio gives you more data, more opportunities and more ways to find what readers actually respond to.</p>
  <p class="kx-p" style="color:#fff;font-weight:700">AMZ United Press builds the portfolio and the system around it.</p>
  <a class="kx-btn" href="#plan" style="margin-top:14px">Show me the 120-day plan →</a>
</div></section>

<!-- 120 days -->
<section class="kx-sec" id="plan" style="padding-top:clamp(30px,4vw,50px)" aria-labelledby="pl-h"><div class="kx-w">
  <p class="kx-kick">The 120-day plan</p><h2 class="kx-h2 l xl" id="pl-h" style="margin-bottom:56px">3 books every month. <span class="lime">12 books across 120 days.</span></h2>
  <div class="kx-months">
  <?php $M = [['Books 1–3', ['Research the market.', 'Build the first titles.', 'Launch with the right positioning, keywords and categories.']], ['Books 4–6', ['Launch the next titles.', 'Review early sales data.', 'Improve listings and campaigns.']], ['Books 7–9', ['Expand the portfolio.', 'Identify stronger niches and titles.', 'Optimize based on real market response.']], ['Books 10–12', ['Complete the 12-book portfolio.', 'Improve existing titles.', 'Strengthen Amazon Ads.', 'Build the next growth plan.']]];
  foreach ($M as $i => $m): ?>
    <article class="kx-month kx-rv" style="--d:<?= $i ?>"><div class="kx-pips" aria-hidden="true"><?php for ($k = 0; $k < 12; $k++): ?><i<?= $k < ($i + 1) * 3 ? ' class="on"' : '' ?>></i><?php endfor; ?></div>
      <small>Month <?= $i + 1 ?></small><h3><?= e($m[0]) ?></h3><ul><?php foreach ($m[1] as $x): ?><li><?= e($x) ?></li><?php endforeach; ?></ul></article>
  <?php endforeach; ?>
  </div>
  <div class="kx-end kx-rv"><h3>At the end of 120 days:</h3><p>You don’t have one book sitting on Amazon. You have a complete portfolio of 12 launched books.</p></div>
</div></section>
<div class="kx-bar" aria-hidden="true"></div>

<!-- Case studies -->
<section class="kx-cases" aria-labelledby="cs-h"><div class="kx-w">
  <h2 class="kx-h2" id="cs-h">Case <span class="lime">studies.</span></h2>
  <div class="kx-case-grid">
    <?= kx_case(['pill' => 'Peak-month performance', 'kpis' => [['$54,424', 'Total cost'], ['$131,604', 'Sales'], ['3,849', 'Purchases'], ['40.58%', 'ACOS']], 'a' => [10, 14, 12, 20, 16, 26, 22, 34, 28, 40, 36, 52, 60], 'b' => [6, 8, 7, 10, 9, 12, 14, 18, 22, 34, 50, 64, 80],
        'title' => 'Built Slow. Scaled Fast.', 'big' => '3,849 Books Sold. $131K in Sales.', 'p' => ['Real numbers from a live Amazon Ads account we run.', 'A smart pre-launch setup, patient testing early on, and aggressive scaling once the winners were clear.']]) ?>
    <?= kx_case(['pill' => 'Long-term scale', 'kpis' => [['$209,035', 'Total cost'], ['$497,054', 'Sales'], ['14,052', 'Purchases'], ['41.58%', 'ACOS']], 'a' => [30, 44, 36, 50, 40, 48, 38, 56, 44, 58, 50, 66, 74], 'b' => [24, 30, 34, 28, 40, 36, 44, 38, 46, 52, 48, 60, 70],
        'title' => 'From a Single Book to an Established KDP Portfolio', 'big' => '14,052 Books Sold. $497K in Sales.', 'p' => ['That’s straight from the Amazon Ads dashboard of a catalog we manage.', 'Smart pre-launch setup, keyword research, and scaling winning campaigns turned ads into real sales.']]) ?>
  </div>
</div></section>

<!-- Whole launch -->
<section class="kx-sec n2" aria-labelledby="wl-h" style="padding-top:20px"><div class="kx-w">
  <h2 class="kx-h2" id="wl-h" style="font-size:clamp(1.8rem,3.4vw,2.6rem);margin-bottom:10px">Other companies give you one piece.</h2>
  <p class="kx-h2" style="margin-bottom:20px"><span class="lime">We handle the whole launch.</span></p>
  <p class="kx-p">You shouldn’t have to hire one person for writing, another for editing, another for design and someone else for Amazon Ads.</p>
  <p class="kx-p" style="color:#fff;font-weight:700">AMZ United Press manages the complete publishing journey.</p>
  <?= kx_rows([['Research', 'Niche research, competitor analysis, topic selection, market opportunity.'], ['Content', 'Scripting, book writing, editing, content refinement.'], ['Design', 'Cover design, interior formatting, A+ content.'], ['Publishing', 'KDP setup, title & subtitle, book description, keywords, categories, pricing.'], ['Launch', 'Review strategy, launch preparation, Amazon Ads, listing optimization.'], ['Growth', 'Performance tracking, ad optimization, pricing adjustments, portfolio optimization.']]) ?>
</div></section>

<!-- Booking -->
<?= kx_book('Let’s Build Your 12-Book Portfolio', 'Book a free call to explore your 12-book launch strategy and ' . $G . ' sales target.', 'Book your free KDP strategy call', 'Tell us where you are. We reply within one business day to set up your call.', 7, 'Book My Free Strategy Call',
    ['A 30-minute call with our KDP team', 'Your 12-book launch strategy, mapped to your goals', 'How the ' . $G . ' sales target and guarantee terms work', 'Honest advice on whether the program is right for you']) ?>

<!-- From publish & hope -->
<section class="kx-sec n2" aria-labelledby="vs-h"><span class="kx-glowdome" aria-hidden="true"></span><div class="kx-w" style="padding-top:clamp(100px,10vw,150px)">
  <h2 class="kx-h2 nc" id="vs-h" style="font-size:clamp(1.8rem,3vw,2.5rem)">From publish &amp; hope to a complete<br><span class="lime">KDP system</span></h2>
  <p class="kx-p" style="max-width:56em">Most authors publish one book, hire a different freelancer for every job and add ads later. Without a plan, good books get buried and launches stall before readers ever find them.</p>
  <div class="kx-vs">
    <div class="kx-rv"><h3>Without AMZ United Press</h3><ul><?php foreach (['One book', 'Multiple freelancers', 'Random keyword research', 'Guessing categories', 'Cover designed separately', 'Ads added later', 'No clear roadmap', 'No portfolio strategy', 'Constant trial and error'] as $x): ?><li><span class="x" aria-hidden="true">✕</span><?= e($x) ?></li><?php endforeach; ?></ul></div>
    <div class="kx-rv" style="--d:1"><h3>With AMZ United Press</h3><ul><?php foreach (['12 books', 'One team', 'Research before publishing', 'Professional writing & design', 'Keywords & categories planned', 'Amazon Ads built into the launch', '120-day roadmap', 'Ongoing optimization', 'Minimum sales target'] as $x): ?><li><span class="ok"><?= kx_i('check') ?></span><?= e($x) ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>
<div class="kx-bar" aria-hidden="true"></div>

<!-- Business -->
<section class="kx-sec" aria-labelledby="bz-h"><div class="kx-w" style="max-width:1000px">
  <h2 class="kx-h2" id="bz-h" style="font-size:clamp(1.6rem,2.8vw,2.3rem)">We don’t just help you publish. <span class="lime">We help you build a publishing business.</span></h2>
  <?= kx_bento([['users', 'One team', 'No chasing multiple freelancers. Writing, editing, design, publishing and marketing are managed under one system.'], ['book', 'Three books every month', 'Instead of putting all your expectations on one title, we create multiple opportunities to find what works.'], ['target', 'Strategy before publishing', 'Keywords, categories, pricing, positioning and launch planning happen before the books go live.'], ['trend', 'Marketing after publishing', 'We don’t disappear after launch day. Amazon Ads and optimization continue as we collect data.'], ['layers', 'Portfolio-level thinking', 'We use the performance of the full portfolio to make better publishing decisions.'], ['map', '120-day roadmap', 'You know what is being built, launched and optimized throughout the program.']]) ?>
</div></section>

<!-- Authors -->
<div class="kx-bar" aria-hidden="true"></div>
<section class="kx-proof" aria-labelledby="au-h"><div class="kx-w">
  <h2 class="kx-h2" id="au-h" style="font-size:clamp(1.6rem,2.8vw,2.3rem);margin:0">Authors who trusted<br><span class="lime">AMZ United Press</span></h2></div>
  <?= kx_authors() ?>
</section>

<!-- FAQ -->
<?= kx_faqsec('The questions people ask right before they <span class="lime">click buy.</span>', $FAQ) ?>

<!-- Guarantee -->
<section class="kx-sec" style="background:#071214" id="guarantee" aria-labelledby="gu-h"><div class="kx-w kx-center">
  <h2 class="kx-h2 nc" id="gu-h" style="font-weight:600">We’re confident enough to put a target <span class="lime">behind the work.</span></h2>
  <p class="kx-p" style="font-size:1.1rem">Most publishing services stop once your book is uploaded.</p>
  <p class="kx-p" style="color:#fff;font-weight:800;font-size:1.15rem">We don’t.</p>
  <div class="kx-guar" style="text-align:left">
    <div class="kx-rv"><small>AMZ United Press combines:</small><ul><?php foreach (['12 books', 'Market research', 'Professional production', 'Amazon positioning', 'Amazon Ads', '120 days of optimization'] as $x): ?><li><?= kx_i('check') ?><?= e($x) ?></li><?php endforeach; ?></ul><p class="kx-p" style="text-align:left;margin:14px 0 0;font-size:.94rem">That gives us more than one opportunity to generate results.</p></div>
    <div class="tgt kx-rv" style="--d:1"><small>Our target:</small><em>MINIMUM</em><b><?= e($G) ?></b><strong>IN SALES</strong><p style="color:#fff;font-size:1.1rem;margin:4px 0 22px">within the agreed guarantee period.</p><p>If the agreed minimum target is not achieved, your investment is refunded according to the terms of the guarantee.</p></div>
  </div>
  <h3 style="font-family:var(--sg);font-weight:700;font-size:clamp(1.4rem,2.2vw,1.8rem);margin:44px 0 10px">Why can we stand behind it?</h3>
  <p class="kx-p">Because we’re not betting everything on:</p>
  <div class="kx-pillset"><span>One book.</span><span>One launch day.</span><span>One ad.</span><span>One keyword.</span></div>
  <p class="kx-p" style="color:#fff;font-size:1.1rem">We’re building and <b>optimizing a portfolio.</b></p>
  <a class="kx-btn" href="#book" data-lp-cta style="margin-top:24px">Show me how the guarantee works →</a>
</div></section>

<!-- Final -->
<section class="kx-sec blk" aria-labelledby="fn-h"><div class="kx-w"><div class="kx-final kx-rv">
  <h2 class="kx-h2 nc xl" id="fn-h" style="font-weight:700">120 days from now, where <span class="lime">do you want to be?</span></h2>
  <p class="kx-hero-p" style="max-width:40em;font-weight:600">Still Trying To Finish And Launch One Book? Or Looking At A Portfolio Of 12 Professionally Built Titles Live On Amazon?</p>
  <div class="kx-dots"><span>AMZ United Press handles</span><span>Research</span><span>Writing</span><span>Editing</span><span>Design</span><span>Publishing</span><span>Positioning</span><span>Amazon Ads</span><span>Optimization</span></div>
  <p class="kx-lead">12 Books. 120 Days. End-To-End. Minimum <?= e($G) ?> Sales Target.*</p>
  <a class="kx-btn nc" href="#book" data-lp-cta><?= kx_i('arrow') ?>Book my free KDP strategy call</a>
  <p class="kx-note b" style="font-style:normal;font-size:.8rem">So You Can Focus On Building The Business, Not Managing Freelancers.</p>
  <p class="kx-note" style="font-size:.76rem;color:#8A9592;margin-top:22px">*The minimum sales target applies subject to the agreed eligibility requirements and guarantee terms, provided in writing before you start.</p>
</div></div></section>

<?= kx_dock('Book a call') ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
