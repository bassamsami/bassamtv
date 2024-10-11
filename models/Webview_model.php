<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webview_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    function getConfig() {
		$query = $this->db->get('config');
		return $query->row();
	}
}