<?php

namespace Epitas\App\Database;

interface DatabaseInterface 
{
    public function query(string $query, ?string $class = null, array $params = []);
    public function getConnection();
}
