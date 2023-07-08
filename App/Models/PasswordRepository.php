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

    public function update($newPassword, $id) {
        $SQLquery = "UPDATE `passwords` SET `password` = :newPassword WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newPassword' => $newPassword,
            'id' => $id
        ]);
    }

    public function getPassword($password_id) {
        $SQLquery = "SELECT `password` FROM `passwords` WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'id' => $password_id
        ]);
        $password = $statement->fetchColumn();
        return $password;
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