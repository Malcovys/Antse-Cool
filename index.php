<?php

namespace App\Router;

use App\Controllers\StudentControllers;
use App\Controllers\UserControllers;
use App\Controllers\TeacherControllers;

require_once('App/Autoloader.php');
\App\Autoloader::register();

try {
    if (!empty($_GET['action'])) {
        if ($_GET['action'] === 'singup') {
            if (!empty($_POST['first_name'])) {
                if (!empty($_POST['last_name'])) {
                    if (!empty($_POST['id'])) {
                        if (!empty($_POST['email'])) {
                            if (!empty($_POST['promotion'])) {
                                if (!empty($_POST['password'])) {
                                    if (isset($_POST['group']) && $_POST['group'] === 'I am a professor') {
                                        $teacher = new TeacherControllers;
                                        $teacher->save($_POST);
                                        header('Location: index.php');
                                        exit();
                                    } else {
                                        $student = new StudentControllers();
                                        $student->save($_POST);
                                        header('Location: index.php');
                                        exit();
                                    }
                                } else {
                                    throw new \Exception('Password is required.');
                                }
                            } else {
                                throw new \Exception('Promotion is empty.');
                            }
                        } else {
                            throw new \Exception('E-mail is required.');
                        }
                    } else {
                        throw new \Exception('Your matricul is empty.');
                    }
                } else {
                    throw new \Exception('What is your last name?');
                }
            } else {
                throw new \Exception('Your first name please');
            }
        } elseif ($_GET['action'] === 'create') {
            UserControllers::singuppage();
        } elseif ($_GET['action'] === 'auth') {
            if (isset($_COOKIE[UserControllers::$cookie_email], $_COOKIE[UserControllers::$cookie_password])) {
                $user = new UserControllers();
                if ($user->auth_by_cookie()) {
                    if (isset($_COOKIE[UserControllers::$cookie_stutend_mode])) {
                        header('Location: index.php?action=student-home');
                        exit();
                    } else {
                        // Action pour les professeurs
                        header('Location: index.php?action=prof-home');
                        exit();
                    }
                } else {
                    echo 'User non reconnu.';
                }
            } else {
                if (!empty($_POST['email'])) {
                    if (!empty($_POST['password'])) {
                        $user = new UserControllers();
                        if ($user->auth($_POST)) {
                            if (isset($_POST['student']) && $_POST['student'] === 'on') {
                                header('Location: index.php?action=student-home');
                                exit();
                            } else {
                                // Action pour les professeurs
                                header('Location: index.php?action=prof-home');
                                exit();
                            }
                        } else {
                            echo 'User non reconnu.';
                        }
                    } else {
                        throw new \Exception('Password required');
                    }
                } else {
                    throw new \Exception('E-mail required');
                }
            }
        } elseif ($_GET['action'] === 'student-home') {
            StudentControllers::homepage();
        } elseif ($_GET['action'] === 'prof-home') {
            TeacherControllers::homepage();
        } elseif ($_GET['action'] === 'logout') {
            UserControllers::logout();
            header('Location: index.php');
            exit();
        }
        elseif ($_GET['action'] === 'edit-profile') {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::editProfilePage();
            } else {
                TeacherControllers::editProfilePage();
            } 
        }
        elseif ($_GET['action'] === 'edit-profile') {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::editProfilePage();
            } else {
                TeacherControllers::editProfilePage();
            } 
        }
        elseif ($_GET['action'] === 'update-profile') {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::updateprofile();
            } else {
                TeacherControllers::profslistPage();
            }
        }
        elseif ($_GET['action'] === 'students-list') {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::studentslistPage();
            } else {
                TeacherControllers::studentslistPage();
            }
        }
        elseif ($_GET['action'] === 'profs-list') {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::profslistPage();
            } else {
                TeacherControllers::profslistPage();
            }
        }
        elseif ($_GET['action'] === 'note-gride') {
            StudentControllers::notegridePage();
        }
    } else {
        if (isset($_COOKIE['user_email'], $_COOKIE['user_password'])) {
            header('Location: index.php?action=auth');
            exit();
        } else {
            UserControllers::loginPage();
        }
    }
} catch (\Exception $e) {
    die('Error: ' . $e);
}
