<?php

require_once __DIR__ . '/../../config/database.php';

class UserModel {

    private $db;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = Database::getConnection();
    }

    public function all(){

        $sql = "SELECT *
                FROM users
                WHERE company_id = :company_id
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id' => $_SESSION['company_id']
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function find($id){

        $sql = "SELECT *
                FROM users
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'company_id' => $_SESSION['company_id']
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    // 🔑 MÉTODO NECESSÁRIO PARA LOGIN
    public function findByEmail($email){

        $sql = "SELECT *
                FROM users
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function create($name,$email,$password,$role){

        $sql = "INSERT INTO users
                (company_id,name,email,password,role,must_change_password)
                VALUES
                (:company_id,:name,:email,:password,:role,1)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'company_id' => $_SESSION['company_id'],
            'name'       => $name,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'role'       => $role
        ]);

    }

    public function update($id,$name,$email,$role){

        $sql = "UPDATE users
                SET name = :name,
                    email = :email,
                    role = :role
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'    => $id,
            'name'  => $name,
            'email' => $email,
            'role'  => $role,
            'company_id' => $_SESSION['company_id']
        ]);

    }

    public function resetPassword($id,$password){

        $sql = "UPDATE users
                SET password = :password,
                    must_change_password = 1
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'       => $id,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'company_id' => $_SESSION['company_id']
        ]);

    }

    public function delete($id){

        $sql = "DELETE FROM users
                WHERE id = :id
                AND company_id = :company_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'company_id' => $_SESSION['company_id']
        ]);

    }

}