<?php

namespace Epitas\App\Database;

use PDO;

class DB implements DatabaseInterface
{
    private $connection;

    public function __construct(array $config) 
    {
        $driver = $config['driver'];
        $database = $config['database'];

        $this->connection = new PDO(dsn: $driver . ':' . $database);
    }

    public function query($query, $class = null, $params = []) 
    {
        $stmt = $this->connection->prepare($query);

        if($class) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $stmt->execute($params);

        return $stmt;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}