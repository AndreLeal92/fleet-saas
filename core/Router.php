<?php

require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';

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
        $uri = rtrim($uri, '/');

        if ($uri === '') {
            $uri = '/';
        }

        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (!isset(self::$routes[$httpMethod][$uri])) {
            http_response_code(404);
            echo "404 - Rota não encontrada";
            return;
        }

        $action = self::$routes[$httpMethod][$uri];

        list($controller, $method) = explode('@', $action);

        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(500);
            die("Controller não encontrado: " . $controller);
        }

        require_once $controllerFile;

        // rotas públicas
        $publicRoutes = [
            '/login',
            '/authenticate'
        ];

        if (!in_array($uri, $publicRoutes)) {
            AuthMiddleware::check();
        }

        // verifica se a classe existe
        if (!class_exists($controller)) {
            http_response_code(500);
            die("Classe do controller não encontrada: " . $controller);
        }

        $controllerInstance = new $controller();

        // verifica se o método existe
        if (!method_exists($controllerInstance, $method)) {
            http_response_code(500);
            die("Método não encontrado: " . $method);
        }

        call_user_func([$controllerInstance, $method]);
    }
}