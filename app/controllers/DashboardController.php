<?php

class DashboardController {

    public function index() {

        $view = 'dashboard/index';

        require __DIR__ . '/../views/layout.php';

    }

}