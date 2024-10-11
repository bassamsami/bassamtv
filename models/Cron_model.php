<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    function getConfig() {
		$query = $this->db->get('config');
		return $query->row();
	}

	function is_cron_enabled() {
		$result                         =   FALSE;
        $cron_key     =   $this->db->get('config')->row()->cron_status;
        if($cron_key):
            $result     =  TRUE;
        endif;
        return $result;
	}

	function check_cron_key($user_cron_key=''){
        $result                         =   FALSE;
        $cron_key     =   $this->db->get('config')->row()->cron_key;
        if($cron_key == $user_cron_key):
            $result     =  TRUE;
        endif;
        return $result;
    }

}