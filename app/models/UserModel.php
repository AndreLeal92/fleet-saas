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
        $stmt->execute(['email'=>$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function findById($id){

        $sql = "SELECT id,name,email,role FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id'=>$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function all(){

        $sql = "SELECT id,name,email,role FROM users";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function create($name,$email,$password,$role){

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name,email,password,role,must_change_password)
                VALUES (:name,:email,:password,:role,1)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'name'=>$name,
            'email'=>$email,
            'password'=>$passwordHash,
            'role'=>$role
        ]);

    }

    public function update($id,$name,$email,$role,$password){

        if(!empty($password)){

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users
                    SET name=:name,email=:email,role=:role,password=:password
                    WHERE id=:id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                'name'=>$name,
                'email'=>$email,
                'role'=>$role,
                'password'=>$passwordHash,
                'id'=>$id
            ]);

        } else {

            $sql = "UPDATE users
                    SET name=:name,email=:email,role=:role
                    WHERE id=:id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                'name'=>$name,
                'email'=>$email,
                'role'=>$role,
                'id'=>$id
            ]);

        }

    }

    public function updatePassword($id,$password){

        $sql = "UPDATE users 
                SET password=:password,must_change_password=0
                WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'password'=>$password,
            'id'=>$id
        ]);

    }

    public function delete($id){

        $sql = "DELETE FROM users WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id'=>$id]);

    }

}