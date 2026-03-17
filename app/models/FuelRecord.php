<?php

require_once __DIR__ . '/../../config/database.php';

class FuelRecord {

    private $db;
    private $company_id;

    public function __construct($company_id) {
        $this->db = Database::getConnection();
        $this->company_id = $company_id;
    }

    // ======================
    // LISTAR ABASTECIMENTOS
    // ======================

    public function all(){

        $sql = "SELECT 
                    f.*,
                    v.plate AS vehicle,
                    d.name  AS driver,
                    t.id    AS trip
                FROM fuel_records f

                LEFT JOIN vehicles v 
                    ON v.id = f.vehicle_id

                LEFT JOIN drivers d 
                    ON d.id = f.driver_id

                LEFT JOIN trips t
                    ON t.id = f.trip_id

                WHERE f.company_id = :company_id

                ORDER BY f.fuel_date DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ======================
    // CRIAR ABASTECIMENTO
    // ======================

    public function create($trip_id,$vehicle_id,$driver_id,$liters,$price,$total,$odometer,$fuel_date){

        $sql = "INSERT INTO fuel_records
                (company_id,trip_id,vehicle_id,driver_id,liters,price,total,odometer,fuel_date)
                VALUES
                (:company_id,:trip_id,:vehicle_id,:driver_id,:liters,:price,:total,:odometer,:fuel_date)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            'company_id' => $this->company_id,
            'trip_id'    => $trip_id ?: null, // 🔥 evita erro
            'vehicle_id' => $vehicle_id,
            'driver_id'  => $driver_id,
            'liters'     => $liters,
            'price'      => $price,
            'total'      => $total,
            'odometer'   => $odometer,
            'fuel_date'  => $fuel_date

        ]);
    }

    // ======================
    // EXCLUIR ABASTECIMENTO
    // ======================

    public function delete($id){

        $sql = "DELETE FROM fuel_records 
                WHERE id = :id AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id,
            'company_id'=>$this->company_id
        ]);
    }
}