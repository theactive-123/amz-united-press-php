<?php
/**
 * KDP campaign landing pages (pre-launch, post-launch, book publishing).
 * Layout follows the campaign reference design; styles in assets/css/kx.css,
 * header/footer via $meta['kx'] in includes/header.php and includes/footer.php.
 */

function kx_i(string $n): string {
    $p = [
        'check'  => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'x'      => '<path d="M7 7l10 10M17 7 7 17"/>',
        'arrow'  => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'phone'  => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
        'chart'  => '<path d="M4 20h16"/><path d="M6 16v-3M10 16V9M14 16v-5M18 16V6"/><path d="m6 9 4-3 4 3 4-5"/>',
        'doc'    => '<path d="M6 3h9l4 4v14H6z"/><path d="M9 11h7M9 15h7M9 7h3"/><path d="m14 17 2 2 3-3"/>',
        'opt'    => '<rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="9" cy="12" r="2"/><circle cx="15" cy="12" r="2"/><path d="M11 12h2"/>',
        'map'    => '<path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2z"/><path d="M9 4v14M15 6v14"/>',
        'cal'    => '<rect x="4" y="5" width="16" height="15" rx="2"/><path d="M4 10h16M9 3v4M15 3v4"/><path d="m10 13 4 4M14 13l-4 4"/>',
        'box'    => '<rect x="4" y="4" width="16" height="16" rx="2"/><path d="m8 12 3 3 5-6"/>',
        'users'  => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.6 3.4-5.5 6.5-5.5s5.7 1.9 6.5 5.5"/><circle cx="17" cy="9" r="2.6"/><path d="M17 14.5c2.4.2 4 1.7 4.6 4.5"/>',
        'book'   => '<path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/>',
        'target' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
        'trend'  => '<path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/>',
        'layers' => '<path d="m12 3 9 5-9 5-9-5z"/><path d="m3 13 9 5 9-5"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
        'star'   => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9z"/>',
        'refresh'=> '<path d="M20 11a8 8 0 0 0-14.6-4.5L4 8"/><path d="M4 3v5h5"/><path d="M4 13a8 8 0 0 0 14.6 4.5L20 16"/><path d="M20 21v-5h-5"/>',
    ][$n] ?? '';
    return '<svg class="kx-ic" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

/** Twinkling sparkles and crosses scattered over the hero. */
function kx_stars(): string {
    $star = '<svg viewBox="0 0 24 24"><path d="M12 0c.6 6.6 5.4 11.4 12 12-6.6.6-11.4 5.4-12 12-.6-6.6-5.4-11.4-12-12C6.6 11.4 11.4 6.6 12 0z"/></svg>';
    $x = '<svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5 5 19" stroke="currentColor" stroke-width="1.6" fill="none"/></svg>';
    $pts = [['86%', '26%', 14, '#fff', $x], ['89.5%', '28%', 12, '#fff', $x], ['92.5%', '30.5%', 22, '#FFB43B', $star], ['86%', '35%', 18, '#fff', $star], ['92%', '35%', 12, '#fff', $x],
            ['8.5%', '45%', 12, '#fff', $x], ['11.5%', '47%', 12, '#fff', $x], ['14.5%', '49.5%', 20, '#FFB43B', $star], ['7.5%', '54%', 16, '#fff', $star], ['13.8%', '53.5%', 11, '#fff', $x]];
    $h = '<div class="kx-stars" aria-hidden="true">';
    foreach ($pts as $i => $p) $h .= '<i style="left:' . $p[0] . ';top:' . $p[1] . ';--s:' . $p[2] . 'px;--c:' . $p[3] . ';--dl:' . ($i * .37) . 's">' . $p[4] . '</i>';
    return $h . '</div>';
}

/** Lime wireframe ring in the lower-left corner of the hero. */
function kx_ring(): string {
    $h = '<svg class="kx-ring" viewBox="0 0 400 400" aria-hidden="true" fill="none" stroke="#F29102" stroke-width="1.6" opacity=".9">';
    for ($i = 0; $i < 14; $i++) { $rx = 70 + $i * 9; $h .= '<ellipse cx="200" cy="200" rx="' . $rx . '" ry="' . (190 - $i * 2) . '" transform="rotate(' . (28 + $i * 2) . ' 200 200)"/>'; }
    for ($i = 0; $i < 12; $i++) $h .= '<path d="M' . (60 + $i * 24) . ' 30 Q 200 ' . (200 + ($i - 6) * 10) . ' ' . (60 + $i * 24) . ' 370" opacity=".55"/>';
    return $h . '</svg>';
}

/** Ads-dashboard panel with four KPIs and a three-line chart (decorative). Returns an open .kx-dash div. */
function kx_dash(array $k, array $a, array $b): string {
    $line = function (array $pts) { $n = count($pts) - 1; $d = ''; foreach ($pts as $i => $v) $d .= ($i ? 'L' : 'M') . round($i * 400 / $n, 1) . ' ' . (90 - $v) . ' '; return trim($d); };
    $cols = ['#4F6BED', '#C2187A', '#1A9E8F', '#F08A3E']; $kh = '';
    foreach ($k as $i => $x) $kh .= '<div><b style="--c:' . $cols[$i] . '">' . e($x[0]) . '</b>' . e($x[1]) . '</div>';
    return '<div class="kx-dash" aria-hidden="true"><div class="kx-dash-top">Performance <span>Lifetime</span></div><div class="kx-dash-k">' . $kh . '</div>'
         . '<svg viewBox="0 0 400 92" preserveAspectRatio="none"><g stroke="#eee"><path d="M0 22h400M0 46h400M0 70h400"/></g>'
         . '<path d="' . $line($a) . '" fill="none" stroke="#F08A3E" stroke-width="1.6"/><path d="' . $line($b) . '" fill="none" stroke="#4F6BED" stroke-width="1.6"/>'
         . '<path d="' . $line(array_map(fn($v) => max(2, $v - 12), $b)) . '" fill="none" stroke="#1A9E8F" stroke-width="1.2"/></svg>';
}

/** Case-study card. $style 'flat' (pre-launch) or 'laptop' (post-launch). */
function kx_case(array $c, string $style = 'flat'): string {
    $pill = '<span class="kx-case-pill">' . e($c['pill']) . '</span>';
    $vis = $style === 'laptop'
        ? '<div class="kx-laptop" aria-hidden="true"><div class="kx-laptop-scr">' . kx_dash($c['kpis'], $c['a'], $c['b']) . '</div></div><div class="kx-laptop-base"></div></div><div class="kx-pillrow">' . $pill . '</div>'
        : kx_dash($c['kpis'], $c['a'], $c['b']) . $pill . '</div>';
    $m = '';
    if (!empty($c['tiles'])) { $m = '<div class="kx-case-m">'; foreach ($c['tiles'] as $t) $m .= '<div><b>' . e($t[0]) . '</b><span>' . e($t[1]) . '</span></div>'; $m .= '</div>'; }
    $ps = ''; foreach ($c['p'] as $p) $ps .= '<p>' . e($p) . '</p>';
    return '<article class="kx-case kx-rv">' . $vis . '<h3>' . e($c['title']) . '</h3><p class="big">' . e($c['big']) . '</p>' . $ps . $m . '</article>';
}

/** Booking block: heading, short promise list and the lead form (in place of a calendar embed). */
function kx_book(string $h2, string $sub, string $formTitle, string $formSub, int $help, string $btn, array $ticks): string {
    $t = ''; foreach ($ticks as $x) $t .= '<li>' . kx_i('check') . '<span>' . e($x) . '</span></li>';
    return '<section class="kx-sec n2 kx-book" id="book" aria-labelledby="bk-h"><div class="kx-w"><h2 id="bk-h">' . $h2 . '</h2><p class="kx-sub">' . e($sub) . '</p>'
         . '<div class="kx-book-grid"><div class="kx-book-side kx-rv"><h3>What happens next</h3><ul>' . $t . '</ul>'
         . '<a class="kx-book-tel" href="tel:' . e(tel_href()) . '" data-lp-call>' . kx_i('phone') . e(site('phone')) . '</a></div>'
         . '<div class="kx-form kx-rv" style="--d:1">' . render_form('lp-form', $formTitle, $formSub, 'landing', $btn, $help) . '</div></div></div></section>';
}

/** Bordered FAQ box. $left = icon-left full-width variant. */
function kx_faq(array $items, bool $left = false): string {
    return '<div class="faq kx-faq' . ($left ? ' left' : '') . '">' . faq_html($items, true) . '</div>';
}

/** Marquee of real author photos (authors holding their books). */
function kx_authors(): string {
    $imgs = glob(__DIR__ . '/../assets/img/client-images/*.{png,jpg,jpeg,webp,avif}', GLOB_BRACE) ?: []; natsort($imgs);
    $row = '';
    foreach ($imgs as $f) $row .= '<figure><img src="' . e(asset('img/client-images/' . rawurlencode(basename($f)))) . '" alt="" loading="lazy" decoding="async"></figure>';
    return '<div class="kx-marq" aria-hidden="true"><div class="kx-marq-t">' . $row . $row . '</div></div>';
}

/** Store logos (real retail platforms). */
function kx_logos(): string {
    $l = ['amazon_kindle' => 'Amazon Kindle', 'ibooks' => 'Apple Books', 'barnes_noble' => 'Barnes & Noble', 'rakuten_kobo' => 'Rakuten Kobo', 'ingramspark' => 'IngramSpark', 'draft2digital' => 'Draft2Digital', 'lulu' => 'Lulu'];
    $h = '<div class="kx-logos">';
    foreach ($l as $f => $n) $h .= '<img src="' . e(asset('img/publishable-logo/' . $f . '.png')) . '" alt="' . e($n) . '" loading="lazy">';
    return $h . '</div>';
}

/** Mobile sticky CTA. */
function kx_dock(string $label = 'Book now'): string {
    return '<div class="kx-dock"><a href="tel:' . e(tel_href()) . '" data-lp-call>' . kx_i('phone') . 'Call us</a><a href="#book" data-lp-cta>' . e($label) . '</a></div>';
}

/** Hero image frame (in place of the reference video). */
function kx_media(string $img, string $cap = '', string $badge = ''): string {
    return '<div class="kx-media kx-rv"><div class="kx-media-in"><img src="' . e(url('/assets/img/' . implode('/', array_map('rawurlencode', explode('/', $img))))) . '" alt="" fetchpriority="high">'
         . ($badge ? '<span class="kx-media-badge">' . e($badge) . '</span>' : '') . ($cap ? '<span class="kx-media-cap">' . e($cap) . '</span>' : '') . '</div></div>';
}

/** Row of real author photos with a proof line. */
function kx_faces(string $html): string {
    $imgs = glob(__DIR__ . '/../assets/img/client-images/*.{png,jpg,jpeg,webp,avif}', GLOB_BRACE) ?: []; natsort($imgs);
    $h = '<div class="kx-faces"><span aria-hidden="true">';
    foreach (array_slice(array_values($imgs), 0, 5) as $f) $h .= '<img src="' . e(asset('img/client-images/' . rawurlencode(basename($f)))) . '" alt="" width="40" height="40" loading="lazy">';
    return $h . '</span><p>' . $html . '</p></div>';
}

/** Numbered rule rows (two columns). $items = [[title, text], ...] */
function kx_rows(array $items): string {
    $h = '<ol class="kx-rows">';
    foreach ($items as $i => $s) $h .= '<li class="kx-rv" style="--d:' . ($i % 2) . '"><span class="n">0' . ($i + 1) . '</span><div><small>Step 0' . ($i + 1) . '</small><h3>' . e($s[0]) . '</h3><p>' . e($s[1]) . '</p></div></li>';
    return $h . '</ol>';
}

/** Bento cards. $items = [[icon, title, text], ...]; the first card is the large one. */
function kx_bento(array $items): string {
    $h = '<div class="kx-bento n' . count($items) . '">';
    foreach ($items as $i => $v) $h .= '<article class="kx-rv' . ($i === 0 ? ' big' : '') . '" style="--d:' . ($i % 3) . '"><span class="num" aria-hidden="true">0' . ($i + 1) . '</span><span class="ib">' . kx_i($v[0]) . '</span><h3>' . e($v[1]) . '</h3><p>' . e($v[2]) . '</p></article>';
    return $h . '</div>';
}

/** Two-column FAQ section: heading and contact on the left, accordion on the right. */
function kx_faqsec(string $h2Html, array $items, string $bg = '#0B0B0A', bool $left = false): string {
    return '<section class="kx-sec" style="background:' . e($bg) . '" aria-labelledby="fq-h"><div class="kx-w kx-faqwrap"><div class="side">'
         . '<p class="kx-kick">Questions</p><h2 class="kx-h2" id="fq-h">' . $h2Html . '</h2>'
         . '<p>Can’t see your question? Talk to a real person.</p><a class="tel" href="tel:' . e(tel_href()) . '" data-lp-call>' . e(site('phone')) . '</a></div>'
         . kx_faq($items, $left) . '</div></section>';
}
