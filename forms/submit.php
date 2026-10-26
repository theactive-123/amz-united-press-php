<?php
/**
 * Form handler — receives the request form (POST), checks it, emails it, and answers.
 *
 *  - POST + JavaScript  -> answers with JSON (the page shows a thank-you message without reloading)
 *  - POST without JS    -> redirects to /thank-you (or back to the form with the errors)
 *  - GET                -> not allowed, sends the visitor to the contact page
 */
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/Mailer.php';

$isAjax = (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch') || str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

function respond(bool $ok, string $message, array $errors = [], int $status = 200, array $old = [], string $source = 'contact'): void {
    global $isAjax;
    if ($isAjax) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');
        echo json_encode(['ok' => $ok, 'message' => $message, 'errors' => $errors], JSON_UNESCAPED_UNICODE);
        exit;
    }
    session_boot();
    if ($ok) { header('Location: ' . url('/thank-you'), true, 303); exit; }
    $_SESSION['flash'][$source] = ['message' => $message, 'errors' => $errors, 'old' => $old];
    $back = $source === 'home' ? '/#contact' : ($source === 'quote' || $source === 'contact' ? '/contact' : '/contact');
    header('Location: ' . url($back), true, 303);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    header('Location: ' . url('/contact'), true, 303);
    exit;
}

/* ---- read and clean the input ---- */
$clean = fn($v, int $max) => mb_substr(trim(preg_replace('/[\r\n\t]+/', ' ', (string)$v)), 0, $max);
$source  = in_array($_POST['source'] ?? '', ['home', 'contact', 'quote', 'service'], true) ? $_POST['source'] : 'contact';
$name    = $clean($_POST['name'] ?? '', 100);
$email   = $clean($_POST['email'] ?? '', 150);
$help    = $clean($_POST['help'] ?? '', 120);
$project = mb_substr(trim(str_replace("\r", '', (string)($_POST['project'] ?? ''))), 0, 3000);
$old     = ['name' => $name, 'email' => $email, 'help' => $help, 'project' => $project];

/* ---- protection: security token, hidden trap field, speed, rate limit ---- */
if (!csrf_ok($_POST['csrf'] ?? null)) respond(false, 'Your session expired. Please reload the page and try again.', [], 419, $old, $source);
if (trim((string)($_POST['website'] ?? '')) !== '') { respond(true, 'Thank you.', [], 200, $old, $source); } // bot: pretend it worked
$age = form_stamp_age($_POST['ts'] ?? null);
if ($age === null || $age < (int)cfg('security.min_seconds', 3)) respond(false, 'That was very quick. Please check your details and send again.', [], 429, $old, $source);

$rlDir = ROOT . '/storage/ratelimit';
if (!is_dir($rlDir)) @mkdir($rlDir, 0755, true);
$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$rlFile = $rlDir . '/' . hash('sha256', $ip) . '.json';
$hits = is_file($rlFile) ? (json_decode((string)file_get_contents($rlFile), true) ?: []) : [];
$hits = array_values(array_filter($hits, fn($t) => $t > time() - 3600));
if (count($hits) >= (int)cfg('security.rate_limit_per_hour', 5)) respond(false, 'You have sent several messages already. Please try again later, or call us.', [], 429, $old, $source);

/* ---- validate ---- */
$errors = [];
if ($name === '') $errors['name'] = 'Please enter your full name.';
if ($email === '') $errors['email'] = 'Please enter your email address.';
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'That email doesn’t look right. It should look like name@example.com.';
if ($help === '' || !in_array($help, data('help_options'), true)) $errors['help'] = 'Please choose what you need help with.';
if ($errors) respond(false, 'Please fix the highlighted fields.', $errors, 422, $old, $source);

/* ---- build the emails ---- */
$when = date('D j M Y, g:i a T');
$page = $clean($_SERVER['HTTP_REFERER'] ?? '', 200);
$text = "New message from the AMZ United Press website\n\nName: $name\nEmail: $email\nNeeds help with: $help\nSent from: $source form" . ($page ? " ($page)" : '') . "\nWhen: $when\n\nProject details:\n" . ($project !== '' ? $project : '(none)') . "\n";
$html = '<div style="font-family:Arial,sans-serif;font-size:15px;line-height:1.6;color:#141413"><h2 style="margin:0 0 12px">New message from the website</h2>'
      . '<table cellpadding="6" style="border-collapse:collapse"><tr><td><b>Name</b></td><td>' . e($name) . '</td></tr><tr><td><b>Email</b></td><td><a href="mailto:' . e($email) . '">' . e($email) . '</a></td></tr>'
      . '<tr><td><b>Needs help with</b></td><td>' . e($help) . '</td></tr><tr><td><b>Form</b></td><td>' . e($source) . '</td></tr><tr><td><b>When</b></td><td>' . e($when) . '</td></tr></table>'
      . '<p><b>Project details</b></p><p style="background:#f6f4ee;padding:12px;border-radius:6px;white-space:pre-wrap">' . ($project !== '' ? e($project) : '(none)') . '</p></div>';

$m = cfg('mail');
[$sent, $err] = Mailer::send($m['to_email'], $m['to_name'], 'New website enquiry: ' . $help . ' — ' . $name, $html, $text, $email, $name);

/* Friendly auto-reply to the visitor (never blocks the main message) */
if ($sent && !empty($m['auto_reply'])) {
    $first = explode(' ', $name)[0];
    $rText = "Hi $first,\n\nThanks for getting in touch with " . site('name') . ". We have your message and a real person will reply within one business day.\n\nYour request: $help\n\nIf it's urgent, call us on " . site('phone') . ".\n\n— " . site('name') . "\n";
    $rHtml = '<div style="font-family:Arial,sans-serif;font-size:15px;line-height:1.6;color:#141413"><p>Hi ' . e($first) . ',</p><p>Thanks for getting in touch with ' . e(site('name')) . '. We have your message and a real person will reply within one business day.</p><p><b>Your request:</b> ' . e($help) . '</p><p>If it’s urgent, call us on ' . e(site('phone')) . '.</p><p>— ' . e(site('name')) . '</p></div>';
    Mailer::send($email, $name, 'We got your message — ' . site('name'), $rHtml, $rText);
}

/* ---- keep a copy (so nothing is lost if email is down) ---- */
if (cfg('security.log_submissions', true)) {
    $line = json_encode(['time' => date('c'), 'ip' => $ip, 'source' => $source, 'name' => $name, 'email' => $email, 'help' => $help, 'project' => $project, 'emailed' => $sent, 'error' => $err], JSON_UNESCAPED_UNICODE) . "\n";
    @file_put_contents(ROOT . '/storage/submissions.log', $line, FILE_APPEND | LOCK_EX);
}
if (!$sent) {
    @file_put_contents(ROOT . '/storage/mail-error.log', '[' . date('c') . '] ' . $err . "\n", FILE_APPEND | LOCK_EX);
    respond(false, 'We could not send your message right now. Please try again, or call us on ' . site('phone') . '.', [], 500, $old, $source);
}

$hits[] = time();
@file_put_contents($rlFile, json_encode($hits), LOCK_EX);
unset($_SESSION['flash']);
respond(true, 'Thank you — we’ve received your message.', [], 200, $old, $source);
