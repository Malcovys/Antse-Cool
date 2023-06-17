<?php
namespace App\Models;

use App\Lib\DatabaseConnection;

class PasswordRepository {

    public DatabaseConnection $connection;

    public function save(string $password): void {
        $SQLquery = "INSERT INTO `passwords` (`password`) VALUES (:password)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'password' => $password
        ]);
    }

    public function getID(string $password) {
        $SQLquery = "SELECT `id` FROM `passwords` WHERE `password` = :password";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'password' => $password
        ]);
        $passwordID = $statement->fetchColumn();
        return $passwordID;
    }
}