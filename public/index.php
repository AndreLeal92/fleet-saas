<?php

// iniciar sessão
session_start();

// mostrar erros (apenas desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// carregar Router
require_once __DIR__ . '/../core/Router.php';

// carregar rotas
require_once __DIR__ . '/../routes/web.php';

// executar rota
Router::dispatch();