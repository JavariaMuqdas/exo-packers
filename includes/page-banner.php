<?php
/* ------------------------------------------------------------------
   Banner shown at the top of inner pages (same style as the home hero).
   Set $banner before including this file:
     'title' => page heading (this becomes the H1)
     'lead'  => one short line under the heading
     'crumb' => name shown in the breadcrumb
     'theme' => 1 sunset, 2 day, 3 night   (optional)
     'truck' => 1 red box truck, 2 green box truck, 3 teal container truck (optional, used by the illustrated truck)
   ------------------------------------------------------------------ */
$b = $banner ?? [];
$theme = (int) ($b['theme'] ?? 1);
$truck = (int) ($b['truck'] ?? 1);

/* REAL TRUCK: every banner uses the SAME truck photo as the home page.
   Put the name of your truck file here (the one you use in index.php). The first file that exists is used;
   if none exists, the illustrated truck is shown instead. Set the flip option to true if your truck faces LEFT. */
$bannerTruckCandidates = ['assets/img/truck1.png', 'assets/img/truck1.webp'];
$bannerTruckFlip = false;
$bannerTruckImg = '';
foreach ($bannerTruckCandidates as $cand) { if (is_file(__DIR__ . '/../' . $cand)) { $bannerTruckImg = $cand; break; } }
$realTruck = $bannerTruckImg !== '';
$truckSize = $realTruck ? (@getimagesize(__DIR__ . '/../' . $bannerTruckImg) ?: [800, 419]) : [800, 419];

$longTitle = strlen($b['title'] ?? '') > 34;     // long titles (articles) get a smaller heading so they stay inside the card
?>
<div class="top" id="top">
  <div class="top__card">
    <section class="stage stage--page" data-s="<?= $theme ?>" aria-label="<?= h($b['title'] ?? '') ?>">
      <div class="sky sky--<?= $theme ?>"><?php if ($theme === 3): ?><div class="stars"></div><?php endif; ?></div>
      <div class="orb"></div>
      <div class="land" aria-hidden="true">
        <div class="layer layer--mountains"></div>
        <div class="layer layer--hills"><img src="assets/svg/layer-hills.svg" alt="" width="1600" height="260"><img src="assets/svg/layer-hills.svg" alt="" width="1600" height="260"></div>
        <div class="layer layer--near"><img src="assets/svg/layer-near.svg" alt="" width="1600" height="210"><img src="assets/svg/layer-near.svg" alt="" width="1600" height="210"></div>
        <div class="road"><i></i></div>
        <div class="tint"></div>
      </div>
      <div class="rigs" aria-hidden="true">
        <div class="rig rig--<?= $truck ?><?= $realTruck ? ' rig--real' : '' ?> is-in">
          <?php if ($realTruck): ?>
          <span class="truck__sway"><span class="truck__real<?= $bannerTruckFlip ? ' is-flip' : '' ?>"><img class="truck__photo" src="<?= h($bannerTruckImg) ?>" alt="" width="<?= (int) $truckSize[0] ?>" height="<?= (int) $truckSize[1] ?>"></span></span>
          <span class="streaks"><i></i><i></i><i></i></span>
          <?php else: readfile(__DIR__ . '/../assets/svg/truck-' . $truck . '.svg'); endif; ?>
          <span class="dust"><i></i><i></i><i></i></span>
        </div>
      </div>
      <div class="stage__shade" aria-hidden="true"></div>

      <div class="stage__content">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="index.php">Home</a><span aria-hidden="true">/</span><span aria-current="page"><?= h($b['crumb'] ?? '') ?></span>
        </nav>
        <h1 class="page-title<?= $longTitle ? ' page-title--long' : '' ?>" data-words><?= h($b['title'] ?? '') ?></h1>
        <?php if (!empty($b['lead'])): ?><p class="page-lead"><?= h($b['lead']) ?></p><?php endif; ?>
      </div>
    </section>
  </div>
</div>
