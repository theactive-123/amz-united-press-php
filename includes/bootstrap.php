<?php
/**
 * Loads settings, content and helper functions. Every page and the form handler start here.
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__));
$GLOBALS['CONFIG'] = require __DIR__ . '/config.php';
// Private settings override defaults; excluded from Git and protected by Apache.
if (is_file(__DIR__ . '/config.local.php')) {
    $GLOBALS['CONFIG'] = array_replace_recursive($GLOBALS['CONFIG'], require __DIR__ . '/config.local.php');
}
// Resolve installation paths on both domain-root hosting and local subfolders.
if (($GLOBALS['CONFIG']['base_path'] ?? null) === null) {
    $documentRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '';
    $siteRoot = str_replace('\\', '/', ROOT);
    $documentRoot = rtrim(str_replace('\\', '/', $documentRoot), '/');
    $GLOBALS['CONFIG']['base_path'] = $documentRoot !== '' && strncasecmp($siteRoot . '/', $documentRoot . '/', strlen($documentRoot) + 1) === 0
        ? substr($siteRoot, strlen($documentRoot))
        : '';
}

$GLOBALS['DATA']   = require __DIR__ . '/data.php';
date_default_timezone_set($GLOBALS['CONFIG']['timezone'] ?? 'UTC');

require __DIR__ . '/functions.php';
require __DIR__ . '/forms.php';
require __DIR__ . '/sections.php';

// Buffer output so the session cookie can be set by forms rendered lower down the page.
ob_start();
