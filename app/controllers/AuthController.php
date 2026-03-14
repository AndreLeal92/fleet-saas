<?php

require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    private $authService;
    private $userModel;

    public function __construct() {
        $this->authService = new AuthService();
        $this->userModel = new UserModel();
    }

    public function showLogin() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        require __DIR__ . '/../views/login.php';
    }

    public function authenticate() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->authService->login($email, $password);

        if ($user) {

            // salvar usuário na sessão
            $_SESSION['user'] = $user;

            // verificar se precisa trocar senha
            if ($user['must_change_password'] == 1) {
                header("Location: /change-password");
                exit;
            }

            header("Location: /");
            exit;
        }

        header("Location: /login?error=1");
        exit;
    }

    public function showChangePassword() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        require __DIR__ . '/../views/change-password.php';
    }

    public function changePassword() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        $password = $_POST['password'] ?? '';

        if (!$password) {
            header("Location: /change-password?error=1");
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->userModel->updatePassword($userId, $hash);

        // atualizar sessão
        $_SESSION['user']['must_change_password'] = 0;

        header("Location: /");
        exit;
    }

    public function logout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: /login");
        exit;
    }

}