<?php
/**
 * AMZ United Press — settings.
 *
 * 1. Fill in the SMTP details under 'mail' so the contact and quote forms can send email.
 * 2. Change 'secret' to any long random text.
 * 3. This file is protected by .htaccess (it cannot be opened from a browser).
 *    Never upload real passwords to a public repository.
 */
return [

    /* ---------- Website address ----------
     * site_url:  leave '' to detect automatically. Or set it, for example 'https://www.amzunitedpress.com'
     *            (no trailing slash). It is used in canonical links, the sitemap and social previews.
     * base_path: null detects the folder from the server document root; '' forces the domain root.
     *            If it sits in a sub-folder (e.g. https://example.com/press), set '/press'. */
    'site_url'  => '',
    'base_path' => null,

    /* ---------- Email (SMTP) ----------
     * driver:     'smtp'  = send through your mail server (recommended)
     *             'mail'  = use the server's built-in PHP mail() function (simple, less reliable)
     * encryption: 'tls' (port 587, STARTTLS), 'ssl' (port 465) or '' (none, port 25)
     * to_email:   where new form messages are delivered
     * from_email: should be an address on your own domain (helps avoid the spam folder) */
    'mail' => [
        'enabled'    => true,
        'driver'     => 'smtp',
        'host'       => 'smtp.hostinger.com',        // PLACEHOLDER: your SMTP host
        'port'       => 465,
        'encryption' => 'ssl',
        'username'   => 'no-reply@example.com',    // PLACEHOLDER
        'password'   => 'Abbas1234',               // PLACEHOLDER
        'from_email' => 'no-reply@amzunitedpress.com',
        'from_name'  => 'AMZ United Press',
        'to_email'   => 'hello@amzunitedpress.com',
        'to_name'    => 'AMZ United Press',
        'auto_reply' => true,                      // send the visitor a short "we got your message" email
        'debug'      => false,                     // true = write SMTP details into storage/mail-error.log
    ],

    /* ---------- Form protection ---------- */
    'security' => [
        'secret'             => 'change-this-to-a-long-random-text',
        'rate_limit_per_hour' => 5,   // max messages from one visitor (IP address) per hour
        'min_seconds'        => 3,    // a real person needs a few seconds to fill the form
        'log_submissions'    => true, // keep a copy of every message in storage/submissions.log
    ],

    /* The API key is server-only: environment variable or ignored config.local.php. */
    'crm' => [
        'base_url' => getenv('CRM_BASE_URL') ?: 'https://crm.theactivesolutions.com',
        'api_key' => getenv('CRM_SITE_API_KEY') ?: 'cd4bc6eda591f983c7df6e76d2568fa9e20bc043536acf91aad4a75407e34451',
    ],

    'timezone' => 'America/Chicago',

    /* ---------- Optional: Google Analytics 4 ----------
     * Paste your measurement ID (like G-XXXXXXXXXX) to turn it on. Leave '' to keep tracking off.
     * If you turn it on, mention it in your Privacy Policy. */
    'ga4_id' => 'G-R43TW80BWG',
];
