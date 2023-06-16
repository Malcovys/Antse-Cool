<?php

namespace App\Lib;


class CryptedCookie
{
    protected static $encryption_method = 'AES-256-CBC';
    protected static $encryption_key = 'T2QbOhyJdCnG97Lxo4eBpfNlPLeB04';
    protected static $iv_file = 'iv.txt';

    public $name;
    public $data;
    public $duration;

    function __construct(string $name, string $data, int $duration)
    {
        $this->name = $name;
        $this->data = $data;
        $this->duration = $duration;
    }

    function setEncryptedCookie(): void {
        $cookie_name = $this->name;
        $cookie_duration = time() + $this->duration;
        # Encryption
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$encryption_method));    
        $encrypted_data = openssl_encrypt($this->data, self::$encryption_method, self::$encryption_key, 0, $iv);
        # Set cookies
        setcookie($cookie_name, base64_encode($encrypted_data), $cookie_duration);
        # Put iv in file
        $iv_file = self::$iv_file;
        file_put_contents($iv_file, base64_encode($iv));   
    }

    public static function decrypt(string $name): string {
        # get $iv value
        $iv = base64_decode(file_get_contents(self::$iv_file));
        # decrypt
        $data = openssl_decrypt(base64_decode($_COOKIE[$name]), self::$encryption_method, self::$encryption_key, 0, $iv);
        return $data;
    }

    public static function destroyCookie(string $name): void {
        setcookie($name, '', time()-3600);
    }
    
    public static function check_cookie(string $name): int {
        if (isset($_COOKIE[$name])) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
}