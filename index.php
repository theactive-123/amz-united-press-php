<?php
require __DIR__ . '/includes/bootstrap.php';
$F = data('faq');
$HOMEFAQ = [$F['Getting started'][0], $F['Getting started'][1], $F['Cost & timing'][0], $F['Publishing'][0]];
$meta = [
    'title'       => 'Ebook Writing, Editing, Design & Publishing | AMZ United Press',
    'description' => 'Ebook writing, editing, cover design and publishing for authors. Written quote first, you keep all rights and royalties, and a real person replies in one business day.',
    'path'        => '/',
    'nav'         => 'home',
    'schema'      => [faq_schema($HOMEFAQ)],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="home">

  <!-- 1. Hero -->
  <section class="x-hero" aria-labelledby="home-h1">
    <div class="x-hero-bg px" data-px="0.12"><img src="https://images.unsplash.com/photo-1676107779594-7a23bd99e07c?auto=format&fit=crop&w=1900&q=75" alt="" fetchpriority="high" decoding="async" onerror="this.classList.add('img-fail')"></div>
    <div class="x-w x-hero-in">
      <div class="x-hero-copy">
      <p class="x-kick ent" style="--d:0"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/></svg>Ebook publishing studio</p>
      <h1 id="home-h1"><span class="sr">We write your ebook. Your ideas deserve a life beyond the screen.</span><span aria-hidden="true"><span class="h1-l ent" style="--d:1">We <span class="rot"><b id="rot">write</b></span></span><span class="h1-l ent" style="--d:2">your ebook.</span></span></h1>
      <p class="x-deck ent" style="--d:3">Your ideas deserve a life beyond the screen.</p>
      <div class="x-hero-body ent" style="--d:4">
        <div class="seg" role="radiogroup" aria-label="I am a…"><button type="button" role="radio" aria-checked="true" data-aud="author">For authors</button><button type="button" role="radio" aria-checked="false" data-aud="biz">For founders &amp; businesses</button></div>
        <p class="lead" id="hero-lead" aria-live="polite"></p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary" data-quote>Request a free quote</button>
          <a class="btn btn-ghost" href="<?= e(url('/portfolio')) ?>">See the covers <svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a>
        </div>
        <div class="hero-pop"><span class="hand">Popular for you</span><span id="hero-pop" style="display:contents"></span></div>
      </div>
      </div>
      <div class="banner-right-image">
        <img src="<?= e(asset('img/banner-right-image.png')) ?>" alt="Two illustrated book covers" fetchpriority="high" decoding="async">
      </div>
    </div>
    <a class="x-scroll" href="#how" aria-label="Scroll to the next section"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a>
  </section>

  <!-- 2. Ticker + photo strip -->
  <div class="x-marq" aria-hidden="true"><div class="x-marq-t"><span>Writing</span><i>✦</i><span>Editing</span><i>✦</i><span>Cover design</span><i>✦</i><span>Publishing</span><i>✦</i><span>Launch</span><i>✦</i><span>Writing</span><i>✦</i><span>Editing</span><i>✦</i><span>Cover design</span><i>✦</i><span>Publishing</span><i>✦</i><span>Launch</span><i>✦</i></div></div>
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

  <!-- 3. Manifesto -->
  <section class="x-man" id="how" aria-labelledby="m-h">
    <div class="x-w x-man-grid">
      <div class="x-man-photo"><figure class="x-frame rv"><img src="<?= e(asset('img/Cinematic%20Sci-Fi%20Book%20Cover%20Showcase.png')) ?>" alt="Cinematic sci-fi book cover showcase" loading="lazy" decoding="async"></figure></div>
      <div class="x-man-text">
        <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v11H9l-5 4z"/><path d="m8.5 10.5 2.2 2.2 4.3-4.4"/></svg>How we work</p>
        <h2 class="x-h2 rv" id="m-h">We tell you <em>plainly.</em></h2>
        <p class="scrub x-big">Publishing has a habit of selling a package and hoping you will not read the details. We put everything on the table before we begin: what the work includes, how long it takes, what it costs, and whose book it is.</p>
        <ul class="x-commit" aria-label="Our commitments">
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h9l4 4v14H6z"/><path d="M9 12h7M9 16h7"/></svg></b><span>A written quote, with scope and timeline, before any work begins.</span></li>
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4 6v6c0 4.5 3.2 7.8 8 9 4.8-1.2 8-4.5 8-9V6z"/><path d="m9 12 2.2 2.2L15.5 10"/></svg></b><span>The book stays yours, with every right and every royalty.</span></li>
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v11H9l-5 4z"/></svg></b><span>A real person replies within one business day.</span></li>
          <li class="rv"><b><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.5 2.5 4.5-5"/></svg></b><span>Nothing starts until you say yes.</span></li>
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
      <h2 class="x-h2 rv" id="c-h">Ten services. <em>Four</em> parts. One team.</h2>
      <div class="xs" id="xp"><?= render_service_tabs() ?></div>
    </div>
  </section>

  <!-- 5. Journey -->
  <section class="journey" id="journey" aria-labelledby="j-h">
    <div class="jpin">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="5" cy="19" r="2"/><circle cx="19" cy="5" r="2"/><path d="M7 19h5a4 4 0 0 0 0-8h-1a4 4 0 0 1 0-8h6"/></svg><span id="j-h">From first idea to finished book</span></p>
      <div class="jmain">
        <div class="jsteps" id="jsteps"><?= render_journey_steps() ?></div>
        <div class="jprog" id="jprog" aria-label="Journey stages"><?= render_journey_nav() ?></div>
      </div>
    </div>
  </section>

  <!-- 6. Cover studio -->
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

  <!-- 7. Shelf -->
  <section class="x-shelf list-ch" aria-labelledby="l-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/></svg>The shelf</p>
      <h2 class="x-h2 rv" id="l-h">Books from our <em>portfolio</em>.</h2>
    </div>
    <div class="list-track" id="list-track" data-works="home" role="region" aria-roledescription="carousel" aria-label="Book covers across all genres" tabindex="0"></div>
    <div class="x-w list-foot">
      <div class="arrows"><button type="button" id="list-prev" aria-label="Previous covers"><svg class="ic" aria-hidden="true" style="transform:scaleX(-1)"><use href="#i-arrow"/></svg></button><button type="button" id="list-next" aria-label="Next covers"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
    </div>
  </section>

  <!-- 8. Proof -->
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

  <!-- 9. Rates -->
  <section class="x-rates" aria-labelledby="r-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12.5V3.5h9l9 9-9 9z"/><circle cx="7.5" cy="8" r="1.2"/></svg>Rates</p>
      <h2 class="x-h2 rv" id="r-h">Three ways to <em>begin.</em></h2>
      <p class="x-sub">Every book is different, so the final quote is written for your length, services and timeline.</p>
      <div class="xp-grid" id="home-price"><?= render_plans() ?></div>
      <?= ph_note('Sample prices. Replace with your real packages before launch.') ?>
    </div>
  </section>

  <!-- 10. Readers -->
  <section class="x-read" aria-labelledby="t-h">
    <div class="x-w">
      <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9.5 6.5C6 7.4 4 9.7 4 13v4.5h5.5V12H6.8c.2-2.2 1.2-3.4 2.7-4z"/><path d="M19.5 6.5c-3.5.9-5.5 3.2-5.5 6.5v4.5h5.5V12h-2.7c.2-2.2 1.2-3.4 2.7-4z"/></svg>Authors say</p>
      <h2 class="x-h2 rv" id="t-h">Kind words, <em>kept short.</em></h2>
      <div id="home-testi"><?= render_testimonials() ?></div>
      <?= ph_note('Sample testimonials and placeholder portraits. Replace with real clients, used with permission.') ?>
    </div>
  </section>

  <!-- 11. Questions -->
  <section class="x-faq" aria-labelledby="faq-h">
    <div class="x-w x-faq-grid">
      <div class="x-faq-side">
        <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9.6 9.6a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.2 1-1.2 1.8"/><path d="M12 17h.01"/></svg>Questions</p>
        <h2 class="x-h2 rv" id="faq-h"><em>Answered</em> plainly.</h2>
        <figure class="x-frame x-faq-photo"><img src="https://images.unsplash.com/photo-1630343710506-89f8b9f21d31?auto=format&fit=crop&w=800&q=75" alt="" loading="lazy" onerror="this.classList.add('img-fail')"></figure>
        <p style="margin:24px 0 0"><a class="x-link" href="<?= e(url('/faq')) ?>">All questions <svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></p>
      </div>
      <div class="faq" data-faq="home"><?= faq_html($HOMEFAQ, true) ?></div>
    </div>
  </section>

  <!-- 12. Close -->
  <section class="x-close" id="contact" aria-labelledby="final-h">
    <div class="x-close-bg px" data-px="0.1"><img src="https://images.unsplash.com/photo-1764337482439-ae67981bff34?auto=format&fit=crop&w=1800&q=70" alt="" loading="lazy" onerror="this.classList.add('img-fail')"></div>
    <div class="x-w x-close-grid">
      <div>
        <p class="x-kick"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5.5h18v13H3z"/><path d="m3.5 6.5 8.5 6.5 8.5-6.5"/></svg>Write to us</p>
        <h2 id="final-h" class="x-h2 x-h2--xl rv">Let’s talk about <em>your book.</em></h2>
        <p class="x-sub">Tell us about your idea or your draft. A real person replies within one business day with honest advice and no obligation.</p>
        <a class="phone-big" href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><?= e(site('phone')) ?></a>
        <ul class="checks"><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Free consultation</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Scope, timeline and price in writing</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Nothing starts until you say yes</li></ul>
      </div>
      <div class="postcard"><?= render_form('home', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'home') ?></div>
    </div>
  </section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
