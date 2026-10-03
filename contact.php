<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';

$title = 'Contact Us | Free Moving Quote in ' . CITY . ' | ' . SITE_NAME;
$desc  = 'Call, WhatsApp or send a message to ' . SITE_NAME . ' for a free moving quote in ' . CITY . '. We reply within the hour during working hours.';
$path  = '/contact.php';
$page  = 'contact';
$banner = ['title' => 'Contact us', 'lead' => 'Tell us about your move and get a free quote.', 'crumb' => 'Contact', 'theme' => 1, 'truck' => 2];
$schemas = [schema_business(), schema_breadcrumbs([['Home', '/'], ['Contact', $path]]),
  ['@context' => 'https://schema.org', '@type' => 'ContactPage', 'name' => 'Contact ' . SITE_NAME, 'url' => SITE_URL . $path]];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section section--mist" aria-label="Contact details and quote form">
  <div class="wrap cpage">
    <div class="cinfo">
      <h2 class="h2 h2--sm" data-reveal>Get in touch</h2>
      <p data-reveal data-delay="1">Choose the way that is easiest for you. We are happy to answer questions before you book.</p>
      <ul class="clist">
        <li data-reveal data-delay="1"><span class="clist__ico"><svg class="ico"><use href="#i-phone"/></svg></span><div><small>Call us</small><a href="tel:<?= h(PHONE_LINK) ?>"><?= h(PHONE_DISPLAY) ?></a></div></li>
        <li data-reveal data-delay="2"><span class="clist__ico"><svg class="ico"><use href="#i-chat"/></svg></span><div><small>WhatsApp</small><a href="https://wa.me/<?= h(WA_NUMBER) ?>" target="_blank" rel="noopener">Message us</a></div></li>
        <li data-reveal data-delay="3"><span class="clist__ico"><svg class="ico"><use href="#i-mail"/></svg></span><div><small>Email</small><a href="mailto:<?= h(EMAIL) ?>"><?= h(EMAIL) ?></a></div></li>
        <li data-reveal data-delay="1"><span class="clist__ico"><svg class="ico"><use href="#i-pin"/></svg></span><div><small>Office</small><span><?= h(ADDRESS) ?></span></div></li>
        <li data-reveal data-delay="2"><span class="clist__ico"><svg class="ico"><use href="#i-clock"/></svg></span><div><small>Working hours</small><span><?= h(HOURS) ?></span></div></li>
      </ul>
    </div>

    <form class="qform" action="actions/send-quote.php" method="post" data-reveal="right">
      <h2 class="qform__title">Request a free quote</h2>
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="source" value="contact-page">
      <div class="qform__row">
        <label class="f"><span>Your name</span><input name="name" type="text" required autocomplete="name"></label>
        <label class="f"><span>Phone number</span><input name="phone" type="tel" required autocomplete="tel"></label>
      </div>
      <div class="qform__row">
        <label class="f"><span>Moving from</span><input name="from" type="text" placeholder="City or area"></label>
        <label class="f"><span>Moving to</span><input name="to" type="text" placeholder="City or area"></label>
      </div>
      <div class="qform__row">
        <label class="f"><span>Service</span>
          <select name="service"><option>House shifting</option><option>Office shifting</option><option>Goods transport</option><option>Car carrier</option><option>Packing only</option></select>
        </label>
        <label class="f"><span>Preferred date</span><input name="date" type="date"></label>
      </div>
      <label class="f"><span>Anything we should know?</span><textarea name="message" rows="3"></textarea></label>
      <button class="btn btn--block" type="submit">Send my request <span class="btn__arrow"><svg class="ico"><use href="#i-arrow"/></svg></span></button>
    </form>
  </div>
</section>

<?php if (MAP_EMBED_URL): ?>
<section class="map" aria-label="Our location">
  <iframe src="<?= h(MAP_EMBED_URL) ?>" title="<?= h(SITE_NAME) ?> location map" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
