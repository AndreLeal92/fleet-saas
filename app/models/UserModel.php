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

}