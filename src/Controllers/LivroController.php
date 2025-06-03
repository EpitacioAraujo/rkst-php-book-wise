<?php

namespace Epitas\App\Controllers;

use Epitas\App\Models\Avaliacao;
use Epitas\App\Models\Livro;

class LivroController {
    public static function index($database)  {
        $livroId = $_GET['id'];

        $sql = <<<SQL
            SELECT * FROM livros WHERE id = :id
        SQL;

        $book = $database->query(
            query: $sql,
            class: Livro::class,
            params: [
                "id" => $livroId
            ]
        )->fetch();

        $sqlAssessments = <<<SQL
            SELECT * FROM avaliacoes
            WHERE fk_livro = :fk_livro
        SQL;

        $assessments = $database->query(
            query: $sqlAssessments,
            class: Avaliacao::class,
            params: [
                "fk_livro" => $livroId
            ]
        )->fetchAll();

        $total_assessments = count($assessments);

        $book_avarage = ceil(array_reduce(
            array: $assessments, 
            callback: fn ($acc, $assessment) => $acc + $assessment->nota,
            initial: 0 
        ) / $total_assessments);

        return render_view('pages/livro/livro', [
            "book" => $book,
            "avarage" => $book_avarage,
            "total_assessments" => $total_assessments,
            "assessments" => $assessments
        ]);
    }
}