<?php

require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/Trip.php'; // 🔥 NOVO

class FuelController {

    private $fuelRecord;
    private $vehicleModel;
    private $driverModel;
    private $trip;
    private $company_id;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $this->company_id = (int) $_SESSION['company_id'];

        $this->fuelRecord   = new FuelRecord($this->company_id);
        $this->vehicleModel = new VehicleModel($this->company_id);
        $this->driverModel  = new DriverModel($this->company_id);
        $this->trip    = new Trip($this->company_id); // 🔥 NOVO
    }

    public function index(){

        $records = $this->fuelRecord->all();

        $view = 'fuel/index';
        require __DIR__ . '/../views/layout.php';
    }

    public function create(){

        $vehicles = $this->vehicleModel->all();
        $drivers  = $this->driverModel->all();
        $trips    = $this->trip->all(); // 🔥 ESSENCIAL

        $view = 'fuel/create';
        require __DIR__ . '/../views/layout.php';
    }

    public function store(){

        $trip_id    = $_POST['trip_id'] ?? null; // 🔥 NOVO
        $vehicle_id = $_POST['vehicle_id'] ?? null;
        $driver_id  = $_POST['driver_id'] ?? null;
        $liters     = $_POST['liters'] ?? 0;
        $price      = $_POST['price'] ?? 0;
        $total      = $_POST['total'] ?? 0;
        $odometer   = $_POST['odometer'] ?? 0;
        $fuel_date  = $_POST['fuel_date'] ?? date('Y-m-d');

        if(!$vehicle_id || !$driver_id){
            die("Veículo e motorista são obrigatórios");
        }

        $this->fuelRecord->create(
            $trip_id, // 🔥 ORDEM CORRETA
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

    public function delete(){

        $id = $_GET['id'] ?? null;

        if($id){
            $this->fuelRecord->delete((int)$id);
        }

        header("Location: /fuel");
        exit;
    }
}