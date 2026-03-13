<?php

require_once __DIR__ . '/../../config/database.php';

class VehicleModel {

    private $db;

    public function __construct(){

        $this->db = Database::getConnection();

    }

    public function all(){

        $sql = "SELECT * FROM vehicles";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function create($plate,$model,$year){

        $sql = "INSERT INTO vehicles (plate,model,year)
                VALUES (:plate,:model,:year)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'plate'=>$plate,
            'model'=>$model,
            'year'=>$year
        ]);

    }

    public function delete($id){

        $sql = "DELETE FROM vehicles WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id
        ]);

    }

}
