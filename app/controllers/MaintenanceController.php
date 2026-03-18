<?php

require_once __DIR__ . '/../models/Maintenance.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class MaintenanceController {

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

        $this->model = new Maintenance($this->company_id);
        $this->vehicleModel = new VehicleModel($this->company_id);
    }

    // ========================================
    // LISTAGEM
    // ========================================
    public function index(){

        // 🔥 atualiza status automaticamente
        $this->model->updateStatusAuto();

        $records = $this->model->all();
        $alerts  = $this->model->alerts();
        $stats   = $this->model->stats();
        $ranking = $this->model->costByVehicle();
        $monthly = $this->model->costPerMonth();
        $realCost = $this->model->realCostPerKm();

        $view = 'maintenance/index';
        require __DIR__ . '/../views/layout.php';
    }

    // ========================================
    // FORM CREATE
    // ========================================
    public function create(){

        $vehicles = $this->vehicleModel->all();

        $view = 'maintenance/create';
        require __DIR__ . '/../views/layout.php';
    }

    // ========================================
    // SALVAR
    // ========================================
    public function store(){

        // 🔒 SANITIZAÇÃO
        $vehicle_id       = (int) ($_POST['vehicle_id'] ?? 0);
        $type             = trim($_POST['type'] ?? '');
        $description      = trim($_POST['description'] ?? '');
        $cost             = (float) ($_POST['cost'] ?? 0);
        $km               = (int) ($_POST['km'] ?? 0);
        $next_km          = !empty($_POST['next_km']) ? (int) $_POST['next_km'] : null;
        $maintenance_date = !empty($_POST['maintenance_date']) 
                            ? $_POST['maintenance_date'] 
                            : date('Y-m-d');

        // 🚫 VALIDAÇÃO
        if($vehicle_id <= 0){
            die("Veículo é obrigatório");
        }

        if($type == ''){
            die("Tipo de manutenção é obrigatório");
        }

        // 💾 SALVAR
        $this->model->create(
            $vehicle_id,
            $type,
            $description,
            $cost,
            $km,
            $next_km,
            $maintenance_date
        );

        // 🔁 REDIRECT
        header("Location: /maintenance");
        exit;
    }

    // ========================================
    // EXCLUIR
    // ========================================
    public function delete(){

        $id = (int) ($_GET['id'] ?? 0);

        if($id > 0){
            $this->model->delete($id);
        }

        header("Location: /maintenance");
        exit;
    }

}