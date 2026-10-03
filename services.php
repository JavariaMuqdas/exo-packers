<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';

$title = 'Moving Services in ' . CITY . ' | House, Office & Goods Shifting | ' . SITE_NAME;
$desc  = 'House shifting, office shifting, packing and unpacking, goods transport, loading and a car carrier in ' . CITY . '. Trained crew, fixed price, free quote from ' . SITE_NAME . '.';
$path  = '/services.php';
$page  = 'services';
$banner = ['title' => 'Our moving services', 'lead' => 'One team for the whole move, from the first box to the last.', 'crumb' => 'Services', 'theme' => 1, 'truck' => 1];
include 'includes/data.php';
$schemas = [schema_business(), schema_breadcrumbs([['Home', '/'], ['Services', $path]]), schema_services($SERVICES)];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section" aria-label="Services">
  <div class="wrap srows">
    <?php foreach ($SERVICES as $i => $sv): ?>
    <article class="srow <?= $i % 2 ? 'srow--rev' : '' ?>" id="<?= h($sv['slug']) ?>">
      <div class="srow__img" data-reveal="<?= $i % 2 ? 'right' : 'left' ?>">
        <img src="assets/img/<?= h($sv['img']) ?>" alt="<?= h($sv['alt']) ?>" width="960" height="720" loading="lazy">
        <span class="svc__ico"><svg class="ico"><use href="#<?= h($sv['icon']) ?>"/></svg></span>
      </div>
      <div class="srow__text">
        <h2 class="h2 h2--sm" data-reveal><?= h($sv['name']) ?></h2>
        <p data-reveal data-delay="1"><?= h($sv['long']) ?></p>
        <ul class="ticks" data-reveal data-delay="2">
          <?php foreach ($sv['points'] as $pt): ?><li><svg class="ico"><use href="#i-check"/></svg><?= h($pt) ?></li><?php endforeach; ?>
        </ul>
        <div data-reveal data-delay="3"><a class="btn btn--mag" href="contact.php">Get a quote <span class="btn__arrow"><svg class="ico"><use href="#i-arrow"/></svg></span></a></div>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
