<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';
include 'includes/data.php';

$title = 'Moving FAQs | Packers and Movers in ' . CITY . ' | ' . SITE_NAME;
$desc  = 'Answers to common questions about moving prices, packing material, intercity moves, booking and protecting your furniture with ' . SITE_NAME . ' in ' . CITY . '.';
$path  = '/faq.php';
$page  = 'faq';
$banner = ['title' => 'Frequently asked questions', 'lead' => 'Straight answers before you book.', 'crumb' => 'FAQ', 'theme' => 2, 'truck' => 1];
$schemas = [schema_business(), schema_breadcrumbs([['Home', '/'], ['FAQ', $path]]), schema_faq($FAQS)];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section" aria-label="Questions and answers">
  <div class="wrap faq">
    <div class="faq__intro">
      <h2 class="h2" data-reveal>Good to know before you move</h2>
      <p data-reveal data-delay="1">Still unsure about something? Call us and we will talk it through.</p>
      <div class="btnrow" data-reveal data-delay="2"><a class="btn btn--mag" href="tel:<?= h(PHONE_LINK) ?>"><svg class="ico"><use href="#i-phone"/></svg><?= h(PHONE_DISPLAY) ?></a><a class="textlink" href="contact.php">Send a message</a></div>
    </div>
    <div class="acc" data-accordion>
      <?php foreach ($FAQS as $i => $f): ?>
      <div class="acc__item <?= $i === 0 ? 'is-open' : '' ?>" data-reveal data-delay="<?= $i % 3 ?>">
        <button class="acc__btn" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"><?= h($f[0]) ?><span class="acc__ico" style="color: black";><svg  class="ico"><use href="#i-plus"/></svg></span></button>
        <div class="acc__panel"><div><p><?= h($f[1]) ?></p></div></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
