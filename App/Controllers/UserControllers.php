<?php
declare(strict_types=1);

namespace App\Controllers;

use \App\Lib\CryptedCookie;

session_start();


class UserControllers extends StudentControllers
{
    public static function loginPage() {
            require('templates/pages/loginpage.php');
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
                $cookie_name = 'user_email';
                $data = htmlspecialchars($infos['email']);
                $duration = time()*3600*24*31;
                $cookie = new CryptedCookie($cookie_name, $data, $duration);
                $cookie->setEncryptedCookie();
        
                # Set password cookie
                $cookie_name = 'user_password';
                $data = $infos['password'];
                $duration = time()*3600*24*31;
                $cookie = new CryptedCookie($cookie_name, $data, $duration);
                $cookie->setEncryptedCookie();

                if (isset($infos['student']) && $infos['student'] !== 'on') {
                        # set email cookie
                        $cookie_name = 'user_student';
                        $data = $infos['student'];
                        $duration = time()*3600*24*31;
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