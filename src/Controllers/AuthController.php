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

        return render_view('pages/auth/auth', [
            'mensagem' => $mensagem
        ]);
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
            where email = :email
        SQL;

        $usuario = $db->query(
            query: $query,
            class: Usuario::class,
            params: [
                "email" => $email
            ])->fetch();

        if(!$usuario) {
            flash()->push('Auth.SignIn.Message.Error', "Email ou senha incorretos");
            flash()->push('Auth.SignIn.Fields', [
                "email" => $email,
                "senha" => ""
            ]);

            header("Location: /auth");
            exit();
        }

        $passIsValid = password_verify($_POST['senha'], $usuario->senha);

        if(!$passIsValid) {
            flash()->push('Auth.SignIn.Message.Error', "Email ou senha incorretos");
            flash()->push('Auth.SignIn.Fields', [
                "email" => $email,
                "senha" => ""
            ]);

            header("Location: /auth");
            exit();
        }

        if($usuario) {
            session()->push('auth', $usuario);
            flash()->push('Global.Message.Success', "Seja bem vindo" . $usuario->nome . "!");

            header("Location: /");
            exit();
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
                    'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
                ]
            )->fetch();

            flash()->push('Auth.SingUp.Message.Success', 'Cadastrado com sucesso!');

            header('Location: /auth');
            exit();
        }catch(Exception $ex) {
            flash()->push('Global.Message.Error', 'Um erro inesperado ocorreu!');
            header('Location: /auth');
            exit();
            // dd([
            //     $ex->getMessage()
            // ]);
        }
    }

    public static function signOut() {
        session_destroy();
        header("Location: /");
        exit();
    }
}
