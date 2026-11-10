<?php
/**
 * Ad landing pages v2 ("adx"): dark, centred, video-first sections. Styles in assets/css/adx.css.
 * Builds on includes/ad.php (icons, video, forms, dashboards, covers).
 */

function x_cta(string $label, string $note = '', string $href = '#book'): string {
    return '<div class="x-cta"><a class="x-btn" href="' . e($href) . '" data-lp-cta>' . e($label) . ad_i('arrow') . '</a>'
         . ($note ? '<small>' . $note . '</small>' : '') . '</div>';
}

/** Section heading: optional tag pill, H2 (HTML allowed, use <span class="a"> for the accent line), optional lead. */
function x_head(string $id, string $h2, string $tag = '', string $sub = '', string $cls = ''): string {
    return '<div class="x-head ' . e($cls) . '">' . ($tag ? '<p class="x-tag">' . e($tag) . '</p>' : '')
         . '<h2 class="x-h2" id="' . e($id) . '">' . $h2 . '</h2>' . ($sub ? '<p class="x-sub">' . $sub . '</p>' : '') . '</div>';
}

/** Decorative wireframe ring (brand orange) and sparkles for the hero. */
function x_deco(): string {
    $ring = '';
    for ($i = 0; $i < 14; $i++) $ring .= '<ellipse cx="200" cy="200" rx="' . (190 - $i * 6) . '" ry="' . (70 + $i * 8) . '" transform="rotate(' . ($i * 9 - 40) . ' 200 200)"/>';
    $svg = '<svg viewBox="0 0 400 400" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">' . $ring . '</svg>';
    $sp = '<svg viewBox="0 0 16 16" aria-hidden="true"><path fill="currentColor" d="M8 0c.6 4.2 3.8 7.4 8 8-4.2.6-7.4 3.8-8 8-.6-4.2-3.8-7.4-8-8 4.2-.6 7.4-3.8 8-8z"/></svg>';
    $s = '';
    foreach ([['8%', '30%'], ['90%', '22%'], ['86%', '46%'], ['12%', '60%'], ['94%', '70%']] as $p) $s .= '<span class="x-deco x-spark" style="left:' . $p[0] . ';top:' . $p[1] . '">' . $sp . '</span>';
    return '<div class="x-deco x-ring">' . $svg . '</div><div class="x-deco x-ring r">' . $svg . '</div>' . $s;
}

function x_logos(string $label): string {
    $l = ['amazon_kindle' => 'Amazon Kindle', 'ibooks' => 'Apple Books', 'barnes_noble' => 'Barnes & Noble', 'rakuten_kobo' => 'Rakuten Kobo', 'ingramspark' => 'IngramSpark', 'scribd' => 'Scribd'];
    $h = '<ul>';
    foreach ($l as $f => $n) $h .= '<li><img src="' . e(asset('img/publishable-logo/' . $f . '.png')) . '" alt="' . e($n) . '" loading="lazy"></li>';
    return '<p>' . e($label) . '</p>' . $h . '</ul>';
}

/** Case study card with a laptop showing an Amazon Ads dashboard. */
function x_case(array $c): string {
    $m = ''; foreach ($c['tiles'] as $t) $m .= '<div><b>' . e($t[0]) . '</b><span>' . e($t[1]) . '</span></div>';
    return '<article class="x-case ad-rv"><div class="x-case-top"><div class="x-laptop"><div class="scr">' . ad_dash($c['kpis'], $c['a'], $c['b']) . '</div><div class="base"></div></div></div>'
         . '<span class="x-case-tag">' . e($c['tag']) . '</span><div class="x-case-b"><h3>' . e($c['title']) . '</h3><p class="big">' . e($c['big']) . '</p><p>' . e($c['text']) . '</p><div class="x-case-m">' . $m . '</div></div></article>';
}

function x_faq(array $items): string { return '<div class="x-faq ad-rv">' . faq_html($items, true) . '</div>'; }

/** "Without vs with" cards. $a/$b = [label, title, [items]] */
function x_vs(array $a, array $b): string {
    $col = function (array $c, bool $us) {
        $h = '<div class="' . ($us ? 'us ' : '') . 'ad-rv"' . ($us ? ' style="--d:1"' : '') . '><span class="lab">' . e($c[0]) . '</span><h3>' . e($c[1]) . '</h3><ul>';
        foreach ($c[2] as $x) $h .= '<li class="' . ($us ? 'y' : 'n') . '">' . ad_i($us ? 'check' : 'x') . '<span>' . e($x) . '</span></li>';
        return $h . '</ul></div>';
    };
    return '<div class="x-vs">' . $col($a, false) . $col($b, true) . '</div>';
}

/** Form section: copy + ticks on the left, the lead form on the right. */
function x_formsec(string $id, string $h2, string $sub, array $ticks, array $form, string $tag = ''): string {
    $t = ''; foreach ($ticks as $x) $t .= '<li>' . ad_i('check') . '<span>' . e($x) . '</span></li>';
    return '<div class="x-formsec"><div class="ad-rv">' . ($tag ? '<p class="x-tag">' . e($tag) . '</p>' : '') . '<h2 class="x-h2" id="' . e($id) . '">' . $h2 . '</h2><p class="x-sub" style="margin-left:0">' . $sub . '</p><ul class="x-list">' . $t . '</ul></div>'
         . ad_form($form[0], $form[1], $form[2], $form[3], $form[4] ?? 'Get My Free Quote', $form[5] ?? 'A real person replies within 1 business day') . '</div>';
}

/** Final call to action box. */
function x_final(string $h2, string $sub, array $dots, string $big, string $cta, string $note): string {
    $d = ''; foreach ($dots as $x) $d .= '<li>' . e($x) . '</li>';
    return '<div class="x-final ad-rv"><h2 class="x-h2" id="fn-h">' . $h2 . '</h2><p class="x-sub">' . $sub . '</p><ul class="x-dots">' . $d . '</ul>'
         . ($big ? '<p class="big">' . $big . '</p>' : '') . x_cta($cta, $note) . '</div>';
}
