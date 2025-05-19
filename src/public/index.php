<?php

require_once __DIR__ . '/../../vendor/autoload.php';

global $db;
$db = new PDO('sqlite:../../db.sqlite');

require_once __DIR__ . '/../server.php';
