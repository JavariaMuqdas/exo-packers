</main>

<footer class="footer">
  <div class="wrap footer__grid">
    <div class="footer__brand">
      <img src="assets/img/logo-light.png" alt="<?= h(SITE_NAME) ?>" width="104" height="72" loading="lazy">
      <p>House shifting, office relocation and goods transport in <?= h(CITY) ?>. Trained crew, own vehicles, fixed price.</p>
      <?php if (FACEBOOK_URL || INSTAGRAM_URL || YOUTUBE_URL): ?>
      <div class="social">
        <?php if (FACEBOOK_URL):  ?><a href="<?= h(FACEBOOK_URL) ?>"  target="_blank" rel="noopener" aria-label="Facebook"><svg class="ico"><use href="#i-fb"/></svg></a><?php endif; ?>
        <?php if (INSTAGRAM_URL): ?><a href="<?= h(INSTAGRAM_URL) ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg class="ico"><use href="#i-ig"/></svg></a><?php endif; ?>
        <?php if (YOUTUBE_URL):   ?><a href="<?= h(YOUTUBE_URL) ?>"   target="_blank" rel="noopener" aria-label="YouTube"><svg class="ico"><use href="#i-yt"/></svg></a><?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
    <nav aria-label="Services">
      <h2>Services</h2>
      <ul>
        <?php foreach ($SERVICES ?? [] as $sv): ?>
        <li><a href="services.php#<?= h($sv['slug']) ?>"><?= h($sv['name']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <nav aria-label="Quick links">
      <h2>Quick links</h2>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="fleets.php">Our vehicles</a></li>
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
    <div>
      <h2>Contact</h2>
      <ul class="footer__contact">
        <li><svg class="ico"><use href="#i-phone"/></svg><a href="tel:<?= h(PHONE_LINK) ?>"><?= h(PHONE_DISPLAY) ?></a></li>
        <li><svg class="ico"><use href="#i-mail"/></svg><a href="mailto:<?= h(EMAIL) ?>"><?= h(EMAIL) ?></a></li>
        <li><svg class="ico"><use href="#i-pin"/></svg><?= h(ADDRESS) ?></li>
        <li><svg class="ico"><use href="#i-clock"/></svg><?= h(HOURS) ?></li>
      </ul>
    </div>
  </div>
  <div class="wrap footer__bar">
    <p>&copy; <?= date('Y') ?> <?= h(SITE_NAME) ?>. All rights reserved.</p>
    <a href="#top">Back to top</a>
  </div>
</footer>

<a class="wa" href="https://wa.me/<?= h(WA_NUMBER) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg class="ico ico--lg"><use href="#i-chat"/></svg>
</a>

<button class="totop" id="toTop" type="button" aria-label="Back to top">
  <svg class="totop__ring" viewBox="0 0 52 52" aria-hidden="true"><circle class="totop__track" cx="26" cy="26" r="24"/><circle class="totop__bar" cx="26" cy="26" r="24"/></svg>
  <svg class="ico totop__arrow" aria-hidden="true"><use href="#i-arrow"/></svg>
</button>

<script src="assets/js/main.js" defer></script>
</body>
</html>
