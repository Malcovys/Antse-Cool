<?php

namespace App\Lib;

class DatabaseConnection
{
    public ?\PDO $database = null;

    function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO(
                'mysql:host=localhost;dbname=antse_cool;charset=utf8',
                'bonely',
                'Bonely12;'
            );
        }

        return $this->database;
    }
}