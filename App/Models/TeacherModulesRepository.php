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

    public function getTeacherGoupIDS($teacher_id): array {
        $SQLquery = "SELECT `group_id` FROM `teacher_modules` WHERE `teacher_id` = :teacher_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id' => $teacher_id
        ]);
        $teacherGroupsID = $statement->fetchAll();
        $tempArray = array();
        for ($i = 0; $i < count($teacherGroupsID); $i++) {
                array_push($tempArray, $teacherGroupsID[$i][0]); 
        }
        $finalArray = Utils::removeDuplicates($tempArray);
        return $finalArray;
    }
}