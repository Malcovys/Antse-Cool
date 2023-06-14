<?php

namespace App\Models;

class Student
{
    public string $matricul;
    public string $fist_name;
    public string $last_name;
    public string $email;
    public string $group;
    public string $promotion;
    public string $password;

    public function __construct(string $matricul, string $fist_name, string $last_name, string $email, string $group, string $promotion, string $password)
    {
        $this->matricul = $matricul;
        $this->fist_name = $fist_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->group = $group;
        $this->promotion = $promotion;
        $this->password = $password;
    }
    
}