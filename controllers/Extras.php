<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extras extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function splash() {
		$this->load->view('extras/splash');
	}
}