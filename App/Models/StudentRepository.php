<?php
declare(strict_types=1);

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Models\GroupRepository;
use App\Models\PasswordRepository;
use App\Models\TeacherModulesRepository;

class StudentRepository
{
    public DatabaseConnection $connection;

    public function getLastName(string $email){
        $SQLquery = "SELECT `lastName` FROM `students` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $lastName = $statement->fetchColumn();
        return $lastName;
    }

    public function getInfos($id) {
        $SQLquery = "SELECT `students`.`id`, `students`.`firstName`, `students`.`lastName`, `students`.`email`, `students`.`photo_dir`, `students`.`state`, `groups`.`name` As `group` 
                        FROM `students` 
                        RIGHT JOIN `groups` ON `students`.`group_id` = `groups`.`id`
                        WHERE `students`.`id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $id
        ]);
        $infos = $statement->fetchAll();
        return $infos[0];
    }

    public function updateInfos($newInfos, $id) {
        $goupRepository = new GroupRepository();
        $goupRepository->connection = new DatabaseConnection();
        $group_id = $goupRepository->getID($newInfos['group']);

        $SQLquery = "UPDATE `students` SET `email` = :newEmail, `state` = :newState, `group_id` = :newGroupID  WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newEmail' => $newInfos['email'],
            'newState' => $newInfos['state'],
            'newGroupID' => $group_id,
            'id' => $id
        ]);
    }

    public function getStudent($id) {
        $SQLquery = "SELECT `id` FROM `students` WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $id
        ]);
        $id = $statement->fetchColumn();
        return $id;
    }

    public function getFirstName(string $email) {
        $SQLquery = "SELECT `firstName` FROM `students` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $firstName = $statement->fetchColumn();
        return $firstName;
    }

    public function updatePhotoDirectory(string $photoDir, string $id) {
        $SQLquery = "UPDATE `students` SET `photo_dir` = :photo_dir WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'photo_dir' => $photoDir,
            'id' => $id
        ]);
    }

    public function getMyInfos($email) {
        $SQLquery = "SELECT `students`.`firstName`, `students`.`lastName`, `students`.`id`, `students`.`email`, `students`.`promotion`, `groups`.`name` AS `group`
                        FROM `students` 
                        RIGHT JOIN `groups` ON `students`.`group_id` = `groups`.`id`
                        WHERE `students`.`email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $myInfos = $statement->fetch();
        return $myInfos;
    }

    public function getStudentsInGroupByModule(string $group_id, string $module_id) {
        $SQLquery = "SELECT `students`.`id`, `students`.`firstName`, `students`.`lastName`, `students`.`photo_dir`, `grades`.`grade` 
                        FROM `students` 
                        RIGHT JOIN `grades` ON `students`.`id` = `grades`.`student_id`
                        WHERE `students`.`group_id` = :group_id AND `grades`.`module_id` = :module_id
                        ORDER BY `students`.`firstName`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id,
            'module_id' => $module_id
        ]);
        $studentsInGroup = $statement->fetchAll();
        return $studentsInGroup;
    }

    public function verifieStudent(string $id) {
        $SQLquery = "SELECT `id` FROM `students` WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetchColumn();
    }

    public function getPasswordID($email) {
        $SQLquery = "SELECT `password_id` FROM `students` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        return $statement->fetchColumn();
    }

    public function getStudents() {
        $SQLquery = "SELECT `students`.`id`, `students`.`firstName`, `students`.`lastName`, `students`.`email`, `groups`.`name` AS `group`, `students`.`promotion`, `students`.`photo_dir`
                        FROM `students` RIGHT JOIN `groups` ON `students`.`group_id` = `groups`.`id` 
                        WHERE `students`.`id` IS NOT NULL AND `state` = 1
                        ORDER BY `students`.`promotion` DESC";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $students = $statement->fetchAll();
        return $students;
    }

    public function updateFirstName(string $newFirstName, string $id) {
        $SQLquery = "UPDATE `students` SET `firstName` = :newFirstName WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newFirstName' => $newFirstName,
            'id' => $id
        ]);
    }

    public function updateLastName(string $newLastName, string $id) {
        $SQLquery = "UPDATE `students` SET `lastName` = :newLastName WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newLastName' => $newLastName,
            'id' => $id
        ]);
    }

    public function getPhotoDirectory(string $email) {
        $SQLquery = "SELECT `photo_dir` FROM `students` WHERE `email` = :email AND `state` = 1";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $photo_directory = $statement->fetchColumn();
        return $photo_directory;
    }

    public function getGroupIDByEmail($email) {
        $SQLquery = "SELECT `group_id` FROM `students` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $group_id = $statement->fetchColumn();
        return $group_id;
    }

    public function getTotalStudent() {
        $SQLquery = "SELECT COUNT(*) FROM `students` WHERE `state` = 1";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $totalStudent = $statement->fetchColumn();
        return $totalStudent;
    }

    public function getTotalClassMate($group_id) {
        $SQLquery = "SELECT COUNT(*) FROM `students` WHERE `group_id` = :group_id AND `state` = 1";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $totalClassMate = $statement->fetchColumn();
        return $totalClassMate;
    }

    public function auth(array $infos) {
        $password = new PasswordRepository;
        $password->connection = new DatabaseConnection;
        $password_id = $password->getID($infos['password']);
        $SQLquery = "SELECT `email`, `password_id` FROM `students` WHERE `email` = :email AND `password_id` = :password_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute(([
            'email' => htmlspecialchars($infos['email']),
            'password_id' => $password_id
        ]));
        $loggetStudent = $statement->fetch();
        return $loggetStudent;
    }

    public function getIdByGroup($group_id) {
        $SQLquery = "SELECT `id` FROM `students` WHERE `group_id` = :group_id AND `state` = 1";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $studentsId = $statement->fetchColumn();
        return $studentsId;
    }

    public function getId($email) {
        $SQLquery = "SELECT `id` FROM `students` WHERE `email` = :email AND `state` = 1";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $studentsId = $statement->fetchColumn();
        return $studentsId;
    }

    public function save(Student $student): void {
        $password = new PasswordRepository;
        $password->connection = new DatabaseConnection;
        $password->save($student->password);

        $password_id = $password->getID($student->password);
        $goupRepository = new GroupRepository;
        $goupRepository->connection = new DatabaseConnection;
        $goup_id = $goupRepository->getID($student->group);

        $SQLquery = "INSERT INTO `students` (`id`, `firstName`, `lastName`, `email`, `group_id`, `promotion`, `password_id`)
            VALUES (:id, :fist_name, :last_name, :email, :group_id, :promotion, :password_id)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $student->matricul,
            'fist_name' => $student->fist_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'group_id' => $goup_id,
            'promotion' => $student->promotion,
            'password_id' => $password_id
        ]);

        $teacherModuleRepository = new TeacherModulesRepository;
        $teacherModuleRepository->connection = new DatabaseConnection;
        $moudulesInGroup = $teacherModuleRepository->getModulesInGroup($goup_id);

        $gradeRepository = new GradeRepository;
        $gradeRepository->connection = new DatabaseConnection;
        foreach($moudulesInGroup as $module) {
            $gradeRepository->insetDefaultGrades($student->matricul, $module[0]);
        }
    }
}