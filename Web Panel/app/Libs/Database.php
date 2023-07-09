<?php

class Database extends PDO
{
    function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            parent::__construct($dsn, DB_USER, DB_PASS, $options);


        } catch (PDOException $e) {
            echo 'Connection Error Dtabase: ' . $e->getMessage();
            exit;
        }
    }
}

