<?php

namespace Epitas\App\Models;

class Avaliacao 
{
    public int $id;
    public int $fk_usuario;
    public int $fk_livro;
    public string $avaliacao;
    public int $nota;
}