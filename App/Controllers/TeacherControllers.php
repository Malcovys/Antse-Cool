<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Teacher;
use App\Models\TeacherRepository;
use App\Lib\DatabaseConnection;
use App\Models\TeacherModulesRepository;
use App\Models\AbsenceRegistersRepository;
use App\Models\GroupRepository;
use App\Models\StudentRepository;

class TeacherControllers
{
    public static function homepage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $teacher_id = $teacherRepository->getID($email);
        $lastName = self::getLastName($email);
        $totalModules= self::getTotalModules($teacher_id);
        $totaleStudent = self::getTotalStudent($teacher_id);
        $absentNumberToDay = self::getAbsentNumberToDay($teacher_id);
        require('templates/pages/teacher/homepage.php');
    }

    public static function getAbsentNumberToDay($teacher_id) {
        $tempArray = array();
        $studentsId = array();
        $studentsIds = array();
        $absentNumberToDay = 0;

        $groupRepository = new TeacherModulesRepository;
        $groupRepository->connection = new DatabaseConnection;
        $teacherGoupIDS = $groupRepository->getTeacherGoupIDS($teacher_id);
        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;

        foreach($teacherGoupIDS as $tempArray) {
            $tempArray = $studentRepository->getIdByGroup($tempArray);
            foreach($tempArray as $studentsId) {
                array_push($studentsIds,$studentsId['id']);
            }    
        }

        $absenceRegistersRepository = new AbsenceRegistersRepository;
        $absenceRegistersRepository->connection = new DatabaseConnection;
        foreach($studentsIds as $id) {
            $absentNumberToDay = $absentNumberToDay + $absenceRegistersRepository->getAbsentNumberToDay($id,date("Y-m-d"));
        }
        return $absentNumberToDay;
    }

    public static function getTotalStudent($teacher_id) {
        $teacher_modules = new TeacherModulesRepository;
        $teacher_modules->connection = new DatabaseConnection;
        $teacherGoupsIDS = $teacher_modules->getTeacherGoupIDS($teacher_id);
        $goupRepository = new GroupRepository;
        $goupRepository->connection = new DatabaseConnection;
        $totalStudent = 0;
        foreach($teacherGoupsIDS as $groupId) {
            $totalStudent = $totalStudent + $goupRepository->getCountStudentInGroup($groupId);
        }
        return $totalStudent;
    }

    public static function getTotalModules($teacher_id) {
        $teacher_modules = new TeacherModulesRepository;
        $teacher_modules->connection = new DatabaseConnection;
        $totalModules = $teacher_modules->getTotalModules($teacher_id);
        return $totalModules;
    }

    public static function getLastName(string $email) {
        $studentRepository = new TeacherRepository();
        $studentRepository->connection = new DatabaseConnection();
        $name = $studentRepository->getLastName($email);
        return $name;
    }

    public function save(array $infos) {
        $matricul = htmlspecialchars($infos['id']);
        $first_name = htmlspecialchars($infos['first_name']);
        $last_name = htmlspecialchars($infos['last_name']);
        $email = htmlspecialchars($infos['email']);
        $promotion = htmlspecialchars($infos['promotion']);
        $password = htmlspecialchars($infos['password']);
        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();
        $teacher = new Teacher($matricul, $first_name, $last_name, $email, $promotion, $password);
        $teacherRepository->save($teacher);
    }

    public function auth(array $infos) {
        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection();
        $loggetTeacher = $teacherRepository->auth($infos);
        return $loggetTeacher;
    }
}