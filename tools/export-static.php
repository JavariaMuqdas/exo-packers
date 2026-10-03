<?php
/* ==================================================================
   EXPORT THE SITE AS PLAIN HTML FOR VERCEL (or any static host)

   How to run (Windows, XAMPP):   D:\xampp\php\php.exe tools\export-static.php
   It creates the folder  dist/  with the finished website.

   BEFORE YOU RUN IT:
   1. In includes/config.php set SITE_URL to your real address (for example https://exo-packers.vercel.app
      first, and your own domain once you have one).
   2. Get a free Web3Forms access key at https://web3forms.com (enter your email, the key arrives by email)
      and paste it below. It makes the quote forms send you an email.
   ================================================================== */

$WEB3FORMS_KEY = getenv('W3F_KEY') ?: 'PASTE_YOUR_WEB3FORMS_ACCESS_KEY_HERE';
$FORM_ENDPOINT = 'https://api.web3forms.com/submit';
$FORM_SUBJECT  = 'New quote request from the Exo Packers website';

/* ------------------------------------------------------------------ */
$root = dirname(__DIR__);
chdir($root);
require_once $root . '/includes/config.php';
include $root . '/includes/data.php';
require_once $root . '/includes/city-pages.php';

$out = $root . '/dist';
$render = __DIR__ . '/render-one.php';
$siteUrl = rtrim(SITE_URL, '/');

function rrmdir(string $d): void { if (!is_dir($d)) return; foreach (scandir($d) as $f) { if ($f === '.' || $f === '..') continue; $p = "$d/$f"; is_dir($p) ? rrmdir($p) : unlink($p); } rmdir($d); }
function rcopy(string $a, string $b): void { @mkdir($b, 0777, true); foreach (scandir($a) as $f) { if ($f === '.' || $f === '..') continue; is_dir("$a/$f") ? rcopy("$a/$f", "$b/$f") : copy("$a/$f", "$b/$f"); } }
function put(string $path, string $data): void { @mkdir(dirname($path), 0777, true); file_put_contents($path, $data); }

/* turns old PHP-style links into clean ones */
function clean_links(string $html): string {
    return preg_replace_callback('~(?<pre>["\'/])(?<file>service-city|article|index|about|services|fleets|blog|faq|contact|thank-you)\.php(?<q>\?[^"\'\s<#]*)?(?<frag>#[^"\'\s<]*)?~', function ($m) {
        $path = $m['file'];
        if ($m['file'] === 'index') $path = '';
        elseif ($m['file'] === 'service-city') {
            parse_str(html_entity_decode(ltrim($m['q'] ?? '', '?')), $a);
            $svc = find_service($a['service'] ?? '');
            $path = $svc ? slugify($svc['name']) . '-in-' . ($a['city'] ?? '') : 'services';
        } elseif ($m['file'] === 'article') {
            parse_str(html_entity_decode(ltrim($m['q'] ?? '', '?')), $a);
            $path = 'blog/' . ($a['slug'] ?? '');
        }
        $lead = $m['pre'] === '/' ? '/' : $m['pre'] . '/';
        return $lead . $path . ($m['frag'] ?? '');
    }, $html);
}
function fix_assets(string $html): string {
    $html = preg_replace('~(\b(?:src|href|poster)=["\'])assets/~', '$1/assets/', $html);
    $html = preg_replace('~url\((["\']?)assets/~', 'url($1/assets/', $html);
    return str_replace('&quot;assets/', '&quot;/assets/', $html);
}
function fix_forms(string $html, string $endpoint, string $key, string $subject, string $thanks): string {
    return preg_replace_callback('~<form\b[^>]*action="actions/send-quote\.php"[^>]*>~', function ($m) use ($endpoint, $key, $subject, $thanks) {
        $tag = str_replace('action="actions/send-quote.php"', 'action="' . $endpoint . '"', $m[0]);
        return $tag
            . '<input type="hidden" name="access_key" value="' . htmlspecialchars($key) . '">'
            . '<input type="hidden" name="subject" value="' . htmlspecialchars($subject) . '">'
            . '<input type="hidden" name="from_name" value="' . htmlspecialchars(SITE_NAME) . ' website">'
            . '<input type="hidden" name="redirect" value="' . htmlspecialchars($thanks) . '">'
            . '<input type="checkbox" name="botcheck" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">';
    }, $html);
}
function render(string $render, string $file, string $query = ''): string {
    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($render) . ' ' . escapeshellarg($file) . ' ' . escapeshellarg($query);
    exec($cmd . ' 2>&1', $lines, $code);
    return implode("\n", $lines);
}

/* ---- list of pages ---- */
$pages = [];   // [source file, query, output path (without .html), public URL]
foreach (['about', 'services', 'fleets', 'faq', 'contact', 'thank-you'] as $p) $pages[] = [$p . '.php', '', $p, '/' . $p];
$pages[] = ['blog.php', '', 'blog/index', '/blog'];     // blog/index.html, so /blog and /blog/article-name never clash
$pages[] = ['index.php', '', 'index', '/'];
foreach ($SERVICES as $s) foreach (CITIES as $c) {
    $slug = slugify($s['name']) . '-in-' . slugify($c);
    $pages[] = ['service-city.php', 'service=' . $s['slug'] . '&city=' . slugify($c), $slug, '/' . $slug];
}
foreach ($ARTICLES ?? [] as $a) $pages[] = ['article.php', 'slug=' . $a['slug'], 'blog/' . $a['slug'], '/blog/' . $a['slug']];

rrmdir($out); mkdir($out, 0777, true);
$keyOk = $WEB3FORMS_KEY !== '' && strpos($WEB3FORMS_KEY, 'PASTE_') === false;
$done = 0; $sitemap = [];
foreach ($pages as [$file, $q, $dest, $url]) {
    $html = render($render, $file, $q);
    if (strlen($html) < 500 || stripos($html, '<html') === false) { echo "  PROBLEM rendering $file?$q\n" . substr($html, 0, 300) . "\n"; continue; }
    $html = fix_forms(fix_assets(clean_links($html)), $FORM_ENDPOINT, $WEB3FORMS_KEY, $FORM_SUBJECT, $siteUrl . '/thank-you');
    put("$out/$dest.html", $html); $done++;
    if ($dest !== 'thank-you') $sitemap[] = $url;
}
/* friendly 404 page (Vercel shows it automatically) */
$nf = render($render, 'service-city.php', 'service=none&city=none');
put("$out/404.html", fix_forms(fix_assets(clean_links($nf)), $FORM_ENDPOINT, $WEB3FORMS_KEY, $FORM_SUBJECT, $siteUrl . '/thank-you'));

/* ---- files that are copied as they are ---- */
rcopy($root . '/assets', $out . '/assets');
foreach (glob($out . '/assets/**/*.php') ?: [] as $f) unlink($f);

/* ---- sitemap, robots, Vercel settings ---- */
$today = date('Y-m-d'); $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($sitemap as $u) $xml .= '  <url><loc>' . htmlspecialchars($siteUrl . ($u === '/' ? '/' : $u), ENT_XML1) . '</loc><lastmod>' . $today . '</lastmod><priority>' . ($u === '/' ? '1.0' : (substr_count($u, '-in-') ? '0.7' : '0.8')) . "</priority></url>\n";
put("$out/sitemap.xml", $xml . '</urlset>');
put("$out/robots.txt", "User-agent: *\nAllow: /\nDisallow: /thank-you\n\nSitemap: $siteUrl/sitemap.xml\n");
$vercel = [
    '$schema' => 'https://openapi.vercel.sh/vercel.json', 'cleanUrls' => true, 'trailingSlash' => false,
    'headers' => [
        ['source' => '/assets/(.*)', 'headers' => [['key' => 'Cache-Control', 'value' => 'public, max-age=86400, stale-while-revalidate=604800']]],
        ['source' => '/(.*)', 'headers' => [['key' => 'X-Content-Type-Options', 'value' => 'nosniff'], ['key' => 'Referrer-Policy', 'value' => 'strict-origin-when-cross-origin'], ['key' => 'X-Frame-Options', 'value' => 'SAMEORIGIN']]],
    ],
];
put("$out/vercel.json", json_encode($vercel, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");

echo "\nDone: $done pages + 404 written to dist/\n";
echo "Website address used in the pages:  $siteUrl\n";
echo $keyOk ? "Forms: will send to your Web3Forms account.\n" : "WARNING: no Web3Forms key set yet, so the quote forms will not send emails. Edit tools/export-static.php and run it again.\n";
