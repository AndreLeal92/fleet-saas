<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleDocumentModel{

private $db;
private $company_id;

public function __construct($company_id){

$this->db = Database::getConnection();
$this->company_id = $company_id;

}

public function create($vehicle_id,$type,$file,$expiration){

$sql="INSERT INTO vehicle_documents
(company_id,vehicle_id,document_type,file_path,expiration_date)
VALUES
(:company_id,:vehicle_id,:type,:file,:expiration)";

$stmt=$this->db->prepare($sql);

return $stmt->execute([
'company_id'=>$this->company_id,
'vehicle_id'=>$vehicle_id,
'type'=>$type,
'file'=>$file,
'expiration'=>$expiration
]);

}

public function getByVehicle($vehicle_id){

$sql="SELECT * FROM vehicle_documents
WHERE vehicle_id=:vehicle_id
ORDER BY expiration_date";

$stmt=$this->db->prepare($sql);

$stmt->execute([
'vehicle_id'=>$vehicle_id
]);

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function expiringSoon(){

$sql="SELECT v.plate,d.document_type,d.expiration_date
FROM vehicle_documents d
JOIN vehicles v ON v.id=d.vehicle_id
WHERE d.expiration_date <= DATE_ADD(CURDATE(),INTERVAL 30 DAY)
AND d.company_id=:company_id";

$stmt=$this->db->prepare($sql);

$stmt->execute([
'company_id'=>$this->company_id
]);

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

}