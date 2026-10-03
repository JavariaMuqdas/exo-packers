<?php
/* Renders ONE page the way a browser would see it and prints the HTML.
   Used by export-static.php. Usage: php tools/render-one.php about.php "service=house&city=islamabad" */
$root = dirname(__DIR__);
chdir($root);
$file = $argv[1] ?? 'index.php';
parse_str($argv[2] ?? '', $_GET);
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['REQUEST_URI'] = '/' . $file;
$_SERVER['HTTP_HOST'] = 'localhost';
ob_start();
include $root . '/' . $file;
echo ob_get_clean();
