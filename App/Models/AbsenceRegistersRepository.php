<?php
# Attente
namespace App\Models;

use App\Lib\DatabaseConnection;

class AbsenceRegistersRepository
{
    public DatabaseConnection $connection;

    public function getAbsentNumberToDay($student_id, $date) {
        $SQLquery = "SELECT COUNT(*) FROM `absence_registers` WHERE `student_id` = :student_id AND `date` = :date";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'student_id' => $student_id,
            'date' => $date
        ]);
        $absenceNunmberToDay = $statement->fetchColumn();
        return $absenceNunmberToDay;
    }

    public function getStudentTotalAbsence($student_id) {
        $SQLquery = "SELECT COUNT(*) FROM `absence_registers` WHERE `student_id` = :student_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'student_id' => $student_id
        ]);
        $totalAbsence = $statement->fetchColumn();
        return $totalAbsence;
    }
}