<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class VehicleController {

    public function index() {

        AuthMiddleware::handle();

        echo "Lista de veículos";

    }

}