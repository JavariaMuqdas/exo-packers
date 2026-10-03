<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';

$title = 'About Us | Trusted Packers and Movers in ' . CITY . ' | ' . SITE_NAME;
$desc  = 'Learn about ' . SITE_NAME . ': a trained moving crew, our own vehicles and fixed prices for house shifting, office relocation and goods transport in ' . CITY . '.';
$path  = '/about.php';
$page  = 'about';
$banner = ['title' => 'About Exo Packers and Movers', 'lead' => 'A careful crew, our own trucks and a price you can trust.', 'crumb' => 'About', 'theme' => 2, 'truck' => 2];
$schemas = [schema_business(), schema_breadcrumbs([['Home', '/'], ['About', $path]])];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<!-- ============ STORY ============ -->
<section class="section about" aria-labelledby="story-title">
  <div class="wrap about__grid">
    <div class="about__media">
      <div class="about__img about__img--a" data-reveal="left"><img src="https://onewaygoods.pk/wp-content/uploads/al_opt_content/IMAGE/onewaygoods.pk/wp-content/uploads/2021/01/One-way-goods-in-lahore.jpg.bv.webp?bv_host=onewaygoods.pk" alt="Exo movers carrying a sofa beside a decorated moving truck" width="960" height="720" loading="lazy" data-parallax="0.06" data-scale="1.08"> alt="Exo movers carrying a sofa beside a decorated moving truck" width="960" height="720" loading="lazy"></div>
      <div class="about__img about__img--b" data-reveal="zoom" data-delay="2"><img src="assets/img/about2.png" alt="Packed cartons ready to load on an Exo Mazda truck" width="640" height="640" loading="lazy"></div>
      <!-- SAMPLE NUMBER: replace 10 with your real years of experience -->
      <div class="about__years" data-reveal="zoom" data-delay="3"><strong>10+</strong><span>Years of moving experience</span></div>
    </div>
    <div class="about__text">
      <h2 class="h2" id="story-title" data-reveal>Who we are</h2>
      <!-- Replace with your own story: when you started, why, what makes you different -->
      <p data-reveal data-delay="1">Exo Packers and Movers started with a simple idea: moving should not be stressful. We built a crew that handles furniture like it is their own, and a fleet of trucks that arrive when we say they will.</p>
      <p data-reveal data-delay="1">Today we move homes, offices and goods across <?= h(CITY) ?> and between major cities, with a price agreed before we start and no surprises on the day.</p>
      <ul class="ticks" data-reveal data-delay="2">
        <li><svg class="ico"><use href="#i-check"/></svg>Trained crew, not casual labour</li>
        <li><svg class="ico"><use href="#i-check"/></svg>Our own trucks and drivers</li>
        <li><svg class="ico"><use href="#i-check"/></svg>Fixed price, agreed in advance</li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ VALUES ============ -->
<section class="section section--mist" aria-labelledby="values-title">
  <div class="wrap">
    <div class="head head--center" data-reveal>
      <h2 class="h2" id="values-title">What we stand for</h2>
    </div>
    <div class="vals">
      <article class="val" data-reveal><svg class="ico"><use href="#i-shield"/></svg><h3>Careful handling</h3><p>Every item is wrapped, padded and strapped before it moves.</p></article>
      <article class="val" data-reveal data-delay="1"><svg class="ico"><use href="#i-price"/></svg><h3>Honest pricing</h3><p>One clear quote up front. The price on the phone is the price you pay.</p></article>
      <article class="val" data-reveal data-delay="2"><svg class="ico"><use href="#i-time"/></svg><h3>On-time service</h3><p>We arrive when we say, and we plan the route before we leave.</p></article>
      <article class="val" data-reveal data-delay="3"><svg class="ico"><use href="#i-crew"/></svg><h3>Respectful crew</h3><p>Polite, trained people who treat your home and your goods with respect.</p></article>
    </div>
  </div>
</section>

<!-- ============ NUMBERS ============ -->
<!-- SAMPLE NUMBERS: replace with your real figures -->
<section class="why px" aria-labelledby="nums-title">
  <div class="px__bg" data-parallax="0.18" style="background-image:url('assets/img/cta-bg.jpg')"></div>
  <div class="wrap why__grid">
    <div class="why__text">
      <h2 class="h2" id="nums-title" data-reveal>Moving people with confidence</h2>
      <p data-reveal data-delay="1">A few numbers about the work we do every day.</p>
    </div>
    <dl class="counters">
      <div data-reveal="zoom"><dt><span data-count="1500">0</span><em>+</em></dt><dd>Moves completed</dd></div>
      <div data-reveal="zoom" data-delay="1"><dt><span data-count="12">0</span></dt><dd>Cities covered</dd></div>
      <div data-reveal="zoom" data-delay="2"><dt><span data-count="25">0</span><em>+</em></dt><dd>Vehicles on the road</dd></div>
      <div data-reveal="zoom" data-delay="3"><dt><span data-count="98">0</span><em>%</em></dt><dd>Customers who would book again</dd></div>
    </dl>
  </div>
</section>

<!-- ============ PROCESS ============ -->
<section class="section" aria-labelledby="proc-title">
  <div class="wrap">
    <div class="head head--center" data-reveal>
      <h2 class="h2" id="proc-title">How we work</h2>
      <p>Four simple steps from first call to final box.</p>
    </div>
    <ol class="steps" data-steps>
      <li class="step" data-reveal><span class="step__no">1</span><h3>Call or message</h3><p>Tell us what you are moving and where.</p></li>
      <li class="step" data-reveal data-delay="1"><span class="step__no">2</span><h3>Get a fixed price</h3><p>One clear quote before we begin.</p></li>
      <li class="step" data-reveal data-delay="2"><span class="step__no">3</span><h3>We pack and load</h3><p>Our crew arrives on time and loads safely.</p></li>
      <li class="step" data-reveal data-delay="3"><span class="step__no">4</span><h3>Delivered and set up</h3><p>We unload and place everything for you.</p></li>
    </ol>
  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
