<?php

require_once __DIR__ . '/../models/VehicleCombinationModel.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class VehicleCombinationController {

    private $model;
    private $vehicleModel;
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

        $this->model = new VehicleCombinationModel($this->company_id);
        $this->vehicleModel = new VehicleModel($this->company_id);
    }

    public function index(){

        $combinations = $this->model->all();

        $view = 'vehicle-combinations/index';
        require __DIR__ . '/../views/layout.php';
    }

    public function create(){

        $vehicles = $this->vehicleModel->all();

        $view = 'vehicle-combinations/create';
        require __DIR__ . '/../views/layout.php';
    }

    public function store(){

        $tractor = $_POST['tractor_id'] ?? null;
        $trailers = $_POST['trailers'] ?? [];

        $trailers = array_filter($trailers);

        if(!$tractor){
            $_SESSION['error'] = "Selecione o cavalo";
            header("Location: /vehicle-combinations/create");
            exit;
        }

        if(empty($trailers)){
            $_SESSION['error'] = "Selecione ao menos um implemento";
            header("Location: /vehicle-combinations/create");
            exit;
        }

        if(count($trailers) !== count(array_unique($trailers))){
            $_SESSION['error'] = "Implementos duplicados não são permitidos";
            header("Location: /vehicle-combinations/create");
            exit;
        }

        if(in_array($tractor, $trailers)){
            $_SESSION['error'] = "O cavalo não pode ser um implemento";
            header("Location: /vehicle-combinations/create");
            exit;
        }

        $result = $this->model->create($tractor, $trailers);

        if(!$result['success']){
            $_SESSION['error'] = $result['message'];
            header("Location: /vehicle-combinations/create");
            exit;
        }

        $_SESSION['success'] = "Veículos atrelados com sucesso!";
        header("Location: /vehicle-combinations");
        exit;
    }

    public function detach(){

        $id = $_GET['id'] ?? null;

        if($id){
            $this->model->delete($id);
            $_SESSION['success'] = "Desatrelado com sucesso!";
        }

        header("Location: /vehicle-combinations");
        exit;
    }
}