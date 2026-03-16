<?php

require_once __DIR__ . '/../models/TripExpense.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class TripExpenseController {

    private $expenseModel;
    private $driverModel;
    private $vehicleModel;

    public function __construct(){

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        $this->expenseModel = new TripExpense($company_id);
        $this->driverModel  = new DriverModel($company_id);
        $this->vehicleModel = new VehicleModel($company_id);
    }

    public function index(){

        $expenses = $this->expenseModel->all();

        $view = 'trip-expenses/index';

        require __DIR__ . '/../views/layout.php';
    }

}