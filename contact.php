<?php
require __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/sv.php';
$meta = [
    'sv' => true,
    'title' => 'Contact AMZ United Press | Get a Free Ebook Quote',
    'description' => 'Tell us about your book in four quick questions. A real person replies within one business day with next steps and a written quote. No obligation.',
    'path' => '/contact', 'nav' => 'contact',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Contact', null]]), ['@context' => 'https://schema.org', '@type' => 'ContactPage', 'name' => 'Contact ' . site('name'), 'url' => abs_url('/contact')]],
];
include __DIR__ . '/includes/header.php';
$tel = tel_href();
?>
<div class="page active svx" data-page="contact">
<section class="x-close svx-close svx-contact-top" aria-labelledby="pg-h1"><div class="x-w x-close-grid">
  <div>
    <p class="svx-crumbs"><a href="<?= e(url('/')) ?>">Home</a> <span aria-hidden="true">/</span> Contact</p>
    <h1 id="pg-h1" class="x-h2 ent" style="--d:1">Tell us about your <em>book</em>.</h1>
    <p class="x-sub ent" style="--d:2">Four quick questions. We’ll reply personally, and there’s no obligation.</p>
    <ul class="checks"><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Free consultation</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Scope, timeline and price in writing</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Nothing starts until you say yes</li></ul>
  </div>
  <div class="postcard"><?= render_form('contact', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'contact') ?></div>
</div></section>
<section class="svx-sec svx-reach" aria-labelledby="ct-talk"><div class="x-w svx-split top">
  <div><?= sv_kick('phone', 'Other ways to reach us') ?><h2 class="x-h2 svx-h2 rv" id="ct-talk">Prefer to talk? <em>Call us.</em></h2><p class="x-sub">Some people find it easier to chat. That’s perfectly fine.</p>
    <a class="phone-big" href="tel:<?= e($tel) ?>"><?= e(site('phone')) ?></a>
    <?= ph_note('Placeholder contact details. Edit them in includes/data.php.') ?></div>
  <ul class="svx-index">
    <li class="rv"><a href="tel:<?= e($tel) ?>"><span class="svx-rn">01</span><span><strong>Phone</strong><p><?= e(site('phone')) ?></p></span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li>
    <li class="rv"><div class="svx-index-row"><span class="svx-rn">02</span><span><strong>Email</strong><p><?= email_reveal('Click to reveal', 'em-row') ?></p></span></div></li>
    <li class="rv"><div class="svx-index-row"><span class="svx-rn">03</span><span><strong>Opening hours</strong><p><?= e(site('hours')) ?></p></span></div></li>
    <li class="rv"><div class="svx-index-row"><span class="svx-rn">04</span><span><strong>Address</strong><p><?= e(site('address')) ?></p></span></div></li>
  </ul>
</div></section>
</div>
<script src="<?= e(asset('js/sv.js')) ?>" defer></script>
<?php include __DIR__ . '/includes/footer.php'; ?>
