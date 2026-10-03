<?php
/* ------------------------------------------------------------------
   Structured data (JSON-LD) so Google understands the business.
   ------------------------------------------------------------------ */
require_once __DIR__ . '/config.php';

function schema_business(): array {
    return [
        '@context'  => 'https://schema.org',
        '@type'     => 'MovingCompany',
        '@id'       => SITE_URL . '/#business',
        'name'      => SITE_NAME,
        'url'       => SITE_URL . '/',
        'logo'      => SITE_URL . '/assets/img/logo-dark.png',
        'image'     => SITE_URL . '/assets/img/og-image.jpg',
        'description' => 'Packers and movers offering house shifting, office relocation, packing, goods transport and car carrier services in ' . CITY . '.',
        'telephone' => PHONE_LINK,
        'email'     => EMAIL,
        'address'   => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => ADDRESS,
            'addressLocality' => CITY,
            'addressCountry'  => 'PK',
        ],
        'areaServed' => array_map(fn($c) => ['@type' => 'City', 'name' => $c], CITIES),
        'sameAs'     => array_values(array_filter([FACEBOOK_URL, INSTAGRAM_URL, YOUTUBE_URL])),
        'openingHoursSpecification' => [[
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'opens'     => '08:00',
            'closes'    => '20:00',
        ]],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name'  => 'Moving services',
            'itemListElement' => array_map(fn($n) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $n]],
                ['House shifting', 'Office shifting', 'Packing and unpacking', 'Goods transport', 'Loading and unloading', 'Car carrier']),
        ],
    ];
}

function schema_website(): array {
    return ['@context' => 'https://schema.org', '@type' => 'WebSite', 'name' => SITE_NAME, 'url' => SITE_URL . '/'];
}

function schema_faq(array $faqs): array {
    return [
        '@context' => 'https://schema.org',
        '@type'    => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type' => 'Question', 'name' => $f[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
        ], $faqs),
    ];
}

function schema_breadcrumbs(array $crumbs): array {
    $items = [];
    foreach ($crumbs as $i => $c) {
        $items[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $c[0], 'item' => SITE_URL . $c[1]];
    }
    return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
}

function schema_services(array $services): array {
    return [
        '@context' => 'https://schema.org',
        '@type'    => 'ItemList',
        'itemListElement' => array_map(fn($s, $i) => [
            '@type' => 'ListItem', 'position' => $i + 1,
            'item'  => ['@type' => 'Service', 'name' => $s['name'], 'description' => $s['long'],
                        'provider' => ['@id' => SITE_URL . '/#business'], 'areaServed' => CITY, 'url' => SITE_URL . '/services.php#' . $s['slug']],
        ], $services, array_keys($services)),
    ];
}

function print_schema(array $schemas): void {
    foreach ($schemas as $s) {
        echo '<script type="application/ld+json">' . json_encode($s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "</script>\n";
    }
}
