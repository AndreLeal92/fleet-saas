<?php

require_once __DIR__ . '/../models/VehicleModel.php';

class VehicleController {

    private $vehicleModel;

    public function __construct() {
        $this->vehicleModel = new VehicleModel();
    }

    public function index() {

        $vehicles = $this->vehicleModel->all();

        $view = 'vehicles/index';

        require __DIR__ . '/../views/layout.php';
    }

    public function create() {

        $view = 'vehicles/create';

        require __DIR__ . '/../views/layout.php';
    }

    public function store() {

        $plate = $_POST['plate'] ?? '';
        $model = $_POST['model'] ?? '';
        $brand = $_POST['brand'] ?? '';
        $year = $_POST['year'] ?? '';

        $this->vehicleModel->create($plate,$model,$brand,$year);

        header("Location: /vehicles");
        exit;
    }

    public function delete($id) {

        $this->vehicleModel->delete($id);

        header("Location: /vehicles");
        exit;
    }

}