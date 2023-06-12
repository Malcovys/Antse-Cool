<?php

require_once('src/controllers/student/pages/homepage.php');
require_once('src/controllers/student/pages/singuppage.php');
require_once('src/controllers/student/pages/loginpage.php');
require_once('src/controllers/student/models/saveStudent.php');
require_once('src/controllers/student/models/auth.php');



try { 

    if (isset($_GET['action']) && $_GET['action'] !== '') {
        
        if ($_GET['action'] === 'singup') {
            if (isset($_POST['first_name']) && $_POST['first_name'] !== '') {
                if (isset($_POST['last_name']) && $_POST['last_name'] !== '') {
                    if (isset($_POST['id']) && $_POST['id'] !== '') {
                        if (isset($_POST['email']) && $_POST['email'] !== '') {
                            if (isset($_POST['group']) && $_POST['group'] !== '') {
                                if (isset($_POST['promotion']) && $_POST['promotion'] !== '') {
                                    if (isset($_POST['password']) && $_POST['password'] !== '') {
                                        
                                        saveStudent($_POST);

                                    } else {
                                        throw new Exception('Password is required.');
                                    }
                                } else {
                                    throw new Exception('Promotion is empty.');
                                }
                            } else {
                                throw new Exception('Group is required.');
                            }
                        } else {
                            throw new Exception('E-mail is required.');
                        }
                    } else {
                        throw new Exception('Your matricul is empty.');
                    }
                } else {
                    throw new Exception('What is your last name ?');
                }
            } else {
                throw new Exception('Your first name please');
            }
        }

        elseif ($_GET['action'] === 'create') {
            singuppage();
        }

        elseif ($_GET['action'] === 'auth') {
            if (isset($_POST['email']) && $_POST['email'] !== '') {
                if (isset($_POST['password']) && $_POST['password'] !== '') {

                    auth($_POST);
                    
                } else {
                    throw new Exception('Password required');
                }
            } else {
                throw new Exception('E-mail required');
            }
        }

    } else {

        loginPage();
    }

} catch(Exception $e) {

    die('Error : '.$e);

}