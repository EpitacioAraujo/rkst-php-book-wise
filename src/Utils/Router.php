<?php

namespace Epitas\App\Utils;

class Router
{
    private static $routes = [];

    /**
     * Registra uma rota GET
     * 
     * @param string $path Path da URL
     * @param string|callable $action View ou callable
     * @return void
     */
    public static function get($path, $action)
    {
        self::addRoute('GET', $path, $action);
    }

    /**
     * Registra uma rota POST
     * 
     * @param string $path Path da URL
     * @param string|callable $action View ou callable
     * @return void
     */
    public static function post($path, $action)
    {
        self::addRoute('POST', $path, $action);
    }

    /**
     * Registra uma rota PUT
     * 
     * @param string $path Path da URL
     * @param string|callable $action View ou callable
     * @return void
     */
    public static function put($path, $action)
    {
        self::addRoute('PUT', $path, $action);
    }

    /**
     * Registra uma rota DELETE
     * 
     * @param string $path Path da URL
     * @param string|callable $action View ou callable
     * @return void
     */
    public static function delete($path, $action)
    {
        self::addRoute('DELETE', $path, $action);
    }

    /**
     * Adiciona uma rota ao array de rotas
     * 
     * @param string $method Método HTTP
     * @param string $path Path da URL
     * @param string|callable $action View ou callable
     * @return void
     */
    private static function addRoute($method, $path, $action)
    {
        self::$routes[$method][$path] = $action;
    }

    /**
     * Retorna todas as rotas registradas
     * 
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Resolve a rota atual e executa a ação correspondente
     * 
     * @param string $method Método HTTP atual
     * @param string $path Path da URL atual
     * @return mixed
     */
    public static function resolve($method, $path)
    {
        // Normaliza o path
        $path = rtrim($path, '/');
        if (empty($path)) {
            $path = '/';
        }

        // Verifica se a rota existe para o método atual
        if (!isset(self::$routes[$method][$path])) {
            return false;
        }

        $action = self::$routes[$method][$path];

        // Se a ação é uma string, assume que é uma view
        if (is_string($action)) {
            return render($action);
        }

        // Se a ação é um callable, executa-o
        if (is_callable($action)) {
            return call_user_func($action);
        }

        return false;
    }
}
