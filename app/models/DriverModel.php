<?php

require_once __DIR__ . '/../../config/database.php';

class DriverModel {

    private $db;
    private $company_id;

    public function __construct($company_id) {

        $this->db = Database::getConnection();
        $this->company_id = $company_id;

    }

    public function all(){

        $sql = "SELECT * FROM drivers WHERE company_id = :company_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'company_id' => $this->company_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function create($name,$cpf,$cnh,$phone){

        $sql = "INSERT INTO drivers (name,cpf,cnh,phone,company_id)
                VALUES (:name,:cpf,:cnh,:phone,:company_id)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'name'=>$name,
            'cpf'=>$cpf,
            'cnh'=>$cnh,
            'phone'=>$phone,
            'company_id'=>$this->company_id
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

        $sql = "DELETE FROM drivers 
                WHERE id = :id 
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id'=>$id,
            'company_id'=>$this->company_id
        ]);
    }

}