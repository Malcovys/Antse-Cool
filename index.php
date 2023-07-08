<?php

namespace App\Router;

use App\Controllers\StudentControllers;
use App\Controllers\UserControllers;
use App\Controllers\TeacherControllers;
use App\Controllers\GroupControllers;
use App\Controllers\ModuleControllers;
use App\Controllers\GradeControllers;
use App\Controllers\AdminControllers;
use App\Models\Teacher;

require_once('App/Autoloader.php');
\App\Autoloader::register();

try 
{
    if (!empty($_GET['action'])) 
    {
        if ($_GET['action'] === 'insert') 
        {
            if (!empty($_POST['firstName'])) {
                if (!empty($_POST['lastName'])) {
                    if (!empty($_POST['matricule'])) {
                        if (!empty($_POST['email'])) {
                            if (!empty($_POST['promotion'])) {
                                if (!empty($_POST['password'])) {
                                    if (isset($_GET['user']) && $_GET['user'] === 'teacher') {
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
        } 
        elseif ($_GET['action'] === 'admin') 
        {
            UserControllers::loginAdminpage();
        }
        elseif ($_GET['action'] === 'auth') 
        {
            if (isset($_COOKIE[UserControllers::$cookie_email], $_COOKIE[UserControllers::$cookie_password]) or isset($_COOKIE['role'], $_COOKIE['password'])) {
                $user = new UserControllers();
                if ($user->auth_by_cookie()) {
                    if (isset($_COOKIE[UserControllers::$cookie_stutend_mode])) {
                        header('Location: index.php?action=student-home');
                        exit();
                    } elseif (isset($_COOKIE['role'])) {
                        header('Location: index.php?action=admin-home');
                        exit();
                    } else {
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
        } 
        elseif ($_GET['action'] === 'student-home') 
        {
            StudentControllers::homepage();
        } 
        elseif ($_GET['action'] === 'prof-home') 
        {
            TeacherControllers::homepage();
        } 
        elseif ($_GET['action'] === 'logout') 
        {
            if (UserControllers::logout()) {
                header('Location: index.php');
                exit();
            }
            
        }
        elseif ($_GET['action'] === 'edit-profile') 
        {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::editProfilePage();
            } else {
                TeacherControllers::editProfilePage();
            } 
        }
        elseif ($_GET['action'] === 'students-list') 
        {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::studentslistPage();
            } elseif (isset($_COOKIE['role']) && $_COOKIE['role'] === 'Admin') {
                AdminControllers::studentslistPage();
            } else {
                TeacherControllers::studentslistPage();
            }
        }
        elseif ($_GET['action'] === 'update-profile') 
        {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::updateprofile($_POST, $_FILES);
            } else {
                TeacherControllers::updateprofile($_POST, $_FILES);   
            }
            header('Location: index.php?action=edit-profile');
            exit();
        }
        elseif ($_GET['action'] === 'profs-list') 
        {
            UserControllers::teacherListPage();
        }
        elseif ($_GET['action'] === 'gride-grade') 
        {
            StudentControllers::grideGradePage();
        }
        elseif ($_GET['action'] === 'profile') 
        {
            if(isset($_COOKIE['stutend_mode'])) {
                StudentControllers::profilePage();
            } else {
                TeacherControllers::profilePage();
            }
        }
        elseif ($_GET['action'] === 'addgrade-page') 
        {
            if(empty($_COOKIE['stutend_mode'])) {
                TeacherControllers::addgradePage();
            } else {
                echo 'Error 404 : page not found';
            }
        }
        elseif ($_GET['action'] === 'edit-grade') 
        {
            if (GroupControllers::verifieGroup($_GET['group']) && ModuleControllers::verifieModule($_GET['mod'])) {
                TeacherControllers::editGradePage($_GET['group'], $_GET['mod']);
            } else {
                echo 'Error 404 : page not found';
            }
        }
        elseif ($_GET['action'] === 'insert-grade')
        {  
            if (StudentControllers::verifieStudent($_GET['SID']) && ModuleControllers::verifieModule($_GET['mod'])) {
                GradeControllers::updateStudentGrade($_GET['SID'], $_GET['mod'], $_POST['grade']);
                header('Location: index.php?action=edit-grade&mod='.$_GET['mod'].'&group='.$_GET['group']);
                exit();
            } else {
                echo 'Error 404 : page not found';
            }
        }
        elseif ($_GET['action'] === 'admin-auth')
        {
            if (!empty($_POST['role']) && $_POST['role'] === 'Admin') {
                if (!empty($_POST['password'])) {
                    $auth = new AdminControllers;
                    if ($auth->auth($_POST)) {
                        header('Location: index.php?action=admin-home');
                        exit();
                    }
                }
            }
        }
        elseif ($_GET['action'] === 'admin-home')
        {
            AdminControllers::homepage();
        }
        elseif ($_GET['action'] === 'module-list')
        {
            UserControllers::moduleslistPage();
        }
        elseif ($_GET['action'] === 'edit-prof')
        {
            if (AdminControllers::checkTeacher($_GET['id'])) {
                AdminControllers::editprofPage($_GET['id']);
            }
        }
        elseif ($_GET['action'] === 'update-teacher') 
        {
            if (AdminControllers::checkTeacher($_GET['id'])) {
                $adminController = new AdminControllers();
                $adminController->updateTeacher($_POST, $_GET['id']);

                header('Location: index.php?action=edit-prof&id='.$_GET['id']);
                exit();
            }
        }
        elseif ($_GET['action'] === 'edit-student')
        {
            if (AdminControllers::checkStudent($_GET['id'])) {
                AdminControllers::editstudentPage($_GET['id']);
            }
        }
        elseif ($_GET['action'] === 'update-student') 
        {
            if (AdminControllers::checkStudent($_GET['id'])) {
                $adminController = new AdminControllers();
                $adminController->updateStudent($_POST, $_GET['id']);

                header('Location: index.php?action=edit-student&id='.$_GET['id']);
                exit();
            }
        }
        elseif ($_GET['action'] === 'edit-module')
        {
            if (AdminControllers::checkModule($_GET['id'])) {
                AdminControllers::editmodulePage($_GET['id'], $_GET['group']);
               
            }
        }
        elseif ($_GET['action'] === 'update-module')
        {
            if (AdminControllers::checkModule($_GET['id'])) {
                $adminController = new AdminControllers();
                $adminController->updateModule($_POST); 
                
                header('Location: index.php?action=edit-module&id='.$_GET['id'].'&group='.$_GET['group']);
                exit();
            }
        }
        elseif ($_GET['action'] === 'create-student')
        {
            AdminControllers::createStudentPage();
        }
        elseif ($_GET['action'] === 'create-teacher')
        {
            AdminControllers::createTeacherPage();
        }
        elseif ($_GET['action'] === 'create-module')
        {
            AdminControllers::createModulePage();
        }
        elseif ($_GET['action'] === 'insert-module')
        {
            if(!empty($_POST['name'])) {
                if(!empty($_POST['code'])) {
                    if(!empty($_POST['teacher'])) {
                        $adminController = new AdminControllers();
                        $adminController->createModule($_POST);

                        header('Location: index.php');
                        exit();
                    }
                }
            }
        }
        elseif ($_GET['action'] === 'create-scheldule')
        {
            AdminControllers::createScheldulePage();
        }
        elseif ($_GET['action'] === 'insert-scheldule')
        {
            if (!empty($_POST['date'])) {
                if (!empty($_POST['begin-hour'])) {
                    if(!empty($_POST['end-hour'])) {
                        AdminControllers::insertScheldule($_POST);
                        header('Location: index.php');
                        exit();
                    }
                }
            }
        }
        elseif ($_GET['action'] === 'mytimetable')
        {
            if (isset($_COOKIE['stutend_mode'])) {
                StudentControllers::myTimeTablePage();
            } else {
                TeacherControllers::myTimeTablePage();
            } 
        }
        elseif ($_GET['action'] === 'estitimetable')
        {
            UserControllers::groupListPage();
        }
        elseif ($_GET['action'] === 'scheldule')
        {
            if (!empty($_GET['group'])) {
                UserControllers::timeTableGroup($_GET['group']);
            }
        }
        elseif ($_GET['action'] === 'delScheldule')
        {
            if (isset($_GET['id'], $_COOKIE['role']) &&$_COOKIE['role'] == 'Admin') {
                if (isset($_GET['group'])) {
                    $adminController = new AdminControllers();
                    $adminController->removeScheldule($_GET['id']);
    
                    header('Location: index.php?action=scheldule&group='.$_GET['group']);
                    exit();
                }
            }
        }
    } else {
        if (isset($_COOKIE['user_email'], $_COOKIE['user_password'])) {
            header('Location: index.php?action=auth');
            exit();
        } elseif (isset($_COOKIE['role'], $_COOKIE['password'])) {
            header('Location: index.php?action=auth');
            exit();
        } else {
            UserControllers::loginPage();
        }
    }
} 
catch (\Exception $e) 
{
    die('Error: ' . $e);
}
