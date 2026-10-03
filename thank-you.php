<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';

$title  = 'Thank you | ' . SITE_NAME;
$desc   = 'Thank you for contacting ' . SITE_NAME . '. We will reply within the hour during working hours.';
$path   = '/thank-you.php';
$page   = 'contact';
$robots = 'noindex, follow';
$banner = ['title' => 'Thank you!', 'lead' => 'Your request has been sent.', 'crumb' => 'Thank you', 'theme' => 1, 'truck' => 2];
$schemas = [schema_business()];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section" aria-label="Thank you">
  <div class="wrap">
    <div class="head head--center" data-reveal>
      <h2 class="h2">We got your message</h2>
      <p>Our team will call or message you within the hour during working hours (<?= h(HOURS) ?>). For anything urgent, call us now.</p>
    </div>
    <div class="btnrow" style="justify-content:center" data-reveal data-delay="1">
      <a class="btn btn--mag" href="tel:<?= h(PHONE_LINK) ?>"><svg class="ico"><use href="#i-phone"/></svg><?= h(PHONE_DISPLAY) ?></a>
      <a class="textlink" href="index.php">Back to the home page</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
