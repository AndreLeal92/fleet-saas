<?php

class Router {

    private static $routes = [];

    public static function get($uri, $action) {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action) {
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch() {

        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset(self::$routes[$method][$uri])) {
            echo "Rota não encontrada";
            return;
        }

        $action = self::$routes[$method][$uri];

        list($controller, $methodAction) = explode('@', $action);

        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if (!file_exists($controllerFile)) {
            echo "Controller não encontrado";
            return;
        }

        require_once $controllerFile;

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $methodAction)) {
            echo "Método não encontrado";
            return;
        }

        $controllerInstance->$methodAction();
    }

}