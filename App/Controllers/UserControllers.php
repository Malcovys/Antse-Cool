<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\TeacherControllers;
use App\Controllers\StudentControllers;

class UserControllers
{
    public static string $cookie_email = 'user_email';
    public static string $cookie_password = 'user_password';
    public static string $cookie_stutend_mode = 'stutend_mode';

    # OK!
    public static function loginPage() {  
        require('templates/pages/loginpage.php');
    }
    
    public static function singuppage() {
        require('templates/pages/singuppage.php');
    }

    # OK!
    public static function logout() {
        // setcookie($cookie_name, '', time()-3600);
        $cookiesToDelete = array(self::$cookie_email, self::$cookie_password);
        foreach ($cookiesToDelete as $cookiesName) {
            setcookie($cookiesName, '', time()-3600);
            unset($_COOKIE[$cookiesName]);
        }
        if (isset($_COOKIE[self::$cookie_stutend_mode])) {
            setcookie(self::$cookie_stutend_mode, '', time()-3600);
            unset($_COOKIE[self::$cookie_stutend_mode]);
        }
    }

    public function auth_by_cookie() {
        $user_email = $_COOKIE[self::$cookie_email];
        $user_password = $_COOKIE[self::$cookie_password];
        $infos = ['email' => $user_email, 'password' => $user_password];
        if (isset($_COOKIE[self::$cookie_stutend_mode])) {
            $loggetUser = new StudentControllers;
            $loggetUser->auth($infos);
        } else {
            #professor
            $loggetUser = new TeacherControllers();
            $loggetUser->auth($infos);
        }
        if (isset($loggetUser) && $loggetUser !== ''){
            return 1;
        } else {
            return 0;
        }
    }

    public function auth(array $infos) {
        # Student login
        if (isset($infos['student']) && $infos['student'] === 'on') {
            $studentControllers = new StudentControllers;
            $loggetUser = $studentControllers->auth($infos);
           
        } else {  
            # Professor login
            $teacherControllers = new TeacherControllers;
            $loggetUser = $teacherControllers->auth($infos);
        }
        if ($loggetUser) {
            # set email cookie       
            $duration = time() + 3600*24*31;
            $cookie_name = self::$cookie_email;
            $email = htmlspecialchars($infos['email']);
            setcookie($cookie_name, $email, $duration);
            # Set password cookie
            $cookie_name = self::$cookie_password;
            $password = $infos['password'];
            setcookie($cookie_name, $password, $duration);
            if (isset($infos['student']) && $infos['student'] === 'on') {
                    # set user mode cookie
                    $cookie_name = self::$cookie_stutend_mode;
                    $stutend_mode = $infos['student'];
                    setcookie($cookie_name, $stutend_mode, $duration);
            } 
            return 1;
        } else {
            return 0;
        }
    }
}