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
    path: '/auth',
    action: function () use ($container) {
        return AuthController::auth();
    }
);

Router::post(
    path: '/auth/singup',
    action: function () use ($container) {
        return AuthController::singUp($container->get('database'));
    }
);

Router::post(
    path: '/auth/singin',
    action: function () use ($container) {
        return AuthController::sigIn($container->get('database'));
    }
);

Router::get(
    path: '/auth/signout',
    action: function () use ($container) {
        return AuthController::signOut();
    }
);
