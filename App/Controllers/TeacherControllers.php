<?php
namespace App\Controllers;

use App\Models\Teacher;
use App\Models\TeacherRepository;
use App\Lib\DatabaseConnection;
use App\Models\TeacherModulesRepository;

class TeacherControllers
{
    public static function homepage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $lastName = self::getLastName($email);
        $totalModules= self::getTotalModules($email);
        // $MyStudentsNumber = self::getMyStudentNumber();
        require('templates/pages/teacher/homepage.php');
    }

    public static function getTotalModules(string $email) {
        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $id = $teacherRepository->getID($email);
        $teacher_modules = new TeacherModulesRepository;
        $teacher_modules->connection = new DatabaseConnection;
        $totalModules = $teacher_modules->getTotalModules($id);
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
    }
}