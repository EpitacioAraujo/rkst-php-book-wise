<?php

use Epitas\App\Utils\Router;
use Epitas\App\Controllers\IndexController;
use Epitas\App\Controllers\LivroController;

Router::get('/', fn () => IndexController::index());

Router::get('/livro', fn () => LivroController::index());
