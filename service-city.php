<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';
include 'includes/data.php';
require_once 'includes/city-pages.php';

$svc  = find_service($_GET['service'] ?? '');
$city = find_city($_GET['city'] ?? '');

if (!$svc || !$city) {                               // unknown address: friendly 404 that Google will not index
    http_response_code(404);
    $title = 'Page not found | ' . SITE_NAME; $desc = 'This page could not be found.';
    $path = '/services.php'; $page = 'services'; $robots = 'noindex, follow';
    $banner = ['title' => 'Page not found', 'lead' => 'The page you are looking for does not exist.', 'crumb' => 'Not found', 'theme' => 3, 'truck' => 3];
    include 'includes/header.php';
    include 'includes/page-banner.php';
    echo '<section class="section"><div class="wrap"><p class="note">Try our <a class="textlink" href="services.php">services page</a>.</p></div></section>';
    include 'includes/footer.php';
    exit;
}

$h1     = city_page_title($svc, $city);
$k      = svc_copy($svc['slug']);
$path   = '/' . city_page_url($svc['slug'], $city);
$page   = 'services';
$title  = $h1 . ' | ' . SITE_NAME;
$desc   = 'Professional ' . $k['phrase'] . ' in ' . $city . ' by ' . SITE_NAME . ': trained crew, own vehicles and a fixed price. Get a free quote today.';
$ogImage = '/assets/img/' . $svc['img'];
$idx    = array_search($svc['slug'], array_column($SERVICES, 'slug'), true);
$banner = ['title' => $h1, 'lead' => 'Trained crew, own vehicles and a fixed price.', 'crumb' => city_page_label($svc, $city), 'theme' => [1, 2, 3][$idx % 3], 'truck' => [1, 2, 3][($idx + 1) % 3]];
$blocks = city_page_blocks($svc, $city);
$faqs   = city_page_faqs($svc, $city);
$schemas = [
    schema_business(),
    schema_breadcrumbs([['Home', '/'], ['Services', '/services.php'], [$h1, $path]]),
    ['@context' => 'https://schema.org', '@type' => 'Service', 'name' => $h1, 'serviceType' => title_case($svc['name']), 'description' => $desc,
     'provider' => ['@id' => SITE_URL . '/#business'], 'areaServed' => ['@type' => 'City', 'name' => $city], 'url' => SITE_URL . $path],
    schema_faq($faqs),
];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section" aria-label="<?= h($h1) ?>">
  <div class="wrap spage">

    <article class="spage__main">
      <div class="spage__cover" data-reveal="zoom"><img src="assets/img/<?= h($svc['img']) ?>" alt="<?= h($svc['alt']) ?>" width="960" height="720"></div>
      <div class="prose">
        <?php foreach ($blocks as $b): ?>
          <?php if ($b[0] === 'p'): ?><p data-reveal><?= h($b[1]) ?></p>
          <?php elseif ($b[0] === 'h'): ?><h2 data-reveal><?= h($b[1]) ?></h2>
          <?php elseif ($b[0] === 'ul'): ?><ul data-reveal><?php foreach ($b[1] as $li): ?><li><?= h($li) ?></li><?php endforeach; ?></ul>
          <?php elseif ($b[0] === 'img'): ?><div class="spage__img2" data-reveal="zoom"><img src="assets/img/<?= h($b[1]) ?>" alt="<?= h(title_case($svc['name']) . ' team and truck in ' . $city) ?>" width="960" height="720" loading="lazy"></div>
          <?php elseif ($b[0] === 'links'): ?>
            <p data-reveal>We also offer <?= h(svc_copy($b[1])['phrase']) ?> in
              <?php $others = array_values(array_filter(CITIES, fn($c) => $c !== $b[2])); foreach ($others as $i => $c): ?><a class="textlink" href="<?= h(city_page_url($b[1], $c)) ?>"><?= h($c) ?></a><?= $i < count($others) - 1 ? ', ' : '.' ?><?php endforeach; ?></p>
          <?php endif; ?>
        <?php endforeach; ?>

        <h2 data-reveal>Frequently Asked Questions</h2>
      </div>
      <div class="acc" data-accordion>
        <?php foreach ($faqs as $i => $f): ?>
        <div class="acc__item <?= $i === 0 ? 'is-open' : '' ?>" data-reveal>
          <button class="acc__btn" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"><?= h($f[0]) ?><span class="acc__ico"><svg class="ico"><use href="#i-plus"/></svg></span></button>
          <div class="acc__panel"><div><p><?= h($f[1]) ?></p></div></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="prose">
        <h2 data-reveal>Contact <?= h(SITE_NAME) ?></h2>
        <p data-reveal>If you need reliable <?= h($k['phrase']) ?> in <?= h($city) ?>, <?= h(SITE_NAME) ?> is ready to help with professional service and a fixed price.</p>
        <p data-reveal><strong>Address:</strong> <?= h(ADDRESS) ?><br><strong>Phone:</strong> <a class="textlink" href="tel:<?= h(PHONE_LINK) ?>"><?= h(PHONE_DISPLAY) ?></a><br><strong>WhatsApp:</strong> <a class="textlink" href="https://wa.me/<?= h(WA_NUMBER) ?>" target="_blank" rel="noopener">Message us</a><br><strong>Email:</strong> <a class="textlink" href="mailto:<?= h(EMAIL) ?>"><?= h(EMAIL) ?></a></p>
      </div>
    </article>

    <aside class="sbar" aria-label="Related pages and contact">
      <nav class="sbox" aria-label="Other services in <?= h($city) ?>">
        <h2>Other services in <?= h($city) ?></h2>
        <ul>
          <?php foreach ($SERVICES as $o): if ($o['slug'] === $svc['slug']) continue; ?>
          <li><a href="<?= h(city_page_url($o['slug'], $city)) ?>"><?= h(city_page_label($o, $city)) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
      <nav class="sbox" aria-label="<?= h(title_case($svc['name'])) ?> in other cities">
        <h2><?= h(title_case($svc['name'])) ?> in other cities</h2>
        <ul>
          <?php foreach (array_slice(array_values(array_filter(CITIES, fn($c) => $c !== $city)), 0, 7) as $c): ?>
          <li><a href="<?= h(city_page_url($svc['slug'], $c)) ?>"><?= h(city_page_label($svc, $c)) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>
      <div class="sbox sbox--cta">
        <h2>Contact us</h2>
        <p>If you have any question about our service, please contact us.</p>
        <ul class="sbox__list">
          <li><svg class="ico"><use href="#i-phone"/></svg><a href="tel:<?= h(PHONE_LINK) ?>"><?= h(PHONE_DISPLAY) ?></a></li>
          <li><svg class="ico"><use href="#i-pin"/></svg><span><?= h(ADDRESS) ?></span></li>
          <li><svg class="ico"><use href="#i-mail"/></svg><a href="mailto:<?= h(EMAIL) ?>"><?= h(EMAIL) ?></a></li>
        </ul>
        <a class="btn btn--white" href="tel:<?= h(PHONE_LINK) ?>"><svg class="ico"><use href="#i-phone"/></svg>Call now</a>
        <a class="sbox__quote" href="contact.php">Or get a free quote</a>
      </div>
    </aside>

  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
