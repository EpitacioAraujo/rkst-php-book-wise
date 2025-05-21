<?php

namespace Epitas\App;

use Epitas\App\Models\Livro;
use PDO;

class DB {
    public $connection;

    public function __construct() {
        $db_path = __DIR__ . '/db.sqlite';

        // dd($db_path);
        $this->connection = new PDO('sqlite:' . $db_path);
    }

    public function livros($pesquisa = null) {
        $sql = <<<SQL
            SELECT * FROM livros
            WHERE 
                    titulo LIKE :pesquisa
                OR  autor LIKE :pesquisa
                OR  descricao LIKE :pesquisa
        SQL;

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':pesquisa', "%{$pesquisa}%", PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Livro::class);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function livro($id) {
        $query = <<<SQL
            SELECT * FROM livros WHERE id = :id
        SQL;

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Livro::class);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_CLASS);
    }
}