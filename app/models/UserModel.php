<?php

require_once __DIR__ . '/../../config/database.php';

class UserModel {

    private $db;

    public function __construct() {

        $this->db = Database::getConnection();

    }

    // Buscar usuário pelo email (login)
    public function findByEmail($email) {

        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    // Listar usuários
    public function all(){

        $sql = "SELECT id, name, email, role FROM users";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // Criar usuário
    public function create($name,$email,$password,$role){

        // hash da senha
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

    // Atualizar senha (primeiro acesso)
    public function updatePassword($id, $password){

        $sql = "UPDATE users 
                SET password = :password,
                    must_change_password = 0
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'password'=>$password,
            'id'=>$id
        ]);

    }

    // Deletar usuário
    public function delete($id){

        $sql = "DELETE FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'id'=>$id
        ]);

    }

}