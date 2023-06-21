<?php

namespace App\Controllers;

use \App\Lib\DatabaseConnection;
use \App\Models\Student;
use \App\Models\StudentRepository;
use \App\Controllers\UserControllers;
use App\Lib\Utils;
use App\Models\AbsenceRegistersRepository;
use App\Models\TeacherModulesRepository;
use App\Models\TeacherRepository;

class StudentControllers
{
    ##### Pages #####
    public static function homepage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $lastName = self::getLastName($email);
        $photoDir = self::getPhotoDirectory($email);

        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;

        $group_id = $studentRepository->getGroupIDByEmail($email);
        $totalClassMate = $studentRepository->getTotalClassMate($group_id);
        $totalEstiStudents = $studentRepository->getTotalStudent();
        $totalClassMatePourcent = Utils::calculPourCentage($totalClassMate, $totalEstiStudents);

        $student_id = $studentRepository->getId($email);
        $absenceRegisterRepository = new AbsenceRegistersRepository;
        $absenceRegisterRepository->connection = new DatabaseConnection();
        $totalAbsence = $absenceRegisterRepository->getStudentTotalAbsence($student_id);

        $teacherModuleRepository = new TeacherModulesRepository;
        $teacherModuleRepository->connection = new DatabaseConnection;
        $totalTeacher = count($teacherModuleRepository->getTeachersIDByGroupID($group_id));

        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $totalEstiTeachers = $teacherRepository->getTotalTeacher();
        $totalTeacherPourcent = Utils::calculPourCentage($totalEstiTeachers, $totalTeacher);

        $weather= Utils::getWeather();

        require('templates/pages/student/homepage.php');
    }

    public static function editProfilePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $firstName = self::getFirstName($email);
        $lastName = self::getLastName($email);
        $photoDir = self::getPhotoDirectory($email);

        require('templates/pages/student/editprofilepage.php');
    }

    public static function profslistPage() {
        require('templates/pages/student/profslistpage.php');
    }

    public static function studentslistPage() {
        require('templates/pages/student/studentslistpage.php');
    }

    public static function notegridePage() {
        require('templates/pages/student/notegridepage.php');
    }

    ##### Trairements #####
    public function auth(array $infos) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $loggetStudent = $studentRepository->auth($infos);
        return $loggetStudent;
    }
############
    public static function updateprofile() {
        if (!empty($_FILES['photo'])){
            Utils::uploadPhoto($_FILES);
        }

    }

    public static function getPhotoDirectory(string $email) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $photoDir = $studentRepository->getPhotoDirectory($email);
        return $photoDir;
    }

    public static function getLastName(string $email) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $name = $studentRepository->getLastName($email);
        return $name;
    }

    public static function getFirstName(string $email) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $name = $studentRepository->getFirstName($email);
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