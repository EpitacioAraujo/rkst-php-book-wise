<?php

namespace Epitas\App\Controllers;

use Epitas\App\Database\DB;

class AuthController
{
    public static function sigin()
    {
        $mensagem = $_GET['mensagem'] ?? null;

        return render('pages/sigin/sigin', [
            'mensagem' => $mensagem
        ]);
    }

    public static function register(DB $db)
    {
        $sql = <<<SQL
            INSERT INTO usuarios (nome, email, senha)
            VALUES (:nome, :email, :senha)
        SQL;

        $db->query(
            query: $sql,
            params: [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
            ]
        )->execute();

        return header('Location: /login?mensagem=Cadastro realizado com sucesso!');
    }
}
