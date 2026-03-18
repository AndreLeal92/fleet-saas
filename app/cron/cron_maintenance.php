<?php

require_once __DIR__ . '/../config/database.php';

$db = Database::getConnection();

$vehicles = $db->query("SELECT * FROM vehicles")->fetchAll(PDO::FETCH_ASSOC);

foreach($vehicles as $v){

    $vehicle_id = $v['id'];
    $kmAtual = $v['current_km'];

    $stmt = $db->prepare("SELECT * FROM maintenance_rules WHERE vehicle_id = ?");
    $stmt->execute([$vehicle_id]);
    $rules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($rules as $rule){

        $gerar = false;

        if($rule['type'] === 'km'){

            $interval = (int)$rule['interval_km'];

            $last = $db->prepare("
                SELECT km FROM maintenances 
                WHERE vehicle_id = ? AND description = ?
                ORDER BY id DESC LIMIT 1
            ");
            $last->execute([$vehicle_id, $rule['description']]);
            $lastKm = $last->fetchColumn();

            if(!$lastKm) $lastKm = 0;

            if($kmAtual >= ($lastKm + $interval)){
                $gerar = true;
            }
        }

        if($gerar){

            $check = $db->prepare("
                SELECT id FROM maintenances 
                WHERE vehicle_id = ? 
                AND description = ?
                AND status = 'pending'
            ");
            $check->execute([$vehicle_id, $rule['description']]);

            if(!$check->fetch()){

                $insert = $db->prepare("
                    INSERT INTO maintenances 
                    (vehicle_id, description, km, date, status)
                    VALUES (?, ?, ?, NOW(), 'pending')
                ");

                $insert->execute([
                    $vehicle_id,
                    $rule['description'],
                    $kmAtual
                ]);

                echo "OK: {$rule['description']} \n";
            }
        }
    }
}