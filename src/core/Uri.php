<?php

namespace Core;

/**
 * Class Uri
 *
 * A simple URI segment parser.
 * @package Core
 * @version 1.0
 * @author Leandro Rocha
 */
class Uri {
    /**
     * Get a specific URI segment by its index (1-based).
     * 
     * @param int $index The segment index (1-based).
     * @param mixed $default The default value if the segment does not exist.
     * @return string|null
     */
    public static function segment($index, $default = null) {
        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        return $segments[$index - 1] ?? $default;
    }

    /**
     * Get all URI segments as an array.
     * 
     * @return array
     */
    public static function all(): array {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
        return array_values(array_filter(explode('/', trim($path, '/'))));
    }

    /**
     * Get the current request path.
     * 
     * @return string
     */
    public static function path(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    /**
     * Get the base URL of the application.
     * 
     * @return string
     */
    public static function base($path = ''): string
    {
        $baseUrl = rtrim((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}", '/');
        return $baseUrl . '/' . ltrim($path, '/');
    }
}
