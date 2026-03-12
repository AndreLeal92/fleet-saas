<?php

session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/' || $uri === '') {
    echo "Fleet SaaS funcionando";
    exit;
}

if ($uri === '/login') {
    require __DIR__ . '/views/login.php';
    exit;
}

echo "Página não encontrada";