<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$ed = sub_by_slug('book-editing-services');
$pr = sub_by_slug('proofreading-services');
$fm = sub_by_slug('book-formatting-services');
$FAQ = [
    ['How much do your book editing services cost?', 'Proofreading starts from ' . $pr['price'] . ', formatting from ' . $fm['price'] . ' and full book editing from ' . $ed['price'] . '. The final price depends on your word count and the level of editing your manuscript needs. We read a sample first and send a written quote, so you know the cost before any work begins.'],
    ['What is the difference between editing and proofreading?', 'Editing improves the writing itself: structure, pacing, clarity, consistency and style. Proofreading is the final check for typos, grammar, punctuation and formatting slips once the text is otherwise finished. Most books benefit from editing first and a proofread last.'],
    ['What types of book editing do you offer?', 'We offer an editorial assessment, developmental (structural) editing for story and argument, line editing for style and flow, copy editing for grammar and consistency, and manuscript proofreading as the final check. After a free sample read, we recommend the level, or combination, your book actually needs.'],
    ['Do you proofread ebooks and novels?', 'Yes. Our professional proofreaders work on novels, memoirs, nonfiction and ebooks, checking the final text and the formatted files so nothing slips through on Kindle, EPUB or print.'],
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
    'description' => 'Affordable book editing services: developmental, line and copy editing, proofreading and formatting by genre-matched editors. Get a free quote today.',
    'path' => '/lp/editing-services', 'nav' => '',
    'schema' => lp_schema('Book Editing Services', 'Professional book editing, proofreading and formatting for fiction and nonfiction manuscripts, by editors matched to the genre.', '/lp/editing-services', $FAQ, $pr['price']),
];
include dirname(__DIR__) . '/includes/header.php';
$tier = function ($s, $sub, $items, $feat, $btn) {
    return '<div class="tier' . ($feat ? ' feat' : '') . '">' . ($feat ? '<span class="tag">Most popular</span>' : '') . '<h3 class="h3">' . e($s['name']) . '</h3><p>' . e($sub) . '</p><span class="from">From</span><div class="amt">' . e($s['price']) . '</div>'
         . lp_checks($items) . '<a class="btn ' . ($feat ? 'btn-primary' : 'btn-dark') . '" href="#lp-form" data-lp-cta>' . e($btn) . ' ' . ic('arrow') . '</a><a class="more" href="' . e(url('/services/' . $s['slug'])) . '">About ' . e(strtolower($s['t'])) . '</a></div>';
};
?>
<div class="page" data-page="lp-editing">

<?= lp_hero([
    'eyebrow' => 'Book editing services',
    'h1' => 'Professional book editing that <em>keeps your voice.</em>',
    'lead' => 'Your story is worth reading. Our professional book editors make sure nothing gets in its way: clearer sentences, tighter pacing, consistent details and zero typos, all with tracked changes so you stay in control of every word.',
    'ticks' => ['Genre-matched editor', 'Tracked changes', 'Free sample assessment'],
    'extra' => '<div class="sample" data-lp-ba data-v="before" aria-label="Editing sample"><div class="sample-top"><b>Editing sample</b><div class="sample-tg"><button type="button" data-v="before" aria-pressed="true">Before</button><button type="button" data-v="after" aria-pressed="false">After</button></div></div>'
        . '<p>She walked <del>very </del>slowly <del>in</del><ins>into</ins> the kitchen<del>,</del><ins>.</ins> <del>and she </del><ins>She </ins>noticed that the letter <del>that was </del>on the table <del>had been</del><ins>was</ins> <del>opened by someone</del><ins>already open</ins><del> already</del>, <del>which was strange</del><ins>and her stomach dropped</ins>.</p></div>',
    'form' => ['Get your free editing quote', 'Tell us your word count and what kind of help you need.', 1],
]) ?>

<section class="sec-s bg-sand" aria-label="AMZ United Press in numbers"><div class="w"><?= lp_stats() ?></div></section>

<section class="sec bg-white" aria-labelledby="tr-h">
  <div class="w">
    <?= lp_head('Choose your level', 'Book editing, proofreading <em>&amp; formatting services.</em>', 'Not sure which you need? Send us a sample and we’ll recommend the right level, for free.', true, 'tr-h') ?>
    <div class="tiers rv">
      <?= $tier($pr, 'The final polish before you publish.', ['Spelling, grammar and punctuation', 'Consistency of names, dates and style', 'Formatting and typesetting slips', 'Tracked changes + clean copy', 'Ready in ' . $pr['time']], false, 'Get a proofreading quote') ?>
      <?= $tier($ed, 'Big-picture and line-by-line editing.', ['Developmental & structural editing', 'Line editing for clarity and flow', 'Copy editing for grammar and consistency', 'Editorial letter with recommendations', 'Tracked changes, comments and a clean copy'], true, 'Get an editing quote') ?>
      <?= $tier($fm, 'Files that look right on every device.', ['Kindle and EPUB ebook files', 'Print-ready PDF for paperback', 'Chapter styles, headers and front matter', 'Tested on phones, tablets and e-readers', 'Ready in ' . $fm['time']], false, 'Get a formatting quote') ?>
    </div>
  </div>
</section>

<?= lp_band('Find out what your manuscript needs, free.', 'Send a sample and get an editor’s recommendation and written quote.') ?>

<section class="sec bg-ink" aria-labelledby="fx-h">
  <div class="w split split-57 top">
    <div class="sticky"><span class="eyebrow">What we fix</span><h2 class="h2" id="fx-h">The problems readers notice, <em>fixed before they do.</em></h2><p class="lead">One-star reviews often mention the same things: typos, confusing passages and plot holes. Our editors catch them so your readers only notice the story.</p><?= lp_ctas('Fix my manuscript', '#lp-form', false) ?></div>
    <?= lp_checks([
        ['Typos & grammar', 'Every spelling, punctuation and grammar slip, corrected.'],
        ['Clunky sentences', 'Rewritten for rhythm and clarity, in your voice.'],
        ['Pacing problems', 'Slow middles tightened, rushed endings given room.'],
        ['Plot & logic holes', 'Timelines, motives and facts checked for consistency.'],
        ['Repetition', 'Overused words and repeated points trimmed away.'],
        ['Inconsistent details', 'Names, spellings and style kept the same throughout.'],
        ['Weak openings', 'First pages strengthened to hook readers from line one.'],
        ['Formatting errors', 'Broken layouts and stray spacing cleaned before upload.'],
    ], true) ?>
  </div>
</section>

<section class="sec bg-white" aria-labelledby="st-h">
  <div class="w">
    <?= lp_head('How it works', 'Our book editing process: five steps to a <em>publish-ready</em> manuscript.', '', false, 'st-h') ?>
    <?= lp_steps([
        ['Send a sample', 'Share your manuscript or a few chapters and tell us your goals and deadline.', 'Day 1'],
        ['Free assessment', 'An editor reads your sample, recommends the right level of editing and sends a written quote.', '1 business day'],
        ['Editing', 'Your genre-matched editor works through the manuscript with tracked changes and comments.', '3 days – 4 weeks'],
        ['Your review', 'You accept or reject each change, ask questions and get answers from your editor.', 'At your pace'],
        ['Final files', 'We deliver the clean manuscript, ready for formatting, printing or upload.', 'Ready to publish'],
    ]) ?>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="bk-h">
  <div class="w">
    <?= lp_head('Our editors’ work', 'Books our editors have <em>polished.</em>', 'Fiction, memoir and nonfiction, edited, proofread and formatted for readers everywhere. [[/portfolio|See the portfolio]].', false, 'bk-h') ?>
    <?= lp_books(6, 4) ?>
  </div>
</section>

<?= lp_authors() ?>

<section class="sec bg-white" aria-labelledby="pm-h">
  <div class="w split split-57">
    <div><span class="eyebrow">Why AMZ United Press</span><h2 class="h2" id="pm-h">Editors who care about <em>your book.</em></h2><p class="lead">Your manuscript is only seen by the editors working on it, and every change is yours to accept or reject.</p></div>
    <?= lp_promises() ?>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="rv-h">
  <div class="w"><?= lp_head('Authors say', 'Clean, clear <em>and still mine.</em>', '', true, 'rv-h') ?><?= lp_quotes() ?></div>
</section>

<?= lp_band('Editing, proofreading and formatting.' . lp_offer_suffix(), 'Get your free sample assessment today.') ?>

<?= lp_faq('bg-white', 'Book editing <em>questions.</em>', $FAQ) ?>

<?= lp_final('Free sample assessment', 'Make every page <em>worth reading.</em>', 'Tell us about your manuscript. An editor will recommend the right level of help and send a written quote within one business day.', ['Genre-matched editor', 'Tracked changes', 'Confidential'], ['Get my editing quote', 'Takes about a minute. We reply within one business day.', 1]) ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
