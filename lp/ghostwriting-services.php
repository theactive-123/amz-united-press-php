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
    ['Is ghostwriting legal and ethical?', 'Yes. Ghostwriting is a long-established, entirely legal practice used by business leaders, public figures and first-time authors. The ideas and stories are yours; the ghostwriter is a professional you hire to put them into words.'],
];
$meta = [
    'lp' => true,
    'title' => 'Ghostwriting Services | Hire a Ghostwriter | AMZ United Press',
    'description' => 'Hire a professional ghostwriter who writes your book in your voice. Signed NDA, 100% rights and royalties, chapter-by-chapter approval. Get a free quote.',
    'path' => '/lp/ghostwriting-services', 'nav' => '',
    'schema' => lp_schema('Ghostwriting Services', 'Professional ghostwriting services: a dedicated ghostwriter interviews the author and writes the book in their voice, with full confidentiality and 100% ownership.', '/lp/ghostwriting-services', $FAQ, $gw['price']),
];
include dirname(__DIR__) . '/includes/header.php';
$t0 = data('testimonials')[0];
?>
<div class="page active" data-page="lp-ghost">

<!-- 1. Hero: story-led, light -->
<section class="lph-story" aria-labelledby="lp-h1">
  <div class="lp-w lph-grid">
    <div>
      <p class="lp-kick">Professional ghostwriting services</p>
      <h1 id="lp-h1">You tell the story. <em>We write the book.</em></h1>
      <p class="lp-lead">Hire a professional ghostwriter who interviews you, learns exactly how you speak and writes your book chapter by chapter, in your voice. You approve every page, your name goes on the cover, and every right and royalty stays with you. Confidential from the very first call.</p>
      <?= lp_ctas() ?>
      <?= lp_assure(['Signed NDA', 'Your name on the cover', '100% royalties']) ?>
      <div class="lph-quote"><div class="lp-stars" aria-label="5 out of 5">★★★★★</div><p>“<?= e($t0[2]) ?>” <b>— <?= e($t0[0]) ?>, <?= e($t0[1]) ?></b></p></div>
    </div>
    <?= lp_form('lp-form', 'Talk to a ghostwriter', 'Free, confidential consultation. We reply within one business day.', 0) ?>
  </div>
</section>

<?= lp_platform_strip('Our authors’ books are sold on') ?>

<!-- 2. Sound familiar -->
<section class="lp-sec" aria-labelledby="sf-h">
  <div class="lp-w">
    <div class="lp-head c"><p class="lp-kick">Sound familiar?</p><h2 class="lp-h2" id="sf-h">You’ve meant to write this book <em>for years.</em></h2><p class="lp-lead">You have the stories, the expertise or the idea. What you don’t have is hundreds of spare hours, or the patience to stare at a blank page. That’s what a ghostwriter is for.</p></div>
    <div class="lp-cards c3">
      <div class="lp-card"><span class="lp-ico"><?= ic('clock') ?></span><h3>“I don’t have the time.”</h3><p>Founders, doctors and busy professionals spend one or two hours a week talking to their writer. We do the hundreds of hours of writing.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('pen') ?></span><h3>“I’m not a writer.”</h3><p>You don’t need to be. You need a great story or valuable knowledge. Our ghostwriters turn conversation into polished, readable chapters.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('edit') ?></span><h3>“I started, then stalled.”</h3><p>Send us your notes and half-finished draft. Your writer will build a plan around what you have and carry the book to the finish line.</p></div>
    </div>
  </div>
</section>

<!-- 3. How it works -->
<section class="lp-sec dark" aria-labelledby="hw-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><p class="lp-kick">How ghostwriting works</p><h2 class="lp-h2" id="hw-h">You talk. <em>We write.</em> You approve.</h2><p class="lp-lead">A clear, collaborative process that keeps you in control without taking over your calendar.</p><?= lp_ctas('#lp-form', 'Book my free consultation', false) ?></div>
    <ol class="lp-vsteps">
      <li><div><h3>Free, confidential consultation</h3><p>Tell us about your book and your goals. We sign an NDA, match you with a ghostwriter for your genre and send a written quote.</p></div></li>
      <li><div><h3>Discovery interviews</h3><p>In a few relaxed, recorded calls, your writer gathers your stories, ideas and the way you naturally speak.</p></div></li>
      <li><div><h3>Outline &amp; voice guide</h3><p>You approve a chapter-by-chapter outline and a short voice guide before any drafting begins.</p></div></li>
      <li><div><h3>Chapter-by-chapter writing</h3><p>Your ghostwriter drafts in stages. You read, comment and request changes, so nothing surprises you at the end.</p></div></li>
      <li><div><h3>Editing &amp; polish</h3><p>A separate editor and proofreader refine the full manuscript for flow, accuracy and consistency.</p></div></li>
      <li><div><h3>Your finished book</h3><p>You receive the final manuscript with full copyright, ready for cover design and publishing whenever you are.</p></div></li>
    </ol>
  </div>
</section>

<!-- 4. Genres -->
<section class="lp-sec alt" aria-labelledby="gn-h">
  <div class="lp-w lp-split">
    <div><p class="lp-kick">Every genre</p><h2 class="lp-h2" id="gn-h">A ghostwriter who knows <em>your kind of book.</em></h2><p class="lp-lead" style="margin:0">We match you with a writer who reads and writes in your genre, so the book meets readers’ expectations from page one.</p></div>
    <div class="lp-chips">
      <?php foreach ([['Memoir', 'memoir-writing-services'], ['Autobiography', 'autobiography-writing-services'], ['Biography', 'biography-writing-services'], ['Business & leadership', 'nonfiction-writing-services'], ['Self-help', 'nonfiction-writing-services'], ['Novels', 'novel-ghostwriting-services'], ['Thriller & mystery', 'fiction-writing-services'], ['Romance', 'fiction-writing-services'], ['Fantasy & sci-fi', 'fiction-writing-services'], ['Children’s books', 'ebook-writing-services'], ['Ebooks & guides', 'ebook-writing-services'], ['Faith & inspiration', 'nonfiction-writing-services']] as $g): ?><a href="<?= e(url('/services/' . $g[1])) ?>"><?= e($g[0]) ?> <?= ic('arrow') ?></a><?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 5. What you get -->
<section class="lp-sec" aria-labelledby="wg-h">
  <div class="lp-w">
    <div class="lp-head"><p class="lp-kick">What you get</p><h2 class="lp-h2" id="wg-h">Everything included in our <em>ghostwriting services.</em></h2></div>
    <div class="lp-cards">
      <div class="lp-card"><span class="lp-ico"><?= ic('users') ?></span><h3>A dedicated ghostwriter</h3><p>One professional writer for the whole book, matched to your genre and personality.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('headset') ?></span><h3>A project manager</h3><p>Your single point of contact for schedules, milestones and questions.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('layout') ?></span><h3>Outline &amp; voice guide</h3><p>A detailed chapter plan and voice profile, approved by you before writing starts.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('edit') ?></span><h3>Revisions included</h3><p>Chapter feedback and revisions within the agreed scope, until it reads like you.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('check') ?></span><h3>Professional editing</h3><p>A separate editor and proofreader polish the finished manuscript.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('lock') ?></span><h3>Signed NDA</h3><p>Complete confidentiality. Your story and your identity stay private.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('shield') ?></span><h3>Full copyright</h3><p>100% ownership of the manuscript and every royalty, transferred to you.</p></div>
      <div class="lp-card"><span class="lp-ico"><?= ic('publish') ?></span><h3>Optional publishing</h3><p><a href="<?= e(url('/services/book-cover-design-services')) ?>">Cover design</a>, formatting and <a href="<?= e(url('/services/amazon-publishing-services')) ?>">Amazon publishing</a> when you are ready.</p></div>
    </div>
  </div>
</section>

<section class="lp-band" aria-label="Get started">
  <div class="lp-w"><div><h2>Your story deserves to be told well.</h2><p>Book a free, confidential call with a ghostwriter today.</p></div><?= lp_ctas('#lp-form2', 'Hire a Ghostwriter', false) ?></div>
</section>

<!-- 6. Compare -->
<section class="lp-sec soft" aria-labelledby="cp-h">
  <div class="lp-w">
    <div class="lp-head"><p class="lp-kick">Compare</p><h2 class="lp-h2" id="cp-h">Ghostwriting that’s <em>personal and affordable.</em></h2></div>
    <div class="lp-tablewrap"><table class="lp-table">
      <thead><tr><th scope="col"></th><th scope="col">Large ghostwriting agencies</th><th scope="col">Freelance marketplaces</th><th scope="col" class="us">AMZ United Press</th></tr></thead>
      <tbody>
        <tr><th scope="row">Typical cost</th><td>Often $20,000+</td><td>Typically $5,000–$25,000</td><td class="us">From <?= e($gw['price']) ?>, quoted in writing</td></tr>
        <tr><th scope="row">Timeline</th><td>Typically 6–12 months</td><td>Often 4–8 months</td><td class="us"><?= e($gw['time']) ?></td></tr>
        <tr><th scope="row">Writer matched to your genre</th><td>Usually</td><td>You vet them yourself</td><td class="us y">✓ Matched for you</td></tr>
        <tr><th scope="row">Chapter-by-chapter approval</th><td>Sometimes</td><td>Depends on the writer</td><td class="us y">✓ Always</td></tr>
        <tr><th scope="row">Editing, cover &amp; publishing</th><td>Extra cost</td><td class="n">Not included</td><td class="us y">✓ Available in-house</td></tr>
        <tr><th scope="row">NDA &amp; full ownership</th><td>Usually</td><td>Depends on the contract</td><td class="us y">✓ Always</td></tr>
      </tbody>
    </table></div>
  </div>
</section>

<!-- 7. Confidentiality + proof -->
<section class="lp-sec dark" aria-labelledby="cf-h">
  <div class="lp-w">
    <div class="lp-head"><p class="lp-kick">Confidential by default</p><h2 class="lp-h2" id="cf-h">Your name on the cover. <em>Ours nowhere.</em></h2><p class="lp-lead" style="margin:0">Ghostwriting only works if you can trust the people behind it. These promises are in every contract.</p></div>
    <?= lp_promises() ?>
    <div class="lp-stats" style="margin-top:56px"><?= lp_stats() ?></div>
  </div>
</section>

<!-- 8. Reviews + covers -->
<section class="lp-sec" aria-labelledby="rv-h">
  <div class="lp-w">
    <div class="lp-head c"><p class="lp-kick">Authors say</p><h2 class="lp-h2" id="rv-h">“It sounds <em>exactly like me.</em>”</h2></div>
    <div class="lp-quotes"><?= lp_quotes() ?></div>
    <div class="lp-covers" style="--n:5;margin-top:56px"><?= lp_covers(5, 0) ?></div>
  </div>
</section>

<!-- 9. FAQ -->
<section class="lp-sec alt" aria-labelledby="fq-h">
  <div class="lp-w" style="max-width:960px">
    <div class="lp-head c"><p class="lp-kick">FAQs</p><h2 class="lp-h2" id="fq-h">Hiring a ghostwriter: <em>your questions.</em></h2></div>
    <div class="faq lp-faq"><?= faq_html($FAQ, true) ?></div>
  </div>
</section>

<!-- 10. Final CTA -->
<section class="lp-sec lp-final" aria-labelledby="fn-h">
  <div class="lp-w lp-split">
    <div><p class="lp-kick">Free &amp; confidential</p><h2 class="lp-h2" id="fn-h">Let’s write <em>your story.</em></h2><p class="lp-lead">Tell us a little about the book you want to write. A real person replies within one business day with next steps, a matched ghostwriter and a written quote.</p><?= lp_ctas('#lp-form2', 'Hire a Ghostwriter') ?><?= lp_assure() ?></div>
    <?= lp_form('lp-form2', 'Start my book', 'Takes about a minute. Completely confidential.', 0) ?>
  </div>
</section>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
