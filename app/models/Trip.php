<?php

require_once __DIR__ . '/../../config/database.php';

class Trip {

    private $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    // =========================
    // LISTAR VIAGENS
    // =========================
    public function all(){

        $sql = "SELECT 
                    t.*,
                    d.name  AS driver_name,
                    v.plate AS vehicle_plate
                FROM trips t
                LEFT JOIN drivers d ON d.id = t.driver_id
                LEFT JOIN vehicles v ON v.id = t.vehicle_id
                ORDER BY t.trip_date DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // =========================
    // BUSCAR UMA VIAGEM
    // =========================
    public function find($id){

        $sql = "SELECT * FROM trips WHERE id = :id LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // =========================
    // CRIAR VIAGEM
    // =========================
    public function create($driver,$vehicle,$origin,$destination,$date,$km_start,$km_end){

        $sql = "INSERT INTO trips
                (driver_id, vehicle_id, origin, destination, trip_date, km_start, km_end)
                VALUES (:driver_id, :vehicle_id, :origin, :destination, :trip_date, :km_start, :km_end)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'driver_id'   => $driver,
            'vehicle_id'  => $vehicle,
            'origin'      => $origin,
            'destination' => $destination,
            'trip_date'   => $date,
            'km_start'    => $km_start,
            'km_end'      => $km_end
        ]);
    }


    // =========================
    // ATUALIZAR VIAGEM
    // =========================
    public function update($id,$driver,$vehicle,$origin,$destination,$date,$km_start,$km_end){

        $sql = "UPDATE trips
                SET driver_id   = :driver_id,
                    vehicle_id  = :vehicle_id,
                    origin      = :origin,
                    destination = :destination,
                    trip_date   = :trip_date,
                    km_start    = :km_start,
                    km_end      = :km_end
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'driver_id'   => $driver,
            'vehicle_id'  => $vehicle,
            'origin'      => $origin,
            'destination' => $destination,
            'trip_date'   => $date,
            'km_start'    => $km_start,
            'km_end'      => $km_end,
            'id'          => $id
        ]);
    }


    // =========================
    // EXCLUIR VIAGEM
    // =========================
    public function delete($id){

        $sql = "DELETE FROM trips WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }


  // =========================
// RELATÓRIO DE VIAGEM
// =========================
public function report(){

    $sql = "
        SELECT
            t.id,
            d.name AS driver,
            v.plate AS vehicle,
            t.origin,
            t.destination,
            t.trip_date,

            (t.km_end - t.km_start) AS km,

            COALESCE(SUM(fr.liters),0) AS liters,
            COALESCE(SUM(fr.total),0) AS fuel_cost,

            COALESCE(SUM(te.amount),0) AS expenses

        FROM trips t

        LEFT JOIN drivers d 
        ON d.id = t.driver_id

        LEFT JOIN vehicles v 
        ON v.id = t.vehicle_id

        LEFT JOIN fuel_records fr
        ON fr.trip_id = t.id

        LEFT JOIN trip_expenses te
        ON te.trip_id = t.id

        GROUP BY t.id

        ORDER BY t.trip_date DESC
    ";

    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

}