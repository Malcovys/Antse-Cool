<?php

require_once('src/lib/database.php');

class Profs
{
    public DatabaseConnection $connection;

    function createTableProfs() {

        $sqlQuery = "CREATE TABLE `profs` (prof_id VARCHAR(100) PRIMARY KEY, prof_fullName VARCHAR(100) NOT NULL, UNIQUE(prof_fullName))";
        
        $statement = $this->connection->getConnection()->prepare($sqlQuery);

        $statement->execute();

    }
}