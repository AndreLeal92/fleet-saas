<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../services/Tenant.php';

class TripExpense {

    private PDO $db;
    private int $company_id;

    public function __construct(){

        $this->db = Database::getConnection();
        $this->company_id = Tenant::id();

    }

    /**
     * Lista todas despesas da empresa
     */
    public function all(): array {

        $sql = "SELECT 
                    e.*,
                    d.name AS driver_name,
                    v.plate AS vehicle_plate
                FROM trip_expenses e
                LEFT JOIN drivers d 
                    ON d.id = e.driver_id 
                    AND d.company_id = :company_id
                LEFT JOIN vehicles v 
                    ON v.id = e.vehicle_id 
                    AND v.company_id = :company_id
                WHERE e.company_id = :company_id
                ORDER BY e.expense_date DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id' => $this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Cria nova despesa
     */
    public function create(
        int $driver_id,
        int $vehicle_id,
        string $type,
        string $description,
        string $location,
        float $amount,
        string $date
    ): bool {

        $sql = "INSERT INTO trip_expenses
                (company_id, driver_id, vehicle_id, expense_type, description, location, amount, expense_date)
                VALUES
                (:company_id, :driver_id, :vehicle_id, :type, :description, :location, :amount, :date)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'company_id' => $this->company_id,
            'driver_id'  => $driver_id,
            'vehicle_id' => $vehicle_id,
            'type'       => $type,
            'description'=> $description,
            'location'   => $location,
            'amount'     => $amount,
            'date'       => $date
        ]);

    }

    /**
     * Remove despesa
     */
    public function delete(int $id): bool {

        $sql = "DELETE FROM trip_expenses
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);

    }

}   