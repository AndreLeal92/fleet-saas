<?php

class Router {

    private static $routes = [];

    public static function get($uri, $action){
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action){
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if(!isset(self::$routes[$method][$uri])){
            echo "Rota não encontrada";
            return;
        }

        $action = self::$routes[$method][$uri];

        list($controller,$method) = explode('@',$action);

        // CAMINHO DO CONTROLLER
        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if(!file_exists($controllerFile)){
            die("Controller não encontrado: " . $controllerFile);
        }

        require_once $controllerFile;

        $controller = new $controller();

        if(!method_exists($controller,$method)){
            die("Método não encontrado: ".$method);
        }

        $controller->$method();

    }

}
