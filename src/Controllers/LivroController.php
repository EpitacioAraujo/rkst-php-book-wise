<?php

namespace Epitas\App\Controllers;

class LivroController {
    public static function index() {
        $livroId = $_GET['id'];

        global $db;

        $livro = $db->livro($livroId);

        return render('pages/livro/livro', [
            "livro" => $livro
        ]);
    }
}