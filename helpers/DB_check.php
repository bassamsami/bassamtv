<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DB_check {
    function isConected()
    {
        if(file_exists($file_path = APPPATH.'config/database.php'))
        {
            include($file_path);
        } else {
            return false;
        }
        $config = $db[$active_group];

        if ($config['dbdriver'] === 'mysqli') {
            $hostname = $config['hostname'];
            $username = $config['username'];
            $password = $config['password'];
            $dbname = $config['database'];

            try {
                $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return true;
            } catch(PDOException $e) {
                return false;
            }
        } else {
            return false;
        }

    }

    function verify($hostname, $username, $password, $dbname) {
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
}