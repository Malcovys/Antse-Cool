<?php
namespace Applcation\Router;

use App\Controllers\StudentControllers;
use \App\Controllers\UserControllers;

require_once('App/Autoloader.php');
\App\Autoloader::register();

session_start();


// require_once 'Src/Controllers/StudentControllers.php';

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

                                        $student = new UserControllers;
                                        $student->save($_POST);
                                        header('Location: index.php');
                                        exit();

                                    } else {
                                        throw new \Exception('Password is required.');
                                    }
                                } else {
                                    throw new \Exception('Promotion is empty.');
                                }
                            } else {
                                throw new \Exception('Group is required.');
                            }
                        } else {
                            throw new \Exception('E-mail is required.');
                        }
                    } else {
                        throw new \Exception('Your matricul is empty.');
                    }
                } else {
                    throw new \Exception('What is your last name ?');
                }
            } else {
                throw new \Exception('Your first name please');
            }
        }

        elseif ($_GET['action'] === 'create') {

            UserControllers::singuppage();
        }

        elseif ($_GET['action'] === 'auth') {
            if (isset($_POST['email']) && $_POST['email'] !== '') {
                if (isset($_POST['password']) && $_POST['password'] !== '') {

                    $user = new UserControllers();
                    $auth = $user->auth($_POST);

                    if ($auth) {
                        if (isset($_POST['student']) && $_POST['student'] === 'on') {
                            header('Location: index.php?action=strudent-home');
                            exit();
                        } else {
                            echo 'Prof';
                        }   
                    }
                    
                } else {
                    throw new \Exception('Password required');
                }
            } else {
                throw new \Exception('E-mail required');
            }
        }

        elseif ($_GET['action'] === 'strudent-home') {
            
            StudentControllers::homepage();
        }

    } else {

        UserControllers::loginPage();
    }

} catch(\Throwable $e) {

    die('Error : '.$e->getMessage());

}