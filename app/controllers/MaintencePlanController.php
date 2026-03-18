<?php

require_once __DIR__ . '/../models/MaintenancePlan.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class MaintenancePlanController {

    private $model;
    private $vehicleModel;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = $_SESSION['company_id'];

        $this->model = new MaintenancePlan($company_id);
        $this->vehicleModel = new VehicleModel($company_id);
    }

    public function index(){

        $plans = $this->model->all();

        $view = 'maintenance-plans/index';
        require __DIR__ . '/../views/layout.php';
    }

    public function create(){

        $vehicles = $this->vehicleModel->all();

        $view = 'maintenance-plans/create';
        require __DIR__ . '/../views/layout.php';
    }

    public function store(){

        $this->model->create(
            $_POST['vehicle_id'],
            $_POST['name'],
            $_POST['description'],
            $_POST['interval_km'],
            $_POST['interval_days']
        );

        header("Location: /maintenance-plans");
        exit;
    }

    public function delete(){

        $this->model->delete($_GET['id']);

        header("Location: /maintenance-plans");
        exit;
    }
}