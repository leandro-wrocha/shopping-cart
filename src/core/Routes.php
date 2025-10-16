<?php

namespace Core;

/**
 * Class Routes
 * A simple routing class to manage application routes.
 * 
 * @package Core
 * @version 1.0
 * @author Leandro Rocha
 */
class Routes {
    private static array $routes = [];

    /**
     * Add a new route.
     * 
     * @param string $method The HTTP method (GET, POST, etc.).
     * @param string $uri The URI pattern.
     * @param callable|array $action The action to be executed (callable or [ControllerClass, 'method']).
     * @return void
     */
    public static function add(string $method, string $uri, callable|array $action): void {
        self::$routes[] = ['method' => strtoupper($method), 'uri' => $uri, 'action' => $action];
    }

    /**
     * Dispatch the request to the appropriate route.
     * 
     * @param string $method The HTTP method of the request.
     * @param string $uri The request URI.
     * @return void
     */
    public static function dispatch(string $method, string $uri): void {
        foreach (self::$routes as $route) {
            if ($route['method'] === strtoupper($method) && preg_match("#^{$route['uri']}$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match
                if (is_array($route['action'])) {
                    $controller = new $route['action'][0]();
                    $method = $route['action'][1];
                    if (method_exists($controller, $method)) {
                        call_user_func_array([$controller, $method], $matches);
                        return;
                    } else {
                        http_response_code(500);
                        echo "Error: method {$method} not found in class " . get_class($controller) . ".";
                        return;
                    }
                }

                call_user_func_array($route['action'], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
