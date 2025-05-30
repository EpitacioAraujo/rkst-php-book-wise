<?php

namespace Epitas\App\Utils;

class Session {
    public function push($chave, $valor)
    {
        $_SESSION[$chave] = $valor;
    }

    public function get($chave)
    {
        if(!isset($_SESSION[$chave])) return null;

        return $_SESSION[$chave];
    }

    public function unset($chave) {
        if(isset($_SESSION[$chave])) {
            unset($_SESSION[$chave]);
        }
    }
}