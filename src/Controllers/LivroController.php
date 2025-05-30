<?php

namespace Epitas\App\Controllers;

use Epitas\App\Models\Livro;

class LivroController {
    public static function index($database)  {
        $livroId = $_GET['id'];

        $sql = <<<SQL
            SELECT * FROM livros WHERE id = :id
        SQL;

        $livro = $database->query(
            query: $sql,
            class: Livro::class,
            params: [
                "id" => $livroId
            ]
        )->fetch();

        $content = render('pages/livro/livro', [
            "livro" => $livro
        ]);

        flash()->clear();

        return $content;
    }
}