<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$gw = sub_by_slug('ghostwriting-services');
$FAQ = [
    ['How much does it cost to hire a ghostwriter?', 'Our ghostwriting services start from ' . $gw['price'] . '. The final price depends on the length of the book, the amount of research and interviews involved, and your deadline. You get a written quote with milestones before any work begins, and you pay in stages as the book progresses.'],
    ['Will people know I used a ghostwriter?', 'Only if you tell them. Your name goes on the cover, our writers sign an NDA, and we never list your book in our portfolio or mention you without your written permission.'],
    ['Do I own the book and the royalties?', 'Yes, 100%. Once the project is paid, the copyright, the manuscript and every royalty belong to you. Ghostwriters do not receive credit or a share of your sales.'],
    ['How does the ghostwriter capture my voice?', 'Through conversation. Your writer interviews you over a series of recorded calls, studies anything you have written before and creates a short voice guide you approve. You then review the book chapter by chapter, so it keeps sounding like you.'],
    ['How much of my time will it take?', 'Usually one to two hours a week. Most of that is interview time and reading the chapters your writer sends. You provide the stories, ideas and expertise; we do the writing.'],
    ['How long does ghostwriting a book take?', 'Most books take ' . $gw['time'] . '. Shorter ebooks can be quicker and longer or research-heavy books take more time. We agree a realistic schedule with you at the start.'],
    ['What kinds of books do you ghostwrite?', 'Memoirs, autobiographies, biographies, business and self-help books, novels across every major genre, children’s books and more. We match you with a ghostwriter who works in your genre.'],
    ['Do you offer ebook ghostwriting?', 'Yes. Ebook ghostwriting is one of our most requested services, from lead-magnet guides and how-to books to short reads and series. Ebooks usually take six to ten weeks, and we can format and publish them to Amazon Kindle and other stores when the writing is done.'],
    ['Where can I find a reliable ghostwriter for hire?', 'Look for a team that offers a written contract, a signed NDA, full transfer of copyright, a clear schedule and samples of their work. At AMZ United Press every project includes all of these, plus a project manager and in-house editing, so you are never relying on a single unknown freelancer.'],
    ['Is ghostwriting legal and ethical?', 'Yes. Ghostwriting is a long-established, entirely legal practice used by business leaders, public figures and first-time authors. The ideas and stories are yours; the ghostwriter is a professional you hire to put them into words.'],
];
$meta = [
    'lp' => true,
    'title' => 'Ghostwriting Services | Hire a Ghostwriter | AMZ United Press',
    'description' => 'Affordable ghostwriting services for books and ebooks. Hire a ghostwriter who writes in your voice, under NDA, with 100% rights and royalties. Free quote.',
    'path' => '/lp/ghostwriting-services', 'nav' => '',
    'schema' => lp_schema('Ghostwriting Services', 'Professional ghostwriting services: a dedicated ghostwriter interviews the author and writes the book in their voice, with full confidentiality and 100% ownership.', '/lp/ghostwriting-services', $FAQ, $gw['price']),
];
include dirname(__DIR__) . '/includes/header.php';
?>
<div class="page" data-page="lp-ghost">

<?= lp_hero([
    'eyebrow' => 'Professional ghostwriting services',
    'h1' => 'You tell the story. <em>We write the book.</em>',
    'lead' => 'Hire a professional ghostwriter who interviews you, learns exactly how you speak and writes your book chapter by chapter, in your voice. You approve every page, your name goes on the cover, and every right and royalty stays with you. Confidential from the very first call.',
    'ticks' => ['Signed NDA', 'Your name on the cover', '100% royalties'],
    'extra' => lp_hero_faces(),
    'form' => ['Talk to a ghostwriter', 'Free, confidential consultation. We reply within one business day.', 0],
]) ?>

<?= lp_trust('Our authors’ books are sold on') ?>

<section class="sec bg-sand" aria-labelledby="sf-h">
  <div class="w">
    <?= lp_head('Sound familiar?', 'You’ve meant to write this book <em>for years.</em>', 'You have the stories, the expertise or the idea. What you don’t have is hundreds of spare hours, or the patience to stare at a blank page. That’s what a ghostwriter is for.', true, 'sf-h') ?>
    <?= lp_cards([
        ['clock', '“I don’t have the time.”', 'Founders, doctors and busy professionals spend one or two hours a week talking to their writer. We do the hundreds of hours of writing.'],
        ['pen', '“I’m not a writer.”', 'You don’t need to be. You need a great story or valuable knowledge. Our ghostwriters turn conversation into polished, readable chapters.'],
        ['edit', '“I started, then stalled.”', 'Send us your notes and half-finished draft. Your writer will build a plan around what you have and carry the book to the finish line.'],
    ], 3) ?>
  </div>
</section>

<section class="sec bg-ink" aria-labelledby="hw-h">
  <div class="w split split-57 top">
    <div class="sticky"><span class="eyebrow">How ghostwriting works</span><h2 class="h2" id="hw-h">Our ghostwriting process: you talk, <em>we write,</em> you approve.</h2><p class="lead">A clear, collaborative process that keeps you in control without taking over your calendar.</p><?= lp_ctas('Book my free consultation', '#lp-form', false) ?></div>
    <?= lp_steps([
        ['Free, confidential consultation', 'Tell us about your book and your goals. We sign an NDA, match you with a ghostwriter for your genre and send a written quote.'],
        ['Discovery interviews', 'In a few relaxed, recorded calls, your writer gathers your stories, ideas and the way you naturally speak.'],
        ['Outline & voice guide', 'You approve a chapter-by-chapter outline and a short voice guide before any drafting begins.'],
        ['Chapter-by-chapter writing', 'Your ghostwriter drafts in stages. You read, comment and request changes, so nothing surprises you at the end.'],
        ['Editing & polish', 'A separate editor and proofreader refine the full manuscript for flow, accuracy and consistency.'],
        ['Your finished book', 'You receive the final manuscript with full copyright, ready for cover design and publishing whenever you are.'],
    ]) ?>
  </div>
</section>

<?= lp_band('Talk to a ghostwriter today, free and confidential.', 'A real person replies within one business day.') ?>

<section class="sec bg-white" aria-labelledby="wg-h">
  <div class="w">
    <?= lp_head('What you get', 'Everything included in our <em>affordable ghostwriting services.</em>', 'One price, written down before we start, covering the whole journey from first interview to finished manuscript.', false, 'wg-h') ?>
    <?= lp_cards([
        ['users', 'A dedicated ghostwriter', 'One professional writer for the whole book, matched to your genre and personality.'],
        ['headset', 'A project manager', 'Your single point of contact for schedules, milestones and questions.'],
        ['layout', 'Outline & voice guide', 'A detailed chapter plan and voice profile, approved by you before writing starts.'],
        ['edit', 'Revisions included', 'Chapter feedback and revisions within the agreed scope, until it reads like you.'],
        ['check', 'Professional editing', 'A separate editor and proofreader polish the finished manuscript.'],
        ['lock', 'Signed NDA', 'Complete confidentiality. Your story and your identity stay private.'],
        ['shield', 'Full copyright', '100% ownership of the manuscript and every royalty, transferred to you.'],
        ['publish', 'Optional publishing', '[[book-cover-design-services|Cover design]], formatting and [[amazon-publishing-services|Amazon publishing]] when you are ready.'],
    ], 4) ?>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="bk-h">
  <div class="w">
    <?= lp_head('Authors say', '“It sounds <em>exactly like me.</em>”', '', true, 'bk-h') ?>
    <?= lp_quotes() ?>
    <div class="mt"><?= lp_books(6, 0) ?></div>
  </div>
</section>

<?= lp_authors() ?>

<section class="sec bg-white" aria-labelledby="gn-h">
  <div class="w split">
    <div><span class="eyebrow">Every genre</span><h2 class="h2" id="gn-h">A ghostwriter for hire who knows <em>your kind of book.</em></h2><p class="lead">We match you with a writer who reads and writes in your genre, so the book meets readers’ expectations from page one.</p></div>
    <div class="chips rv">
      <?php foreach ([['Memoir', 'memoir-writing-services'], ['Autobiography', 'autobiography-writing-services'], ['Biography', 'biography-writing-services'], ['Business & leadership', 'nonfiction-writing-services'], ['Self-help', 'nonfiction-writing-services'], ['Novels', 'novel-ghostwriting-services'], ['Thriller & mystery', 'fiction-writing-services'], ['Romance', 'fiction-writing-services'], ['Fantasy & sci-fi', 'fiction-writing-services'], ['Children’s books', 'ebook-writing-services'], ['Ebooks & guides', 'ebook-writing-services'], ['Faith & inspiration', 'nonfiction-writing-services']] as $g): ?><a href="<?= e(url('/services/' . $g[1])) ?>"><?= e($g[0]) ?> <?= ic('arrow') ?></a><?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="cp-h">
  <div class="w">
    <?= lp_head('Compare', 'Ghostwriting that’s <em>personal and affordable.</em>', '', false, 'cp-h') ?>
    <?= lp_table(['Large ghostwriting agencies', 'Freelance marketplaces', 'AMZ United Press'], [
        ['Typical cost', 'Often $20,000+', 'Typically $5,000–$25,000', 'From ' . $gw['price'] . ', quoted in writing'],
        ['Timeline', 'Typically 6–12 months', 'Often 4–8 months', $gw['time']],
        ['Writer matched to your genre', 'Usually', 'You vet them yourself', '✓ Matched for you'],
        ['Chapter-by-chapter approval', 'Sometimes', 'Depends on the writer', '✓ Always'],
        ['Editing, cover & publishing', 'Extra cost', '— Not included', '✓ Available in-house'],
        ['NDA & full ownership', 'Usually', 'Depends on the contract', '✓ Always'],
    ]) ?>
  </div>
</section>

<?= lp_band('Hire a ghostwriter who writes like you.' . lp_offer_suffix(), 'Free, confidential consultation and a written quote.') ?>

<section class="sec bg-ink" aria-labelledby="cf-h">
  <div class="w">
    <div class="split split-57">
      <div><span class="eyebrow">Confidential by default</span><h2 class="h2" id="cf-h">Your name on the cover. <em>Ours nowhere.</em></h2><p class="lead">Ghostwriting only works if you can trust the people behind it. These promises are in every contract.</p></div>
      <?= lp_promises() ?>
    </div>
    <div class="mt"><?= lp_stats() ?></div>
  </div>
</section>

<?= lp_faq('bg-white', 'Hiring a ghostwriter: <em>your questions.</em>', $FAQ) ?>

<?= lp_final('Free & confidential', 'Let’s write <em>your story.</em>', 'Tell us a little about the book you want to write. A real person replies within one business day with next steps, a matched ghostwriter and a written quote.', ['Signed NDA', 'Written quote first', '100% rights & royalties'], ['Start my book', 'Takes about a minute. Completely confidential.', 0]) ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
