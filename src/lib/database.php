<?php

class DatabaseConnection
{
    public ?PDO $database = null;

    function getConnection(): PDO
    {
        if ($this->database === null) {
            $this->database = new PDO();
        }

        return $this->database;
    }
}