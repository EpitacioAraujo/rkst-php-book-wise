<?php

$config = require_once __DIR__ . '/../config.php';

require_once __DIR__ . '/../../vendor/autoload.php';

session_start();

// Inicializar o container
$container = \Epitas\App\Utils\Container::getInstance();

// Registrar o serviço de banco de dados
$container->set('database', new \Epitas\App\Database\DB($config['database']));

require_once __DIR__ . '/../server.php';