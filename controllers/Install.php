<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Install extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index() {
        if ($this->input->post('verify')) {
            $this->load->model('LicenseModel');
            echo json_encode($this->LicenseModel->verify($this->input->post('username'), $this->input->post('key')));
        } else if ($this->input->post('dbcheck')) {
            try {
                $db_host = $this->input->post('db_host');
                $db_name = $this->input->post('db_name');
                $db_user = $this->input->post('db_user');
                $db_pass = $this->input->post('db_pass');
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if($this->update_database_config($db_host, $db_user, $db_pass, $db_name)) {
                    $CI = &get_instance();
                    $this->db = $CI->load->database('default', TRUE);
                    $table_count = empty($this->db->list_tables()) ? 0 : 1;

                    echo json_encode(array('status' => 'success', 'message' => 'Database Connected Successfully', 'db_status' => $table_count));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => "Invalid Database Connection"));
                }
            } catch(PDOException $e) {
                echo json_encode(array('status' => 'error', 'message' => "Invalid Database Connection"));
            }
        } else if ($this->input->post('importdb')) {
            $dbPath = FCPATH.'assets/db/database.sql';
            if (file_exists($dbPath)) {
                $this->load->database();
                $this->load->dbutil();
                $this->load->dbforge();

                if ($this->input->post('import_type') !== 0) {
                    $tables = $this->db->list_tables();
                    foreach ($tables as $table) {
                        $this->dbforge->drop_table($table, TRUE);
                    }
                }

                $sql_contents = file_get_contents($dbPath);
                if ($sql_contents === false) {
                    echo json_encode(array('status' => 'error', 'message' => "Invalid Database File"));
                }

                $queries = explode(';', $sql_contents);
                foreach ($queries as $query) {
                    $trimmed_query = trim($query);
                    if (!empty($trimmed_query)) {
                        $this->db->query($trimmed_query);
                    }
                }

                echo json_encode(array('status' => 'success', 'message' => 'Database Imported Successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Invalid Database File"));
            }
        } else if ($this->input->post('install')) {
            $this->load->database();
            $data = array(
                'id' => 1,
                'name' => $this->input->post('app_name'),
                'logo' => '',
                'package_name' => '',
                'api_key' => substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(16/strlen($x)) )),1,16),
                'license_code' => $this->input->post('codecanyon_purchase_key'),
                'license_user' => $this->input->post('codecanyon_username'),
                'license_access_token' => $this->input->post('access_token'),
                'license_token_type' => $this->input->post('token_type'),
                'login_mandatory' => 0,
                'maintenance' => 0,
                'image_slider_type' => 0,
                'movie_image_slider_max_visible' => 10,
                'webseries_image_slider_max_visible' => 10,
                'onesignal_api_key' => 'your_onesignal_api_key',
                'onesignal_appid' => 'onesignal_appid',
                'ad_type' => 0,
                'Admob_Publisher_ID' => 'admob_publisher_id',
                'Admob_APP_ID' => 'admob_app_id',
                'adMob_Native' => 'admob_native',
                'adMob_Banner' => 'admob_banner',
                'adMob_Interstitial' => 'admob_interstitial',
                'adMob_AppOpenAd' => 'admob_app_open_ad',
                'StartApp_App_ID' => 'startapp_app_id',
                'facebook_app_id' => 'facebook_app_id',
                'facebook_banner_ads_placement_id' => 'facebook_banner_id',
                'facebook_interstitial_ads_placement_id' => 'facebook_interstitial_id',
                'Latest_APK_Version_Name' => '1.0.0',
                'Latest_APK_Version_Code' => '100',
                'APK_File_URL' => 'http://example.com/app.apk',
                'Whats_new_on_latest_APK' => 'Bug fixes and improvements',
                'Update_Skipable' => 1,
                'Update_Type' => 0,
                'googleplayAppUpdateType' => 0,
                'Contact_Email' => 'contact@example.com',
                'SMTP_Host' => 'smtp.example.com',
                'SMTP_Username' => 'smtp_username',
                'SMTP_Password' => 'smtp_password',
                'SMTP_Port' => '587',
                'SMTP_crypto' => 'tls',
                'Dashboard_Version' => '2.8.8',
                'Dashboard_Version_Code' => 288,
                'shuffle_contents' => 0,
                'Home_Rand_Max_Movie_Show' => 0,
                'Home_Rand_Max_Series_Show' => 0,
                'Home_Recent_Max_Movie_Show' => 0,
                'Home_Recent_Max_Series_Show' => 0,
                'Show_Message' => 0,
                'message_animation_url' => '',
                'Message_Title' => 'Welcome to our app',
                'Message' => 'Hello world!',
                'all_live_tv_type' => 0,
                'all_movies_type' => 0,
                'all_series_type' => 0,
                'LiveTV_Visiable_in_Home' => 1,
                'TermsAndConditions' => 'By using this app, you agree to our terms.',
                'PrivecyPolicy' => 'Our privacy policy explains how we collect and use your information.',
                'tmdb_language' => 'en-US',
                'admin_panel_language' => 'en-US',
                'genre_visible_in_home' => 1,
                'AdColony_app_id' => 'adcolony_app_id',
                'AdColony_banner_zone_id' => 'adcolony_banner_zone',
                'AdColony_interstitial_zone_id' => 'adcolony_interstitial_zone',
                'unity_game_id' => 'unity_game_id',
                'unity_banner_id' => 'unity_banner_id',
                'unity_interstitial_id' => 'unity_interstitial_id',
                'custom_banner_url' => 'http://example.com/custom_banner.png',
                'custom_banner_click_url_type' => 0,
                'custom_banner_click_url' => 'http://example.com',
                'custom_interstitial_url' => 'http://example.com/custom_interstitial.png',
                'custom_interstitial_click_url_type' => 0,
                'custom_interstitial_click_url' => 'http://example.com',
                'applovin_sdk_key' => 'applovin_sdk_key',
                'applovin_apiKey' => 'applovin_api_key',
                'applovin_Banner_ID' => 'applovin_banner_id',
                'applovin_Interstitial_ID' => 'applovin_interstitial_id',
                'ironSource_app_key' => 'ironsource_app_key',
                'movie_comments' => 1,
                'webseries_comments' => 1,
                'google_login' => 1,
                'onscreen_effect' => 1,
                'razorpay_status' => 1,
                'razorpay_key_id' => 'razorpay_key_id',
                'razorpay_key_secret' => 'razorpay_key_secret',
                'paypal_status' => 1,
                'paypal_type' => 0,
                'paypal_clint_id' => 'paypal_client_id',
                'paypal_secret_key' => 'paypal_secret_key',
                'content_item_type' => 0,
                'live_tv_content_item_type' => 0,
                'webSeriesEpisodeitemType' => 0,
                'telegram_token' => 'telegram_token',
                'telegram_chat_id' => 'telegram_chat_id',
                'splash_screen_type' => 0,
                'splash_bg_color' => '#1b242f',
                'splash_image_url' => '',
                'splash_lottie_url' => '',
                'cron_key' => substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(16/strlen($x)) )),1,16),
                'cron_status' => 0,
                'auto_notification_status' => 0,
                'auto_notification_schedule' => 1,
                'db_backup_status' => 0,
                'db_backup_schedule' => 1,
                'safeModeVersions' => '',
                'safeMode' => 0,
                'primeryThemeColor' => $this->input->post('primery_theme_color'),
                'blocked_regions' => '',
                'pinLockStatus' => 1,
                'pinLockPin' => '1234',
                'flutterwave_status' => 1,
                'flutterwave_public_key' => 'flutterwave_public_key',
                'flutterwave_secret_key' => 'flutterwave_secret_key',
                'flutterwave_encryption_key' => 'flutterwave_encryption_key',
                'onboarding_status' => 1,
                'movieDefaultStreamLinkType' => 0,
                'movieDefaultStreamLinkStatus' => 1,
                'live_tv_genre_visible_in_home' => 0,
                'login_otp_status' => 0,
                'signup_otp_status' => 0,
                'force_single_device' => 0,
                'payment_gateway_type' => 0,
                'home_bottom_floting_menu_status' => 0,
                'uddoktapay_status' => 0,
                'uddoktapay_api_key' => 'uddoktapay_api_key',
                'uddoktapay_base_url' => 'http://example.com/uddoktapay',
                'bKash_status' => 0,
                'bKash_app_key' => 'bKash_app_key',
                'bKash_app_secret' => 'bKash_app_secret',
                'bKash_username' => 'bKash_username',
                'bKash_password' => 'bKash_password',
                'bKash_payment_type' => 0,
                'embed_error_code' => '',
                'download_manager' => 0,
                'player_intro' => '',
                'image_proxy_status' => 0,
                'image_storage_provider' => 0,
                'imgbb_api_key' => 'imgbb_api_key'
            );

            $this->db->insert('config', $data);

            $data = array(
                'name' => $this->input->post('admin_name'),
                'email' => $this->input->post('admin_email'),
                'password' => md5($this->input->post('admin_password')),
                'role' => '1',
                'active_subscription' => 'free',
                'subscription_type' => '0',
                'time' => '0',
                'amount' => '0',
                'subscription_start' => '',
                'subscription_exp' => '',
                'device_id' => ''
            );
            $this->db->insert('user_db', $data);



            $constants_file_path = APPPATH . 'config/constants.php';
            if (file_exists($constants_file_path)) {
                $constants_file_contents = file_get_contents($constants_file_path);
                $search = "defined('INSTALLED') OR define('INSTALLED', FALSE);";
                $replace = "defined('INSTALLED') OR define('INSTALLED', TRUE);";
                if (str_contains($constants_file_contents, $search)) {
                    $constants_file_contents = str_replace($search, $replace, $constants_file_contents);
                } else {
                    $constants_file_contents .= PHP_EOL . $replace;
                }

                file_put_contents($constants_file_path, $constants_file_contents);
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Something Went Wrong!"));
            }

            echo json_encode(array('status' => 'success', 'message' => 'Installed Successfully'));
        } else {
            $this->load->view('install/index');
        }
    }

    function update_database_config($hostname, $username, $password, $database) {
        $file_path = APPPATH . 'config/database.php';

        if (file_exists($file_path)) {
            $file_contents = file_get_contents($file_path);
            if ($file_contents === false) {
                return false;
            }

            $file_contents = preg_replace(
                "/('hostname' => ')[^']*(',)/",
                "$1$hostname$2",
                $file_contents
            );

            $file_contents = preg_replace(
                "/('username' => ')[^']*(',)/",
                "$1$username$2",
                $file_contents
            );

            $file_contents = preg_replace(
                "/('password' => ')[^']*(',)/",
                "$1$password$2",
                $file_contents
            );

            $file_contents = preg_replace(
                "/('database' => ')[^']*(',)/",
                "$1$database$2",
                $file_contents
            );

            $result = file_put_contents($file_path, $file_contents);
            if ($result === false) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }
}