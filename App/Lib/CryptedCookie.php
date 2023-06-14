<?php

namespace App\Lib;


class CryptedCookie
{
    protected $encryption_method = 'AES-256-CBC';
    protected $encryption_key = 'T2QbOhyJdCnG97Lxo4eBpfNlPLeB04';
    protected $iv = 'hK/s9g4Rfgnm7OHobzDADw==';

    public $name;
    public $data;
    public $duration;

    function __construct(string $name, string $data, int $duration)
    {
        $this->name = $name;
        $this->data = $data;
        $this->duration = $duration;
    }

    function checkCookies() {

        if (isset($_COOKIE[$this->name]) && $_COOKIE[$this->name] !== '') {
    
                $user_data = openssl_decrypt(base64_decode($_COOKIE[$this->name]),
                    self::$encryption_method, self::$encryption_key, 0, self::$iv);
                
                return $user_data;
    
                //$infos = ['email' => $user_email, 'password' => $user_possword];
        }
    
    }
    
    function setEncryptedCookie() {
        $cookie_name = $this->name;
        $cookie_duration = $this->duration;
        # Encryption
        //$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($encryption_method));
        
        $encrypted_data = openssl_encrypt($this->data, self::$encryption_method, self::$encryption_key, 0, self::$iv);
    
        # Set cookies
        setcookie($cookie_name, base64_encode($encrypted_data), $cookie_duration);
    }
    
    function destroyCookie(string $name) {
    
        setcookie($name, '', time()-360);
    
    }
}