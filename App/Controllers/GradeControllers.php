<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Models\GradeRepository;

class GradeControllers
{
    public static function updateStudentGrade(string $student_id, string $module_id, $new_grade) {
        $gradeRepository = new GradeRepository;
        $gradeRepository->connection = new DatabaseConnection;
        $gradeRepository->updateGrade($student_id, $module_id, $new_grade);
    }
}