<?php

require_once __DIR__ . '/../../config/database.php';

class FuelRecord {

    private PDO $db;
    private int $company_id;

    public function __construct(int $company_id) {

        $this->db = Database::getConnection();
        $this->company_id = $company_id;

    }

    /**
     * Lista abastecimentos da empresa
     */
    public function all(): array {

        $sql = "SELECT 
                    f.*, 
                    v.plate AS vehicle,
                    d.name AS driver
                FROM fuel_records f
                LEFT JOIN vehicles v ON v.id = f.vehicle_id
                LEFT JOIN drivers d ON d.id = f.driver_id
                WHERE f.company_id = :company_id
                ORDER BY fuel_date DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id' => $this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cria novo abastecimento
     */
    public function create(
        int $vehicle_id,
        int $driver_id,
        float $liters,
        float $price,
        float $total,
        int $odometer,
        string $fuel_date
    ): bool {

        $sql = "INSERT INTO fuel_records
                (company_id, vehicle_id, driver_id, liters, price, total, odometer, fuel_date)
                VALUES
                (:company_id, :vehicle_id, :driver_id, :liters, :price, :total, :odometer, :fuel_date)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'company_id' => $this->company_id,
            'vehicle_id' => $vehicle_id,
            'driver_id'  => $driver_id,
            'liters'     => $liters,
            'price'      => $price,
            'total'      => $total,
            'odometer'   => $odometer,
            'fuel_date'  => $fuel_date
        ]);
    }

    /**
     * Busca último KM registrado para um veículo
     */
    public function lastOdometer(int $vehicle_id): ?int {

        $sql = "SELECT odometer
                FROM fuel_records
                WHERE vehicle_id = :vehicle_id
                AND company_id = :company_id
                ORDER BY fuel_date DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'vehicle_id' => $vehicle_id,
            'company_id' => $this->company_id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? (int)$result['odometer'] : null;
    }

    /**
     * Remove abastecimento
     */
    public function delete(int $id): bool {

        $sql = "DELETE FROM fuel_records
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);
    }

}