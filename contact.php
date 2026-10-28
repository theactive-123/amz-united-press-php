<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/inner.php';
$meta = [
    'inner' => true,
    'title' => 'Contact AMZ United Press | Get a Free Ebook Quote',
    'description' => 'Tell us about your book in four quick questions. A real person replies within one business day with next steps and a written quote. No obligation.',
    'path' => '/contact', 'nav' => 'contact',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Contact', null]]), ['@context' => 'https://schema.org', '@type' => 'ContactPage', 'name' => 'Contact ' . site('name'), 'url' => abs_url('/contact')]],
];
include __DIR__ . '/includes/header.php';
$tel = preg_replace('/[^\d+]/', '', site('phone'));
$side = '<div class="ix-hero-side ix-contact-side">' . ix_book(1, 'ix-contact-book') . ix_form('contact', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'contact', null, 'Send my request') . '</div>';
?>
<div class="page active ix" data-page="contact">
<div class="ix-progress" aria-hidden="true"><i></i></div>
<?= ix_page_hero(['Contact'], 'Tell us about your <span class="mk">book</span>.', 'Four quick questions. We’ll reply personally, and there’s no obligation.', $side, '<ul class="ix-hero-ticks"><li>' . ix_icon('check') . 'Free advice, no obligation</li><li>' . ix_icon('check') . 'A real person replies within one business day</li><li>' . ix_icon('check') . 'Your idea stays confidential</li></ul>' . ix_journey()) ?>

<section class="ix-sec ix-contact" aria-labelledby="ct-talk">
  <div class="ix-w ix-contact-in">
    <div class="ix-contact-copy">
      <span class="ix-eyebrow ix-rv">Other ways to reach us</span>
      <h2 id="ct-talk" class="ix-h2 ix-rv">Prefer to talk? Call us.</h2>
      <p class="ix-lead ix-rv">Some people find it easier to chat. That’s perfectly fine.</p>
      <div class="ix-ctas ix-rv"><a class="ix-btn ix-btn-primary" href="tel:<?= e($tel) ?>"><?= ix_icon('phone') ?>Call <?= e(site('phone')) ?></a><button type="button" class="ix-btn ix-btn-ghost" data-chat><?= ix_icon('chat') ?>Live Chat</button></div>
      <?= ph_note('Placeholder contact details. Edit them in includes/data.php.') ?>
    </div>
    <ul class="ix-contact-list contact-list">
      <li class="ix-rv big"><span class="ix-why-ic"><?= ix_icon('phone') ?></span><div><strong>Phone</strong><a href="tel:<?= e($tel) ?>"><?= e(site('phone')) ?></a></div></li>
      <li class="ix-rv" style="--d:80ms"><span class="ix-why-ic"><?= ix_icon('mail') ?></span><div><strong>Email</strong><a href="mailto:<?= e(site('email')) ?>"><?= e(site('email')) ?></a></div></li>
      <li class="ix-rv" style="--d:160ms"><span class="ix-why-ic"><?= ix_icon('clock') ?></span><div><strong>Opening hours</strong><span><?= e(site('hours')) ?></span></div></li>
      <li class="ix-rv" style="--d:240ms"><span class="ix-why-ic"><?= ix_icon('map') ?></span><div><strong>Address</strong><span><?= e(site('address')) ?></span></div></li>
    </ul>
  </div>
</section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
