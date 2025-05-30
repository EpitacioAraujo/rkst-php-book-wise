<?php

namespace Epitas\App\Libs\Validacao;

class RuleDTO {
    public function __construct(
        public readonly string $field,
        public readonly string $value,
        public readonly array $all_data,
        public readonly ?string $config = null,
    ) {
    }
}