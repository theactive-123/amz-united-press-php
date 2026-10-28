<?php
/**
 * Inner-page design system (service pages and resource pages).
 * Pairs with assets/css/inner.css and assets/js/inner.js. Every visual component here only changes how
 * existing copy is presented: headings, paragraphs and links are passed in unchanged, so SEO stays intact.
 * Decorative pieces are aria-hidden and never carry content that exists nowhere else.
 */

/** Line icons (24px grid, stroke-based, Lucide-style). */
function ix_icon(string $name, string $cls = ''): string {
    static $I = [
        'message'  => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 9h8M8 13h5"/>',
        'chat'     => '<path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/>',
        'filesearch' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h5"/><path d="M14 2v6h6"/><path d="M20 8v3"/><circle cx="16.5" cy="16.5" r="2.5"/><path d="m21 21-2.7-2.7"/>',
        'type'     => '<path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/>',
        'fileedit' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="m9 18 6-6-2-2-6 6v2z"/>',
        'book'     => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20V2H6.5A2.5 2.5 0 0 0 4 4.5z"/><path d="M4 19.5A2.5 2.5 0 0 0 6.5 22H20v-5"/>',
        'bookopen' => '<path d="M2 4h6a4 4 0 0 1 4 4v13a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v13a3 3 0 0 1 3-3h7z"/>',
        'rocket'   => '<path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/>',
        'upload'   => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m17 8-5-5-5 5"/><path d="M12 3v12"/>',
        'trend'    => '<path d="m22 7-8.5 8.5-5-5L2 17"/><path d="M16 7h6v6"/>',
        'pen'      => '<path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4z"/>',
        'feather'  => '<path d="M12.67 19a2 2 0 0 0 1.41-.59l6.33-6.34a6 6 0 0 0-8.49-8.49L5.59 9.92A2 2 0 0 0 5 11.33V19z"/><path d="M16 8 2 22"/><path d="M17.5 15H9"/>',
        'search'   => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'mic'      => '<path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><path d="M12 19v3"/>',
        'list'     => '<path d="m3 17 2 2 4-4"/><path d="m3 7 2 2 4-4"/><path d="M13 6h8"/><path d="M13 12h8"/><path d="M13 18h8"/>',
        'layers'   => '<path d="m12 2 10 5-10 5L2 7z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/>',
        'palette'  => '<path d="M12 22a10 10 0 1 1 10-10c0 2.8-2.2 4-4 4h-2a2 2 0 0 0-1 3.7A1.6 1.6 0 0 1 12 22z"/><circle cx="7.5" cy="10.5" r="1"/><circle cx="12" cy="7.5" r="1"/><circle cx="16.5" cy="10.5" r="1"/>',
        'image'    => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/>',
        'package'  => '<path d="M16.5 9.4 7.5 4.2"/><path d="M21 16V8a2 2 0 0 0-1-1.7l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.7l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/>',
        'badge'    => '<path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76z"/><path d="m9 12 2 2 4-4"/>',
        'refresh'  => '<path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-15 6.7L3 16"/><path d="M8 16H3v5"/>',
        'megaphone'=> '<path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
        'target'   => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
        'users'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
        'shield'   => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
        'coins'    => '<circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/>',
        'clock'    => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
        'sparkles' => '<path d="M9.9 2.6 12 8l5.4 2.1L12 12.2 9.9 17.6 7.8 12.2 2.4 10.1 7.8 8z"/><path d="M19 15v4M17 17h4"/>',
        'heart'    => '<path d="M19 14c1.5-1.5 3-3.2 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.8 0-3 .5-4.5 2-1.5-1.5-2.7-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4 3 5.5l7 7z"/>',
        'globe'    => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10 15 15 0 0 1 4-10z"/>',
        'headphones'=> '<path d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a9 9 0 0 1 18 0v7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3"/>',
        'video'    => '<rect x="2" y="6" width="14" height="12" rx="2"/><path d="m22 8-6 4 6 4z"/>',
        'monitor'  => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>',
        'lock'     => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        'star'     => '<path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1z"/>',
        'compass'  => '<circle cx="12" cy="12" r="10"/><path d="m16.2 7.8-2.1 6.3-6.3 2.1 2.1-6.3z"/>',
        'ghost'    => '<path d="M9 10h.01M15 10h.01"/><path d="M12 2a8 8 0 0 0-8 8v12l3-3 2.5 2.5L12 19l2.5 2.5L17 19l3 3V10a8 8 0 0 0-8-8z"/>',
        'wand'     => '<path d="m15 4-1 1M18 7l1-1M21 4l-1 1M15 10l-1 1"/><path d="m3 21 12-12"/><path d="M17 3v2M21 7h-2"/>',
        'scroll'   => '<path d="M8 21h12a2 2 0 0 0 2-2v-2H10v2a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v3h4"/><path d="M19 17V5a2 2 0 0 0-2-2H4"/>',
        'smile'    => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><path d="M9 9h.01M15 9h.01"/>',
        'zap'      => '<path d="M13 2 3 14h9l-1 8 10-12h-9z"/>',
        'map'      => '<path d="M14.1 2.6 9.9 4.4a2 2 0 0 1-1.8 0L3.4 2.2A1 1 0 0 0 2 3.1v14.6a1 1 0 0 0 .6.9l5.5 2.8a2 2 0 0 0 1.8 0l4.2-2a2 2 0 0 1 1.8 0l4.7 2.4a1 1 0 0 0 1.4-.9V6.3a1 1 0 0 0-.6-.9l-5.5-2.8a2 2 0 0 0-1.8 0z"/><path d="M15 5.8v15M9 3.2v15"/>',
        'eye'      => '<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>',
        'arrow'    => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'check'    => '<path d="M20 6 9 17l-5-5"/>',
        'phone'    => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/>',
        'mail'     => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
        'x'        => '<path d="M18 6 6 18M6 6l12 12"/>',
        'minus'    => '<path d="M5 12h14"/>',
        'plus'     => '<path d="M5 12h14M12 5v14"/>',
    ];
    $p = $I[$name] ?? $I['sparkles'];
    return '<svg class="ix-ic' . ($cls ? ' ' . $cls : '') . '" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $p . '</svg>';
}

/** Pick a meaningful icon from a title (process steps, features, genres). */
function ix_icon_for(string $t, string $fallback = 'sparkles'): string {
    $t = strtolower($t);
    $map = [
        'royalt|earn|income|sales|revenue|growth' => 'trend', 'contact|signup|sign up|get started|initial|discussion|consult|call|talk|conversation' => 'chat',
        'manuscript review|review|assess|audit|inspect|evaluat' => 'filesearch', 'edit|proofread|format|typo|grammar|polish|refin|line|copy' => 'fileedit',
        'cover|design|illustrat|artwork|visual' => 'palette', 'publish|upload|launch|go live|distribut|submission' => 'rocket',
        'research|prepar|topic|ideation|keyword|seo|market research' => 'search', 'interview|record|narrat|voice|audio|listen' => 'mic',
        'outline|plan|strategy|structure|blueprint|roadmap' => 'list', 'draft|writ|chapter|author|story|ghost' => 'pen',
        'deliver|final|handover|files' => 'package', 'quality|check|assurance|approval|approve' => 'badge', 'revis|feedback|change' => 'refresh',
        'promot|marketing|advert|campaign|social|media|outreach|brand' => 'megaphone', 'track|report|performance|measure|analytic' => 'trend',
        'team|select|match|expert|specialist|support|people' => 'users', 'price|cost|afford|budget|package|rate' => 'coins', 'confiden|nda|secur|ownership|rights|copyright|privacy|ethic' => 'shield',
        'time|deadline|fast|quick|turnaround|schedul' => 'clock', 'video|trailer|film' => 'video', 'website|web|page|online|site' => 'monitor', 'book|genre|fiction|novel|memoir|biograph' => 'book',
        'kindle|ebook|e-book|digital|device' => 'bookopen', 'global|world|store|platform|reach' => 'globe', 'custom|personal|tailor|unique' => 'wand',
        'fantasy|magic|sci' => 'sparkles', 'romance|love' => 'heart', 'thriller|mystery|horror|suspense' => 'eye', 'history|historical' => 'scroll', 'adventure|action' => 'compass',
        'child' => 'smile', 'self-help|business|nonfiction|non-fiction' => 'target', 'poetry' => 'feather', 'dystop|disaster' => 'zap', 'travel' => 'map',
    ];
    foreach ($map as $k => $ic) if (preg_match('/' . $k . '/', $t)) return $ic;
    return $fallback;
}

/** Icon for a service (used on related-service cards). */
function ix_service_icon(string $slug): string {
    $m = ['ghost' => 'ghost', 'ebook-writing' => 'bookopen', 'fiction' => 'sparkles', 'nonfiction' => 'target', 'memoir' => 'heart', 'novel' => 'book', 'biography' => 'users', 'autobiography' => 'feather',
          'ebook-publishing' => 'globe', 'amazon' => 'rocket', 'editing' => 'fileedit', 'proofreading' => 'search', 'formatting' => 'type', 'marketing' => 'megaphone', 'audiobook' => 'headphones',
          'blog' => 'pen', 'website-content' => 'monitor', 'cover' => 'palette', 'trailer' => 'video', 'author-website' => 'monitor', 'article' => 'scroll'];
    foreach ($m as $k => $v) if (str_contains($slug, $k)) return $v;
    return 'book';
}

function ix_cover(int $i): string {
    $w = data('work');
    $x = $w[$i % count($w)];
    return url(implode('/', array_map('rawurlencode', explode('/', $x['image']))));
}

/** A 3D book mockup from a real cover. */
function ix_book(int $i, string $cls = ''): string {
    return '<span class="ix-book ' . e($cls) . '"><img src="' . e(ix_cover($i)) . '" alt="" loading="lazy" decoding="async" width="200" height="300"></span>';
}

/** A Kindle-style e-reader mockup showing a real cover. */
function ix_kindle(int $i, string $cls = ''): string {
    return '<span class="ix-kindle ' . e($cls) . '"><span class="ix-kindle-screen"><img src="' . e(ix_cover($i)) . '" alt="" loading="lazy" decoding="async" width="200" height="300"></span></span>';
}

/**
 * Category-specific hero artwork (decorative, aria-hidden). Built from real covers and simple UI cards,
 * so it never shows invented claims.
 */
function ix_hero_art(string $cat, string $slug, int $seed = 0): string {
    $a = $seed % 6;
    $float = function (string $icon, string $title, string $sub, string $pos) { return '<span class="ix-float ' . $pos . '">' . ix_icon($icon) . '<span><b>' . e($title) . '</b><small>' . e($sub) . '</small></span></span>'; };
    $h = '<div class="ix-hero-art ix-art-' . e($cat) . '" aria-hidden="true"><span class="ix-glow"></span>';
    if (str_contains($slug, 'audiobook')) {
        $h .= ix_book($a, 'b1') . '<span class="ix-wave"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>' . $float('headphones', 'Chapter 4', 'Narration mastered', 'f1') . $float('mic', 'Studio session', 'Recording booked', 'f2');
    } elseif (str_contains($slug, 'trailer')) {
        $h .= '<span class="ix-screen"><img src="' . e(ix_cover($a + 1)) . '" alt=""><span class="ix-play">' . ix_icon('video') . '</span></span>' . $float('video', 'Trailer draft', 'Ready to review', 'f1') . $float('sparkles', 'Storyboard', 'Approved', 'f2');
    } elseif (str_contains($slug, 'website') || str_contains($slug, 'blog') || str_contains($slug, 'article')) {
        $h .= '<span class="ix-browser"><span class="ix-browser-bar"><i></i><i></i><i></i></span><span class="ix-browser-body"><img src="' . e(ix_cover($a + 2)) . '" alt=""><span class="ix-lines"><i></i><i></i><i></i><i></i></span></span></span>' . $float('monitor', 'New page', 'Ready for review', 'f1') . $float('search', 'SEO check', 'Keywords mapped', 'f2');
    } elseif ($cat === 'publish') {
        $h .= ix_kindle($a, 'k1') . ix_book($a + 3, 'b2') . $float('rocket', 'Listing live', 'Kindle + paperback', 'f1') . $float('globe', 'Stores', 'Amazon · Apple · Kobo', 'f2');
    } elseif ($cat === 'edit') {
        $h .= '<span class="ix-page"><span class="ix-lines"><i></i><i class="del"></i><i></i><i class="ins"></i><i></i><i class="del"></i><i></i></span></span>' . ix_book($a + 1, 'b2') . $float('fileedit', 'Tracked changes', 'Ready for your review', 'f1') . $float('badge', 'Proofread', 'Final pass done', 'f2');
    } elseif (str_contains($slug, 'marketing')) {
        $h .= '<span class="ix-chart"><i style="--h:34%"></i><i style="--h:48%"></i><i style="--h:42%"></i><i style="--h:66%"></i><i style="--h:58%"></i><i style="--h:82%"></i></span>' . ix_book($a, 'b2') . $float('megaphone', 'Launch campaign', 'Ads + reviews', 'f1') . $float('trend', 'Weekly report', 'Sent to you', 'f2');
    } elseif (str_contains($slug, 'cover')) {
        $h .= ix_book($a, 'b1') . ix_book($a + 2, 'b2') . ix_book($a + 4, 'b3') . $float('palette', 'Concept 2', 'Chosen by author', 'f1') . $float('image', 'Print + ebook', 'Files ready', 'f2');
    } else { // writing
        $h .= '<span class="ix-page"><span class="ix-page-h">Chapter One</span><span class="ix-lines"><i></i><i></i><i></i><i></i><i></i><i></i></span></span>' . ix_book($a, 'b2') . $float('pen', 'Chapter 3', 'Drafted in your voice', 'f1') . $float('check', 'Outline', 'Approved by you', 'f2');
    }
    return $h . '</div>';
}

/** The eight stages of a project (shown as an animated journey rail). */
function ix_journey(): string {
    $st = ['Free consultation', 'Proposal & pricing', 'Research & outline', 'Writing & editing', 'Design & formatting', 'Your review', 'Quality check', 'Final delivery'];
    $h = '<div class="ix-journey" aria-label="How a project moves from first call to delivery"><span class="ix-journey-label">Your project, start to finish</span><ol>';
    foreach ($st as $i => $s) $h .= '<li' . ($i === 0 ? ' class="on"' : '') . '><i>' . ($i + 1) . '</i><span>' . e($s) . '</span></li>';
    return $h . '</ol></div>';
}

/** Multi-step lead form: the normal form (same fields, endpoint and validation), enhanced into steps by inner.js. */
function ix_form(string $id, string $heading, string $sub, string $source, int $help, string $btn = 'Get My Free Quote'): string {
    $o = site('offer');
    $badge = !empty($o['on']) ? '<span class="ix-offer" role="note">' . e($o['big']) . '<small>' . e(!empty($o['ends']) ? 'Ends ' . $o['ends'] : ($o['note'] ?? '')) . '</small></span>' : '';
    return '<div class="ix-msf" id="' . e($id) . '-wrap" data-steps>' . $badge . render_form($id, $heading, $sub, $source, $btn, $help) . '</div>';
}

/** Milestone counters (exact figures from data.php). */
function ix_stats(string $title = 'Milestones that speak for themselves'): string {
    $icons = ['book', 'users', 'layers', 'calendar'];
    $h = '<div class="ix-stats">';
    foreach (data('stats') as $i => $s) {
        $h .= '<div class="ix-stat ix-rv" style="--d:' . ($i * 90) . 'ms"><span class="ix-stat-ic">' . ix_icon($icons[$i % 4]) . '</span><b><span data-count="' . (int)$s[0] . '">' . (int)$s[0] . '</span>' . e($s[1]) . '</b><span class="ix-stat-l">' . e($s[2]) . '</span></div>';
    }
    return $h . '</div>';
}

/** Section heading used across inner pages. $tag keeps the original heading level. */
function ix_head(string $eyebrow, string $title, string $lead = '', string $tag = 'h2', string $cls = ''): string {
    return '<div class="ix-head ix-rv ' . e($cls) . '">' . ($eyebrow !== '' ? '<span class="ix-eyebrow">' . e($eyebrow) . '</span>' : '')
         . '<' . $tag . ' class="ix-h2">' . $title . '</' . $tag . '>' . ($lead !== '' ? '<p class="ix-lead">' . rich($lead) . '</p>' : '') . '</div>';
}

/** Call-to-action buttons: quote (dialog), live chat, phone. */
function ix_ctas(string $label = 'Get a Free Quote', string $pref = '', int $help = -1, bool $dark = false): string {
    $tel = preg_replace('/[^\d+]/', '', site('phone'));
    return '<div class="ix-ctas"><button type="button" class="ix-btn ix-btn-primary" data-quote="' . e($pref) . '"' . ($help >= 0 ? ' data-help="' . $help . '"' : '') . '>' . e($label) . ix_icon('arrow') . '</button>'
         . '<button type="button" class="ix-btn ix-btn-ghost' . ($dark ? ' on-dark' : '') . '" data-chat>' . ix_icon('chat') . 'Live Chat</button>'
         . '<a class="ix-call" href="tel:' . e($tel) . '"><span>' . ix_icon('phone') . '</span><span><small>Call us now</small><b>' . e(site('phone')) . '</b></span></a></div>';
}

/** FAQ accordion (keeps the existing <details> markup from faq_html, enhanced by inner.js). */
function ix_faq_list(array $items): string {
    return '<div class="faq ix-faq" data-ix-faq>' . faq_html($items, true) . '</div>';
}
