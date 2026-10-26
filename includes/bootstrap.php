<?php
/**
 * Loads settings, content and helper functions. Every page and the form handler start here.
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__));
$GLOBALS['CONFIG'] = require __DIR__ . '/config.php';
$GLOBALS['DATA']   = require __DIR__ . '/data.php';
date_default_timezone_set($GLOBALS['CONFIG']['timezone'] ?? 'UTC');

require __DIR__ . '/functions.php';
require __DIR__ . '/forms.php';
require __DIR__ . '/sections.php';

// Buffer output so the session cookie can be set by forms rendered lower down the page.
ob_start();
