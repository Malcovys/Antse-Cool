<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\TeacherControllers;
use App\Controllers\StudentControllers;
use App\Lib\DatabaseConnection;
use App\Models\StudentRepository;
use App\Models\TeacherRepository;
use App\Controllers\AdminControllers;
use App\Models\GroupRepository;
use App\Models\SchelduleRepository;
use App\Models\TeacherModulesRepository;

class UserControllers
{
    public static string $cookie_email = 'user_email';
    public static string $cookie_password = 'user_password';
    public static string $cookie_stutend_mode = 'stutend_mode';

    # OK!
    public static function loginPage() {  
        require('templates/pages/loginpage.php');
    }
    
    public static function loginAdminpage() {
        require('templates/pages/admin/loginpage.php');
    }

    public static function groupListPage() {

        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $groupList = $groupRepository->getGroups();

        if (isset($_COOKIE[self::$cookie_stutend_mode])){
            $email = $_COOKIE[self::$cookie_email];
            $photoDir = StudentControllers::getPhotoDirectory($email);
            require('templates/pages/student/grouplistpage.php');
        } elseif(isset($_COOKIE['role']) && $_COOKIE['role'] == 'Admin') {
            require('templates/pages/admin/grouplistpage.php');
        } else {
            $email = $_COOKIE[self::$cookie_email];
            $photoDir = TeacherControllers::getPhotoDirectory($email);
            require('templates/pages/teacher/grouplistpage.php');
        }  
    }

    public static function timeTableGroup($group_name) {
        
        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $group_id = $groupRepository->getID($group_name);

        $schelduleRepositopry = new SchelduleRepository();
        $schelduleRepositopry->connection = new DatabaseConnection();

        $timeTable = $schelduleRepositopry->getStudentTimeTable($group_id);

        $title = $group_name.' Time Table';

        if(isset($_COOKIE[self::$cookie_stutend_mode])) {
            $email = $_COOKIE[self::$cookie_email];
            $photoDir = StudentControllers::getPhotoDirectory($email);
            require('templates/pages/student/timetablepage.php');
        } elseif (isset($_COOKIE['role']) && $_COOKIE['role'] == 'Admin') {
            require('templates/pages/admin/timetablepage.php');
        } else {
            $email = $_COOKIE[self::$cookie_email];
            $photoDir = TeacherControllers::getPhotoDirectory($email);
            require('templates/pages/teacher/timetablepage.php');
        }
    }

    public static function moduleslistPage() {
        $teacherModulesmoduleRepository = new TeacherModulesRepository();
        $teacherModulesmoduleRepository->connection = new DatabaseConnection();

        $listModules = $teacherModulesmoduleRepository->getModules();
        
        if (isset($_COOKIE[self::$cookie_email], $_COOKIE[self::$cookie_password])){
            $email = $_COOKIE[UserControllers::$cookie_email];

            if(isset($_COOKIE['stutend_mode'])) {
                $photoDir = StudentControllers::getPhotoDirectory($email);
                require('templates/pages/student/moduleslistpage.php');
            } else {
                $photoDir = TeacherControllers::getPhotoDirectory($email);
                require('templates/pages/teacher/moduleslistpage.php');
            }
        }

        if (isset($_COOKIE['role'], $_COOKIE['password'])) {
            require('templates/pages/admin/moduleslistpage.php');
        }
    }

    public static function teacherListPage() {
        $teacherRepository = new TeacherRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $listInfos = $teacherRepository->getTeachers();

        $email = $_COOKIE[UserControllers::$cookie_email];
        
        if(isset($_COOKIE['stutend_mode'])) {
            $photoDir = StudentControllers::getPhotoDirectory($email);
            require('templates/pages/student/profslistpage.php');
        } elseif (isset($_COOKIE['role']) && $_COOKIE['role'] === 'Admin'){
            require('templates/pages/admin/profslistpage.php');
        } else {
            $photoDir = TeacherControllers::getPhotoDirectory($email);
            require('templates/pages/teacher/profslistpage.php');
        }
    }

    public static function studentListPage() {
        $teacherRepository = new StudentRepository;
        $teacherRepository->connection = new DatabaseConnection;
        $listInfos = $teacherRepository->getStudents();

        if(isset($_COOKIE['stutend_mode'])) {
            require('templates/pages/student/profslistpage.php');
        } else {
            require('templates/pages/teacher/profslistpage.php');
        }
    }

    # OK!
    public static function logout() {

        if (isset($_COOKIE[self::$cookie_email])) {
            $cookiesToDelete = array(self::$cookie_email, self::$cookie_password);

            foreach ($cookiesToDelete as $cookiesName) {
                setcookie($cookiesName, '', time()-3600);
                unset($_COOKIE[$cookiesName]);
            }

            if (isset($_COOKIE[self::$cookie_stutend_mode])) {
                setcookie(self::$cookie_stutend_mode, '', time()-3600);
                unset($_COOKIE[self::$cookie_stutend_mode]);
            }

            return 1;
        } else {
            $cookiesToDelete = array('role', 'password');

            foreach ($cookiesToDelete as $cookiesName) {
                setcookie($cookiesName, '', time()-3600);
                unset($_COOKIE[$cookiesName]);
            }
            return 1;
        }

        return 0;
    }

    public function auth_by_cookie() {
        if (isset($_COOKIE[self::$cookie_email], $_COOKIE[self::$cookie_password])){

            $user_email = $_COOKIE[self::$cookie_email];
            $user_password = $_COOKIE[self::$cookie_password];

            $infos = ['email' => $user_email, 'password' => $user_password];

            if (isset($_COOKIE[self::$cookie_stutend_mode])) {

                $loggetUser = new StudentControllers;
                $loggetUser->auth($infos);

            } else {

                $loggetUser = new TeacherControllers();
                $loggetUser->auth($infos);
            }
        } elseif (isset($_COOKIE['role']) && $_COOKIE['role'] === 'Admin') {

            $infos = [$_COOKIE['role'], $_COOKIE['password']];

            $loggetUser = new AdminControllers;
            $loggetUser->auth($infos);
        }

        if (isset($loggetUser) && $loggetUser !== ''){
            return 1;
        } else {
            return 0;
        }
    }


    public function auth(array $infos) {
        # Student login
        if (isset($infos['student']) && $infos['student'] === 'on') {
            $studentControllers = new StudentControllers;
            $loggetUser = $studentControllers->auth($infos);
           
        } else {  
            # Professor login
            $teacherControllers = new TeacherControllers;
            $loggetUser = $teacherControllers->auth($infos);
        }
        if ($loggetUser) {
            # set email cookie       
            $duration = time() + 3600*24*31;
            $cookie_name = self::$cookie_email;
            $email = htmlspecialchars($infos['email']);
            setcookie($cookie_name, $email, $duration);
            # Set password cookie
            $cookie_name = self::$cookie_password;
            $password = $infos['password'];
            setcookie($cookie_name, $password, $duration);
            if (isset($infos['student']) && $infos['student'] === 'on') {
                    # set user mode cookie
                    $cookie_name = self::$cookie_stutend_mode;
                    $stutend_mode = $infos['student'];
                    setcookie($cookie_name, $stutend_mode, $duration);
            } 
            return 1;
        } else {
            return 0;
        }
    }
}