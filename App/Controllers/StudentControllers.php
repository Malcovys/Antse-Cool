<?php

namespace App\Controllers;

use \App\Lib\DatabaseConnection;
use \App\Models\Student;
use \App\Models\StudentRepository;


class StudentControllers
{
    ##### Pages #####
    public static function homepage() {
        require('templates/pages/student/homepage.php');
    }

    public static function loginPage() {
        require('templates/pages/loginpage.php');
    }

    public static function singuppage() {
        require_once('templates/pages/singuppage.php');
    }

    ##### Trairements #####
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
        $student = new Student(
            $matricul,
            $first_name,
            $last_name,
            $email,
            $group,
            $promotion,
            $password
        );
    
        $studentRepository->save($student);
    }

    protected function authStudent(array $infos) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $loggetStudent = $studentRepository->auth($infos);
       
        return $loggetStudent;
    }

    protected function getGroup(int $id) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();

        $studentRepository->getGroupName($id);
    }
}