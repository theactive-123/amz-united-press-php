<?php
/**
 * Section components for the ad landing pages in /lp/.
 * Each landing page sets $meta['lp'] = true (distraction-free header/footer, assets/css/lp.css only)
 * and is composed from the functions below, so every page shares one container, spacing scale and
 * set of section layouts. Copy is passed in as plain text; headings accept a single <em> for the
 * orange phrase.
 */

/* ---------- small pieces ---------- */

function lp_tel(): string { return preg_replace('/[^\d+]/', '', site('phone')); }

/** Heading block: eyebrow, h2 (may contain <em>), lead. $center for centred heads. */
function lp_head(string $eyebrow, string $h2Html, string $lead = '', bool $center = false, string $id = ''): string {
    return '<div class="head rv' . ($center ? ' c' : '') . '">' . ($eyebrow !== '' ? '<span class="eyebrow">' . e($eyebrow) . '</span>' : '')
         . '<h2 class="h2"' . ($id ? ' id="' . e($id) . '"' : '') . '>' . $h2Html . '</h2>' . ($lead !== '' ? '<p class="lead">' . rich($lead) . '</p>' : '') . '</div>';
}

/** Primary button (scrolls to the page form) + optional Live Chat + phone. */
function lp_ctas(string $label = 'Get a Free Quote', string $target = '#lp-form', bool $chat = true, bool $call = true): string {
    return '<div class="ctas"><a class="btn btn-primary" href="' . e($target) . '" data-lp-cta>' . e($label) . ' ' . ic('arrow') . '</a>'
         . ($chat ? '<button type="button" class="btn btn-line" data-chat>Live Chat</button>' : '')
         . ($call ? '<a class="call" href="tel:' . e(lp_tel()) . '" data-lp-call><span class="call-ic">' . ic('phone') . '</span><span><small>Call us now</small><b>' . e(site('phone')) . '</b></span></a>' : '') . '</div>';
}

function lp_ticks(array $items): string {
    $h = '<ul class="ticks">';
    foreach ($items as $x) $h .= '<li>' . ic('check') . e($x) . '</li>';
    return $h . '</ul>';
}

function lp_checks(array $items, bool $two = false): string {
    $h = '<ul class="checks' . ($two ? ' c2' : '') . '">';
    foreach ($items as $x) {
        $h .= is_array($x) ? '<li>' . ic('check') . '<span><b>' . e($x[0]) . '</b><span>' . rich($x[1]) . '</span></span></li>' : '<li>' . ic('check') . '<span>' . e($x) . '</span></li>';
    }
    return $h . '</ul>';
}

function lp_img(string $path): string { return url(implode('/', array_map('rawurlencode', explode('/', $path)))); }

function lp_author_photos(): array {
    $f = glob(ROOT . '/assets/img/client-images/*.{png,jpg,jpeg,webp}', GLOB_BRACE) ?: [];
    natsort($f);
    return array_values(array_map(fn($x) => asset('img/client-images/' . rawurlencode(basename($x))), $f));
}

/* ---------- offer + form ---------- */

function lp_offer_badge(): string {
    $o = site('offer');
    if (empty($o['on'])) return '';
    $note = !empty($o['ends']) ? 'Ends ' . $o['ends'] : ($o['note'] ?? '');
    return '<div class="offer" role="note" aria-label="' . e($o['big'] . ' — ' . $note) . '"><small>' . e($o['top']) . '</small><b>' . e($o['big']) . '</b><span>' . e($note) . '</span></div>';
}
/** " 50% off for a limited time." while the offer is on, otherwise empty. */
function lp_offer_suffix(): string {
    $o = site('offer');
    if (empty($o['on'])) return '';
    return ' ' . ucfirst(strtolower($o['big'])) . (!empty($o['ends']) ? ' until ' . $o['ends'] . '.' : ' for a limited time.');
}

/** The landing-page form (posts like every other form, tagged "landing"). */
function lp_form(string $id, string $heading, string $sub, int $help, string $btn = 'Get My Free Quote'): string {
    $badge = lp_offer_badge();
    return '<div class="fw' . ($badge ? ' has-offer' : '') . '" id="' . e($id) . '" data-steps>' . $badge . render_form($id, $heading, $sub, 'landing', $btn, $help) . '</div>';
}

/* ---------- sections ---------- */

/**
 * Hero: full-bleed background, contained 7/5 split (copy | form).
 * $o: eyebrow, h1 (html), lead, tags[], ticks[], cta, extra (html under the CTAs), form [title, sub, help, btn], orange (bool)
 */
function lp_hero(array $o): string {
    $orange = !empty($o['orange']);
    $bg = '';
    if (!$orange) {
        $w = data('work'); $bg = '<div class="hero-bg" aria-hidden="true"><div class="hero-bg-in">';
        for ($i = 0; $i < 24; $i++) $bg .= '<img src="' . e(lp_img($w[$i % count($w)]['image'])) . '" alt="" loading="' . ($i < 12 ? 'eager' : 'lazy') . '" decoding="async">';
        $bg .= '</div></div>';
    }
    $tags = '';
    if (!empty($o['tags'])) { $tags = '<ul class="hero-tags">'; foreach ($o['tags'] as $t) $tags .= '<li>' . e($t) . '</li>'; $tags .= '</ul>'; }
    $f = $o['form'];
    return '<section class="hero' . ($orange ? ' hero-orange' : '') . '" aria-labelledby="lp-h1">' . $bg . '<div class="w split split-75"><div class="hero-copy">'
         . $tags . '<span class="eyebrow">' . e($o['eyebrow']) . '</span><h1 class="h1" id="lp-h1">' . $o['h1'] . '</h1><p class="lead">' . rich($o['lead']) . '</p>'
         . lp_ctas($o['cta'] ?? 'Get a Free Quote') . (!empty($o['ticks']) ? lp_ticks($o['ticks']) : '') . ($o['extra'] ?? '')
         . '</div>' . lp_form('lp-form', $f[0], $f[1], $f[2], $f[3] ?? 'Get My Free Quote') . '</div></section>';
}

/** Hero extra: author faces + a short proof line. */
function lp_hero_faces(string $text = ''): string {
    $s = data('stats')[0];
    $text = $text ?: '<b>' . e($s[0] . $s[1]) . ' books published</b> for authors like these, under their own names.';
    $h = '<div class="hero-proof"><div class="faces">';
    foreach (array_slice(lp_author_photos(), 0, 5) as $src) $h .= '<img src="' . e($src) . '" alt="" width="44" height="44">';
    return $h . '</div><p>' . $text . '</p></div>';
}
/** Hero extra: a shelf of real covers. */
function lp_hero_shelf(array $idx = [2, 4, 6, 7, 8]): string {
    $w = data('work'); $h = '<div class="shelf" aria-hidden="true">';
    foreach ($idx as $i) if (isset($w[$i])) $h .= '<img src="' . e(lp_img($w[$i]['image'])) . '" alt="">';
    return $h . '</div>';
}

/** Trust bar: store logos (real retail platforms only). Full width, contained. */
function lp_trust(string $label = 'Published on the stores readers use'): string {
    $logos = ['amazon_kindle' => 'Amazon Kindle', 'ibooks' => 'Apple Books', 'barnes_noble' => 'Barnes & Noble', 'rakuten_kobo' => 'Rakuten Kobo', 'ingramspark' => 'IngramSpark', 'draft2digital' => 'Draft2Digital', 'lulu' => 'Lulu', 'smashwords' => 'Smashwords', 'scribd' => 'Scribd'];
    $h = '<section class="trust" aria-label="' . e($label) . '"><div class="w"><p>' . e($label) . '</p><ul>';
    foreach ($logos as $f => $n) $h .= '<li><img src="' . e(asset('img/publishable-logo/' . $f . '.png')) . '" alt="' . e($n) . '" loading="lazy" decoding="async"></li>';
    return $h . '</ul></div></section>';
}

/** Full-bleed author photo marquee. */
function lp_authors(string $title = 'Our authors, holding the books we helped them publish'): string {
    $row = '';
    foreach (lp_author_photos() as $src) $row .= '<img src="' . e($src) . '" alt="" loading="lazy" decoding="async" width="210" height="210">';
    return '<section class="authors" aria-label="' . e($title) . '"><div class="w"><h2 class="h2">' . e($title) . '</h2><a class="btn btn-line" href="#lp-form" data-lp-cta>Become one of them</a></div>'
         . '<div class="marquee"><div class="marquee-belt">' . $row . '</div><div class="marquee-belt" aria-hidden="true">' . $row . '</div></div></section>';
}

/** Full-bleed orange CTA band. */
function lp_band(string $heading, string $sub = '', string $target = '#lp-form'): string {
    return '<section class="band" aria-label="Get started"><div class="w"><div><h2>' . e($heading) . '</h2>' . ($sub ? '<p>' . e($sub) . '</p>' : '') . '</div>'
         . '<div class="ctas"><a class="btn btn-dark" href="' . e($target) . '" data-lp-cta>Get a Quote ' . ic('arrow') . '</a><button type="button" class="btn btn-line" data-chat>Live Chat</button>'
         . '<a class="call" href="tel:' . e(lp_tel()) . '" data-lp-call><span class="call-ic">' . ic('phone') . '</span><span><small>Call us now</small><b>' . e(site('phone')) . '</b></span></a></div></div></section>';
}

/** Problem / solution: heading left, two panels right. $bad/$good = [title, [items]] */
function lp_vs(string $bg, string $eyebrow, string $h2, string $lead, array $bad, array $good): string {
    $col = function ($c, $cls, $mark) {
        $h = '<div class="vs-col ' . $cls . '"><h3 class="h3">' . e($c[0]) . '</h3><ul>';
        foreach ($c[1] as $x) $h .= '<li><i aria-hidden="true">' . $mark . '</i><span>' . e($x) . '</span></li>';
        return $h . '</ul></div>';
    };
    return '<section class="sec ' . $bg . '"><div class="w">' . lp_head($eyebrow, $h2, $lead, true) . '<div class="vs rv">' . $col($bad, 'vs-bad', '✕') . $col($good, 'vs-good', '✓') . '</div></div></section>';
}

/**
 * Card grid. $items: [icon, title, text, (optional) link path, (optional) price, (optional) feat]
 * $cols 2/3/4.
 */
function lp_cards(array $items, int $cols = 3): string {
    $h = '<div class="grid g' . $cols . ' rv">';
    foreach ($items as $c) {
        $tag = !empty($c[3]) ? 'a' : 'div';
        $href = !empty($c[3]) ? ' href="' . e(url($c[3])) . '"' : '';
        $foot = !empty($c[3]) ? '<div class="card-foot"><span>' . (!empty($c[4]) ? 'From ' . e($c[4]) : 'Learn more') . '</span><b>Details ' . ic('arrow') . '</b></div>' : '';
        $h .= '<' . $tag . ' class="card row-m' . (!empty($c[5]) ? ' feat' : '') . '"' . $href . '><span class="card-ic">' . ic($c[0]) . '</span><h3 class="h3">' . e($c[1]) . '</h3><p>' . rich($c[2]) . '</p>' . $foot . '</' . $tag . '>';
    }
    return $h . '</div>';
}

/** Process steps. $steps: [title, text, (optional) time]. Horizontal when <= 5, otherwise vertical. */
function lp_steps(array $steps): string {
    $n = count($steps);
    if ($n <= 5) {
        $h = '<ol class="steps rv" style="--n:' . $n . '">';
        foreach ($steps as $s) $h .= '<li><h3 class="h3">' . e($s[0]) . '</h3><p>' . e($s[1]) . '</p>' . (!empty($s[2]) ? '<small>' . e($s[2]) . '</small>' : '') . '</li>';
        return $h . '</ol>';
    }
    $h = '<ol class="vsteps rv">';
    foreach ($steps as $s) $h .= '<li><div><h3 class="h3">' . e($s[0]) . '</h3><p>' . e($s[1]) . '</p></div></li>';
    return $h . '</ol>';
}

/** 3D books from the portfolio. */
function lp_books(int $n = 6, int $offset = 0): string {
    $h = '<div class="books rv" style="--n:' . $n . '">';
    foreach (array_slice(data('work'), $offset, $n) as $w) {
        $rev = $w['reviews'] ? ' · ' . number_format((int)$w['reviews']) . ((int)$w['reviews'] === 1 ? ' review' : ' reviews') : '';
        $h .= '<figure class="book"><div class="book-3d"><img src="' . e(lp_img($w['image'])) . '" alt="' . e($w['t'] . ' by ' . $w['by']) . '" loading="lazy" decoding="async"></div><figcaption><b>' . e($w['t']) . '</b><span>' . e($w['by'] . $rev) . '</span></figcaption></figure>';
    }
    return $h . '</div>';
}

function lp_stats(): string {
    $h = '<div class="stats rv">';
    foreach (data('stats') as $s) $h .= '<div class="stat"><b><span data-count="' . (int)$s[0] . '">' . (int)$s[0] . '</span>' . e($s[1]) . '</b><span>' . e($s[2]) . '</span></div>';
    return $h . '</div>';
}

function lp_quotes(): string {
    $h = '<div class="grid g3 rv">';
    foreach (data('testimonials') as $t) $h .= '<figure class="quote"><span class="quote-mark" aria-hidden="true">“</span><blockquote>' . e($t[2]) . '</blockquote><figcaption><i aria-hidden="true">' . e(mb_substr($t[0], 0, 1)) . '</i><span><b>' . e($t[0]) . '</b><span>' . e($t[1]) . '</span></span></figcaption></figure>';
    return $h . '</div>';
}

/** Our standing promises as icon rows (2 columns). */
function lp_promises(): string {
    $p = [
        ['lock', '100% ownership', 'You keep every right and every royalty. Your book is published under your name.'],
        ['shield', 'Signed NDA', 'Your ideas and manuscript stay confidential from the first call.'],
        ['tag', 'Written quote first', 'Scope, timeline and price in writing before any work begins.'],
        ['headset', 'Real people', 'One project manager, and a reply within one business day.'],
    ];
    $h = '<div class="grid g2 rv">';
    foreach ($p as $x) $h .= '<div class="promise"><span class="card-ic">' . ic($x[0]) . '</span><div><h3 class="h3">' . e($x[1]) . '</h3><p>' . e($x[2]) . '</p></div></div>';
    return $h . '</div>';
}

/** Comparison table. $cols: 3 headers (2 others + us). $rows: [label, a, b, us] — prefix a cell with ✓ or — for colour. */
function lp_table(array $cols, array $rows): string {
    $cell = function ($v, $us = false) {
        $cls = $us ? 'us' : '';
        if (str_starts_with($v, '✓')) $cls .= ' y'; elseif ($v === '—') $cls .= ' n';
        return '<td' . (trim($cls) ? ' class="' . trim($cls) . '"' : '') . '>' . e($v) . '</td>';
    };
    $h = '<div class="tbl-wrap rv"><table class="tbl"><thead><tr><th scope="col"><span class="sr">Compare</span></th><th scope="col">' . e($cols[0]) . '</th><th scope="col">' . e($cols[1]) . '</th><th scope="col" class="us">' . e($cols[2]) . '</th></tr></thead><tbody>';
    foreach ($rows as $r) $h .= '<tr><th scope="row">' . e($r[0]) . '</th>' . $cell($r[1]) . $cell($r[2]) . $cell($r[3], true) . '</tr>';
    return $h . '</tbody></table></div>';
}

/** FAQ: sticky heading + CTA left, accordion right. */
function lp_faq(string $bg, string $h2, array $items): string {
    return '<section class="sec ' . $bg . '" aria-labelledby="fq-h"><div class="w split split-57 top"><div class="sticky"><span class="eyebrow">FAQs</span><h2 class="h2" id="fq-h">' . $h2 . '</h2>'
         . '<p class="lead">Can’t see your question? Call <a href="tel:' . e(lp_tel()) . '" data-lp-call>' . e(site('phone')) . '</a> or send it with the form.</p><a class="btn btn-primary" href="#lp-form2" data-lp-cta>Ask us anything ' . ic('arrow') . '</a></div>'
         . '<div class="faq">' . faq_html($items, true) . '</div></div></section>';
}

/** Final CTA: dark, copy + second form. */
function lp_final(string $eyebrow, string $h2, string $lead, array $ticks, array $form): string {
    return '<section class="sec bg-ink" aria-labelledby="fn-h"><div class="w split split-75"><div><span class="eyebrow">' . e($eyebrow) . '</span><h2 class="h2" id="fn-h">' . $h2 . '</h2><p class="lead">' . rich($lead) . '</p>'
         . lp_ctas('Get a Free Quote', '#lp-form2') . lp_ticks($ticks) . '</div>' . lp_form('lp-form2', $form[0], $form[1], $form[2], $form[3] ?? 'Get My Free Quote') . '</div></section>';
}

/** Schema for a landing page: the service, its FAQs and a breadcrumb. */
function lp_schema(string $name, string $desc, string $path, array $faq, string $price = ''): array {
    $svc = ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $name, 'description' => $desc, 'url' => abs_url($path), 'areaServed' => 'Worldwide',
            'provider' => ['@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'telephone' => site('phone'), 'email' => site('email')]];
    if ($price !== '') $svc['offers'] = ['@type' => 'Offer', 'priceCurrency' => 'USD', 'price' => preg_replace('/[^\d.]/', '', $price), 'description' => 'Starting price. Written quote before work begins.'];
    return [$svc, faq_schema($faq), breadcrumb_schema([['Home', '/'], [$name, null]])];
}
