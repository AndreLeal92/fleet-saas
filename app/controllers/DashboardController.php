<?php

// Importação dos Models
require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../models/TripExpense.php';

class DashboardController {

    public function index()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $company_id = $_SESSION['company_id'];

        // Instanciando os modelos
        $vehicleModel = new VehicleModel($company_id);
        $driverModel  = new DriverModel($company_id);
        $fuelModel    = new FuelRecord($company_id);
        $tripModel    = new Trip($company_id);
        $expenseModel = new TripExpense($company_id);

        // Contagens
        $vehicles = count($vehicleModel->all());
        $drivers  = count($driverModel->all());
        $fuel     = count($fuelModel->all());
        $trips    = count($tripModel->all());
        $expenses = count($expenseModel->all());

        // View que será carregada
        $view = 'dashboard/index';

        require __DIR__ . '/../views/layout.php';
    }

}