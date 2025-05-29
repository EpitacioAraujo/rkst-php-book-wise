<?php

namespace Epitas\App\Libs\Validacao;

class Validacao {
    public $validacoes = [];

    private function required($campo, $input) {
        if(!(strlen($input) > 0)) {
            $label = ucfirst($campo);
            return "obrigatório";
        }
    }

    private function email($campo, $input) {
        if(!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return "inválido";
        }
    }

    private function confirmed($campo, $input) {
        $input_confirmed = $this->input["{$campo}_confirm"] ?? null;

        if($input != $input_confirmed) {
            $label = ucfirst($campo);
            return "não confirmado";
        }
    }

    private function min($campo, $input, $length) {
        if(strlen($input) < $length) {
            $label = ucfirst($campo);
            return "deve ter no mínimo $length caracteres";
        }
    }

    private function strong($campo, $input) {
        if(!strpos("*", $input)){
            $label = ucfirst($campo);
            return "precisa ter um '*'";
        }
    }

    public function naoPassou(){
        return sizeof($this->validacoes) > 0;
    }

    public static function validar(array $regras, array $dados) {
        $validacao = new Self;

        foreach($regras as $campo => $regrasDoCampo):
            $input = isset($dados[$campo]) ? $dados[$campo] : "";

            $validacao->validacoes[$campo] = [];

            foreach($regrasDoCampo as $regra):
                $exploded = explode(":", $regra);

                $nmRegra = $exploded[0];
                $config = isset($exploded[1]) ? $exploded[1] : null;

                $erro = $validacao->$nmRegra($campo, $input, $config);

                if($erro) {
                    $validacao->validacoes[$campo][] = $erro;
                }
            endforeach;
        endforeach;

        return $validacao;
    }
}