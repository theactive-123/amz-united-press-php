<?php
/**
 * Building blocks for the ad landing pages in /lp/.
 * Each landing page sets $meta['lp'] = true, which switches the header and footer to a
 * distraction-free version (logo, phone and quote button only).
 */

/** The landing-page form. Posts like every other form, tagged as source "landing". */
function lp_form(string $id, string $heading, string $sub, int $help, string $btn = 'Get My Free Quote', bool $badge = true): string {
    return '<div class="lp-formwrap" id="' . e($id) . '">' . ($badge ? lp_offer_badge() : '') . render_form($id, $heading, $sub, 'landing', $btn, $help) . '</div>';
}

/** The offer sticker (text comes from data.php -> site.offer). */
function lp_offer_badge(): string {
    $o = site('offer');
    if (empty($o['on'])) return '';
    $note = !empty($o['ends']) ? 'Ends ' . $o['ends'] : ($o['note'] ?? '');
    return '<div class="lp-offer" role="note" aria-label="' . e($o['big'] . ' — ' . $note) . '"><small>' . e($o['top']) . '</small><b>' . e($o['big']) . '</b><span>' . e($note) . '</span></div>';
}
function lp_offer_text(): string {
    $o = site('offer');
    return empty($o['on']) ? '' : $o['big'] . ' — ' . (!empty($o['ends']) ? 'ends ' . $o['ends'] : strtolower($o['note'] ?? ''));
}

/** Hero background: a tilted mosaic of the real portfolio covers under an ink overlay. */
function lp_mosaic(): string {
    $h = '<div class="lp-mosaic" aria-hidden="true"><div class="lp-mosaic-in">';
    $w = data('work');
    for ($i = 0; $i < 24; $i++) { $x = $w[$i % count($w)]; $h .= '<img src="' . e(lp_img($x['image'])) . '" alt="" loading="' . ($i < 12 ? 'eager' : 'lazy') . '" decoding="async">'; }
    return $h . '</div></div>';
}
function lp_img(string $path): string { return url(implode('/', array_map('rawurlencode', explode('/', $path)))); }

/** Real author photos (assets/img/client-images) as a scrolling strip. Not tied to any testimonial. */
function lp_authors(string $title = 'Our authors, holding the books we helped them publish'): string {
    $imgs = glob(ROOT . '/assets/img/client-images/*.{png,jpg,jpeg,webp}', GLOB_BRACE) ?: [];
    natsort($imgs);
    $row = '';
    foreach ($imgs as $f) $row .= '<img src="' . e(asset('img/client-images/' . rawurlencode(basename($f)))) . '" alt="" loading="lazy" decoding="async" width="240" height="240">';
    return '<section class="lp-authors" aria-label="' . e($title) . '"><div class="lp-w lp-authors-head"><h2>' . e($title) . '</h2><a class="btn btn-outline" href="#lp-form" data-lp-cta>Become one of them</a></div>'
         . '<div class="lp-authors-row"><div class="lp-authors-belt">' . $row . '</div><div class="lp-authors-belt" aria-hidden="true">' . $row . '</div></div></section>';
}

/** " 50% off for a limited time." while the offer is on, otherwise empty. */
function lp_offer_suffix(): string {
    $o = site('offer');
    if (empty($o['on'])) return '';
    return ' ' . ucfirst(strtolower($o['big'])) . (!empty($o['ends']) ? ' until ' . $o['ends'] . '.' : ' for a limited time.');
}

/** Orange call-to-action strip: heading + Get a Quote | Live Chat | phone. */
function lp_strip(string $heading, string $target = '#lp-form'): string {
    $tel = preg_replace('/[^\d+]/', '', site('phone'));
    return '<section class="lp-strip" aria-label="Get started"><div class="lp-w"><h2>' . e($heading) . '</h2><div class="lp-strip-btns"><a class="btn btn-dark" href="' . e($target) . '" data-lp-cta>Get a Quote</a><button type="button" class="btn btn-outline" data-chat>Live Chat</button><a class="lp-strip-tel" href="tel:' . e($tel) . '" data-lp-call>' . ic('phone') . e(site('phone')) . '</a></div></div></section>';
}

/** Primary call-to-action buttons: scroll to the page's form, call, or open chat. */
function lp_ctas(string $target = '#lp-form', string $label = 'Get a Free Quote', bool $chat = true): string {
    $tel = preg_replace('/[^\d+]/', '', site('phone'));
    return '<div class="lp-ctas"><a class="btn btn-primary" href="' . e($target) . '" data-lp-cta>' . e($label) . ' ' . ic('arrow') . '</a>'
         . ($chat ? '<button type="button" class="btn btn-outline" data-chat>Live Chat</button>' : '')
         . '<a class="lp-call" href="tel:' . e($tel) . '" data-lp-call>' . ic('phone') . '<span><small>Call us now</small>' . e(site('phone')) . '</span></a></div>';
}

/** Small reassurance line under a CTA. */
function lp_assure(array $items = ['Free consultation', 'Written quote first', '100% rights & royalties']): string {
    $h = '<ul class="lp-assure">';
    foreach ($items as $x) $h .= '<li>' . ic('check') . e($x) . '</li>';
    return $h . '</ul>';
}

/** Self-publishing stores we publish to (real retail platforms only). */
function lp_platforms(): array {
    return ['amazon_kindle' => 'Amazon Kindle', 'ibooks' => 'Apple Books', 'barnes_noble' => 'Barnes & Noble', 'rakuten_kobo' => 'Rakuten Kobo',
            'ingramspark' => 'IngramSpark', 'draft2digital' => 'Draft2Digital', 'lulu' => 'Lulu', 'smashwords' => 'Smashwords', 'scribd' => 'Scribd', 'abebooks' => 'AbeBooks', 'alibris' => 'Alibris'];
}
function lp_platform_strip(string $label = 'Published on the stores readers use'): string {
    $logos = '';
    foreach (lp_platforms() as $f => $n) $logos .= '<img src="' . e(asset('img/publishable-logo/' . $f . '.png')) . '" alt="' . e($n) . '" loading="lazy" decoding="async">';
    return '<section class="lp-logos" aria-label="' . e($label) . '"><div class="lp-w"><p>' . e($label) . '</p><div class="lp-logos-row"><div class="lp-logos-belt">' . $logos . '</div><div class="lp-logos-belt" aria-hidden="true">' . str_replace('alt="', 'alt="" data-alt="', $logos) . '</div></div></div></section>';
}

/** Book covers from the portfolio. */
function lp_covers(int $n = 8, int $offset = 0): string {
    $h = '';
    foreach (array_slice(data('work'), $offset, $n) as $w) {
        $h .= '<figure class="lp-cover"><div class="lp-book"><img src="' . e(lp_img($w['image'])) . '" alt="' . e($w['t'] . ' by ' . $w['by']) . '" loading="lazy" decoding="async"></div><figcaption><b>' . e($w['t']) . '</b><span>' . e($w['by']) . ($w['reviews'] ? ' · ' . number_format((int)$w['reviews']) . ((int)$w['reviews'] === 1 ? ' review' : ' reviews') : '') . '</span></figcaption></figure>';
    }
    return $h;
}

/** Testimonial cards (from data.php). */
function lp_quotes(): string {
    $h = '';
    foreach (data('testimonials') as $t) $h .= '<figure class="lp-quote"><span class="lp-qmark" aria-hidden="true">“</span><blockquote>' . e($t[2]) . '</blockquote><figcaption><i aria-hidden="true">' . e(mb_substr($t[0], 0, 1)) . '</i><span><b>' . e($t[0]) . '</b>' . e($t[1]) . '</span></figcaption></figure>';
    return $h;
}

/** Stat figures (from data.php). */
function lp_stats(): string {
    $h = '';
    foreach (data('stats') as $s) $h .= '<div class="lp-stat"><b data-n="' . (int)$s[0] . '" data-suf="' . e($s[1]) . '">' . (int)$s[0] . e($s[1]) . '</b><span>' . e($s[2]) . '</span></div>';
    return $h;
}

/** Our standing promises, as an icon row. */
function lp_promises(): string {
    $p = [
        ['lock', '100% ownership', 'You keep every right and every royalty. Your book is published under your name.'],
        ['shield', 'Signed NDA', 'Your ideas and manuscript stay confidential from the first call.'],
        ['tag', 'Written quote first', 'Scope, timeline and price in writing before any work begins.'],
        ['headset', 'Real people', 'One project manager, and a reply within one business day.'],
    ];
    $h = '<div class="lp-promises">';
    foreach ($p as $x) $h .= '<div><span class="lp-ico">' . ic($x[0]) . '</span><h3>' . e($x[1]) . '</h3><p>' . e($x[2]) . '</p></div>';
    return $h . '</div>';
}

/** Schema for a landing page: the service, its FAQs and a breadcrumb. */
function lp_schema(string $name, string $desc, string $path, array $faq, string $price = ''): array {
    $svc = ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $name, 'description' => $desc, 'url' => abs_url($path), 'areaServed' => 'Worldwide',
            'provider' => ['@type' => 'Organization', 'name' => site('name'), 'url' => abs_url('/'), 'telephone' => site('phone'), 'email' => site('email')]];
    if ($price !== '') $svc['offers'] = ['@type' => 'Offer', 'priceCurrency' => 'USD', 'price' => preg_replace('/[^\d.]/', '', $price), 'description' => 'Starting price. Written quote before work begins.'];
    return [$svc, faq_schema($faq), breadcrumb_schema([['Home', '/'], [$name, null]])];
}
