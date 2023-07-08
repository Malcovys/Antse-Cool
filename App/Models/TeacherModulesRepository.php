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

    public function getModulesInGroup($group_id) {
        $SQLquery = "SELECT `module_id` FROM `teacher_modules` WHERE `group_id` = :group_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $modulesInGroup = $statement->fetchAll();
        return $modulesInGroup;
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

    public function getMyModules(string $id): array {
        $SQLquery = "SELECT `teacher_modules`.`module_id`, `groups`.`name` AS `group`, `modules`.`name` AS `module`
                        FROM `teacher_modules`
                        RIGHT JOIN `groups` 
                        ON `teacher_modules`.`group_id` = `groups`.`id`
                        RIGHT JOIN `modules`
                        ON `teacher_modules`.`module_id` = `modules`.`id`
                        WHERE `teacher_modules`.`teacher_id` = :teacher_id AND `modules`.`state` = 1
                        ORDER BY `teacher_modules`.`group_id`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id' => $id
        ]);
        $myModules = $statement->fetchAll();
        return $myModules;
    }

    public function insertTeacherModule($module_id, $teacher_id, $group_id) {
        $SQLquery = "INSERT INTO `teacher_modules` (`module_id`, `teacher_id`, `group_id`) VALUES (:module_id, :teacher_id, :group_id)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'module_id' => $module_id,
            'teacher_id' => $teacher_id,
            'group_id' => $group_id
        ]);
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

    public function getTeacherModules($teacher_id) {
        $SQLquery = "SELECT `group_id`, `module_id`  FROM `teacher_modules` WHERE `teacher_id` = :teacher_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id' => $teacher_id
        ]);
        $data = $statement->fetchAll();
        return $data;
    }

    public function getInfos ($id, $group_id) {
        $SQLquery = "SELECT `teacher_modules`.`module_id`, `modules`.`name` AS `module_name`, `teachers`.`id` AS `teacherMatricule`, `teachers`.`lastName` AS `teacher`, `groups`.`name` AS `group`, `modules`.`state`
                        FROM `teacher_modules`
                        RIGHT JOIN `modules` ON `modules`.`id` = `teacher_modules`.`module_id`
                        RIGHT JOIN `teachers` ON `teachers`.`id` = `teacher_modules`.`teacher_id`
                        RIGHT JOIN `groups` ON `groups`.`id` = `teacher_modules`.`group_id`
                        WHERE `teacher_modules`.`module_id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'id' => $id
        ]);
        $infos = $statement->fetchAll();
        return $infos[0];
    }

    public function update($teacher_id, $module_id) {
        $SQLquery = "UPDATE `teacher_modules` SET `teacher_id` = :teacher_id WHERE `module_id` = :module_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id'=> $teacher_id,
            'module_id' => $module_id,
        ]);
    }

    public function getModules() {
        $SQLquery = "SELECT `teacher_modules`.`module_id`, `modules`.`name` AS `module_name`, `teachers`.`lastName` AS `teacher`, `groups`.`name` AS `group`
                        FROM `teacher_modules`
                        RIGHT JOIN `modules` ON `modules`.`id` = `teacher_modules`.`module_id`
                        RIGHT JOIN `teachers` ON `teachers`.`id` = `teacher_modules`.`teacher_id`
                        RIGHT JOIN `groups` ON `groups`.`id` = `teacher_modules`.`group_id`
                        WHERE `teacher_modules`.`module_id` IS NOT NULL
                        ORDER BY `groups`.`name`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        return $statement->fetchAll();
    }
}