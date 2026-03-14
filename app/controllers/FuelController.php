<?php

require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';

class FuelController {

    private $fuelModel;
    private $vehicleModel;
    private $driverModel;

    public function __construct(){

        $this->fuelModel = new FuelRecord();
        $this->vehicleModel = new VehicleModel();
        $this->driverModel = new DriverModel();

    }

    public function index(){

        $records = $this->fuelModel->all();

        $view = 'fuel/index';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $vehicles = $this->vehicleModel->all();
        $drivers = $this->driverModel->all();

        $view = 'fuel/create';

        require __DIR__ . '/../views/layout.php';

    }

    public function store(){

        $vehicle_id = $_POST['vehicle_id'];
        $driver_id = $_POST['driver_id'];
        $liters = $_POST['liters'];
        $price = $_POST['price'];
        $total = $_POST['total'];
        $odometer = $_POST['odometer'];
        $fuel_date = $_POST['fuel_date'];

        $this->fuelModel->create(
            $vehicle_id,
            $driver_id,
            $liters,
            $price,
            $total,
            $odometer,
            $fuel_date
        );

        header("Location: /fuel");
        exit;

    }

    public function delete($id){

        $this->fuelModel->delete($id);

        header("Location: /fuel");
        exit;

    }

}