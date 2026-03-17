<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleCombinationModel{

    private $db;
    private $company_id;

    public function __construct($company_id){

        $this->db = Database::getConnection();
        $this->company_id = $company_id;

    }


    /* ========================================
       CRIAR CONJUNTO CAVALO + CARRETA
    ======================================== */

    public function create($tractor,$trailer){

        /* verifica se cavalo já está atrelado */

        $check = $this->db->prepare("
            SELECT id
            FROM vehicle_combinations
            WHERE tractor_vehicle_id = :tractor
            AND company_id = :company_id
        ");

        $check->execute([
            'tractor'=>$tractor,
            'company_id'=>$this->company_id
        ]);

        if($check->fetch()){
            return false;
        }


        /* verifica se carreta já está atrelada */

        $check = $this->db->prepare("
            SELECT id
            FROM vehicle_combinations
            WHERE trailer_vehicle_id = :trailer
            AND company_id = :company_id
        ");

        $check->execute([
            'trailer'=>$trailer,
            'company_id'=>$this->company_id
        ]);

        if($check->fetch()){
            return false;
        }


        $sql = "INSERT INTO vehicle_combinations
                (company_id, tractor_vehicle_id, trailer_vehicle_id)
                VALUES
                (:company_id, :tractor, :trailer)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'company_id'=>$this->company_id,
            'tractor'=>$tractor,
            'trailer'=>$trailer
        ]);

    }


    /* ========================================
       LISTAR COMBINAÇÕES
    ======================================== */

    public function all(){

        $sql = "SELECT
                vc.id,
                v1.plate AS cavalo,
                v2.plate AS carreta
                FROM vehicle_combinations vc
                JOIN vehicles v1 ON v1.id = vc.tractor_vehicle_id
                JOIN vehicles v2 ON v2.id = vc.trailer_vehicle_id
                WHERE vc.company_id = :company_id
                ORDER BY vc.id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    /* ========================================
       LISTAR VEÍCULOS DISPONÍVEIS
    ======================================== */

    public function getAvailableVehicles(){

        $sql = "SELECT id, plate, model
                FROM vehicles
                WHERE company_id = :company_id
                ORDER BY plate";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    /* ========================================
       DESATRELAR CONJUNTO
    ======================================== */

    public function delete($id){

        $sql = "DELETE FROM vehicle_combinations
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id'=>$id,
            'company_id'=>$this->company_id
        ]);

    }

}