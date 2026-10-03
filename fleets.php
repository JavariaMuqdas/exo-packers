<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';

$title = 'Moving Trucks & Vehicles in ' . CITY . ' | Pickups, Containers, Flatbeds | ' . SITE_NAME;
$desc  = 'Choose from pickups, Mazda and Shehzore trucks, 20 ft and 40 ft containers and flatbeds. ' . SITE_NAME . ' has the right vehicle for every move in ' . CITY . '.';
$path  = '/fleets.php';
$page  = 'fleets';
$banner = ['title' => 'Our vehicles', 'lead' => 'The right truck for every load, from a pickup to a 40 ft container.', 'crumb' => 'Vehicles', 'theme' => 3, 'truck' => 3];
include 'includes/data.php';
$schemas = [schema_business(), schema_breadcrumbs([['Home', '/'], ['Vehicles', $path]])];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section" aria-label="Vehicles">
  <div class="wrap">
    <div class="vgrid">
      <?php foreach ($FLEET as $i => $f): ?>
      <article class="vitem" data-reveal data-delay="<?= $i % 3 ?>">
        <div class="vitem__img"><img src="assets/img/<?= h($f['img']) ?>" alt="<?= h($f['alt']) ?>" width="960" height="720" loading="lazy"><span class="vcard__cap"><?= h($f['cap']) ?></span></div>
        <div class="vitem__body">
          <h2 class="h3"><?= h($f['name']) ?></h2>
          <p><?= h($f['desc']) ?></p>
          <p class="vitem__best"><svg class="ico"><use href="#i-check"/></svg>Best for: <?= h($f['best']) ?></p>
          <a class="svc__link" href="contact.php">Book this vehicle <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <p class="note" data-reveal>Not sure which vehicle you need? Tell us what you are moving and we will choose the right one for you.</p>
  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
