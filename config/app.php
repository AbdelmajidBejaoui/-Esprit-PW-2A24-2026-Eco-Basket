<?php
// Detect base URL automatically — works in XAMPP/WAMP subfolders
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script   = $_SERVER['SCRIPT_NAME'] ?? '/index.php';         // e.g. /entrainements_project/index.php
$base     = rtrim(dirname($script), '/\\');                   // e.g. /entrainements_project
define('BASE_URL', $protocol . '://' . $host . $base);        // http://localhost/entrainements_project
define('BASE_PATH', $base);                                    // /entrainements_project  (for href)
define('ASSETS_FRONT', BASE_PATH . '/public/vegefoods');
define('ASSETS_BACK',  BASE_PATH . '/public/adminlte');
