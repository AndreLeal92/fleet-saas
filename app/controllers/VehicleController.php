<?php

require_once __DIR__ . '/../models/VehicleModel.php';

class VehicleController {

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

        $this->vehicleModel = new VehicleModel($company_id);
    }

    public function index(){

        $vehicles = $this->vehicleModel->all();

        $view = 'vehicles/index';

        require __DIR__ . '/../views/layout.php';
    }

    public function create(){

        $view = 'vehicles/create';

        require __DIR__ . '/../views/layout.php';
    }

    public function store(){

        $plate = $_POST['plate'] ?? '';
        $model = $_POST['model'] ?? '';
        $brand = $_POST['brand'] ?? '';
        $year  = $_POST['year'] ?? 0;

        if(empty($plate) || empty($model)){
            die("Placa e modelo são obrigatórios");
        }

        $this->vehicleModel->create($plate, $model, $brand, $year);

        header("Location: /vehicles");
        exit;
    }

    public function delete(){

        $id = $_GET['id'] ?? null;

        if($id){
            $this->vehicleModel->delete((int)$id);
        }

        header("Location: /vehicles");
        exit;
    }

}