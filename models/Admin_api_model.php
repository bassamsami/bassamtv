<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_api_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function changeLanguage($lang) {
		$this->db->set('admin_panel_language', $lang);
		$this->db->where('id', 1);
		$this->db->update('config');
	}

	function genarateApiKey() {
		$length = 16;
		$newKey = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

		$this->db->set('api_key', $newKey);
        $this->db->where('id', 1);
        return $this->db->update('config');
	}

    function savePrivecyPolicy($PrivecyPolicy) {
		$this->db->set('PrivecyPolicy', $PrivecyPolicy);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function saveterms_and_conditions($terms_and_conditions) {
		$this->db->set('TermsAndConditions', $terms_and_conditions);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function updateSliderConfig($image_slider_type, $movie_image_slider_max_visible, $webseries_image_slider_max_visible) {
		$this->db->set('image_slider_type', $image_slider_type);
		$this->db->set('movie_image_slider_max_visible', $movie_image_slider_max_visible);
		$this->db->set('webseries_image_slider_max_visible', $webseries_image_slider_max_visible);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}
    
	function addMovie($TMDB_ID, $name, $description, $genres, $release_date, $runtime, $poster, $banner, $youtube_trailer, $downloadable, $type, $status, $content_networks, $custom_tag) {
		$this->db->set('TMDB_ID', $TMDB_ID);
		$this->db->set('name', $name);
		$this->db->set('description', $description);
		$this->db->set('genres', $genres);
		$this->db->set('release_date', $release_date);
		$this->db->set('runtime', $runtime);
		$this->db->set('poster', $poster);
		$this->db->set('banner', $banner);
		$this->db->set('youtube_trailer', $youtube_trailer);
		$this->db->set('downloadable', $downloadable);
		$this->db->set('type', $type);
		$this->db->set('status', $status);
		$this->db->set('content_type', 1);
		$this->db->insert('movies');

		$movies_insert_id = $this->db->insert_id();

		$content_networks = explode (",", $content_networks); 
		foreach ($content_networks as $content_network_space) {
		    $content_network = trim($content_network_space);

			$this->db->set('content_id', $movies_insert_id);
		    $this->db->set('network_id', $content_network);
		    $this->db->set('content_type', 1);
		    $this->db->insert('content_network_log');
		}


        if($custom_tag!=0) {
            $this->load->model('Custom_tag_log_model');
            if($this->Custom_tag_log_model->is_avaliable( array('content_id'=>$movies_insert_id, 'content_type'=>1) )) {
                $this->Custom_tag_log_model->update_log_by_content($custom_tag, $movies_insert_id, 1);
            } else {
                $this->Custom_tag_log_model->insert_log($custom_tag, $movies_insert_id, 1);
            }
        }

		return $movies_insert_id;
	}

	function getAllMovie() {
        $table = 'movies';
         
        $primaryKey = 'id';
        
        $columns = array(
            array( 'db' => 'id', 'dt' => 2 ),
            array( 'db' => 'poster', 'dt' => 3 ),
            array( 'db' => 'name',  'dt' => 4 ),
            array( 'db' => 'description',   'dt' => 5 ),
            array( 'db' => 'status',   'dt' => 6 )
        );
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function deleteMovie($movieID) {
		$this->db->where('movie_id', $movieID);
        $this->db->delete("movie_play_links");

		$this->db->where('movie_id', $movieID);
        $this->db->delete("movie_download_links");

        $this->load->model('Custom_tag_log_model');
        $this->Custom_tag_log_model->delete_log_by_content($movieID, 1);

		$this->db->where('id', $movieID);
        return $this->db->delete("movies");
	}

	function initiateGenres($GENRE_list) {
		$query = $this->db->get('genres');
		//$Genrelist_result = $query->result();
		$json =array();
		if($GENRE_list != "") {
        
			$genres = explode(',', $GENRE_list);
			$data_genres =array();
			foreach ($query->result() as $row)
            {
                $data_genres[] = $row;
            }
			foreach ($genres as $genre_item) {
			   $got = false;
			   $f_genre = trim($genre_item);
				foreach ($data_genres as $data_genre_item) {
					if (stripos($data_genre_item->name, $f_genre) !== false) {
						$got = true;
						$json[] = array("id"=>$data_genre_item->id, "text"=>$data_genre_item->name);
					}
				}
			   
				if($got == false) {

					$this->db->set('name', "$f_genre");
					$this->db->set('icon', '');
					$this->db->set('description', '');
					$this->db->set('featured', '0');
					$this->db->set('status', '1');
		            $this->db->insert('genres');

					$json[] = array("id"=>$this->db->insert_id(), "text"=>$f_genre);
				}
				
			}
		}
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function initiateLiveTvGenres($GENRE_list) {
		$query = $this->db->get('live_tv_genres');
		//$Genrelist_result = $query->result();
		$json =array();
		if($GENRE_list != "") {
        
			$genres = explode(',', $GENRE_list);
			$data_genres =array();
			foreach ($query->result() as $row)
            {
                $data_genres[] = $row;
            }
			foreach ($genres as $genre_item) {
			   $got = false;
			   $f_genre = trim($genre_item);
				foreach ($data_genres as $data_genre_item) {
					if (stripos($data_genre_item->name, $f_genre) !== false) {
						$got = true;
						$json[] = array("id"=>$data_genre_item->id, "text"=>$data_genre_item->name);
					}
				}
			   
				if($got == false) {

					$this->db->set('name', "$f_genre");
					$this->db->set('status', '1');
		            $this->db->insert('live_tv_genres');

					$json[] = array("id"=>$this->db->insert_id(), "text"=>$f_genre);
				}
				
			}
		}
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function updateMovie($movieID, $name, $description, $genres, $release_date, $runtime, $poster, $banner, $youtube_trailer, $downloadable, $type, $status, $content_networks, $custom_tag) {
		$this->db->set('name', $name);
		$this->db->set('description', $description);
		$this->db->set('genres', $genres);
		$this->db->set('release_date', $release_date);
		$this->db->set('runtime', $runtime);
		$this->db->set('poster', $poster);
		$this->db->set('banner', $banner);
		$this->db->set('youtube_trailer', $youtube_trailer);
		$this->db->set('downloadable', $downloadable);
		$this->db->set('type', $type);
		$this->db->set('status', $status);
		$this->db->where('id', $movieID);
		$update_status = $this->db->update('movies');

		$this->db->where('content_id', $movieID);
		$this->db->where('content_type', 1);
		$this->db->delete("content_network_log");

		$content_networks = explode (",", $content_networks); 
		foreach ($content_networks as $content_network_space) {
		    $content_network = trim($content_network_space);

			$this->db->set('content_id', $movieID);
		    $this->db->set('network_id', $content_network);
		    $this->db->set('content_type', 1);
		    $this->db->insert('content_network_log');
		}

        if($custom_tag!=0) {
            $this->load->model('Custom_tag_log_model');
            if($this->Custom_tag_log_model->is_avaliable( array('content_id'=>$movieID, 'content_type'=>1) )) {
                $this->Custom_tag_log_model->update_log_by_content($custom_tag, $movieID, 1);
            } else {
                $this->Custom_tag_log_model->insert_log($custom_tag, $movieID, 1);
            }
        } else {
            $this->load->model('Custom_tag_log_model');
            $this->Custom_tag_log_model->delete_log_by_content($movieID, 1);
        }

		return $update_status;
	}

	function getNotificationContentList($search, $type) {
		if($type == "movie") {
			$json =array();
			$this->db->order_by('id', 'DESC');
		    $query = $this->db->get('movies');
		    foreach($query->result() as $Data) {
				if (stripos($Data->name, $search) !== false) {
					$json[] = array("id"=>$Data->id, "text"=>$Data->name);
				}
			}
			return $json;
		} else if($type== "web_series") {
			$json =array();
			$this->db->order_by('id', 'DESC');
		    $query = $this->db->get('web_series');
		    foreach($query->result() as $Data) {
				if (stripos($Data->name, $search) !== false) {
					$json[] = array("id"=>$Data->id, "text"=>$Data->name);
				}
			}
			return $json;
		}
	}

	function getMovieByID($ID) {
		$this->db->where('id', $ID);
		$query = $this->db->get('movies');
		return $query->row();
	}

	function getWebSeriesByID($ID) {
		$this->db->where('id', $ID);
		$query = $this->db->get('web_series');
		return $query->row();
	}

	function add_cs($add_cs_content_id, $add_slider_type, $add_cs_Title, $add_cs_Banner, $add_cs_URL, $add_cs_Status) {
		$this->db->set('title', $add_cs_Title);
		$this->db->set('banner', $add_cs_Banner);
		$this->db->set('content_type', $add_slider_type);
		$this->db->set('content_id', $add_cs_content_id);
		$this->db->set('url', $add_cs_URL);
		$this->db->set('status', $add_cs_Status);
		$this->db->insert('image_slider');
		return $this->db->insert_id();
	}

	function delete_cs($ID) {
		$this->db->where('id', $ID);
		return $this->db->delete("image_slider");
	}

	function get_cs_details($ID) {
		$this->db->where('id', $ID);
		$query = $this->db->get('image_slider');
		return $query->row();
	}

	function edit_cs($Edit_cs_id, $Edit_cs_content_id, $Edit_slider_type, $Edit_cs_Title, $Edit_cs_Banner, $Edit_cs_URL, $Edit_cs_Status) {
		$this->db->set('title', $Edit_cs_Title);
		$this->db->set('banner', $Edit_cs_Banner);
		$this->db->set('content_type', $Edit_slider_type);
		$this->db->set('content_id', $Edit_cs_content_id);
		$this->db->set('url', $Edit_cs_URL);
		$this->db->set('status', $Edit_cs_Status);
		$this->db->where('id', $Edit_cs_id);
		return $this->db->update('image_slider');
	}

	function get_all_report() {
        $table = 'report';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'user_id', 'dt' => 3, 'formatter' => function( $d, $row ) {
				return $this->get_user_Details($d)->name;
			}),
			array( 'db' => 'user_id', 'dt' => 4, 'formatter' => function( $d, $row ) {
				return $this->get_user_Details($d)->email;
			}),
			array( 'db' => 'title',  'dt' => 5 ),
			array( 'db' => 'description',   'dt' => 6 ),
			array( 'db' => 'report_type',   'dt' => 7 ),
			array( 'db' => 'status',   'dt' => 8 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function delete_report($report_id) {
		$this->db->where('id', $report_id);
        return $this->db->delete('report');
	}

	function update_report_status($notify, $report_id, $status) {
		$this->db->set('status', $status);
		$this->db->where('id', $report_id);
		$this->db->update('report');

		$typeArray = array(
			"0" => "Custom",
			"1" => "Movie",
			"2" => "Web Series",
			"3" => "Live TV	"
		);
		$statusArray = array(
			"0" => "Pending",
			"1" => "Solved",
			"2" => "Canceled"
		);

		$this->db->where('id', $report_id);
		$report = $this->db->get('report')->row();
		if($report->status == $status) {
			if($notify) {
				$this->load->model('Notification_model');
				$this->Notification_model->sendNotification($typeArray[$report->report_type]." Report ".$statusArray[$report->status], "Report: $report->title",
				"", "", array("Type" => "Announcement"), array($report->user_id));
			}
			return true;
		}
		return false;
	}

	function get_all_request() {
        $table = 'request';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'user_id', 'dt' => 3, 'formatter' => function( $d, $row ) {
				return $this->get_user_Details($d)->name;
			}),
			array( 'db' => 'user_id', 'dt' => 4, 'formatter' => function( $d, $row ) {
				return $this->get_user_Details($d)->email;
			}),
			array( 'db' => 'title',  'dt' => 5 ),
			array( 'db' => 'description',   'dt' => 6 ),
			array( 'db' => 'type',   'dt' => 7 ),
			array( 'db' => 'status',   'dt' => 8 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function delete_request($request_id) {
		$this->db->where('id', $request_id);
        return $this->db->delete('request');
	}

	function update_request_status($notify, $request_id, $status) {
		$this->db->set('status', $status);
		$this->db->where('id', $request_id);
		$this->db->update('request');
		
		
	    $typeArray = array(
	    	"0" => "Custom",
	    	"1" => "Movie",
	    	"2" => "Web Series",
	    	"3" => "Live TV	"
	    );
	    $statusArray = array(
	    	"0" => "Pending",
	    	"1" => "Accepted",
	    	"2" => "Rejected"
	    );    
	    $this->db->where('id', $request_id);
	    $request = $this->db->get('request')->row();
	    if($request->status == $status) {
	    	if($notify) {
	    	    $this->load->model('Notification_model');
	    	    $this->Notification_model->sendNotification($typeArray[$request->type]." Request ".$statusArray[$request->status], "Request: $request->title",
	    	    "", "", array("Type" => "Announcement"), array($request->user_id));
	    	}
	    	return true;
	    }
		
		return false;
	}

	function get_all_users() {
        $table = 'user_db';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'name', 'dt' => 3 ),
			array( 'db' => 'email',  'dt' => 4 ),
			array( 'db' => 'role',   'dt' => 5 ),
			array( 'db' => 'active_subscription',   'dt' => 6 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function add_user($UserName, $UserEmail, $UserPassword) {
		$this->db->where('email', $UserEmail);
		$this->db->from("user_db");
		$totalUser = $this->db->count_all_results();
		if($totalUser != 0) {
			echo "Email Already Regestered";
		} else {
			$this->db->set('name', $UserName);
			$this->db->set('email', $UserEmail);
			$this->db->set('password', $UserPassword);
			$this->db->set('active_subscription', 'Free');
			$this->db->set('subscription_start', '0000-00-00');
			$this->db->set('subscription_exp', '0000-00-00');
			$this->db->insert('user_db');
			if($this->db->insert_id() == "") {
				echo "Something Went Wrong";
			} else {
				echo "User Added successfully";
			}
		}
	}

	function delete_user($user_id) {
		$this->db->where('id', $user_id);
        return $this->db->delete('user_db');
	}

	function get_user_Details($userID) {
		$this->db->where('id', $userID);
		$query = $this->db->get('user_db');
		return $query->row();
	}

	function update_user_data($userID, $Edit_modal_User_Name, $Edit_modal_Email) {
		$this->db->where('email', $Edit_modal_Email);
		$this->db->from("user_db");
		$totalUser = $this->db->count_all_results();
		if($totalUser != 0) {
			$this->db->where('id', $userID);
			$query = $this->db->get('user_db');
		    foreach($query->result() as $Data) {

				if($Data->email == $Edit_modal_Email) {
					$this->db->where('id', $userID);
					$this->db->set('name', $Edit_modal_User_Name);
					if($this->db->update('user_db')) {
						echo "User Updated successfully";
					} else {
						echo "Something Went Wrong";
					}
				} else {
					echo "Email Already Regestered";
				}
			}
		} else {
			$this->db->where('id', $userID);
			$this->db->set('name', $Edit_modal_User_Name);
			$this->db->set('email', $Edit_modal_Email);
			if($this->db->update('user_db')) {
				echo "User Updated successfully";
			} else {
				echo "Something Went Wrong";
			}
		}
	}

	function save_telegram_data($telegram_bot_token, $teligram_chat_id) {
		$this->db->set('telegram_token', $telegram_bot_token);
		$this->db->set('telegram_chat_id', $teligram_chat_id);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function getRedirectedUrl($url) {
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if (preg_match('~Location: (.*)~i', $result, $match)) {
           return trim($match[1]);
        } else {
			return "";
		}
	}

	function sendMessage($chatID, $token, $Telegrammessage, $image) {
		$image = $this->getRedirectedUrl($image);
		if($image!="") {
			$url = "https://api.telegram.org/bot" . $token . "/sendPhoto?chat_id=" . $chatID . "&disable_web_page_preview=false&parse_mode=HTML";
		    $url = $url . "&photo=" . $image;
			$url = $url . "&caption=" . urlencode($Telegrammessage);
		} else {
			$url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID . "&disable_web_page_preview=false&parse_mode=HTML";
		    $url = $url . "&text=" . urlencode($Telegrammessage);
		}
		
		$ch = curl_init();
		$optArray = array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $optArray);
		$result = curl_exec($ch);
		curl_close($ch);
		return "Message Sended SuccessFully!";
	}

	function teligram($telegram_token, $telegram_chat_id, $Heading, $Message, $image) {
		$Telegrammessage = "<strong> $Heading </strong>
		<code>$Message</code>";
		echo $this->sendMessage($telegram_chat_id, $telegram_token, $Telegrammessage, $image);
	}

	function update_sub_setting($razorpay_status_int, $razorpay_key_id, $razorpay_key_secret, $paypal_status_int, $paypal_payment_type, 
	                                $paypal_clint_id, $paypal_secret_key, $flutterwave_status, $flutterwave_public_key, 
									$flutterwave_secret_key, $flutterwave_encryption_key, $uddoktapay_status, $uddoktapay_api_key, $uddoktapay_base_url,
									$bKash_status, $bKash_app_key, $bKash_app_secret, $bKash_username, $bKash_password, $bKash_payment_type) {
		$this->db->set('razorpay_status', $razorpay_status_int);
		$this->db->set('razorpay_key_id', $razorpay_key_id);
		$this->db->set('razorpay_key_secret', $razorpay_key_secret);
		$this->db->set('paypal_status', $paypal_status_int);
		$this->db->set('paypal_type', $paypal_payment_type);
		$this->db->set('paypal_clint_id', $paypal_clint_id);
		$this->db->set('paypal_secret_key', $paypal_secret_key);
		$this->db->set('flutterwave_status', $flutterwave_status);
		$this->db->set('flutterwave_public_key', $flutterwave_public_key);
		$this->db->set('flutterwave_secret_key', $flutterwave_secret_key);
		$this->db->set('flutterwave_encryption_key', $flutterwave_encryption_key);
		$this->db->set('uddoktapay_status', $uddoktapay_status);
		$this->db->set('uddoktapay_api_key', $uddoktapay_api_key);
		$this->db->set('uddoktapay_base_url', $uddoktapay_base_url);
		$this->db->set('bKash_status', $bKash_status);
		$this->db->set('bKash_app_key', $bKash_app_key);
		$this->db->set('bKash_app_secret', $bKash_app_secret);
		$this->db->set('bKash_username', $bKash_username);
		$this->db->set('bKash_password', $bKash_password);
		$this->db->set('bKash_payment_type', $bKash_payment_type);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function get_all_genres() {
		$table = 'genres';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 1 ),
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'icon', 'dt' => 3 ),
			array( 'db' => 'name',  'dt' => 4 ),
			array( 'db' => 'description',   'dt' => 5 ),
			array( 'db' => 'featured',   'dt' => 6 ),
			array( 'db' => 'status',   'dt' => 7 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function delete_genre($genreID) {
		$this->db->where('id', $genreID);
        return $this->db->delete('genres');
	}

	function delete_live_tv_genre($genreID) {
		$this->db->where('id', $genreID);
        return $this->db->delete('live_tv_genres');
	}

	function add_genre($modal_Genre_Name, $modal_Genre_Icon, $modal_Genre_Description, $Genre_Featured, $Genre_Status) {
		$this->db->set('name', $modal_Genre_Name);
		$this->db->set('icon', $modal_Genre_Icon);
		$this->db->set('description', $modal_Genre_Description);
		$this->db->set('featured', $Genre_Featured);
		$this->db->set('status', $Genre_Status);
		$this->db->insert('genres');
		return $this->db->insert_id();
	}

	function add_live_tv_genre($modal_Genre_Name, $Genre_Status) {
		$this->db->set('name', $modal_Genre_Name);
		$this->db->set('status', $Genre_Status);
		$this->db->insert('live_tv_genres');
		return $this->db->insert_id();
	}

	function get_genre_details($genreID) {
		$this->db->where('id', $genreID);
		$query = $this->db->get('genres');
		return json_encode($query->row());
	}

	function get_Live_tv_genre_details($genreID) {
		$this->db->where('id', $genreID);
		$query = $this->db->get('live_tv_genres');
		return json_encode($query->row());
	}

	function update_genre_details($Edit_modal_Genre_id, $Edit_modal_Genre_Name, $Edit_modal_Genre_Icon, $Edit_modal_Genre_Description, $Edit_Genre_Featured, $Edit_Genre_Status) {
		$this->db->set('name', $Edit_modal_Genre_Name);
		$this->db->set('icon', $Edit_modal_Genre_Icon);
		$this->db->set('description', $Edit_modal_Genre_Description);
		$this->db->set('featured', $Edit_Genre_Featured);
		$this->db->set('status', $Edit_Genre_Status);
		$this->db->where('id', $Edit_modal_Genre_id);
		return $this->db->update('genres');
	}

	function update_live_tv_genre_details($Edit_modal_Genre_id, $Edit_modal_Genre_Name, $Edit_Genre_Status) {
		$this->db->set('name', $Edit_modal_Genre_Name);
		$this->db->set('status', $Edit_Genre_Status);
		$this->db->where('id', $Edit_modal_Genre_id);
		return $this->db->update('live_tv_genres');
	}

	function get_all_subscriptions() {
		$table = 'subscription';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 1 ),
			array( 'db' => 'name', 'dt' => 2 ),
			array( 'db' => 'time',  'dt' => 3 ),
			array( 'db' => 'amount',   'dt' => 4 ),
			array( 'db' => 'currency',   'dt' => 5 ),
			array( 'db' => 'background',   'dt' => 6 ),
			array( 'db' => 'subscription_type',   'dt' => 7 ),
			array( 'db' => 'status',   'dt' => 8 ),
			array( 'db' => 'id', 'dt' => 9 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function create_sub_plan($modal_plan_name, $modal_time, $modal_ammount, $modal_currency, $modal_bg_image_url, $f_Subscription_Type, $Publish_toggle_int) {
		$this->db->set('name', $modal_plan_name);
		$this->db->set('time', $modal_time);
		$this->db->set('amount', $modal_ammount);
		$this->db->set('currency', $modal_currency);
		$this->db->set('background', $modal_bg_image_url);
		$this->db->set('subscription_type', $f_Subscription_Type);
		$this->db->set('status', $Publish_toggle_int);
		$this->db->insert('subscription');
		return $this->db->insert_id();
	}

	function delete_sub_plan($subscriptionID) {
		$this->db->where('id', $subscriptionID);
        return $this->db->delete('subscription');
	}

	function get_all_coupons() {
		$table = 'coupon';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'name', 'dt' => 3 ),
			array( 'db' => 'coupon_code',  'dt' => 4 ),
			array( 'db' => 'time',   'dt' => 5 ),
			array( 'db' => 'amount',   'dt' => 6 ),
			array( 'db' => 'subscription_type',  'dt' => 7 ),
			array( 'db' => 'max_use',   'dt' => 8 ),
			array( 'db' => 'used',   'dt' => 9 ),
			array( 'db' => 'used_by',   'dt' => 10 ),
			array( 'db' => 'expire_date',   'dt' => 11 ),
			array( 'db' => 'status',   'dt' => 12 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function get_coupon_details($couponID) {
		$this->db->where('id', $couponID);
		$query = $this->db->get('coupon');
		return $query->row();
	}

	function create_coupon($Name, $Coupon_Code, $Time, $Amount, $Max_Use, $Status_Count, $f_Subscription_Type, $add_expire_date) {
		$this->db->set('name', $Name);
		$this->db->set('coupon_code', $Coupon_Code);
		$this->db->set('time', $Time);
		$this->db->set('amount', $Amount);
		$this->db->set('subscription_type', $f_Subscription_Type);
		$this->db->set('status', $Status_Count);
		$this->db->set('max_use', $Max_Use);
		$this->db->set('used', '0');
		$this->db->set('used_by', '');
		$this->db->set('expire_date', $add_expire_date);
		$this->db->insert('coupon');
		return $this->db->insert_id();
	}

	function delete_coupon($couponID) {
		$this->db->where('id', $couponID);
        return $this->db->delete('coupon');
	}

	function update_coupon_details($Edit_ID, $Edit_Name,$Edit_Coupon_Code, $Edit_Time, $Edit_Amount, $Edit_Max_Use, $Edit_Status_Count, $f_Edit_Subscription_Type, $expire_date) {
		$this->db->set('name', $Edit_Name);
		$this->db->set('coupon_code', $Edit_Coupon_Code);
		$this->db->set('time', $Edit_Time);
		$this->db->set('amount', $Edit_Amount);
		$this->db->set('subscription_type', $f_Edit_Subscription_Type);
		$this->db->set('status', $Edit_Status_Count);
		$this->db->set('max_use', $Edit_Max_Use);
		$this->db->set('expire_date', $expire_date);
		$this->db->where('id', $Edit_ID);
		return $this->db->update('coupon');
	}

	function save_onesignal_data($Onesignal_Api_Key, $Onesignal_Appid) {
		$this->db->set('onesignal_api_key', $Onesignal_Api_Key);
		$this->db->set('onesignal_appid', $Onesignal_Appid);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function add_movie_links($Movie_id, $Label, $Order, $Quality, $Size, $Source, $Url, $Status, $skip_available_Count, $intro_start, $intro_end, $link_type, $end_credits_marker, $drm_uuid, $drm_license_uri) {
		$this->db->set('name', $Label);
		$this->db->set('size', $Size);
		$this->db->set('quality', $Quality);
		$this->db->set('link_order', $Order);
		$this->db->set('movie_id', $Movie_id);
		$this->db->set('url', $Url);
		$this->db->set('type', $Source);
		$this->db->set('status', $Status);
		$this->db->set('skip_available', $skip_available_Count);
		$this->db->set('intro_start', $intro_start);
		$this->db->set('intro_end', $intro_end);
		$this->db->set('end_credits_marker', $end_credits_marker);
		$this->db->set('link_type', $link_type);
		$this->db->set('drm_uuid', $drm_uuid);
		$this->db->set('drm_license_uri', $drm_license_uri);
		$this->db->insert('movie_play_links');
		return $this->db->insert_id();
	}

    function add_episodes_stream_links($episode_id, $Label, $Order, $Quality, $Size, $Source, $Url, $Status, $skip_available_Count, $intro_start, $intro_end, $link_type, $end_credits_marker, $drm_uuid, $drm_license_uri) {
        $this->db->set('name', $Label);
        $this->db->set('size', $Size);
        $this->db->set('quality', $Quality);
        $this->db->set('link_order', $Order);
        $this->db->set('episode_id', $episode_id);
        $this->db->set('url', $Url);
        $this->db->set('type', $Source);
        $this->db->set('status', $Status);
        $this->db->set('skip_available', $skip_available_Count);
        $this->db->set('intro_start', $intro_start);
        $this->db->set('intro_end', $intro_end);
        $this->db->set('end_credits_marker', $end_credits_marker);
        $this->db->set('link_type', $link_type);
        $this->db->set('drm_uuid', $drm_uuid);
        $this->db->set('drm_license_uri', $drm_license_uri);
        $this->db->insert('episode_play_links');
        return $this->db->insert_id();
    }

	function get_movie_link_details($movie_play_link_ID) {
		$this->db->where('id', $movie_play_link_ID);
		$query = $this->db->get('movie_play_links');
		return $query->row();
	}

    function get_episode_link_details($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('episode_play_links');
        return $query->row();
    }

	function update_movie_link_data($ID, $Label, $Order, $Quality, $Size, $Source, $Url, $Status, $link_type, $modal_skip_available_Count, $modal_intro_start, $modal_intro_end, $end_credits_marker, $drm_uuid_modal, $drm_license_uri_modal) {
		$this->db->set('name', $Label);
		$this->db->set('size', $Size);
		$this->db->set('quality', $Quality);
		$this->db->set('link_order', $Order);
		$this->db->set('url', $Url);
		$this->db->set('type', $Source);
		$this->db->set('status', $Status);
		$this->db->set('skip_available', $modal_skip_available_Count);
		$this->db->set('intro_start', $modal_intro_start);
		$this->db->set('intro_end', $modal_intro_end);
		$this->db->set('end_credits_marker', $end_credits_marker);
		$this->db->set('link_type', $link_type);
		$this->db->set('drm_uuid', $drm_uuid_modal);
		$this->db->set('drm_license_uri', $drm_license_uri_modal);
		$this->db->where('id', $ID);
		return $this->db->update('movie_play_links');
	}

    function update_episode_stream_link_data($ID, $Label, $Order, $Quality, $Size, $Source, $Url, $Status, $link_type, $modal_skip_available_Count, $modal_intro_start, $modal_intro_end, $end_credits_marker, $drm_uuid_modal, $drm_license_uri_modal) {
        $this->db->set('name', $Label);
        $this->db->set('size', $Size);
        $this->db->set('quality', $Quality);
        $this->db->set('link_order', $Order);
        $this->db->set('url', $Url);
        $this->db->set('type', $Source);
        $this->db->set('status', $Status);
        $this->db->set('skip_available', $modal_skip_available_Count);
        $this->db->set('intro_start', $modal_intro_start);
        $this->db->set('intro_end', $modal_intro_end);
        $this->db->set('end_credits_marker', $end_credits_marker);
        $this->db->set('link_type', $link_type);
        $this->db->set('drm_uuid', $drm_uuid_modal);
        $this->db->set('drm_license_uri', $drm_license_uri_modal);
        $this->db->where('id', $ID);
        return $this->db->update('episode_play_links');
    }

	function delete_movie_link_api($movie_play_link_ID) {
		$this->db->where('id', $movie_play_link_ID);
        return $this->db->delete('movie_play_links');
	}

    function delete_episode_stream_link_api($episode_stream_link_ID) {
        $this->db->where('id', $episode_stream_link_ID);
        return $this->db->delete('episode_play_links');
    }

	function add_subtitle($content_id, $content_type, $modal_add_Language, $modal_add_Subtitle_url, $modal_add_Mimetype, $Status_int) {
		$this->db->set('content_id', $content_id);
		$this->db->set('content_type', $content_type);
		$this->db->set('language', $modal_add_Language);
		$this->db->set('subtitle_url', $modal_add_Subtitle_url);
		$this->db->set('mime_type', $modal_add_Mimetype);
		$this->db->set('status', $Status_int);
		$this->db->insert('subtitles');
		return $this->db->insert_id();
	}

	function get_subtitle_details($subtitleID) {
		$this->db->where('id', $subtitleID);
		$query = $this->db->get('subtitles');
		return $query->row();
	}

	function update_subtitle($edit_subtitle_id, $modal_edit_Language, $edit_subtitle_url, $modal_edit_mimetype, $Status) {
		$this->db->set('language', $modal_edit_Language);
		$this->db->set('subtitle_url', $edit_subtitle_url);
		$this->db->set('mime_type', $modal_edit_mimetype);
		$this->db->set('status', $Status);
		$this->db->where('id', $edit_subtitle_id);
		return $this->db->update('subtitles');
	}

	function delete_subtitle($subtitleID) {
		$this->db->where('id', $subtitleID);
        return $this->db->delete('subtitles');
	}

	function add_movie_download_links($Movie_id, $Label, $Order, $Quality, $Size, $Source, $Url, $download_type, $Status) {
		$this->db->set('name', $Label);
		$this->db->set('size', $Size);
		$this->db->set('quality', $Quality);
		$this->db->set('link_order', $Order);
		$this->db->set('movie_id', $Movie_id);
		$this->db->set('url', $Url);
		$this->db->set('type', $Source);
		$this->db->set('download_type', $download_type);
		$this->db->set('status', $Status);
		$this->db->insert('movie_download_links');
		return $this->db->insert_id();
	}

	function get_movie_download_link_details($movie_download_link_id) {
		$this->db->where('id', $movie_download_link_id);
		$query = $this->db->get('movie_download_links');
		return $query->row();
	}

	function update_movie_download_link_data($ID, $Label, $Order, $Quality, $Size, $Source, $Url, $Status, $download_type) {
		$this->db->set('name', $Label);
		$this->db->set('size', $Size);
		$this->db->set('quality', $Quality);
		$this->db->set('link_order', $Order);
		$this->db->set('url', $Url);
		$this->db->set('type', $Source);
		$this->db->set('download_type', $download_type);
		$this->db->set('status', $Status);
		$this->db->where('id', $ID);
		return $this->db->update('movie_download_links');
	}

	function delete_download_link($movie_download_link_ID) {
		$this->db->where('id', $movie_download_link_ID);
        return $this->db->delete('movie_download_links');
	}

	function getUserData($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user_db');
		return $query->row();
	}

	function update_self_data($userID, $Edit_modal_User_Name, $Edit_modal_Email, $Edit_modal_Password) {
		$this->db->where('id', $userID);
		$query = $this->db->get('user_db');
		$UserData = $query->row();

		$this->db->where('email', $Edit_modal_Email);
		$query = $this->db->get('user_db');
		$totalUser = $this->db->count_all_results();

		if($totalUser == 1) {
			if($Edit_modal_Password == $UserData->password) {
				$this->db->set('name', $Edit_modal_User_Name);
				$this->db->set('email', $Edit_modal_Email);
				$this->db->where('id', $userID);
				$this->db->update('user_db');
				echo "User Updated successfully";
			} else {
				$this->db->set('name', $Edit_modal_User_Name);
				$this->db->set('email', $Edit_modal_Email);
				$this->db->set('password', md5($Edit_modal_Password));
				$this->db->where('id', $userID);
				$this->db->update('user_db');
				echo "User Updated successfully";
			}
		}else {
			echo "Email Already Regestered";
		}

		
	}

	function get_all_channel() {
		$table = 'live_tv_channels';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'name', 'dt' => 4 ),
			array( 'db' => 'banner',  'dt' => 3 ),
			array( 'db' => 'stream_type',   'dt' => 5 ),
			array( 'db' => 'url',     'dt' => 6 ),
			array( 'db' => 'status',     'dt' => 7 ),
			array( 'db' => 'featured',     'dt' => 8 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function get_all_webseries() {
		$table = 'web_series';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'poster', 'dt' => 3 ),
			array( 'db' => 'name',  'dt' => 4 ),
			array( 'db' => 'description',   'dt' => 5 ),
			array( 'db' => 'status',   'dt' => 6 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function add_channel($name, $banner, $stream_type, $url, $genres, $status, $featured, $type, $user_agent, $referer, $cookie, $headers, $drm_uuid, $drm_license_uri) {
		$this->db->set('name', $name);
		$this->db->set('banner', $banner);
		$this->db->set('stream_type', $stream_type);
		$this->db->set('url', $url);
		$this->db->set('genres', $genres);
		$this->db->set('status', $status);
		$this->db->set('featured', $featured);
		$this->db->set('type', $type);
		$this->db->set('user_agent', $user_agent);
		$this->db->set('referer', $referer);
		$this->db->set('cookie', $cookie);
		$this->db->set('headers', $headers);
		$this->db->set('drm_uuid', $drm_uuid);
		$this->db->set('drm_license_uri', $drm_license_uri);
		$this->db->insert('live_tv_channels');
		return $this->db->insert_id();
	}

	function delete_channel($channelID) {
		$this->db->where('id', $channelID);
        return $this->db->delete('live_tv_channels');
	} 

	function update_channel_data($channelID, $name, $stream_type, $url, $type, $banner, $genres, $featured, $status, $user_agent, $referer, $cookie, $headers, $drm_uuid, $drm_license_uri) {
		$this->db->set('name', $name);
		$this->db->set('stream_type', $stream_type);
		$this->db->set('url', $url);
		$this->db->set('type', $type);
		$this->db->set('banner', $banner);
		$this->db->set('genres', $genres);
		$this->db->set('featured', $featured);
		$this->db->set('status', $status);
		$this->db->set('user_agent', $user_agent);
		$this->db->set('referer', $referer);
		$this->db->set('cookie', $cookie);
		$this->db->set('headers', $headers);
		$this->db->set('drm_uuid', $drm_uuid);
		$this->db->set('drm_license_uri', $drm_license_uri);
		$this->db->where('id', $channelID);
		return $this->db->update('live_tv_channels');
	}

	function add_web_series($TMDB_ID, $Name, $Description, $genres, $release_date, $poster, $banner, $youtube_trailer, $downloadable, $type, $status, $content_networks, $custom_tag) {
		$this->db->set('TMDB_ID', $TMDB_ID);
		$this->db->set('name', $Name);
		$this->db->set('description', $Description);
		$this->db->set('genres', $genres);
		$this->db->set('release_date', $release_date);
		$this->db->set('poster', $poster);
		$this->db->set('banner', $banner);
		$this->db->set('youtube_trailer', $youtube_trailer);
		$this->db->set('downloadable', $downloadable);
		$this->db->set('type', $type);
		$this->db->set('status', $status);
		$this->db->insert('web_series');

		$series_insert_id = $this->db->insert_id();

		$content_networks = explode (",", $content_networks); 
		foreach ($content_networks as $content_network_space) {
		    $content_network = trim($content_network_space);

			$this->db->set('content_id', $series_insert_id);
		    $this->db->set('network_id', $content_network);
		    $this->db->set('content_type', 2);
		    $this->db->insert('content_network_log');
		}

        if($custom_tag!=0) {
            $this->load->model('Custom_tag_log_model');
            if($this->Custom_tag_log_model->is_avaliable( array('content_id'=>$series_insert_id, 'content_type'=>2) )) {
                $this->Custom_tag_log_model->update_log_by_content($custom_tag, $series_insert_id, 2);
            } else {
                $this->Custom_tag_log_model->insert_log($custom_tag, $series_insert_id, 2);
            }
        }

		return $series_insert_id;
	}

	function delete_web_series($WebSeriesID) {
		$this->db->where('web_series_id', $WebSeriesID);
		$web_series_seasons = $this->db->get('web_series_seasons');
		foreach($web_series_seasons->result() as $web_series_season) {

			$this->db->where('season_id', $web_series_season->id);
			$web_series_episoades = $this->db->get('web_series_episoade');
			foreach($web_series_episoades->result() as $web_series_episoade) {
				$this->db->where('episode_id', $web_series_episoade->id);
				$this->db->delete('episode_download_links');
			}

			$this->db->where('season_id', $web_series_season->id);
			$this->db->delete('web_series_episoade');
		}

		$this->db->where('web_series_id', $WebSeriesID);
		$this->db->delete('web_series_seasons');

        $this->load->model('Custom_tag_log_model');
        $this->Custom_tag_log_model->delete_log_by_content($WebSeriesID, 2);

		$this->db->where('id', $WebSeriesID);
        return $this->db->delete('web_series');
	}

	function Update_web_series($WebSeriesID, $Name, $Description, $genres, $release_date, $poster, $banner, $youtube_trailer, $downloadable, $type, $status, $content_networks, $custom_tag) {
		$this->db->set('name', $Name);
		$this->db->set('description', $Description);
		$this->db->set('genres', $genres);
		$this->db->set('release_date', $release_date);
		$this->db->set('poster', $poster);
		$this->db->set('banner', $banner);
		$this->db->set('youtube_trailer', $youtube_trailer);
		$this->db->set('downloadable', $downloadable);
		$this->db->set('type', $type);
		$this->db->set('status', $status);
		$this->db->where('id', $WebSeriesID);
		$update_status = $this->db->update('web_series');

		$this->db->where('content_id', $WebSeriesID);
		$this->db->where('content_type', 2);
		$this->db->delete("content_network_log");

		$content_networks = explode (",", $content_networks); 
		foreach ($content_networks as $content_network_space) {
		    $content_network = trim($content_network_space);

			$this->db->set('content_id', $WebSeriesID);
		    $this->db->set('network_id', $content_network);
		    $this->db->set('content_type', 2);
		    $this->db->insert('content_network_log');
		}

        if($custom_tag!=0) {
            $this->load->model('Custom_tag_log_model');
            if($this->Custom_tag_log_model->is_avaliable( array('content_id'=>$WebSeriesID, 'content_type'=>2) )) {
                $this->Custom_tag_log_model->update_log_by_content($custom_tag, $WebSeriesID, 2);
            } else {
                $this->Custom_tag_log_model->insert_log($custom_tag, $WebSeriesID, 2);
            }
        } else {
            $this->load->model('Custom_tag_log_model');
            $this->Custom_tag_log_model->delete_log_by_content($WebSeriesID, 2);
        }

		return $update_status;
	}

	function add_season($webseries_id, $modal_Season_Name, $modal_Order, $Modal_Status) {
		$this->db->set('Session_Name', $modal_Season_Name);
		$this->db->set('season_order', $modal_Order);
		$this->db->set('web_series_id', $webseries_id);
		$this->db->set('status', $Modal_Status);
		$this->db->insert('web_series_seasons');
		return $this->db->insert_id();
	}

	function delete_season($WebSeriesID) {
		$this->db->where('season_id', $WebSeriesID);
		$web_series_episoades = $this->db->get('web_series_episoade');
		foreach($web_series_episoades->result() as $web_series_episoade) {
			$this->db->where('episode_id', $web_series_episoade->id);
			$this->db->delete('episode_download_links');
		}

		$this->db->where('season_id', $WebSeriesID);
        $this->db->delete('web_series_episoade');

		$this->db->where('id', $WebSeriesID);
        return $this->db->delete('web_series_seasons');
	}

	function getSeasonData($seasonID) {
		$this->db->where('id', $seasonID);
		$query = $this->db->get('web_series_seasons');
		return $query->row();
	}

	function update_season($modal_season_id, $edit_modal_Season_Name, $edit_modal_Order, $Modal_Status) {
		$this->db->set('Session_Name', $edit_modal_Season_Name);
		$this->db->set('season_order', $edit_modal_Order);
		$this->db->set('status', $Modal_Status);
		$this->db->where('id', $modal_season_id);
		return $this->db->update('web_series_seasons');
	}

	function add_episode($season_id, $modal_Episodes_Name, $modal_Thumbnail, $modal_Order, $modal_Source, $modal_Url, $modal_Description,
	        $Downloadable, $Type, $Status, $add_modal_skip_available_Count, $add_modal_intro_start, $add_modal_intro_end, $end_credits_marker,
			    $drm_uuid_addModal, $drm_license_uri_addModal) {
		$this->db->set('Episoade_Name', $modal_Episodes_Name);
		$this->db->set('episoade_image', $modal_Thumbnail);
		$this->db->set('episoade_description', $modal_Description);
		$this->db->set('episoade_order', $modal_Order);
		$this->db->set('season_id', $season_id);
		$this->db->set('downloadable', $Downloadable);
		$this->db->set('type', $Type);
		$this->db->set('status', $Status);
		$this->db->set('source', $modal_Source);
		$this->db->set('url', $modal_Url);
		$this->db->set('skip_available', $add_modal_skip_available_Count);
		$this->db->set('intro_start', $add_modal_intro_start);
		$this->db->set('intro_end', $add_modal_intro_end);
		$this->db->set('end_credits_marker', $end_credits_marker);
		$this->db->set('drm_uuid', $drm_uuid_addModal);
		$this->db->set('drm_license_uri', $drm_license_uri_addModal);
		$this->db->insert('web_series_episoade');
		return $this->db->insert_id();
	}

	function delete_episode($episoadID) {
		$this->db->where('episode_id', $episoadID);
		$this->db->delete('episode_download_links');

		$this->db->where('id', $episoadID);
        return $this->db->delete('web_series_episoade');
	}

	function getEpisodeDetails($episoadID) {
		$this->db->where('id', $episoadID);
		$query = $this->db->get('web_series_episoade');
		return $query->row();
	}

	function updateEpisode($Edit_modal_videos_id, $modal_Episodes_Name, $modal_Thumbnail, $modal_Order, $modal_Source, $modal_Url, $modal_Description,
	        $Downloadable, $Type, $Status, $add_modal_skip_available_Count, $add_modal_intro_start, $add_modal_intro_end, $end_credits_marker,
			    $drm_uuid_editModal, $drm_license_uri_editModal) {
		$this->db->set('Episoade_Name', $modal_Episodes_Name);
		$this->db->set('episoade_image', $modal_Thumbnail);
		$this->db->set('episoade_description', $modal_Description);
		$this->db->set('episoade_order', $modal_Order);
		$this->db->set('downloadable', $Downloadable);
		$this->db->set('type', $Type);
		$this->db->set('status', $Status);
		$this->db->set('source', $modal_Source);
		$this->db->set('url', $modal_Url);
		$this->db->set('skip_available', $add_modal_skip_available_Count);
		$this->db->set('intro_start', $add_modal_intro_start);
		$this->db->set('intro_end', $add_modal_intro_end);
		$this->db->set('end_credits_marker', $end_credits_marker);
		$this->db->set('drm_uuid', $drm_uuid_editModal);
		$this->db->set('drm_license_uri', $drm_license_uri_editModal);
		$this->db->where('id', $Edit_modal_videos_id);
		return $this->db->update('web_series_episoade');
	}

	function add_episode_download_link($EpisodeID, $Label, $Order, $Quality, $Size, $Source, $Url, $download_type, $Status) {
		$this->db->set('name', $Label);
		$this->db->set('size', $Size);
		$this->db->set('quality', $Quality);
		$this->db->set('link_order', $Order);
		$this->db->set('episode_id', $EpisodeID);
		$this->db->set('url', $Url);
		$this->db->set('type', $Source);
		$this->db->set('download_type', $download_type);
		$this->db->set('status', $Status);
		$this->db->insert('episode_download_links');
		return $this->db->insert_id();
	}

	function delete_episode_download_link($episoadDownloadLinkID) {
		$this->db->where('id', $episoadDownloadLinkID);
        return $this->db->delete('episode_download_links');
	}

	function get_episoad_download_link_details($episoadDownloadLinkID) {
		$this->db->where('id', $episoadDownloadLinkID);
		$query = $this->db->get('episode_download_links');
		return $query->row();
	}

	function update_episode_download_link_data($episoadDownloadLinkID, $Label, $Order, $Quality, $Size, $Source, $Url, $download_type, $Status) {
		$this->db->set('name', $Label);
		$this->db->set('size', $Size);
		$this->db->set('quality', $Quality);
		$this->db->set('link_order', $Order);
		$this->db->set('url', $Url);
		$this->db->set('type', $Source);
		$this->db->set('download_type', $download_type);
		$this->db->set('status', $Status);
		$this->db->where('id', $episoadDownloadLinkID);
		return $this->db->update('episode_download_links');
	}

	function License_Setting($User_name, $License_Code) {
        $this->load->model('LicenseModel');

        if (empty($User_name) || empty($License_Code)) {
            $response = array('status' => 'error', 'message' => 'Username and License Code are required.');
        } else {
            $response = $this->LicenseModel->auth($User_name, $License_Code);
        }

        return $response;
	}

	function processImportedDb($fullPath) {
		if (file_exists($fullPath)){
			$host           =     $this->db->hostname;
			$dbuser         =     $this->db->username;
			$dbpassword     =     $this->db->password;
			$dbname         =     $this->db->database;
	
			$mysqli = @new mysqli($host, $dbuser, $dbpassword, $dbname);
	
			if (!mysqli_connect_errno()) {
				$sql = file_get_contents($fullPath);
	
				$mysqli->multi_query($sql);
				do {
					
				} while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));
				$mysqli->close();
			}

			return true;
		} else {
			return false;
		}
	}

	function get_tmdb_id($Type, $id) {
		if($Type == "Webseries_id") {
			$this->db->where('id', $id);
			return $this->db->get('web_series')->row()->TMDB_ID;
		}
	}

	function GenerateSecrateCronKey() {
		$length = 16;
		$newKey = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

		$this->db->set('cron_key', $newKey);
        $this->db->where('id', 1);
        return $this->db->update('config');
	}

	function CronStatus($cron_status) {
		$this->db->set('cron_status', $cron_status);
        $this->db->where('id', 1);
        return $this->db->update('config');
	}

	public function TruncateTables($tables) {
		$tablesArrey = explode(',', $tables);
		foreach($tablesArrey as $tableItem) {
			$this->db->truncate($tableItem);
		}
		return true;
	}

	function get_live_tv_genres() {
		$table = 'live_tv_genres';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 1 ),
			array( 'db' => 'id', 'dt' => 2 ),
			array( 'db' => 'name',  'dt' => 3 ),
			array( 'db' => 'status',   'dt' => 4 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function addUpcommingContent($tmdb_id, $name, $description, $release_date, $poster, $youtube_trailer, $content_type, $status) {
		$this->db->set('tmdb_id', $tmdb_id);
		$this->db->set('name', $name);
		$this->db->set('description', $description);
		$this->db->set('release_date', $release_date);
		$this->db->set('poster', $poster);
		$this->db->set('trailer_url', $youtube_trailer);
		$this->db->set('type', $content_type);
		$this->db->set('status', $status);
		$this->db->insert('upcoming_contents');
		return $this->db->insert_id();
	}

	function getAllUpcomingContents() {
        $table = 'upcoming_contents';
         
        $primaryKey = 'id';
        
        $columns = array(
            array( 'db' => 'id', 'dt' => 2 ),
            array( 'db' => 'poster', 'dt' => 3 ),
            array( 'db' => 'name',  'dt' => 4 ),
            array( 'db' => 'description',   'dt' => 5 ),
            array( 'db' => 'status',   'dt' => 6 )
        );
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function getUpcomingContentByID($ID) {
		$this->db->where('id', $ID);
		$query = $this->db->get('upcoming_contents');
		return $query->row();
	}

	function deleteUpcomingContent($ID) {
		$this->db->where('id', $ID);
        return $this->db->delete("upcoming_contents");
	}

	function UpdateUpcommingContent($ID, $name, $description, $release_date, $poster, $youtube_trailer, $content_type, $status) {
		$this->db->set('name', $name);
		$this->db->set('description', $description);
		$this->db->set('release_date', $release_date);
		$this->db->set('poster', $poster);
		$this->db->set('trailer_url', $youtube_trailer);
		$this->db->set('type', $content_type);
		$this->db->set('status', $status);
		$this->db->where('id', $ID);
		return $this->db->update('upcoming_contents');
	}

	function publish_all($type) {
		if($type==1) {
			$this->db->where('status', 0);
			$query = $this->db->get('movies');
			$totalChanged = 0;
			foreach($query->result() as $data) {
				$this->db->set('status', 1);
				$this->db->where('id', $data->id);
				$this->db->update('movies');
				$totalChanged++;
			}
			return $totalChanged;
		} else if($type==2) {
			$this->db->where('status', 0);
			$query = $this->db->get('web_series');
			$totalChanged = 0;
			foreach($query->result() as $data) {
				$this->db->set('status', 1);
				$this->db->where('id', $data->id);
				$this->db->update('web_series');
				$totalChanged++;
			}
			return $totalChanged;
		} else {
			return 0;
		}
	}

	function updatePaymentGatewayType($payment_gateway_type) {
		$this->db->set('payment_gateway_type', $payment_gateway_type);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function get_all_custom_payment_requests() {
		$table = 'custom_payment_requests';
         
        $primaryKey = 'id';
        
        $columns = array(
			array( 'db' => 'id', 'dt' => 1 ),
			array( 'db' => 'user_id', 'dt' => 2, 'formatter' => function( $d, $row ) {
				return $this->get_user_Details($d)->name;
			}),
			array( 'db' => 'user_id', 'dt' => 13, 'formatter' => function( $d, $row ) {
				return $this->get_user_Details($d)->email;
			}),
			array( 'db' => 'payment_type',  'dt' => 3 ),
			array( 'db' => 'payment_details',   'dt' => 4 ),
			array( 'db' => 'subscription_name',   'dt' => 5 ),
			array( 'db' => 'subscription_type',   'dt' => 6 ),
			array( 'db' => 'subscription_time',   'dt' => 7 ),
			array( 'db' => 'subscription_amount',   'dt' => 8 ),
			array( 'db' => 'subscription_currency', 'dt' => 9 ),
			array( 'db' => 'uploaded_image', 'dt' => 10 ),
			array( 'db' => 'request_status', 'dt' => 11 ),
			array( 'db' => 'id', 'dt' => 12 )
		);
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function add_custom_payment_type($payment_type_modal, $payment_details_modal, $modal_status_modal) {
		$this->db->set('type', $payment_type_modal);
		$this->db->set('payment_details', $payment_details_modal);
		$this->db->set('status', $modal_status_modal);
		$this->db->insert('custom_payment_type');
		return $this->db->insert_id();
	}

	function Delete_custom_payment_type($ID) {
		$this->db->where('id', $ID);
        return $this->db->delete('custom_payment_type');
	}

	function updateRequestStatus($ID, $request_status) {
		if($request_status == 1) {
			$Today = date("Y-m-d");

		    $this->db->where('id', $ID);
		    $query = $this->db->get('custom_payment_requests');
		    $custom_payment_request = $query->row();
    
		    $exp_Date = date('Y-m-d', strtotime($Today . " + " . $custom_payment_request->subscription_time . " day"));
    
		    $this->db->set('active_subscription', $custom_payment_request->subscription_name);
		    $this->db->set('subscription_type', $custom_payment_request->subscription_type);
		    $this->db->set('time', $custom_payment_request->subscription_time);
		    $this->db->set('amount', $custom_payment_request->subscription_amount);
		    $this->db->set('subscription_start', $Today);
		    $this->db->set('subscription_exp', $exp_Date);
            $this->db->where('id', $custom_payment_request->user_id);
            $this->db->update('user_db');
		}

		$this->db->set('request_status', $request_status);
		$this->db->where('id', $ID);
		$this->db->update('custom_payment_requests');

        $requestStatusArray = array(
            "0" => "Pending",
            "1" => "Approved",
            "2" => "Declined"
        );

        $this->db->where('id', $ID);
        $report = $this->db->get('custom_payment_requests')->row();
        if($report->request_status == $request_status) {
            $this->load->model('Notification_model');
            $this->Notification_model->sendNotification("Payment Request ".$requestStatusArray[$report->request_status], "Subscription: $report->subscription_name & Amount: $report->subscription_amount",
                "", "", array("Type" => "Announcement"), array($report->user_id));

            try {
                $this->db->where('id', $custom_payment_request->user_id);
                $user_db = $this->db->get('user_db')->row();
                $config = $this->db->get('config')->row();
                $this->load->model('Mail_model');
                $this->load->model('Mail_formater_model');
                $this->Mail_model->toMail($user_db->email);
                $this->Mail_model->subject($custom_payment_request->subscription_name.' Subscription Activated on '.$config->name);
                $this->Mail_model->body($this->Mail_formater_model->format('subscription_purchase', $user_db->email, '', $user_db->name, $custom_payment_request->subscription_name, $custom_payment_request->subscription_time, $custom_payment_request->subscription_amount, $Today, $exp_Date));
                $this->Mail_model->send();
            } catch (Exception $e) {}

            return true;
        }
        return false;
	}


	function getAlldisposableEmails() {
        $table = 'disposable_emails';
         
        $primaryKey = 'id';
        
        $columns = array(
            array( 'db' => 'emails', 'dt' => 2 ),
            array( 'db' => 'id', 'dt' => 3 ),
        );
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY id DESC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function Add_disposable_email($disposable_Email) {
		$this->db->set('emails', $disposable_Email);
		$this->db->insert('disposable_emails');
		return $this->db->insert_id();
	}

	function deletedisposableEmail($ID) {
		$this->db->where('id', $ID);
        return $this->db->delete('disposable_emails');
	}

	function ClearAllDisposableEmails() {
        return $this->db->empty_table('disposable_emails');
	}

	function AutoFetchDisposableEmails() {
		$jsonData = json_decode(@file_get_contents('https://raw.githubusercontent.com/disposable/disposable-email-domains/master/domains.json'));
		foreach($jsonData as $item) {
			$this->db->set('emails', $item);
			$this->db->insert('disposable_emails');
			$this->db->insert_id();
		}
		return true;
	}

	function getAllContentNetworks() {
        $table = 'networks';
         
        $primaryKey = 'id';
        
        $columns = array(
            array( 'db' => 'id', 'dt' => 2 ),
            array( 'db' => 'logo', 'dt' => 3 ),
            array( 'db' => 'name',  'dt' => 4 ),
            array( 'db' => 'networks_order',   'dt' => 5 ),
            array( 'db' => 'status',   'dt' => 6 )
        );
         
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
			'charset' => 'utf8'
        );
         
        $order = "ORDER BY networks_order ASC";
        require(APPPATH.'/libraries/ssp.class.php');
         
        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $order )
        );
	}

	function getContentNetworkDetails($networkID) {
		$this->db->where('id', $networkID);
		$query = $this->db->get('networks');
		return $query->row();
	}

	function updateContentNetwork($edit_networkID, $edit_network_name, $edit_network_logo, $edit_network_order, $edit_network_status) {
		$this->db->set('name', $edit_network_name);
		$this->db->set('logo', $edit_network_logo);
		$this->db->set('networks_order', $edit_network_order);
		$this->db->set('status', $edit_network_status);
		$this->db->where('id', $edit_networkID);
		return $this->db->update('networks');
	}

	function addContentNetwork($add_network_name, $add_network_logo, $add_network_order, $add_network_status) {
		$this->db->set('name', $add_network_name);
		$this->db->set('logo', $add_network_logo);
		$this->db->set('networks_order', $add_network_order);
		$this->db->set('status', $add_network_status);
		$this->db->insert('networks');
		return $this->db->insert_id();
	}

	function DeleteContentNetwork($ID) {
		$this->db->where('id', $ID);
        return $this->db->delete("networks");
	}

	function embed_custom_error_code($embed_error_code) {
		$this->db->set('embed_error_code', $embed_error_code);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function embed_custom_error_code_reset() {
		$customErrorCode = base64_decode("Jmx0OyFET0NUWVBFIGh0bWwmZ3Q7Jmx0O2h0bWwmZ3Q7ICAgICZsdDtoZWFkJmd0OyAgICAmbHQ7bGluayBocmVmPSJodHRwczovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2NzczI/ZmFtaWx5PU51bml0bytTYW5zOndnaHRANjAwOzkwMCZhbXA7ZGlzcGxheT1zd2FwIiByZWw9InN0eWxlc2hlZXQiJmd0OyAgICAmbHQ7c2NyaXB0IHNyYz0iaHR0cHM6Ly9raXQuZm9udGF3ZXNvbWUuY29tLzRiOWJhMTRiMGYuanMiIGNyb3Nzb3JpZ2luPSJhbm9ueW1vdXMiJmd0OyZsdDsvc2NyaXB0Jmd0OyAgICAmbHQ7c3R5bGUmZ3Q7Ym9keSB7ICBiYWNrZ3JvdW5kLWNvbG9yOiAjOTVjMmRlO30ubWFpbmJveCB7ICBiYWNrZ3JvdW5kLWNvbG9yOiAjOTVjMmRlOyAgbWFyZ2luOiBhdXRvOyAgaGVpZ2h0OiA0MDBweDsgIHdpZHRoOiA2MDBweDsgIHBvc2l0aW9uOiByZWxhdGl2ZTt9ICAuZXJyIHsgICAgY29sb3I6ICNmZmZmZmY7ICAgIGZvbnQtZmFtaWx5OiAnTnVuaXRvIFNhbnMnLCBzYW5zLXNlcmlmOyAgICBmb250LXNpemU6IDhyZW07ICAgIHBvc2l0aW9uOmFic29sdXRlOyAgICBsZWZ0OiAyOCU7ICAgIHRvcDogOCU7ICB9LmZhciB7ICBwb3NpdGlvbjogYWJzb2x1dGU7ICBmb250LXNpemU6IDYuNXJlbTsgIGxlZnQ6IDQ1JTsgIHRvcDogMTUlOyAgY29sb3I6ICNmZmZmZmY7fSAuZXJyMiB7ICAgIGNvbG9yOiAjZmZmZmZmOyAgICBmb250LWZhbWlseTogJ051bml0byBTYW5zJywgc2Fucy1zZXJpZjsgICAgZm9udC1zaXplOiA4cmVtOyAgICBwb3NpdGlvbjphYnNvbHV0ZTsgICAgbGVmdDogNjUlOyAgICB0b3A6IDglOyAgfS5tc2cgeyAgICB0ZXh0LWFsaWduOiBjZW50ZXI7ICAgIGZvbnQtZmFtaWx5OiAnTnVuaXRvIFNhbnMnLCBzYW5zLXNlcmlmOyAgICBmb250LXNpemU6IDEuM3JlbTsgICAgcG9zaXRpb246YWJzb2x1dGU7ICAgIGxlZnQ6IDE2JTsgICAgdG9wOiA0NSU7ICAgIHdpZHRoOiA3NSU7ICB9YSB7ICB0ZXh0LWRlY29yYXRpb246IG5vbmU7ICBjb2xvcjogd2hpdGU7fWE6aG92ZXIgeyAgdGV4dC1kZWNvcmF0aW9uOiB1bmRlcmxpbmU7fSAgICAmbHQ7L3N0eWxlJmd0OyAgJmx0Oy9oZWFkJmd0OyAgJmx0O2JvZHkmZ3Q7ICAgICZsdDtkaXYgY2xhc3M9Im1haW5ib3giJmd0OyAgICAgICZsdDtkaXYgY2xhc3M9ImVyciImZ3Q7NCZsdDsvZGl2Jmd0OyAgICAgICZsdDtpIGNsYXNzPSJmYXIgZmEtcXVlc3Rpb24tY2lyY2xlIGZhLXNwaW4iJmd0OyZsdDsvaSZndDsgICAgICAmbHQ7ZGl2IGNsYXNzPSJlcnIyIiZndDs0Jmx0Oy9kaXYmZ3Q7ICAgICAgJmx0O2RpdiBjbGFzcz0ibXNnIiZndDtNYXliZSB0aGlzIENvbnRlbnQgbW92ZWQ/IEdvdCBkZWxldGVkPyBJcyBoaWRpbmcgb3V0IGluIHF1YXJhbnRpbmU/IE5ldmVyIGV4aXN0ZWQgaW4gdGhlIGZpcnN0IHBsYWNlPyZsdDtwJmd0O0xldCdzIGdvIEJhY2sgYW5kIHRyeSBmcm9tIHRoZXJlLiZsdDsvcCZndDsmbHQ7L2RpdiZndDsgICAgICAgICZsdDsvZGl2Jmd0OyAgICAgICZsdDsvYm9keSZndDsgICAgICAmbHQ7L2h0bWwmZ3Q7");
		$this->db->set('embed_error_code', $customErrorCode);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function deleteGdriveAccount($ID) {
		$this->db->where('id', $ID);
        return $this->db->delete("google_drive_accounts");
	}

	function getGdriveAccount($ID) {
		$this->db->where('id', $ID);
		$query = $this->db->get('google_drive_accounts');
		return $query->row();
	}

	function pauseGdriveAccount($ID) {
		$this->db->set('status', 0);
		$this->db->where('id', $ID);
		return $this->db->update('google_drive_accounts');
	}

	function updateGdriveAccount($edit_account_id, $edit_email, $edit_client_id, $edit_client_secret, $edit_refresh_token, $access_token, $expires_in, $edit_status) {
		$this->db->set('email', $edit_email);
		$this->db->set('client_id', $edit_client_id);
		$this->db->set('client_secret', $edit_client_secret);
		$this->db->set('refresh_token', $edit_refresh_token);
		$this->db->set('access_token', $access_token);
		$this->db->set('expires_in', $expires_in);
		$this->db->set('status', $edit_status);
		$this->db->set('updated_at', time());
		$this->db->where('id', $edit_account_id);
		return $this->db->update('google_drive_accounts');
	}

	function addGdriveAccount($add_email, $add_client_id, $add_client_secret, $add_refresh_token, $access_token, $expires_in, $add_status) {
		$this->db->set('email', $add_email);
		$this->db->set('client_id', $add_client_id);
		$this->db->set('client_secret', $add_client_secret);
		$this->db->set('refresh_token', $add_refresh_token);
		$this->db->set('access_token', $access_token);
		$this->db->set('expires_in', $expires_in);
		$this->db->set('status', $add_status);
		$this->db->set('created_at', time());
		$this->db->set('updated_at', time());
		$this->db->insert('google_drive_accounts');
		return $this->db->insert_id();
	}

}