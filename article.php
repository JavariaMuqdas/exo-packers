<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';
include 'includes/data.php';
require_once 'includes/article-card.php';

$slug = $_GET['slug'] ?? '';
$art = null;
foreach ($ARTICLES as $a) { if ($a['slug'] === $slug) { $art = $a; break; } }

if (!$art) {                                         // unknown address: friendly 404 that Google will not index
    http_response_code(404);
    $title = 'Article not found | ' . SITE_NAME;
    $desc = 'This article could not be found.';
    $path = '/blog.php'; $page = 'blog'; $robots = 'noindex, follow';
    $banner = ['title' => 'Article not found', 'lead' => 'The page you are looking for does not exist.', 'crumb' => 'Not found', 'theme' => 3, 'truck' => 3];
    include 'includes/header.php';
    include 'includes/page-banner.php';
    echo '<section class="section"><div class="wrap"><p class="note">Try our <a class="textlink" href="blog.php">latest articles</a>.</p></div></section>';
    include 'includes/footer.php';
    exit;
}

$title = $art['title'] . ' | ' . SITE_NAME;
$desc  = $art['excerpt'];
$path  = '/article.php?slug=' . $art['slug'];
$page  = 'blog';
$ogImage = '/assets/img/' . $art['img'];
$banner = ['title' => $art['title'], 'lead' => date('F j, Y', strtotime($art['date'])) . '  |  ' . $art['tag'], 'crumb' => 'Article', 'theme' => 2, 'truck' => 1];
$schemas = [
  schema_business(),
  schema_breadcrumbs([['Home', '/'], ['Blog', '/blog.php'], [$art['title'], $path]]),
  ['@context' => 'https://schema.org', '@type' => 'Article', 'headline' => $art['title'], 'description' => $art['excerpt'],
   'image' => SITE_URL . '/assets/img/' . $art['img'], 'datePublished' => $art['date'], 'dateModified' => $art['date'],
   'author' => ['@type' => 'Organization', 'name' => SITE_NAME], 'publisher' => ['@id' => SITE_URL . '/#business'],
   'mainEntityOfPage' => SITE_URL . $path],
];
include 'includes/header.php';
include 'includes/page-banner.php';
$others = array_values(array_filter($ARTICLES, fn($x) => $x['slug'] !== $art['slug']));
?>

<section class="section" aria-label="Article">
  <div class="wrap">
    <article class="apage">
      <div class="apage__cover" data-reveal="zoom"><img src="assets/img/<?= h($art['img']) ?>" alt="<?= h($art['alt']) ?>" width="1200" height="750"></div>
      <div class="prose">
        <?php foreach ($art['body'] as $b): ?>
          <?php if ($b[0] === 'p'): ?><p data-reveal><?= h($b[1]) ?></p>
          <?php elseif ($b[0] === 'h'): ?><h2 data-reveal><?= h($b[1]) ?></h2>
          <?php elseif ($b[0] === 'ul'): ?><ul data-reveal><?php foreach ($b[1] as $li): ?><li><?= h($li) ?></li><?php endforeach; ?></ul>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="btnrow apage__cta" data-reveal><a class="btn btn--mag" href="contact.php">Get a free quote <span class="btn__arrow"><svg class="ico"><use href="#i-arrow"/></svg></span></a><a class="textlink" href="blog.php">All articles</a></div>
    </article>
  </div>
</section>

<section class="section section--mist" aria-labelledby="more-title">
  <div class="wrap">
    <div class="head head--center" data-reveal><h2 class="h2" id="more-title">More articles</h2></div>
    <div class="arts arts--two">
      <?php foreach ($others as $i => $a) art_card($a, $i); ?>
    </div>
  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
