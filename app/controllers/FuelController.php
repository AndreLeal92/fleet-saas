<?php

require_once __DIR__ . '/../models/FuelRecord.php';
require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../models/DriverModel.php';

class FuelController {

    private $fuelRecord;
    private $vehicleModel;
    private $driverModel;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        $this->fuelRecord   = new FuelRecord($company_id);
        $this->vehicleModel = new VehicleModel($company_id);
        $this->driverModel  = new DriverModel($company_id);

    }

    public function index(){

        $records = $this->fuelRecord->all();

        $view = 'fuel/index';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $vehicles = $this->vehicleModel->all();
        $drivers  = $this->driverModel->all();

        $view = 'fuel/create';

        require __DIR__ . '/../views/layout.php';

    }

    public function delete(){

        $id = $_GET['id'] ?? null;

        if($id){
            $this->fuelRecord->delete($id);
        }

        header("Location: /fuel");
        exit;

    }

}