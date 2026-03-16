<?php

require_once __DIR__ . '/../../config/database.php';

class DriverModel {

    private $db;

    public function __construct() {

        $this->db = Database::getConnection();

    }

    public function all(){

        $sql = "SELECT * FROM drivers";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function create($name,$cpf,$cnh,$phone){

        $sql = "INSERT INTO drivers (name,cpf,cnh,phone)
                VALUES (:name,:cpf,:cnh,:phone)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'name'=>$name,
            'cpf'=>$cpf,
            'cnh'=>$cnh,
            'phone'=>$phone
        ]);

    }

  public function delete($id){

    // verifica se existe abastecimento ligado ao motorista
    $sql = "SELECT COUNT(*) FROM fuel_records WHERE driver_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();

    if($stmt->fetchColumn() > 0){
        return false;
    }

    $sql = "DELETE FROM drivers WHERE id = :id AND company_id = :company_id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->bindValue(':company_id',$this->company_id);

    return $stmt->execute();
}

}