<?php

require_once __DIR__ . '/../../config/database.php';

class MaintenancePlan {

    private $db;
    private $company_id;

    public function __construct($company_id){
        $this->db = Database::getConnection();
        $this->company_id = $company_id;
    }

    public function all(){

        $stmt = $this->db->prepare("
            SELECT mp.*, v.plate
            FROM maintenance_plans mp
            LEFT JOIN vehicles v ON v.id = mp.vehicle_id
            WHERE mp.company_id = :company_id
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($vehicle,$name,$desc,$km,$days){

        $stmt = $this->db->prepare("
            INSERT INTO maintenance_plans
            (company_id,vehicle_id,name,description,interval_km,interval_days)
            VALUES (:company_id,:vehicle,:name,:desc,:km,:days)
        ");

        return $stmt->execute([
            'company_id'=>$this->company_id,
            'vehicle'=>$vehicle ?: null,
            'name'=>$name,
            'desc'=>$desc,
            'km'=>$km,
            'days'=>$days
        ]);
    }

    public function delete($id){

        $stmt = $this->db->prepare("
            DELETE FROM maintenance_plans
            WHERE id = :id AND company_id = :company_id
        ");

        return $stmt->execute([
            'id'=>$id,
            'company_id'=>$this->company_id
        ]);
    }

}