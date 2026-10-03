<?php
/* ------------------------------------------------------------------
   ONE-CLICK BACKGROUND REMOVER for your truck photo (runs on your own computer only).

   How to use:
   1. Put your truck photo in assets/img/  (for example truck1.jpg)
   2. Start Apache in XAMPP and open:
        http://localhost/exo/tools/make-truck-transparent.php?src=truck1.jpg
   3. It saves a transparent copy next to it:  assets/img/truck1.png
   4. In index.php set:  $truckImg = 'assets/img/truck1.png';
   5. Delete this tools folder before you upload the site to your live hosting.

   If the result is not perfect, add &strength=1 ... 5 to the address (default 3):
     - grey background still left behind  -> try a higher number
     - parts of the truck got eaten away  -> try a lower number
   ------------------------------------------------------------------ */

if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true)) {
    http_response_code(403);
    exit('This tool only works on your own computer (localhost).');
}
if (!function_exists('imagecreatetruecolor')) {
    exit('The PHP "gd" extension is off. In XAMPP open php.ini, remove the semicolon before ";extension=gd", then restart Apache.');
}
@set_time_limit(180);
@ini_set('memory_limit', '768M');

$dir = realpath(__DIR__ . '/../assets/img');
$src = basename($_GET['src'] ?? 'truck1.jpg');
$path = $dir . '/' . $src;
if (!is_file($path)) exit('Cannot find ' . htmlspecialchars($src) . ' in assets/img/. Check the file name.');

$strength = max(1, min(5, (int) ($_GET['strength'] ?? 3)));
[$tol, $edgeMax] = [1 => [6, 22], 2 => [8, 30], 3 => [10, 38], 4 => [14, 50], 5 => [20, 70]][$strength];
$maxW = max(600, min(2000, (int) ($_GET['w'] ?? 1200)));

$ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
$im = match ($ext) {
    'jpg', 'jpeg' => @imagecreatefromjpeg($path),
    'png'         => @imagecreatefrompng($path),
    'webp'        => @imagecreatefromwebp($path),
    default       => false,
};
if (!$im) exit('Unsupported or broken image. Use JPG, PNG or WebP.');

$W = imagesx($im); $H = imagesy($im);
if ($W > $maxW) { $s = imagescale($im, $maxW); imagedestroy($im); $im = $s; $W = imagesx($im); $H = imagesy($im); }
$n = $W * $H;

/* ---- read pixels ---- */
$px = $L = $S = array_fill(0, $n, 0);
for ($y = 0, $i = 0; $y < $H; $y++) {
    for ($x = 0; $x < $W; $x++, $i++) {
        $c = imagecolorat($im, $x, $y);
        $r = ($c >> 16) & 255; $g = ($c >> 8) & 255; $b = $c & 255;
        $px[$i] = $c & 0xFFFFFF;
        $L[$i]  = (int) (0.3 * $r + 0.59 * $g + 0.11 * $b);
        $S[$i]  = max($r, $g, $b) - min($r, $g, $b);
    }
}
/* edge strength */
$E = array_fill(0, $n, 255);
for ($y = 1; $y < $H - 1; $y++) {
    $row = $y * $W;
    for ($x = 1; $x < $W - 1; $x++) {
        $i = $row + $x;
        $E[$i] = abs($L[$i + 1] - $L[$i - 1]) + abs($L[$i + $W] - $L[$i - $W]);
    }
}

/* ---- grow the background inward from the picture border ----
   a pixel counts as background if it is light and grey, changes smoothly from its neighbour and is not on a strong edge */
$isBg = fn(int $j): bool => $S[$j] <= 40 && $L[$j] >= 115;
$bg = array_fill(0, $n, 0);
$q = []; $qh = 0;
$seed = function (int $j) use (&$bg, &$q, $isBg) { if (!$bg[$j] && $isBg($j)) { $bg[$j] = 1; $q[] = $j; } };
for ($x = 0; $x < $W; $x++) { $seed($x); $seed(($H - 1) * $W + $x); }
for ($y = 0; $y < $H; $y++) { $seed($y * $W); $seed($y * $W + $W - 1); }
while ($qh < count($q)) {
    $i = $q[$qh++];
    $x = $i % $W;
    foreach ([$x > 0 ? $i - 1 : -1, $x < $W - 1 ? $i + 1 : -1, $i >= $W ? $i - $W : -1, $i < $n - $W ? $i + $W : -1] as $j) {
        if ($j < 0 || $bg[$j]) continue;
        if ($E[$j] <= $edgeMax && abs($L[$j] - $L[$i]) <= $tol && $isBg($j)) { $bg[$j] = 1; $q[] = $j; }
    }
}
unset($q);

/* ---- keep only the biggest solid object (the truck), drop specks ---- */
$lab = array_fill(0, $n, 0); $best = 0; $bestSize = 0; $id = 0;
for ($s = 0; $s < $n; $s++) {
    if ($bg[$s] || $lab[$s]) continue;
    $id++; $lab[$s] = $id; $qq = [$s]; $h = 0;
    while ($h < count($qq)) {
        $i = $qq[$h++]; $x = $i % $W;
        foreach ([$x > 0 ? $i - 1 : -1, $x < $W - 1 ? $i + 1 : -1, $i >= $W ? $i - $W : -1, $i < $n - $W ? $i + $W : -1] as $j) {
            if ($j >= 0 && !$bg[$j] && !$lab[$j]) { $lab[$j] = $id; $qq[] = $j; }
        }
    }
    if (count($qq) > $bestSize) { $bestSize = count($qq); $best = $id; }
}
$m = array_fill(0, $n, 0);
for ($i = 0; $i < $n; $i++) $m[$i] = ($lab[$i] === $best) ? 1 : 0;
unset($lab, $bg);

/* ---- tidy the edge: shrink 1 px (removes the light halo), then soften ---- */
$er = array_fill(0, $n, 0);
for ($y = 1; $y < $H - 1; $y++) for ($x = 1; $x < $W - 1; $x++) {
    $i = $y * $W + $x;
    if ($m[$i] && $m[$i - 1] && $m[$i + 1] && $m[$i - $W] && $m[$i + $W]) $er[$i] = 1;
}
$out = imagecreatetruecolor($W, $H);
imagealphablending($out, false); imagesavealpha($out, true);
imagefill($out, 0, 0, 0x7F000000);
$minX = $W; $minY = $H; $maxX = 0; $maxY = 0;
for ($y = 1; $y < $H - 1; $y++) for ($x = 1; $x < $W - 1; $x++) {
    $i = $y * $W + $x;
    $sum = $er[$i - $W - 1] + $er[$i - $W] + $er[$i - $W + 1] + $er[$i - 1] + $er[$i] + $er[$i + 1] + $er[$i + $W - 1] + $er[$i + $W] + $er[$i + $W + 1];
    if ($sum === 0) continue;
    $a = max(0, min(1, ($sum / 9 - 0.25) / 0.5));
    if ($a <= 0) continue;
    imagesetpixel($out, $x, $y, ((127 - (int) round($a * 127)) << 24) | $px[$i]);
    if ($x < $minX) $minX = $x; if ($x > $maxX) $maxX = $x; if ($y < $minY) $minY = $y; if ($y > $maxY) $maxY = $y;
}
if ($maxX <= $minX) exit('Nothing was left after removing the background. Try &strength=1.');
$pad = 4;
$crop = imagecrop($out, ['x' => max(0, $minX - $pad), 'y' => max(0, $minY - $pad), 'width' => min($W, $maxX - $minX + 2 * $pad), 'height' => min($H, $maxY - $minY + 2 * $pad)]);
imagealphablending($crop, false); imagesavealpha($crop, true);
$outName = pathinfo($src, PATHINFO_FILENAME) . '.png';
imagepng($crop, $dir . '/' . $outName, 8);
$kb = round(filesize($dir . '/' . $outName) / 1024);
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="utf-8"><title>Truck background removed</title>
<style>
  body { font: 16px/1.6 system-ui, sans-serif; max-width: 980px; margin: 30px auto; padding: 0 20px; color: #1c2526; }
  .check { background: #fff conic-gradient(#ddd 25%, #fff 0 50%, #ddd 0 75%, #fff 0) 0 0 / 24px 24px; border-radius: 14px; padding: 14px; text-align: center; }
  .check img { max-width: 100%; height: auto; }
  code { background: #eef6f6; padding: 2px 7px; border-radius: 6px; }
  a { color: #0e6b70; font-weight: 700; }
  .ok { background: #d9eeef; padding: 14px 18px; border-radius: 12px; }
</style></head><body>
<h1>Done: background removed</h1>
<p class="ok">Saved <code>assets/img/<?= htmlspecialchars($outName) ?></code> (<?= $kb ?> KB, transparent).<br>
Now in <code>index.php</code> set: <code>$truckImg = 'assets/img/<?= htmlspecialchars($outName) ?>';</code></p>
<p>Preview on a checkerboard (the checkerboard shows through where it is transparent):</p>
<div class="check"><img src="../assets/img/<?= htmlspecialchars($outName) ?>?v=<?= time() ?>" alt="Truck with transparent background"></div>
<p>Not happy?
<?php foreach ([1, 2, 3, 4, 5] as $k): ?><a href="?src=<?= urlencode($src) ?>&amp;strength=<?= $k ?>"><?= $k === $strength ? "[$k]" : $k ?></a> <?php endforeach; ?>
&nbsp;(higher = removes more background, lower = protects the truck)</p>
</body></html>