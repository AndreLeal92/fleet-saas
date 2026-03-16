<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleModel {

    private PDO $db;
    private int $company_id;


    public function __construct(int $company_id){

        $this->db = Database::getConnection();
        $this->company_id = $company_id;

    }


    /* =========================================
       LISTAR VEÍCULOS
    ========================================= */

    public function all(): array {

        $sql = "SELECT *
                FROM vehicles
                WHERE company_id = :company_id
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id' => $this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /* =========================================
       BUSCAR VEÍCULO
    ========================================= */

    public function find(int $id): ?array {

        $sql = "SELECT *
                FROM vehicles
                WHERE id = :id
                AND company_id = :company_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);

        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

        return $vehicle ?: null;
    }


    /* =========================================
       CRIAR VEÍCULO
    ========================================= */

    public function create(

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

        $crlv_file

    ): bool {

        $sql = "INSERT INTO vehicles (

            company_id,

            plate,
            year_fab,
            brand,
            model,

            renavam,
            chassis,

            fuel_type,
            uses_arla32,

            tire_size,

            fuel_tank_capacity,
            arla_tank_capacity,

            cargo_capacity,
            pbt,

            owner_name,
            owner_document,
            owner_phone,

            responsible_name,
            owner_email,

            cep,
            logradouro,
            numero,
            bairro,
            cidade,
            estado,

            status,
            crlv_file

        )

        VALUES (

            :company_id,

            :plate,
            :year_fab,
            :brand,
            :model,

            :renavam,
            :chassis,

            :fuel_type,
            :uses_arla32,

            :tire_size,

            :fuel_tank_capacity,
            :arla_tank_capacity,

            :cargo_capacity,
            :pbt,

            :owner_name,
            :owner_document,
            :owner_phone,

            :responsible_name,
            :owner_email,

            :cep,
            :logradouro,
            :numero,
            :bairro,
            :cidade,
            :estado,

            :status,
            :crlv_file
        )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'company_id' => $this->company_id,

            'plate' => $plate,
            'year_fab' => $year_fab,
            'brand' => $brand,
            'model' => $model,

            'renavam' => $renavam,
            'chassis' => $chassis,

            'fuel_type' => $fuel_type,
            'uses_arla32' => $uses_arla32,

            'tire_size' => $tire_size,

            'fuel_tank_capacity' => $fuel_tank_capacity,
            'arla_tank_capacity' => $arla_tank_capacity,

            'cargo_capacity' => $cargo_capacity,
            'pbt' => $pbt,

            'owner_name' => $owner_name,
            'owner_document' => $owner_document,
            'owner_phone' => $owner_phone,

            'responsible_name' => $responsible_name,
            'owner_email' => $owner_email,

            'cep' => $cep,
            'logradouro' => $logradouro,
            'numero' => $numero,
            'bairro' => $bairro,
            'cidade' => $cidade,
            'estado' => $estado,

            'status' => $status,
            'crlv_file' => $crlv_file
        ]);
    }


    /* =========================================
       ATUALIZAR VEÍCULO
    ========================================= */

    public function updateVehicle(
        $id,
        $plate,
        $brand,
        $model,
        $year_fab,
        $crlv_file
    ){

        $sql = "UPDATE vehicles
                SET

                plate = :plate,
                brand = :brand,
                model = :model,
                year_fab = :year_fab,
                crlv_file = :crlv_file

                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'plate'=>$plate,
            'brand'=>$brand,
            'model'=>$model,
            'year_fab'=>$year_fab,
            'crlv_file'=>$crlv_file,
            'id'=>$id,
            'company_id'=>$this->company_id
        ]);
    }


    /* =========================================
       REMOVER VEÍCULO
    ========================================= */

    public function delete(int $id): bool {

        $sql = "DELETE FROM vehicles
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);
    }


    /* =========================================
       TIPOS DE COMBUSTÍVEL
    ========================================= */

    public function getFuelTypes(){

        $sql = "SELECT DISTINCT fuel_type
                FROM vehicles
                WHERE fuel_type IS NOT NULL
                AND fuel_type != ''
                AND company_id = :company_id
                ORDER BY fuel_type";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /* =========================================
       TIPOS DE VEÍCULO
    ========================================= */

    public function getVehicleTypes(){

        $sql = "SELECT DISTINCT vehicle_type
                FROM vehicles
                WHERE vehicle_type IS NOT NULL
                AND vehicle_type != ''
                AND company_id = :company_id
                ORDER BY vehicle_type";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}