<?php
/**
 * Form helpers: security tokens and the HTML of the request form.
 * The same form is used on the home page, contact page, service pages and in the quote pop-up.
 * It submits with POST to /forms/submit.php (works with or without JavaScript).
 */

function session_boot(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_name('amzsid');
        session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS'])]);
        session_start();
    }
}
function csrf_token(): string {
    session_boot();
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(24));
    return $_SESSION['csrf'];
}
function csrf_ok(?string $t): bool { session_boot(); return !empty($_SESSION['csrf']) && is_string($t) && hash_equals($_SESSION['csrf'], $t); }

/** A signed timestamp: lets the server see how long the form was open (bots submit instantly). */
function form_stamp(): string { $t = (string)time(); return $t . '.' . hash_hmac('sha256', $t, (string)cfg('security.secret', 'x')); }
function form_stamp_age(?string $s): ?int {
    if (!$s || !str_contains($s, '.')) return null;
    [$t, $sig] = explode('.', $s, 2);
    if (!ctype_digit($t) || !hash_equals(hash_hmac('sha256', $t, (string)cfg('security.secret', 'x')), $sig)) return null;
    return time() - (int)$t;
}

/**
 * Print the form.
 * $p       unique prefix for field ids (home, contact, quote, svc)
 * $source  which page the message came from (saved with the message)
 */
function render_form(string $p, string $heading, string $sub, string $source, string $btn = 'Send my request', ?int $preselect = null): string {
    $flash = '';
    session_boot();
    $old = [];
    if (!empty($_SESSION['flash'][$source])) { $f = $_SESSION['flash'][$source]; unset($_SESSION['flash'][$source]); $flash = $f['message'] ?? ''; $old = $f['old'] ?? []; $errs = $f['errors'] ?? []; }
    $errs = $errs ?? [];
    $opts = '<option value="" disabled' . (empty($old['help']) && $preselect === null ? ' selected' : '') . '>Choose one</option>';
    foreach (data('help_options') as $i => $h) $opts .= '<option' . ((($old['help'] ?? '') === $h || (empty($old['help']) && $preselect === $i)) ? ' selected' : '') . '>' . e($h) . '</option>';
    $field = function (string $n, string $label, string $inputHtml, bool $req = true) use ($p, $errs) {
        $err = $errs[$n] ?? '';
        return '<div class="field' . ($err ? ' invalid' : '') . '" data-f="' . $n . '"><label for="' . $p . '-' . $n . '">' . e($label)
            . ($req ? ' <span class="req" aria-hidden="true">*</span><span class="sr">(required)</span>' : ' <span class="opt">(optional)</span>') . '</label>'
            . $inputHtml . '<p class="err" id="' . $p . '-' . $n . '-e">' . e($err) . '</p></div>';
    };
    $h  = '<div class="form-card contact-form-card">';
    $h .= '<div class="form-success" role="status" tabindex="-1"><div class="big-tick">' . ic('check') . '</div><h3>Thank you — we’ve received your message.</h3><p>We’ll read it and reply personally within one business day. If it’s urgent, call us on <strong>' . e(site('phone')) . '</strong>.</p><button class="btn btn-outline" type="button" data-again>Send another message</button></div>';
    $h .= '<form class="form form-body" method="post" action="' . e(url('/forms/submit.php')) . '" data-ajax novalidate>';
    $h .= '<h2 class="form-title">' . e($heading) . '</h2><p class="form-sub">' . e($sub) . '</p>';
    $h .= '<div class="form-banner' . ($flash ? ' show' : '') . '" role="alert" data-banner>' . ($flash ? e($flash) : 'Something went wrong sending your message. Please try again, or call us on <strong>' . e(site('phone')) . '</strong>.') . '</div>';
    $h .= $field('name', 'Full Name', '<input class="input" id="' . $p . '-name" name="name" type="text" autocomplete="name" placeholder="Your full name" maxlength="100" value="' . e($old['name'] ?? '') . '" required aria-describedby="' . $p . '-name-e">');
    $h .= $field('email', 'Email Address', '<input class="input" id="' . $p . '-email" name="email" type="email" autocomplete="email" inputmode="email" placeholder="you@example.com" maxlength="150" value="' . e($old['email'] ?? '') . '" required aria-describedby="' . $p . '-email-e">');
    $h .= $field('help', 'What Do You Need Help With?', '<select class="select" id="' . $p . '-help" name="help" required aria-describedby="' . $p . '-help-e">' . $opts . '</select>');
    $h .= $field('project', 'Tell Us About Your Project', '<textarea class="textarea" id="' . $p . '-project" name="project" rows="4" maxlength="3000" placeholder="A few words about your book, your goal or your timeline…">' . e($old['project'] ?? '') . '</textarea>', false);
    // hidden protection fields
    $h .= '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '"><input type="hidden" name="ts" value="' . e(form_stamp()) . '"><input type="hidden" name="source" value="' . e($source) . '">';
    $h .= '<div class="hp" aria-hidden="true" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden"><label>Leave this field empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>';
    $h .= '<button class="btn btn-primary" type="submit"><span class="spinner" aria-hidden="true"></span><span data-label>' . e($btn) . '</span> ' . ic('arrow') . '</button>';
    $h .= '<p class="form-fine">Free advice. No obligation. Prefer to talk? Call ' . e(site('phone')) . '.</p></form></div>';
    return $h;
}
