<?php

namespace App\Controllers;

use \App\Lib\DatabaseConnection;
use \App\Models\Student;
use \App\Models\StudentRepository;
use \App\Controllers\UserControllers;

class StudentControllers
{
    ##### Pages #####
    public static function homepage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $lastName = self::getStudentLastName($email);
        require('templates/pages/student/homepage.php');
    }
    
    public static function singuppage() {
        require('templates/pages/singuppage.php');
    }

    ##### Trairements #####
    protected function authStudent(array $infos) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $loggetStudent = $studentRepository->auth($infos);
        return $loggetStudent;
    }

    public static function getStudentLastName(string $email) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $name = $studentRepository->getLastName($email);
        return $name;
    }

    protected function getGroup(int $id) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $group = $studentRepository->getGroupName($id);
        return $group;
    }
    
    public function save(array $infos) {
        $matricul = htmlspecialchars($infos['id']);
        $first_name = htmlspecialchars($infos['first_name']);
        $last_name = htmlspecialchars($infos['last_name']);
        $email = htmlspecialchars($infos['email']);
        $group = htmlspecialchars($infos['group']);
        $promotion = htmlspecialchars($infos['promotion']);
        $password = htmlspecialchars($infos['password']);
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $student = new Student($matricul, $first_name, $last_name, $email, $group, $promotion, $password);
        $studentRepository->save($student);
    }
}