<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthService {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login($email, $password) {

        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        session_start();

        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "company_id" => $user['company_id']
        ];

        return true;
    }

}