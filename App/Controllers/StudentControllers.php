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
        $lastName = self::getLastName($email);
        require('templates/pages/student/homepage.php');
    }

    ##### Trairements #####
    public function auth(array $infos) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $loggetStudent = $studentRepository->auth($infos);
        return $loggetStudent;
    }

    public static function getLastName(string $email) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $name = $studentRepository->getLastName($email);
        return $name;
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