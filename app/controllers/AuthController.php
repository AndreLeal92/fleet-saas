<?php

require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    private $authService;
    private $userModel;

    public function __construct(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->authService = new AuthService();
        $this->userModel = new UserModel();
    }

    public function showLogin(){

        if(isset($_SESSION['user_id']) && isset($_SESSION['company_id'])){
            header("Location: /");
            exit;
        }

        require __DIR__ . '/../views/login.php';
    }

    public function authenticate(){

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            header("Location: /login?error=empty");
            exit;
        }

        $user = $this->authService->login($email, $password);

        if ($user) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['company_id'] = $user['company_id'];
            $_SESSION['user_name'] = $user['name'];

            if (!empty($user['must_change_password']) && $user['must_change_password'] == 1) {

                header("Location: /change-password");
                exit;

            }

            header("Location: /");
            exit;

        }

        header("Location: /login?error=1");
        exit;

    }

    public function logout(){

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