<?php
require __DIR__ . '/includes/bootstrap.php';
$meta = [
    'title' => 'Contact AMZ United Press | Get a Free Ebook Quote',
    'description' => 'Tell us about your book in four quick questions. A real person replies within one business day with next steps and a written quote. No obligation.',
    'path' => '/contact', 'nav' => 'contact',
    'schema' => [breadcrumb_schema([['Home', '/'], ['Contact', null]]), ['@context' => 'https://schema.org', '@type' => 'ContactPage', 'name' => 'Contact ' . site('name'), 'url' => abs_url('/contact')]],
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="contact">
<?= page_hero(['Contact'], 'Tell us about your <span class="mk">book</span>.', 'Four quick questions. We’ll reply personally, and there’s no obligation.', 'contact') ?>
<section class="section" style="padding-top:72px"><div class="wrap contact-grid">
  <div>
    <h2>Prefer to talk? Call us.</h2><p class="lead">Some people find it easier to chat. That’s perfectly fine.</p>
    <ul class="contact-list">
      <li><span class="ring"><?= ic('phone') ?></span><div><strong>Phone</strong><a href="tel:<?= e(preg_replace('/[^\d+]/', '', site('phone'))) ?>"><?= e(site('phone')) ?></a></div></li>
      <li><span class="ring"><?= ic('mail') ?></span><div><strong>Email</strong><a href="mailto:<?= e(site('email')) ?>"><?= e(site('email')) ?></a></div></li>
      <li><span class="ring"><?= ic('clock') ?></span><div><strong>Opening hours</strong><span><?= e(site('hours')) ?></span></div></li>
      <li><span class="ring"><?= ic('pin') ?></span><div><strong>Address</strong><span><?= e(site('address')) ?></span></div></li>
    </ul>
    <?= ph_note('Placeholder contact details. Edit them in includes/data.php.') ?>
  </div>
  <div><?= render_form('contact', 'Tell us about your book', 'Takes about a minute. We reply within one business day.', 'contact') ?></div>
</div></section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
