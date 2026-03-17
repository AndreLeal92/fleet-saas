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


    /* ========================================
       LISTAR COMBINAÇÕES
    ======================================== */

    public function index(){

        $combinations = $this->model->all();

        $view = 'vehicle-combinations/index';

        require __DIR__ . '/../views/layout.php';

    }


    /* ========================================
       FORM ATRELAR CAVALO + CARRETA
    ======================================== */

    public function create(){

        $vehicles = $this->vehicleModel->all();

        $view = 'vehicle-combinations/create';

        require __DIR__ . '/../views/layout.php';

    }


    /* ========================================
       SALVAR COMBINAÇÃO
    ======================================== */

    public function store(){

        $tractor = $_POST['tractor_id'] ?? null;
        $trailer = $_POST['trailer_id'] ?? null;

        if(!$tractor || !$trailer){
            die("Selecione cavalo e carreta");
        }

        $this->model->create($tractor,$trailer);

        header("Location: /vehicle-combinations");
        exit;

    }


    /* ========================================
       DESATRELAR
    ======================================== */

    public function detach(){

        $id = $_GET['id'] ?? null;

        if($id){
            $this->model->delete($id);
        }

        header("Location: /vehicle-combinations");
        exit;

    }

}