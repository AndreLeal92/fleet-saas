<?php

class Router {

    private static $routes = [];

    public static function get($uri, $action) {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action) {
        self::$routes['POST'][$uri] = $action;
    }

    public static function run() {

        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if(isset(self::$routes[$method][$uri])) {

            $action = self::$routes[$method][$uri];

            list($controller,$method) = explode('@',$action);

            require "../app/controllers/$controller.php";

            $controller = new $controller();

            return $controller->$method();
        }

        http_response_code(404);
        echo "Página não encontrada";

    }

}