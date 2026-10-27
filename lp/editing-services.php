<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$ed = sub_by_slug('book-editing-services');
$pr = sub_by_slug('proofreading-services');
$fm = sub_by_slug('book-formatting-services');
$FAQ = [
    ['How much do your book editing services cost?', 'Proofreading starts from ' . $pr['price'] . ', formatting from ' . $fm['price'] . ' and full book editing from ' . $ed['price'] . '. The final price depends on your word count and the level of editing your manuscript needs. We read a sample first and send a written quote, so you know the cost before any work begins.'],
    ['What is the difference between editing and proofreading?', 'Editing improves the writing itself: structure, pacing, clarity, consistency and style. Proofreading is the final check for typos, grammar, punctuation and formatting slips once the text is otherwise finished. Most books benefit from editing first and a proofread last.'],
    ['Will editing change my voice?', 'No. Good editing makes your book sound more like you, not like the editor. Every change is tracked so you can accept or reject it, and your editor explains the reasoning behind bigger suggestions.'],
    ['How long does editing take?', 'Proofreading and formatting usually take three to seven days. A full edit takes two to four weeks depending on length. We agree the deadline at the start and can work to a launch date.'],
    ['How will I receive my edits?', 'You get your manuscript back in Word with tracked changes and comments, plus a clean copy and, for full edits, an editorial letter that summarises the main recommendations.'],
    ['Do you edit fiction and nonfiction?', 'Yes. We match you with an editor who works in your genre, whether that’s a thriller, a memoir, a business book or a children’s story.'],
    ['Can you format the book for Amazon after editing?', 'Yes. Our formatting service turns your edited manuscript into Kindle, EPUB and print-ready files, and our publishing team can upload it for you.'],
    ['Is my manuscript kept confidential?', 'Always. Your manuscript is only seen by the editors working on it, we sign an NDA on request, and you keep every right to your work.'],
];
$meta = [
    'lp' => true,
    'title' => 'Book Editing Services | Editing & Proofreading | AMZ United Press',
    'description' => 'Professional book editing, proofreading and formatting by genre-matched editors. Tracked changes, your voice kept, written quote first. Get a free quote.',
    'path' => '/lp/editing-services', 'nav' => '',
    'schema' => lp_schema('Book Editing Services', 'Professional book editing, proofreading and formatting for fiction and nonfiction manuscripts, by editors matched to the genre.', '/lp/editing-services', $FAQ, $pr['price']),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page active" data-page="lp-editing">

<!-- 1. Hero: copy + before/after sample, form on the right -->
<section class="lph-proof" aria-labelledby="lp-h1">
  <div class="lp-w lph-grid">
    <div>
      <p class="lp-kick">Book editing services</p>
      <h1 id="lp-h1">Professional book editing that <em>keeps your voice.</em></h1>
      <p class="lp-lead">Your story is worth reading. Our professional book editors make sure nothing gets in its way: clearer sentences, tighter pacing, consistent details and zero typos, all with tracked changes so you stay in control of every word.</p>
      <?= lp_ctas() ?>
      <div class="lp-ba" data-lp-ba data-v="before" aria-label="Editing sample">
        <div class="lp-ba-top"><b>Editing sample</b><div class="lp-ba-tg"><button type="button" data-v="before" aria-pressed="true">Before</button><button type="button" data-v="after" aria-pressed="false">After</button></div></div>
        <p>She walked <del>very </del>slowly <del>in</del><ins>into</ins> the kitchen<del>,</del><ins>.</ins> <del>and she </del><ins>She </ins>noticed that the letter <del>that was </del>on the table <del>had been</del><ins>was</ins> <del>opened by someone</del><ins>already open</ins><del> already</del>, <del>which was strange</del><ins>and her stomach dropped</ins>.</p>
      </div>
    </div>
    <?= lp_form('lp-form', 'Get your free editing quote', 'Tell us your word count and what kind of help you need.', 1) ?>
  </div>
</section>

<!-- 2. Stats -->
<section class="lp-sec alt" style="padding:48px 0" aria-label="AMZ United Press in numbers"><div class="lp-w"><div class="lp-stats"><?= lp_stats() ?></div></div></section>

<!-- 3. Three services as tiers -->
<section class="lp-sec" aria-labelledby="tr-h">
  <div class="lp-w">
    <div class="lp-head c"><p class="lp-kick">Choose your level</p><h2 class="lp-h2" id="tr-h">Editing, proofreading <em>&amp; formatting.</em></h2><p class="lp-lead">Not sure which you need? Send us a sample and we’ll recommend the right level, for free.</p></div>
    <div class="lp-tiers">
      <div class="lp-tier"><h3><?= e($pr['name']) ?></h3><p>The final polish before you publish.</p><span class="lp-from">From</span><div class="lp-amt"><?= e($pr['price']) ?></div>
        <ul><?php foreach (['Spelling, grammar and punctuation', 'Consistency of names, dates and style', 'Formatting and typesetting slips', 'Tracked changes + clean copy', 'Ready in ' . $pr['time']] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <a class="btn btn-outline" href="#lp-form" data-lp-cta>Get a proofreading quote</a><a class="lp-link" href="<?= e(url('/services/' . $pr['slug'])) ?>">About proofreading</a></div>
      <div class="lp-tier feat"><span class="lp-tag">Most popular</span><h3><?= e($ed['name']) ?></h3><p>Big-picture and line-by-line editing.</p><span class="lp-from">From</span><div class="lp-amt"><?= e($ed['price']) ?></div>
        <ul><?php foreach (['Structure, pacing and plot or argument', 'Line editing for clarity and flow', 'Character, voice and continuity checks', 'Editorial letter with key recommendations', 'Tracked changes, comments and a clean copy'] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <a class="btn btn-primary" href="#lp-form" data-lp-cta>Get an editing quote <?= ic('arrow') ?></a><a class="lp-link" href="<?= e(url('/services/' . $ed['slug'])) ?>">About book editing</a></div>
      <div class="lp-tier"><h3><?= e($fm['name']) ?></h3><p>Files that look right on every device.</p><span class="lp-from">From</span><div class="lp-amt"><?= e($fm['price']) ?></div>
        <ul><?php foreach (['Kindle and EPUB ebook files', 'Print-ready PDF for paperback', 'Chapter styles, headers and front matter', 'Tested on phones, tablets and e-readers', 'Ready in ' . $fm['time']] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <a class="btn btn-outline" href="#lp-form" data-lp-cta>Get a formatting quote</a><a class="lp-link" href="<?= e(url('/services/' . $fm['slug'])) ?>">About book formatting</a></div>
    </div>
  </div>
</section>

<!-- 4. What editors fix -->
<section class="lp-sec dark" aria-labelledby="fx-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><p class="lp-kick">What we fix</p><h2 class="lp-h2" id="fx-h">The problems readers notice, <em>fixed before they do.</em></h2><p class="lp-lead">One-star reviews often mention the same things: typos, confusing passages and plot holes. Our editors catch them so your readers only notice the story.</p><?= lp_ctas('#lp-form', 'Fix my manuscript', false) ?></div>
    <ul class="lp-checks">
      <li><?= ic('check') ?><span><b>Typos &amp; grammar</b>Every spelling, punctuation and grammar slip, corrected.</span></li>
      <li><?= ic('check') ?><span><b>Clunky sentences</b>Rewritten for rhythm and clarity, in your voice.</span></li>
      <li><?= ic('check') ?><span><b>Pacing problems</b>Slow middles tightened, rushed endings given room.</span></li>
      <li><?= ic('check') ?><span><b>Plot &amp; logic holes</b>Timelines, motives and facts checked for consistency.</span></li>
      <li><?= ic('check') ?><span><b>Repetition</b>Overused words and repeated points trimmed away.</span></li>
      <li><?= ic('check') ?><span><b>Inconsistent details</b>Names, spellings and style kept the same throughout.</span></li>
      <li><?= ic('check') ?><span><b>Weak openings</b>First pages strengthened to hook readers from line one.</span></li>
      <li><?= ic('check') ?><span><b>Formatting errors</b>Broken layouts and stray spacing cleaned before upload.</span></li>
    </ul>
  </div>
</section>

<!-- 5. Steps -->
<section class="lp-sec" aria-labelledby="st-h">
  <div class="lp-w">
    <div class="lp-head"><p class="lp-kick">How it works</p><h2 class="lp-h2" id="st-h">Five steps to a <em>publish-ready</em> manuscript.</h2></div>
    <ol class="lp-steps" style="--n:5">
      <li><h3>Send a sample</h3><p>Share your manuscript or a few chapters and tell us your goals and deadline.</p><small>Day 1</small></li>
      <li><h3>Free assessment</h3><p>An editor reads your sample, recommends the right level of editing and sends a written quote.</p><small>1 business day</small></li>
      <li><h3>Editing</h3><p>Your genre-matched editor works through the manuscript with tracked changes and comments.</p><small>3 days – 4 weeks</small></li>
      <li><h3>Your review</h3><p>You accept or reject each change, ask questions and get answers from your editor.</p><small>At your pace</small></li>
      <li><h3>Final files</h3><p>We deliver the clean manuscript, ready for formatting, printing or upload.</p><small>Ready to publish</small></li>
    </ol>
  </div>
</section>

<section class="lp-band" aria-label="Get started">
  <div class="lp-w"><div><h2>Find out what your manuscript needs, free.</h2><p>Send a sample today and get an editor’s recommendation and written quote.</p></div><?= lp_ctas('#lp-form2', 'Send My Sample', false) ?></div>
</section>

<!-- 6. Promises + covers -->
<section class="lp-sec soft" aria-labelledby="pm-h">
  <div class="lp-w">
    <div class="lp-head"><p class="lp-kick">Why AMZ United Press</p><h2 class="lp-h2" id="pm-h">Editors who care about <em>your book.</em></h2></div>
    <?= lp_promises() ?>
    <div class="lp-head" style="margin:72px 0 32px"><h3 class="lp-h2" style="font-size:clamp(1.6rem,2.8vw,2.4rem)">Books our editors have worked on</h3></div>
    <div class="lp-covers" style="--n:6"><?= lp_covers(6, 4) ?></div>
  </div>
</section>

<!-- 7. Reviews -->
<section class="lp-sec" aria-labelledby="rv-h">
  <div class="lp-w"><div class="lp-head c"><p class="lp-kick">Authors say</p><h2 class="lp-h2" id="rv-h">Clean, clear <em>and still mine.</em></h2></div><div class="lp-quotes"><?= lp_quotes() ?></div></div>
</section>

<!-- 8. FAQ -->
<section class="lp-sec alt" aria-labelledby="fq-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><p class="lp-kick">FAQs</p><h2 class="lp-h2" id="fq-h">Book editing <em>questions.</em></h2><p class="lp-lead">Still unsure which service you need? Call <a href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>" data-lp-call><?= e(site('phone')) ?></a> and talk to an editor.</p></div>
    <div class="faq lp-faq"><?= faq_html($FAQ, true) ?></div>
  </div>
</section>

<!-- 9. Final CTA -->
<section class="lp-sec lp-final" aria-labelledby="fn-h">
  <div class="lp-w lp-split">
    <div><p class="lp-kick">Free sample assessment</p><h2 class="lp-h2" id="fn-h">Make every page <em>worth reading.</em></h2><p class="lp-lead">Tell us about your manuscript. An editor will recommend the right level of help and send a written quote within one business day.</p><?= lp_assure(['Genre-matched editor', 'Tracked changes', 'Written quote first', 'Confidential']) ?></div>
    <?= lp_form('lp-form2', 'Get my editing quote', 'Takes about a minute. We reply within one business day.', 1) ?>
  </div>
</section>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
