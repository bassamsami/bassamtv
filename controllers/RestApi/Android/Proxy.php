<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proxy extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function imageProxy($encoded_data) {
        $url = htmlentities(base64_decode($encoded_data));
        echo file_get_contents($url);
    }
}