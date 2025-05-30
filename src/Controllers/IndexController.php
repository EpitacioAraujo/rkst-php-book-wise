<?php

namespace Epitas\App\Controllers;

use Epitas\App\Models\Livro;

class IndexController {
    public static function index($database) {
        $pesquisa = $_REQUEST['pesquisa'] ?? '';
        
        $sql = <<<SQL
            SELECT 
                *
            FROM livros
            WHERE 
                    titulo    LIKE :pesquisa
                OR  autor     LIKE :pesquisa
                OR  descricao LIKE :pesquisa
        SQL;
        
        $livros = $database->query(
            query: $sql,
            class: Livro::class,
            params: [
                "pesquisa" => "%{$pesquisa}%"
            ]
        )->fetchAll();

        return render_view('pages/home/home', [
            "livros" => $livros
        ]);
    }
}