<?php
namespace App\Models;

use App\Lib\DatabaseConnection;

class SchelduleRepository
{
    public DatabaseConnection $connection;

    public function insertScheldule($module_id, $group_id, $date, $begin_at, $end_at) {
        $SQLquery = "INSERT INTO `scheldules` (`module_id`, `group_id`, `date`, `begin_at`, `end_at`) 
                        VALUES (:module_id, :group_id, :date, :begin_at, :end_at)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'module_id' => $module_id,
            'group_id' => $group_id,
            'date' => $date,
            'begin_at' => $begin_at,
            'end_at' => $end_at
        ]);
    }

    public function countSchelduleTeacher($group_id, $module_id) {
        $SQLquery = "SELECT COUNT(*) FROM `scheldules` WHERE `group_id` = :group_id AND `module_id` = :module_id AND `date` >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id,
            'module_id' => $module_id
        ]);
        $value = $statement->fetchColumn();
        return $value;
    }

    public function getTotaleCoursLeft($group_id) {
        $SQLquery = "SELECT COUNT(*) FROM `scheldules` WHERE `group_id` = :group_id AND `date` >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $totale = $statement->fetchColumn();
        return $totale;
    }

    public function getStudentTimeTable($group_id) {
        $SQLquery = "SELECT `scheldules`.`id`, `scheldules`.`module_id`, `modules`.`name` AS `module`, `scheldules`.`date`, `scheldules`.`begin_at`, `scheldules`.`end_at` 
                        FROM `scheldules` 
                        RIGHT JOIN `modules` ON `scheldules`.`module_id` = `modules`.`id`
                        WHERE `scheldules`.`group_id` = :group_id AND `scheldules`.`date` >= DATE_SUB(NOW(), INTERVAL 1 WEEK)
                        ORDER BY `scheldules`.`date` DESC"; 
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $studentTimeTable = $statement->fetchAll();
        return $studentTimeTable;
    }

    public function removeScheldule($id) {
        $SQLquery = "DELETE FROM `scheldules` WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'id' => $id
        ]);
    }

    public function getTeacherTimeTable($group_id, $module_id) {
        $SQLquery = "SELECT `scheldules`.`module_id`, `groups`.`name` AS  `group`, `modules`.`name` AS `module`, `scheldules`.`date`, `scheldules`.`begin_at`, `scheldules`.`end_at` 
                        FROM `scheldules` 
                        RIGHT JOIN `modules` ON `scheldules`.`module_id` = `modules`.`id`
                        RIGHT JOIN `groups` ON `groups`.`id` = `scheldules`.`group_id`
                        WHERE `scheldules`.`group_id` = :group_id AND `scheldules`.`module_id` = :module_id AND `scheldules`.`date` >= DATE_SUB(NOW(), INTERVAL 1 WEEK)
                        ORDER BY `scheldules`.`date` DESC"; 
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id,
            'module_id' => $module_id
        ]);
        $studentTimeTable = $statement->fetchAll();
        return $studentTimeTable;
    }
}