<?php

class AuthMiddleware {

    public static function check()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Rotas que NÃO precisam login
        $publicRoutes = [
            '/login',
            '/authenticate'
        ];

        if (in_array($uri, $publicRoutes)) {
            return;
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

    }

}