<?php

namespace App\Models;

use App\Lib\DatabaseConnection;

class GradeRepository
{
    public DatabaseConnection $connection;

    public function getStudentGrades(string $studentId) {
        $SQLquery = "SELECT `grades`.`module_id`, `modules`.`name` AS `module`, `grades`.`grade`
                        FROM `grades` 
                        RIGHT JOIN `modules` ON `grades`.`module_id` = `modules`.`id`
                        WHERE `grades`.`student_id` = :student_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'student_id' => $studentId
        ]);
        $grades = $statement->fetchAll();
        return $grades;
    }
}