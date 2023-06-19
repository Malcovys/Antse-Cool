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

    public function getName($groupID): string {
        $SQLquery = "SELECT `name` FROM `groups` WHERE `id` = :group_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $groupID
        ]);
        $group_name = $statement->fetchColumn();
        return $group_name;
    }

    public function getCountStudentInGroup($group_id): int {
        $SQLquery = "SELECT count(*) FROM `students` WHERE `group_id` = :group_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $studentsInGroup = $statement->fetchColumn();
        return $studentsInGroup;
    }

    public function getStudentID($group_id): int {
        $SQLquery = "SELECT `id` FROM `students` WHERE `goup_id` = :goup_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $studentID = $statement->fetchColumn();
        return $studentID;
    }
}