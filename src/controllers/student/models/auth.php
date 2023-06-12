<?php

require_once('src/lib/database.php');
require_once('src/models/student.php');

function auth(array $infos) {

    $studentRepository = new StudentRepository();
    $studentRepository->connection = new DatabaseConnection();

    if (isset($_COOKIE['logget_user_email']) && $_COOKIE['logget_user_email'] !== '') {
        if (isset($_COOKIE['logget_user_password']) && $_COOKIE['logget_user_password'] !== '') {

            $methode = file_get_contents('encryption_method.txt');
            $encryption_key = file_get_contents('encrypt_key.txt');
            $iv = base64_decode(file_get_contents('iv.txt'));

            $user_email = openssl_decrypt(base64_decode($_COOKIE['logget_user_email']),
                $methode, $encryption_key, 0, $iv);

            $user_possword = openssl_decrypt(base64_decode($_COOKIE['logget_user_password']),
                $methode, $encryption_key, 0, $iv);

            $infos = ['email' => $user_email, 'password' => $user_possword];

            //$loggetStudent = $studentRepository->auth($infos);

            print_r($infos);

        }

    } else {

        $loggetStudent = $studentRepository->auth($infos);

        if (isset($loggetStudent) && $loggetStudent !== '') {

            if (isset($infos['keep'])) {
                if ($infos['keep'] === 'on') {

                    # Encryption
                    $encrypt_key = file_get_contents('encrypt_key.txt');
                    $encryption_method = file_get_contents('encryption_method.txt');
                    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($encryption_method));
                    
                    $encrypted_email = openssl_encrypt($loggetStudent['student_email'], 
                        $encryption_method, $encrypt_key, 0, $iv);

                    $encrypted_password = openssl_encrypt($infos['password'], 
                        $encryption_method, $encrypt_key, 0, $iv);


                    # Set cookies
                    
                    $cookie_duration = time() + 3600 * 24 * 31;

                    $cookie_name = 'logget_user_password';
                    setcookie($cookie_name, 
                        base64_encode($encrypted_password),
                        $cookie_duration,
                    );

                    $cookie_name = 'logget_user_email';
                    setcookie($cookie_name, 
                        base64_encode($encrypted_email),
                        $cookie_duration,
                    );


                    $file = 'iv.txt';
                    file_put_contents($file, base64_encode($iv));

                    // setcookie('logget_user_password', '', time()-360);
                    // setcookie('logget_user_email', '', time()-360);

                } else {
                    echo 'Keep invalide.';
                }
            }

            session_start();
            $_SESSION['name'] = [$loggetStudent['student_firstName'], $loggetStudent['student_lastName']];
            $_SESSION['matricule'] = $loggetStudent['student_id'];
            $_SESSION['group'] = $studentRepository->getGroupName($loggetStudent['group_id']);
            $_SESSION['promotion'] = $loggetStudent['promotion'];
        }
    }
}