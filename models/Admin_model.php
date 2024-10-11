<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
	}

    function login($email, $password) {
        $this->db->where('email', $email);  
        $this->db->where('password', $password);  
        $query = $this->db->get('user_db');  
  
        if ($query->num_rows() == 1) {  
            return true;  
        } else {
            return false;  
        }  
	}

    function getConfig() {
		$query = $this->db->get('config');
		return $query->row();
	}

    function getUserData($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('user_db');
		return $query->row();
	}

	function dashboardData() {
		$Total_Movie = $this->db->count_all('movies');
		$Total_WebSeries = $this->db->count_all('web_series');


		$this->db->like('status', 0);
        $this->db->from('movies');
        $Total_Unpublished_Movie = $this->db->count_all_results();

		$this->db->like('status', 0);
        $this->db->from('web_series');
        $Total_Unpublished_WebSeries = $this->db->count_all_results(); 

		$Total_device = $this->db->count_all('devices');
		$Total_user = $this->db->count_all('user_db');

		$todate = date('m-d-Y', time());

		$query = $this->db->get_where('view_log', array('date' => $todate,'content_type' => 1));
		$todaysMoviesView = $query->num_rows();

		$query = $this->db->get_where('view_log', array('date' => $todate,'content_type' => 2));
		$todaysWebSeriesView = $query->num_rows();

		return (object) ['Total_Movie' =>  $Total_Movie, 'Total_Unpublished_Movie' => $Total_Unpublished_Movie, 'Total_WebSeries' => $Total_WebSeries, 'Total_Unpublished_WebSeries' => $Total_Unpublished_WebSeries,
		            'Total_device' =>  $Total_device, 'Total_user' =>  $Total_user, 'todaysMoviesView' => $todaysMoviesView, 'todaysWebSeriesView' => $todaysWebSeriesView];
	}

	function mostViewedToday() {
		$todate = date('m-d-Y', time());
		$json =array();
		$query = $this->db->query("SELECT *, count(content_id) as max FROM view_log WHERE date LIKE '$todate' GROUP BY content_id ORDER BY max DESC LIMIT 6");
		$_I = "0";
		foreach ($query->result() as $row)
        {

			$query = $this->db->where('date', $todate)->where('content_id', $row->content_id, FALSE)->get('view_log');
			$_V = $query->num_rows();

			if($row->content_type == '1') {
				$query = $this->db->like('id', $row->content_id, 'none', FALSE)->get('movies');
				foreach ($query->result() as $_row) {
					$_I++;
					$json[] = array("_I"=>$_I, "name"=>$_row->name, "c_type"=>"Movies", "_V"=>$_V, "id"=>$_row->id);
				}

			} else if($row->content_type == '2') {
				$query = $this->db->like('id', $row->content_id, 'none', FALSE)->get('web_series');
				foreach ($query->result() as $_row) {
					$_I++;
					$json[] = array("_I"=>$_I, "name"=>$_row->name, "c_type"=>"Web Series", "_V"=>$_V, "id"=>$_row->id);
				}
			}
        }
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function MostPopularMovies() {
		$query = $this->db->query("SELECT *, count(content_id ) as max FROM view_log WHERE content_type LIKE 1 GROUP BY content_id ORDER BY max DESC LIMIT 5");
		$M_I = "0";
		$json =array();
		foreach ($query->result() as $row)
        {
			$query = $this->db->where('content_type', '1')->where('content_id', $row->content_id, FALSE)->get('view_log');
			$T_M_V = $query->num_rows();

			$query = $this->db->like('id', $row->content_id, 'none', FALSE)->get('movies');
			foreach ($query->result() as $_row) {
				$M_I++;
				$json[] = array("M_I"=>$M_I, "name"=>$_row->name, "T_M_V"=>$T_M_V, "id"=>$_row->id);
			}
		}
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function MostPopularWebSeries() {
		$query = $this->db->query("SELECT *, count(content_id ) as max FROM view_log WHERE content_type LIKE 2 GROUP BY content_id ORDER BY max DESC LIMIT 5");
		$S_I = "0";
		$json =array();
		foreach ($query->result() as $row) {
			$query = $this->db->where('content_type', '2')->where('content_id', $row->content_id, FALSE)->get('view_log');
			$T_S_V = $query->num_rows();

			$query = $this->db->like('id', $row->content_id, 'none', FALSE)->get('web_series');
			foreach ($query->result() as $_row) {
				$S_I++;
				$json[] = array("S_I"=>$S_I, "name"=>$_row->name, "T_S_V"=>$T_S_V, "id"=>$_row->id);
			}
		}
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function NewUsers() {
		$query = $this->db->select('*')->order_by('id DESC')->get('user_db', 10);
		$M_I = "0";
		$json =array();
		foreach ($query->result() as $row) {
			$M_I++;
			$json[] = array("M_I"=>$M_I, "name"=>$row->name, "email"=>$row->email, "role"=>$row->role, "active_subscription"=>$row->active_subscription);
		}
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function getSelectGenre() {
		$query = $this->db->get('genres');
		$json =array();
        foreach ($query->result() as $row)
        {
            $json[] = array("id"=>$row->id, "text"=>$row->name);
        }
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function getSelectContentNetworks() {
		$query = $this->db->get('networks');
		$json =array();
        foreach ($query->result() as $row)
        {
            $json[] = array("id"=>$row->id, "text"=>$row->name);
        }
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function getLiveTvSelectGenre() {
		$query = $this->db->get('live_tv_genres');
		$json =array();
        foreach ($query->result() as $row)
        {
            $json[] = array("id"=>$row->id, "text"=>$row->name);
        }
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function movieData($movieID) {
		$this->db->where('id', $movieID);
		$query = $this->db->get('movies');
		return $query->row();
	}

	function webSeriesData($WebSeriesID) {
		$this->db->where('id', $WebSeriesID);
		$query = $this->db->get('web_series');
		return $query->row();
	}

    function webSeriesByEpisodeID($episoadID) {
        $this->db->where('id', $episoadID);
        $query = $this->db->get('web_series_episoade');
        $season_id = $query->row()->season_id;
        $this->db->where('id', $season_id);
        $query = $this->db->get('web_series_seasons');
        return $this->webSeriesData($query->row()->web_series_id);
    }
    function seasionByEpisodeID($episoadID) {
        $this->db->where('id', $episoadID);
        $query = $this->db->get('web_series_episoade');
        $season_id = $query->row()->season_id;
        $this->db->where('id', $season_id);
        $query = $this->db->get('web_series_seasons');
        return $query->row();
    }

	function splashScreenUI($splashScreenBgColor, $splash_screen_ui_type, $splash_image_url, $splash_lottie_animation_url) {
		$this->db->set('splash_bg_color', $splashScreenBgColor);
		$this->db->set('splash_screen_type', $splash_screen_ui_type);
		$this->db->set('splash_image_url', $splash_image_url);
		$this->db->set('splash_lottie_url', $splash_lottie_animation_url);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function contentItemUI($MW_Item_Type, $LT_Item_Type, $EP_Type) {
		$this->db->set('content_item_type', $MW_Item_Type);
		$this->db->set('live_tv_content_item_type', $LT_Item_Type);
		$this->db->set('webSeriesEpisodeitemType', $EP_Type);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function onScreenEffets($Effect_Type) {
		$this->db->set('onscreen_effect', $Effect_Type);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function androidUpdate($Latest_APK_Version_Name, $Latest_APK_Version_Code, $APK_File_URL, $Whats_new_on_latest_APK, $Update_Skipable, $Update_Type, $GooglePlay_Update_Type) {
		$this->db->set('Latest_APK_Version_Name', $Latest_APK_Version_Name);
		$this->db->set('Latest_APK_Version_Code', $Latest_APK_Version_Code);
		$this->db->set('APK_File_URL', $APK_File_URL);
		$this->db->set('Whats_new_on_latest_APK', $Whats_new_on_latest_APK);
		$this->db->set('Update_Skipable', $Update_Skipable);
		$this->db->set('Update_Type', $Update_Type);
		$this->db->set('googleplayAppUpdateType', $GooglePlay_Update_Type);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function messageSetting($Show_Message, $Message_Animation, $Message_Title, $Message) {
		$this->db->set('Show_Message', $Show_Message);
		$this->db->set('message_animation_url', $Message_Animation);
		$this->db->set('Message_Title', $Message_Title);
		$this->db->set('Message', $Message);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function commentSettings($movie_comments, $webseries_comments) {
		$this->db->set('movie_comments', $movie_comments);
		$this->db->set('webseries_comments', $webseries_comments);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function contentSetting($shuffle_contents, $Home_Rand_Max_Movie_Show, $Home_Rand_Max_Series_Show, $Home_Recent_Max_Movie_Show, $Home_Recent_Max_Series_Show) {
		$this->db->set('shuffle_contents', $shuffle_contents);
		$this->db->set('Home_Rand_Max_Movie_Show', $Home_Rand_Max_Movie_Show);
		$this->db->set('Home_Rand_Max_Series_Show', $Home_Rand_Max_Series_Show);
		$this->db->set('Home_Recent_Max_Movie_Show', $Home_Recent_Max_Movie_Show);
		$this->db->set('Home_Recent_Max_Series_Show', $Home_Recent_Max_Series_Show);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function loginSetting($google_login) {
		$this->db->set('google_login', $google_login);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function safeMode($safeMode_versions, $safe_mode_bool) {
		$this->db->set('safeModeVersions', $safeMode_versions);
		$this->db->set('safeMode', $safe_mode_bool);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function pinLock($pinLockStatus_bool, $pinLockcode) {
		$this->db->set('pinLockStatus', $pinLockStatus_bool);
		$this->db->set('pinLockPin', $pinLockcode);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function default_stream($movieDefaultStreamLinkStatus, $movieDefaultStreamLinkType) {
		$this->db->set('movieDefaultStreamLinkStatus', $movieDefaultStreamLinkStatus);
		$this->db->set('movieDefaultStreamLinkType', $movieDefaultStreamLinkType);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function otp_system($login_otp_status, $signup_otp_status) {
		$this->db->set('login_otp_status', $login_otp_status);
		$this->db->set('signup_otp_status', $signup_otp_status);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function androidSetting($name, $apk_logo, $package_name, $login_mandatory, $maintenance, $all_live_tv_type, $all_movies_type, $all_series_type, $LiveTV_Visiable_in_Home, $genre_visible_in_home, $livetv_genreList_Visiable_in_Home_bool, $primeryThemeColor, $blocked_regions, $onboarding_status, $SASD_status, $home_bottom_floting_menu_status_bool, $download_manager) {
		$this->db->set('name', $name);
		$this->db->set('logo', $apk_logo);
		$this->db->set('package_name', $package_name);
		$this->db->set('login_mandatory', $login_mandatory);
		$this->db->set('maintenance', $maintenance);
		$this->db->set('all_live_tv_type', $all_live_tv_type);
		$this->db->set('all_movies_type', $all_movies_type);
		$this->db->set('all_series_type', $all_series_type);
		$this->db->set('LiveTV_Visiable_in_Home', $LiveTV_Visiable_in_Home);
		$this->db->set('genre_visible_in_home', $genre_visible_in_home);
		$this->db->set('live_tv_genre_visible_in_home', $livetv_genreList_Visiable_in_Home_bool);
		$this->db->set('primeryThemeColor', $primeryThemeColor);
		$this->db->set('blocked_regions', $blocked_regions);
		$this->db->set('onboarding_status', $onboarding_status);
		$this->db->set('force_single_device', $SASD_status);
		$this->db->set('home_bottom_floting_menu_status', $home_bottom_floting_menu_status_bool);
		$this->db->set('download_manager', $download_manager);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

    function imageSettings($image_proxy_status, $image_storage_provider, $imgbb_api_key) {
        $this->db->set('image_proxy_status', $image_proxy_status);
        $this->db->set('image_storage_provider', $image_storage_provider);
        $this->db->set('imgbb_api_key', $imgbb_api_key);
        $this->db->where('id', 1);
        return $this->db->update('config');
    }

    function playerSetting($default_intro_video)
    {
        $this->db->set('player_intro', $default_intro_video);
        $this->db->where('id', 1);
        return $this->db->update('config');
    }

	function TMDB_Language($Language) {
		$this->db->set('tmdb_language', $Language);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function License_Setting($User_name, $License_Code) {
        $this->load->model('LicenseModel');

        if (empty($User_name) || empty($License_Code)) {
            return false;
        } else {
            $response = $this->LicenseModel->auth($User_name, $License_Code);
        }
        if($response['status']) {
            return true;
        } else {
            return false;
        }
	}

	function ads_setting($ad_type, $Admob_Publisher_ID, $Admob_APP_ID, $adMob_Native, $adMob_Banner, $adMob_Interstitial, $adMob_appopen
	                        , $StartApp_App_ID, $facebook_app_id, $facebook_banner_ads_placement_id
							    , $facebook_interstitial_ads_placement_id, $AdColony_app_id, $AdColony_BANNER_ZONE_ID
								    , $AdColony_INTERSTITIAL_ZONE_ID, $UnityAds_game_id, $UnityAds_BANNER_ID, $UnityAds_Interstitial_ID, $Custom_Banner_Url
									    , $Custom_Banner_Click_Url_Type, $Custom_Banner_Click_Url, $custom_interstitial_url
									        , $Custom_Interstitial_Click_Url_Type, $Custom_Interstitial_Click_Url
											, $applovin_sdk_key, $applovin_apiKey, $applovin_Banner_ID
											, $applovin_Interstitial_ID, $ironSource_app_key) {
		$this->db->set('ad_type', $ad_type);
		$this->db->set('Admob_Publisher_ID', $Admob_Publisher_ID);
		$this->db->set('Admob_APP_ID', $Admob_APP_ID);
		$this->db->set('adMob_Native', $adMob_Native);
		$this->db->set('adMob_Banner', $adMob_Banner);
		$this->db->set('adMob_Interstitial', $adMob_Interstitial);
		$this->db->set('adMob_AppOpenAd', $adMob_appopen);
		$this->db->set('StartApp_App_ID', $StartApp_App_ID);
		$this->db->set('facebook_app_id', $facebook_app_id);
		$this->db->set('facebook_banner_ads_placement_id', $facebook_banner_ads_placement_id);
		$this->db->set('facebook_interstitial_ads_placement_id', $facebook_interstitial_ads_placement_id);
		$this->db->set('AdColony_app_id', $AdColony_app_id);
		$this->db->set('AdColony_banner_zone_id', $AdColony_BANNER_ZONE_ID);
		$this->db->set('AdColony_interstitial_zone_id', $AdColony_INTERSTITIAL_ZONE_ID);
		$this->db->set('unity_game_id', $UnityAds_game_id);
		$this->db->set('unity_banner_id', $UnityAds_BANNER_ID);
		$this->db->set('unity_interstitial_id', $UnityAds_Interstitial_ID);
		$this->db->set('custom_banner_url', $Custom_Banner_Url);
		$this->db->set('custom_banner_click_url_type', $Custom_Banner_Click_Url_Type);
		$this->db->set('custom_banner_click_url', $Custom_Banner_Click_Url);
		$this->db->set('custom_interstitial_url', $custom_interstitial_url);
		$this->db->set('custom_interstitial_click_url_type', $Custom_Interstitial_Click_Url_Type);
		$this->db->set('custom_interstitial_click_url', $Custom_Interstitial_Click_Url);
		$this->db->set('applovin_sdk_key', $applovin_sdk_key);
		$this->db->set('applovin_apiKey', $applovin_apiKey);
		$this->db->set('applovin_Banner_ID', $applovin_Banner_ID);
		$this->db->set('applovin_Interstitial_ID', $applovin_Interstitial_ID);
		$this->db->set('ironSource_app_key', $ironSource_app_key);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function email_setting($contact_email, $smtp_host, $smtp_user, $smtp_pass, $smtp_port, $smtp_crypto) {
		$this->db->set('Contact_Email', $contact_email);
		$this->db->set('SMTP_Host', $smtp_host);
		$this->db->set('SMTP_Username', $smtp_user);
		$this->db->set('SMTP_Password', $smtp_pass);
		$this->db->set('SMTP_Port', $smtp_port);
		$this->db->set('SMTP_crypto', $smtp_crypto);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function getImageSliders() {
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('image_slider');
		return $query->result();
	}

	function get_movie_play_links($movie_id) {
		$this->db->where('movie_id', $movie_id);
		$this->db->order_by('link_order', 'ASC');
		$query = $this->db->get('movie_play_links');
		return $query->result();
	}

	function get_movie_link_details($movie_play_link_ID) {
		$this->db->where('id', $movie_play_link_ID);
		$query = $this->db->get('movie_play_links');
		return $query->row();
	}

	function get_WebSeries_link_details($WebSeries_play_link_ID) {
		$this->db->where('id', $WebSeries_play_link_ID);
		$query = $this->db->get('web_series_episoade');
		return $query->row();
	}

	function get_subtitles($ID, $ct) {
		$this->db->where('content_id', $ID);
		$this->db->where('content_type', $ct);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('subtitles');
		return $query->result();
	}

	function movie_download_links($movie_id) {
		$this->db->where('movie_id', $movie_id);
		$this->db->order_by('link_order', 'ASC');
		$query = $this->db->get('movie_download_links');
		return $query->result();
	}

	function channelData($channelID) {
		$this->db->where('id', $channelID);
		$query = $this->db->get('live_tv_channels');
		return $query->row();
	}

	function webSeriesSeasons($WebSeriesID) {
		$this->db->where('web_series_id', $WebSeriesID);
		$this->db->order_by('season_order', 'ASC');
		$query = $this->db->get('web_series_seasons');
		return $query->result();
	}

	function web_series_Season_episoades($seasonID) {
		$this->db->where('season_id', $seasonID);
		$query = $this->db->get('web_series_episoade');
		return $query->num_rows();
	}

	function seasonData($seasonID) {
		$this->db->where('id', $seasonID);
		$query = $this->db->get('web_series_seasons');
		return $query->row();
	}

	function seasonWebSeriesData($seasonID) {
		$this->db->where('id', $seasonID);
		$query = $this->db->get('web_series_seasons');
		$web_series_id = $query->row()->web_series_id;

		$this->db->where('id', $web_series_id);
		$query = $this->db->get('web_series');
		return $query->row();
	}

	function webSeriesEpisoads($seasonID) {
		$this->db->where('season_id', $seasonID);
		$this->db->order_by('episoade_order', 'ASC');
		$query = $this->db->get('web_series_episoade');
		return $query->result();
	}

	function WebSeriesDownloadLinks($episoadID) {
		$this->db->where('episode_id', $episoadID);
		$this->db->order_by('link_order', 'ASC');
		$query = $this->db->get('episode_download_links');
		return $query->result();
	}

    function WebSeriesStreamLinks($episoadID) {
        $this->db->where('episode_id', $episoadID);
        $this->db->order_by('link_order', 'ASC');
        $query = $this->db->get('episode_play_links');
        return $query->result();
    }

	function DatabaseBackupCronSettings($db_backup_status, $db_backup_schedule) {
		$this->db->set('db_backup_status', $db_backup_status);
		$this->db->set('db_backup_schedule', $db_backup_schedule);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function NotificationCronSetting($auto_notification_status, $auto_notification_schedule) {
		$this->db->set('auto_notification_status', $auto_notification_status);
		$this->db->set('auto_notification_schedule', $auto_notification_schedule);
		$this->db->where('id', 1);
		return $this->db->update('config');
	}

	function getAllTable() {
		$tables = $this->db->list_tables();
		return $tables;
	}

	function getUpcomingContent($ID) {
		$this->db->where('id', $ID);
		$query = $this->db->get('upcoming_contents');
		return $query->row();
	}

	function get_custom_payment_type() {
		$query = $this->db->select('*')->order_by('id DESC')->get('custom_payment_type', 10);
		$M_I = "0";
		$json =array();
		foreach ($query->result() as $row) {
			$M_I++;
			$json[] = array("M_I"=>$M_I,"id"=>$row->id, "type"=>$row->type, "payment_details"=>$row->payment_details, "status"=>$row->status);
		}
		return json_encode($json, JSON_UNESCAPED_SLASHES);
	}

	function getNetworksRelatedToContent($content_id, $content_type) {
		$this->db->where('content_id', $content_id);
		$this->db->where('content_type', $content_type);
		$query = $this->db->get('content_network_log');
		return $query->result();
	}

	function get_google_drive_accounts() {
		$query = $this->db->get('google_drive_accounts');
		return $query->result();
	}

    function get_subscriptions() {
        $query = $this->db->get('subscription');
        return $query->result();
    }

    function add_subscription($user_id, $subscription_id, $notify) {
        if($subscription_id == 0) {
            $this->db->set('active_subscription', "Free");
            $this->db->set('subscription_type', "0");
            $this->db->set('time', "0");
            $this->db->set('amount', "0");
            $this->db->set('subscription_start', "0000-00-00");
            $this->db->set('subscription_exp', "0000-00-00");
            $this->db->where('id', $user_id);
            $this->db->update('user_db');
            $return_status = ($this->db->affected_rows() > 0);
        } else {
            $this->db->where('id', $subscription_id);
            $query = $this->db->get('subscription');
            $subscription = $query->row();

            date_default_timezone_set("Asia/Kolkata");
            $Today = date("Y-m-d");
            $exp_Date = date('Y-m-d', strtotime($Today . " + " . $subscription->time . " day"));

            $this->db->set('active_subscription', $subscription->name);
            $this->db->set('subscription_type', $subscription->subscription_type);
            $this->db->set('time', $subscription->time);
            $this->db->set('amount', $subscription->amount);
            $this->db->set('subscription_start', $Today);
            $this->db->set('subscription_exp', $exp_Date);
            $this->db->where('id', $user_id);
            $this->db->update('user_db');
            $return_status = ($this->db->affected_rows() > 0);
        }

        if($notify && $return_status) {
            if($subscription_id == 0) {
                $notify_title = "Subscription Plan Expired!";
                $notify_msg = "Your subscription plan has been expired today.";
            } else {
                $notify_title = "Subscription Upgraded!";
                $notify_msg = "Your account subscription has been upgraded to ".$subscription->name;
            }
            $this->load->model('Notification_model');
            $this->Notification_model->sendNotification($notify_title, $notify_msg,
                "", "", array("Type" => "Announcement"), array($user_id));
        }

        return $return_status;
    }

    function getAllCustomTags() {
        $this->load->model('Custom_tags_model');
        $json =array();
        foreach ($this->Custom_tags_model->get_all_tags() as $row)
        {
            $json[] = array("id"=>$row->id, "text"=>$row->name);
        }
        return json_encode($json, JSON_UNESCAPED_SLASHES);
    }

    function getCustomTag($contentID, $contentType) {
        $this->load->model('Custom_tag_log_model');
        if($this->Custom_tag_log_model->is_avaliable( array('content_id'=>$contentID, 'content_type'=>$contentType) )) {
            return $this->Custom_tag_log_model->get_logs_by_content($contentID, $contentType)->custom_tags_id;
        } else {
            return 0;
        }
    }

}