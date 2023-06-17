<?php
declare(strict_types=1);

namespace App\Models;

use App\Lib\DatabaseConnection;

class TeacherModulesRepository
{
    public DatabaseConnection $connection;

    public function getTotalModules(string $teacher_id){
        $SQLquery = "SELECT COUNT(*) FROM `teacher_modules` INNER JOIN `teachers` ON `teacher_modules`.`teacher_id` = `teachers`.`id` WHERE `teachers`.`id` = :teacher_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'teacher_id' => $teacher_id
        ]);
        $totalModules = $statement->fetchColumn();
        return $totalModules;
    }

    
}