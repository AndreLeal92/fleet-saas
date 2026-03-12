<?php

class Router {

    public static function route($uri) {

        switch ($uri) {

            case "/":
                echo "Fleet SaaS";
                break;

            case "/login":
                echo "Tela login";
                break;

            default:
                echo "404";
        }

    }

}