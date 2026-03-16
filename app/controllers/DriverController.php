<?php

require_once __DIR__ . '/../models/DriverModel.php';

class DriverController {

    private $driverModel;

    public function __construct() {

        $this->driverModel = new DriverModel();

    }

    public function index(){

        $drivers = $this->driverModel->all();

        $view = 'drivers/index';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $view = 'drivers/create';

        require __DIR__ . '/../views/layout.php';

    }

    public function store(){

        $name = $_POST['name'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $cnh = $_POST['cnh'] ?? '';
        $phone = $_POST['phone'] ?? '';

        $this->driverModel->create($name,$cpf,$cnh,$phone);

        header("Location: /drivers");
        exit;

    }

public function delete(){

    $id = $_GET['id'] ?? null;

    if($id){

        $deleted = $this->driverModel->delete($id);

        if(!$deleted){
            header("Location: /drivers?error=has_fuel");
            exit;
        }

    }

    header("Location: /drivers");
    exit;

}

}