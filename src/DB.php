<?php

namespace Epitas\App;

use Epitas\App\Models\Livro;
use PDO;

class DB {
    public $connection;

    public function __construct() {
        $db_path = __DIR__ . '/../db.sqlite';

        // dd($db_path);
        $this->connection = new PDO('sqlite:' . $db_path);
    }

    public function livros() {
        $stmt = $this->connection->query('SELECT * FROM livros');
        $items = $stmt->fetchAll();

        return array_map(
            fn($item) => Livro::make($item), 
            $items
        );
    }

    public function livro($id) {
        $stmt = $this->connection->query('SELECT * FROM livros WHERE id = ' . $id);
        $items = $stmt->fetchAll();
        $item = $items[0];

        return Livro::make($item);
    }
}