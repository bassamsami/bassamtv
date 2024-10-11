<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Installer {
    public function index()
    {
        if(file_exists($file_path = APPPATH.'config/config.php'))
        {
            include($file_path);
        }
        if (empty($config['base_url'])) {
            $config_file_path = APPPATH.'config/config.php';
            $config_contents = file_get_contents($config_file_path);
            if (preg_match("/\[\s*'base_url'\s*]\s*=\s*''\s*;/", $config_contents)) {
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $domainName = $_SERVER['HTTP_HOST'];
                $requestUri = $_SERVER['REQUEST_URI'];
                $new_config_contents = preg_replace(
                    "/(\[\s*'base_url'\s*]\s*=\s*)''\s*;/",
                    "$1'$protocol$domainName/';",
                    $config_contents
                );
                file_put_contents($config_file_path, $new_config_contents);
                header("Location: /");
            }
        }


        if(file_exists($file_path = APPPATH.'helpers/DB_check.php'))
        {
            include($file_path);
        }

        $DB_check = new DB_check();

        if(!$DB_check->isConected()) {
            if($_SERVER['REQUEST_URI'] != "/install") {
                header("Location: /install");
                die();
            }
        } else {
            if(defined('INSTALLED') && INSTALLED) {
                if($_SERVER['REQUEST_URI'] == "/install") {
                    header("Location: /");
                    die();
                }
            } else {
                if($_SERVER['REQUEST_URI'] != "/install") {
                    header("Location: /install");
                    die();
                }
            }
        }
    }

}