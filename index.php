<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';
require_once 'includes/article-card.php';

$title   = 'Packers and Movers in ' . CITY . ' | House Shifting & Goods Transport | ' . SITE_NAME;
$desc    = 'Trusted packers and movers in ' . CITY . '. House shifting, office relocation, packing and goods transport with trained crews, your own fixed price and free quotes. Call today.';
$path    = '/';
$page    = 'home';

include 'includes/data.php';
$faqs = $FAQS;   /* edit the FAQ text in includes/data.php */

$schemas = [schema_business(), schema_website(), schema_faq($faqs)];
include 'includes/header.php';
?>

<!-- ================= HERO (framed card + animated truck scene) ================= -->
<div class="top" id="top">
  <div class="top__card">
    <section class="stage" id="stage" data-s="1" aria-roledescription="carousel" aria-label="Featured services">

      <!-- sky, sun/moon, clouds -->
      <div class="sky sky--1"></div>
      <div class="sky sky--2"></div>
      <div class="sky sky--3">
        <div class="stars"></div>
      </div>
      <div class="orb"></div>
     

      <!-- moving landscape -->
      <div class="land" aria-hidden="true">
        <div class="layer layer--mountains"></div>
        <div class="layer layer--hills"><img src="assets/svg/layer-hills.svg" alt="" width="1600" height="260"><img src="assets/svg/layer-hills.svg" alt="" width="1600" height="260"></div>
        <div class="layer layer--near"><img src="assets/svg/layer-near.svg" alt="" width="1600" height="210"><img src="assets/svg/layer-near.svg" alt="" width="1600" height="210"></div>
        <div class="road"><i></i></div>
        <div class="tint"></div>
      </div>

      <!-- the trucks (inline SVG so the wheels can spin) -->
      <?php
      /* HERO TRUCK IMAGE: paste your image URL, or a local path like 'assets/img/truck.png' */
     $truckImg  = 'assets/img/truck1.png';
      $truckFlip = false;   // set to true if the truck in your image faces LEFT
      ?>
      <div class="rigs">
        <?php foreach ([1, 2, 3] as $n): ?>
          <div class="rig rig--real rig--<?= $n ?><?= $n === 1 ? ' is-in' : '' ?>" <?= $n > 1 ? ' aria-hidden="true"' : '' ?>>
            <span class="truck__sway"><span class="truck__real<?= $truckFlip ? ' is-flip' : '' ?>"><img class="truck__photo" src="<?= h($truckImg) ?>" alt="<?= $n === 1 ? 'Exo Packers and Movers truck driving on the road' : '' ?>" width="1400" height="700"></span></span>
            <span class="streaks" aria-hidden="true"><i></i><i></i><i></i></span>
            <span class="dust"><i></i><i></i><i></i></span>
          </div>
        <?php endforeach; ?>
      </div>
      

      <!-- text -->
      <div class="stage__content">
        <p class="chip"><i></i>Free quote within the hour</p>
        <div class="hslides" id="hslides">
          <div class="hslide is-active" data-title="Packers and movers" aria-label="1 of 3">
            <h1 class="hslide__title" data-words>Packers and Movers in <?= h(CITY) ?></h1>
            <p class="hslide__lead">Safe house shifting, office relocation and goods transport. Trained crew, own vehicles and a fixed price.</p>
            <div class="hslide__actions">
              <a style="color: whitesmoke;" class="btn btn--mag" href="contact.php">Get a free quote</a>
              <a class="btn-circle" href="contact.php" aria-label="Go to the contact page"><svg class="ico">
                  <use href="#i-up-right" />
                </svg></a>
            </div>
          </div>
          <div class="hslide" data-title="House shifting" aria-label="2 of 3">
            <p class="hslide__title" data-words>House shifting without the stress</p>
            <p class="hslide__lead">From a single room to a full house, we pack, load, move and set everything up for you.</p>
            <div class="hslide__actions">
              <a style="color:white" class="btn btn--mag" href="services.php">See our services</a>
              <a class="btn-circle" href="services.php" aria-label="Go to the services page"><svg class="ico">
                  <use href="#i-up-right" />
                </svg></a>
            </div>
          </div>
          <div class="hslide" data-title="Goods transport" aria-label="3 of 3">
            <p class="hslide__title" data-words>Goods transport across Pakistan</p>
            <p class="hslide__lead">Pickups, container trucks and flatbeds for city and intercity deliveries, on time.</p>
            <div class="hslide__actions">
              <a style="color:white" class="btn btn--mag" href="fleets.php">View our vehicles</a>
              <a class="btn-circle" href="fleets.php" aria-label="Go to the vehicles page"><svg class="ico">
                  <use href="#i-up-right" />
                </svg></a>
            </div>
          </div>
        </div>
        <ol class="dots" id="heroDots" aria-label="Choose slide">
          <li><button class="is-active" aria-label="Slide 1"></button></li>
          <li><button aria-label="Slide 2"></button></li>
          <li><button aria-label="Slide 3"></button></li>
        </ol>
      </div>

      <!-- next-slide card -->
      <button class="next" id="heroNext" aria-label="Show next slide">
        <span class="next__bar" aria-hidden="true"><i></i></span>
        <span class="next__thumb"><img id="nextImg" src="assets/img/hero-2.jpg" alt="" width="1920" height="1080" loading="lazy"><span class="next__play"><svg class="ico">
              <use href="#i-arrow" />
            </svg></span></span>
        <span class="next__text"><small>Next up</small><strong id="nextTitle">House shifting</strong></span>
        <span class="next__count"><b id="nextNo">01</b>/03</span>
      </button>
    </section>
  </div>
</div>

<!-- ================= QUICK QUOTE + TRUST ================= -->
<!-- <section class="quick" aria-label="Quick quote">
  <div class="wrap">
    <form class="quickbar" action="actions/send-quote.php" method="post" aria-label="Quick quote request">
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="source" value="home-quickbar">
      <label class="qf"><span>Moving from</span><input name="from" type="text" placeholder="City or area"></label>
      <label class="qf"><span>Moving to</span><input name="to" type="text" placeholder="City or area"></label>
      <label class="qf"><span>Service</span>
        <select name="service">
          <option>House shifting</option>
          <option>Office shifting</option>
          <option>Goods transport</option>
          <option>Car carrier</option>
          <option>Packing only</option>
        </select>
      </label>
      <label class="qf"><span>Your phone</span><input name="phone" type="tel" placeholder="03xx xxxxxxx" required autocomplete="tel"></label>
      <button class="btn" type="submit">Get my quote <span class="btn__arrow"><svg class="ico">
            <use href="#i-arrow" />
          </svg></span></button>
    </form>
  </div>
</section> -->

<!-- ================= TRUST STRIP ================= -->
<section class="trust" aria-label="Why choose us">
  <ul class="wrap trust__list">
    <li data-reveal><svg class="ico">
        <use href="#i-crew" />
      </svg>
      <div><strong>Trained crew</strong><span>Careful wrapping and loading</span></div>
    </li>
    <li data-reveal data-delay="1"><svg class="ico">
        <use href="#i-price" />
      </svg>
      <div><strong>Fixed price</strong><span>Agreed before we start</span></div>
    </li>
    <li data-reveal data-delay="2"><svg class="ico">
        <use href="#i-time" />
      </svg>
      <div><strong>On time</strong><span>We arrive when we say</span></div>
    </li>
    <li data-reveal data-delay="3"><svg class="ico">
        <use href="#i-truck" />
      </svg>
      <div><strong>Own vehicles</strong><span>Pickups to containers</span></div>
    </li>
  </ul>
</section>

<!-- ================= ABOUT ================= -->
<section class="section about" id="about" aria-labelledby="about-title">
  <div class="wrap about__grid">
    <div class="about__media">
      <div class="about__img about__img--a" data-reveal="left"><img src="https://onewaygoods.pk/wp-content/uploads/al_opt_content/IMAGE/onewaygoods.pk/wp-content/uploads/2021/01/One-way-goods-in-lahore.jpg.bv.webp?bv_host=onewaygoods.pk" alt="Exo movers carrying a sofa beside a decorated moving truck" width="960" height="720" loading="lazy" data-parallax="0.06" data-scale="1.08"></div>
      <div class="about__img about__img--b" data-reveal="zoom" data-delay="2"><img src="assets/img/about2.png" alt="Packed cartons ready to load on an Exo Mazda truck" width="640" height="640" loading="lazy"></div>
      <!-- SAMPLE NUMBER: replace 10 with your real years of experience -->
      <div class="about__years" data-reveal="zoom" data-delay="3"><strong>10+</strong><span>Years of moving experience</span></div>
    </div>

    <div class="about__text">
      <h2 class="h2" id="about-title" data-reveal>Careful movers you can trust with everything you own</h2>
      <p data-reveal data-delay="1">Moving is stressful enough. Exo Packers and Movers brings a trained crew, clean vehicles and a price agreed before we start, so your furniture, appliances and goods arrive safely and on time.</p>
      <ul class="ticks" data-reveal data-delay="2">
        <li><svg class="ico">
            <use href="#i-check" />
          </svg>Furniture wrapped and padded before loading</li>
        <li><svg class="ico">
            <use href="#i-check" />
          </svg>Our own trucks and drivers, no middlemen</li>
        <li><svg class="ico">
            <use href="#i-check" />
          </svg>Free quote with no hidden charges</li>
      </ul>
      <div class="btnrow" data-reveal data-delay="3"><a class="btn btn--mag" href="about.php">More about us <span class="btn__arrow"><svg class="ico">
              <use href="#i-arrow" />
            </svg></span></a><a class="textlink" href="contact.php">Get a free quote</a></div>
    </div>
  </div>
</section>

<!-- ================= SERVICES ================= -->
<section class="section section--mist" id="services" aria-labelledby="services-title">
  <div class="wrap">
    <div class="head head--center" data-reveal>
      <h2 class="h2" id="services-title">Our moving services</h2>
      <p>Choose one service or let us handle the whole move.</p>
    </div>

    <div class="grid">
      <?php foreach ($SERVICES as $i => $sv): ?>
        <article class="svc" data-reveal data-delay="<?= $i % 3 ?>">
          <div class="svc__img">
            <img src="assets/img/<?= h($sv['img']) ?>" alt="<?= h($sv['alt']) ?>" width="960" height="720" loading="lazy">
            <span class="svc__ico"><svg class="ico">
                <use href="#<?= h($sv['icon']) ?>" />
              </svg></span>
          </div>
          <div class="svc__body">
            <h3><?= h($sv['name']) ?></h3>
            <p><?= h($sv['short']) ?></p>
            <a class="svc__link" href="services.php#<?= h($sv['slug']) ?>" aria-label="Learn more about <?= h($sv['name']) ?>">Learn more <svg class="ico">
                <use href="#i-arrow" />
              </svg></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="more" data-reveal><a class="btn btn--mag" href="services.php">View all services <span class="btn__arrow"><svg class="ico">
            <use href="#i-arrow" />
          </svg></span></a></div>
  </div>
</section>

<!-- ================= SERVICES WE OFFER (colour band) ================= -->
<section class="svcband" aria-labelledby="svcband-title">
  <div class="svcband__slashes" aria-hidden="true"><i></i><i></i><i></i></div>
  <div class="wrap svcband__grid">
    <div>
      <p class="svcband__label" data-reveal>Services we offer</p>
      <h2 class="h2" id="svcband-title" data-reveal data-delay="1">Home shifting and goods transport services in <?= h(CITY) ?></h2>
    </div>
    <div>
      <p class="svcband__text" data-reveal data-delay="1">Moving to a new house or office does not have to be stressful. At <?= h(SITE_NAME) ?> our trained crew packs, loads, transports and unloads your belongings with care, and we agree one fixed price before we start. Whether you are moving inside <?= h(CITY) ?> or between cities such as <?= h(implode(', ', array_slice(CITIES, 0, 4))) ?>, we use proper padding, strapping and the right vehicle for the load, from the first box to final delivery.</p>
      <div class="btnrow" data-reveal data-delay="2"><a class="btn btn--mag" href="services.php">Explore our services <span class="btn__arrow"><svg class="ico"><use href="#i-arrow"/></svg></span></a><a class="textlink textlink--light" href="contact.php">Get a free quote</a></div>
    </div>
  </div>
</section>

<!-- ================= WHY US / COUNTERS (parallax) ================= -->
<!-- SAMPLE NUMBERS: replace with your real figures -->
<section class="why px" id="why" aria-labelledby="why-title">
  <div class="px__bg" data-parallax="0.18" style="background-image:url('assets/img/cta-bg.jpg')"></div>
  <div class="wrap why__grid">
    <div class="why__text">
      <h2 class="h2" id="why-title" data-reveal>Why customers choose Exo</h2>
      <p data-reveal data-delay="1">Honest prices, a careful crew and vehicles that arrive on time. That is the whole promise.</p>
      <a class="btn btn--mag" href="contact.php" data-reveal data-delay="2">Get a free quote <span class="btn__arrow"><svg class="ico">
            <use href="#i-arrow" />
          </svg></span></a>
    </div>
    <dl class="counters">
      <div data-reveal="zoom">
        <dt><span data-count="1500">0</span><em>+</em></dt>
        <dd>Moves completed</dd>
      </div>
      <div data-reveal="zoom" data-delay="1">
        <dt><span data-count="12">0</span></dt>
        <dd>Cities covered</dd>
      </div>
      <div data-reveal="zoom" data-delay="2">
        <dt><span data-count="25">0</span><em>+</em></dt>
        <dd>Vehicles on the road</dd>
      </div>
      <div data-reveal="zoom" data-delay="3">
        <dt><span data-count="98">0</span><em>%</em></dt>
        <dd>Customers who would book again</dd>
      </div>
    </dl>
  </div>
</section>

<!-- ================= HOW IT WORKS ================= -->
<section class="section" id="how" aria-labelledby="how-title">
  <div class="wrap">
    <div class="head head--center" data-reveal>
      <h2 class="h2" id="how-title">How it works</h2>
      <p>Four simple steps from first call to final box.</p>
    </div>

    <ol class="steps" data-steps>
      <li class="step" data-reveal><span class="step__no">1</span>
        <h3>Call or message</h3>
        <p>Tell us what you are moving and where.</p>
      </li>
      <li class="step" data-reveal data-delay="1"><span class="step__no">2</span>
        <h3>Get a fixed price</h3>
        <p>One clear quote before we begin.</p>
      </li>
      <li class="step" data-reveal data-delay="2"><span class="step__no">3</span>
        <h3>We pack and load</h3>
        <p>Our crew arrives on time and loads safely.</p>
      </li>
      <li class="step" data-reveal data-delay="3"><span class="step__no">4</span>
        <h3>Delivered and set up</h3>
        <p>We unload and place everything for you.</p>
      </li>
    </ol>
  </div>
</section>

<!-- ================= FLEET ================= -->
<section class="section section--ink" id="fleet" aria-labelledby="fleet-title">
  <div class="wrap">
    <div class="head head--row" data-reveal>
      <div>
        <h2 class="h2" id="fleet-title">Our vehicles</h2>
        <p>The right vehicle for every load, from a pickup to a 40 ft container.</p>
      </div>
      <div class="arrows">
        <button class="arrow arrow--prev" id="fleetPrev" aria-label="Previous vehicles"><svg class="ico">
            <use href="#i-arrow" />
          </svg></button>
        <button class="arrow" id="fleetNext" aria-label="Next vehicles"><svg class="ico">
            <use href="#i-arrow" />
          </svg></button>
      </div>
    </div>

    <div class="slider" id="fleetSlider" tabindex="0" aria-label="Vehicle list">
      <?php foreach ($FLEET as $f): ?>
        <article class="vcard">
          <div class="vcard__img"><img src="assets/img/<?= h($f['img']) ?>" alt="<?= h($f['alt']) ?>" width="960" height="720" loading="lazy"><span class="vcard__cap"><?= h($f['cap']) ?></span></div>
          <h3><?= h($f['name']) ?></h3>
          <p><?= h($f['best']) ?></p>
          <a class="vcard__link" href="fleets.php">See details <svg class="ico">
              <use href="#i-arrow" />
            </svg></a>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="slider__bar" aria-hidden="true"><i id="fleetBar"></i></div>
    <div class="more" data-reveal><a class="btn btn--mag" href="fleets.php">View all vehicles <span class="btn__arrow"><svg class="ico">
            <use href="#i-arrow" />
          </svg></span></a></div>
  </div>
</section>

<!-- ================= AREAS ================= -->
<section class="section areas" id="areas" aria-labelledby="areas-title">
  <div class="wrap areas__grid">
    <div class="areas__text">
      <h2 class="h2" id="areas-title" data-reveal>Packers and movers across Pakistan</h2>
      <p data-reveal data-delay="1">We move homes, offices and goods between major cities and inside them. Do not see your city? Call us, we probably cover it.</p>
      <a class="btn btn--mag" href="tel:<?= h(PHONE_LINK) ?>" data-reveal data-delay="2"><svg class="ico">
          <use href="#i-phone" />
        </svg><?= h(PHONE_DISPLAY) ?></a>
    </div>
    <ul class="chips">
      <?php foreach (CITIES as $i => $c): ?>
        <li data-reveal data-delay="<?= $i % 4 ?>"><svg class="ico">
            <use href="#i-pin" />
          </svg><span><strong><?= h($c) ?></strong><small>Packers and movers in <?= h($c) ?></small></span></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<!-- SAMPLE REVIEWS: replace with real customer feedback -->
<section class="section section--mist reviews" id="reviews" aria-labelledby="reviews-title">
  <div class="wrap">
    <div class="head head--center" data-reveal>
      <h2 class="h2" id="reviews-title">What our customers say</h2>
    </div>

    <div class="rv" id="reviewSlider" data-reveal>
      <?php
      $reviews = [
        ['A', 'The crew arrived on time, wrapped everything properly and nothing was scratched. The price was exactly what they quoted on the phone.', 'House shifting, City'],
        ['B', 'We moved our whole office over a weekend and opened on Monday as normal. Every desk and computer came to the right room.', 'Office shifting, City'],
        ['C', 'I was worried about moving cities. They sent my car on a carrier and the furniture in a container, and both arrived on the day promised.', 'Intercity move'],
      ];
      foreach ($reviews as $i => $r): ?>
        <figure class="rv__slide <?= $i === 0 ? 'is-active' : '' ?>">
          <div class="stars" role="img" aria-label="5 out of 5 stars"><?php for ($k = 0; $k < 5; $k++): ?><svg class="ico">
                <use href="#i-star" />
              </svg><?php endfor; ?></div>
          <blockquote><?= h($r[1]) ?></blockquote>
          <figcaption><span class="avatar"><?= h($r[0]) ?></span><span><strong>Customer name</strong><br><?= h($r[2]) ?></span></figcaption>
        </figure>
      <?php endforeach; ?>
      <div  class="rv__ctrl">
        <button  class="arrow arrow--light arrow--prev" id="rvPrev" aria-label="Previous review"><svg class="ico">
            <use style="color: black;" href="#i-arrow" />
          </svg></button>
        <div class="rv__dots" id="rvDots"></div>
        <button class="arrow arrow--light" id="rvNext" aria-label="Next review"><svg class="ico">
            <use style="color: black;" href="#i-arrow" />
          </svg></button>
      </div>
    </div>
  </div>
</section>

<!-- ================= FAQ ================= -->
<section class="section" id="faq" aria-labelledby="faq-title">
  <div class="wrap faq">
    <div class="faq__intro">
      <h2 class="h2" id="faq-title" data-reveal>Frequently asked questions</h2>
      <p data-reveal data-delay="1">Still unsure? Call us and we will talk it through.</p>
      <div class="btnrow" data-reveal data-delay="2"><a class="btn btn--mag" href="tel:<?= h(PHONE_LINK) ?>"><svg class="ico">
            <use href="#i-phone" />
          </svg><?= h(PHONE_DISPLAY) ?></a><a class="textlink" href="faq.php">All questions</a></div>
    </div>
    <div class="acc" data-accordion>
      <?php foreach ($faqs as $i => $f): ?>
        <div class="acc__item <?= $i === 0 ? 'is-open' : '' ?>" data-reveal data-delay="<?= $i % 3 ?>">
          <button class="acc__btn" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"><?= h($f[0]) ?><span class="acc__ico"><svg class="ico">
                <use href="#i-plus" />
              </svg></span></button>
          <div class="acc__panel">
            <div>
              <p><?= h($f[1]) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ================= LATEST ARTICLES ================= -->
<section class="section section--mist" id="articles" aria-labelledby="articles-title">
  <div class="wrap">
    <div class="head head--row" data-reveal>
      <div>
        <h2 class="h2" id="articles-title">Latest articles</h2>
        <p>Tips and guides from our moving crew.</p>
      </div>
      <a class="textlink" href="blog.php">All articles <span class="btn__arrow"><svg class="ico"><use href="#i-arrow"/></svg></span></a>
    </div>
    <div class="arts">
      <?php foreach (array_slice($ARTICLES, 0, 3) as $i => $a) art_card($a, $i); ?>
    </div>
  </div>
</section>


<!-- ================= CONTACT ================= -->
<section class="contact" id="contact" aria-labelledby="contact-title">
  <div class="contact__slashes" aria-hidden="true"><i></i><i></i><i></i></div>
  <div class="wrap contact__grid">
    <div class="contact__text">
      <h2 class="h2" id="contact-title" data-reveal>Get a free quote</h2>
      <p data-reveal data-delay="1">Fill in the form or call us. We reply within the hour during working hours.</p>
      <a class="contact__phone" href="tel:<?= h(PHONE_LINK) ?>" data-reveal data-delay="2"><?= h(PHONE_DISPLAY) ?></a>
      <ul class="contact__list" data-reveal data-delay="3">
        <li><svg class="ico">
            <use href="#i-chat" />
          </svg><a href="https://wa.me/<?= h(WA_NUMBER) ?>" target="_blank" rel="noopener">Message us on WhatsApp</a></li>
        <li><svg class="ico">
            <use href="#i-mail" />
          </svg><a href="mailto:<?= h(EMAIL) ?>"><?= h(EMAIL) ?></a></li>
        <li><svg class="ico">
            <use href="#i-clock" />
          </svg><?= h(HOURS) ?></li>
        <li><svg class="ico">
            <use href="#i-pin" />
          </svg><?= h(ADDRESS) ?></li>
      </ul>
    </div>

    <form class="qform" action="actions/send-quote.php" method="post" data-reveal="right">
      <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="source" value="home-contact">
      <div class="qform__row">
        <label class="f"><span>Your name</span><input name="name" type="text" required autocomplete="name"></label>
        <label class="f"><span>Phone number</span><input name="phone" type="tel" required autocomplete="tel"></label>
      </div>
      <div class="qform__row">
        <label class="f"><span>Moving from</span><input name="from" type="text" placeholder="City or area"></label>
        <label class="f"><span>Moving to</span><input name="to" type="text" placeholder="City or area"></label>
      </div>
      <label class="f"><span>Service</span>
        <select name="service">
          <option>House shifting</option>
          <option>Office shifting</option>
          <option>Goods transport</option>
          <option>Car carrier</option>
          <option>Packing only</option>
        </select>
      </label>
      <button class="btn btn--block" type="submit">Send my request <span class="btn__arrow"><svg class="ico">
            <use href="#i-arrow" />
          </svg></span></button>
    </form>
  </div>
</section>

<?php include 'includes/footer.php'; ?>