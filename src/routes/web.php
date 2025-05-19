<?php

use Epitas\App\Controllers\LivroController;
use Epitas\App\Utils\Router;

Router::get('/', fn () => LivroController::index());

Router::get('/livro', 'pages/livro/livro');
