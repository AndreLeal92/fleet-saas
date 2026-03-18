<?php

require_once __DIR__ . '/../../config/database.php';

class Maintenance {

    private $db;
    private $company_id;

    public function __construct($company_id){
        $this->db = Database::getConnection();
        $this->company_id = $company_id;
    }

    // ========================================
    // LISTAR
    // ========================================
    public function all(){

        $stmt = $this->db->prepare("
            SELECT 
                m.*, 
                v.plate,
                v.current_km
            FROM maintenances m
            JOIN vehicles v ON v.id = m.vehicle_id
            WHERE m.company_id = :company_id
            ORDER BY m.maintenance_date DESC
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ========================================
    // CRIAR
    // ========================================
    public function create($vehicle,$type,$desc,$cost,$km,$next_km,$date){

        $stmt = $this->db->prepare("
            INSERT INTO maintenances
            (company_id,vehicle_id,type,description,cost,km,next_km,maintenance_date)
            VALUES (:company_id,:vehicle,:type,:desc,:cost,:km,:next_km,:date)
        ");

        return $stmt->execute([
            'company_id'=>$this->company_id,
            'vehicle'=>$vehicle,
            'type'=>$type,
            'desc'=>$desc,
            'cost'=>$cost,
            'km'=>$km,
            'next_km'=>$next_km,
            'date'=>$date
        ]);
    }

    // ========================================
    // EXCLUIR
    // ========================================
    public function delete($id){

        $stmt = $this->db->prepare("
            DELETE FROM maintenances 
            WHERE id = :id AND company_id = :company_id
        ");

        return $stmt->execute([
            'id'=>$id,
            'company_id'=>$this->company_id
        ]);
    }

    // ========================================
    // ALERTAS (EXECUTADA + PREVENTIVA 🔥)
    // ========================================
    public function alerts(){

        $alerts = [];

        // 🔧 MANUTENÇÃO NORMAL
        $stmt = $this->db->prepare("
            SELECT 
                m.*, 
                v.plate,
                v.current_km
            FROM maintenances m
            JOIN vehicles v ON v.id = m.vehicle_id
            WHERE m.company_id = :company_id
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $m){

            if(!$m['next_km']) continue;

            if($m['current_km'] >= $m['next_km']){
                $m['alert'] = 'VENCIDO';
                $m['source'] = 'Manutenção';
                $alerts[] = $m;
            }
            elseif(($m['next_km'] - $m['current_km']) <= 500){
                $m['alert'] = 'PRÓXIMO';
                $m['source'] = 'Manutenção';
                $alerts[] = $m;
            }
        }

        // 🧠 PREVENTIVAS (NOVO)
        $stmt = $this->db->prepare("
            SELECT 
                mp.*,
                v.plate,
                v.current_km
            FROM maintenance_plans mp
            JOIN vehicles v ON v.id = mp.vehicle_id
            WHERE mp.company_id = :company_id
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($plans as $p){

            if(!$p['interval_km']) continue;

            if($p['current_km'] >= $p['interval_km']){
                $alerts[] = [
                    'plate' => $p['plate'],
                    'alert' => 'VENCIDO',
                    'source' => 'Preventiva',
                    'type' => $p['name']
                ];
            }
            elseif(($p['interval_km'] - $p['current_km']) <= 500){
                $alerts[] = [
                    'plate' => $p['plate'],
                    'alert' => 'PRÓXIMO',
                    'source' => 'Preventiva',
                    'type' => $p['name']
                ];
            }
        }

        return $alerts;
    }

    // ========================================
    // STATUS AUTOMÁTICO
    // ========================================
    public function updateStatusAuto(){

        $stmt = $this->db->prepare("
            UPDATE maintenances m
            JOIN vehicles v ON v.id = m.vehicle_id
            SET m.status = 
                CASE
                    WHEN m.next_km IS NOT NULL AND v.current_km >= m.next_km THEN 'VENCIDO'
                    WHEN m.next_km IS NOT NULL AND (m.next_km - v.current_km) <= 500 THEN 'PRÓXIMO'
                    ELSE 'OK'
                END
            WHERE m.company_id = :company_id
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);
    }

    // ========================================
    // CUSTO REAL POR KM (CORRIGIDO 🔥)
    // ========================================
    public function realCostPerKm(){

        $stmt = $this->db->prepare("
            SELECT 
                (
                    (SELECT COALESCE(SUM(total),0) FROM fuel_records WHERE company_id = :company_id)
                    +
                    (SELECT COALESCE(SUM(cost),0) FROM maintenances WHERE company_id = :company_id)
                )
                /
                NULLIF(
                    (SELECT SUM(km_end - km_start) FROM trips WHERE company_id = :company_id),
                    0
                ) AS cost_per_km
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ========================================
    // ESTATÍSTICAS
    // ========================================
    public function stats(){

        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total,
                COALESCE(SUM(cost),0) as total_cost,
                COALESCE(AVG(cost),0) as avg_cost
            FROM maintenances
            WHERE company_id = :company_id
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ========================================
    // CUSTO POR VEÍCULO
    // ========================================
    public function costByVehicle(){

        $stmt = $this->db->prepare("
            SELECT 
                v.plate,
                COALESCE(SUM(m.cost),0) as total_cost
            FROM maintenances m
            JOIN vehicles v ON v.id = m.vehicle_id
            WHERE m.company_id = :company_id
            GROUP BY v.id
            ORDER BY total_cost DESC
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ========================================
    // CUSTO POR MÊS
    // ========================================
    public function costPerMonth(){

        $stmt = $this->db->prepare("
            SELECT 
                MONTH(maintenance_date) as month,
                COALESCE(SUM(cost),0) as total
            FROM maintenances
            WHERE company_id = :company_id
            GROUP BY MONTH(maintenance_date)
            ORDER BY month
        ");

        $stmt->execute([
            'company_id'=>$this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}