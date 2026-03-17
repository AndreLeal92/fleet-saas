<?php

require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';

class Router {

    private static $routes = [];

    public static function get($uri, $action){
        self::$routes['GET'][self::normalize($uri)] = $action;
    }

    public static function post($uri, $action){
        self::$routes['POST'][self::normalize($uri)] = $action;
    }

    private static function normalize($uri){
        $uri = rtrim($uri, '/');
        return $uri === '' ? '/' : $uri;
    }

    public static function dispatch(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = self::normalize($uri);

        $method = $_SERVER['REQUEST_METHOD'];

        // 🔥 DEBUG (pode remover depois)
        // echo "URI: $uri | METHOD: $method"; exit;

        if(!isset(self::$routes[$method][$uri])){

            http_response_code(404);

            echo "<h2>404 - Rota não encontrada</h2>";
            echo "<strong>URI:</strong> $uri <br>";
            echo "<strong>METHOD:</strong> $method <br><br>";

            echo "<strong>Rotas disponíveis:</strong><br>";
            foreach(self::$routes[$method] ?? [] as $route => $action){
                echo "$method $route<br>";
            }

            exit;
        }

        $action = self::$routes[$method][$uri];

        list($controller,$methodAction) = explode('@',$action);

        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if(!file_exists($controllerFile)){
            http_response_code(500);
            die("Controller não encontrado: ".$controller);
        }

        require_once $controllerFile;

        $publicRoutes = [
            '/login',
            '/authenticate'
        ];

        if(!in_array($uri,$publicRoutes)){
            AuthMiddleware::check();
        }

        if(!class_exists($controller)){
            http_response_code(500);
            die("Classe do controller não encontrada: ".$controller);
        }

        $controllerInstance = new $controller();

        if(!method_exists($controllerInstance,$methodAction)){
            http_response_code(500);
            die("Método não encontrado: ".$methodAction);
        }

        call_user_func([$controllerInstance,$methodAction]);
    }
}