<?php

require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../models/TripExpense.php';
require_once __DIR__ . '/../models/VehicleDocumentModel.php';

class DashboardController {

    public function index()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = $_SESSION['company_id'];

        // Models
        $vehicleModel = new VehicleModel($company_id);
        $driverModel  = new DriverModel($company_id);
        $fuelModel    = new FuelRecord($company_id);
        $tripModel    = new Trip($company_id);
        $expenseModel = new TripExpense($company_id);
        $docModel     = new VehicleDocumentModel($company_id);

        // Contagens
        $vehicles = count($vehicleModel->all());
        $drivers  = count($driverModel->all());
        $fuel     = count($fuelModel->all());
        $trips    = count($tripModel->all());
        $expenses = count($expenseModel->all());

        // ALERTA DE DOCUMENTOS VENCENDO
        $alerts = $docModel->expiringSoon();

        $view = 'dashboard/index';

        require __DIR__ . '/../views/layout.php';
    }

}