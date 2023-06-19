<?php
declare(strict_types=1);

namespace App\Models;

use App\Lib\DatabaseConnection;
use App\Models\GroupRepository;
use App\Models\PasswordRepository;

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
        $SQLquery = "SELECT `id` FROM `students` WHERE `group_id` = :group_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $group_id
        ]);
        $studentsId = $statement->fetchAll();
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
    }
}