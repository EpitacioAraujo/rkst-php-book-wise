<?php

namespace Epitas\App\Controllers;

use Epitas\App\Database\DB;
use Epitas\App\Libs\Validacao\Validacao;
use Epitas\App\Models\Avaliacao;
use Epitas\App\ViewModels\LivroViewModel;

class LivroController {
    public static function index(DB $database)  
    {
        $livroId = $_GET['id'];

        $sql = <<<SQL
            SELECT 
                L.*,
                AVG(A.nota) as avarage,
                COUNT(A.id) as total_assessments
            FROM livros as L
            LEFT JOIN avaliacoes as A on A.fk_livro = L.id
            WHERE 
                L.id = :id
            GROUP BY
                L.id
        SQL;

        $book = $database->query(
            query: $sql,
            class: LivroViewModel::class,
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

        return render_view('pages/livro/livro', [
            "book" => $book,
            "assessments" => $assessments
        ]);
    }

    public static function viewMyBooks(DB $db) {
        if(!auth()) 
        {
            flash()->push("Global.Message.Error", "Você precisa estar logado.");
            redirect();
        }

        $sql = <<<SQL
            SELECT 
                L.*,
                AVG(A.nota) as avarage,
                COUNT(A.id) as total_assessments
            FROM livros as L
            LEFT JOIN avaliacoes as A on A.fk_livro = L.id
            WHERE 
                L.fk_usuario = :fk_usuario
            GROUP BY
                L.id
        SQL;

        $books = $db->query(
            query: $sql,
            class: LivroViewModel::class,
            params: [
                "fk_usuario" => auth()->id
            ]
        )->fetchAll();

        return render_view("pages/meusLivros/meusLivros", [
            "books" => $books
        ]);
    }

    public static function store(DB $db)
    {
        if(!auth())
        {
            redirect();
        }

        $imagem = $_FILES['imagem'];

        $novoNome = md5(rand());
        $extension = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $novaImagem = "{$novoNome}.{$extension}";
        $novaImagemFullPath = __DIR__ . "/../public/assets/images/{$novaImagem}";
        move_uploaded_file($imagem['tmp_name'], $novaImagemFullPath);

        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descricao = $_POST['descricao'];
        $ano_lancamento = $_POST['ano_lancamento'];

        $validate = Validacao::validate(
            rules:[
                "titulo" => ['required', 'min:3'],
                "autor" => ['required', 'min:3'],
                "descricao" => ['required', 'min:3'],
                "ano_lancamento" => ['required'],
            ], 
            data: $_POST
        );

        if($validate->failed())
        {
            flash()->push("Livro.Store.Validations", $validate->validacoes);
            flash()->push("Livro.Store.Fields", $_POST);
            redirect('/meus-livros');
        }

        $sqlInsert = <<<SQL
            INSERT INTO livros (titulo, autor, descricao, ano_lancamento, fk_usuario, imagem)
            VALUES (:titulo, :autor, :descricao, :ano_lancamento, :fk_usuario, :imagem)
        SQL;

        $db->query(
            query: $sqlInsert,
            params: [
                "titulo" => $titulo,
                "autor" => $autor,
                "descricao" => $descricao,
                "ano_lancamento" => $ano_lancamento,
                "fk_usuario" => auth()->id,
                "imagem" => $novaImagem
            ]
        );

        flash()->push("Livro.Store.Message.Success", "Cadastro com sucesso!");
        redirect('/meus-livros');
    }
}