<?php
declare(strict_types=1);

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Lib\Utils;

class TeacherModulesRepository
{
    public DatabaseConnection $connection;

    public function getTotalModules($teacher_id): int {
        $SQLquery = "SELECT COUNT(*) FROM `teacher_modules` INNER JOIN `teachers` ON `teacher_modules`.`teacher_id` = `teachers`.`id` WHERE `teachers`.`id` = :teacher_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id' => $teacher_id
        ]);
        $totalModules = $statement->fetchColumn();
        return $totalModules;
    }

    public function getTeachersIDByGroupID($group_id) {
        $SQLquery = "SELECT `teacher_id` FROM `teacher_modules` WHERE `group_id` = :group_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $data = $statement->fetchAll();
        $tempArray = Utils::reorganiseArray($data);
        $teachersId = Utils::removeDuplicates($tempArray);
        return $teachersId;
    }

    public function getTeacherGoupIDS($teacher_id): array {
        $SQLquery = "SELECT `group_id` FROM `teacher_modules` WHERE `teacher_id` = :teacher_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id' => $teacher_id
        ]);
        $data = $statement->fetchAll();
        $tempArray = Utils::reorganiseArray($data);
        $teacherGroupsID = Utils::removeDuplicates($tempArray);
        return $teacherGroupsID;
    }
}