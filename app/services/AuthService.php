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

        $_SESSION['user'] = $user;

        return true;
    }

}