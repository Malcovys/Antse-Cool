<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Teacher;
use App\Models\TeacherRepository;
use App\Lib\DatabaseConnection;
use App\Models\TeacherModulesRepository;
use App\Models\GroupRepository;
use App\Models\StudentRepository;
use App\Lib\Utils;
use App\Models\ModuleRepository;
use App\Models\SchelduleRepository;
use App\Models\PasswordRepository;

class TeacherControllers
{
    public static function homepage() {
        $email = $_COOKIE[UserControllers::$cookie_email];

        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $teacher_id = $teacherRepository->getID($email);

        $lastName = self::getLastName($email);
        $photoDir = self::getPhotoDirectory($email);
        $totalStudent = self::getTotalStudent($teacher_id);

        $totalModules= self::getTotalModules($teacher_id);
        $totalEstiModules = self::getAllModulesNumber();
        $totalModulePourcent = Utils::calculPourCentage($totalModules, $totalEstiModules);

        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        $totalEstiStudents = $studentRepository->getTotalStudent();
        $totalStudentPourcent = Utils::calculPourCentage($totalStudent, $totalEstiStudents);

        $totaleScheldule = self::getTotaleScheldule($teacher_id);
    
        $weather= Utils::getWeather();        

        require('templates/pages/teacher/homepage.php');
    }

    public static function myTimeTablePage() {

        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);

        $timeTable = self::getTimeTables(self::getID($email));
        // print_r($timeTable);
        $title = 'My time table';
        require('templates/pages/teacher/timetablepage.php');
    }

    public static function editGradePage(string $group_name, string $module_id) {
        $title = $module_id.'-'.$group_name;

        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);

        $listInfos = StudentControllers::getStudentsInGroupByModule($group_name, $module_id);

        require('templates/pages/teacher/editgradepage.php');
    }

    public static function getTotaleScheldule($teacher_id) {
        $teacher_modules = new TeacherModulesRepository;
        $teacher_modules->connection = new DatabaseConnection;
        $teacher_modules_goups_ids = $teacher_modules->getTeacherModules($teacher_id);

        $counter = 0;
        $schelduleRepository = new SchelduleRepository();
        $schelduleRepository->connection = new DatabaseConnection();
        foreach($teacher_modules_goups_ids as $teacherModules){
            $value = $schelduleRepository->countSchelduleTeacher($teacherModules['group_id'], $teacherModules['module_id']);
            $counter = $counter + $value;
        }  
        return $counter;
    }

    public static function getTimeTables($teacher_id) {
        $teacher_modules = new TeacherModulesRepository;
        $teacher_modules->connection = new DatabaseConnection;
        $teacher_modules_goups_ids = $teacher_modules->getTeacherModules($teacher_id);

        $timeTables = array();
        $schelduleRepository = new SchelduleRepository();
        $schelduleRepository->connection = new DatabaseConnection();
        foreach($teacher_modules_goups_ids as $teacherModules){
            $value = $schelduleRepository->countSchelduleTeacher($teacherModules['group_id'], $teacherModules['module_id']);
            if ($value) {
                $timeTable = $schelduleRepository->getTeacherTimeTable($teacherModules['group_id'], $teacherModules['module_id']);
                array_push($timeTables, $timeTable);
            }
        }  
        return $timeTables[0];
    }

    public static function editProfilePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $firstName = self::getFirstName($email);
        $lastName = self::getLastName($email);
        $photoDir = self::getPhotoDirectory($email);
        $password = self::getPassword($email);
        require('templates/pages/teacher/editprofilepage.php');
    }

    public static function studentslistPage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);
        $listInfos = StudentControllers::getStudentsList();
        require('templates/pages/teacher/studentslistpage.php');
    }

    public static function profilePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);
        $infos = self::getMyInfos($email);
        require('templates/pages/teacher/profilepage.php');
    }

    public static function addgradePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);

        $id = self::getID($email);
        $myModules = self::geMyModules($id);

        require('templates/pages/teacher/addgrade-page.php');
    }

    #### Traitements ######
    public static function getPassword($email) {
        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();
        $password_id = $teacherRepository->getPasswordID($email);
        
        $passwordRepository = new PasswordRepository();
        $passwordRepository->connection = new DatabaseConnection();
        $password = $passwordRepository->getPassword($password_id);

        return [$password, $password_id];
    }

    public static function geMyModules($id) {
        $teacherRepository = new TeacherModulesRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $myModules = $teacherRepository->getMyModules($id);
        return $myModules;
    }

    public static function getMyInfos($email) {
        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $myInfos = $teacherRepository->getMyInfos($email);
        return $myInfos;
    }

    public static function getID(string $email) {
        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $id = $teacherRepository->getID($email);
        return $id;
    }

    public static function getPhotoDirectory(string $email) {
        $studentRepository = new TeacherRepository();
        $studentRepository->connection = new DatabaseConnection();
        $photoDir = $studentRepository->getPhotoDirectory($email);
        return $photoDir;
    }

    public static function getFirstName(string $email) {
        $studentRepository = new TeacherRepository();
        $studentRepository->connection = new DatabaseConnection();
        $name = $studentRepository->getFirstName($email);
        return $name;
    }

    public static function getAllModulesNumber() {
        $moduleRepository = new ModuleRepository;
        $moduleRepository->connection = new DatabaseConnection;
        $allModuleNumber = $moduleRepository->countModules();
        return $allModuleNumber;
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
        $matricul = htmlspecialchars($infos['matricule']);
        $first_name = htmlspecialchars($infos['firstName']);
        $last_name = htmlspecialchars($infos['lastName']);
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

    public static function updateprofile($infos, array $photoInfos) {
        $email = $_COOKIE[UserControllers::$cookie_email];

        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        
        $id = $teacherRepository->getId($email);

        if ($photoInfos['photo']['size']){
            $photoDir = Utils::uploadPhoto($photoInfos);
            $teacherRepository->updatePhotoDirectory($photoDir, $id);
        }

        $teacherRepository->updateFirstName($infos['firstName'], $id);
        $teacherRepository->updateLastName($infos['lastName'], $id);

        $passwordRepository = new PasswordRepository();
        $passwordRepository->connection = new DatabaseConnection();
        $passwordRepository->update($infos["password"], $infos['password_id']);
    }
}