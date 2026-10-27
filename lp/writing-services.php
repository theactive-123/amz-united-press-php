<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$FAQ = [
    ['How much do your book writing services cost?', 'Pricing depends on the length of your book, the genre and how much material you already have. Ebook writing starts from $1,800 and full-length ghostwriting from $2,400. You get a written quote with the scope, milestones and timeline before any work begins, and it never changes unless you agree to it in writing.'],
    ['Will the book really sound like me?', 'Yes. Your writer starts with recorded interviews, your notes and any writing you have done before, then builds a short voice guide you approve. You review chapters as they are written, so the book keeps sounding like you from the first page to the last.'],
    ['Who owns the finished book?', 'You do. Once the project is paid, you own 100% of the copyright, the manuscript and every royalty. Your name goes on the cover, and our writers work under a signed NDA, so nobody will know you had help unless you choose to tell them.'],
    ['How long does it take to write a book?', 'Most ebooks take six to ten weeks. Full-length nonfiction and memoirs usually take two to four months, and novels three to five. We agree a schedule with milestones at the start, and you see progress chapter by chapter.'],
    ['I only have an idea. Is that enough to start?', 'Absolutely. Many of our authors begin with nothing more than an idea and a few notes. Your writer helps you shape the concept, plan the chapters and gather the stories and research the book needs.'],
    ['Can you also edit, design and publish the book?', 'Yes. When the manuscript is finished, our editors, cover designers and publishing team can take it all the way to a live listing on Amazon and other stores, under your own account. You can add these services at any point.'],
    ['What if I don’t like a chapter?', 'Tell us. Revisions within the agreed scope are part of every project, and your writer works with you until the chapter reads the way you want. Because you review as we go, small changes never turn into big rewrites.'],
    ['Do you write for authors outside the USA?', 'Yes. We work with authors worldwide by phone, video call and email, and we write in US or UK English to suit your readers.'],
];
$meta = [
    'lp' => true,
    'title' => 'Book Writing Services | Expert Book Writers | AMZ United Press',
    'description' => 'Professional book and ebook writing services for fiction, memoir, biography and nonfiction. Written in your voice, 100% yours. Get a free quote today.',
    'path' => '/lp/writing-services', 'nav' => '',
    'schema' => lp_schema('Book Writing Services', 'Professional book and ebook writing services for fiction, nonfiction, memoir, biography and autobiography, written in the author’s voice.', '/lp/writing-services', $FAQ, '$1,800'),
];
include dirname(__DIR__) . '/includes/header.php';
$picks = [
    ['ghostwriting-services', 'Your ideas, expertise or story, written into a full-length book by a professional ghostwriter who learns exactly how you speak.', ['Recorded interviews and voice guide', 'Chapter-by-chapter approval', 'Signed NDA, full confidentiality', 'Your name on the cover']],
    ['ebook-writing-services', 'Lead-magnet ebooks, guides and short reads written to be finished, shared and acted on, ready for Kindle and every other store.', ['Topic and reader research', 'Outline before drafting', 'Formatted for Kindle and EPUB', 'Fast six-to-ten-week delivery']],
    ['fiction-writing-services', 'Thrillers, romance, fantasy and more, with a plot that holds together, characters readers care about and an ending that pays off.', ['Plot and character planning', 'Genre-savvy fiction writers', 'Consistent world and timeline', 'Series planning available']],
    ['nonfiction-writing-services', 'Business, self-help and expert books that organise what you know into a clear, credible book that builds your authority.', ['Structure built around your method', 'Research and fact-checking', 'Case studies and examples', 'Clear, practical language']],
    ['memoir-writing-services', 'One chapter of your life, a loss, a recovery, a turning point, told honestly and shaped into scenes that feel true.', ['Gentle, guided interviews', 'Scene-by-scene storytelling', 'Respectful handling of real people', 'Optional family-only editions']],
    ['novel-ghostwriting-services', 'A full-length novel built from your concept, with the pacing, dialogue and structure readers expect from a published book.', ['Concept and synopsis development', 'Chapter plan you approve', 'Dialogue and pacing polish', 'Ready for editing and publishing']],
    ['biography-writing-services', 'The life story of a parent, founder or public figure, researched, interviewed and written in a readable third-person narrative.', ['Interviews with family and colleagues', 'Records and timeline research', 'Accurate names, dates and places', 'Photos and documents included']],
    ['autobiography-writing-services', 'Your whole life story in your own first-person voice, from early memories to today, organised so every chapter earns its place.', ['Life timeline workshop', 'First-person voice in your words', 'Help choosing what to include', 'Print and ebook editions']],
];
?>
<div class="page" data-page="lp-writing">

<?= lp_hero([
    'tags' => ['Fiction', 'Nonfiction', 'Memoir', 'Biography', 'Ebooks'],
    'eyebrow' => 'Book writing services',
    'h1' => 'Professional book writing services, <em>in your voice.</em>',
    'lead' => 'You have the idea. Our professional book writers turn it into a finished, publish-ready manuscript: they interview you, learn how you speak and write chapter by chapter while you approve every step. Your name goes on the cover, and every right and royalty stays with you.',
    'ticks' => ['Free consultation', 'Written quote first', 'Signed NDA'],
    'extra' => lp_hero_faces(),
    'form' => ['Get your free writing quote', 'Tell us about your book. A real person replies within one business day.', 0],
]) ?>

<?= lp_trust('We write, then publish to') ?>

<?= lp_vs('bg-sand', 'Sound familiar?', 'The book is in your head. <em>Getting it out</em> is the hard part.', 'Most books never get written, not because the idea isn’t good, but because writing a book takes hundreds of focused hours. That’s exactly what our ebook and book writing services take off your plate.',
    ['Writing it alone', ['Months of evenings and weekends that never add up to a finished draft', 'A blank page, a loose outline and no one to tell you if it’s working', 'Chapters that don’t flow, and a voice that changes from page to page', 'No clear path from manuscript to a book people can buy']],
    ['With AMZ United Press', ['A professional writer matched to your genre, on an agreed schedule', 'A chapter plan you approve before a single page is drafted', 'One consistent voice, yours, checked against your interviews', 'Editing, cover design and publishing whenever you are ready']]) ?>

<section class="sec bg-white" aria-labelledby="pk-h">
  <div class="w">
    <?= lp_head('Choose your book', 'Writing services for <em>every kind</em> of book.', 'Pick the book you want to write to see how we help and where pricing starts.', false, 'pk-h') ?>
    <div class="pick rv" data-lp-pick>
      <div class="pick-list" role="tablist" aria-label="Writing services">
        <?php foreach ($picks as $i => $p): $s = sub_by_slug($p[0]); ?>
        <button type="button" role="tab" id="pk-t<?= $i ?>" aria-controls="pk-p<?= $i ?>" aria-selected="<?= $i ? 'false' : 'true' ?>" tabindex="<?= $i ? -1 : 0 ?>"><?= e($s['name']) ?><?= ic('arrow') ?></button>
        <?php endforeach; ?>
      </div>
      <?php foreach ($picks as $i => $p): $s = sub_by_slug($p[0]); ?>
      <div class="pick-panel" role="tabpanel" id="pk-p<?= $i ?>" aria-labelledby="pk-t<?= $i ?>"<?= $i ? ' hidden' : '' ?>>
        <h3 class="h2"><?= e($s['name']) ?></h3>
        <p><?= e($p[1]) ?></p>
        <?= lp_checks($p[2], true) ?>
        <div class="pick-meta"><span>From <?= e($s['price']) ?></span><span>Typical time <?= e($s['time']) ?></span><span>Written quote first</span></div>
        <div class="ctas"><a class="btn btn-primary" href="#lp-form" data-lp-cta>Get a <?= e(strtolower($s['t'])) ?> quote <?= ic('arrow') ?></a><a href="<?= e(url('/services/' . $s['slug'])) ?>">Read more about <?= e(strtolower($s['name'])) ?></a></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= lp_band('Not sure which writing service fits your book?', 'Talk to a writer for free and get honest advice.') ?>

<section class="sec bg-sand" aria-labelledby="cv-h">
  <div class="w">
    <?= lp_head('Our authors’ books', 'Books we’ve helped <em>bring to life.</em>', 'A few titles from authors we have written, edited, designed and published for. [[/portfolio|See the full portfolio]].', false, 'cv-h') ?>
    <?= lp_books(6, 2) ?>
    <div class="mt"><?= lp_stats() ?></div>
  </div>
</section>

<?= lp_authors() ?>

<section class="sec bg-white" aria-labelledby="st-h">
  <div class="w">
    <?= lp_head('How it works', 'From first call to finished manuscript in <em>four steps.</em>', '', false, 'st-h') ?>
    <?= lp_steps([
        ['Free consultation', 'Tell us about your book, your readers and your goals. We match you with a writer who knows your genre and send a written quote.', '1–3 days'],
        ['Interviews & outline', 'Your writer interviews you, gathers your notes and research, and builds a chapter-by-chapter outline for your approval.', '1–2 weeks'],
        ['Writing & review', 'Chapters arrive in stages. You read, comment and request changes, so the book stays true to you the whole way through.', '4–14 weeks'],
        ['Final manuscript', 'We polish, proofread and deliver the finished manuscript in Word and PDF, with full rights transferred to you.', '1–2 weeks'],
    ]) ?>
    <div class="mt"><?= lp_ctas('Start with a free consultation') ?></div>
  </div>
</section>

<section class="sec bg-ink" aria-labelledby="pr-h">
  <div class="w split split-57">
    <div><span class="eyebrow">Our promise</span><h2 class="h2" id="pr-h">Your book. Your name. <em>Your royalties.</em></h2><p class="lead">Every writing project comes with the same four guarantees, written into your contract before we start.</p></div>
    <?= lp_promises() ?>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="cp-h">
  <div class="w">
    <?= lp_head('Compare your options', 'Why authors choose our <em>book writers.</em>', '', false, 'cp-h') ?>
    <?= lp_table(['Writing it yourself', 'Freelance marketplaces', 'AMZ United Press'], [
        ['Time to a finished draft', 'Often a year or more', 'Varies with the freelancer', '6–20 weeks, agreed upfront'],
        ['Writer matched to your genre', '—', 'You vet them yourself', '✓ Matched for you'],
        ['Chapter-by-chapter approval', '—', 'Sometimes', '✓ Always'],
        ['Editing, cover & publishing', 'Find each one separately', 'Usually not included', '✓ Under one roof'],
        ['Price', 'Your time', 'Often renegotiated mid-project', 'Written quote, no surprises'],
        ['Rights & royalties', 'Yours', 'Depends on the contract', '✓ 100% yours, signed NDA'],
    ]) ?>
  </div>
</section>

<?= lp_band('Ready to finish your book?' . lp_offer_suffix(), 'Book a free consultation and get a written quote within one business day.') ?>

<section class="sec bg-white" aria-labelledby="rv-h">
  <div class="w"><?= lp_head('Authors say', 'Kind words from <em>our authors.</em>', '', true, 'rv-h') ?><?= lp_quotes() ?></div>
</section>

<?= lp_faq('bg-sand', 'Questions about our <em>book writing services.</em>', $FAQ) ?>

<?= lp_final('Free consultation', 'Let’s write <em>your book.</em>', 'Tell us what you want to write. We’ll match you with the right writer, answer your questions and send a written quote. No pressure and no obligation.', ['Free consultation', 'Written quote first', '100% rights & royalties'], ['Start your book today', 'Takes about a minute. We reply within one business day.', 0]) ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
