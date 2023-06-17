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

    public function auth(array $infos) {
        $password_id = new PasswordRepository;
        $password_id->getID($infos['password']);
        $SQLquery = "SELECT `email`, `password_id` FROM `teachers` WHERE `email` = :email AND `password_id` = :password_id";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute(([
            'email' => htmlspecialchars($infos['email']),
            'password_id' => $password_id
        ]));
        $loggetStudent = $statement->fetch();
        return $loggetStudent;
    }

    public function save(Teacher $student): void {
        $password = new PasswordRepository;
        $password->save($student->password);
        $password_id = $password->getID($student->password);
        $SQLquery = "INSERT INTO `teachers` (`id`, `firstName`, `lastName`, `email`, `promotion`, `password_id`)
            VALUES (:id, :fist_name, :last_name, :email, :group_id, :promotion, :password_id)";
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $student->matricul,
            'fist_name' => $student->fist_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'promotion' => $student->promotion,
            'password_id' => $password_id
        ]);
    }
}