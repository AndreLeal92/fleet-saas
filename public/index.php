<?php

// inicia sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// core do sistema
require_once __DIR__ . '/../core/Router.php';

// rotas
require_once __DIR__ . '/../routes/web.php';

// serviço de tenant (SaaS)
require_once __DIR__ . '/../app/services/Tenant.php';


// define empresa logada
if (isset($_SESSION['company_id'])) {

    Tenant::set((int) $_SESSION['company_id']);

}


// executa roteador
Router::dispatch();