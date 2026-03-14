<?php

require_once __DIR__ . '/../../config/database.php';

class TripExpense {

    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function all(){

        $sql = "SELECT 
                    e.*,
                    d.name AS driver,
                    v.plate AS vehicle
                FROM trip_expenses e
                LEFT JOIN drivers d ON d.id = e.driver_id
                LEFT JOIN vehicles v ON v.id = e.vehicle_id
                ORDER BY expense_date DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($driver_id,$vehicle_id,$type,$description,$location,$amount,$date){

        $sql = "INSERT INTO trip_expenses
                (driver_id,vehicle_id,expense_type,description,location,amount,expense_date)
                VALUES
                (:driver_id,:vehicle_id,:type,:description,:location,:amount,:date)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'driver_id'=>$driver_id,
            'vehicle_id'=>$vehicle_id,
            'type'=>$type,
            'description'=>$description,
            'location'=>$location,
            'amount'=>$amount,
            'date'=>$date
        ]);
    }

    public function delete($id){

        $sql = "DELETE FROM trip_expenses WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id'=>$id]);
    }
}