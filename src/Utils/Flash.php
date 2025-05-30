<?php

namespace Epitas\App\Utils;

class Flash {
    public function push($chave, $valor)
    {
        $_SESSION["Flash.{$chave}"] = $valor;
    }

    public function get($chave, $defaultValue = null)
    {
        if(!isset($_SESSION["Flash.{$chave}"])) return $defaultValue;

        return $_SESSION["Flash.{$chave}"];
    }

    public function clear() {
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, "Flash.") === 0) {
                unset($_SESSION[$key]);
            }
        }
    }
}