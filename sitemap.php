<?php
/* Sitemap for Google: lists every page, article and city service page automatically.
   Submit  https://www.yourdomain.pk/sitemap.php  in Google Search Console. */
require_once __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/city-pages.php';
header('Content-Type: application/xml; charset=utf-8');
$today = date('Y-m-d');
$urls = [['/', '1.0']];
foreach (['about.php', 'services.php', 'fleets.php', 'blog.php', 'faq.php', 'contact.php'] as $p) $urls[] = ['/' . $p, '0.8'];
foreach ($SERVICES as $s) foreach (CITIES as $c) $urls[] = ['/' . city_page_url($s['slug'], $c), '0.7'];
foreach ($ARTICLES ?? [] as $a) $urls[] = ['/article.php?slug=' . $a['slug'], '0.6'];
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as [$u, $pr]) echo '  <url><loc>' . htmlspecialchars(SITE_URL . $u, ENT_XML1) . '</loc><lastmod>' . $today . '</lastmod><priority>' . $pr . "</priority></url>\n";
echo '</urlset>';
