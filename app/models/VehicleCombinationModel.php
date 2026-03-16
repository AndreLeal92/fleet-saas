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

        $sql = "INSERT INTO vehicle_combinations
                (company_id,tractor_id,trailer_id)
                VALUES
                (:company_id,:tractor,:trailer)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'company_id'=>$this->company_id,
            'tractor'=>$tractor,
            'trailer'=>$trailer
        ]);

    }


    /* ========================================
       LISTAR CONJUNTOS
    ======================================== */

    public function all(){

        $sql = "SELECT
                vc.id,
                v1.plate AS cavalo,
                v2.plate AS carreta
                FROM vehicle_combinations vc
                JOIN vehicles v1 ON v1.id = vc.tractor_id
                JOIN vehicles v2 ON v2.id = vc.trailer_id
                WHERE vc.company_id = :company_id
                ORDER BY vc.id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    /* ========================================
       EXCLUIR CONJUNTO
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