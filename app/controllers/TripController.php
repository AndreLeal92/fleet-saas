<?php

require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class TripController {

    private $tripModel;
    private $driverModel;
    private $vehicleModel;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        $this->tripModel    = new Trip($company_id);
        $this->driverModel  = new DriverModel($company_id);
        $this->vehicleModel = new VehicleModel($company_id);

    }

    public function index(){

        $trips = $this->tripModel->all();

        $view = 'Trips/index';

        require __DIR__ . '/../views/layout.php';
    }

    public function create(){

        // busca motoristas e veículos
        $drivers  = $this->driverModel->all();
        $vehicles = $this->vehicleModel->all();

        $view = 'Trips/create';

        require __DIR__ . '/../views/layout.php';
    }

    public function delete(){

        $id = $_GET['id'] ?? null;

        if(!$id){
            header("Location: /trips");
            exit;
        }

        $this->tripModel->delete((int)$id);

        header("Location: /trips");
        exit;
    }

}