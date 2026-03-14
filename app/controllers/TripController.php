<?php

require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class TripController {

    private $tripModel;
    private $driverModel;
    private $vehicleModel;

    public function __construct(){

        $this->tripModel = new Trip();
        $this->driverModel = new DriverModel();
        $this->vehicleModel = new VehicleModel();

    }

    public function index(){

        $trips = $this->tripModel->all();

        $view = 'trips/index';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $drivers = $this->driverModel->all();
        $vehicles = $this->vehicleModel->all();

        $view = 'trips/create';

        require __DIR__ . '/../views/layout.php';

    }

    public function store(){

        $this->tripModel->create(
            $_POST['driver_id'],
            $_POST['vehicle_id'],
            $_POST['origin'],
            $_POST['destination'],
            $_POST['start_km'],
            $_POST['end_km'],
            $_POST['trip_date'],
            $_POST['notes']
        );

        header("Location: /trips");
        exit;
    }

    public function delete(){

        $this->tripModel->delete($_GET['id']);

        header("Location: /trips");
        exit;
    }

}