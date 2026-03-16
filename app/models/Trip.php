<?php

require_once __DIR__ . '/../../config/database.php';

class Trip {

    private $db;

    public function __construct(){

        $this->db = Database::getConnection();

    }

    public function all(){

        $sql = "SELECT trips.*, drivers.name driver_name, vehicles.plate vehicle_plate
                FROM trips
                LEFT JOIN drivers ON drivers.id = trips.driver_id
                LEFT JOIN vehicles ON vehicles.id = trips.vehicle_id
                ORDER BY trip_date DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    public function create($driver,$vehicle,$origin,$destination,$date,$km_start,$km_end){

        $sql = "INSERT INTO trips
                (driver_id,vehicle_id,origin,destination,trip_date,km_start,km_end)
                VALUES (?,?,?,?,?,?,?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $driver,
            $vehicle,
            $origin,
            $destination,
            $date,
            $km_start,
            $km_end
        ]);

    }

    public function delete($id){

        $sql = "DELETE FROM trips WHERE id=?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);

    }

}
