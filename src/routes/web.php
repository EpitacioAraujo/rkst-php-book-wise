<?php

use Epitas\App\Controllers\AuthController;
use Epitas\App\Controllers\AvaliacaoController;
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
    path: '/meus-livros',
    action: function () use ($container) {
        return LivroController::viewMyBooks($container->get('database'));
    }
);

Router::get(
    path: '/auth',
    action: function () use ($container) {
        return AuthController::auth();
    }
);

Router::post(
    path: '/auth/signup',
    action: function () use ($container) {
        return AuthController::signUp($container->get('database'));
    }
);

Router::post(
    path: '/auth/signin',
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

Router::post(
    path: '/assessment/store',
    action: function () use ($container) {
        return AvaliacaoController::store($container->get('database'));
    }
);

Router::get(
    path: '/assessments',
    action: function () use ($container) {
        return AvaliacaoController::store($container->get('database'));
    }
);

Router::post(
    path: '/livro',
    action: function () use ($container) {
        return LivroController::store($container->get('database'));
    }
);
