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

    public function insetDefaultGrades($student_id, $module_id) {
        $SQLquery = "INSERT INTO `grades` (`student_id`, `module_id`) VALUES (:student_id, :module_id)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'student_id' => $student_id,
            'module_id' => $module_id
        ]); 
    }

    public function updateGrade($student_id, $module_id, $new_grade) {
        $SQLquery = "UPDATE `grades` SET `grade` = :new_grade WHERE `student_id` = :student_id AND `module_id` = :module_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'new_grade' => $new_grade,
            'student_id' => $student_id,
            'module_id' => $module_id
        ]);
    }
}