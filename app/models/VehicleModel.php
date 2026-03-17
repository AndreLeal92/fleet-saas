<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleModel {

    private PDO $db;
    private int $company_id;

    public function __construct(int $company_id){
        $this->db = Database::getConnection();
        $this->company_id = $company_id;

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* =========================================
       HELPERS
    ========================================= */

    private function toDecimal($value){
        return ($value === '' || $value === null) ? null : (float)$value;
    }

    private function toInt($value){
        return ($value === '' || $value === null) ? null : (int)$value;
    }

    private function toBool($value){
        return $value ? 1 : 0;
    }

    private function toNull($value){
        return ($value === '' || $value === null) ? null : $value;
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

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
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

        // 🔥 NORMALIZAÇÃO
        $year_fab = $this->toInt($year_fab);

        $fuel_tank_capacity = $this->toDecimal($fuel_tank_capacity);
        $arla_tank_capacity = $this->toDecimal($arla_tank_capacity);

        $cargo_capacity = $this->toInt($cargo_capacity);
        $pbt = $this->toInt($pbt);

        $uses_arla32 = $this->toBool($uses_arla32);

        // strings opcionais
        $renavam = $this->toNull($renavam);
        $chassis = $this->toNull($chassis);
        $owner_email = $this->toNull($owner_email);

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

        ) VALUES (

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
        int $id,
        string $plate,
        string $brand,
        string $model,
        $year_fab,
        ?string $crlv_file
    ): bool{

        $year_fab = $this->toInt($year_fab);

        $sql = "UPDATE vehicles
                SET
                plate = :plate,
                brand = :brand,
                model = :model,
                year_fab = :year_fab,
                crlv_file = :crlv_file
                WHERE id = :id
                AND company_id = :company_id
                LIMIT 1";

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

        $stmt = $this->db->prepare("
            DELETE FROM vehicles
            WHERE id = :id
            AND company_id = :company_id
            LIMIT 1
        ");

        return $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);
    }

    /* =========================================
       TIPOS DE COMBUSTÍVEL
    ========================================= */

    public function getFuelTypes(): array{

        $stmt = $this->db->prepare("
            SELECT DISTINCT fuel_type
            FROM vehicles
            WHERE fuel_type IS NOT NULL
            AND fuel_type != ''
            AND company_id = :company_id
            ORDER BY fuel_type
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================================
       TIPOS DE VEÍCULO
    ========================================= */

    public function getVehicleTypes(): array{

        $stmt = $this->db->prepare("
            SELECT DISTINCT vehicle_type
            FROM vehicles
            WHERE vehicle_type IS NOT NULL
            AND vehicle_type != ''
            AND company_id = :company_id
            ORDER BY vehicle_type
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}