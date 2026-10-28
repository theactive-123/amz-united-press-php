<?php
/**
 * Reusable page sections (printed by the page files). Keeping them here means the home page,
 * pricing page and others always show the same content from includes/data.php.
 */

function ph_note(string $text): string {
    return site('show_placeholder_notes') ? '<p class="ph-note">' . e($text) . '</p>' : '';
}

/** The big counting numbers. */
function render_stats(): string {
    $h = '';
    foreach (data('stats') as $s) $h .= '<div class="fig" role="listitem"><b data-n="' . (int)$s[0] . '" data-suf="' . e($s[1]) . '">' . (int)$s[0] . e($s[1]) . '</b><span>' . e($s[2]) . '</span></div>';
    return $h;
}

/** Four service tabs with a photo and the list of services for each. */
function render_service_tabs(): string {
    $icons = [
        'write' => '<path d="m4 20 1-4.2L16.2 4.6l3.2 3.2L8.2 19z"/><path d="m14 6.8 3.2 3.2"/>',
        'edit' => '<path d="M4 5h16v11H9l-5 4z"/><path d="m8.5 10.5 2.2 2.2 4.3-4.4"/>',
        'publish' => '<path d="m3 11 18-8-8 18-2.2-7.8z"/>',
        'other' => '<circle cx="12" cy="12" r="9"/><circle cx="8.5" cy="10" r="1.2"/><circle cx="12" cy="7.6" r="1.2"/><circle cx="15.6" cy="10" r="1.2"/><path d="M12 21c-1.5 0-2-1.5-1-2.5s0-2.5-1.5-2.5"/>',
    ];
    $ph = [
        'write' => ['Crafting Stories at the Writing Desk.png', 'Crafting stories at a writing desk'],
        'edit' => ['Cozy Manuscript Editing Workspace.png', 'Manuscript editing workspace'],
        'publish' => ['Self-Publishing Dashboard Workspace.png', 'Self-publishing dashboard workspace'],
        'other' => ['Cinematic Book Design Workspace.png', 'Book design and marketing workspace'],
    ];
    $tabs = '<div class="xs-tabs" role="tablist" aria-label="Service categories">';
    $panels = '<div class="xs-stage">';
    foreach (data('cats') as $i => $c) {
        $subs = subs_of($c['k']);
        $tabs .= '<button type="button" role="tab" class="xs-tab" id="xt' . $i . '" aria-controls="xpn' . $i . '" aria-selected="' . ($i === 0 ? 'true' : 'false') . '" tabindex="' . ($i === 0 ? 0 : -1) . '"><svg viewBox="0 0 24 24" aria-hidden="true">' . $icons[$c['k']] . '</svg><span class="xs-n">0' . ($i + 1) . '</span><b>' . e($c['t']) . '</b></button>';
        $panels .= '<div class="xs-panel" role="tabpanel" id="xpn' . $i . '" aria-labelledby="xt' . $i . '"' . ($i ? ' hidden' : '') . '><div class="xs-photo x-frame">' . '<img src="' . e(asset('img/Fourparts/' . rawurlencode($ph[$c['k']][0]))) . '" alt="' . e($ph[$c['k']][1]) . '" loading="lazy" decoding="async">' . '</div><div class="xs-body"><h3>' . e($c['t']) . '</h3><p>' . e($c['d']) . '</p><ul class="xs-subs">';
        foreach ($subs as $s) $panels .= '<li><a href="' . e(url('/services/' . $s['slug'])) . '"><span>' . e($s['name']) . '</span>' . ic('arrow') . '</a></li>';
        $panels .= '</ul><a class="x-link" href="' . e(url('/services#cat-' . $c['k'])) . '">Explore all ' . e(strtolower($c['t'])) . ' ' . ic('arrow') . '</a></div></div>';
    }
    return $tabs . '</div>' . $panels . '</div>';
}

/** Pinned scroll journey: the four stages. */
function render_journey_steps(): string {
    $jp = [
        ['Remote Project Discussion on Google Meet.png', 'Book consultation over Google Meet'],
        ['Book Project Proposal Workspace.png', 'Book project proposal workspace'],
        ['Cozy InDesign Book Layout Workspace.png', 'Book production and layout workspace'],
        ['Author Workspace with KDP Publishing Dashboard.png', 'Author workspace with publishing dashboard'],
    ];
    $h = '';
    foreach (data('steps') as $i => $s) {
        $h .= '<article class="jstep' . ($i === 0 ? ' on' : '') . '" aria-label="Stage ' . ($i + 1) . ': ' . e($s['t']) . '"><div class="jtxt"><span class="jn" aria-hidden="true">0' . ($i + 1) . '</span><h3>' . e($s['t']) . '</h3><p>' . e($s['d']) . '</p><span class="chip">Typical: ' . e($s['time']) . '</span></div><div class="jphoto">' . '<img src="' . e(asset('img/' . rawurlencode('From first idea to finished book') . '/' . rawurlencode($jp[$i][0]))) . '" alt="' . e($jp[$i][1]) . '" loading="lazy" decoding="async">' . '</div></article>';
    }
    return $h;
}
function render_journey_nav(): string {
    $h = '<i id="jbar" aria-hidden="true"></i>';
    foreach (data('steps') as $i => $s) $h .= '<button type="button" data-j="' . $i . '"' . ($i === 0 ? ' aria-current="step"' : '') . '>0' . ($i + 1) . ' ' . e($s['t']) . '</button>';
    return $h;
}

/** Three pricing cards. */
function render_plans(): string {
    $h = '';
    foreach (data('prices') as $i => $p) {
        $cls = $p['f'] ? ' hot' : ($i === 2 ? ' dark' : '');
        $h .= '<article class="xp-plan rv' . $cls . '"><div class="xp-top"><span class="xp-n" aria-hidden="true">0' . ($i + 1) . '</span>' . ($p['f'] ? '<span class="xp-tag">Most popular</span>' : '') . '</div>'
            . '<h3>' . e($p['t']) . '</h3>' . ($p['s'] !== '' ? '<p class="xp-s">' . e($p['s']) . '</p>' : '') . '<div class="xp-price">' . (str_starts_with($p['p'], 'From') ? '<small>From</small>' : '') . '<b>' . e(preg_replace('/^From\s*/', '', $p['p'])) . '</b></div><ul>';
        foreach ($p['l'] as $x) $h .= '<li>' . ic('check') . e($x) . '</li>';
        $h .= '</ul><button type="button" class="btn xp-btn" data-quote="Interested in: ' . e($p['t']) . '">' . e($p['b']) . '</button></article>';
    }
    return $h;
}

/** Testimonials with placeholder portraits. */
function render_testimonials(): string {
    $t = data('testimonials'); $pp = photos()['portraits'];
    $h = '<figure class="xr-main rv"><div class="xr-pic">' . photo($pp[0], 700, 'Portrait of a smiling woman') . '</div><div><blockquote>“' . e($t[0][2]) . '”</blockquote><figcaption><b>' . e($t[0][0]) . '</b><span>' . e($t[0][1]) . '</span></figcaption></div></figure><div class="xr-row">';
    foreach (array_slice($t, 1) as $i => $x) {
        $h .= '<figure class="xr-card rv"><blockquote>“' . e($x[2]) . '”</blockquote><figcaption>' . photo($pp[$i + 1], 200, 'Portrait') . '<span><b>' . e($x[0]) . '</b><span>' . e($x[1]) . '</span></span></figcaption></figure>';
    }
    return $h . '</div>';
}
