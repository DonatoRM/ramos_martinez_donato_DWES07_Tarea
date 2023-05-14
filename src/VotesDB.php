<?php

namespace Donatorm\Ud07;

use PDO;
use PDOException;

class VotesDB extends ConnectionDB
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Método que Valida una Votación de forma que un usuario sólo puede registrar una votación en
     * el mismo producto
     *
     * @param string $user Usuario
     * @param integer $idProduct Identificador del Producto
     * @return boolean Devuelve TRUE y el Voto es posible, y FALSE si el voto no lo es
     */
    public function validateVote(string $user, int $idProduct): bool
    {
        $queryValidateVote = "select * from votos where idUs=:u and idPr=:p";
        $stmt = $this->connection->prepare($queryValidateVote);
        try {
            $stmt->execute([
                ':u' => $user,
                ':p' => $idProduct
            ]);
        } catch (PDOException $ex4) {
            die('Error al Validar el Voto. Mensaje: ' . $ex4->getMessage());
        }
        $numRegisters = $stmt->rowCount();
        $stmt = null;
        return !$numRegisters;
    }
    /**
     * Método con el que se inserta un Voto en la DB (ojo, después de haberlo comprobado con el
     * método validateVote)
     *
     * @param string $user Usuario que vota
     * @param integer $idProduct Identificador del producto a votar
     * @param integer $quantity Cantidad de 1 a 5 que valdrá la votación del usuario
     * @return void
     */
    public function addVote(string $user, int $idProduct, int $quantity)
    {
        $queryAddVote = "insert into votos(cantidad,idPr,idUs) values(:c,:p,:u)";
        $stmt = $this->connection->prepare($queryAddVote);
        try {
            $stmt->execute([
                ':c' => $quantity,
                ':p' => $idProduct,
                ':u' => $user
            ]);
        } catch (PDOException $ex5) {
            die('Error al Insertar el Voto. Mensaje: ' . $ex5->getMessage());
        }
    }
    /**
     * Método que Saca la Media Aritmética de las votaciones de un producto
     *
     * @param integer $id Identificador del producto
     * @return float Devuelve la Media Aritmética
     */
    public function arithmeticMeanVotes(int $id): float
    {
        $queryArithmeticMeanVotes = "select avg(cantidad) as mean from votos where idPr=:i";
        $stmt = $this->connection->prepare($queryArithmeticMeanVotes);
        try {
            $stmt->execute([
                ':i' => $id
            ]);
        } catch (PDOException $ex5) {
            die('Error al sacar la Media Aritmética. Mensaje: ' . $ex5->getMessage());
        }
        $arithmeticMean = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        return $arithmeticMean['mean'];
    }
    /**
     * Método que Cuenta el número de veces que se ha votado un producto
     *
     * @param integer $id Identificador del producto
     * @return integer Número de veces que se compró el producto
     */
    public function countProducts(int $id): int
    {
        $queryCountProducts = "select count(id) as num from votos where idPr=:i";
        $stmt = $this->connection->prepare($queryCountProducts);
        try {
            $stmt->execute([
                ':i' => $id
            ]);
        } catch (PDOException $ex6) {
            die('Error al sacar la Media Aritmética. Mensaje: ' . $ex6->getMessage());
        }
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        return $count['num'];
    }
}
