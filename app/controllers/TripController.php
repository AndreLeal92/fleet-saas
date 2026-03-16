<?php

require_once __DIR__ . '/../models/Trip.php';

class TripController {

    private $tripModel;

    public function __construct(){

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        $this->tripModel = new Trip($company_id);
    }

    public function index(){

        // BUSCA AS VIAGENS
        $trips = $this->tripModel->all();

        // DEFINE VIEW
        $view = 'Trips/index';

        require __DIR__ . '/../views/layout.php';
    }

    public function create(){

    $view = 'Trips/create';

    require __DIR__ . '/../views/layout.php';

}

public function delete(){

    $id = $_GET['id'] ?? null;

    if(!$id){
        header("Location: /trips");
        exit;
    }

    $this->tripModel->delete($id);

    header("Location: /trips");
    exit;

}

}