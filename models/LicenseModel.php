<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LicenseModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function verify($User_name, $License_Code) {
		return array('status' => 'success', 'data' => array('username' => 'username', 'license' => '*******', 'message' => 'Verified'));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => base64_decode("aHR0cHM6Ly9vbmVieXRlc29sdXRpb24uY29tL2FwaS9kb29vL2F1dGg="),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array('username' => $User_name,'license' => $License_Code)),
        ));

        $response = curl_exec($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code == 200) {
            return array('status' => 'success', 'data' => json_decode($response));
        } else {

            $response_data = json_decode($response, true);

            if (isset($response_data['message'])) {
                return array('status' => 'error', 'message' => $response_data['message']);
            } else {
                return array('status' => 'error', 'message' => 'Username and License Code are required.');
            }
        }

    }

    function auth($User_name, $License_Code) {
            $this->db->set('license_user', $User_name);
            $this->db->set('license_code', $License_Code);
            $this->db->set('license_access_token', 'token';
            $this->db->set('license_token_type', 'type';
            $this->db->where('id', 1);
            $this->db->update('config');
            return array('status' => 'success', 'message' => "License Code verified successfully!");
    }

    function licence() {
		return array('status' => 'success', 'message' => 'Verified', 'data' => array('license_type' => 'Regular License', 'item_name' => 'Dooo'));
        $this->load->database();
        $query = $this->db->get('config');
        $config = $query->row();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => base64_decode("aHR0cHM6Ly9vbmVieXRlc29sdXRpb24uY29tL2FwaS9kb29vL2xpY2VuY2U="),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$config->license_token_type." ".$config->license_access_token
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code == 200) {
            return array('status' => 'success', 'data' => json_decode($response));
        } else {
            return array('status' => 'error', 'message' => 'Invalid License Code.');
        }

    }
}