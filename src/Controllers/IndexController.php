<?php

namespace Epitas\App\Controllers;

class IndexController {
    public static function index() {
        global $db;

        $pesquisa = $_REQUEST['pesquisa'] ?? '';
        $livros = $db->livros($pesquisa);

        return render('pages/home/home', [
            "livros" => $livros
        ]);
    }
}