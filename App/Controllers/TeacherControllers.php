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
use App\Lib\Utils;
use App\Models\ModuleRepository;

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
        $absentNumberToDay = self::getAbsentNumberToDay($teacher_id);

        $totalModules= self::getTotalModules($teacher_id);
        $totalEstiModules = self::getAllModulesNumber();
        $totalModulePourcent = Utils::calculPourCentage($totalModules, $totalEstiModules);

        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;
        $totalEstiStudents = $studentRepository->getTotalStudent();
        $totalStudentPourcent = Utils::calculPourCentage($totalStudent, $totalEstiStudents);
    
        $weather= Utils::getWeather();        

        require('templates/pages/teacher/homepage.php');
    }

    public static function editProfilePage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $firstName = self::getFirstName($email);
        $lastName = self::getLastName($email);
        $photoDir = self::getPhotoDirectory($email);
        require('templates/pages/teacher/editprofilepage.php');
    }

    public static function studentslistPage() {
        $email = $_COOKIE[UserControllers::$cookie_email];
        $photoDir = self::getPhotoDirectory($email);
        $listInfos = StudentControllers::getStudentsList();
        require('templates/pages/teacher/studentslistpage.php');
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

    public static function getAbsentNumberToDay($teacher_id) {
        $tempArray = array();
        $studentsIds = array();
        $absentNumberToDay = 0;

        $groupRepository = new TeacherModulesRepository;
        $groupRepository->connection = new DatabaseConnection;
        $teacherGoupIDS = $groupRepository->getTeacherGoupIDS($teacher_id);
        $studentRepository = new StudentRepository;
        $studentRepository->connection = new DatabaseConnection;

        foreach($teacherGoupIDS as $tempArray) {
            $studentId = $studentRepository->getIdByGroup($tempArray);
            array_push($studentsIds,$studentId);  
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
    }
}