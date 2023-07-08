<?php
namespace App\Models;

use App\Lib\DatabaseConnection;

class AdminRepository {

    public DatabaseConnection $connection;

    public function auth(string $role, string $password) {
        $SQLquery = "SELECT `role` FROM `Admin` WHERE `role` = :role AND `password` = :password";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'role' => $role,
            'password' => $password
        ]);
        
        $auth = $statement->fetchAll();

        if(empty($auth)){
            return 0;
        } else {
            return 1;
        }
    }
}