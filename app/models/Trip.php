<?php

require_once __DIR__ . '/../../config/database.php';

class Trip {

    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function all(){

        $sql = "SELECT 
                    t.*,
                    d.name AS driver,
                    v.plate AS vehicle
                FROM trips t
                LEFT JOIN drivers d ON d.id = t.driver_id
                LEFT JOIN vehicles v ON v.id = t.vehicle_id
                ORDER BY trip_date DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($driver,$vehicle,$origin,$destination,$start_km,$end_km,$date,$notes){

        $sql = "INSERT INTO trips
                (driver_id,vehicle_id,origin,destination,start_km,end_km,trip_date,notes)
                VALUES
                (:driver,:vehicle,:origin,:destination,:start_km,:end_km,:date,:notes)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'driver'=>$driver,
            'vehicle'=>$vehicle,
            'origin'=>$origin,
            'destination'=>$destination,
            'start_km'=>$start_km,
            'end_km'=>$end_km,
            'date'=>$date,
            'notes'=>$notes
        ]);
    }

    public function delete($id){

        $sql = "DELETE FROM trips WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id'=>$id]);
    }

}