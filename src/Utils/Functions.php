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

function flash()
{
    return new Flash;
}

function session()
{
    return new Session;
}

function auth()
{
    return session()->get('auth');
}

function redirect($location = "/")
{
    header("Location: {$location}");
    exit();
}