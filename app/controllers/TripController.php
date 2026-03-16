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

    // ======================
    // LISTAR VIAGENS
    // ======================

    public function index(){

        $trips = $this->tripModel->all();

        $view = 'Trips/index';

        require __DIR__ . '/../views/layout.php';
    }


    // ======================
    // FORM CRIAR
    // ======================

    public function create(){

        $drivers  = $this->driverModel->all();
        $vehicles = $this->vehicleModel->all();

        $view = 'Trips/create';

        require __DIR__ . '/../views/layout.php';
    }


    // ======================
    // SALVAR VIAGEM
    // ======================

    public function store(){

        $driver_id   = $_POST['driver_id'] ?? null;
        $vehicle_id  = $_POST['vehicle_id'] ?? null;
        $origin      = $_POST['origin'] ?? '';
        $destination = $_POST['destination'] ?? '';
        $trip_date   = $_POST['trip_date'] ?? date('Y-m-d');
        $km_start    = $_POST['km_start'] ?? 0;
        $km_end      = $_POST['km_end'] ?? 0;

        if(!$driver_id || !$vehicle_id){
            die("Motorista e veículo são obrigatórios");
        }

        $this->tripModel->create(
            $driver_id,
            $vehicle_id,
            $origin,
            $destination,
            $trip_date,
            $km_start,
            $km_end
        );

        header("Location: /trips");
        exit;
    }


    // ======================
    // FORM EDITAR
    // ======================

    public function edit(){

        $id = $_GET['id'] ?? null;

        if(!$id){
            header("Location: /trips");
            exit;
        }

        $trip = $this->tripModel->find($id);

        $drivers  = $this->driverModel->all();
        $vehicles = $this->vehicleModel->all();

        $view = 'Trips/edit';

        require __DIR__ . '/../views/layout.php';
    }


    // ======================
    // ATUALIZAR VIAGEM
    // ======================

    public function update(){

        $id = $_POST['id'] ?? null;

        if(!$id){
            header("Location: /trips");
            exit;
        }

        $driver_id   = $_POST['driver_id'];
        $vehicle_id  = $_POST['vehicle_id'];
        $origin      = $_POST['origin'];
        $destination = $_POST['destination'];
        $trip_date   = $_POST['trip_date'];
        $km_start    = $_POST['km_start'];
        $km_end      = $_POST['km_end'];

        $this->tripModel->update(
            $id,
            $driver_id,
            $vehicle_id,
            $origin,
            $destination,
            $trip_date,
            $km_start,
            $km_end
        );

        header("Location: /trips");
        exit;
    }


    // ======================
    // EXCLUIR VIAGEM
    // ======================

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