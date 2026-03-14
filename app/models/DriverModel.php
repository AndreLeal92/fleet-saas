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

        $sql = "DELETE FROM drivers WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id
        ]);

    }

}