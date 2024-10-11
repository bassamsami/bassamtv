<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cron extends CI_Controller{
    function __construct()
	{
		parent::__construct();
		$this->load->model('Cron_model');
	}


    public function index($slug=''){
    	echo "This is cron.";
    }

    public function notification($cron_key = ''){
        if(!empty($cron_key) && $cron_key !='' && $cron_key !=NULL):
            if($this->Cron_model->check_cron_key($cron_key)):
                if($this->Cron_model->is_cron_enabled($cron_key)):
                    $config = $this->Cron_model->getConfig();

                    if($config->onesignal_appid === "" && $config->onesignal_api_key == "") exit("Please Setup Notification Settings in Admin Panel!");
            
                    $json =array();
                    $this->db->order_by('id', 'RANDOM');
                    $this->db->limit(1);
                    $query = $this->db->get('movies');
                    $json[] = $query->row();
                    
                    $this->db->order_by('id', 'RANDOM');
                    $this->db->limit(1);
                    $query = $this->db->get('web_series');
                    $json[] = $query->row();
            
                    $r_data = $json[array_rand($json, 1)];
            
                    $idd = $r_data->id;
                    $Heading = $r_data->name;
                    $Message = $r_data->description;
                    $Large_Icon = $r_data->poster;
                    $Big_Picture = $r_data->banner;
                
                    $content_type = $r_data->content_type;
                    if($content_type == 1) {
                        $c_Type = "Movie";
                    } else if($content_type == 2) {
                        $c_Type = "Web Series";
                    } else {
                        exit();
                    }
                
            
            
                    $headings      = array(
                        "en" => $Heading
                    );
                    $content      = array(
                        "en" => $Message
                    );
                    $fields = array(
                        'included_segments' => array(
                            'All'
                        ),
                        'app_id' => $config->onesignal_appid,
                        'contents' => $content,
                        'headings' => $headings,
                        'data' => array(
                            "Type" => $c_Type,
                            "Movie_id" => $idd
                        ),            
                        "big_picture" => $Big_Picture,
                        "large_icon" => $Large_Icon
                    );
                    
                    $fields = json_encode($fields);
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json; charset=utf-8',
                        "Authorization: Basic $config->onesignal_api_key"
                    ));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    
                    $response = curl_exec($ch);
                    curl_close($ch);
            
                    $D_response = json_decode($response);
                    //echo "Total Recipients= $D_response->recipients";
                else:
                    echo 'Cron is Disabled.';
                endif;
            else:
                echo 'Cron key is invalid.';
            endif;
        else:
            echo 'Cron key must not be null or empty.';
        endif;
    }

    function dbbackup($cron_key = '') {
        if(!empty($cron_key) && $cron_key !='' && $cron_key !=NULL):
            if($this->Cron_model->check_cron_key($cron_key)):
                if($this->Cron_model->is_cron_enabled($cron_key)):
                    $Today = date("Y-m-d_h-i-s");
		            $this->load->dbutil();
		            $prefs = array(
		            	'format' => 'txt',
		            	'filename' => 'db.sql'
		            );
		            $backup = $this->dbutil->backup($prefs);
		            if (!is_dir('backup/db/')) {
		            	mkdir('backup/db/', 0777, true);
		            }
		            write_file("backup/db/AutoBackup.sql", $backup);
                else:
                    echo 'Cron is Disabled.';
                endif;
            else:
                echo 'Cron key is invalid.';
            endif;
        else:
            echo 'Cron key must not be null or empty.';
        endif;
	}

    public function daily($cron_key = ''){
        if(!empty($cron_key) && $cron_key !='' && $cron_key !=NULL):
            if($this->Cron_model->check_cron_key($cron_key)):
                if($this->Cron_model->is_cron_enabled($cron_key)):
                    $config = $this->Cron_model->getConfig();
                    if($config->auto_notification_status =='1' && $config->auto_notification_schedule == '1'):
                        $this->notification($cron_key);
                    endif;
                    if($config->db_backup_status =='1' && $config->db_backup_schedule == '1'):
                        $this->dbbackup($cron_key);
                    endif;
                    echo 'Cron process finished';
                else:
                    echo 'Cron is Disabled.';
                endif;
            else:
                echo 'Cron key is invalid.';
            endif;
        else:
            echo 'Cron key must not be null or empty.';
        endif;
    }

    public function weekly($cron_key = ''){
        if(!empty($cron_key) && $cron_key !='' && $cron_key !=NULL):
            if($this->Cron_model->check_cron_key($cron_key)):
                if($this->Cron_model->is_cron_enabled($cron_key)):
                    $config = $this->Cron_model->getConfig();
                    if($config->auto_notification_status =='1' && $config->auto_notification_schedule == '7'):
                        $this->notification($cron_key);
                    endif;
                    if($config->db_backup_status =='1' && $config->db_backup_schedule == '7'):
                        $this->dbbackup($cron_key);
                    endif;
                    echo 'Cron process finished';
                else:
                    echo 'Cron is Disabled.';
                endif;
            else:
                echo 'Cron key is invalid.';
            endif;
        else:
            echo 'Cron key must not be null or empty.';
        endif;
    }

    public function monthly($cron_key = ''){
        if(!empty($cron_key) && $cron_key !='' && $cron_key !=NULL):
            if($this->Cron_model->check_cron_key($cron_key)):
                if($this->Cron_model->is_cron_enabled($cron_key)):
                    $config = $this->Cron_model->getConfig();
                    if($config->auto_notification_status =='1' && $config->auto_notification_schedule == '30'):
                        $this->notification($cron_key);
                    endif;
                    if($config->db_backup_status =='1' && $config->db_backup_schedule == '30'):
                        $this->dbbackup($cron_key);
                    endif;
                    echo 'Cron process finished';
                else:
                    echo 'Cron is Disabled.';
                endif;
            else:
                echo 'Cron key is invalid.';
            endif;
        else:
            echo 'Cron key must not be null or empty.';
        endif;
    }
}