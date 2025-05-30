<?php

namespace Epitas\App\Utils;

class Flash {
    public function push($key, $valor)
    {
        $_SESSION["Flash.{$key}"] = $valor;
    }

    public function get($key, $defaultValue = null)
    {
        if(!isset($_SESSION["Flash.{$key}"])) return $defaultValue;

        return $_SESSION["Flash.{$key}"];
    }

    public function clear() {
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, "Flash.") === 0) {
                unset($_SESSION[$key]);
            }
        }
    }
}