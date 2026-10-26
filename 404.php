<?php
require_once __DIR__ . '/includes/bootstrap.php';
http_response_code(404);
$meta = [
    'title' => 'Page Not Found | AMZ United Press',
    'description' => 'The page you were looking for could not be found.',
    'path' => '/404', 'nav' => '', 'noindex' => true,
];
include __DIR__ . '/includes/header.php';
?>
<div class="page active" data-page="404">
<section class="section" style="padding:120px 0 140px;text-align:center"><div class="wrap" style="max-width:640px">
  <p class="eyebrow">Error 404</p>
  <h1>This page has gone missing.</h1>
  <p class="lead">The link may be old or mistyped. Try one of these instead.</p>
  <div class="btn-row" style="justify-content:center;margin-top:28px"><a class="btn btn-dark" href="<?= e(url('/')) ?>">Go to home</a><a class="btn btn-outline" href="<?= e(url('/services')) ?>">See services</a><a class="btn btn-outline" href="<?= e(url('/contact')) ?>">Contact us</a></div>
</div></section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
