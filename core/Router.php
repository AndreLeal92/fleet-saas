<?php

require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';

class Router {

    private static $routes = [];

    public static function get($uri, $action){

        $uri = rtrim($uri,'/');
        if($uri === '') $uri = '/';

        self::$routes['GET'][$uri] = $action;

    }

    public static function post($uri, $action){

        $uri = rtrim($uri,'/');
        if($uri === '') $uri = '/';

        self::$routes['POST'][$uri] = $action;

    }

    public static function dispatch(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = rtrim($uri,'/');
        if($uri === '') $uri = '/';

        $method = $_SERVER['REQUEST_METHOD'];

        if(!isset(self::$routes[$method][$uri])){

            http_response_code(404);
            echo "404 - Rota não encontrada";
            return;

        }

        $action = self::$routes[$method][$uri];

        list($controller,$methodAction) = explode('@',$action);

        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if(!file_exists($controllerFile)){

            http_response_code(500);
            die("Controller não encontrado: ".$controller);

        }

        require_once $controllerFile;

        /* ROTAS PUBLICAS */

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