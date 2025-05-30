<?php

namespace Epitas\App\Libs\Validacao;

use Epitas\App\Utils\Container;

class Validacao {
    public $validacoes = [];

    private function required( RuleDTO $regra ) {
        if(!(strlen($regra->value) > 0))
        {
            return "obrigatório";
        }
    }

    private function email( RuleDTO $regra ) {
        if(!filter_var($regra->value, FILTER_VALIDATE_EMAIL)) 
        {
            return "inválido";
        }
    }

    private function confirmed( RuleDTO $regra ) {
        $input_confirmed = $regra->all_data["{$regra->field}_confirm"] ?? null;

        if($regra->value != $input_confirmed)
        {
            return "não confere";
        }
    }

    private function min( RuleDTO $regra) {
        if(strlen($regra->value) < $regra->config)
        {
            return "deve ter no mínimo $regra->config caracteres";
        }
    }

    private function strong( RuleDTO $regra ) {
        if(!strpbrk($regra->value, "!@#$%¨&*()_+-=[]{}ºª°.,><§¬¢£³²¹", ))
        {
            return "mínimo 1 caractere especial";
        }
    }

    private function unique (RuleDTO $regra ) {
        $regra->field;
        $regra->value;
        $regra->config;
        
        $db = Container::getInstance()->get('database');

        $sanitizedTable = preg_replace('/[^a-zA-Z0-9_]/', '', $regra->config);
        $sanitizedColumn = preg_replace('/[^a-zA-Z0-9_]/', '', $regra->field);

        $query = <<<SQL
            select id from `{$sanitizedTable}` where `{$sanitizedColumn}` = :value
        SQL;

        $item = $db->query(
            query: $query,
            params: [
                "value" => $regra->value
            ]
        )->fetch();

        if($item)
        {
            return "indisponível";
        }
    }

    public function failed(){
        $isError = array_find($this->validacoes, fn ($errors) => sizeof($errors) > 0);
        return (bool) $isError;
    }

    public static function validate(array $rules, array $data) {
        $validacao = new Self;

        foreach($rules as $field => $fieldRules):
            $input = isset($data[$field]) ? $data[$field] : "";

            $validacao->validacoes[$field] = [];

            foreach($fieldRules as $rule):
                $exploded = explode(":", $rule);

                $ruleName = $exploded[0];
                $config = isset($exploded[1]) ? $exploded[1] : null;

                $regra = new RuleDTO(
                    field: $field,
                    value: $input,
                    config: $config,
                    all_data: $data,
                );

                $error = $validacao->$ruleName($regra);

                if($error) {
                    $validacao->validacoes[$field][] = $error;
                }
            endforeach;
        endforeach;

        return $validacao;
    }
}