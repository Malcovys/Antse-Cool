<?php

require_once('src/lib/database.php');

class Student
{
    public string $matricul;
    public string $fist_name;
    public string $last_name;
    public string $email;
    public string $group;
    public string $promotion;
    public string $password;

    public function __construct(string $matricul, string $fist_name, string $last_name, string $email, string $group, string $promotion, string $password)
    {
        $this->matricul = $matricul;
        $this->fist_name = $fist_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->group = $group;
        $this->promotion = $promotion;
        $this->password = $password;
    }
    
}

class StudentRepository
{
    public DatabaseConnection $connection;

    public function getGroupID(string $group_name): string {

        $SQLquery = "SELECT `group_id` FROM `groups` WHERE `group_name` = :group_name";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'group_name' => $group_name
        ]);

        $group_id = $statement->fetchColumn();

        return $group_id;

    }

    public function savePassword(string $password): void {

        $SQLquery = "INSERT INTO `passwords` (`password`) VALUES (:password)";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'password' => $password
        ]);

    }

    protected function getPasswordID(string $password): string {

        $SQLquery = "SELECT password_id FROM `passwords` WHERE `password` = :password";

        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([
            'password' => $password
        ]);

        $passwordID = $statement->fetchColumn();

        return $passwordID;

    }

    public function saveStutent(Student $student): void {

        $this->savePassword($student->password);

        $password_id = $this->getPasswordID($student->password);
        
        $SQLquery = "INSERT INTO `students` (`student_id`, `student_firstName`, `student_lastName`, `student_email`, `group_id`, `promotion`, `password_id`)
            VALUES (:identifier, :fist_name, :last_name, :email, :group_id, :promotion, :password_id)";
        
        $statement = $this->connection->getConnection()->prepare($SQLquery);
        $statement->execute([   
            'identifier' => $student->matricul,
            'fist_name' => $student->fist_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'group_id' => $this->getGroupID($student->group),
            'promotion' => $student->promotion,
            'password_id' => $password_id
        ]);

    }
}