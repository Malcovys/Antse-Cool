<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Lib\CryptedCookie;


class UserControllers extends StudentControllers
{
    protected static string $cookie_email = 'user_email';
    protected static string $cookie_password = 'user_password';
    protected static string $cookie_student = 'user_student';

    public static function loginPage() {
            require('templates/pages/loginpage.php');
    }
    
    public static function logout() {
        if (CryptedCookie::check_cookie(self::$cookie_email)) {
            CryptedCookie::destroyCookie(self::$cookie_email);
        }
        if (CryptedCookie::check_cookie(self::$cookie_password)) {
            CryptedCookie::destroyCookie(self::$cookie_password);
        }
        session_destroy();
    }

    public function auth_by_cookie() {
        // print_r($_COOKIE);
        $user_email = CryptedCookie::decrypt(self::$cookie_email);
        $user_password = CryptedCookie::decrypt(self::$cookie_password);

        if ($_COOKIE[self::$cookie_student]) {
            $student_mode = CryptedCookie::decrypt(self::$cookie_student);
            $infos = ['email' => $user_email, 'password' => $user_password];

            if ($student_mode === 'on'){
                $loggetUser = $this->authStudent($infos);

                if (!empty($loggetUser)) {
                    $_SESSION['group'] = $this->getGroup((int)$loggetUser['group_id']);
                }
            } else {
                #professor
            }
        }
    }

    public function auth(array $infos): int {
        # Student login
        if (isset($infos['student']) && $infos['student'] === 'on') {
            $loggetUser = $this->authStudent($infos);
            # Set group
            if (isset($loggetUser) && $loggetUser !== '') {
                $_SESSION['group'] = $this->getGroup((int)$loggetUser['group_id']);
            }
        } else {
            
            # Professor login

        }

        if (!empty($loggetUser)) {
            # Cookies
            if (isset($infos['keep']) && $infos['keep'] === 'on') {
                # set email cookie
                $duration = time() + 3600*24*31;

                $cookie_name = self::$cookie_email;
                $data = htmlspecialchars($infos['email']);
                $cookie = new CryptedCookie($cookie_name, $data, $duration);
                $cookie->setEncryptedCookie();
        
                # Set password cookie
                $cookie_name = self::$cookie_password;
                $data = $infos['password'];
                $cookie = new CryptedCookie($cookie_name, $data, $duration);
                $cookie->setEncryptedCookie();

                if (isset($infos['student']) && $infos['student'] === 'on') {
                        # set user mode cookie
                        $cookie_name = self::$cookie_student;
                        $data = $infos['student'];
                        $cookie = new CryptedCookie($cookie_name, $data, $duration);
                        $cookie->setEncryptedCookie();  
                }
            } else {
                    echo 'No keep.';
                }

                # Set session val
            $_SESSION['matricule'] = $loggetUser['id'];
            $_SESSION['name'] = [$loggetUser['firstName'], $loggetUser['lastName']];
            $_SESSION['promotion'] = $loggetUser['promotion'];
            
            return 1;
        } else {
            return 0;
        }
    }
}