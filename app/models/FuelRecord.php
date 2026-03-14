<?php

require_once __DIR__ . '/../../config/database.php';

class FuelRecord {

    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all(){

        $sql = "SELECT 
                    f.*, 
                    v.plate AS vehicle,
                    d.name AS driver
                FROM fuel_records f
                LEFT JOIN vehicles v ON v.id = f.vehicle_id
                LEFT JOIN drivers d ON d.id = f.driver_id
                ORDER BY fuel_date DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($vehicle_id,$driver_id,$liters,$price,$total,$odometer,$fuel_date){

        $sql = "INSERT INTO fuel_records
                (vehicle_id,driver_id,liters,price,total,odometer,fuel_date)
                VALUES
                (:vehicle_id,:driver_id,:liters,:price,:total,:odometer,:fuel_date)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'vehicle_id'=>$vehicle_id,
            'driver_id'=>$driver_id,
            'liters'=>$liters,
            'price'=>$price,
            'total'=>$total,
            'odometer'=>$odometer,
            'fuel_date'=>$fuel_date
        ]);
    }

    public function delete($id){

        $sql = "DELETE FROM fuel_records WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id
        ]);
    }

}