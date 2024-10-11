<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/RestController.php');
use chriskacerguis\RestServer\RestController;

require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class Web_api extends RestController {
    function __construct()
    {
        parent::__construct();
        $this->load->model('RestApi/Android/Web_api_model');
    }

    
}