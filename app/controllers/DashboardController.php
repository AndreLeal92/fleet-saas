<?php

require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../models/TripExpense.php';
require_once __DIR__ . '/../models/VehicleDocumentModel.php';
require_once __DIR__ . '/../models/Maintenance.php'; // 🔥 NOVO

class DashboardController {

    public function index(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        // Models
        $vehicleModel = new VehicleModel($company_id);
        $driverModel  = new DriverModel($company_id);
        $fuelModel    = new FuelRecord($company_id);
        $tripModel    = new Trip($company_id);
        $expenseModel = new TripExpense($company_id);
        $docModel     = new VehicleDocumentModel($company_id);
        $maintenanceModel = new Maintenance($company_id); // 🔥 NOVO

        // Contagens
        $vehicles = count($vehicleModel->all());
        $drivers  = count($driverModel->all());
        $fuel     = count($fuelModel->all());
        $trips    = count($tripModel->all());
        $expenses = count($expenseModel->all());

        // ALERTAS
        $alerts = $docModel->expiringSoon();

        // 💰 KPI GLOBAL
        $realCost = $maintenanceModel->realCostPerKm();

        $view = 'dashboard/index';
        require __DIR__ . '/../views/layout.php';
    }

}