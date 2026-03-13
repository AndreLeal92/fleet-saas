<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class DashboardController {

    public function index() {

        AuthMiddleware::handle();

        require __DIR__ . '/../../public/views/dashboard/index.php';

    }

}