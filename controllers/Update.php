<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->onLoad();
    }

    function onLoad() {
        if(!$this->session->userdata('currently_logged_in') || !$this->input->is_ajax_request()) {
            exit('No access allowed');
        }
    }

    function getConfig() {
        $query = $this->db->get('config');
        return $query->row();
    }

    function getFilename($header) {
        if (preg_match('/filename="(.+?)"/', $header, $matches)) {
            return $matches[1];
        }
        if (preg_match('/filename=([^; ]+)/', $header, $matches)) {
            return rawurldecode($matches[1]);
        }
        throw new Exception(__FUNCTION__ .": Filename not found");
    }

    function hashDirectory($directory){
        if (! is_dir($directory)){ return false; }

        $files = array();
        $dir = dir($directory);

        while (false !== ($file = $dir->read())){
            if ($file != '.' and $file != '..') {
                if (is_dir($directory . '/' . $file)) { $files[] = $this->hashDirectory($directory . '/' . $file); }
                else { $files[] = md5_file($directory . '/' . $file); }
            }
        }

        $dir->close();

        return md5(implode('', $files));
    }

    function folderCopy($source, $dest, $permissions = 0755){
        $sourceHash = $this->hashDirectory($source);
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            if($sourceHash != $this->hashDirectory($source."/".$entry)){
                $this->folderCopy("$source/$entry", "$dest/$entry", $permissions);
            }
        }

        // Clean up
        $dir->close();
        return true;
    }

    function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    function update_database_config($hostname, $username, $password, $database) {
        $file_path = APPPATH . 'config/database.php';

        if (file_exists($file_path)) {
            $file_contents = file_get_contents($file_path);
            if ($file_contents === false) {
                return false;
            }

            $file_contents = preg_replace(
                "/('hostname' => ')[^']*(',)/",
                "$1$hostname$2",
                $file_contents
            );

            $file_contents = preg_replace(
                "/('username' => ')[^']*(',)/",
                "$1$username$2",
                $file_contents
            );

            $file_contents = preg_replace(
                "/('password' => ')[^']*(',)/",
                "$1$password$2",
                $file_contents
            );

            $file_contents = preg_replace(
                "/('database' => ')[^']*(',)/",
                "$1$database$2",
                $file_contents
            );

            $result = file_put_contents($file_path, $file_contents);
            if ($result === false) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }

    function update() {
        ini_set('max_execution_time', 300);
        $this->load->helper('url');
        $base_url = base_url();
        $db_hostname = $this->db->hostname;
        $db_database = $this->db->database;
        $db_username = $this->db->username;
        $db_password = $this->db->password;


        $arrContextOptions=stream_context_create(array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        ));

        $Config = $this->getConfig();
        $this->load->model('LicenseModel');
        $licenceData= $this->LicenseModel->licence();

        if($licenceData['status'] === "success") {
            $updateData = $licenceData['data']->update;
        } else {
            echo "Invalid File";
        }

        $update_dir = 'uploads/update/';

        if (!is_dir($update_dir)) {
            mkdir($update_dir, 0777, true);
        } else {
            delete_files($update_dir, true);
        }

        $data = file_get_contents (base64_decode("aHR0cHM6Ly9vbmVieXRlc29sdXRpb24uY29tLw==").$updateData->update_file, false, $arrContextOptions);
        $update_file = $update_dir.'update.zip';
        write_file($update_file, $data);

        if(md5_file($update_file) == $updateData->update_hash) {
            $zip = new ZipArchive;

            if ($zip->open($update_file) === TRUE) {
                $zip->extractTo(FCPATH.$update_dir);
                $zip->close();
                unlink($update_file);


                // update database
                if (file_exists($update_dir.'/database.sql')){
                    $host           =     $this->db->hostname;
                    $dbuser         =     $this->db->username;
                    $dbpassword     =     $this->db->password;
                    $dbname         =     $this->db->database;

                    $mysqli = @new mysqli($host, $dbuser, $dbpassword, $dbname);

                    if (!mysqli_connect_errno()) {
                        $sql = file_get_contents($update_dir.'/database.sql');

                        $mysqli->multi_query($sql);
                        do {

                        } while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));
                        $mysqli->close();
                    }
                }


                // get json_content
                if (file_exists($update_dir.'/config.json')){
                    $str = file_get_contents($update_dir.'/config.json');
                    $converted_json = json_decode($str, true);
                }


                // process php file
                if (file_exists($update_dir.'/update.php')){
                    require $update_dir.'/update.php';
                }


                if (file_exists($update_dir.'/config.json')){
                    // Create directorie if not exist
                    if (!empty($converted_json['directories'])) {
                        foreach ($converted_json['directories'] as $dir) {
                            if (!is_dir($dir['title']))
                                mkdir($dir['title'], 0777, true);
                        }
                    }
                    // copy folder if not exist or replace existing folder
                    if (!empty($converted_json['folders'])) {
                        foreach ($converted_json['folders'] as $folders):
                            // copy/replace file
                            $this->folderCopy($folders['from_dir'], $folders['to_dir']);
                            $this->deleteDirectory($folders['from_dir']);
                        endforeach;
                    }
                    // copy file if not exist or replace existing file
                    if (!empty($converted_json['files'])) {
                        foreach ($converted_json['files'] as $files):
                            // copy/replace file
                            copy($files['from_dir'], $files['to_dir']);
                            unlink($files['from_dir']);
                        endforeach;
                    }
                }

                if (is_dir($update_dir)) {
                    delete_files($update_dir, true);
                }

                $config_file_path = APPPATH.'$config_file_path/config.php';
                if (file_exists($config_file_path)) {
                    $config_contents = file_get_contents($config_file_path);
                    if (preg_match("/\[\s*'base_url'\s*]\s*=\s*''\s*;/", $config_contents)) {
                        $new_config_contents = preg_replace(
                            "/(\[\s*'base_url'\s*]\s*=\s*)''\s*;/",
                            "$1'$base_url/';",
                            $config_contents
                        );
                        file_put_contents($config_file_path, $new_config_contents);
                    }
                }

                $constants_file_path = APPPATH . 'config/constants.php';
                if (file_exists($constants_file_path)) {
                    $constants_file_contents = file_get_contents($constants_file_path);
                    $search = "defined('INSTALLED') OR define('INSTALLED', FALSE);";
                    $replace = "defined('INSTALLED') OR define('INSTALLED', TRUE);";
                    if (str_contains($constants_file_contents, $search)) {
                        $constants_file_contents = str_replace($search, $replace, $constants_file_contents);
                    } else {
                        $constants_file_contents .= PHP_EOL . $replace;
                    }

                    file_put_contents($constants_file_path, $constants_file_contents);
                }

                $this->update_database_config($db_hostname, $db_username, $db_password, $db_database);

                $index_file_path = FCPATH . 'index.php';
                if (file_exists($index_file_path)) {
                    $index_file_contents = file_get_contents($index_file_path);
                    $search = 'define(\'ENVIRONMENT\', isset($_SERVER[\'CI_ENV\']) ? $_SERVER[\'CI_ENV\'] : \'development\')';
                    $replace = 'define(\'ENVIRONMENT\', isset($_SERVER[\'CI_ENV\']) ? $_SERVER[\'CI_ENV\'] : \'production\');';
                    if (str_contains($index_file_contents, $search)) {
                        $index_file_contents = str_replace($search, $replace, $index_file_contents);
                    } else {
                        $index_file_contents .= PHP_EOL . $replace;
                    }

                    file_put_contents($index_file_path, $index_file_contents);
                }

                echo "Updated Successfully";
            }
        } else {
            delete_files($update_dir, true);
            echo "Invalid File";
        }
    }
}