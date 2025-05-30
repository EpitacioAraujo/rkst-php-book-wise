<?php

use Epitas\App\Controllers\AuthController;
use Epitas\App\Utils\Router;
use Epitas\App\Utils\Container;
use Epitas\App\Controllers\IndexController;
use Epitas\App\Controllers\LivroController;

$container = Container::getInstance();

Router::get(
    path: '/',
    action: function () use ($container) {
        return IndexController::index($container->get('database'));
    }
);

Router::get(
    path: '/livro',
    action: function () use ($container) {
        return LivroController::index($container->get('database'));
    }
);

Router::get(
    path: '/login',
    action: function () use ($container) {
        return AuthController::sigin();
    }
);

Router::post(
    path: '/singup',
    action: function () use ($container) {
        return AuthController::register($container->get('database'));
    }
);

Router::post(
    path: '/auth',
    action: function () use ($container) {
        return AuthController::auth($container->get('database'));
    }
);

Router::get(
    path: '/logout',
    action: function () use ($container) {
        return AuthController::logout();
    }
);
