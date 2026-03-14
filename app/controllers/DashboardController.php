<?php

require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';
require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/Trip.php';
require_once __DIR__ . '/../models/TripExpense.php';

class DashboardController {

    public function index(){

        $vehicleModel = new VehicleModel();
        $driverModel = new DriverModel();
        $fuelModel = new FuelRecord();
        $tripModel = new Trip();
        $expenseModel = new TripExpense();

        $vehicles = count($vehicleModel->all());
        $drivers = count($driverModel->all());
        $fuel = count($fuelModel->all());
        $trips = count($tripModel->all());
        $expenses = count($expenseModel->all());

        $view = 'dashboard/index';

        require __DIR__ . '/../views/layout.php';

    }

}