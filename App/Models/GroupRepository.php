<?php
namespace App\Models;

use App\Lib\DatabaseConnection;

class GroupRepository
{
    public DatabaseConnection $connection;

    public function getID(string $group_name) {
        $SQLquery = "SELECT `id` FROM `groups` WHERE `name` = :name";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'name' => $group_name
        ]);
        $group_id = $statement->fetchColumn();
        return $group_id;
    }

    public function getName(int $groupID) {
        $SQLquery = "SELECT `name` FROM `groups` WHERE `id` = :group_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $groupID
        ]);
        $group_name = $statement->fetchColumn();
        return $group_name;
    }
}