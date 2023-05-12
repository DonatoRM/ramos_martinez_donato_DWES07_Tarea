<?php

namespace Donatorm\Ud07;

use PDO;
use PDOException;

abstract class ConnectionDB
{
    protected PDO $connection;
    public function __construct(string $host = 'localhost', string $user = 'gestor', string $pass = 'secreto', string $db = 'proyecto', int $port = 3306, string $charset = 'utf8mb4')
    {
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
        try {
            $this->connection = new PDO($dsn, $user, $pass);
        } catch (PDOException $ex1) {
            die('Error en la Conexión con la BD. Mensaje: ' . $ex1->getMessage());
        }
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
