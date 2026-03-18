<?php

// inicia sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// core do sistema
require_once __DIR__ . '/fleet-saas/core/Router.php';

// rotas
require_once __DIR__ . '/fleet-saas/routes/web.php';

// serviço de tenant (SaaS)
require_once __DIR__ . '/fleet-saas/app/services/Tenant.php';

// define empresa logada
if (isset($_SESSION['company_id'])) {
    Tenant::set((int) $_SESSION['company_id']);
}

// executa roteador
Router::dispatch();