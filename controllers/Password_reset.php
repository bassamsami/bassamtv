<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_reset extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->library('session');
        $this->load->model('Password_reset_model');
	}

    function testMail() {
        $this->Password_reset_model->testMail($_POST['mail']);
	}

    function password_reset_mail() {
        $this->Password_reset_model->password_reset_mail($_POST['mail']);
	}

    function checkCode() {
        $this->Password_reset_model->checkCode($_POST['code']);
    }

    function password_reset() {
        $this->Password_reset_model->password_reset($_POST['code'], md5($_POST['pass']));
    }

}