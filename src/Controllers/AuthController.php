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

        $usuario = $db->query(query: $query, params: [
            "email" => $email,
            "senha" => $senha
        ])->fetch();

        if(!$usuario) {
            $_SESSION['Auth.Login.Message.Error'] = "Email ou senha incorreto";
            unset($_POST['senha']);
            $_SESSION['Auth.Login.Fields'] = $_POST;
            header("Location: /login");
        }

        if($usuario) {
            $_SESSION['auth'] = $usuario;
            $_SESSION['mensage'] = "Seja bem vindo" . $usuario['nome'] . "!";
            header("Location: /");
        }
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

            $_SESSION['Auth.Register.Fields'] = [];

            if($validacao->naoPassou()) {
                $_SESSION['Auth.Register.Fields'] = $_POST;
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
                    'senha' => $_POST['senha']
                ]
            )->fetch();

            $_SESSION['Auth.Message.Success'] = 'Cadastrado com sucesso!';

            return header('Location: /login');
        }catch(Exception $ex) {
            $_SESSION['Auth.Message.Error'] = 'Erro ao cadastrar!';
            // dd([
            //     $ex->getMessage()
            // ]);
        }
    }
}
