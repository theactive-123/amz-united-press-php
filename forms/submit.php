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
require dirname(__DIR__) . '/includes/Crm.php';
require dirname(__DIR__) . '/includes/EmailTemplates.php';

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
$source  = in_array($_POST['source'] ?? '', ['home', 'contact', 'quote', 'service', 'landing'], true) ? $_POST['source'] : 'contact';
$name    = $clean($_POST['name'] ?? '', 100);
$email   = $clean($_POST['email'] ?? '', 150);
$help    = $clean($_POST['help'] ?? '', 120);
$project = mb_substr(trim(str_replace("\r", '', (string)($_POST['project'] ?? ''))), 0, 3000);
// Ad tracking: landing page and UTM tags (added to the form by forms.js)
$track = [];
foreach (['landing_page', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid'] as $k) {
    $v = $clean($_POST[$k] ?? '', 200);
    if ($v !== '') $track[$k] = $v;
}
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

/* ---- CRM is the primary delivery channel for every form ---- */
$page = Crm::pageUrl($clean($_SERVER['HTTP_REFERER'] ?? '', 2000));
$fields = array_merge(['name' => $name, 'email' => $email, 'help' => $help, 'project' => $project], $track);
[$crmSent, $leadId, $crmError] = Crm::send($source, $fields, $page);
$sent = false;
$err = '';
$replySent = false;
$replyError = '';

// Email is supplementary. An SMTP failure must not turn an accepted CRM lead into a failed submission.
if ($crmSent) {
    $rows = '';
    $text = "New enquiry from " . site('name') . "\nCRM lead: $leadId\n";
    foreach (array_merge(['Form' => $source, 'Page' => $page ?? '', 'CRM lead' => $leadId], $fields) as $label => $value) {
        $rows .= '<tr><th align="left" valign="top" style="padding:8px">' . e($label) . '</th><td style="padding:8px;white-space:pre-wrap">' . e($value) . '</td></tr>';
        $text .= "$label: $value\n";
    }
    $html = EmailTemplates::layout('New website enquiry', '<table cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse">' . $rows . '</table>');
    $m = cfg('mail');
    [$sent, $err] = Mailer::send($m['to_email'], $m['to_name'], 'New website enquiry: ' . $help . ' - ' . $name, $html, $text, $email, $name);
    if (!empty($m['auto_reply'])) {
        [$replyHtml, $replyText] = EmailTemplates::confirmation($name, $help);
        [$replySent, $replyError] = Mailer::send($email, $name, 'We received your message - ' . site('name'), $replyHtml, $replyText);
    }
}

if (cfg('security.log_submissions', true)) {
    $line = json_encode(['time' => date('c'), 'ip' => $ip, 'source' => $source, 'name' => $name, 'email' => $email, 'help' => $help, 'project' => $project, 'track' => $track, 'crm_sent' => $crmSent, 'crm_lead_id' => $leadId, 'crm_error' => $crmError, 'emailed' => $sent, 'error' => $err, 'auto_reply_sent' => $replySent, 'auto_reply_error' => $replyError], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE) . "\n";
    @file_put_contents(ROOT . '/storage/submissions.log', $line, FILE_APPEND | LOCK_EX);
}
foreach (['crm' => $crmError, 'mail' => $err, 'auto-reply' => $replyError] as $channel => $error) {
    if ($error !== '') @file_put_contents(ROOT . '/storage/delivery-error.log', '[' . date('c') . '] ' . $channel . ': ' . $error . "\n", FILE_APPEND | LOCK_EX);
}
if (!$crmSent) respond(false, 'We could not send your message right now. Please try again shortly.', [], 502, $old, $source);

$hits[] = time();
@file_put_contents($rlFile, json_encode($hits), LOCK_EX);
unset($_SESSION['flash']);
if (!$isAjax) $_SESSION['lead_conversion'] = ['form_source' => $source, 'service' => $help];
respond(true, 'Thank you - we have received your message.', [], 200, $old, $source);