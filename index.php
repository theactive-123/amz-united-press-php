<?php
require __DIR__ . '/includes/bootstrap.php';
$HOMEFAQ = data('home_faq');
$meta = [
    'title'       => 'Self-Publishing Services for Authors | AMZ United Press',
    'description' => 'Ghostwriting, ebook writing, editing, cover design, Amazon publishing and book marketing in one place. Keep 100% of your rights. Get a free quote today.',
    'path'        => '/',
    'nav'         => 'home',
    'schema'      => [
        ['@context' => 'https://schema.org', '@type' => 'ProfessionalService', 'name' => site('name'), 'url' => abs_url('/'), 'image' => abs_url('/assets/img/og-image.jpg'), 'telephone' => site('phone'), 'email' => site('email'),
         'description' => 'Self-publishing services for authors: ghostwriting, ebook writing, book editing, proofreading, formatting, cover design, Amazon and ebook publishing, audiobooks and book marketing.',
         'areaServed' => 'Worldwide',
         'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => 'Self-publishing services', 'itemListElement' => array_map(fn($s) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $s['name'], 'url' => abs_url('/services/' . $s['slug'])]], data('subs'))]],
        faq_schema($HOMEFAQ),
    ],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="home">

  <!-- 1. Hero -->
  <section class="x-hero" aria-labelledby="home-h1">
    <div class="x-hero-bg px" data-px="0.12"><img src="https://images.unsplash.com/photo-1676107779594-7a23bd99e07c?auto=format&fit=crop&w=1900&q=75" alt="" fetchpriority="high" decoding="async" onerror="this.classList.add('img-fail')"></div>
    <div class="x-w x-hero-in">
      <div class="x-hero-copy">
      <p class="x-kick ent" style="--d:0"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/></svg>Ebook writing &amp; publishing company</p>
      <h1 id="home-h1" class="hm-h1"><span class="h1-l ent" style="--d:1">Self-Publishing Services</span> <span class="h1-l ent" style="--d:2">for Authors</span></h1>
      <p class="x-deck ent" style="--d:3"><span class="sr">We write, edit, design, publish and launch your ebook.</span><span aria-hidden="true">We <span class="rot"><b id="rot">write</b></span> your ebook. You keep every royalty.</span></p>
      <div class="x-hero-body ent" style="--d:4">
        <div class="seg" role="radiogroup" aria-label="I am a…"><button type="button" role="radio" aria-checked="true" data-aud="author">For authors</button><button type="button" role="radio" aria-checked="false" data-aud="biz">For founders &amp; businesses</button></div>
        <p class="lead" id="hero-lead" aria-live="polite"></p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary" data-quote>Get a Free Quote</button>
          <a class="btn btn-ghost" href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><svg class="ic" aria-hidden="true"><use href="#i-phone"/></svg><?= e(site('phone')) ?></a>
        </div>
        <div class="hero-pop"><span class="hand">Popular services</span><span id="hero-pop" style="display:contents"></span></div>
      </div>
      </div>
      <div class="banner-right-image">
        <img src="<?= e(asset('img/banner-right-image.png')) ?>" alt="Two ebook covers created by AMZ United Press" fetchpriority="high" decoding="async">
      </div>
    </div>
    <a class="x-scroll" href="#how" aria-label="Scroll to the next section"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a>
  </section>

  <!-- 2. Ticker + photo strip -->
  <div class="x-marq" aria-hidden="true"><div class="x-marq-t"><span>Ghostwriting</span><i>✦</i><span>Book editing</span><i>✦</i><span>Cover design</span><i>✦</i><span>Amazon publishing</span><i>✦</i><span>Book marketing</span><i>✦</i><span>Ghostwriting</span><i>✦</i><span>Book editing</span><i>✦</i><span>Cover design</span><i>✦</i><span>Amazon publishing</span><i>✦</i><span>Book marketing</span><i>✦</i></div></div>
  <section class="x-strip trusted-strip" aria-labelledby="trusted-heading">
    <div class="trusted-label"><span class="trusted-eyebrow"><i aria-hidden="true"></i> Our author community</span><h2 id="trusted-heading">Trusted by <em>clients.</em></h2><p>Our authors, proudly holding the books they brought to life.</p></div>
    <div class="trusted-window" aria-hidden="true">
      <div class="x-strip-t" id="x-strip">
        <?php
          $clientImages = glob(__DIR__ . '/assets/img/client-images/*.{png,jpg,jpeg,webp,avif}', GLOB_BRACE) ?: [];
          natsort($clientImages);
          for ($copy = 0; $copy < 2; $copy++):
        ?><div class="trusted-group"><?php foreach ($clientImages as $clientImage): ?><img src="<?= e(asset('img/client-images/' . rawurlencode(basename($clientImage)))) ?>" alt="" loading="lazy" decoding="async"><?php endforeach; ?></div><?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- 3. Services for writers + platforms -->
  <section class="x-man" id="how" aria-labelledby="m-h">
    <div class="x-w x-man-grid">
      <div class="x-man-photo"><figure class="x-frame rv"><img src="<?= e(asset('img/Cinematic%20Sci-Fi%20Book%20Cover%20Showcase.png')) ?>" alt="Cinematic sci-fi book cover showcase" loading="lazy" decoding="async"></figure></div>
      <div class="x-man-text">
        <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v11H9l-5 4z"/><path d="m8.5 10.5 2.2 2.2 4.3-4.4"/></svg>Services for writers</p>
        <h2 class="x-h2 hm-h2 rv" id="m-h">Write, edit, publish and <em>promote</em> your ebook with an expert team.</h2>
        <p class="scrub x-big">Every author you admire once sat in front of a blank page and wondered whether the book would ever get finished. What carried them through was help: an editor who saw the potential, a designer who made it look the part, someone who knew how publishing really works. AMZ United Press brings that whole team to your side, whether you are writing your first ebook or your fifth.</p>
        <ul class="x-commit" aria-label="What we help you achieve">
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/></svg></b><span>Finally become a published author, with a book you are proud of.</span></li>
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.5 2.5 4.5-5"/></svg></b><span>Reach more readers and build an audience that comes back for the next one.</span></li>
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12.5V3.5h9l9 9-9 9z"/><circle cx="7.5" cy="8" r="1.2"/></svg></b><span>Turn your writing into income, with 100% of your royalties kept by you.</span></li>
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h9l4 4v14H6z"/><path d="M9 12h7M9 16h7"/></svg></b><span>A written quote before any work begins, and nothing starts until you say yes.</span></li>
        </ul>
      </div>
    </div>
    <section class="publishing-platforms" aria-labelledby="platform-heading">
      <div class="x-w platform-layout">
        <div class="platform-copy">
          <p class="x-kick">Beyond the manuscript</p>
          <h2 id="platform-heading">We Publish<br>Your Book<br>On All Leading<br><em>Platforms!</em></h2>
        </div>
        <div class="platform-marquees" aria-label="Publishing platforms">
          <?php
          $platforms = [
            'abebooks' => 'AbeBooks', 'scribd' => 'Scribd',
            'penguin_random_house' => 'Penguin Random House', 'barnes_noble' => 'Barnes & Noble',
            'rakuten_kobo' => 'Rakuten Kobo', 'lulu' => 'Lulu', 'createspace' => 'CreateSpace',
            'alibris' => 'Alibris', 'hachette' => 'Hachette Book Group', 'ibooks' => 'iBooks',
            'amazon_kindle' => 'Amazon Kindle', 'simon_schuster' => 'Simon & Schuster',
            'draft2digital' => 'Draft2Digital', 'harpercollins' => 'HarperCollins',
            'ingramspark' => 'IngramSpark', 'new_york_times' => 'The New York Times',
            'macmillan' => 'Macmillan', 'smashwords' => 'Smashwords',
          ];
          foreach (array_chunk($platforms, 6, true) as $row => $logos):
          ?><div class="platform-row<?= $row === 1 ? ' platform-row-reverse' : '' ?>"><div class="platform-belt"><?php for ($copy = 0; $copy < 2; $copy++): ?><div class="platform-group"<?= $copy ? ' aria-hidden="true"' : '' ?>><?php foreach ($logos as $file => $name): ?><div class="platform-logo"><img src="<?= e(asset('img/publishable-logo/' . $file . '.png')) ?>" alt="<?= $copy ? '' : e($name) ?>" loading="lazy" decoding="async"></div><?php endforeach; ?></div><?php endfor; ?></div></div><?php endforeach; ?>
        </div>
      </div>
    </section>
  </section>

  <!-- 4. Services -->
  <section class="x-svc" aria-labelledby="c-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 3.5h14v17H5z"/><path d="M9 8.5h6M9 12.5h6M9 16.5h3.5"/></svg>What we do</p>
      <h2 class="x-h2 hm-h2 rv" id="c-h">Self-publish your book with a <em>full-service</em> author services company.</h2>
      <p class="x-sub">Don’t leave the book in a drawer. From <a href="<?= e(url('/services/ebook-writing-services')) ?>">ebook writing</a> and <a href="<?= e(url('/services/book-editing-services')) ?>">book editing</a> to <a href="<?= e(url('/services/amazon-publishing-services')) ?>">Amazon publishing</a> and <a href="<?= e(url('/services/book-marketing-services')) ?>">book marketing</a>, every service you need is here, at prices written down before we start.</p>
      <div class="xs" id="xp"><?= render_service_tabs() ?></div>
    </div>
  </section>

  <!-- 5. Call to action -->
  <section class="hm-band" aria-labelledby="cta1-h">
    <div class="x-w hm-band-in">
      <div><h2 id="cta1-h">Ready to self-publish your book?</h2><p>AMZ United Press turns ideas and rough drafts into professionally written, edited and designed ebooks, then publishes them under your name.</p></div>
      <div class="hm-band-btns"><button type="button" class="btn btn-dark" data-quote>Get a Quote</button><button type="button" class="btn btn-outline" data-chat>Live Chat</button></div>
    </div>
  </section>

  <!-- 6. Genres -->
  <section class="hm-genres" aria-labelledby="g-h">
    <div class="x-w hm-genres-grid">
      <div>
        <p class="x-kick">Every genre</p>
        <h2 class="x-h2 hm-h2 rv" id="g-h">Self-publishing services for <em>all genres</em>.</h2>
        <p class="x-sub">Thrillers, memoirs, business books or bedtime stories: our writers and editors work across genres, so your book is handled by someone who knows its readers. Whatever you write, we help you write it well and get it in front of the people who will love it.</p>
        <button type="button" class="btn btn-primary" data-quote>Talk to a writer</button>
      </div>
      <ul class="hm-genre-list"><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Fiction</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/nonfiction-writing-services')) ?>"><span>Non-Fiction</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/memoir-writing-services')) ?>"><span>Memoir</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/biography-writing-services')) ?>"><span>Biography</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/autobiography-writing-services')) ?>"><span>Autobiography</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/novel-ghostwriting-services')) ?>"><span>Novels</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/nonfiction-writing-services')) ?>"><span>Self-Help</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/ebook-writing-services')) ?>"><span>Children’s Books</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Mystery & Thriller</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Science Fiction</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Fantasy</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Romance</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Dystopian</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Action & Adventure</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Horror & Suspense</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li><li><a href="<?= e(url('/services/fiction-writing-services')) ?>"><span>Historical Fiction</span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li></ul>
    </div>
  </section>

  <!-- 7. Shelf -->
  <section class="x-shelf list-ch" aria-labelledby="l-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/></svg>The shelf</p>
      <h2 class="x-h2 hm-h2 rv" id="l-h">Our published <em>ebooks</em>.</h2>
      <p class="x-sub">A few of the books we have helped authors write, design and publish. <a href="<?= e(url('/portfolio')) ?>">See the full portfolio</a>.</p>
    </div>
    <div class="list-track" id="list-track" data-works="home" role="region" aria-roledescription="carousel" aria-label="Book covers across all genres" tabindex="0"></div>
    <div class="x-w list-foot">
      <div class="arrows"><button type="button" id="list-prev" aria-label="Previous covers"><svg class="ic" aria-hidden="true" style="transform:scaleX(-1)"><use href="#i-arrow"/></svg></button><button type="button" id="list-next" aria-label="Next covers"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
    </div>
  </section>

  <!-- 8. Four steps -->
  <section class="journey" id="journey" aria-labelledby="j-h">
    <div class="jpin">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="19" r="2"/><circle cx="19" cy="5" r="2"/><path d="M7 19h5a4 4 0 0 0 0-8h-1a4 4 0 0 1 0-8h6"/></svg><span id="j-h">Four steps to your published book</span></p>
      <div class="jmain">
        <div class="jsteps" id="jsteps"><?= render_journey_steps() ?></div>
        <div class="jprog" id="jprog" aria-label="Journey stages"><?= render_journey_nav() ?></div>
      </div>
    </div>
  </section>

  <!-- 9. Call to action -->
  <section class="hm-band hm-band-dark" aria-labelledby="cta2-h">
    <div class="x-w hm-band-in">
      <div><h2 id="cta2-h">Services for authors, shaped by writers.</h2><p>Our team writes and publishes books for a living. We bring that experience to your manuscript and turn it into an ebook ready for readers everywhere.</p></div>
      <div class="hm-band-btns"><button type="button" class="btn btn-primary" data-quote>Get a Quote</button><a class="btn btn-outline" href="<?= e(url('/how-it-works')) ?>">How it works</a></div>
    </div>
  </section>

  <!-- 10. About + why choose us -->
  <section class="hm-about" aria-labelledby="ab-h">
    <div class="x-w">
      <div class="hm-about-top">
        <div><p class="x-kick">About us</p><h2 class="x-h2 hm-h2 rv" id="ab-h">About our author <em>services</em> company.</h2></div>
        <div>
          <h3>Professional ebook writers and book publishers</h3>
          <p>AMZ United Press is a team of ghostwriters, editors, proofreaders, cover designers, formatters and publishing specialists who have spent years helping independent authors bring books to market. Whatever your book needs, the right person is already on the team.</p>
          <p>You work with one project manager from first call to launch day, and you see the scope, timeline and price in writing before anything begins. <a href="<?= e(url('/about')) ?>">More about us</a>.</p>
        </div>
      </div>
      <h3 class="hm-why-h">Why choose our self-publishing company?</h3>
      <p class="x-sub">Because writing, editing and publishing all happen in one place, with people who care about the book as much as you do. We help you get your ideas out of your notebook and into readers’ hands.</p>
      <div class="hm-why">
        <article class="rv"><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-shield"/></svg></span><h4>Quality you can trust</h4><p>Every book gets experienced writers and editors and a careful final check. We stay transparent about what we are doing and why, so you always know where your project stands.</p></article>
        <article class="rv"><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-lock"/></svg></span><h4>Your copyright, your control</h4><p>Your book is your legacy. You approve every stage, keep full copyright and choose how and where to publish, distribute and market it. We protect your work under a signed NDA.</p></article>
        <article class="rv"><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-clock"/></svg></span><h4>On-time delivery</h4><p>We agree a schedule with you at the start and keep to it. A clear workflow and milestone updates mean your launch date stays realistic, without cutting corners on quality.</p></article>
        <article class="rv"><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-globe"/></svg></span><h4>A real market advantage</h4><p>A professionally written, edited and designed book earns trust from readers and reviewers. We help you stand out in a crowded store and build an author brand that lasts beyond one title.</p></article>
      </div>
      <div class="hm-stats" role="list"><?= render_stats() ?></div>
    </div>
  </section>

  <!-- 11. Cover studio -->
  <section class="x-studio" aria-labelledby="st-big">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m4 20 1-4.2L16.2 4.6l3.2 3.2L8.2 19z"/><path d="m14 6.8 3.2 3.2"/></svg>Cover maker</p>
      <h2 class="x-h2 rv" id="st-big">Try a cover. <em>Right now.</em></h2>
      <p class="x-sub">Type your title, pick a genre and watch a concept cover appear. It is a quick sketch of what our designers can do.</p>
      <aside class="hero-press" id="studio" role="group" aria-labelledby="st-h">
        <div class="st-top"><h3 id="st-h">Live preview</h3><span aria-hidden="true">Concept</span></div>
        <div class="st-stage" id="st-stage"><div class="bk3d" id="st-book"></div></div>
        <div class="studio">
          <div class="st-row"><div><label for="st-title">Book title</label><input id="st-title" maxlength="38" value="The Quiet Harvest" autocomplete="off"></div>
          <div><label for="st-by">Author name</label><input id="st-by" maxlength="26" value="Helen Marsh" autocomplete="off"></div></div>
          <fieldset><legend>Genre</legend><div class="gchips" role="radiogroup" id="st-genres" aria-label="Genre"></div></fieldset>
          <div class="st-act"><button type="button" class="btn btn-primary" id="st-go">Request a cover like this</button><p class="note-small" id="st-status" aria-live="polite"></p></div>
        </div>
      </aside>
    </div>
  </section>

  <!-- 12. Proof -->
  <section class="x-proof" aria-labelledby="p-h">
    <div class="x-proof-bg px" data-px="0.1"><img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1800&q=70" alt="" loading="lazy" onerror="this.classList.add('img-fail')"></div>
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m4 20 1-4.2L16.2 4.6l3.2 3.2L8.2 19z"/><path d="m14 6.8 3.2 3.2"/></svg>Editing, shown</p>
      <h2 class="x-h2 rv" id="p-h">Your voice, with the <em>clutter</em> removed.</h2>
      <p class="x-sub">Good editing keeps what is yours and takes away what gets in its way. Switch the paragraph to see the same text after editing.</p>
      <div class="seg proof-ctl" role="radiogroup" aria-label="Show the paragraph"><button type="button" role="radio" aria-checked="true" data-ed="before">Before</button><button type="button" role="radio" aria-checked="false" data-ed="after">After editing</button></div>
      <div class="proof">
        <div class="proof-page" id="paper" aria-live="polite"></div>
        <ol class="edit-notes" id="edit-notes" aria-label="Editor’s notes"></ol>
      </div>
    </div>
  </section>

  <!-- 13. Rates -->
  <section class="x-rates" aria-labelledby="r-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12.5V3.5h9l9 9-9 9z"/><circle cx="7.5" cy="8" r="1.2"/></svg>Rates</p>
      <h2 class="x-h2 rv" id="r-h">Three ways to <em>begin.</em></h2>
      <p class="x-sub">Every book is different, so the final quote is written for your length, services and timeline.</p>
      <div class="xp-grid" id="home-price"><?= render_plans() ?></div>
      <?= ph_note('Sample prices. Replace with your real packages before launch.') ?>
    </div>
  </section>

  <!-- 14. Readers -->
  <section class="x-read" aria-labelledby="t-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9.5 6.5C6 7.4 4 9.7 4 13v4.5h5.5V12H6.8c.2-2.2 1.2-3.4 2.7-4z"/><path d="M19.5 6.5c-3.5.9-5.5 3.2-5.5 6.5v4.5h5.5V12h-2.7c.2-2.2 1.2-3.4 2.7-4z"/></svg>Authors say</p>
      <h2 class="x-h2 rv" id="t-h">Kind words, <em>kept short.</em></h2>
      <div id="home-testi"><?= render_testimonials() ?></div>
      <?= ph_note('Sample testimonials and placeholder portraits. Replace with real clients, used with permission.') ?>
    </div>
  </section>

  <!-- 15. Questions -->
  <section class="x-faq" aria-labelledby="faq-h">
    <div class="x-w x-faq-grid">
      <div class="x-faq-side">
        <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9.6 9.6a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.2 1-1.2 1.8"/><path d="M12 17h.01"/></svg>Questions</p>
        <h2 class="x-h2 rv" id="faq-h">Frequently asked <em>questions</em>.</h2>
        <figure class="x-frame x-faq-photo"><img src="https://images.unsplash.com/photo-1630343710506-89f8b9f21d31?auto=format&fit=crop&w=800&q=75" alt="" loading="lazy" onerror="this.classList.add('img-fail')"></figure>
        <p style="margin:24px 0 0"><a class="x-link" href="<?= e(url('/faq')) ?>">All questions <svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></p>
      </div>
      <div class="faq" data-faq="home"><?= faq_html($HOMEFAQ, true) ?></div>
    </div>
  </section>

  <!-- 16. Close -->
  <section class="x-close" id="contact" aria-labelledby="final-h">
    <div class="x-close-bg px" data-px="0.1"><img src="https://images.unsplash.com/photo-1764337482439-ae67981bff34?auto=format&fit=crop&w=1800&q=70" alt="" loading="lazy" onerror="this.classList.add('img-fail')"></div>
    <div class="x-w x-close-grid">
      <div>
        <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5.5h18v13H3z"/><path d="m3.5 6.5 8.5 6.5 8.5-6.5"/></svg>Write to us</p>
        <h2 id="final-h" class="x-h2 x-h2--xl rv">Writers and publishers, <em>ready for you.</em></h2>
        <p class="x-sub">Tell us about your idea or your draft. A real person replies within one business day with honest advice and no obligation.</p>
        <a class="phone-big" href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><?= e(site('phone')) ?></a>
        <ul class="checks"><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Free consultation</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Scope, timeline and price in writing</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Nothing starts until you say yes</li></ul>
      </div>
      <div class="postcard"><?= render_form('home', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'home') ?></div>
    </div>
  </section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
