<?php

use Epitas\App\Utils\Flash;
use Epitas\App\Utils\Session;

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function dd($data)
{
    dump($data);
    die();
}

function flash() {
    return new Flash;
}

function Session() {
    return new Session;
}