<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController {

    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLogin() {

        // se já estiver logado, ir para dashboard
        if (isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

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

        // garantir sessão ativa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // limpar variáveis da sessão
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