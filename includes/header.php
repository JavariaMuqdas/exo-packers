<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/city-pages.php';

$title    = $title    ?? SITE_NAME;
$desc     = $desc     ?? 'Packers and movers for house shifting, office relocation and goods transport. Get a free quote from ' . SITE_NAME . '.';
$path     = $path     ?? '/';
$page     = $page     ?? '';
$ogImage  = $ogImage  ?? '/assets/img/og-image.jpg';
$robots   = $robots   ?? 'index, follow, max-image-preview:large';
$schemas  = $schemas  ?? [schema_business(), schema_website()];
$canonical = SITE_URL . $path;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($title) ?></title>
  <meta name="description" content="<?= h($desc) ?>">
  <meta name="robots" content="<?= h($robots) ?>">
  <link rel="canonical" href="<?= h($canonical) ?>">
  <meta name="theme-color" content="#060606">

  <!-- Social sharing -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= h(SITE_NAME) ?>">
  <meta property="og:title" content="<?= h($title) ?>">
  <meta property="og:description" content="<?= h($desc) ?>">
  <meta property="og:url" content="<?= h($canonical) ?>">
  <meta property="og:image" content="<?= h(SITE_URL . $ogImage) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="en_PK">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= h($title) ?>">
  <meta name="twitter:description" content="<?= h($desc) ?>">
  <meta name="twitter:image" content="<?= h(SITE_URL . $ogImage) ?>">
  <meta name="geo.region" content="PK">

  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link rel="apple-touch-icon" href="assets/img/favicon.png">
  <?php if (!empty($preload)): ?>
    <link rel="preload" as="image" href="<?= h($preload) ?>" fetchpriority="high">
  <?php endif; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
    /* Marks that JS is on, so animated elements can start hidden. Fallback shows everything if the script fails. */
    document.documentElement.classList.add('js');
    window.__t = setTimeout(function() {
      document.documentElement.classList.add('no-anim');
    }, 5000);
  </script>
  <?php print_schema($schemas); ?>
</head>

<body>

  <svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <defs>
      <symbol id="i-home" viewBox="0 0 24 24">
        <path d="M3 11l9-8 9 8M5 10v10h5v-6h4v6h5V10" />
      </symbol>
      <symbol id="i-building" viewBox="0 0 24 24">
        <path d="M4 21V4h10v17M14 9h6v12M8 8h2M8 12h2M8 16h2M3 21h18" />
      </symbol>
      <symbol id="i-box" viewBox="0 0 24 24">
        <path d="M3 7l9-4 9 4v10l-9 4-9-4zM3 7l9 4 9-4M12 11v10" />
      </symbol>
      <symbol id="i-lift" viewBox="0 0 24 24">
        <path d="M5 20h14M12 16V4M7 9l5-5 5 5" />
      </symbol>
      <symbol id="i-truck" viewBox="0 0 24 24">
        <path d="M2 6h12v10H2zM14 10h4l3 3v3h-7M6.5 19a2 2 0 100-4 2 2 0 000 4zM17.5 19a2 2 0 100-4 2 2 0 000 4z" />
      </symbol>
      <symbol id="i-car" viewBox="0 0 24 24">
        <path d="M3 15l2-6h14l2 6v3H3zM7 18v2M17 18v2M7 13h.01M17 13h.01" />
      </symbol>
      <symbol id="i-phone" viewBox="0 0 24 24">
        <path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z" />
      </symbol>
      <symbol id="i-pin" viewBox="0 0 24 24">
        <path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11zM12 12a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
      </symbol>
      <symbol id="i-clock" viewBox="0 0 24 24">
        <path d="M12 7v5l3 2M12 21a9 9 0 100-18 9 9 0 000 18z" />
      </symbol>
      <symbol id="i-check" viewBox="0 0 24 24">
        <path d="M5 12.5l4.5 4.5L19 7" />
      </symbol>
          <symbol id="i-chev" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></symbol>
      <symbol id="i-arrow" viewBox="0 0 24 24">
        <path d="M5 12h14M13 6l6 6-6 6" />
      </symbol>
      <symbol id="i-up-right" viewBox="0 0 24 24">
        <path d="M7 17L17 7M8 7h9v9" />
      </symbol>
      <symbol id="i-down" viewBox="0 0 24 24">
        <path d="M12 5v14M6 13l6 6 6-6" />
      </symbol>
      <symbol id="i-chat" viewBox="0 0 24 24">
        <path d="M21 12a8 8 0 01-11.6 7.1L4 20l1-4.6A8 8 0 1121 12z" />
      </symbol>
      <symbol id="i-mail" viewBox="0 0 24 24">
        <path d="M3 6h18v12H3zM3 7l9 7 9-7" />
      </symbol>
      <symbol id="i-plus" viewBox="0 0 24 24">
        <path d="M12 5v14M5 12h14" />
      </symbol>
      <symbol id="i-price" viewBox="0 0 24 24">
        <path d="M12 3v18M16.5 7.5C16 6 14.2 5 12 5c-2.4 0-4 1.2-4 3 0 4.5 8.5 2 8.5 7 0 1.8-1.8 3-4.5 3-2.3 0-4.2-1-4.8-2.6" />
      </symbol>
      <symbol id="i-crew" viewBox="0 0 24 24">
        <path d="M9 11a3.5 3.5 0 100-7 3.5 3.5 0 000 7zM2.5 20c.5-3.5 3-5.5 6.5-5.5s6 2 6.5 5.5M16 4.5a3.2 3.2 0 010 6.2M17.5 14.7c2.2.5 3.7 2.3 4 5.3" />
      </symbol>
      <symbol id="i-time" viewBox="0 0 24 24">
        <path d="M12 21a9 9 0 100-18 9 9 0 000 18zM12 7v5l3.5 2M9 2h6" />
      </symbol>
      <symbol id="i-shield" viewBox="0 0 24 24">
        <path d="M12 3l8 3v6c0 4.5-3.2 8-8 9-4.8-1-8-4.5-8-9V6zM8.5 12l2.5 2.5 4.5-5" />
      </symbol>
      <symbol id="i-star" viewBox="0 0 24 24">
        <path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z" fill="currentColor" stroke="none" />
      </symbol>
      <symbol id="i-tw" viewBox="0 0 24 24">
        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
      </symbol>
      <symbol id="i-in" viewBox="0 0 24 24">
        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z" />
      </symbol>
      <symbol id="i-g" viewBox="0 0 24 24">
        <path d="M17.1 6.9A7.2 7.2 0 1019.2 12H12" />
      </symbol>
      <symbol id="i-fb" viewBox="0 0 24 24">
        <path d="M14 8h3V4h-3a4 4 0 00-4 4v2H7v4h3v6h4v-6h3l1-4h-4V8z" />
      </symbol>
      <symbol id="i-ig" viewBox="0 0 24 24">
        <rect x="3" y="3" width="18" height="18" rx="5" />
        <circle cx="12" cy="12" r="4" />
        <path d="M17.5 6.5h.01" />
      </symbol>
      <symbol id="i-yt" viewBox="0 0 24 24">
        <rect x="2.5" y="5.5" width="19" height="13" rx="4" />
        <path d="M10 9.5l5 2.5-5 2.5z" />
      </symbol>
    </defs>
  </svg>

  <a class="skip" href="#main">Skip to content</a>

  <!-- Top info bar -->
  <div class="topbar" id="topbar">
    <div class="topbar__in">
      <ul class="topbar__info">
        <li><svg class="ico">
            <use href="#i-pin" />
          </svg><span><?= h(ADDRESS) ?></span></li>
        <li><svg class="ico">
            <use href="#i-phone" />
          </svg>
          <a href="tel:<?= h(PHONE_LINK) ?>"><?= h(PHONE_DISPLAY) ?></a><?php if (ALT_PHONE_DISPLAY): ?><em class="topbar__alt"> / <a href="tel:<?= h(ALT_PHONE_LINK) ?>"><?= h(ALT_PHONE_DISPLAY) ?></a></em><?php endif; ?>
        </li>
        <li class="topbar__hours"><svg class="ico">
            <use href="#i-clock" />
          </svg><span><?= h(HOURS) ?></span></li>
      </ul>
      <div class="topbar__social">
      <?php foreach ([['Facebook', FACEBOOK_URL, 'i-fb'], ['Twitter', TWITTER_URL, 'i-tw'], ['LinkedIn', LINKEDIN_URL, 'i-in'], ['Instagram', INSTAGRAM_URL, 'i-ig'], ['YouTube', YOUTUBE_URL, 'i-yt']] as $soc):
        if (in_array($soc[0], ['Instagram', 'YouTube'], true) && !$soc[1]) continue; ?>
      <a href="<?= h($soc[1] ?: '#') ?>"<?= $soc[1] ? ' target="_blank" rel="noopener"' : '' ?> aria-label="<?= h($soc[0]) ?>"><svg class="ico"><use href="#<?= $soc[2] ?>"/></svg></a>
      <?php endforeach; ?>

        <a href="https://wa.me/<?= h(WA_NUMBER) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg class="ico">
            <use href="#i-chat" />
          </svg></a>
        <a class="topbar__mail" href="mailto:<?= h(EMAIL) ?>" aria-label="Email us"><svg class="ico">
            <use href="#i-mail" />
          </svg></a>
      </div>
    </div>
  </div>

  <header class="site-nav" id="siteNav">
    <div class="bar">
      <a class="bar__logo" href="index.php" aria-label="<?= h(SITE_NAME) ?> home">
        <img src="assets/img/logo-dark.png" alt="<?= h(SITE_NAME) ?> logo" width="104" height="68">
      </a>

      <nav class="nav" id="nav" aria-label="Main">
        <div class="nav__links">
          <a href="index.php" class="nav__link <?= $page === 'home' ? 'is-active' : '' ?>">Home</a>
          <a href="about.php" class="nav__link <?= $page === 'about' ? 'is-active' : '' ?>">About</a>

        <div class="nav__drop">
          <a href="services.php" class="nav__link <?= $page === 'services' ? 'is-active' : '' ?>">Services <svg class="ico nav__chev" aria-hidden="true"><use href="#i-chev"/></svg></a>
          <button class="nav__tg" type="button" aria-label="Show services menu" aria-expanded="false"><svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></button>
          <div class="mega">
            <ul class="mega__l">
              <?php foreach ($SERVICES as $sv): ?>
              <li class="mega__item">
                <a href="services.php#<?= h($sv['slug']) ?>"><?= h($sv['name']) ?> <svg class="ico" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                <button class="mega__tg" type="button" aria-label="Show <?= h($sv['name']) ?> cities" aria-expanded="false"><svg class="ico" aria-hidden="true"><use href="#i-plus"/></svg></button>
                <ul class="mega__r">
                  <?php foreach (array_slice(CITIES, 0, 8) as $c): ?>
                  <li><a href="<?= h(city_page_url($sv['slug'], $c)) ?>"><?= h(city_page_label($sv, $c)) ?></a></li>
                  <?php endforeach; ?>
                  <li class="mega__all"><a href="services.php#<?= h($sv['slug']) ?>">All <?= h(strtolower($sv['name'])) ?> services</a></li>
                </ul>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
          <a href="blog.php" class="nav__link <?= $page === 'contact' ? 'is-active' : '' ?>">Blog</a>
          <a href="fleets.php" class="nav__link <?= $page === 'fleets' ? 'is-active' : '' ?>">Vehicles</a>
          <a href="contact.php" class="nav__link <?= $page === 'contact' ? 'is-active' : '' ?>">Contact</a>
        </div>
        <a class="nav__phone" href="tel:<?= h(PHONE_LINK) ?>"><svg class="ico">
            <use href="#i-phone" />
          </svg><?= h(PHONE_DISPLAY) ?></a>
      </nav>

      <a class="btn bar__cta" href="contact.php">Get a free quote <span class="btn__arrow"><svg class="ico">
            <use href="#i-arrow" />
          </svg></span></a>
      <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><span></span><span></span></button>
    </div>
  </header>

  <main id="main">