<?php

namespace Donatorm\Ud07;

use PDOException;

class UsersDB extends ConnectionDB
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Método que indica si el usuario está registrado en la BD
     *
     * @param string $user Usuario
     * @param string $pass Contraseña
     * @return boolean Devuelve TRUE si está registrado, y FALSE si no lo está
     */
    public function validateUserDB(string $user, string $pass): bool
    {
        $hashPass = hash('sha256', $pass);
        $queryValidateUserDB = "select * from usuarios where usuario=:u and pass=:p";
        $stmt = $this->connection->prepare($queryValidateUserDB);
        try {
            $stmt->execute([
                ':u' => $user,
                ':p' => $hashPass
            ]);
        } catch (PDOException $ex2) {
            die('Error en Validación de Usuario. Mesnaje: ' . $ex2->getMessage());
        }
        $numRegisters = $stmt->rowCount();
        $stmt = null;
        return $numRegisters;
    }
}
