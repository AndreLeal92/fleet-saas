<?php

require_once __DIR__ . '/../models/VehicleModel.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class VehicleController {

    private $vehicleModel;

    public function __construct(){

        $this->vehicleModel = new VehicleModel();

    }

    public function index(){

        AuthMiddleware::handle();

        $vehicles = $this->vehicleModel->all();

        $view = __DIR__ . '/../views/vehicles/index.php';

        require __DIR__ . '/../views/layout.php';

    }

    public function create(){

        $view = __DIR__ . '/../views/vehicles/create.php';

        require __DIR__ . '/../views/layout.php';

    }

    public function store(){

        $plate = $_POST['plate'];
        $model = $_POST['model'];
        $year = $_POST['year'];

        $this->vehicleModel->create($plate,$model,$year);

        header("Location: /vehicles?success=1");
        exit;

    }

    public function delete(){

        $id = $_GET['id'];

        $this->vehicleModel->delete($id);

        header("Location: /vehicles?deleted=1");
        exit;

    }

}
