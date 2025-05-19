<?php

namespace Epitas\App\Models;

class Livro {
    public $id;
    public $titulo;
    public $autor;
    public $descricao;
    public $ano_lancamento;

    public static function make($data) {
        $livro = new Livro;
        $livro->id = $data['id'];
        $livro->titulo = $data['titulo'];
        $livro->autor = $data['autor'];
        $livro->descricao = $data['descricao'];
        $livro->ano_lancamento = $data['ano_lancamento'];

        return $livro;
    }
}