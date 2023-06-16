<?php
namespace Applcation\Router;

use App\Controllers\StudentControllers;
use \App\Controllers\UserControllers;
use \App\Controllers\ProfControllers;

require_once('App/Autoloader.php');
\App\Autoloader::register();

session_start();
// require_once 'Src/Controllers/StudentControllers.php';

try { 
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'singup') {
            if (!empty($_POST['first_name'])) {
                if (!empty($_POST['last_name'])) {
                    if (!empty($_POST['id'])) {
                        if (!empty($_POST['email'])) {
                            if (!empty($_POST['group']) ) {
                                if (!empty($_POST['promotion'])) {
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
            if (isset($_COOKIE[UserControllers::$cookie_email], $_COOKIE[UserControllers::$cookie_password])){
                $user = new UserControllers();
                if ($user->auth_by_cookie()){
                    if(isset($_COOKIE[UserControllers::$cookie_stutend_mode])){
                        header('Location: index.php?action=strudent-home');
                        exit();
                    } else {
                        ## Prof action
                        header('Location: indexphp?action=prof-home'); # pas encore là
                        exit();
                    }
                } else {
                    echo 'user non reconnue';
                }
            } else {
                if (!empty($_POST['email'])) {
                    if (!empty($_POST['password'])) {
                        $user = new UserControllers();
                        if ($user->auth($_POST)) {
                            if (isset($_POST['student']) && $_POST['student'] === 'on') {
                                header('Location: index.php?action=strudent-home');
                                exit();
                            }  else {
                                header('Location: indexphp?action=prof-home'); # pas encore là
                                exit();
                            }
                        } else {
                            echo 'user non reconnue';
                        }  
                    } else {
                        throw new \Exception('Password required');
                    }
                } else {
                    throw new \Exception('E-mail required');
                }
            } 
           
        }

        elseif ($_GET['action'] === 'strudent-home') {
            StudentControllers::homepage();
        }

        elseif ($_GET['action'] === 'prof-home') {
            ProfControllers::homepage();
        }

        else if($_GET['action'] === 'logout') {
            UserControllers::logout();
            // header('Location: index.php');
            // exit();
        }
    } else {
        if (isset($_COOKIE['user_email'], $_COOKIE['user_password'])) {
            header('Location: index.php?action=auth');
            exit();
        } else {
            UserControllers::loginPage();
        }
    }
} catch(\Exception $e) {

    die('Error : '.$e);

}