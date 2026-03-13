<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class DashboardController {

    public function index() {

        AuthMiddleware::handle();

        echo "Dashboard NeoFleet funcionando 🚀";

    }

}