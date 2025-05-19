<?php

namespace Epitas\App\Controllers;

class IndexController {
    public static function index() {
        global $db;

        $livros = $db->livros();

        return render('pages/home/home', [
            "livros" => $livros
        ]);
    }
}