<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mail_model extends CI_Model
{
    private $config;
    private $mailtype = 'html';
    private $toMail = '';
    private $subject = '';
    private $body = '';
    private $print_debugger = '';

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->config = $this->db->get('config')->row();
    }
    public function mailType($mailtype)
    {
        $this->mailtype = $mailtype;
    }
    public function toMail($toMail)
    {
        $this->toMail = $toMail;
    }

    public function subject($subject)
    {
        $this->subject = $subject;
    }
    public function body($body)
    {
        $this->body = $body;
    }
    public function print_debugger()
    {
        return $this->print_debugger;
    }

    public function send()
    {
        if ($this->toMail == '') {
            return 'please set a mail to send the message';
        } else if ($this->subject == '') {
            return 'please set a subject to send the message';
        } else if ($this->body == '') {
            return 'please set a body to send the message';
        } else {
            $mailConfig = array(
                'protocol' => 'smtp',
                'smtp_host' => $this->config->SMTP_Host,
                'smtp_port' => $this->config->SMTP_Port,
                'smtp_user' => $this->config->SMTP_Username,
                'smtp_pass' => $this->config->SMTP_Password,
                'charset' => 'iso-8859-1',
                'mailtype' => $this->mailtype,
                'wordwrap' => TRUE,
                'smtp_crypto' => ($this->config->SMTP_crypto == 'none') ? '' : $this->config->SMTP_crypto
            );

            $this->load->library('email', $mailConfig);
            $this->email->set_newline("\r\n");

            $this->email->from($this->config->SMTP_Username, '');

            $this->email->to($this->toMail);
            $this->email->subject($this->subject);
            $this->email->message($this->body);

            $this->print_debugger = $this->email->print_debugger();

            return $this->email->send();

        }
    }


}