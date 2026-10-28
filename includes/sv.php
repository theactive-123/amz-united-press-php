<?php
/**
 * Service pages — clean editorial sections in the homepage style.
 * Every page shares the hero, FAQ and closing form; the middle of the page is
 * composed per service in service.php, and each service gets its own
 * signature section (sv_sig) that shows the work rather than describing it.
 */

/** Small inline stroke icons (the sprite only has a few). */
function sv_i(string $n): string {
    $p = [
        'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
        'check' => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'book'  => '<path d="M4.5 4h4.5v16H4.5zM10.5 4H15v16h-4.5z"/><path d="m17 5.2 3.6 1-3.6 13.2-2.6-.8"/>',
        'pen'   => '<path d="m4 20 1-4.2L16.2 4.6l3.2 3.2L8.2 19z"/><path d="m14 6.8 3.2 3.2"/>',
        'edit'  => '<path d="M4 5h16v11H9l-5 4z"/><path d="m8.5 10.5 2.2 2.2 4.3-4.4"/>',
        'send'  => '<path d="m3 11 18-8-8 18-2.2-7.8z"/>',
        'spark' => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5 18 18M18 6l-2.5 2.5M8.5 15.5 6 18"/>',
        'chat'  => '<path d="M4 5h16v11H9l-5 4z"/>',
        'q'     => '<circle cx="12" cy="12" r="9"/><path d="M9.6 9.6a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.2 1-1.2 1.8"/><path d="M12 17h.01"/>',
        'steps' => '<circle cx="5" cy="19" r="2"/><circle cx="19" cy="5" r="2"/><path d="M7 19h5a4 4 0 0 0 0-8h-1a4 4 0 0 1 0-8h6"/>',
        'list'  => '<path d="M5 3.5h14v17H5z"/><path d="M9 8.5h6M9 12.5h6M9 16.5h3.5"/>',
        'mail'  => '<path d="M3 5.5h18v13H3z"/><path d="m3.5 6.5 8.5 6.5 8.5-6.5"/>',
        'mic'   => '<rect x="9" y="3" width="6" height="11" rx="3"/><path d="M5 11a7 7 0 0 0 14 0M12 18v3"/>',
        'play'  => '<path d="M7 4.5v15l12-7.5z"/>',
        'globe' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
        'search'=> '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
        'eye'   => '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'chart' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'layout'=> '<path d="M4 4h16v16H4zM4 9h16M9 9v11"/>',
    ][$n] ?? '';
    return '<svg class="svx-ic" viewBox="0 0 24 24" aria-hidden="true">' . $p . '</svg>';
}

/** Mono kicker with the round orange icon (homepage .x-kick). */
function sv_kick(string $icon, string $text, string $id = ''): string {
    return '<p class="x-kick"' . ($id ? ' id="' . e($id) . '"' : '') . '>' . sv_i($icon) . e($text) . '</p>';
}

/** Heading text with its last word set in the italic serif accent, homepage style. */
function sv_em(string $text): string {
    if (!preg_match('/^(.*\s)(\S+?)([.!?…]*)$/u', trim($text), $m)) return e($text);
    return e($m[1]) . '<em>' . e($m[2]) . '</em>' . e($m[3]);
}

/** Portfolio cover URL by index. */
function sv_cover(int $i): string { $w = data('work'); return url($w[(($i % count($w)) + count($w)) % count($w)]['image']); }

/** Image from assets/img/<folder>/<file>. */
function sv_img(string $rel, string $alt = '', bool $eager = false): string {
    return '<img src="' . e(url('/assets/img/' . implode('/', array_map('rawurlencode', explode('/', $rel))))) . '" alt="' . e($alt) . '"' . ($eager ? ' fetchpriority="high"' : ' loading="lazy"') . ' decoding="async">';
}

/** A 3D book built from a real portfolio cover. */
function sv_book(int $i, string $cls = ''): string {
    return '<span class="svx-book ' . e($cls) . '"><img src="' . e(sv_cover($i)) . '" alt="" loading="lazy" decoding="async"></span>';
}

/** Primary + phone buttons. */
function sv_actions(string $quote, int $help, string $label = 'Get a Free Quote', bool $dark = true): string {
    $tel = preg_replace('/[^\d+]/', '', site('phone'));
    return '<div class="svx-actions"><button type="button" class="btn btn-primary" data-quote="' . e($quote) . '" data-help="' . $help . '">' . e($label) . '</button>'
         . '<a class="btn btn-ghost' . ($dark ? '' : ' on-light') . '" href="tel:' . e($tel) . '">' . sv_i('phone') . e(site('phone')) . '</a></div>';
}

/* ======================================================================
   Hero artwork — one clear object per service, decorative only.
   ====================================================================== */
function sv_hero_art(string $kind, int $s): string {
    $h = '<div class="svx-art svx-art-' . e($kind) . '" aria-hidden="true">';
    switch ($kind) {
        case 'books':   $h .= sv_book($s, 'a') . sv_book($s + 3, 'b'); break;
        case 'fan':     $h .= sv_book($s, 'a') . sv_book($s + 2, 'b') . sv_book($s + 4, 'c'); break;
        case 'kindle':  $h .= '<span class="svx-kindle"><img src="' . e(sv_cover($s)) . '" alt=""></span>' . sv_book($s + 2, 'b'); break;
        case 'page':    $h .= '<span class="svx-page"><b>Chapter One</b><span class="svx-type">The morning she finally wrote it down, the kitchen was still dark</span><i></i><i></i><i></i><i></i><i class="s"></i></span>' . sv_book($s, 'b'); break;
        case 'marks':   $h .= '<span class="svx-page marks"><b>Page 214</b><span>Their <s>was</s> <u>were</u> three letters on the table, <s>and</s> each one addressed to <s>a</s> someone who had never <s>lived</s> <u>lived</u> there.</span><i></i><i></i><i class="s"></i></span>' . sv_book($s, 'b'); break;
        case 'wave':    $h .= '<span class="svx-sq"><img src="' . e(sv_cover($s)) . '" alt=""></span><span class="svx-wave">' . str_repeat('<i></i>', 28) . '</span>'; break;
        case 'screen':  $h .= '<span class="svx-screen"><img src="' . e(sv_cover($s)) . '" alt=""><span class="svx-play">' . sv_i('play') . '</span><span class="svx-bar"><i></i></span></span>'; break;
        case 'browser': $h .= '<span class="svx-browser"><span class="svx-dots"><i></i><i></i><i></i><em>yourname.com</em></span><span class="svx-site"><img src="' . e(sv_cover($s)) . '" alt=""><span><b>New release</b><i></i><i></i><i class="s"></i><u>Buy the book</u></span></span></span>'; break;
        case 'doc':     $h .= '<span class="svx-browser doc"><span class="svx-dots"><i></i><i></i><i></i><em>blog / new-post</em></span><span class="svx-post"><b>How to plan a book launch in 30 days</b><i></i><i></i><i></i><i class="s"></i><i></i><i class="s"></i></span></span>'; break;
        default:        $h .= '<figure class="x-frame svx-photo">' . sv_img($kind, '', true) . '</figure>';
    }
    return $h . '</div>';
}

function sv_hero(array $d, array $cat, string $art, int $seed, string $quote, int $help): string {
    $kick = ['write' => 'pen', 'publish' => 'send', 'edit' => 'edit', 'other' => 'spark'][$d['cat']] ?? 'book';
    return '<section class="svx-hero" aria-labelledby="svh-h1"><div class="x-w svx-hero-in">'
         . '<div class="svx-hero-copy">'
         . '<p class="svx-crumbs"><a href="' . e(url('/')) . '">Home</a> <span aria-hidden="true">/</span> <a href="' . e(url('/services#cat-' . $cat['k'])) . '">' . e($cat['t']) . '</a> <span aria-hidden="true">/</span> ' . e($d['t']) . '</p>'
         . '<h1 id="svh-h1" class="ent" style="--d:1">' . e($d['h1']) . '</h1>'
         . '<p class="svx-lead ent" style="--d:2">' . rich($d['lead']) . '</p>'
         . '<div class="ent" style="--d:3">' . sv_actions($quote, $help) . '</div>'
         . '</div>' . sv_hero_art($art, $seed) . '</div>'
         . '<span class="svx-hero-kick" aria-hidden="true">' . sv_i($kick) . '</span></section>';
}

/* ======================================================================
   Shared sections
   ====================================================================== */

/** Intro: split with a photo, or editorial (text only). $list shows up to four outcomes. */
function sv_intro(array $d, string $layout, string $img = ''): string {
    $in = $d['intro'];
    $list = '<ul class="x-commit">';
    foreach (array_slice($in['list'], 0, 4) as $x) $list .= '<li class="rv"><b>' . sv_i('check') . '</b><span>' . e($x) . '</span></li>';
    $list .= '</ul>';
    $p = '';
    foreach ($in['p'] as $i => $x) $p .= '<p' . ($i === 0 ? ' class="svx-big"' : '') . '>' . rich($x) . '</p>';
    $head = sv_kick('book', $d['name']) . '<h2 class="x-h2 svx-h2 rv" id="sv-intro">' . sv_em($in['h2']) . '</h2>';
    if ($layout === 'editorial') {
        return '<section class="svx-sec svx-intro ed" aria-labelledby="sv-intro"><div class="x-w">' . $head
             . '<div class="svx-ed-grid"><div class="svx-ed-p">' . $p . '</div>' . $list . '</div></div></section>';
    }
    return '<section class="svx-sec svx-intro' . ($layout === 'right' ? ' flip' : '') . '" aria-labelledby="sv-intro"><div class="x-w svx-split">'
         . '<figure class="x-frame svx-intro-img rv">' . sv_img($img, '') . '</figure>'
         . '<div>' . $head . $p . $list . '</div></div></section>';
}

/** What we cover: numbered rule rows (short lists) or a picker (long lists). */
function sv_types(array $d, string $mode): string {
    if (empty($d['types'])) return '';
    $t = $d['types']; $items = $t['items'];
    $head = sv_kick('list', 'What we cover') . '<h2 class="x-h2 svx-h2 rv" id="sv-types">' . sv_em($t['h2']) . '</h2><p class="x-sub">' . rich($t['p']) . '</p>';
    if ($mode === 'picker') {
        $tabs = ''; $panes = '';
        foreach ($items as $i => $x) {
            $tabs .= '<button type="button" data-k="' . $i . '"' . ($i === 0 ? ' class="on" aria-pressed="true"' : ' aria-pressed="false"') . '>' . e($x[0]) . '</button>';
            $panes .= '<article class="svx-pane' . ($i === 0 ? ' on' : '') . '" data-pane="' . $i . '"><span class="svx-pn">' . str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) . ' / ' . str_pad((string)count($items), 2, '0', STR_PAD_LEFT) . '</span><h3>' . e($x[0]) . '</h3><p>' . rich($x[1]) . '</p></article>';
        }
        return '<section class="svx-sec svx-types pick" aria-labelledby="sv-types"><div class="x-w">' . $head
             . '<div class="svx-picker" data-sv-sw><div class="svx-chipset" role="group" aria-label="' . e($t['h2']) . '">' . $tabs . '</div><div class="svx-panes">' . $panes . '</div></div></div></section>';
    }
    $rows = '';
    foreach ($items as $i => $x) $rows .= '<li class="rv"><span class="svx-rn">' . str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) . '</span><div><h3>' . e($x[0]) . '</h3><p>' . rich($x[1]) . '</p></div></li>';
    return '<section class="svx-sec svx-types" aria-labelledby="sv-types"><div class="x-w svx-split top"><div class="svx-sticky">' . $head . '</div><ol class="svx-rows">' . $rows . '</ol></div></section>';
}

/** Process: pinned scroll (homepage journey), numbered rows, or a horizontal track. */
function sv_process(array $d, string $mode, string $quote, int $help): string {
    $pr = $d['process']; $st = $pr['steps']; $n = count($st);
    if ($mode === 'pin') {
        $jp = [['Remote Project Discussion on Google Meet.png', 'Project discussion on a video call'], ['Book Project Proposal Workspace.png', 'Book project proposal workspace'], ['Cozy InDesign Book Layout Workspace.png', 'Book layout workspace'], ['Author Workspace with KDP Publishing Dashboard.png', 'Author workspace with a publishing dashboard']];
        $steps = ''; $nav = '<i id="jbar" aria-hidden="true"></i>';
        foreach ($st as $i => $x) {
            $p = $jp[min(3, intdiv($i * 4, $n))];
            $steps .= '<article class="jstep' . ($i === 0 ? ' on' : '') . '"><div class="jtxt"><span class="jn" aria-hidden="true">' . str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) . '</span><h3>' . e($x[0]) . '</h3><p>' . rich($x[1]) . '</p></div><div class="jphoto">' . sv_img('From first idea to finished book/' . $p[0], $p[1]) . '</div></article>';
            $nav .= '<button type="button" data-j="' . $i . '"' . ($i === 0 ? ' aria-current="step"' : '') . '>' . str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) . ' ' . e($x[0]) . '</button>';
        }
        return '<section class="journey svx-journey" id="journey" aria-labelledby="sv-proc" style="--jn:' . $n . '"><div class="jpin">'
             . '<div class="svx-jhead">' . sv_kick('steps', 'How it works') . '<h2 class="svx-jh2" id="sv-proc">' . e($pr['h2']) . '</h2></div>'
             . '<div class="jmain"><div class="jsteps" id="jsteps">' . $steps . '</div><div class="jprog" id="jprog" aria-label="Stages">' . $nav . '</div></div></div>'
             . '<p class="sr">' . plain($pr['p']) . '</p></section>';
    }
    $items = '';
    foreach ($st as $i => $x) $items .= '<li class="rv"><span class="svx-sn">' . str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) . '</span><h3>' . e($x[0]) . '</h3><p>' . rich($x[1]) . '</p></li>';
    $head = sv_kick('steps', 'How it works') . '<h2 class="x-h2 svx-h2 rv" id="sv-proc">' . sv_em($pr['h2']) . '</h2><p class="x-sub">' . rich($pr['p']) . '</p>';
    if ($mode === 'track') {
        return '<section class="svx-sec svx-proc track" aria-labelledby="sv-proc"><div class="x-w">' . $head . '</div>'
             . '<div class="svx-track-wrap"><ol class="svx-track" data-sv-track tabindex="0" aria-label="Steps">' . $items . '</ol></div>'
             . '<div class="x-w svx-track-foot"><span class="svx-track-bar"><i data-sv-bar></i></span><div class="arrows"><button type="button" data-sv-prev aria-label="Previous step">' . sv_i('arrow') . '</button><button type="button" data-sv-next aria-label="Next step">' . sv_i('arrow') . '</button></div></div></section>';
    }
    return '<section class="svx-sec svx-proc rows" aria-labelledby="sv-proc"><div class="x-w svx-split top"><div class="svx-sticky">' . $head
         . '<button type="button" class="btn btn-primary" data-quote="' . e($quote) . '" data-help="' . $help . '">Start with step one</button></div><ol class="svx-steps">' . $items . '</ol></div></section>';
}

/** Orange or dark full-width call-to-action band. */
function sv_band(string $title, string $quote, int $help, bool $dark = false): string {
    return '<section class="hm-band' . ($dark ? ' hm-band-dark' : '') . '" aria-label="Get started"><div class="x-w hm-band-in"><div><h2>' . e($title) . '</h2></div>'
         . '<div class="hm-band-btns"><button type="button" class="btn ' . ($dark ? 'btn-primary' : 'btn-dark') . '" data-quote="' . e($quote) . '" data-help="' . $help . '">Get a Quote</button><button type="button" class="btn btn-outline" data-chat>Live Chat</button></div></div></section>';
}

/** Proof: the homepage cover shelf, the client photo strip or the store logos. */
function sv_proof(string $kind): string {
    if ($kind === 'shelf') {
        return '<section class="x-shelf list-ch svx-shelf" aria-labelledby="sv-shelf"><div class="x-w">' . sv_kick('book', 'The shelf') . '<h2 class="x-h2 svx-h2 rv" id="sv-shelf">Books we helped <em>publish</em>.</h2>'
             . '<p class="x-sub">Real covers from real authors. <a href="' . e(url('/portfolio')) . '">See the full portfolio</a>.</p></div>'
             . '<div class="list-track" id="list-track" data-works="home" role="region" aria-roledescription="carousel" aria-label="Book covers" tabindex="0"></div>'
             . '<div class="x-w list-foot"><div class="arrows"><button type="button" id="list-prev" aria-label="Previous covers"><svg class="ic" aria-hidden="true" style="transform:scaleX(-1)"><use href="#i-arrow"/></svg></button><button type="button" id="list-next" aria-label="Next covers"><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></button></div></div></section>';
    }
    if ($kind === 'clients') {
        $imgs = glob(__DIR__ . '/../assets/img/client-images/*.{png,jpg,jpeg,webp,avif}', GLOB_BRACE) ?: []; natsort($imgs);
        $g = '';
        for ($c = 0; $c < 2; $c++) { $g .= '<div class="trusted-group">'; foreach ($imgs as $f) $g .= '<img src="' . e(asset('img/client-images/' . rawurlencode(basename($f)))) . '" alt="" loading="lazy" decoding="async">'; $g .= '</div>'; }
        return '<section class="x-strip trusted-strip" aria-labelledby="sv-trust"><div class="trusted-label"><span class="trusted-eyebrow"><i aria-hidden="true"></i> Our author community</span><h2 id="sv-trust">Trusted by <em>authors.</em></h2><p>Our authors, proudly holding the books they brought to life.</p></div>'
             . '<div class="trusted-window" aria-hidden="true"><div class="x-strip-t">' . $g . '</div></div></section>';
    }
    if ($kind === 'stores') {
        $logos = ['amazon_kindle' => 'Amazon Kindle', 'ibooks' => 'Apple Books', 'barnes_noble' => 'Barnes & Noble', 'rakuten_kobo' => 'Rakuten Kobo', 'ingramspark' => 'IngramSpark', 'draft2digital' => 'Draft2Digital', 'scribd' => 'Scribd', 'lulu' => 'Lulu', 'smashwords' => 'Smashwords', 'abebooks' => 'AbeBooks', 'alibris' => 'Alibris', 'createspace' => 'CreateSpace'];
        $row = '';
        for ($c = 0; $c < 2; $c++) { $row .= '<div class="platform-group"' . ($c ? ' aria-hidden="true"' : '') . '>'; foreach ($logos as $f => $n) $row .= '<div class="platform-logo"><img src="' . e(asset('img/publishable-logo/' . $f . '.png')) . '" alt="' . ($c ? '' : e($n)) . '" loading="lazy" decoding="async"></div>'; $row .= '</div>'; }
        return '<section class="svx-stores" aria-label="Stores we publish to"><div class="x-w"><p class="svx-mono">Published where readers already shop</p></div><div class="platform-row"><div class="platform-belt">' . $row . '</div></div></section>';
    }
    return '';
}

/** FAQ in the homepage two-column layout. */
function sv_faq(array $d): string {
    return '<section class="x-faq svx-faq" aria-labelledby="sv-faq"><div class="x-w x-faq-grid"><div class="x-faq-side">'
         . sv_kick('q', 'Questions') . '<h2 class="x-h2 rv" id="sv-faq">Frequently asked <em>questions</em>.</h2>'
         . '<p class="svx-faq-p">Straight answers about our ' . e(strtolower($d['name'])) . '. Can’t see your question? <a href="' . e(url('/contact')) . '">Ask us directly</a>.</p>'
         . '<p class="svx-faq-cta">' . e($d['faq_cta']) . '</p>'
         . '<p><a class="x-link" href="' . e(url('/faq')) . '">All questions <svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></p></div>'
         . '<div class="faq" data-faq="svc">' . faq_html($d['faq'], true) . '</div></div></section>';
}

/** Related services as clean rule rows. */
function sv_more(array $d, array $beyond): string {
    if (!$beyond) return '';
    $li = '';
    foreach ($beyond as $x) $li .= '<li><a href="' . e(url('/services/' . $x['slug'])) . '"><span><b>' . e($x['name']) . '</b><small>' . e(plain($x['short'])) . '</small></span><svg class="ic" aria-hidden="true"><use href="#i-arrow"/></svg></a></li>';
    return '<section class="svx-sec svx-more" aria-labelledby="sv-more"><div class="x-w">' . sv_kick('spark', 'Keep going') . '<h2 class="x-h2 svx-h2 rv" id="sv-more">' . sv_em($d['beyond']['h2']) . '</h2><ul class="svx-more-list">' . $li . '</ul></div></section>';
}

/** Closing section with the lead form (homepage .x-close). */
function sv_close(array $d, int $help): string {
    return '<section class="x-close svx-close" id="contact" aria-labelledby="sv-end"><div class="x-w x-close-grid"><div>'
         . sv_kick('mail', 'Start your project') . '<h2 id="sv-end" class="x-h2 rv">' . sv_em($d['cta2']['h3']) . '</h2><p class="x-sub">' . rich($d['cta2']['p']) . '</p>'
         . '<a class="phone-big" href="tel:' . e(preg_replace('/[^\d+]/', '', site('phone'))) . '">' . e(site('phone')) . '</a>'
         . '<ul class="checks"><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Free consultation</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>Scope, timeline and price in writing</li><li><span class="tick"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg></span>You keep 100% of your rights</li></ul></div>'
         . '<div class="postcard">' . render_form('svc', 'Sign Up Now!', 'Tell us about your project. A real person replies within one business day.', 'service', 'Get My Free Quote', $help) . '</div></div></section>';
}

/* ======================================================================
   Signature sections — one per service, each with its own perspective.
   All content is in the HTML; JS only switches what is in focus.
   ====================================================================== */

/** Segmented switch + panes. $tabs = [label => paneHtml]. */
function sv_switch(array $tabs, string $label, string $cls = '', int $auto = 0): string {
    $b = ''; $p = ''; $i = 0;
    foreach ($tabs as $t => $html) {
        $b .= '<button type="button" data-k="' . $i . '" aria-pressed="' . ($i ? 'false' : 'true') . '"' . ($i ? '' : ' class="on"') . '>' . e($t) . '</button>';
        $p .= '<div class="svx-pane' . ($i ? '' : ' on') . '" data-pane="' . $i . '">' . $html . '</div>';
        $i++;
    }
    return '<div class="svx-sw ' . e($cls) . '" data-sv-sw' . ($auto ? ' data-auto="' . $auto . '"' : '') . '><div class="svx-seg" role="group" aria-label="' . e($label) . '">' . $b . '</div><div class="svx-panes">' . $p . '</div></div>';
}

function sv_sig_wrap(string $icon, string $kick, string $title, string $sub, string $body, bool $dark = false, string $cls = ''): string {
    return '<section class="svx-sec svx-sig ' . ($dark ? 'dark ' : '') . e($cls) . '" aria-labelledby="sv-sig"><div class="x-w">' . sv_kick($icon, $kick)
         . '<h2 class="x-h2 svx-h2 rv" id="sv-sig">' . $title . '</h2><p class="x-sub">' . e($sub) . '</p>' . $body . '</div></section>';
}

/** Page mock used by several signatures. */
function sv_sheet(string $label, string $html, string $cls = ''): string {
    return '<div class="svx-sheet ' . e($cls) . '"><span class="svx-mono">' . e($label) . '</span>' . $html . '</div>';
}

function sv_sig(string $slug, int $s): string {
    switch ($slug) {

    case 'ghostwriting-services':
        $body = sv_switch([
            'Your notes' => sv_sheet('Call notes, week one', '<ul class="svx-notes"><li>grew up above the bakery, 5am smell of bread</li><li>dad never said “proud”, said “good work” instead</li><li>sold the bakery 2009, regret? not sure</li><li>want readers to feel: you can start over at 50</li></ul>', 'notes'),
            'The outline' => sv_sheet('Chapter plan, approved by you', '<ol class="svx-outline"><li><b>1</b>Five in the Morning</li><li><b>2</b>Good Work</li><li><b>3</b>The Year We Sold It</li><li><b>4</b>Starting Over at Fifty</li></ol>'),
            'Chapter one' => sv_sheet('Draft, in your voice', '<p class="svx-prose">The bread was always awake before we were. By five o’clock the whole flat smelled of it, and my father would already be downstairs, sleeves rolled, saying nothing. He never told me he was proud of me. He said “good work,” and for a long time I thought that was the same thing.</p>'),
        ], 'From notes to chapter', 'svx-voice', 5200);
        return sv_sig_wrap('pen', 'Your voice, kept', 'You talk. We <em>write</em>.', 'Every book starts with your words. Switch through a sample project to see how a few lines from a call become a chapter that still sounds like you.', $body);

    case 'novel-ghostwriting-services':
        $body = sv_switch([
            'Premise' => sv_sheet('Your premise', '<p class="svx-prose lg">A lighthouse keeper finds a message in her own handwriting, dated ten years from now.</p>', 'notes'),
            'Beat sheet' => sv_sheet('Story beats', '<ol class="svx-outline"><li><b>1</b>The bottle on the rocks</li><li><b>2</b>Nobody believes her</li><li><b>3</b>The second message</li><li><b>4</b>The storm she was warned about</li><li><b>5</b>Choosing the future</li></ol>'),
            'Opening scene' => sv_sheet('Draft scene', '<p class="svx-prose">The bottle had been in the water long enough to grow a beard of weed. Mara almost kicked it back into the surf. Then she saw the paper inside, and the handwriting on it, and sat down hard on the wet rocks, because the handwriting was hers.</p>'),
        ], 'From premise to scene', 'svx-voice', 5200);
        return sv_sig_wrap('pen', 'Idea to novel', 'From one line to a <em>novel</em>.', 'A sample of how a premise grows: first the beats, then a scene. Your story, plotted and written with you approving every step.', $body, true);

    case 'ebook-writing-services':
        $body = '<div class="svx-builder" data-sv-outline><label class="svx-field"><span class="svx-mono">Your ebook is about</span><input type="text" maxlength="48" value="Saving money on a single income" data-bind="topic" autocomplete="off"></label>'
              . sv_sheet('Sample outline', '<p class="svx-ot" data-out="topic">Saving money on a single income</p><ol class="svx-outline" data-outline><li><b>1</b><span>Why <span data-out="topic">saving money on a single income</span> matters now</span></li><li><b>2</b>The five mistakes most people make</li><li><b>3</b>A simple plan you can start this week</li><li><b>4</b>Real examples, step by step</li><li><b>5</b>Your 30-day checklist</li></ol>')
              . '</div>';
        return sv_sig_wrap('list', 'Try it', 'Type a topic. See an <em>outline</em>.', 'A good ebook starts with a clear structure. Type any subject and watch a sample chapter plan take shape, the same way our writers begin.', $body);

    case 'fiction-writing-services':
        $g = ['Thriller' => 'The text arrived at 3:12 a.m., from a number that had been disconnected for six years.', 'Romance' => 'She had sworn off two things: weddings, and men who smiled like he did. He was standing at both.', 'Fantasy' => 'The dragons left the mountains on the morning the king died, and none of them flew toward the capital.', 'Sci-fi' => 'Ship’s log, day 412: the stars outside the window have started moving in the wrong direction.', 'Mystery' => 'Everyone in the village agreed the vicar was a kind man, which was why nobody mentioned the shovel.'];
        $tabs = []; $i = 0;
        foreach ($g as $k => $line) $tabs[$k] = '<div class="svx-open">' . sv_book($s + $i++, 'sm') . '<blockquote class="svx-line">“' . e($line) . '”</blockquote></div>';
        return sv_sig_wrap('book', 'First lines', 'Every genre has its own <em>hook</em>.', 'Pick a genre to read a sample opening line written for this page. Our fiction writers know what readers of your genre expect on page one.', sv_switch($tabs, 'Genre', 'svx-genres', 4200), true);

    case 'nonfiction-writing-services':
        $body = '<div class="svx-stack">'
              . '<div class="svx-layer rv"><span class="svx-mono">01 · The promise</span><b>What will the reader be able to do after the last page?</b></div>'
              . '<div class="svx-layer rv"><span class="svx-mono">02 · The proof</span><b>Your experience, research and stories that back it up.</b></div>'
              . '<div class="svx-layer rv"><span class="svx-mono">03 · The path</span><b>Chapters in an order that makes each one easier than the last.</b></div>'
              . '<div class="svx-layer rv"><span class="svx-mono">04 · The page</span><b>Clear sentences, real examples, no filler.</b></div></div>';
        return sv_sig_wrap('list', 'How we build it', 'A book with a <em>spine</em>.', 'Strong nonfiction is built in layers. We agree each one with you before a chapter is written, so the finished book holds together.', $body);

    case 'memoir-writing-services':
        $q = ['What did your childhood home smell like?', 'Who taught you something you only understood years later?', 'When did your life split into a before and an after?', 'What have you never told anyone, and are you ready to?', 'What do you want your grandchildren to know about you?', 'Which day would you live again, exactly as it was?'];
        $cards = '';
        foreach ($q as $i => $x) $cards .= '<li class="rv" style="--d:' . ($i % 3) . '"><span class="svx-mono">Question ' . ($i + 1) . '</span><p>' . e($x) . '</p></li>';
        return sv_sig_wrap('chat', 'Where memoirs begin', 'It starts with a <em>conversation</em>.', 'These are the kinds of questions our memoir writers ask in your first interviews. Your answers become the scenes of your book.', '<ul class="svx-qcards">' . $cards . '</ul>', true);

    case 'biography-writing-services':
        $src = ['Interviews' => ['Family, friends and colleagues', 'We record and transcribe every conversation, so quotes are accurate and nothing is lost.'], 'Letters & diaries' => ['Private papers', 'Handwritten letters, journals and notes, read carefully and handled with permission.'], 'Photographs' => ['Family albums', 'Dates, places and faces that anchor each chapter in a real moment.'], 'Records' => ['Public archives', 'Birth, military, property and newspaper records checked against what people remember.']];
        $tabs = [];
        foreach ($src as $k => $v) $tabs[$k] = '<div class="svx-src"><span class="svx-mono">Source</span><b>' . e($v[0]) . '</b><p>' . e($v[1]) . '</p></div>';
        return sv_sig_wrap('search', 'The research', 'A life, carefully <em>sourced</em>.', 'A biography is only as good as its sources. Here is where our biographers look before they write a single chapter.', sv_switch($tabs, 'Sources', 'svx-sources', 4800));

    case 'autobiography-writing-services':
        $eras = ['Early years' => 'Where you came from, the people who raised you and the place that shaped you.', 'Growing up' => 'School, friendships, first jobs and the choices that set your direction.', 'The turning point' => 'The moment everything changed, told as a scene the reader can see.', 'The work of a life' => 'Career, family and the things you built, with the lessons that came with them.', 'Looking back' => 'What you know now, and what you want the people after you to remember.'];
        $tabs = []; $i = 0;
        foreach ($eras as $k => $v) { $tabs[$k] = '<div class="svx-era"><span class="svx-mono">Part ' . (++$i) . '</span><b>' . e($k) . '</b><p>' . e($v) . '</p></div>'; }
        return sv_sig_wrap('steps', 'Your life, in parts', 'Your story, from the <em>start</em>.', 'Most autobiographies follow a shape like this. We map yours together, then write it chapter by chapter in your voice.', sv_switch($tabs, 'Parts of the book', 'svx-life', 4200), true);

    case 'ebook-publishing-services':
        $st = ['Kindle' => ['Amazon Kindle', 'EPUB converted for Kindle, KDP listing, categories and pricing.'], 'Apple Books' => ['Apple Books', 'Validated EPUB, Apple metadata and a preview that reads well on iPhone and iPad.'], 'Kobo' => ['Rakuten Kobo', 'Kobo Writing Life setup, so your book reaches readers in many countries.'], 'Barnes & Noble' => ['Barnes & Noble', 'Nook Press listing with the same clean files and description.'], 'Google Play' => ['Google Play Books', 'Upload, pricing by region and a listing that matches your other stores.']];
        $tabs = [];
        foreach ($st as $k => $v) $tabs[$k] = '<div class="svx-store"><span class="svx-kindle sm"><img src="' . e(sv_cover($s + count($tabs))) . '" alt=""></span><div><span class="svx-mono">Store</span><b>' . e($v[0]) . '</b><p>' . e($v[1]) . '</p><span class="svx-live">' . sv_i('check') . 'One set of files, ready for this store</span></div></div>';
        return sv_sig_wrap('globe', 'Go wide', 'One book. Every <em>store</em>.', 'Choose a store to see what we prepare for it. You approve one set of files, and we handle each platform’s rules.', sv_switch($tabs, 'Stores', 'svx-stores-sw', 4200), true);

    case 'amazon-publishing-services':
        $body = '<div class="svx-kdp" data-sv-bind><div class="svx-kdp-form"><label class="svx-field"><span class="svx-mono">Book title</span><input type="text" maxlength="40" value="The Quiet Harvest" data-bind="t" autocomplete="off"></label>'
              . '<label class="svx-field"><span class="svx-mono">Subtitle</span><input type="text" maxlength="60" value="A Year of Growing Food and Starting Over" data-bind="st" autocomplete="off"></label>'
              . '<label class="svx-field"><span class="svx-mono">Author</span><input type="text" maxlength="30" value="Helen Marsh" data-bind="a" autocomplete="off"></label></div>'
              . '<div class="svx-amz" aria-live="polite"><span class="svx-amz-cover"><img src="' . e(sv_cover($s)) . '" alt=""></span><div><b class="svx-amz-t"><span data-out="t">The Quiet Harvest</span>: <span data-out="st">A Year of Growing Food and Starting Over</span></b><span class="svx-amz-a">by <span data-out="a">Helen Marsh</span> (Author)</span><span class="svx-amz-f"><i class="on">Kindle</i><i>Paperback</i></span><span class="svx-amz-l"><i></i><i></i><i class="s"></i></span><span class="svx-mono">Listing preview</span></div></div></div>';
        return sv_sig_wrap('send', 'Your Amazon listing', 'See your book on <em>Amazon</em>.', 'Type your title and watch a sample listing update. We write the title, subtitle, description and keywords that make a page like this work.', $body);

    case 'book-editing-services':
        $lv = [
            'Developmental' => '<p class="svx-prose"><mark class="big">Chapter three starts too slowly. Consider opening on the phone call and moving the backstory to chapter five.</mark> Anna had lived in the town for eleven years before anything happened.</p>',
            'Line edit' => '<p class="svx-prose">Anna had lived in the town for eleven years <del>before anything had ever really happened to her</del><ins>, and nothing had happened</ins>. Then the phone rang.</p>',
            'Copyedit' => '<p class="svx-prose">Anna had lived in the town for eleven years<ins>,</ins> and nothing had happened. Then the phone rang<del>,</del><ins>.</ins> <del>it</del><ins>It</ins> was <del>Tuesday</del><ins>a Tuesday</ins>.</p>',
            'Proofread' => '<p class="svx-prose">Anna had lived in the town for eleven years, and nothing had happened. Then the phone rang. It was a Tuesday<ins>.</ins> <span class="svx-ok">' . sv_i('check') . 'Ready to publish</span></p>',
        ];
        $tabs = [];
        foreach ($lv as $k => $v) $tabs[$k] = sv_sheet($k . ' pass', $v, 'ed');
        return sv_sig_wrap('edit', 'Four kinds of editing', 'Pick the depth. See the <em>difference</em>.', 'Each editing level does a different job. Switch between them to see what an editor changes on the same few lines.', sv_switch($tabs, 'Editing level', 'svx-levels', 4800), true);

    case 'proofreading-services':
        $txt = 'Every author <span class="svx-err" tabindex="0" role="button" data-fix="knows">know</span> the feeling. You have read <span class="svx-err" tabindex="0" role="button" data-fix="your">you’re</span> chapter twenty times, and the mistakes have become invisible. A missing <span class="svx-err" tabindex="0" role="button" data-fix="comma,">comma</span> a doubled <span class="svx-err" tabindex="0" role="button" data-fix="the">the the</span> word, a name spelled two <span class="svx-err" tabindex="0" role="button" data-fix="ways.">way.</span> Readers will <span class="svx-err" tabindex="0" role="button" data-fix="notice">noticed</span> them on page one.';
        $body = '<div class="svx-spot" data-sv-spot>' . sv_sheet('Sample paragraph', '<p class="svx-prose">' . $txt . '</p>') . '<div class="svx-spot-side"><span class="svx-mono">Errors found</span><b class="svx-spot-n"><span data-found>0</span> / 6</b><p>Tap the mistakes you can spot. Our proofreaders catch them on every page.</p><button type="button" class="btn btn-primary" data-reveal>Show all fixes</button></div></div>';
        return sv_sig_wrap('eye', 'Spot the errors', 'Six mistakes. Can you <em>find</em> them?', 'Fresh eyes catch what tired ones miss. Try it on this sample paragraph written for this page.', $body);

    case 'book-formatting-services':
        $raw = sv_sheet('manuscript.docx', '<p class="svx-raw">CHAPTER 3<br><br>the storm came in off the water just after six    and by seven the power was out.  Maggie lit the lamp anyway<br><br><br>She waited</p>', 'raw');
        $fin = '<div class="svx-devs"><span class="svx-dev print"><b>3</b><i class="svx-dropcap">The storm came in off the water just after six, and by seven the power was out. Maggie lit the lamp anyway.</i><small>— 41 —</small></span><span class="svx-dev ebook"><b>Chapter 3</b><i>The storm came in off the water just after six, and by seven the power was out.</i></span></div>';
        return sv_sig_wrap('layout', 'Before and after', 'From Word file to finished <em>book</em>.', 'Switch to see the same page as a raw manuscript, then as a print interior and a Kindle screen.', sv_switch(['Raw manuscript' => $raw, 'Formatted' => $fin], 'View', 'svx-format', 4500), true);

    case 'book-marketing-services':
        $ph = ['8 weeks before' => [['Author platform', 'Website, newsletter sign-up and social profiles that match your book.'], ['Advance readers', 'Early copies to readers who will post honest reviews at launch.']], 'Launch week' => [['Store listing', 'Keywords, categories and a description written to convert browsers.'], ['Ads', 'Amazon and social ads with a set budget you approve.']], 'After launch' => [['Reporting', 'A clear weekly summary of what is working and what is not.'], ['Keep it moving', 'Promotions, price tests and outreach so sales do not stop after week one.']]];
        $tabs = [];
        foreach ($ph as $k => $items) { $h = '<div class="svx-plan">'; foreach ($items as $it) $h .= '<div><b>' . e($it[0]) . '</b><p>' . e($it[1]) . '</p></div>'; $tabs[$k] = $h . '</div>'; }
        return sv_sig_wrap('chart', 'A launch, planned', 'Marketing with a <em>calendar</em>.', 'A sample launch plan. Switch phases to see what happens when. We agree the plan and budget with you, and never promise sales we can’t control.', sv_switch($tabs, 'Launch phase', 'svx-phases', 4800));

    case 'audiobook-services':
        $v = ['Warm' => 'Gentle and close, like a friend reading aloud. Suits memoir and self-help.', 'Dramatic' => 'Pace and tension for thrillers, fantasy and big emotional moments.', 'Conversational' => 'Natural and relaxed, for business books and how-to guides.', 'Authoritative' => 'Clear and confident, for history, biography and expert nonfiction.'];
        $tabs = []; $i = 0;
        foreach ($v as $k => $x) $tabs[$k] = '<div class="svx-voicecard"><span class="svx-wave big s' . ($i++) . '">' . str_repeat('<i></i>', 40) . '</span><b>' . e($k) . ' narration</b><p>' . e($x) . '</p></div>';
        return sv_sig_wrap('mic', 'Find the voice', 'Choose how your book <em>sounds</em>.', 'Narration style changes everything. Switch between styles to see which fits your book. We match narrators to your genre and audience.', sv_switch($tabs, 'Narration style', 'svx-voices', 4200), true);

    case 'book-cover-design-services':
        return '<section class="x-studio svx-studio" aria-labelledby="st-big"><div class="x-w">' . sv_kick('pen', 'Cover maker') . '<h2 class="x-h2 rv" id="st-big">Try a cover. <em>Right now.</em></h2><p class="x-sub">Type your title, pick a genre and watch a concept cover appear. It is a quick sketch of what our designers can do.</p>'
             . '<aside class="hero-press" id="studio" role="group" aria-labelledby="st-h"><div class="st-top"><h3 id="st-h">Live preview</h3><span aria-hidden="true">Concept</span></div><div class="st-stage" id="st-stage"><div class="bk3d" id="st-book"></div></div>'
             . '<div class="studio"><div class="st-row"><div><label for="st-title">Book title</label><input id="st-title" maxlength="38" value="The Quiet Harvest" autocomplete="off"></div><div><label for="st-by">Author name</label><input id="st-by" maxlength="26" value="Helen Marsh" autocomplete="off"></div></div>'
             . '<fieldset><legend>Genre</legend><div class="gchips" role="radiogroup" id="st-genres" aria-label="Genre"></div></fieldset><div class="st-act"><button type="button" class="btn btn-primary" id="st-go">Request a cover like this</button><p class="note-small" id="st-status" aria-live="polite"></p></div></div></aside></div></section>';

    case 'video-book-trailer-services':
        $fr = [['0:00', 'Hook', 'A single line of text over a dark frame.'], ['0:06', 'World', 'The setting, in slow, moody shots.'], ['0:15', 'Conflict', 'Music rises. The stakes in three words.'], ['0:24', 'Cover', 'Your cover, title and where to buy.']];
        $tabs = []; $i = 0;
        foreach ($fr as $f) { $tabs[$f[0] . ' ' . $f[1]] = '<div class="svx-frameview"><span class="svx-screen big"><img src="' . e(sv_cover($s + $i)) . '" alt=""><span class="svx-cap">' . e($f[1]) . '</span><span class="svx-bar"><i style="width:' . (($i + 1) * 25) . '%"></i></span></span><p><b>' . e($f[0]) . ' · ' . e($f[1]) . '</b>' . e($f[2]) . '</p></div>'; $i++; }
        return sv_sig_wrap('play', 'Storyboard', 'Thirty seconds, <em>planned</em>.', 'A sample storyboard for a short trailer. Every shot is planned with you before anything is edited.', sv_switch($tabs, 'Storyboard frame', 'svx-board', 3200), true);

    case 'author-website-design-services':
        $pages = ['Home' => '<span class="svx-site big"><img src="' . e(sv_cover($s)) . '" alt=""><span><b>The new novel</b><i></i><i></i><i class="s"></i><u>Buy now</u></span></span>', 'Books' => '<span class="svx-grid3">' . sv_book($s, 'sm') . sv_book($s + 1, 'sm') . sv_book($s + 2, 'sm') . '</span>', 'About' => '<span class="svx-about"><span class="svx-avatar"></span><span><b>About the author</b><i></i><i></i><i></i><i class="s"></i></span></span>', 'Newsletter' => '<span class="svx-news"><b>Get chapter one free</b><span class="svx-input">your@email.com</span><u>Send it to me</u></span>'];
        $tabs = [];
        foreach ($pages as $k => $v) $tabs[$k] = '<div class="svx-browser lg"><span class="svx-dots"><i></i><i></i><i></i><em>yourname.com/' . strtolower($k === 'Home' ? '' : $k) . '</em></span>' . $v . '</div>';
        return sv_sig_wrap('globe', 'Your site, page by page', 'A home for your <em>books</em>.', 'Click through a sample author site. Every page has one job: help a visitor become a reader.', sv_switch($tabs, 'Page', 'svx-site-sw', 4000));

    case 'blog-writing-services':
        $brief = sv_sheet('Your brief', '<ul class="svx-notes"><li>topic: how to plan a book launch</li><li>reader: first-time indie authors</li><li>goal: newsletter sign-ups</li><li>tone: friendly, practical</li></ul>', 'notes');
        $post = sv_sheet('Finished post', '<p class="svx-ot">How to Plan a Book Launch in 30 Days (Without Burning Out)</p><p class="svx-prose sm">Most first launches fail for the same reason: everything happens in the last week. Here is a calmer plan, broken into four weeks you can actually keep…</p><span class="svx-tags"><i>1,400 words</i><i>Keyword: book launch plan</i><i>CTA: free checklist</i></span>');
        return sv_sig_wrap('pen', 'Brief in, post out', 'A brief becomes a <em>post</em>.', 'Switch to see how a short brief turns into a publish-ready post, with the keyword, structure and call to action built in.', sv_switch(['Brief' => $brief, 'Blog post' => $post], 'View', 'svx-voice', 4500), true);

    case 'website-content-writing-services':
        $pg = ['Home' => ['Stories that stay with you.', 'Award-winning thrillers by Jane Doe. Start with the book readers call “impossible to put down.”'], 'About' => ['Hi, I’m Jane.', 'I write thrillers from a small town by the sea, usually before sunrise and always with too much coffee.'], 'Books' => ['The Harbour Series', 'Three standalone mysteries, one stormy town. Read them in any order.'], 'Contact' => ['Let’s talk.', 'For events, interviews and rights, send a note and I’ll reply within a week.']];
        $tabs = [];
        foreach ($pg as $k => $v) $tabs[$k] = '<div class="svx-browser lg"><span class="svx-dots"><i></i><i></i><i></i><em>janedoe.com/' . strtolower($k === 'Home' ? '' : $k) . '</em></span><span class="svx-copy"><b>' . e($v[0]) . '</b><p>' . e($v[1]) . '</p><u>' . ($k === 'Contact' ? 'Send a message' : 'Read more') . '</u></span></div>';
        return sv_sig_wrap('globe', 'Copy, page by page', 'Words that do a <em>job</em>.', 'Sample copy written for a fictional author. Each page is written for one reader and one action.', sv_switch($tabs, 'Page', 'svx-site-sw', 4000), true);

    case 'article-writing-services':
        $body = '<div class="svx-serp" data-sv-bind><label class="svx-field"><span class="svx-mono">Article headline</span><input type="text" maxlength="70" value="How to Write a Book Proposal That Gets Read" data-bind="h" data-count autocomplete="off"><small class="svx-count"><span data-len="h">43</span> / 60 characters</small></label>'
              . '<div class="svx-result" aria-live="polite"><span class="svx-url">yourname.com › articles</span><b data-out="h">How to Write a Book Proposal That Gets Read</b><p>A clear, step-by-step guide to the five parts every proposal needs, with examples and a free template…</p></div></div>';
        return sv_sig_wrap('search', 'Built to be found', 'Written for readers. Ready for <em>search</em>.', 'Type a headline to preview how it could appear in search results. We write titles, summaries and articles that earn the click.', $body);
    }
    return '';
}
