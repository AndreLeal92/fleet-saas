<?php

require_once __DIR__ . '/../models/Maintenance.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class MaintenanceController {

    private $maintenanceModel;
    private $vehicleModel;

    public function __construct(){

        $this->maintenanceModel = new Maintenance();
        $this->vehicleModel = new VehicleModel();

    }

    public function index(){

        $maintenances = $this->maintenanceModel->all();

        $view = 'maintenance/index';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $vehicles = $this->vehicleModel->all();

        $view = 'maintenance/create';

        require __DIR__ . '/../views/layout.php';

    }

    public function store(){

        $vehicle_id = $_POST['vehicle_id'];
        $description = $_POST['description'];
        $cost = $_POST['cost'];
        $odometer = $_POST['odometer'];
        $maintenance_date = $_POST['maintenance_date'];

        $this->maintenanceModel->create(
            $vehicle_id,
            $description,
            $cost,
            $odometer,
            $maintenance_date
        );

        header("Location: /maintenance");
        exit;

    }

    public function delete(){

        $id = $_GET['id'];

        $this->maintenanceModel->delete($id);

        header("Location: /maintenance");
        exit;

    }

}