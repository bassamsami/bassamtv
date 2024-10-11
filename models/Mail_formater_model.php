<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mail_formater_model extends CI_Model
{
    private $config;
    function __construct()
    {
        parent::__construct();
        $this->load->model('mail_templates_model');
        $this->config = $this->db->get('config')->row();
    }

    public function format($type, $toMail, $code='', $user_name='', $active_subscription='', $Subscription_time='',
                           $Subscription_amount='', $Subscription_start='', $Subscription_expire='')
    {
        $mail_templates_model = $this->mail_templates_model->get(array('type'=>$type));
        if($mail_templates_model=="") {
            return '';
        }
        $template = $mail_templates_model->data;
        if($template=="") {
            return '';
        }
        date_default_timezone_set("Asia/Kolkata");
        $today=strtotime("now");
        $template = str_replace('{{APP_NAME}}', $this->config->name, $template);
        $template = str_replace('{{APP_LOGO}}', $this->config->logo, $template);
        $template = str_replace('{{USER_MAIL}}', $toMail, $template);
        $template = str_replace('{{CURRENT_DATE}}', date("Y-m-d", $today), $template);
        $template = str_replace('{{CURRENT_TIME}}', date("h:i:s", $today), $template);
        $template = str_replace('{{CURRENT_DATE_TIME}}', date("Y-m-d h:i:s", $today), $template);
        $template = str_replace('{{CURRENT_YEAR}}', date("Y", $today), $template);
        if($code!='') {
            $template = str_replace('{{VERIFICATION_CODE}}', $code, $template);
        }
        if($user_name!='') {
            $template = str_replace('{{USER_NAME}}', $user_name, $template);
        }
        if($active_subscription!='') {
            $template = str_replace('{{SUBSCUIPTION_NAME}}', $active_subscription, $template);
        }
        if($Subscription_time!='') {
            $template = str_replace('{{SUBSCUIPTION_TIME}}', $Subscription_time, $template);
        }
        if($Subscription_amount!='') {
            $template = str_replace('{{SUBSCUIPTION_AMOUNT}}', $Subscription_amount, $template);
        }
        if($Subscription_start!='') {
            $template = str_replace('{{SUBSCUIPTION_START}}', $Subscription_start, $template);
        }
        if($Subscription_expire!='') {
            $template = str_replace('{{SUBSCUIPTION_EXPIRE}}', $Subscription_expire, $template);
        }
        return $template;
    }
}