<?php

namespace App\Models;

use App\Lib\DatabaseConnection;

class ModuleRepository
{
    public DatabaseConnection $connection;

    public function countModules(){
        $SQLquery = "SELECT COUNT(*) FROM `modules`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $totaleModules = $statement->fetchColumn();
        return $totaleModules;
    }
}