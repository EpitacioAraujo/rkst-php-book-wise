<?php

namespace Epitas\App\Controllers;

use Epitas\App\Database\DB;
use Epitas\App\Libs\Validacao\Validacao;
use Exception;

class AuthController
{
    public static function sigin()
    {
        $mensagem = $_GET['mensagem'] ?? null;

        return render('pages/sigin/sigin', [
            'mensagem' => $mensagem
        ]);
    }

    public static function auth(DB $db)
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $query = <<<SQL
            select * from usuarios
            where true
                and email = :email
                and senha = :senha
        SQL;

        $db->query(query: $query, params: [
            "email" => $email,
            "senha" => $senha
        ])->fetch();
    }

    public static function register(DB $db)
    {
        try{
            $validacao = Validacao::validar([
                'nome' => ['required'],
                'email_confirm' => ['required', 'email'],
                'email' => ['required', 'email', 'confirmed'],
                'senha' => ['required', 'min:8', 'strong']
            ], $_POST);

            if($validacao->naoPassou()) {
                $_SESSION['validacao'] = $validacao->validacoes;
                header('Location: /login');
                exit();
            }

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

            return header('Location: /login?mensagem="Cadastro realizado com sucesso!"');
        }catch(Exception $ex) {
            dd([
                $ex->getMessage()
            ]);
        }
    }
}
