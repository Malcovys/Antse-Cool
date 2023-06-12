<?php

require_once('src/lib/database.php');
require_once('src/models/student.php');

function saveStudent(array $infos) {
    
    $matricul = htmlspecialchars($infos['id']);
    $fist_name = htmlspecialchars($infos['first_name']);
    $last_name = htmlspecialchars($infos['last_name']);
    $email = htmlspecialchars($infos['email']);
    $group = htmlspecialchars($infos['group']);
    $promotion = htmlspecialchars($infos['promotion']);
    $password = htmlspecialchars($infos['password']);

    $studentRepository = new StudentRepository();
    $studentRepository->connection = new DatabaseConnection();
    $student = new Student(
        $matricul,
        $fist_name,
        $last_name,
        $email,
        $group,
        $promotion,
        $password
    );

    $studentRepository->saveStutent($student);
}

