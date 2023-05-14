<?php

namespace Donatorm\Ud07;

use PDOException;
use PDO;

class ProductsDB extends ConnectionDB
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Método que nos devuelve la tabla de Productos
     *
     * @return array Array de Prodcutos (asociativo)
     */
    public function getProductsDB(): array
    {
        $queryGetProducts = "select * from productos order by nombre,id asc";
        $stmt = $this->connection->prepare($queryGetProducts);
        try {
            $stmt->execute();
        } catch (PDOException $ex3) {
            die('Error con rescatar los Productos. Mensaje: ' . $ex3->getMessage());
        }
        $tableProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $tableProducts;
    }
}
