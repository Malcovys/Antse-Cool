<?php

require_once('src/lib/database.php');

class Groupe
{
    public DatabaseConnection $connection;

    function createTableGroup() {

        $sqlQuery = "CREATE TABLE `group` (group_id INT PRIMARY KEY, group_name VARCHAR(100) NOT NULL, UNIQUE(group_name))";
        
        $statement = $this->connection->getConnection()->prepare($sqlQuery);

        $statement->execute();

    }
}