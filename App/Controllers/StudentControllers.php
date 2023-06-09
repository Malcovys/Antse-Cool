<?php

namespace App\Controllers;

use \App\Lib\DatabaseConnection;
use \App\Models\Student;
use \App\Models\StudentRepository;
use \App\Controllers\UserControllers;
use App\Lib\Utils;
use App\Models\TeacherModulesRepository;
use App\Models\TeacherRepository;
use App\Models\GradeRepository;
use App\Models\GroupRepository;
use App\Models\PasswordRepository;
use App\Models\SchelduleRepository;

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


        $teacherModuleRepository = new TeacherModulesRepository;
        $teacherModuleRepository->connection = new DatabaseConnection;
        $totalTeacher = count($teacherModuleRepository->getTeachersIDByGroupID($group_id));

        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $totalEstiTeachers = $teacherRepository->getTotalTeacher();
        $totalTeacherPourcent = Utils::calculPourCentage($totalEstiTeachers, $totalTeacher);

        $schelduleRepository = new SchelduleRepository();
        $schelduleRepository->connection = new DatabaseConnection();
        $totaleCoursLeft = $schelduleRepository->getTotaleCoursLeft($group_id); 

        $weather= Utils::getWeather();

        require('templates/pages/student/homepage.php');
    }

    public static function myTimeTablePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);

        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $group_id = $studentRepository->getGroupIDByEmail($_COOKIE[UserControllers::$cookie_email]);

        $schelduleRepository = new SchelduleRepository();
        $schelduleRepository->connection = new DatabaseConnection();
        $timeTable = $schelduleRepository->getStudentTimeTable($group_id);

        $title = 'My time table';
        require('templates/pages/student/timetablepage.php');
    }

    public static function editProfilePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $firstName = self::getFirstName($email);
        $lastName = self::getLastName($email);
        $photoDir = self::getPhotoDirectory($email);
        $password = self::getPassword($email);

        require('templates/pages/student/editprofilepage.php');
    }

    public static function studentslistPage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);

        $listInfos = self::getStudentsList();
        require('templates/pages/student/studentslistpage.php');
    }

    public static function grideGradePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        
        $id = self::getID($email);
        $grades = self::getGrades($id);
        $photoDir = self::getPhotoDirectory($email);
        require('templates/pages/student/gridegradepage.php');
    }

    public static function profilePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);
        $infos = self::getMyInfos($email);
        require('templates/pages/student/profilepage.php');
    }

    ##### Trairements #####
    public static function getPassword($email) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $password_id = $studentRepository->getPasswordID($email);
        
        $passwordRepository = new PasswordRepository();
        $passwordRepository->connection = new DatabaseConnection();
        $password = $passwordRepository->getPassword($password_id);

        return [$password, $password_id];
    }

    public function auth(array $infos) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $loggetStudent = $studentRepository->auth($infos);
        return $loggetStudent;
    }
    
    public static function getMyInfos($email) {
        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        $myInfos = $studentRepository->getMyInfos($email);
        return $myInfos;
    }

    public static function getGrades(string $id) {
        $gradeRepository = new GradeRepository;
        $gradeRepository->connection = new DatabaseConnection;
        $grades = $gradeRepository->getStudentGrades($id);
        return $grades;
    }

    public static function verifieStudent(string $id) {
        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        if($studentRepository->verifieStudent(htmlspecialchars($id))){
            return 1;
        } else {
            return 0;
        }
    }

    public static function getStudentsInGroupByModule(string $group_name, string $module_id) {
        $groupRepository = new GroupRepository;
        $groupRepository->connection = new DatabaseConnection;
        $group_id = $groupRepository->getID($group_name);

        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        $studentsInGroup = $studentRepository->getStudentsInGroupByModule($group_id, $module_id);
        return $studentsInGroup;
    }

    public static function getStudentsList() {
        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        $studentsList = $studentRepository->getStudents();
        return $studentsList;
    }

    public static function getID(string $email) {
        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        $id = $studentRepository->getID($email);
        return $id;
    }
    
    public static function updateprofile($infos,$photoInfos) {
        $email = $_COOKIE[UserControllers::$cookie_email];

        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        
        $id = $studentRepository->getId($email);


        if ($photoInfos['photo']['size']){
            $photoDir = Utils::uploadPhoto($photoInfos);
            $studentRepository->updatePhotoDirectory($photoDir, $id);
        }

        $studentRepository->updateFirstName($infos['firstName'], $id);
        $studentRepository->updateLastName($infos['lastName'], $id);

        $passwordRepository = new PasswordRepository();
        $passwordRepository->connection = new DatabaseConnection();
        $passwordRepository->update($infos["password"], $infos['password_id']);
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
        $matricul = htmlspecialchars($infos['matricule']);
        $first_name = htmlspecialchars($infos['firstName']);
        $last_name = htmlspecialchars($infos['lastName']);
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