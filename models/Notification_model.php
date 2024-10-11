<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    function getConfig() {
		$query = $this->db->get('config');
		return $query->row();
	}

    function sendNotification($Heading, $Message, $Large_Icon, $Big_Picture, $data, $user_ids='') {
        $config = $this->db->get('config')->row();
        $Onesignal_Appid = $config->onesignal_appid;
        $Onesignal_Api_Key = $config->onesignal_api_key;
        if($Onesignal_Appid==""||$Onesignal_Api_Key=="") {
            return "Onesignal credential not found!";
        }
        $curl = curl_init();
        if(empty($user_ids)) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://onesignal.com/api/v1/notifications',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "included_segments": ["All"],
                    "app_id": "'.$Onesignal_Appid.'",
                    "contents": {"en": "'.$Message.'"},
	                "headings": {"en": "'.$Heading.'"},
	                "data": '.json_encode($data).',
	                "big_picture": "'.$Big_Picture.'",
	                "large_icon": "'.$Large_Icon.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Basic $Onesignal_Api_Key",
                    "Content-Type: application/json",
                ),
            ));
        } else {
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://onesignal.com/api/v1/notifications',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "include_external_user_ids": '.json_encode($user_ids).',
            	"app_id": "'.$Onesignal_Appid.'",
                "contents": {"en": "'.$Message.'"},
	            "headings": {"en": "'.$Heading.'"},
	            "data": '.json_encode($data).',
	            "big_picture": "'.$Big_Picture.'",
	            "large_icon": "'.$Large_Icon.'"
              }',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$Onesignal_Api_Key,
                'Content-Type: application/json',
              ),
            ));
        }
        $response = curl_exec($curl); 
        curl_close($curl);
        return $response;
    }
}