<?php
/**
 * Building blocks for the ad landing pages in /lp/.
 * Each landing page sets $meta['lp'] = true, which switches the header and footer to a
 * distraction-free version (logo, phone and quote button only).
 */

/** The landing-page form. Posts like every other form, tagged as source "landing". */
function lp_form(string $id, string $heading, string $sub, int $help, string $btn = 'Get My Free Quote'): string {
    return '<div class="lp-formwrap" id="' . e($id) . '">' . render_form($id, $heading, $sub, 'landing', $btn, $help) . '</div>';
}

/** Primary call-to-action buttons: scroll to the page's form, call, or open chat. */
function lp_ctas(string $target = '#lp-form', string $label = 'Get a Free Quote', bool $chat = true): string {
    $tel = preg_replace('/[^\d+]/', '', site('phone'));
    return '<div class="lp-ctas"><a class="btn btn-primary" href="' . e($target) . '" data-lp-cta>' . e($label) . ' ' . ic('arrow') . '</a>'
         . ($chat ? '<button type="button" class="btn btn-outline" data-chat>Live Chat</button>' : '')
         . '<a class="lp-call" href="tel:' . e($tel) . '" data-lp-call>' . ic('phone') . '<span><small>Talk to a specialist</small>' . e(site('phone')) . '</span></a></div>';
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
        $h .= '<figure class="lp-cover"><img src="' . e(url(implode('/', array_map('rawurlencode', explode('/', $w['image']))))) . '" alt="' . e($w['t'] . ' by ' . $w['by']) . '" loading="lazy" decoding="async"><figcaption><b>' . e($w['t']) . '</b><span>' . e($w['by']) . ($w['reviews'] ? ' · ' . number_format((int)$w['reviews']) . ((int)$w['reviews'] === 1 ? ' review' : ' reviews') : '') . '</span></figcaption></figure>';
    }
    return $h;
}

/** Testimonial cards (from data.php). */
function lp_quotes(): string {
    $h = '';
    foreach (data('testimonials') as $t) $h .= '<figure class="lp-quote"><div class="lp-stars" aria-label="5 out of 5">★★★★★</div><blockquote>“' . e($t[2]) . '”</blockquote><figcaption><b>' . e($t[0]) . '</b><span>' . e($t[1]) . '</span></figcaption></figure>';
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
