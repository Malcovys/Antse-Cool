<?php

namespace App\Models;

use App\Lib\DatabaseConnection;

class ModuleRepository
{
    public DatabaseConnection $connection;

    public function countModules(){
        $SQLquery = "SELECT COUNT(*) FROM `modules` WHERE `state` = 1";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $totaleModules = $statement->fetchColumn();
        return $totaleModules;
    }

    public function verifieModule($module_id) {
        $SQLquery = "SELECT `id` FROM `modules` WHERE `id` = :module_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'module_id' => $module_id
        ]);
        return $statement->fetch();
    }

    public function insertModule($id, $name) {
        $SQLquery = "INSERT INTO `modules` (`id`, `name`) VALUES (:id, :name) ";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'id' => $id,
            'name' => $name
        ]);
    }

    public function getModules() {
        $SQLquery = "SELECT `name` FROM `modules`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $modules = $statement->fetchAll();
        return $modules;
    }

    public function update($name, $state, $id) {
        $SQLquery = "UPDATE `modules` SET `name` = :newName, `state` = :newState WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newName' => $name,
            'newState' => $state,
            'id' => $id
        ]);
    }

    public function getID($name) {
        $SQLquery = "SELECT id FROM modules WHERE name = :name";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            "name" => $name
        ]);
        $id = $statement->fetchColumn();
        return $id;
    }
}