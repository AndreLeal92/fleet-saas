<?php

require_once __DIR__ . '/../models/VehicleModel.php';

class VehicleController {

    private $vehicleModel;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['company_id'])){
            header("Location: /login");
            exit;
        }

        $company_id = (int) $_SESSION['company_id'];

        $this->vehicleModel = new VehicleModel($company_id);
    }

    /* ================================
       LISTAR VEÍCULOS
    ================================= */

    public function index(){

        $vehicles = $this->vehicleModel->all();

        $view = 'vehicles/index';

        require __DIR__ . '/../views/layout.php';
    }

    /* ================================
       FORM NOVO VEÍCULO
    ================================= */

    public function create(){

        $fuelTypes = $this->vehicleModel->getFuelTypes();
        $vehicleTypes = $this->vehicleModel->getVehicleTypes();

        $view = 'vehicles/create';

        require __DIR__ . '/../views/layout.php';
    }

    /* ================================
       SALVAR VEÍCULO
    ================================= */

    public function store(){

        $plate = trim($_POST['plate'] ?? '');
        $year_fab = $_POST['year_fab'] ?? null;

        $brand = trim($_POST['brand'] ?? '');
        $model = trim($_POST['model'] ?? '');

        $renavam = $_POST['renavam'] ?? '';
        $chassis = $_POST['chassis'] ?? '';

        $fuel_type = $_POST['fuel_type'] ?? '';
        $uses_arla32 = isset($_POST['uses_arla32']) ? 1 : 0;

        $tire_size = $_POST['tire_size'] ?? '';

        $fuel_tank_capacity = $_POST['fuel_tank_capacity'] ?? null;
        $arla_tank_capacity = $_POST['arla_tank_capacity'] ?? null;

        $cargo_capacity = $_POST['cargo_capacity'] ?? null;
        $pbt = $_POST['pbt'] ?? null;

        $owner_name = $_POST['owner_name'] ?? '';
        $owner_document = $_POST['owner_document'] ?? '';
        $owner_phone = $_POST['owner_phone'] ?? '';

        $responsible_name = $_POST['responsible_name'] ?? '';
        $owner_email = $_POST['owner_email'] ?? '';

        $cep = $_POST['cep'] ?? '';
        $logradouro = $_POST['logradouro'] ?? '';
        $numero = $_POST['numero'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $estado = $_POST['estado'] ?? '';

        $status = $_POST['status'] ?? 1;

        /* UPLOAD CRLV */

        $crlvPath = null;

        if(isset($_FILES['crlv_file']) && $_FILES['crlv_file']['error'] == 0){

            $uploadDir = __DIR__ . '/../../public/uploads/crlv/';

            if(!is_dir($uploadDir)){
                mkdir($uploadDir,0777,true);
            }

            $fileName = time().'_'.basename($_FILES['crlv_file']['name']);

            move_uploaded_file(
                $_FILES['crlv_file']['tmp_name'],
                $uploadDir.$fileName
            );

            $crlvPath = '/uploads/crlv/'.$fileName;
        }

        if(empty($plate)){
            die("Placa é obrigatória");
        }

        $this->vehicleModel->create(

            $plate,
            $year_fab,
            $brand,
            $model,

            $renavam,
            $chassis,

            $fuel_type,
            $uses_arla32,

            $tire_size,

            $fuel_tank_capacity,
            $arla_tank_capacity,

            $cargo_capacity,
            $pbt,

            $owner_name,
            $owner_document,
            $owner_phone,

            $responsible_name,
            $owner_email,

            $cep,
            $logradouro,
            $numero,
            $bairro,
            $cidade,
            $estado,

            $status,

            $crlvPath
        );

        header("Location: /vehicles");
        exit;
    }

    /* ================================
       EDITAR VEÍCULO
    ================================= */

    public function edit(){

        $id = $_GET['id'] ?? null;

        if(!$id){
            die("Veículo não encontrado");
        }

        $vehicle = $this->vehicleModel->find((int)$id);

        if(!$vehicle){
            die("Veículo não encontrado");
        }

        $fuelTypes = $this->vehicleModel->getFuelTypes();
        $vehicleTypes = $this->vehicleModel->getVehicleTypes();

        $view = 'vehicles/edit';

        require __DIR__ . '/../views/layout.php';
    }

    /* ================================
       ATUALIZAR VEÍCULO
    ================================= */

    public function update(){

        $id = $_POST['id'] ?? null;

        if(!$id){
            die("ID inválido");
        }

        $plate = $_POST['plate'] ?? '';
        $year_fab = $_POST['year_fab'] ?? null;
        $brand = $_POST['brand'] ?? '';
        $model = $_POST['model'] ?? '';

        $crlvPath = $_POST['crlv_atual'] ?? null;

        if(isset($_FILES['crlv_file']) && $_FILES['crlv_file']['error'] == 0){

            $uploadDir = __DIR__ . '/../../public/uploads/crlv/';

            if(!is_dir($uploadDir)){
                mkdir($uploadDir,0777,true);
            }

            $fileName = time().'_'.basename($_FILES['crlv_file']['name']);

            move_uploaded_file(
                $_FILES['crlv_file']['tmp_name'],
                $uploadDir.$fileName
            );

            $crlvPath = '/uploads/crlv/'.$fileName;
        }

        $this->vehicleModel->updateVehicle(
            $id,
            $plate,
            $brand,
            $model,
            $year_fab,
            $crlvPath
        );

        header("Location: /vehicles");
        exit;
    }

    /* ================================
       EXCLUIR VEÍCULO
    ================================= */

    public function delete(){

        $id = $_GET['id'] ?? null;

        if($id){
            $this->vehicleModel->delete((int)$id);
        }

        header("Location: /vehicles");
        exit;
    }

    /* ================================
       EXPORTAR CSV / PDF
    ================================= */

    public function export(){

        $type = $_GET['type'] ?? 'csv';
        $status = $_GET['status'] ?? 'all';

        $vehicles = $this->vehicleModel->all();

        if($status !== 'all'){
            $vehicles = array_filter($vehicles,function($v) use ($status){
                return $v['status'] == $status;
            });
        }

        if($type === 'csv'){

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=frota.csv');

            $output = fopen('php://output','w');

            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($output,[
                'ID','Placa','Marca','Modelo','Ano',
                'Renavam','Chassis','Combustível',
                'Usa Arla32','Pneu',
                'Capacidade Combustível','Capacidade Arla32',
                'Capacidade Carga','PBT',
                'Proprietário','Documento','Telefone',
                'Responsável','Email',
                'CEP','Logradouro','Número','Bairro',
                'Cidade','Estado','Status'
            ],';');

            foreach($vehicles as $v){

                fputcsv($output,[
                    $v['id'] ?? '',
                    $v['plate'] ?? '',
                    $v['brand'] ?? '',
                    $v['model'] ?? '',
                    $v['year_fab'] ?? '',
                    $v['renavam'] ?? '',
                    $v['chassis'] ?? '',
                    $v['fuel_type'] ?? '',
                    !empty($v['uses_arla32']) ? 'Sim':'Não',
                    $v['tire_size'] ?? '',
                    $v['fuel_tank_capacity'] ?? '',
                    $v['arla_tank_capacity'] ?? '',
                    $v['cargo_capacity'] ?? '',
                    $v['pbt'] ?? '',
                    $v['owner_name'] ?? '',
                    $v['owner_document'] ?? '',
                    $v['owner_phone'] ?? '',
                    $v['responsible_name'] ?? '',
                    $v['owner_email'] ?? '',
                    $v['cep'] ?? '',
                    $v['logradouro'] ?? '',
                    $v['numero'] ?? '',
                    $v['bairro'] ?? '',
                    $v['cidade'] ?? '',
                    $v['estado'] ?? '',
                    $v['status'] ? 'Ativo':'Inativo'
                ],';');

            }

            fclose($output);
            exit;
        }

        if($type === 'pdf'){

            echo "<h1>Relatório de Veículos</h1>";

            echo "<table border='1' cellpadding='5'>";

            echo "<tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Status</th>
            </tr>";

            foreach($vehicles as $v){

                echo "<tr>
                <td>{$v['id']}</td>
                <td>{$v['plate']}</td>
                <td>{$v['brand']}</td>
                <td>{$v['model']}</td>
                <td>{$v['year_fab']}</td>
                <td>".($v['status']?'Ativo':'Inativo')."</td>
                </tr>";

            }

            echo "</table>";
            exit;
        }

    }

}