<?php
/**
 * Campaign landing pages (pre-launch, post-launch, ads publishing).
 * Dark editorial theme in the brand colours; loaded with lp.css + lx.css ($meta['lx']).
 * Header, footer, forms and the quote dialog come from the shared landing-page layout.
 */
require_once __DIR__ . '/lp.php';

/** Stroke icon set used only on these pages. */
function lx_i(string $n): string {
    $p = [
        'arrow'  => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'check'  => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'x'      => '<path d="M6 6l12 12M18 6 6 18"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
        'pen'    => '<path d="m4 20 1-4.2L16.2 4.6l3.2 3.2L8.2 19z"/><path d="m14 6.8 3.2 3.2"/>',
        'layout' => '<path d="M4 4h16v16H4zM4 9h16M9 9v11"/>',
        'send'   => '<path d="m3 11 18-8-8 18-2.2-7.8z"/>',
        'rocket' => '<path d="M5 15c-1.5 1.5-2 5-2 5s3.5-.5 5-2M9 13l2 2M14.5 4.5c3-1.5 5.5-1 5.5-1s.5 2.5-1 5.5L13 15l-4-4z"/><circle cx="15.5" cy="8.5" r="1.4"/>',
        'chart'  => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'trend'  => '<path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/>',
        'users'  => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.6 3.4-5.5 6.5-5.5s5.7 1.9 6.5 5.5"/><circle cx="17" cy="9" r="2.6"/><path d="M17 14.5c2.4.2 4 1.7 4.6 4.5"/>',
        'layers' => '<path d="m12 3 9 5-9 5-9-5z"/><path d="m3 13 9 5 9-5"/>',
        'map'    => '<path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2z"/><path d="M9 4v14M15 6v14"/>',
        'eye'    => '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'tag'    => '<path d="M3 12.5V3.5h9l9 9-9 9z"/><circle cx="7.5" cy="8" r="1.2"/>',
        'star'   => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9z"/>',
        'shield' => '<path d="M12 3 4 6v6c0 4.5 3.4 8 8 9 4.6-1 8-4.5 8-9V6z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
        'clock'  => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'phone'  => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
        'book'   => '<path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/>',
        'refresh'=> '<path d="M20 11a8 8 0 0 0-14.6-4.5L4 8"/><path d="M4 3v5h5"/><path d="M4 13a8 8 0 0 0 14.6 4.5L20 16"/><path d="M20 21v-5h-5"/>',
        'target' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
    ][$n] ?? '';
    return '<svg class="lx-ic" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

/** Mono kicker. */
function lx_kick(string $text, bool $center = false): string {
    return '<p class="lx-kick' . ($center ? ' c' : '') . '"><i aria-hidden="true"></i>' . e($text) . '</p>';
}

/** Primary CTA link to a form anchor. */
function lx_cta(string $label, string $target = '#lp-form', string $cls = ''): string {
    return '<a class="btn btn-primary lx-btn ' . e($cls) . '" href="' . e($target) . '" data-lp-cta>' . e($label) . lx_i('arrow') . '</a>';
}

/** Small row of real author photos with a line of proof. */
function lx_faces(string $text): string {
    $imgs = glob(__DIR__ . '/../assets/img/client-images/*.{png,jpg,jpeg,webp,avif}', GLOB_BRACE) ?: []; natsort($imgs);
    $h = '<div class="lx-faces"><span aria-hidden="true">';
    foreach (array_slice(array_values($imgs), 0, 5) as $f) $h .= '<img src="' . e(asset('img/client-images/' . rawurlencode(basename($f)))) . '" alt="" width="40" height="40" loading="lazy">';
    return $h . '</span><p>' . $text . '</p></div>';
}

/** Fanned stack of real covers, decorative. */
function lx_covers(array $idx, string $cls = ''): string {
    $w = data('work'); $h = '<div class="lx-covers ' . e($cls) . '" aria-hidden="true">';
    foreach ($idx as $k => $i) if (isset($w[$i])) $h .= '<span style="--k:' . $k . '"><img src="' . e(lp_img($w[$i]['image'])) . '" alt="" loading="lazy"></span>';
    return $h . '</div>';
}

/**
 * Case-study card drawn as an ads dashboard: headline, three metrics and a sparkline.
 * $c: tag, title, big, text, metrics [[value, label]...], points (0–100 heights)
 */
function lx_case(array $c): string {
    $pts = $c['points']; $n = count($pts) - 1; $line = ''; $area = 'M0 100 ';
    foreach ($pts as $i => $v) { $x = round($i * 300 / $n, 1); $y = 100 - $v; $line .= ($i ? 'L' : 'M') . $x . ' ' . $y . ' '; $area .= 'L' . $x . ' ' . $y . ' '; }
    $area .= 'L300 100Z';
    $m = '';
    foreach ($c['metrics'] as $x) $m .= '<li><b>' . e($x[0]) . '</b><span>' . e($x[1]) . '</span></li>';
    return '<article class="lx-case lx-rv"><div class="lx-case-chart" aria-hidden="true"><span class="lx-case-tag">' . e($c['tag']) . '</span>'
         . '<svg viewBox="0 0 300 100" preserveAspectRatio="none"><defs><linearGradient id="g' . crc32($c['title']) . '" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#F29102" stop-opacity=".45"/><stop offset="1" stop-color="#F29102" stop-opacity="0"/></linearGradient></defs>'
         . '<path d="' . $area . '" fill="url(#g' . crc32($c['title']) . ')"/><path class="lx-spark" d="' . trim($line) . '" fill="none" stroke="#F29102" stroke-width="2.4" vector-effect="non-scaling-stroke"/></svg></div>'
         . '<div class="lx-case-body"><h3>' . e($c['title']) . '</h3><p class="lx-case-big">' . e($c['big']) . '</p><p>' . e($c['text']) . '</p><ul class="lx-metrics">' . $m . '</ul></div></article>';
}

/** FAQ: kicker + heading left, accordion right. */
function lx_faq(string $h2Html, array $items, string $sub = ''): string {
    return '<section class="lx-sec lx-light lx-faqsec" aria-labelledby="lx-fq"><div class="w lx-split">'
         . '<div class="lx-sticky">' . lx_kick('Questions') . '<h2 class="lx-h2" id="lx-fq">' . $h2Html . '</h2>'
         . ($sub !== '' ? '<p class="lx-sub">' . $sub . '</p>' : '')
         . '<p class="lx-sub">Can’t see your question? Call <a href="tel:' . e(tel_href()) . '" data-lp-call>' . e(site('phone')) . '</a>.</p></div>'
         . '<div class="faq lx-faq">' . faq_html($items, true) . '</div></div></section>';
}

/** Final section: copy left, second form right. */
function lx_final(string $kick, string $h2Html, string $lead, array $ticks, array $form): string {
    $t = '';
    foreach ($ticks as $x) $t .= '<li>' . lx_i('check') . e($x) . '</li>';
    return '<section class="lx-sec lx-final" aria-labelledby="lx-fn"><span class="lx-glow" aria-hidden="true"></span><div class="w lx-hero-in">'
         . '<div>' . lx_kick($kick) . '<h2 class="lx-h2 xl" id="lx-fn">' . $h2Html . '</h2><p class="lx-lead">' . $lead . '</p><ul class="lx-ticks">' . $t . '</ul>'
         . '<a class="lx-tel" href="tel:' . e(tel_href()) . '" data-lp-call>' . lx_i('phone') . '<span><small>Prefer to talk?</small><b>' . e(site('phone')) . '</b></span></a></div>'
         . lp_form('lp-form2', $form[0], $form[1], $form[2], $form[3] ?? 'Get My Free Quote') . '</div></section>';
}
