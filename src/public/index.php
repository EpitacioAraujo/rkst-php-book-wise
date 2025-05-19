<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Epitas\App\DB;

global $db;
$db = new DB();

require_once __DIR__ . '/../server.php';
