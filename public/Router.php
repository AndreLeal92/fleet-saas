<?php

// mostrar erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// se for arquivo real (css, js, imagem)
if (php_sapi_name() === 'cli-server') {

    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $file = __DIR__ . $path;

    // se existir arquivo físico → servir direto
    if (is_file($file)) {
        return false;
    }
}

// senão, carregar o sistema
require_once __DIR__ . '/index.php';