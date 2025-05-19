<?php

namespace Epitas\App\Controllers;

class LivroController {
    public static function index() {
        global $db;

        $query = $db->query('SELECT * FROM livros');

        $livros = $query->fetchAll();

        return render('pages/home/home', [
            "livros" => $livros
        ]);
    }
}