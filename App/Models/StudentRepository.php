<?php
declare(strict_types=1);

namespace App\Models;

use \App\Lib\DatabaseConnection;

class StudentRepository
{
    public DatabaseConnection $connection;

    public function getGroupID(string $group_name): string {

        $SQLquery = "SELECT `id` FROM `groups` WHERE `name` = :name";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'name' => $group_name
        ]);

        $group_id = $statement->fetchColumn();

        return $group_id;

    }

    public function getGroupName(int $groupID): string {

        $SQLquery = "SELECT `name` FROM `groups` WHERE `id` = :group_id";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_id' => $groupID
        ]);

        $group_name = $statement->fetchColumn();

        return $group_name;
    }

    public function savePassword(string $password): void {

        $SQLquery = "INSERT INTO `passwords` (`password`) VALUES (:password)";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'password' => $password
        ]);

    }

    protected function getPasswordID(string $password): int {

        $SQLquery = "SELECT `id` FROM `passwords` WHERE `password` = :password";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'password' => $password
        ]);

        $passwordID = $statement->fetchColumn();

        return $passwordID;

    }
######## User #######
    public function auth(array $infos): array {

        $password_id = $this->getPasswordID($infos['password']);

        $SQLquery = "SELECT * FROM `students` WHERE `email` = :email AND `password_id` = :password_id";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute(([
            'email' => htmlspecialchars($infos['email']),
            'password_id' => $password_id
        ]));

        $loggetStudent = $statement->fetch();

        return $loggetStudent;

    }

    public function save(Student $student): void {

        $this->savePassword($student->password);

        $password_id = $this->getPasswordID($student->password);
        
        $SQLquery = "INSERT INTO `students` (`id`, `firstName`, `lastName`, `email`, `group_id`, `promotion`, `password_id`)
            VALUES (:id, :fist_name, :last_name, :email, :group_id, :promotion, :password_id)";
        
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'id' => $student->matricul,
            'fist_name' => $student->fist_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'group_id' => $this->getGroupID($student->group),
            'promotion' => $student->promotion,
            'password_id' => $password_id
        ]);

    }
}