<?php
require_once 'includes/config.php';
require_once 'includes/seo.php';
include 'includes/data.php';
require_once 'includes/article-card.php';

$title = 'Moving & Goods Transport Articles | ' . SITE_NAME;
$desc  = 'Practical guides on moving, packing and transporting electronics, leather, footwear and medical equipment in ' . CITY . ' from the team at ' . SITE_NAME . '.';
$path  = '/blog.php';
$page  = 'blog';
$banner = ['title' => 'Latest articles', 'lead' => 'Tips and guides from our moving crew.', 'crumb' => 'Blog', 'theme' => 2, 'truck' => 2];
$schemas = [schema_business(), schema_breadcrumbs([['Home', '/'], ['Blog', $path]])];
include 'includes/header.php';
include 'includes/page-banner.php';
?>

<section class="section" aria-label="Articles">
  <div class="wrap">
    <div class="arts">
      <?php foreach ($ARTICLES as $i => $a) art_card($a, $i % 3); ?>
    </div>
  </div>
</section>

<?php include 'includes/cta.php'; include 'includes/footer.php'; ?>
