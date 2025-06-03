<?php

namespace Epitas\App\Controllers;

use Epitas\App\ViewModels\LivroViewModel;

class IndexController {
    public static function index($database) {
        $pesquisa = $_REQUEST['pesquisa'] ?? '';
        
        $sql = <<<SQL
            SELECT 
                L.*,
                AVG(A.nota) as avarage,
                COUNT(A.id) as total_assessments
            FROM livros as L
            LEFT JOIN avaliacoes as A on A.fk_livro = L.id
            WHERE 
                    titulo    LIKE :pesquisa
                OR  autor     LIKE :pesquisa
                OR  descricao LIKE :pesquisa
            GROUP BY
                L.id
        SQL;

        $books = $database->query(
            query: $sql,
            class: LivroViewModel::class,
            params: [
                "pesquisa" => "%{$pesquisa}%"
            ]
        )->fetchAll();

        return render_view('pages/home/home', [
            "books" => $books
        ]);
    }
}