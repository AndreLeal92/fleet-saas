<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

$file = __DIR__ . $uri;

// se existir arquivo físico → servir direto
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// senão roda o sistema
require_once __DIR__ . '/index.php';
