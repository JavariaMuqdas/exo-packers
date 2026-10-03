<?php
/* Prints one article card (used on the home page, blog page and under articles) */
if (!function_exists('art_card')) {
    function art_card(array $a, int $delay = 0): void { ?>
      <article class="art" data-reveal data-delay="<?= $delay ?>">
        <a class="art__img" href="article.php?slug=<?= h($a['slug']) ?>" tabindex="-1" aria-hidden="true">
          <img src="assets/img/<?= h($a['img']) ?>" alt="" width="1200" height="750" loading="lazy">
          <span class="art__tag"><?= h($a['tag']) ?></span>
        </a>
        <div class="art__body">
          <p class="art__meta"><svg class="ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h14a2 2 0 012 2v13a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2zM16 2v4M8 2v4M3 10h18"/></svg><time datetime="<?= h($a['date']) ?>"><?= h(date('F j, Y', strtotime($a['date']))) ?></time></p>
          <h3><a href="article.php?slug=<?= h($a['slug']) ?>"><?= h($a['title']) ?></a></h3>
          <p class="art__excerpt"><?= h($a['excerpt']) ?></p>
          <a class="svc__link" href="article.php?slug=<?= h($a['slug']) ?>" aria-label="Read: <?= h($a['title']) ?>">Read article <svg class="ico"><use href="#i-arrow"/></svg></a>
        </div>
      </article>
    <?php }
}
