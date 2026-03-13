<?php

class AuthMiddleware {

    public static function handle() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // se não estiver logado
        if (!isset($_SESSION['user'])) {

            header("Location: /login");
            exit;

        }

    }

}