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
<div class="page active" data-page="lp-writing">

<!-- 1. Hero: dark split with the form -->
<section class="lph-split lp-hero-dark" aria-labelledby="lp-h1">
  <?= lp_mosaic() ?>
  <div class="lp-w lph-grid">
    <div>
      <div class="lph-badges"><span>Fiction</span><span>Nonfiction</span><span>Memoir</span><span>Biography</span><span>Ebooks</span></div>
      <h1 id="lp-h1">Professional book writing services, <em>in your voice.</em></h1>
      <p class="lp-lead">You have the idea. Our professional book writers turn it into a finished, publish-ready manuscript, interviewing you, learning how you speak and writing chapter by chapter while you approve every step. Your name goes on the cover. Every right and royalty stays with you.</p>
      <?= lp_ctas() ?>
      <?= lp_assure(['Free consultation', 'Written quote first', 'Signed NDA', '100% rights & royalties']) ?>
      <?php $fc = array_slice(glob(ROOT . '/assets/img/client-images/*.{png,jpg,jpeg,webp}', GLOB_BRACE) ?: [], 0, 5); ?>
      <div class="lph-faces"><span><?php foreach ($fc as $f): ?><img src="<?= e(asset('img/client-images/' . rawurlencode(basename($f)))) ?>" alt="" width="46" height="46"><?php endforeach; ?></span><p><b><?= e(data('stats')[0][0] . data('stats')[0][1]) ?> books published</b> for authors like these, under their own names.</p></div>
    </div>
    <?= lp_form('lp-form', 'Get your free writing quote', 'Tell us about your book. A real person replies within one business day.', 0) ?>
  </div>
</section>

<?= lp_platform_strip('We write, then publish to') ?>

<?= lp_authors() ?>

<!-- 2. Problem / solution -->
<section class="lp-sec" aria-labelledby="pg-h">
  <div class="lp-w">
    <div class="rv lp-head c"><p class="lp-kick">Sound familiar?</p><h2 class="lp-h2" id="pg-h">The book is in your head. <em>Getting it out</em> is the hard part.</h2><p class="lp-lead">Most books never get written, not because the idea isn’t good, but because writing a book takes hundreds of focused hours. That’s exactly what our ebook and book writing services take off your plate.</p></div>
    <div class="rv lp-pg">
      <div class="pain"><h3>Writing it alone</h3><ul>
        <li><i>✕</i>Months of evenings and weekends that never quite add up to a finished draft</li>
        <li><i>✕</i>A blank page, a loose outline and no one to tell you if it’s working</li>
        <li><i>✕</i>Chapters that don’t flow, and a voice that changes from page to page</li>
        <li><i>✕</i>No clear path from manuscript to a book people can actually buy</li>
      </ul></div>
      <div class="gain"><h3>With AMZ United Press</h3><ul>
        <li><i>✓</i>A professional writer matched to your genre, working to an agreed schedule</li>
        <li><i>✓</i>A chapter plan you approve before a single page is drafted</li>
        <li><i>✓</i>One consistent voice, yours, checked against your interviews and notes</li>
        <li><i>✓</i>Editing, cover design and publishing available whenever you are ready</li>
      </ul></div>
    </div>
  </div>
</section>

<!-- 3. Service picker -->
<section class="lp-sec alt" aria-labelledby="pk-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="pk-h">Writing services for <em>every kind</em> of book.</h2><p class="lp-lead" style="margin:0">Pick the book you want to write to see how we help and where pricing starts.</p></div>
    <div class="lp-pick" data-lp-pick>
      <div class="lp-pick-list" role="tablist" aria-label="Writing services">
        <?php foreach ($picks as $i => $p): $s = sub_by_slug($p[0]); ?>
        <button type="button" role="tab" id="pk-t<?= $i ?>" aria-controls="pk-p<?= $i ?>" aria-selected="<?= $i ? 'false' : 'true' ?>" tabindex="<?= $i ? -1 : 0 ?>"><?= e($s['name']) ?><?= ic('arrow') ?></button>
        <?php endforeach; ?>
      </div>
      <?php foreach ($picks as $i => $p): $s = sub_by_slug($p[0]); ?>
      <div class="lp-pick-panel" role="tabpanel" id="pk-p<?= $i ?>" aria-labelledby="pk-t<?= $i ?>"<?= $i ? ' hidden' : '' ?>>
        <h3><?= e($s['name']) ?></h3>
        <p><?= e($p[1]) ?></p>
        <ul><?php foreach ($p[2] as $x): ?><li><?= ic('check') ?><?= e($x) ?></li><?php endforeach; ?></ul>
        <div class="lp-pick-meta"><span>From <?= e($s['price']) ?></span><span>Typical time <?= e($s['time']) ?></span><span>Written quote first</span></div>
        <div class="lp-ctas"><a class="btn btn-primary" href="#lp-form" data-lp-cta>Get a <?= e(strtolower($s['t'])) ?> quote <?= ic('arrow') ?></a><a class="lp-link" href="<?= e(url('/services/' . $s['slug'])) ?>">Read more about <?= e(strtolower($s['name'])) ?></a></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 4. Process -->
<section class="lp-sec dark" aria-labelledby="st-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="st-h">From first call to finished manuscript in <em>four steps.</em></h2></div>
    <ol class="rv lp-steps" style="--n:4">
      <li><h3>Free consultation</h3><p>Tell us about your book, your readers and your goals. We match you with a writer who knows your genre and send a written quote.</p><small>1–3 days</small></li>
      <li><h3>Interviews &amp; outline</h3><p>Your writer interviews you, gathers your notes and research, and builds a chapter-by-chapter outline for your approval.</p><small>1–2 weeks</small></li>
      <li><h3>Writing &amp; review</h3><p>Chapters arrive in stages. You read, comment and request changes, so the book stays true to you the whole way through.</p><small>4–14 weeks</small></li>
      <li><h3>Final manuscript</h3><p>We polish, proofread and deliver the finished manuscript in Word and PDF, with full rights transferred to you.</p><small>1–2 weeks</small></li>
    </ol>
    <div style="margin-top:48px"><?= lp_ctas('#lp-form', 'Start with a free consultation') ?></div>
  </div>
</section>

<!-- 5. Proof: covers + stats -->
<section class="lp-sec" aria-labelledby="cv-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="cv-h">Books we’ve helped <em>bring to life.</em></h2><p class="lp-lead" style="margin:0">A few titles from authors we have written, edited, designed and published for. <a href="<?= e(url('/portfolio')) ?>">See the full portfolio</a>.</p></div>
    <div class="lp-covers" style="--n:5"><?= lp_covers(5, 2) ?></div>
    <div class="lp-stats" style="margin-top:64px"><?= lp_stats() ?></div>
  </div>
</section>

<section class="lp-band" aria-label="Get started">
  <div class="lp-w"><div><h2>Your book could be finished this season.</h2><p>Book a free consultation and get a written quote within one business day.</p></div><?= lp_ctas('#lp-form', 'Get My Free Quote', false) ?></div>
</section>

<?= lp_strip('Not sure which writing service fits your book? Ask a writer.') ?>

<!-- 6. Comparison -->
<section class="lp-sec alt" aria-labelledby="cp-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="cp-h">Why authors choose our <em>book writers.</em></h2></div>
    <div class="rv lp-tablewrap"><table class="lp-table">
      <thead><tr><th scope="col"></th><th scope="col">Writing it yourself</th><th scope="col">Freelance marketplaces</th><th scope="col" class="us">AMZ United Press</th></tr></thead>
      <tbody>
        <tr><th scope="row">Time to a finished draft</th><td>Often a year or more</td><td>Varies with the freelancer</td><td class="us">6–20 weeks, agreed upfront</td></tr>
        <tr><th scope="row">Writer matched to your genre</th><td class="n">—</td><td>You vet them yourself</td><td class="us y">✓ Matched for you</td></tr>
        <tr><th scope="row">Chapter-by-chapter approval</th><td class="n">—</td><td>Sometimes</td><td class="us y">✓ Always</td></tr>
        <tr><th scope="row">Editing, cover &amp; publishing</th><td>Find each one separately</td><td>Usually not included</td><td class="us y">✓ Under one roof</td></tr>
        <tr><th scope="row">Price</th><td>Your time</td><td>Often renegotiated mid-project</td><td class="us">Written quote, no surprises</td></tr>
        <tr><th scope="row">Rights &amp; royalties</th><td>Yours</td><td>Depends on the contract</td><td class="us y">✓ 100% yours, signed NDA</td></tr>
      </tbody>
    </table></div>
  </div>
</section>

<!-- 7. Promises + quotes -->
<section class="lp-sec" aria-labelledby="pr-h">
  <div class="lp-w">
    <div class="rv lp-head"><h2 class="lp-h2" id="pr-h">Your book. Your name. <em>Your royalties.</em></h2></div>
    <?= lp_promises() ?>
    <div class="rv lp-quotes" style="margin-top:40px"><?= lp_quotes() ?></div>
  </div>
</section>

<?= lp_strip('Ready to finish your book?' . lp_offer_suffix()) ?>

<!-- 8. FAQ -->
<section class="lp-sec soft" aria-labelledby="fq-h">
  <div class="lp-w lp-split top">
    <div class="lp-sticky"><h2 class="lp-h2" id="fq-h">Questions about our <em>book writing services.</em></h2><p class="lp-lead">Can’t see yours? Call us on <a href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>" data-lp-call><?= e(site('phone')) ?></a> or ask in the form.</p><a class="btn btn-primary" href="#lp-form2" data-lp-cta>Ask a writer <?= ic('arrow') ?></a></div>
    <div class="faq lp-faq"><?= faq_html($FAQ, true) ?></div>
  </div>
</section>

<!-- 9. Final CTA with form -->
<section class="lp-sec lp-final" aria-labelledby="fn-h">
  <div class="lp-w lp-split">
    <div><p class="lp-kick">Free consultation</p><h2 class="lp-h2" id="fn-h">Let’s write <em>your book.</em></h2><p class="lp-lead">Tell us what you want to write. We’ll match you with the right writer, answer your questions and send a written quote. No pressure and no obligation.</p><?= lp_ctas('#lp-form2', 'Get a Free Quote') ?><?= lp_assure() ?></div>
    <?= lp_form('lp-form2', 'Start your book today', 'Takes about a minute. We reply within one business day.', 0) ?>
  </div>
</section>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
