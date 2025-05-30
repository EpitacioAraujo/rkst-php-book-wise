<?php

namespace Epitas\App\Libs\Validacao;

use Epitas\App\Utils\Container;

class Validacao {
    public $validacoes = [];

    private function required( RegraDTO $regra ) {
        if(!(strlen($regra->value) > 0))
        {
            return "obrigatório";
        }
    }

    private function email( RegraDTO $regra ) {
        if(!filter_var($regra->value, FILTER_VALIDATE_EMAIL)) 
        {
            return "inválido";
        }
    }

    private function confirmed( RegraDTO $regra ) {
        $input_confirmed = $regra->all_data["{$regra->field}_confirm"] ?? null;

        if($regra->value != $input_confirmed)
        {
            return "não confere";
        }
    }

    private function min( RegraDTO $regra) {
        if(strlen($regra->value) < $regra->config)
        {
            return "deve ter no mínimo $regra->config caracteres";
        }
    }

    private function strong( RegraDTO $regra ) {
        if(!strpbrk($regra->value, "!@#$%¨&*()_+-=[]{}ºª°.,><§¬¢£³²¹", ))
        {
            return "mínimo 1 caractere especial";
        }
    }

    private function unique (RegraDTO $regra ) {
        $regra->field;
        $regra->value;
        $regra->config;
        
        $db = Container::getInstance()->get('database');

        $sanitizedTable = preg_replace('/[^a-zA-Z0-9_]/', '', $regra->config);
        $sanitizedColumn = preg_replace('/[^a-zA-Z0-9_]/', '', $regra->field);

        $query = <<<SQL
            select id from `{$sanitizedTable}` where `{$sanitizedColumn}` = :valor
        SQL;

        $item = $db->query(
            query: $query,
            params: [
                "valor" => $regra->value
            ]
        )->fetch();

        if($item)
        {
            return "indisponível";
        }
    }

    public function naoPassou(){
        $isError = array_find($this->validacoes, fn ($errors) => sizeof($errors) > 0);
        return (bool) $isError;
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

                $regra = new RegraDTO(
                    field: $campo,
                    value: $input,
                    config: $config,
                    all_data: $dados,
                );

                $erro = $validacao->$nmRegra($regra);

                if($erro) {
                    $validacao->validacoes[$campo][] = $erro;
                }
            endforeach;
        endforeach;

        return $validacao;
    }
}