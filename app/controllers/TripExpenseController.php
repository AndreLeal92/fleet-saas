<?php

require_once __DIR__ . '/../models/TripExpense.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/Trip.php';

class TripExpenseController {

    private $expenseModel;
    private $driverModel;
    private $vehicleModel;
    private $tripModel;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        $this->expenseModel = new TripExpense($company_id);
        $this->driverModel  = new DriverModel($company_id);
        $this->vehicleModel = new VehicleModel($company_id);
        $this->tripModel    = new Trip($company_id);
    }


    // ======================
    // LISTAR DESPESAS
    // ======================

    public function index(){

        $expenses = $this->expenseModel->all();

        $view = 'trip-expenses/index';

        require __DIR__ . '/../views/layout.php';
    }


    // ======================
    // FORM CRIAR DESPESA
    // ======================

    public function create(){

        $drivers  = $this->driverModel->all();
        $vehicles = $this->vehicleModel->all();
        $trips    = $this->tripModel->all();

        $view = 'trip-expenses/create';

        require __DIR__ . '/../views/layout.php';
    }


    // ======================
    // SALVAR DESPESA
    // ======================

    public function store(){

        $trip_id      = $_POST['trip_id'] ?? null;
        $driver_id    = $_POST['driver_id'] ?? null;
        $vehicle_id   = $_POST['vehicle_id'] ?? null;
        $expense_type = $_POST['expense_type'] ?? '';
        $description  = $_POST['description'] ?? '';
        $location     = $_POST['location'] ?? '';
        $amount       = $_POST['amount'] ?? 0;
        $expense_date = $_POST['expense_date'] ?? date('Y-m-d');

        if(!$trip_id){
            die("A viagem é obrigatória");
        }

        $this->expenseModel->create(
            $trip_id,
            $driver_id,
            $vehicle_id,
            $expense_type,
            $description,
            $location,
            $amount,
            $expense_date
        );

        header("Location: /trip-expenses");
        exit;
    }


    // ======================
    // EXCLUIR DESPESA
    // ======================

    public function delete(){

        $id = $_GET['id'] ?? null;

        if(!$id){
            header("Location: /trip-expenses");
            exit;
        }

        $this->expenseModel->delete($id);

        header("Location: /trip-expenses");
        exit;
    }

}