<?php

namespace App\Core;

/**
 * Class Router
 *
 * Handles HTTP request routing.
 */
class Router
{
    private static ?Router $instance = null;
    private array $routes = [];
    private array $middleware = [];
    private string $currentRoute = '';

    private function __construct()
    {
    }

    /**
     * Get the singleton instance of Router.
     *
     * @return Router
     */
    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Registers a GET route.
     *
     * @param string $path
     * @param string $controllerMethod Controller@Method
     * @param array $middleware
     * @return Router
     */
    public function get(string $path, string $controllerMethod, array $middleware = []): Router
    {
        $this->routes['GET'][$path] = $controllerMethod;
        $this->middleware['GET'][$path] = $middleware;

        return $this;
    }

    /**
     * Registers a POST route.
     *
     * @param string $path
     * @param string $controllerMethod Controller@Method
     * @param array $middleware
     * @return Router
     */
    public function post(string $path, string $controllerMethod, array $middleware = []): Router
    {
        $this->routes['POST'][$path] = $controllerMethod;
        $this->middleware['POST'][$path] = $middleware;

        return $this;
    }

    /**
     * Get the current route.
     *
     * @return string|null
     */
    public function currentRoute(): ?string
    {
        return $this->currentRoute;
    }

    /**
     * Check if the given path matches the current route.
     *
     * @param string $path The path to be checked against the current route.
     * @return bool True if the path contains the current route, false otherwise.
     */
    public function matches(string $path): bool
    {
        return str_contains($this->currentRoute, $path);
    }

    /**
     * Dispatch the request to the appropriate controller method.
     */
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->currentRoute = $path;

        if (isset($this->routes[$method][$path])) {
            $this->executeMiddleware($method, $path);

            [$controller, $method] = explode('@', $this->routes[$method][$path]);
            $controller = "App\\Controllers\\$controller";

            if (class_exists($controller) && method_exists($controller, $method)) {
                return (new $controller())->$method();
            }
        }

        // Handle Dynamic Routes
        foreach ($this->routes[$method] as $route => $controllerMethod) {
            $pattern = preg_replace('/\{(\w+)}/', '(?P<\1>[^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                $this->executeMiddleware($method, $route);

                [$controller, $action] = explode('@', $controllerMethod);
                $controller = "App\\Controllers\\$controller";

                if (class_exists($controller) && method_exists($controller, $action)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                    return (new $controller())->$action(...$params);
                }
            }
        }

        http_response_code(404);
        View::render('errors/404');
        die();
    }

    /**
     * Executes middleware for a given route.
     *
     * @param string $path
     * @param string $method
     */
    private function executeMiddleware(string $method, string $path): void
    {
        if (isset($this->middleware[$method][$path])) {
            foreach ($this->middleware[$method][$path] as $middleware) {
                if (is_array($middleware)) {
                    [$middlewareClass, $middlewareParam] = $middleware;
                    (new $middlewareClass($middlewareParam))->handle();
                } else {
                    (new $middleware())->handle();
                }
            }
        }
    }
}
