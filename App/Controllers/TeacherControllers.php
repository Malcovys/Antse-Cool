<?php
namespace App\Controllers;

use App\Models\Teacher;
use App\Models\TeacherRepository;
use App\Lib\DatabaseConnection;

class TeacherControllers
{
    public static function homepage() {
        require('templates/pages/Profesor/homepage.php');
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

}