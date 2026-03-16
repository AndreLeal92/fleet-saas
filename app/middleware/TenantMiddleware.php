<?php

require_once __DIR__ . '/../services/Tenant.php';

class TenantMiddleware {

    public static function handle(): void {

        if (!isset($_SESSION['company_id'])) {

            session_destroy();
            header("Location: /login");
            exit;

        }

        Tenant::setCompanyId((int) $_SESSION['company_id']);

    }

}