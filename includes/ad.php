<?php
/**
 * Paid-ads landing pages: shared building blocks (styles in assets/css/ad.css, header/footer via $meta['ad']).
 * Images come from assets/img/lp (optimised WebP), showreels from assets/video.
 */

function ad_i(string $n): string {
    $p = [
        'check'  => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'x'      => '<path d="M7 7l10 10M17 7 7 17"/>',
        'arrow'  => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'phone'  => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
        'pen'    => '<path d="m4 20 1-4.2L16.2 4.6l3.2 3.2L8.2 19z"/><path d="m14 6.8 3.2 3.2"/>',
        'layout' => '<path d="M4 4h16v16H4zM4 9h16M9 9v11"/>',
        'book'   => '<path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/>',
        'send'   => '<path d="m3 11 18-8-8 18-2.2-7.8z"/>',
        'tag'    => '<path d="M3 12.5V3.5h9l9 9-9 9z"/><circle cx="7.5" cy="8" r="1.2"/>',
        'chart'  => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'trend'  => '<path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
        'eye'    => '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'target' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
        'users'  => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.6 3.4-5.5 6.5-5.5s5.7 1.9 6.5 5.5"/><circle cx="17" cy="9" r="2.6"/><path d="M17 14.5c2.4.2 4 1.7 4.6 4.5"/>',
        'layers' => '<path d="m12 3 9 5-9 5-9-5z"/><path d="m3 13 9 5 9-5"/>',
        'shield' => '<path d="M12 3 4 6v6c0 4.5 3.4 8 8 9 4.6-1 8-4.5 8-9V6z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
        'clock'  => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'star'   => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3 6.4 20.2l1.1-6.2L3 9.6l6.2-.9z"/>',
        'alert'  => '<path d="M12 3 2 20h20z"/><path d="M12 10v4M12 17h.01"/>',
        'refresh'=> '<path d="M20 11a8 8 0 0 0-14.6-4.5L4 8"/><path d="M4 3v5h5"/><path d="M4 13a8 8 0 0 0 14.6 4.5L20 16"/><path d="M20 21v-5h-5"/>',
        'doc'    => '<path d="M6 3h9l4 4v14H6z"/><path d="M9 11h7M9 15h7M9 7h3"/>',
        'map'    => '<path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2z"/><path d="M9 4v14M15 6v14"/>',
        'pause'  => '<path d="M8 5v14M16 5v14"/>',
        'play'   => '<path d="M7 4.5v15l12-7.5z"/>',
        'globe'  => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
        'chat'   => '<path d="M4 5h16v11H9l-5 4z"/>',
        'lock'   => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
    ][$n] ?? '';
    return '<svg class="ad-ic" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

function ad_src(string $name): string { return asset('img/lp/' . $name); }
function ad_img(string $name, string $alt = '', bool $eager = false): string {
    return '<img src="' . e(ad_src($name . '.webp')) . '" alt="' . e($alt) . '"' . ($eager ? ' fetchpriority="high"' : ' loading="lazy"') . ' decoding="async">';
}
/** Portfolio book → its optimised cover. */
function ad_cover(array $w): string {
    $n = strtolower(pathinfo($w['image'], PATHINFO_FILENAME));
    $n = str_replace([' ', "'", ','], ['-', '', ''], $n);
    return ad_src('cover-' . $n . '.webp');
}
function ad_authors_list(): array {
    $f = glob(__DIR__ . '/../assets/img/lp/author-*.webp') ?: []; natsort($f);
    return array_map(fn($x) => basename($x, '.webp'), array_values($f));
}

function ad_kick(string $t, bool $c = false): string { return '<p class="ad-kick' . ($c ? ' c' : '') . '">' . e($t) . '</p>'; }
function ad_cta(string $label, string $note = '', string $href = '#book'): string {
    return '<div class="ad-ctarow"><a class="ad-btn" href="' . e($href) . '" data-lp-cta>' . e($label) . ad_i('arrow') . '</a>'
         . '<a class="ad-btn ghost" href="tel:' . e(tel_href()) . '" data-lp-call>' . ad_i('phone') . e(site('phone')) . '</a></div>'
         . ($note ? '<span class="ad-btn-note">' . e($note) . '</span>' : '');
}

function ad_proof(string $html): string {
    $h = '<div class="ad-proof"><span aria-hidden="true">';
    foreach (array_slice(ad_authors_list(), 0, 5) as $a) $h .= '<img src="' . e(ad_src($a . '.webp')) . '" alt="" width="44" height="44">';
    return $h . '</span><p>' . $html . '</p></div>';
}

/** Faded real covers drifting at the hero edges. */
function ad_float_books(): string {
    $w = data('work');
    $pos = [['3%', '8%', -8], ['88%', '6%', 9], ['92%', '58%', -6], ['-2%', '62%', 7]];
    $h = '<div class="ad-float-books" aria-hidden="true">';
    foreach ($pos as $i => $p) $h .= '<img src="' . e(ad_cover($w[($i * 3 + 1) % count($w)])) . '" alt="" style="left:' . $p[0] . ';top:' . $p[1] . ';transform:rotate(' . $p[2] . 'deg);--r:' . $p[2] . 'deg;animation-delay:-' . ($i * 2) . 's">';
    return $h . '</div>';
}

/** Lead form card (same fields and endpoint as every site form). */
function ad_form(string $id, string $title, string $sub, int $help, string $btn = 'Get My Free Quote', string $badge = 'A real person replies within 1 business day'): string {
    return '<div class="ad-form ad-rv" id="' . e($id === 'lp-form' ? 'book' : $id . '-wrap') . '"><p class="sr">' . e($badge) . '</p>'
         . str_replace('<form class="form form-body"', '<p class="ad-form-badge">' . e($badge) . '</p><form class="form form-body"', render_form($id, $title, $sub, 'landing', $btn, $help))
         . '<div class="ad-form-trust"><span>' . ad_i('lock') . 'Your details stay private</span><span>' . ad_i('check') . 'No obligation</span><span>' . ad_i('shield') . 'Signed NDA on request</span></div></div>';
}

function ad_logos(string $label): string {
    $l = ['amazon_kindle' => 'Amazon Kindle', 'ibooks' => 'Apple Books', 'barnes_noble' => 'Barnes & Noble', 'rakuten_kobo' => 'Rakuten Kobo', 'ingramspark' => 'IngramSpark', 'draft2digital' => 'Draft2Digital', 'lulu' => 'Lulu', 'scribd' => 'Scribd'];
    $h = '<section class="ad-logos" aria-label="' . e($label) . '"><div class="ad-w"><p>' . e($label) . '</p><ul>';
    foreach ($l as $f => $n) $h .= '<li><img src="' . e(asset('img/publishable-logo/' . $f . '.png')) . '" alt="' . e($n) . '" loading="lazy"></li>';
    return $h . '</ul></div></section>';
}

/** Autoplaying muted showreel with a pause button. */
function ad_video(string $name, string $tag, string $label): string {
    return '<div class="ad-video ad-rv" data-ad-video><video autoplay muted loop playsinline preload="metadata" poster="' . e(ad_src('poster-' . $name . '.jpg')) . '" aria-label="' . e($label) . '">'
         . '<source src="' . e(asset('video/' . $name . '.mp4')) . '" type="video/mp4"></video>'
         . '<span class="ad-video-tag">' . e($tag) . '</span><button type="button" class="ad-video-btn" aria-label="Pause video">' . ad_i('pause') . '</button></div>';
}

/** Image cards. $items = [[image, kicker, title, text], ...] */
function ad_cards(array $items): string {
    $h = '<div class="ad-cards">';
    foreach ($items as $i => $c) $h .= '<article class="ad-card ad-rv" style="--d:' . ($i % 3) . '"><figure>' . ad_img($c[0], '') . '</figure><div class="ad-card-b"><small>' . e($c[1]) . '</small><h3>' . e($c[2]) . '</h3><p>' . e($c[3]) . '</p></div></article>';
    return $h . '</div>';
}

/** Zig-zag image/text steps. $items = [[image, chipIcon, chipText, title, text, ticks[]], ...] */
function ad_zz(array $items): string {
    $h = '<div class="ad-zz">';
    foreach ($items as $i => $s) {
        $t = ''; foreach ($s[5] ?? [] as $x) $t .= '<li>' . ad_i('check') . '<span>' . e($x) . '</span></li>';
        $h .= '<div class="ad-zz-row"><div class="ad-zz-img ad-rv">' . ad_img($s[0], '') . '<span class="chip">' . ad_i($s[1]) . e($s[2]) . '</span></div>'
            . '<div class="ad-zz-t ad-rv" style="--d:1"><span class="ad-zz-n">0' . ($i + 1) . '</span><h3 class="ad-h3">' . e($s[3]) . '</h3><p>' . e($s[4]) . '</p>' . ($t ? '<ul class="ad-ticks">' . $t . '</ul>' : '') . '</div></div>';
    }
    return $h . '</div>';
}

/** The three publishing packages from data.php. */
function ad_plans(): string {
    $h = '<div class="ad-plans">';
    foreach (data('prices') as $i => $p) {
        $h .= '<article class="ad-plan ad-rv' . ($p['f'] ? ' hot' : '') . '" style="--d:' . $i . '">' . ($p['f'] ? '<span class="tag">Most popular</span>' : '')
            . '<h3>' . e($p['t']) . '</h3><p class="price">' . e($p['p']) . '</p><p class="once">One-time fee · You keep 100% of royalties</p><ul>';
        foreach ($p['l'] as $x) $h .= '<li>' . ad_i('check') . '<span>' . e($x) . '</span></li>';
        $h .= '</ul><a class="ad-btn" href="#book" data-lp-cta data-pkg="' . e($p['t']) . '">Get Started</a></article>';
    }
    return $h . '</div>';
}

/** Real published books with their real Amazon review counts. */
function ad_shelf(int $n = 6, int $offset = 0): string {
    $h = '<div class="ad-shelf">';
    foreach (array_slice(data('work'), $offset, $n) as $i => $w) {
        $rev = $w['reviews'] ? number_format((int)$w['reviews']) . ((int)$w['reviews'] === 1 ? ' Amazon review' : ' Amazon reviews') : 'New release';
        $h .= '<figure class="ad-book ad-rv" style="--d:' . ($i % 6) . '"><div class="b3d"><img src="' . e(ad_cover($w)) . '" alt="' . e($w['t'] . ' by ' . $w['by']) . '" loading="lazy"></div><figcaption><b>' . e($w['t']) . '</b><span>' . e($w['by']) . ' · ' . e($rev) . '</span></figcaption></figure>';
    }
    return $h . '</div>';
}

function ad_authors(int $n = 10): string {
    $h = '<div class="ad-authors">';
    foreach (array_slice(ad_authors_list(), 0, $n) as $i => $a) $h .= '<figure class="ad-rv" style="--d:' . ($i % 5) . '"><img src="' . e(ad_src($a . '.webp')) . '" alt="An AMZ United Press author holding their published book" loading="lazy"></figure>';
    return $h . '</div>';
}

/** Ads-dashboard illustration with KPIs and a line chart. */
function ad_dash(array $k, array $a, array $b): string {
    $line = function (array $pts) { $n = count($pts) - 1; $d = ''; foreach ($pts as $i => $v) $d .= ($i ? 'L' : 'M') . round($i * 400 / $n, 1) . ' ' . (106 - $v) . ' '; return trim($d); };
    $cols = ['#4F6BED', '#C2187A', '#1A9E8F', '#F08A3E']; $kh = '';
    foreach ($k as $i => $x) $kh .= '<div><b style="--c:' . $cols[$i] . '">' . e($x[0]) . '</b>' . e($x[1]) . '</div>';
    return '<div class="ad-dash" aria-hidden="true"><div class="ad-dash-top">Sponsored ads · Performance <span>Lifetime</span></div><div class="ad-dash-k">' . $kh . '</div>'
         . '<svg viewBox="0 0 400 110" preserveAspectRatio="none"><g stroke="#eee"><path d="M0 27h400M0 54h400M0 81h400"/></g>'
         . '<path d="' . $line($a) . '" fill="none" stroke="#F08A3E" stroke-width="1.8"/><path d="' . $line($b) . '" fill="none" stroke="#4F6BED" stroke-width="1.8"/>'
         . '<path d="' . $line(array_map(fn($v) => max(2, $v - 14), $b)) . '" fill="none" stroke="#1A9E8F" stroke-width="1.4"/></svg></div>';
}
function ad_case(array $c): string {
    $m = ''; foreach ($c['tiles'] as $t) $m .= '<div><b>' . e($t[0]) . '</b><span>' . e($t[1]) . '</span></div>';
    return '<article class="ad-case ad-rv"><div class="ad-case-top"><span class="ad-case-tag">' . e($c['tag']) . '</span>' . ad_dash($c['kpis'], $c['a'], $c['b']) . '</div>'
         . '<div class="ad-case-b"><h3>' . e($c['title']) . '</h3><p class="big">' . e($c['big']) . '</p><p>' . e($c['text']) . '</p><div class="ad-case-m">' . $m . '</div></div></article>';
}

/** "What happens next" three steps on dark, with a promise box. */
function ad_next(string $h2, string $lead, array $steps, string $promise, string $cta): string {
    $s = ''; foreach ($steps as $i => $x) $s .= '<li class="ad-rv" style="--d:' . $i . '"><span class="n">' . ($i + 1) . '</span><h3>' . e($x[0]) . '</h3><p>' . e($x[1]) . '</p></li>';
    return '<section class="ad-sec dark" aria-labelledby="nx-h"><div class="ad-w ad-c"><div class="ad-head ad-c">' . ad_kick('Ready to get started?', true) . '<h2 class="ad-h2" id="nx-h">' . $h2 . '</h2><p class="ad-lead">' . e($lead) . '</p></div>'
         . '<ol class="ad-next">' . $s . '</ol><p class="ad-promise">' . $promise . '</p>' . ad_cta($cta, 'No obligation. Honest advice.') . '</div></section>';
}

function ad_faq(string $h2, array $items): string {
    return '<section class="ad-sec white" aria-labelledby="fq-h"><div class="ad-w ad-faq-in"><div class="ad-faq-side">' . ad_kick('Questions')
         . '<h2 class="ad-h2" id="fq-h">' . $h2 . '</h2><p>Can’t see your question? Talk to a real person.</p><a class="tel" href="tel:' . e(tel_href()) . '" data-lp-call>' . e(site('phone')) . '</a></div>'
         . '<div class="faq ad-faq">' . faq_html($items, true) . '</div></div></section>';
}

/** Final section: copy left, second form right. */
function ad_final(string $kick, string $h2, string $lead, array $ticks, array $form): string {
    $t = ''; foreach ($ticks as $x) $t .= '<li>' . ad_i('check') . '<span>' . e($x) . '</span></li>';
    return '<section class="ad-hero ad-final" aria-labelledby="fn-h">' . ad_float_books() . '<div class="ad-w ad-hero-in"><div>' . ad_kick($kick) . '<h2 class="ad-h1" id="fn-h">' . $h2 . '</h2><p class="ad-lead">' . e($lead) . '</p>'
         . '<ul class="ad-hero-ticks">' . $t . '</ul>' . ad_proof('Join <b>' . e(data('stats')[1][0] . data('stats')[1][1]) . ' authors</b> who published with AMZ United Press.') . '</div>'
         . ad_form('lp-form2', $form[0], $form[1], $form[2], $form[3] ?? 'Get My Free Quote') . '</div></section>';
}

function ad_dock(string $label): string {
    return '<div class="ad-dock"><a href="tel:' . e(tel_href()) . '" data-lp-call>' . ad_i('phone') . 'Call us</a><a href="#book" data-lp-cta>' . e($label) . '</a></div>';
}

/** Side-by-side comparison. $a/$b = [kicker, title, [[text, yes(bool)], ...]] — $b is "us". */
function ad_compare(array $a, array $b): string {
    $col = function (array $c, bool $us) {
        $h = '<div class="' . ($us ? 'us ' : '') . 'ad-rv"' . ($us ? ' style="--d:1"' : '') . '><h3><small>' . e($c[0]) . '</small>' . e($c[1]) . '</h3><ul>';
        foreach ($c[2] as $x) $h .= '<li class="' . ($x[1] ? 'y' : 'n') . '">' . ad_i($x[1] ? 'check' : 'x') . '<span>' . e($x[0]) . '</span></li>';
        return $h . '</ul></div>';
    };
    return '<div class="ad-compare">' . $col($a, false) . '<span class="ad-vs" aria-hidden="true">VS</span>' . $col($b, true) . '</div>';
}

/** Stat cards beside a video. $s = [[kicker, big, text], ...] */
function ad_vstats(array $s): string {
    $h = '<div class="ad-vstats">';
    foreach ($s as $i => $x) $h .= '<div class="ad-vstat ad-rv" style="--d:' . $i . '"><small>' . e($x[0]) . '</small><b>' . e($x[1]) . '</b><p>' . e($x[2]) . '</p></div>';
    return $h . '</div>';
}
