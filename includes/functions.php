<?php
/**
 * Small helpers used by the page templates.
 */

/** Escape text for safe output in HTML. */
function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

function cfg(string $key, $default = null) {
    $v = $GLOBALS['CONFIG'];
    foreach (explode('.', $key) as $k) { if (!is_array($v) || !array_key_exists($k, $v)) return $default; $v = $v[$k]; }
    return $v;
}
function data(string $key) { return $GLOBALS['DATA'][$key] ?? null; }
function site(string $key = ''): mixed { $s = $GLOBALS['DATA']['site']; return $key === '' ? $s : ($s[$key] ?? ''); }

/** Path inside the site (adds the sub-folder prefix if the site is not in the domain root). */
function url(string $path = '/'): string {
    $base = rtrim((string)cfg('base_path', ''), '/');
    return $base . ($path === '' ? '/' : $path);
}
/** Asset URL. CSS and JS get ?v=<last modified time> so browsers and server caches fetch the new file after every deploy. */
function asset(string $path): string {
    $path = ltrim($path, '/');
    $u = url('/assets/' . $path);
    if (preg_match('/\.(css|js)$/', $path) && is_file($f = dirname(__DIR__) . '/assets/' . $path)) $u .= '?v=' . filemtime($f);
    return $u;
}

/** Full address of the site, e.g. https://www.example.com (no trailing slash). */
function site_url(): string {
    $u = rtrim((string)cfg('site_url', ''), '/');
    if ($u !== '') return $u;
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
    $host  = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return ($https ? 'https://' : 'http://') . preg_replace('/[^a-zA-Z0-9.:\-]/', '', $host);
}
function abs_url(string $path): string { return site_url() . url($path); }

/** Inline icon from the SVG sprite (partials/sprite.svg). */
function ic(string $name): string { return '<svg class="ic" aria-hidden="true"><use href="#i-' . e($name) . '"/></svg>'; }

/** Photo from Unsplash (placeholder photography; replace with your own licensed photos). */
function photo(string $id, int $w, string $alt = '', string $class = '', bool $eager = false): string {
    $src = 'https://images.unsplash.com/photo-' . $id . '?auto=format&fit=crop&w=' . $w . '&q=75';
    return '<img' . ($class ? ' class="' . e($class) . '"' : '') . ' src="' . $src . '" alt="' . e($alt) . '"'
         . ($eager ? ' fetchpriority="high"' : ' loading="lazy"') . ' decoding="async" onerror="this.classList.add(\'img-fail\')">';
}

/* Photo IDs used across the site (Unsplash). Swap these for your own photography. */
function photos(): array {
    return [
        'cat' => [
            'write'   => ['1586943759341-be5595944989', 'A typewriter with a sheet reading Write something'],
            'edit'    => ['1580127645995-d43fe9598711', 'A pen editing handwritten pages'],
            'publish' => ['1637942695886-69c5094fb1bb', 'A person reading an ebook on a phone'],
            'other'   => ['1572044162444-ad60f128bdea', 'Colour swatches and a tablet on a designer’s desk'],
        ],
        'journey' => [
            ['1551836022-d5d88e9218df', 'Two people talking over a notebook'],
            ['1562564055-71e051d33c19', 'A written proposal on a desk'],
            ['1559163499-413811fb2344', 'Laptop, notebook and coffee on a work desk'],
            ['1774070231417-4bf4d2025878', 'A bookstore display of new books'],
        ],
        'strip'    => ['1662306477863-19133c2b2d39','1555631545-9dc21031669b','1455541504462-57ebb2a9cec1','1504598561342-6b76820ef3e6','1592685855723-11ec58598a6d','1588580000645-4562a6d2c839','1593430980369-68efc5a5eb34','1512820790803-83ca734da794'],
        'portraits' => ['1506863530036-1efeddceb993','1566753323558-f4e0952af115','1534399315465-2b91232de345'],
        'hero' => [
            'services'     => ['1588580000645-4562a6d2c839', 'Shelves of books in a bookshop'],
            'portfolio'    => ['1512820790803-83ca734da794', 'Stacks of books'],
            'how-it-works' => ['1559163499-413811fb2344', 'Laptop, notebook and coffee on a work desk'],
            'pricing'      => ['1572044162444-ad60f128bdea', 'Colour swatches and a tablet on a designer’s desk'],
            'about'        => ['1522648485144-849409408aee', 'A writer at a desk, seen from above'],
            'faq'          => ['1630343710506-89f8b9f21d31', 'A reader with a book'],
            'contact'      => ['1764337482439-ae67981bff34', 'A bookstore display'],
        ],
        'consult' => ['1551836022-d5d88e9218df', 'Two people reviewing a document together at a laptop'],
        'team'    => ['1517245386807-bb43f82c33c4', 'A small team collaborating around a table'],
    ];
}

/** Lookups for services. */
function subs_of(string $cat): array { return array_values(array_filter(data('subs'), fn($s) => $s['cat'] === $cat)); }
function sub_by_slug(string $slug): ?array { foreach (data('subs') as $s) if ($s['slug'] === $slug) return $s; return null; }
function cat_by_key(string $key): ?array { foreach (data('cats') as $c) if ($c['k'] === $key) return $c; return null; }
/** Which option of the form's "What do you need help with?" menu fits a service. */
function help_for(array $s): int {
    $map = ['book-cover-design-services' => 2, 'audiobook-services' => 5, 'video-book-trailer-services' => 5, 'author-website-design-services' => 5,
            'blog-writing-services' => 6, 'article-writing-services' => 6, 'website-content-writing-services' => 6];
    return $map[$s['slug']] ?? (int)(cat_by_key($s['cat'])['help'] ?? 0);
}

/**
 * Escape copy and turn internal-link tokens into links:
 *   [[book-editing-services|book editing]] -> /services/book-editing-services
 *   [[/pricing|our prices]]                -> /pricing
 */
function rich(string $t): string {
    return preg_replace_callback('/\[\[([^|\]]+)\|([^\]]+)\]\]/', function ($m) {
        $path = html_entity_decode($m[1], ENT_QUOTES, 'UTF-8');
        $path = str_starts_with($path, '/') ? $path : '/services/' . $path;
        return '<a href="' . e(url($path)) . '">' . $m[2] . '</a>';
    }, e($t));
}
/** The same copy as plain text (for meta tags and JSON-LD). */
function plain(string $t): string { return preg_replace('/\[\[[^|\]]+\|([^\]]+)\]\]/', '$1', $t); }

function min_price(array $subs): int {
    return min(array_map(fn($s) => (int)preg_replace('/\D/', '', $s['price']), $subs));
}

/** FAQ items as <details> elements. */
function faq_html(array $items, bool $openFirst = false): string {
    $h = '';
    foreach ($items as $i => $f) {
        $h .= '<details' . ($openFirst && $i === 0 ? ' open' : '') . '><summary>' . e($f[0]) . '</summary><div class="ans"><p>' . rich($f[1]) . '</p></div></details>';
    }
    return $h;
}

/** Orange call-to-action band used at the bottom of inner pages. */
function cta_band(string $title, string $text, string $label, string $href = '/contact', string $label2 = '', string $href2 = ''): string {
    $btn2 = $label2 ? '<a class="btn btn-outline" href="' . e(url($href2)) . '">' . e($label2) . '</a>' : '';
    return '<section class="final section slim"><div class="wrap split"><div><h2>' . e($title) . '</h2><p class="lead" style="margin:0">' . e($text) . '</p></div>'
         . '<div class="btn-row"><a class="btn btn-dark" href="' . e(url($href)) . '">' . e($label) . '</a>' . $btn2 . '</div></div></section>';
}

/** Page hero with a photo background. $key picks the photo from photos()['hero']. */
function page_hero(array $crumbs, string $h1Html, string $lead, string $key, string $extra = ''): string {
    $p = photos()['hero'][$key];
    $c = '<a href="' . e(url('/')) . '">Home</a>';
    foreach ($crumbs as $i => $cr) {
        $c .= ' / ' . (is_array($cr) ? '<a href="' . e(url($cr[1])) . '">' . e($cr[0]) . '</a>' : e($cr));
    }
    return '<section class="page-hero"><div class="wrap ph-grid"><div><p class="crumbs">' . $c . '</p><h1>' . $h1Html . '</h1><p class="lead">' . e($lead) . '</p>' . $extra . '</div>'
         . '<div class="ph-art" aria-hidden="true">' . photo($p[0], 1800, '', 'aph', true) . '</div></div></section>';
}

/** Breadcrumb JSON-LD. $trail = [['Home','/'],['Services','/services'], ['Name', null]] */
function breadcrumb_schema(array $trail): array {
    $items = [];
    foreach ($trail as $i => $t) {
        $it = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $t[0]];
        if (!empty($t[1])) $it['item'] = abs_url($t[1]);
        $items[] = $it;
    }
    return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
}
function faq_schema(array $items): array {
    return ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => plain($f[1])],
    ], $items)];
}

/** Every public page for the sitemap: [path, priority, changefreq] */
function sitemap_pages(): array {
    $p = [['/', '1.0', 'weekly'], ['/services', '0.9', 'weekly']];
    foreach (data('subs') as $s) $p[] = ['/services/' . $s['slug'], '0.8', 'monthly'];
    foreach ([['/portfolio','0.7'],['/how-it-works','0.7'],['/pricing','0.8'],['/about','0.6'],['/faq','0.6'],['/contact','0.8']] as $x) $p[] = [$x[0], $x[1], 'monthly'];
    foreach (glob(ROOT . '/lp/*.php') ?: [] as $f) $p[] = ['/lp/' . basename($f, '.php'), '0.8', 'monthly'];
    $p[] = ['/privacy', '0.3', 'yearly']; $p[] = ['/terms', '0.3', 'yearly'];
    return $p;
}
