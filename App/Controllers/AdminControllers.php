<?php
namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Models\AdminRepository;
use App\Lib\Utils;
use App\Controllers\StudentControllers;
use App\Models\GroupRepository;
use App\Models\ModuleRepository;
use App\Models\TeacherRepository;
use App\Models\StudentRepository;
use App\Models\TeacherModulesRepository;
use App\Models\SchelduleRepository;

class AdminControllers {

    public static function homepage() {

        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $totaleStudent = $studentRepository->getTotalStudent();

        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();
        $totaleTeacher = $teacherRepository->getTotalTeacher();

        $moduleRepository = new ModuleRepository();
        $moduleRepository->connection = new DatabaseConnection();
        $totaleModule = $moduleRepository->countModules();

        $weather= Utils::getWeather(); 

        require ('templates/pages/admin/homepage.php');
    }

    public static function studentslistPage() {

        $listInfos = StudentControllers::getStudentsList();

        require('templates/pages/admin/studentslistpage.php');
    }

    public static function createStudentPage() {
        require('templates/pages/admin/createstudentpage.php');
    }

    public static function createTeacherPage() {
        require('templates/pages/admin/createteacherpage.php');
    }

    public static function createModulePage() {
        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $groupList = $groupRepository->getGroups();

        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();
        $teachersList = $teacherRepository->getTeachers();

        require('templates/pages/admin/createmodulepage.php');
    }

    public static function editprofPage($id) {

        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();
        $infos = $teacherRepository->getInfos($id);

        require('templates/pages/admin/editprofpage.php');
    }

    public static function createScheldulePage() {
        $moduleRepository = new ModuleRepository();
        $moduleRepository->connection = new DatabaseConnection();
        $moduleList = $moduleRepository->getModules();

        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $groupList = $groupRepository->getGroups();

        require('templates/pages/admin/createscheldulepage.php');
    }
 

    public static function editstudentPage($id) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();
        $infos = $studentRepository->getInfos($id);

        // Utils::print_array($infos);
        require('templates/pages/admin/editstudentpage.php');
    }

    public static function editmodulePage($id, $group) {
        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $group_id = $groupRepository->getID($group);

        $teacherModuleRepository = new TeacherModulesRepository();
        $teacherModuleRepository->connection = new DatabaseConnection();
        $infos = $teacherModuleRepository->getInfos($id, $group_id);

        require('templates/pages/admin/editmodulepage.php');
    }

    public static function checkTeacher($id) {
        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();

        if ($teacherRepository->getTeacher($id)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function checkStudent($id) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();

        if ($studentRepository->getStudent($id)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function insertScheldule(array $infos) {
        $moduleRepository = new ModuleRepository();
        $moduleRepository->connection = new DatabaseConnection();
        $module_id = $moduleRepository->getID($infos['module']);

        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $group_id = $groupRepository->getID($infos['group']);

        $date = $infos['date'];
        $begin_at = $infos['begin-hour'];
        $end_at = $infos['end-hour'];

        $schelduleRepository = new SchelduleRepository();
        $schelduleRepository->connection = new DatabaseConnection();
        $schelduleRepository->insertScheldule($module_id, $group_id, $date,$begin_at, $end_at);
        
    }

    public static function checkModule($id) {
        $moduleRepository = new ModuleRepository();
        $moduleRepository->connection = new DatabaseConnection();

        if ($moduleRepository->verifieModule($id)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateModule($infos){
        $moduleRepository = new ModuleRepository();
        $moduleRepository->connection = new DatabaseConnection();
        $moduleRepository->update($infos['name'], $infos['state'],$infos['module_id']);

        $teacherModuleRepository = new TeacherModulesRepository();
        $teacherModuleRepository->connection = new DatabaseConnection();
        $teacherModuleRepository->update($infos['teacherMatricule'],$infos['module_id']);
    }

    public function removeScheldule($scheldule_id) {
        $schelduleRepository = new SchelduleRepository();
        $schelduleRepository->connection = new DatabaseConnection();
        $schelduleRepository->removeScheldule($scheldule_id);
    }

    public function createModule($moduleInfos) {
        $moduleRepository = new ModuleRepository();
        $moduleRepository->connection = new DatabaseConnection();
        $moduleRepository->insertModule($moduleInfos['code'], $moduleInfos['name']);

        $groupRepository = new GroupRepository();
        $groupRepository->connection = new DatabaseConnection();
        $group_id = $groupRepository->getID($moduleInfos['group']);

        $teacherModuleRepository = new TeacherModulesRepository();
        $teacherModuleRepository->connection = new DatabaseConnection();
        $teacherModuleRepository->insertTeacherModule($moduleInfos['code'], $moduleInfos['teacher'], $group_id);
    }

    public function updateTeacher($infos, $id) {
        $teacherRepository = new TeacherRepository();
        $teacherRepository->connection = new DatabaseConnection();

        $teacherRepository->updateInfos($infos, $id);
    }

    public function updateStudent($infos, $id) {
        $studentRepository = new StudentRepository();
        $studentRepository->connection = new DatabaseConnection();

        $studentRepository->updateInfos($infos, $id);
    }

    public function auth($user) {

        $adminRepository = new AdminRepository;
        $adminRepository->connection = new DatabaseConnection;

        $role = htmlspecialchars($user['role']);
        $password = htmlspecialchars($user['password']);

        $auth = $adminRepository->auth($role, $password);

        if ($auth){
                     
            $duration = time() + 3600*24;

            $cookie_name = 'role';
            $email = $role;
            setcookie($cookie_name, $email, $duration);
            
            $cookie_name = 'password';
            $password = $password;
            setcookie($cookie_name, $email, $duration);

            return 1;       
        } else {
            return 0;
        }
    }
}