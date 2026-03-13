<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class DashboardController {

    public function index(){

        AuthMiddleware::handle();

        $view = __DIR__ . '/../views/dashboard/index.php';

        require __DIR__ . '/../views/layout.php';

    }

}
