<?php

namespace App\Core;

/**
 * Class Router
 *
 * Handles HTTP request routing.
 */
class Router {
    private static $instance = null;
    private $routes = [];

    private function __construct() {}

    /**
     * Get the singleton instance of Router.
     *
     * @return Router
     */
    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Registers a GET route.
     *
     * @param string $path
     * @param string $controllerMethod Controller@Method
     * @return Router
     */
    public function get(string $path, string $controllerMethod): Router
    {
        $this->routes['GET'][$path] = $controllerMethod;

        return $this;
    }

    /**
     * Registers a POST route.
     *
     * @param string $path
     * @param string $controllerMethod Controller@Method
     * @return Router
     */
    public function post(string $path, string $controllerMethod): Router
    {
        $this->routes['POST'][$path] = $controllerMethod;

        return $this;
    }

    /**
     * Dispatch the request to the appropriate controller method.
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$path])) {
            [$controller, $method] = explode('@', $this->routes[$method][$path]);
            $controller = "App\\Controllers\\$controller";

            if (class_exists($controller) && method_exists($controller, $method)) {
                return (new $controller())->$method();
            }
        }

        http_response_code(404);
        return View::render('errors/404');
    }
}