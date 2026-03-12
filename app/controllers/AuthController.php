<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController {

    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLogin() {
        require __DIR__ . '/../../public/views/login.php';
    }

    public function authenticate() {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->authService->login($email, $password)) {

            header("Location: /");
            exit;

        }

        header("Location: /login?error=1");
        exit;
    }

    public function logout() {

        session_destroy();

        header("Location: /login");
        exit;
    }

}