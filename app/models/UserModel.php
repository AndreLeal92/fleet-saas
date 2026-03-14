<?php

require_once __DIR__ . '/../../config/database.php';

class UserModel {

    private $db;

    public function __construct() {

        $this->db = Database::getConnection();

    }

    public function findByEmail($email) {

        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function all(){

        $sql = "SELECT id, name, email, role FROM users";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

public function create($name,$email,$password,$role){

    $sql = "INSERT INTO users (name,email,password,role,must_change_password)
            VALUES (:name,:email,:password,:role,1)";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        'name'=>$name,
        'email'=>$email,
        'password'=>$password,
        'role'=>$role
    ]);

}
    public function delete($id){

        $sql = "DELETE FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id
        ]);

    }

}
