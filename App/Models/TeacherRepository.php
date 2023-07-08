<?php
declare(strict_types=1);

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Models\PasswordRepository;

class TeacherRepository
{
    public DatabaseConnection $connection;

    public function getLastName(string $email){
        $SQLquery = "SELECT `lastName` FROM `teachers` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $lastName = $statement->fetchColumn();
        return $lastName;
    }

    public function updatePhotoDirectory(string $photoDir, string $id) {
        $SQLquery = "UPDATE `teachers` SET `photo_dir` = :photo_dir WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'photo_dir' => $photoDir,
            'id' => $id
        ]);
    }

    public function updateFirstName(string $newFirstName, string $id) {
        $SQLquery = "UPDATE `teachers` SET `firstName` = :newFirstName WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newFirstName' => $newFirstName,
            'id' => $id
        ]);
    }

    public function getTeachers() {
        $SQLquery = "SELECT `id`, `firstName`, `lastName`, `email`, `photo_dir` FROM `teachers`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $teachers = $statement->fetchAll();
        return $teachers;
    }

    public function getMyInfos($email) {
        $SQLquery = "SELECT `firstName`, `lastName`, `id`, `email` FROM `teachers` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $myInfos = $statement->fetch();
        return $myInfos;
    }

    public function updateInfos($newInfos, $id) {
        $SQLquery = "UPDATE `teachers` SET `email` = :newEmail, `state` = :newState  WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newEmail' => $newInfos['email'],
            'newState' => $newInfos['state'],
            'id' => $id
        ]);
    }

    public function updateLastName(string $newLastName, string $id) {
        $SQLquery = "UPDATE `teachers` SET `lastName` = :newLastName WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'newLastName' => $newLastName,
            'id' => $id
        ]);
    }

    public function getFirstName(string $email) {
        $SQLquery = "SELECT `firstName` FROM `teachers` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $firstName = $statement->fetchColumn();
        return $firstName;
    }

    public function auth(array $infos) {
        $password = new PasswordRepository;
        $password->connection = new DatabaseConnection;
        $password_id = $password->getID($infos['password']);
        $SQLquery = "SELECT `email`, `password_id` FROM `teachers` WHERE `email` = :email AND `password_id` = :password_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute(([
            'email' => htmlspecialchars($infos['email']),
            'password_id' => $password_id
        ]));
        $loggetTeacher = $statement->fetch();
        return $loggetTeacher;
    }

    public function getPhotoDirectory($email) {
        $SQLquery = "SELECT `photo_dir` FROM `teachers` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'email' => $email
        ]);
        $photo_directory = $statement->fetchColumn();
        return $photo_directory;
    }

    public function getTotalTeacher() {
        $SQLquery = "SELECT COUNT(*) FROM `teachers`";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute();
        $totalTeacher = $statement->fetchColumn();
        return $totalTeacher;
    }

    public function getID($email){
        $SQLquery = "SELECT `id` FROM `teachers` WHERE `email` = :email";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'email' => $email,
        ]);
        $id = $statement->fetchColumn();
        return $id;
    }

    public function getTeacher($id) {
        $SQLquery = "SELECT `id` FROM `teachers` WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $id
        ]);
        $id = $statement->fetchColumn();
        return $id;
    }

    public function getInfos($id) {
        $SQLquery = "SELECT `id`, `firstName`, `lastName`, `email`, `photo_dir`, `state` FROM `teachers` WHERE `id` = :id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $id
        ]);
        $infos = $statement->fetchAll();
        return $infos[0];
    }

    public function save(Teacher $tacher): void {
        $password = new PasswordRepository;
        $password->connection = new DatabaseConnection;
        $password->save($tacher->password);
        $password_id = $password->getID($tacher->password);
        $SQLquery = "INSERT INTO `teachers` (`id`, `firstName`, `lastName`, `email`, `promotion`, `password_id`)
            VALUES (:id, :fist_name, :last_name, :email, :promotion, :password_id)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $tacher->matricul,
            'fist_name' => $tacher->fist_name,
            'last_name' => $tacher->last_name,
            'email' => $tacher->email,
            'promotion' => $tacher->promotion,
            'password_id' => $password_id
        ]);
    }
}