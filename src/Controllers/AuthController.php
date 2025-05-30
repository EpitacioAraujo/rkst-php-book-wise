<?php

namespace Epitas\App\Controllers;

use Epitas\App\Database\DB;
use Epitas\App\Libs\Validacao\Validacao;
use Epitas\App\Models\Usuario;
use Exception;

class AuthController
{
    public static function auth()
    {
        $mensagem = $_GET['mensagem'] ?? null;

        $content = render('pages/auth/auth', [
            'mensagem' => $mensagem
        ]);

        flash()->clear();

        return $content;
    }

    public static function sigIn(DB $db)
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $validacao = Validacao::validar([
            "email" => ["required", "email"],
            "senha" => ["required"]
        ], $_POST);

        if($validacao->naoPassou()) {
            flash()->push('Auth.SignIn.Validacoes', $validacao->validacoes);
            flash()->push('Auth.SignIn.Fields', [
                "email" => $email
            ]);
            header("Location: /auth");
            exit();
        }

        $query = <<<SQL
            select * from usuarios
            where true
                and email = :email
                and senha = :senha
        SQL;

        $usuario = $db->query(
            query: $query,
            class: Usuario::class,
            params: [
                "email" => $email,
                "senha" => $senha
            ])->fetch();

        if(!$usuario) {
            flash()->push('Auth.SignIn.Message.Error', "Email ou senha incorreto");
            flash()->push('Auth.SignIn.Fields', [
                "email" => $email,
                "senha" => ""
            ]);

            header("Location: /auth");
        }

        if($usuario) {
            $_SESSION['auth'] = $usuario;
            $_SESSION['mensage'] = "Seja bem vindo" . $usuario->nome . "!";
            header("Location: /");
        }
    }

    public static function singUp(DB $db)
    {
        try{
            $validacao = Validacao::validar([
                'nome' => ['required'],
                'email' => ['required', 'email', 'confirmed', 'unique:usuarios'],
                'email_confirm' => ['required', 'email'],
                'senha' => ['required', 'min:8', 'strong']
            ], $_POST);

            flash()->push('Auth.SingUp.Fields', []);
            
            if($validacao->naoPassou()) {
                flash()->push('Auth.SingUp.Fields', [
                    "nome" => $_POST['nome'],
                    "email" => $_POST['email'],
                    "email_confirm" => $_POST['email_confirm'],
                ]);
                flash()->push('Auth.SingUp.Validacoes', $validacao->validacoes);

                header('Location: /auth');
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

            flash()->push('Auth.SingUp.Message.Success', 'Cadastrado com sucesso!');

            return header('Location: /auth');
        }catch(Exception $ex) {
            flash()->push('Global.Message.Error', 'Um erro inesperado ocorreu!');
            return header('Location: /auth');
            // dd([
            //     $ex->getMessage()
            // ]);
        }
    }

    public static function signOut() {
        session_destroy();
        header("Location: /");
    }
}
