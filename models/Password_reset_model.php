<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_reset_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
        $this->load->library('session');
	}
    function password_reset_mail($mail) {
		    $d=strtotime("now");
        $Current_DT =  date("Y-m-d h:i:s", $d);
        $Current_DT_encoded = base64_encode($Current_DT);

		    $this->db->where('email', $mail);
		    $num_rows = $this->db->get('user_db')->num_rows();

        $code = rand(1000, 9999);

		if($num_rows > 0) {
            $this->db->set('code', $code);
			  $this->db->set('token', $Current_DT_encoded);
		    $this->db->set('mail', $mail);
		    $this->db->set('type', 'Password Reset');
		    $this->db->insert('mail_token_details');
		    if($this->db->insert_id() == "") {
		    	echo "Something Went Wrong!";
		    } else {
                $this->load->model('Mail_model');
                $this->load->model('Mail_formater_model');
                $this->Mail_model->toMail($mail);
                $this->Mail_model->subject('PASSWORD RESET');
                $this->Mail_model->body($this->Mail_formater_model->format('password_reset_otp', $mail, $code));
                if($this->Mail_model->send()) {
                    echo "Message has been sent";
                } else {
                    echo "Something Went Wrong!";
                }
		    }
		} else {
			echo 'Email Not Registered';
		}

		
	}

    function checkCode($code) {
        $this->db->where('code', $code);
        $mail_token_rows = $this->db->get('mail_token_details')->num_rows();
        if($mail_token_rows > 0) {
            $this->db->where('code', $code);
            $mail_token = $this->db->get('mail_token_details')->row();
            $Tkn_Time =  base64_decode($mail_token->token);
            $d=strtotime("now");
            $Current_DT =  date("Y-m-d h:i:s", $d);
            $to_time = strtotime($Current_DT);
            $from_time = strtotime($Tkn_Time);
            $Diff = ($to_time - $from_time) / 60;
            if($Diff>5) {
                echo "Expired";
            } else {
                if($mail_token->status == 0) {
                    $this->db->set('status', 1);
                    $this->db->where('code', $code);
                    $this->db->update('mail_token_details');
    
                    $_SESSION['code'] = $mail_token->code;
                    echo "valid Code";
                } else {
                    echo 'Used Code';
                }
            }

        } else {
			echo 'Invalid Request';
		}
    }

    function password_reset($code, $pass) {
        $this->db->where('code', $code);
        $mail_token_rows = $this->db->get('mail_token_details')->num_rows();
        if($mail_token_rows > 0) {
            $this->db->where('code', $code);
            $mail_token_details = $this->db->get('mail_token_details')->row();


            $Tkn_Time =  base64_decode($mail_token_details->token);
            $d=strtotime("now");
            $Current_DT =  date("Y-m-d h:i:s", $d);
            $to_time = strtotime($Current_DT);
            $from_time = strtotime($Tkn_Time);
            $Diff = ($to_time - $from_time) / 60;

            if($Diff>5) {
                echo "Expired!";
            } else {
                $this->db->set('password', $pass);
                $this->db->where('email', $mail_token_details->mail);
                $this->db->update('user_db');
                echo 'Password Updated successfully';
            }
        } else {
			echo 'Invalid Request';
		}
    }

}