<?php

session_start();

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../routes/web.php';

require_once __DIR__ . '/../app/services/Tenant.php';

// define o tenant da sessão
if (isset($_SESSION['company_id'])) {
    Tenant::set($_SESSION['company_id']);
}

Router::dispatch();