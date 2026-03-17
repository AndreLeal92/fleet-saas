<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleCombinationModel{

    private $db;
    private $company_id;

    public function __construct($company_id){
        $this->db = Database::getConnection();
        $this->company_id = $company_id;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create($tractor, $trailers){

        try {

            if(!$tractor){
                return ['success'=>false,'message'=>'Selecione o cavalo'];
            }

            if(empty($trailers)){
                return ['success'=>false,'message'=>'Selecione ao menos um implemento'];
            }

            // 🔒 valida cavalo já em uso
            $stmt = $this->db->prepare("
                SELECT id FROM vehicle_combinations
                WHERE tractor_vehicle_id = :tractor AND company_id = :company_id
            ");
            $stmt->execute([
                'tractor'=>$tractor,
                'company_id'=>$this->company_id
            ]);

            if($stmt->rowCount() > 0){
                return ['success'=>false,'message'=>'Este cavalo já está em uso'];
            }

            // 🔒 valida implementos já em uso
            $placeholders = implode(',', array_fill(0, count($trailers), '?'));

            $stmt = $this->db->prepare("
                SELECT vehicle_id FROM vehicle_combination_items
                WHERE vehicle_id IN ($placeholders)
            ");

            $stmt->execute($trailers);

            if($stmt->rowCount() > 0){
                return ['success'=>false,'message'=>'Um ou mais implementos já estão em uso'];
            }

            $this->db->beginTransaction();

            $stmt = $this->db->prepare("
                INSERT INTO vehicle_combinations (company_id, tractor_vehicle_id)
                VALUES (:company_id, :tractor)
            ");

            $stmt->execute([
                'company_id'=>$this->company_id,
                'tractor'=>$tractor
            ]);

            $combination_id = $this->db->lastInsertId();

            $position = 1;

            foreach($trailers as $t){

                $stmt = $this->db->prepare("
                    INSERT INTO vehicle_combination_items
                    (combination_id, vehicle_id, position)
                    VALUES (:combination_id, :vehicle_id, :position)
                ");

                $stmt->execute([
                    'combination_id'=>$combination_id,
                    'vehicle_id'=>$t,
                    'position'=>$position++
                ]);
            }

            $this->db->commit();

            return ['success'=>true];

        } catch(Exception $e){

            $this->db->rollBack();

            return ['success'=>false,'message'=>$e->getMessage()];
        }
    }

    public function all(){

        $sql = "SELECT
                vc.id,

                v1.model AS cavalo_modelo,
                v1.plate AS cavalo_placa,

                GROUP_CONCAT(
                    CONCAT(v2.model, ' (', v2.plate, ')')
                    ORDER BY vci.position
                    SEPARATOR ' + '
                ) AS implementos

            FROM vehicle_combinations vc

            INNER JOIN vehicles v1 
                ON v1.id = vc.tractor_vehicle_id

            LEFT JOIN vehicle_combination_items vci 
                ON vci.combination_id = vc.id

            LEFT JOIN vehicles v2 
                ON v2.id = vci.vehicle_id

            WHERE vc.company_id = :company_id

            GROUP BY vc.id

            ORDER BY vc.id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableVehicles(){

        $stmt = $this->db->prepare("
            SELECT id, plate, model
            FROM vehicles
            WHERE company_id = :company_id
            ORDER BY plate
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id){

        try {

            $this->db->beginTransaction();

            $this->db->prepare("
                DELETE FROM vehicle_combination_items
                WHERE combination_id = :id
            ")->execute(['id'=>$id]);

            $this->db->prepare("
                DELETE FROM vehicle_combinations
                WHERE id = :id AND company_id = :company_id
            ")->execute([
                'id'=>$id,
                'company_id'=>$this->company_id
            ]);

            $this->db->commit();

            return true;

        } catch(Exception $e){

            $this->db->rollBack();
            return false;
        }
    }
}