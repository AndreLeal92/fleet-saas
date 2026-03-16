<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleCombinationModel{

private $db;
private $company_id;

public function __construct($company_id){

$this->db=Database::getConnection();
$this->company_id=$company_id;

}

public function create($tractor,$trailer){

$sql="INSERT INTO vehicle_combinations
(company_id,tractor_vehicle_id,trailer_vehicle_id)
VALUES
(:company_id,:tractor,:trailer)";

$stmt=$this->db->prepare($sql);

return $stmt->execute([
'company_id'=>$this->company_id,
'tractor'=>$tractor,
'trailer'=>$trailer
]);

}

public function all(){

$sql="SELECT
vc.id,
v1.plate as cavalo,
v2.plate as carreta
FROM vehicle_combinations vc
JOIN vehicles v1 ON v1.id=vc.tractor_vehicle_id
JOIN vehicles v2 ON v2.id=vc.trailer_vehicle_id
WHERE vc.company_id=:company_id";

$stmt=$this->db->prepare($sql);

$stmt->execute([
'company_id'=>$this->company_id
]);

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

}