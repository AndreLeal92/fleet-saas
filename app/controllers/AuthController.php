<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController {

    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLogin() {

        // iniciar sessão se necessário
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // se já estiver logado, ir para dashboard
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

        if ($this->authService->login($email, $password)) {

            header("Location: /");
            exit;

        }

        header("Location: /login?error=1");
        exit;
    }

    public function logout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // limpar sessão
        $_SESSION = [];

        // remover cookie da sessão
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

        // destruir sessão
        session_destroy();

        header("Location: /login");
        exit;
    }

}