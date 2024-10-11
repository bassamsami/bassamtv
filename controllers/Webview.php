<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Webview extends CI_Controller{
    function __construct()
	{
		parent::__construct();
		$this->load->model('Webview_model');
	}

    public function privacy_policy_webview() {
		$data['privacy_policy'] = $this->Webview_model->getConfig()->PrivecyPolicy;
		$this->load->view('webview/privacy_policy', $data);
	}

	public function terms_and_conditions_webview() {
		$data['TermsAndConditions'] = $this->Webview_model->getConfig()->TermsAndConditions;
		$this->load->view('webview/terms_and_conditions', $data);
	}

}