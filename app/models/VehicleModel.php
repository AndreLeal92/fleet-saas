<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleModel {

    private PDO $db;
    private int $company_id;

    /**
     * Construtor exige o ID da empresa para garantir
     * isolamento de dados no SaaS.
     */
    public function __construct(int $company_id) {

        $this->db = Database::getConnection();
        $this->company_id = $company_id;

    }

    /**
     * Lista todos os veículos da empresa
     */
    public function all(): array {

        $sql = "SELECT *
                FROM vehicles
                WHERE company_id = :company_id
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id' => $this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca um veículo específico
     */
    public function find(int $id): ?array {

        $sql = "SELECT *
                FROM vehicles
                WHERE id = :id
                AND company_id = :company_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);

        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

        return $vehicle ?: null;

    }

    /**
     * Cria um novo veículo
     */
    public function create(string $plate, string $model, string $brand, int $year): bool {

        $sql = "INSERT INTO vehicles
                (company_id, plate, model, brand, year)
                VALUES
                (:company_id, :plate, :model, :brand, :year)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'company_id' => $this->company_id,
            'plate'      => $plate,
            'model'      => $model,
            'brand'      => $brand,
            'year'       => $year
        ]);

    }

    /**
     * Atualiza veículo
     */
    public function update(int $id, string $plate, string $model, string $brand, int $year): bool {

        $sql = "UPDATE vehicles
                SET plate = :plate,
                    model = :model,
                    brand = :brand,
                    year = :year
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id'         => $id,
            'company_id' => $this->company_id,
            'plate'      => $plate,
            'model'      => $model,
            'brand'      => $brand,
            'year'       => $year
        ]);

    }

    /**
     * Remove veículo
     */
    public function delete(int $id): bool {

        $sql = "DELETE FROM vehicles
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'company_id' => $this->company_id
        ]);

    }

}