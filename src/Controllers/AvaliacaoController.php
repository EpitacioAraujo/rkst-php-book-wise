<?php

namespace Epitas\App\Controllers;

use Epitas\App\Database\DB;
use Epitas\App\Libs\Validacao\Validacao;

class AvaliacaoController
{
    public static function store(DB $db)
    {
        $livro = $_POST['fk_livro'] ?? null;

        $validacao = Validacao::validate([
            "avaliacao" => ["required"],
            "nota" => ["required"],
            "fk_livro" => ["required"],
        ], $_POST);

        if ($validacao->failed()) {
            flash()->push("Assessment.Register.Validations", $validacao->validacoes);
            flash()->push("Assessment.Register.Fields", $_POST);

            header("Location: /livro?id={$livro}");
            exit();
        }

        $query = <<<SQL
            INSERT INTO avaliacoes (fk_usuario, fk_livro, avaliacao, nota)
            VALUES (:fk_usuario , :fk_livro , :avaliacao , :nota)
        SQL;

        $db->query(
            query: $query,
            params: [
                "fk_usuario" => auth()->id,
                "fk_livro" => $livro,
                "avaliacao" => $_POST['avaliacao'],
                "nota" => $_POST['nota']
            ]
        )->execute();

        flash()->push('Assessment.Register.Message.Success', 'Cadastro com sucesso!');

        header("Location: /livro?id={$livro}");
        exit();
    }
}
