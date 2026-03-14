<?php

require_once __DIR__ . '/../../config/database.php';

class Maintenance {

    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function all(){

        $sql = "SELECT 
                    m.*, 
                    v.plate AS vehicle
                FROM maintenances m
                LEFT JOIN vehicles v ON v.id = m.vehicle_id
                ORDER BY maintenance_date DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($vehicle_id,$description,$cost,$odometer,$maintenance_date){

        $sql = "INSERT INTO maintenances 
                (vehicle_id,description,cost,odometer,maintenance_date)
                VALUES
                (:vehicle_id,:description,:cost,:odometer,:maintenance_date)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'vehicle_id'=>$vehicle_id,
            'description'=>$description,
            'cost'=>$cost,
            'odometer'=>$odometer,
            'maintenance_date'=>$maintenance_date
        ]);
    }

    public function delete($id){

        $sql = "DELETE FROM maintenances WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id
        ]);
    }
}