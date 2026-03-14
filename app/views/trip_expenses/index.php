<?php

require_once __DIR__ . '/../models/TripExpense.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/VehicleModel.php';

class TripExpenseController {

    private $expenseModel;
    private $driverModel;
    private $vehicleModel;

    public function __construct(){

        $this->expenseModel = new TripExpense();
        $this->driverModel = new DriverModel();
        $this->vehicleModel = new VehicleModel();

    }

    public function index(){

        $expenses = $this->expenseModel->all();

        $view = 'trip_expenses/index';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $drivers = $this->driverModel->all();
        $vehicles = $this->vehicleModel->all();

        $view = 'trip_expenses/create';

        require __DIR__ . '/../views/layout.php';

    }

    public function store(){

        $this->expenseModel->create(
            $_POST['driver_id'],
            $_POST['vehicle_id'],
            $_POST['expense_type'],
            $_POST['description'],
            $_POST['location'],
            $_POST['amount'],
            $_POST['expense_date']
        );

        header("Location: /trip-expenses");
        exit;
    }

    public function delete(){

        $this->expenseModel->delete($_GET['id']);

        header("Location: /trip-expenses");
        exit;
    }

}