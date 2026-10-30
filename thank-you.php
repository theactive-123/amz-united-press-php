<?php
require __DIR__ . '/includes/bootstrap.php';
session_boot();
$conversion = $_SESSION['lead_conversion'] ?? null;
unset($_SESSION['lead_conversion']);
$meta = [
    'title' => 'Thank You | AMZ United Press',
    'description' => 'Your message has been received. A real person will reply within one business day.',
    'path' => '/thank-you', 'nav' => '', 'noindex' => true,
];
include __DIR__ . '/includes/header.php';
if ($conversion && cfg('ga4_id')) {
    echo '<script>gtag("event","generate_lead",' . json_encode($conversion, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ');</script>';
}
?>
<div class="page active" data-page="thank-you">
<section class="section" style="padding:120px 0 140px;text-align:center"><div class="wrap" style="max-width:640px">
  <div class="big-tick" style="margin:0 auto 24px"><?= ic('check') ?></div>
  <h1>Thank you. We’ve got your message.</h1>
  <p class="lead">A real person will read it and reply personally within one business day. If it’s urgent, call us on <strong><?= e(site('phone')) ?></strong>.</p>
  <div class="btn-row" style="justify-content:center;margin-top:28px"><a class="btn btn-dark" href="<?= e(url('/')) ?>">Back to home</a><a class="btn btn-outline" href="<?= e(url('/portfolio')) ?>">Browse the portfolio</a></div>
</div></section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
