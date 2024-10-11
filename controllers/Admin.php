<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Admin_model');
        $this->onLoad();
    }

    function onLoad()
    {
        $this->language();

        if ($this->session->userdata('email') != null) {
            if ($this->uri->uri_string() == "login") {
                redirect("index");
            }
            /*if($this->ci_admin_model->getRole($this->session->userdata('email')) == 1) {
                $userData = $this->ci_admin_model->getUserData( $this->session->userdata('email'));
                    $userData = array(
                    'name' => $userData->name,
                'email' => $userData->email,
                'role' => $userData->role,
                'currently_logged_in' => 1
                );
                $this->session->set_userdata($userData);

                if($this->uri->uri_string() == "login") {
                    redirect("index");
                }
            } else {
                $this->logout();
            }*/
        } else {
            if ($this->uri->uri_string() != "login" && $this->uri->uri_string() != "recoverpw" && $this->uri->uri_string() != "changepass") {
                $this->logout();
            }

        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("login");
    }

    public function getQrData()
    {
        $config = $this->Admin_model->getConfig();
        $userData = $this->Admin_model->getUserData($this->session->userdata['email']);
        return json_encode(array('api_url' => base_url(), 'api_key' => $config->api_key, 'license_code' => $config->license_code,
            'Email' => $userData->email, 'Password' => $userData->password));
    }

    function instantVerify()
    {
        $this->load->model('LicenseModel');
        $response = $this->LicenseModel->licence();
        if($response['status'] === "success") {
            return false;
        } else {
            return true;
        }
    }

    public function language()
    {
        $admin_panel_language = $this->Admin_model->getConfig()->admin_panel_language;
        switch ($admin_panel_language) {
            case "english":
                $this->lang->load(array('login', 'dashboard', 'sidebar'), 'english');
                break;
            case "russian":
                $this->lang->load(array('login', 'dashboard', 'sidebar'), 'russian');
                break;
            default:
                $this->lang->load(array('login', 'dashboard', 'sidebar'), 'english');
        }
    }

    public function index()
    {
        $this->load->model('ServerStatsModel');
        $this->load->model('CacheModel');

        if ($this->input->post('server_status')) {
            if(ini_get('open_basedir') && ini_get('shell_exec')) {
                echo json_encode($this->ServerStatsModel->getServerStatus());
            }
        } else if ($this->input->post('cache_size')) {
            echo $this->CacheModel->getCacheSize();
        } else if ($this->input->post('clear_cache')) {
            echo $this->CacheModel->clear_cache();
        } else {
            $data['config'] = $this->Admin_model->getConfig();

            $data['contentDetails'] = $this->Admin_model->dashboardData();
            $data['mostViewedToday'] = $this->Admin_model->mostViewedToday();
            $data['MostPopularMovies'] = $this->Admin_model->MostPopularMovies();
            $data['MostPopularWebSeries'] = $this->Admin_model->MostPopularWebSeries();
            $data['NewUsers'] = $this->Admin_model->NewUsers();

            if(ini_get('open_basedir') && ini_get('shell_exec')) {
                $data['server_status'] = $this->ServerStatsModel->getServerStatus();
            }

            $data['cache_size'] = $this->CacheModel->getCacheSize();


            $this->load->model('LicenseModel');
            if($data['config']->Dashboard_Version_Code < $this->LicenseModel->licence()['data']->update->version_code) {
                $data['isUpdateAvailable'] = true;
            } else {
                $data['isUpdateAvailable'] = false;
            }

            $this->load->view('home', $data);
        }
    }

    public function login()
    {
        $this->load->view('login');
        if ($this->input->post('submit')) {
            if ($this->Admin_model->login($this->input->post('email'), md5($this->input->post('password')))) {

                $userData = $this->Admin_model->getUserData($this->input->post('email'));

                if ($userData->role == 1) {
                    $data = array(
                        'name' => $userData->name,
                        'email' => $userData->email,
                        'role' => $userData->role,
                        'currently_logged_in' => 1
                    );
                    $this->session->set_userdata($data);
                    $this->db->query('DELETE FROM ci_sessions WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 DAY))');
                    redirect("index");
                } else {
                    $this->session->set_flashdata('error', 'Login BLocked');
                    redirect("login");
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid Login');
                redirect("login");
            }
        }
    }


    public function recoverpw()
    {
        $this->load->view('recoverpw');
    }

    public function changepass()
    {
        if (isset($_SESSION['code'])) {
            $this->db->where('code', $_SESSION['code']);
            $mail_token_rows = $this->db->get('mail_token_details')->num_rows();
            if ($mail_token_rows > 0) {
                $this->db->where('code', $_SESSION['code']);
                $mail_token = $this->db->get('mail_token_details')->row();
                $Tkn_Time = base64_decode($mail_token->token);
                $d = strtotime("now");
                $Current_DT = date("Y-m-d h:i:s", $d);
                $to_time = strtotime($Current_DT);
                $from_time = strtotime($Tkn_Time);
                $Diff = ($to_time - $from_time) / 60;
                if ($Diff > 5) {
                    if ($mail_token->status == 0) {
                        redirect("recoverpw");
                    } else {
                        $data['code'] = $_SESSION['code'];
                        $this->load->view('changepass', $data);
                    }
                } else {
                    $data['code'] = $_SESSION['code'];
                    $this->load->view('changepass', $data);
                }
            }
        } else {
            redirect("recoverpw");
        }

    }

    public function api_setting()
    {
        $data['data'] = (object)['api_url' => base_url(), 'api_key' => $this->Admin_model->getConfig()->api_key];
        $this->load->view("api_setting", $data);
    }

    public function privacy_policy()
    {
        $data['privacy_policy'] = $this->Admin_model->getConfig()->PrivecyPolicy;
        $this->load->view('privacy_policy', $data);
    }

    public function terms_and_conditions()
    {
        $data['TermsAndConditions'] = $this->Admin_model->getConfig()->TermsAndConditions;
        $this->load->view('terms_and_conditions', $data);
    }

    public function db_manager()
    {
        $data['tables'] = $this->Admin_model->getAllTable();
        $this->load->view('db_manager', $data);
    }

    public function db_import()
    {
        $this->load->view('db_import');
    }

    public function db_export()
    {
        if (!is_dir('backup/db/')) {
            mkdir('backup/db/', 0777, true);
        }
        $data['files'] = directory_map('backup/db/');
        $this->load->view('db_export', $data);
    }

    public function slider_settings()
    {
        $data['data'] = (object)['image_slider_type' => $this->Admin_model->getConfig()->image_slider_type, 'movie_image_slider_max_visible' => $this->Admin_model->getConfig()->movie_image_slider_max_visible, 'webseries_image_slider_max_visible' => $this->Admin_model->getConfig()->webseries_image_slider_max_visible];
        $this->load->view('slider_settings', $data);
    }

    public function add_movie()
    {
        $data['config'] = (object)['tmdb_language' => $this->Admin_model->getConfig()->tmdb_language, 'license_code' => $this->Admin_model->getConfig()->license_code, 'image_storage_provider' => $this->Admin_model->getConfig()->image_storage_provider, 'imgbb_api_key' => $this->Admin_model->getConfig()->imgbb_api_key];
        $data['selectGenre'] = $this->Admin_model->getSelectGenre();
        $data['selectContentNetworks'] = $this->Admin_model->getSelectContentNetworks();
        $data['customTags'] = $this->Admin_model->getAllCustomTags();
        $this->load->view('add_movie', $data);
    }

    public function movie_link_manager()
    {
        $this->load->view("movie_link_manager");
    }

    public function all_movies()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('all_movies', $data);
    }

    public function editMovie($movieID)
    {
        $data['movieData'] = $this->Admin_model->movieData($movieID);
        $data['movieID'] = $movieID;
        $data['selectGenre'] = $this->Admin_model->getSelectGenre();
        $data['selectContentNetworks'] = $this->Admin_model->getSelectContentNetworks();
        $data['networksRelatedToContent'] = $this->Admin_model->getNetworksRelatedToContent($movieID, 1);
        $data['customTags'] = $this->Admin_model->getAllCustomTags();
        $data['selectedCustomTags'] = $this->Admin_model->getCustomTag($movieID, 1);
        $this->load->view('editMovie', $data);
    }

    public function android_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('android_setting', $data);

        if ($this->input->post('SplashScreenUI')) {
            if ($this->Admin_model->splashScreenUI($this->input->post('splashScreenBgColor'), $this->input->post('splash_screen_ui_type')
                , $this->input->post('splash_image_url'), $this->input->post('splash_lottie_animation_url'))) {
                $this->session->set_flashdata('success', 'Splash Screen UI Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Splash Screen UI Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('contentItemUI')) {
            if ($this->Admin_model->contentItemUI($this->input->post('MW_Item_Type'), $this->input->post('LT_Item_Type'), $this->input->post('EP_Type'))) {
                $this->session->set_flashdata('success', 'Content Item UI Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Content Item UI Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('onScreenEffets')) {
            if ($this->Admin_model->onScreenEffets($this->input->post('Effect_Type'))) {
                $this->session->set_flashdata('success', 'onScreen Effets Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'onScreen Effets Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('androidUpdate')) {
            if ($this->input->post('update_skipable') == "on") {
                $update_skipable = 1;
            } else {
                $update_skipable = 0;
            }
            if ($this->Admin_model->androidUpdate($this->input->post('apk_version_name'), $this->input->post('apk_version_code'), $this->input->post('latest_apk_url'), $this->input->post('apk_whats_new'), $update_skipable, $this->input->post('Update_Type'), $this->input->post('GooglePlay_Update_Type'))) {
                $this->session->set_flashdata('success', 'Android Update Data Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Android Update Data Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('messageSetting')) {
            if ($this->input->post('Show_Message_bool') == "on") {
                $Show_Message_bool = 1;
            } else {
                $Show_Message_bool = 0;
            }
            if ($this->Admin_model->messageSetting($Show_Message_bool, $this->input->post('Message_Animation'), $this->input->post('Message_Title'), $this->input->post('Message'))) {
                $this->session->set_flashdata('success', 'Message Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Message Setting Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('commentSettings')) {
            if ($this->input->post('moviesComment') == "on") {
                $moviesComment = 1;
            } else {
                $moviesComment = 0;
            }
            if ($this->input->post('webSeriesComment') == "on") {
                $webSeriesComment = 1;
            } else {
                $webSeriesComment = 0;
            }
            if ($this->Admin_model->commentSettings($moviesComment, $webSeriesComment)) {
                $this->session->set_flashdata('success', 'Comment Settings Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Comment Settings Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('contentSetting')) {
            if ($this->input->post('shuffle_contents_bool') == "on") {
                $shuffle_contents_bool = 1;
            } else {
                $shuffle_contents_bool = 0;
            }
            if ($this->Admin_model->contentSetting($shuffle_contents_bool, $this->input->post('Home_Rand_Max_Movie_Show'), $this->input->post('Home_Rand_Max_Series_Show'), $this->input->post('Home_Recent_Max_Movie_Show'), $this->input->post('Home_Recent_Max_Series_Show'))) {
                $this->session->set_flashdata('success', 'Content Settings Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Content Settings Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('loginSetting')) {
            if ($this->input->post('google_login_bool') == "on") {
                $google_login_bool = 1;
            } else {
                $google_login_bool = 0;
            }
            if ($this->Admin_model->loginSetting($google_login_bool)) {
                $this->session->set_flashdata('success', 'Login Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Login Setting Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('safeMode')) {
            if ($this->input->post('safe_mode_bool') == "on") {
                $safe_mode_bool = 1;
            } else {
                $safe_mode_bool = 0;
            }
            $safeMode_versions = is_array($this->input->post('safeMode_versions')) ? implode(",", $this->input->post('safeMode_versions')) : "";
            if ($this->Admin_model->safeMode($safeMode_versions, $safe_mode_bool)) {
                $this->session->set_flashdata('success', 'SafeMode Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'SafeMode Not Updated!');
            }

            redirect("android_setting");
        }

        if ($this->input->post('androidSetting')) {
            if ($this->input->post('login_mandatory_bool') == "on") {
                $login_mandatory_bool = 1;
            } else {
                $login_mandatory_bool = 0;
            }
            if ($this->input->post('maintenance_bool') == "on") {
                $maintenance_bool = 1;
            } else {
                $maintenance_bool = 0;
            }
            if ($this->input->post('LiveTV_Visiable_in_Home_bool') == "on") {
                $LiveTV_Visiable_in_Home_bool = 1;
            } else {
                $LiveTV_Visiable_in_Home_bool = 0;
            }
            if ($this->input->post('genreList_Visiable_in_Home_bool') == "on") {
                $genreList_Visiable_in_Home_bool = 1;
            } else {
                $genreList_Visiable_in_Home_bool = 0;
            }
            if ($this->input->post('livetv_genreList_Visiable_in_Home_bool') == "on") {
                $livetv_genreList_Visiable_in_Home_bool = 1;
            } else {
                $livetv_genreList_Visiable_in_Home_bool = 0;
            }
            if ($this->input->post('onboarding_status') == "on") {
                $onboarding_status = 1;
            } else {
                $onboarding_status = 0;
            }
            if ($this->input->post('SASD_status') == "on") {
                $SASD_status = 1;
            } else {
                $SASD_status = 0;
            }
            if ($this->input->post('home_bottom_floting_menu_status_bool') == "on") {
                $home_bottom_floting_menu_status_bool = 1;
            } else {
                $home_bottom_floting_menu_status_bool = 0;
            }

            $blocked_regions = is_array($this->input->post('blocked_regions')) ? implode(",", $this->input->post('blocked_regions')) : "";
            if ($this->Admin_model->androidSetting($this->input->post('apk_name'), $this->input->post('apk_logo'), $this->input->post('package_name'), $login_mandatory_bool, $maintenance_bool, $this->input->post('All_Live_TV_Type'), $this->input->post('All_Movies_Type'), $this->input->post('All_Series_Type'), $LiveTV_Visiable_in_Home_bool, $genreList_Visiable_in_Home_bool, $livetv_genreList_Visiable_in_Home_bool, $this->input->post('primeryThemeColor'), $blocked_regions, $onboarding_status, $SASD_status, $home_bottom_floting_menu_status_bool, $this->input->post('download_manager'), $image_proxy_status)) {
                $this->session->set_flashdata('success', 'Android Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Android Setting Not Updated!');
            }

            redirect("android_setting");
        }

        if ($this->input->post('image_settings')) {
            if ($this->input->post('image_proxy_status') == "on") {
                $image_proxy_status = 1;
            } else {
                $image_proxy_status = 0;
            }
            if ($this->Admin_model->imageSettings($image_proxy_status, $this->input->post('image_storage_provider'), $this->input->post('imgbb_api_key'))) {
                $this->session->set_flashdata('success', 'Image Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Image Setting Not Updated!');
            }

            redirect("android_setting");
        }

        if ($this->input->post('pinLock')) {
            if ($this->input->post('pinLockStatus_bool') == "on") {
                $pinLockStatus_bool = 1;
            } else {
                $pinLockStatus_bool = 0;
            }
            if ($this->Admin_model->pinLock($pinLockStatus_bool, $this->input->post('pinLockcode'))) {
                $this->session->set_flashdata('success', 'Pin Code Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Pin Code Setting Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('default_stream')) {
            if ($this->input->post('movieDefaultStreamLinkStatus') == "on") {
                $movieDefaultStreamLinkStatus = 1;
            } else {
                $movieDefaultStreamLinkStatus = 0;
            }
            if ($this->Admin_model->default_stream($movieDefaultStreamLinkStatus, $this->input->post('movieDefaultStreamLinkType'))) {
                $this->session->set_flashdata('success', 'Default Stream Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Default Stream Setting Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('otp_system')) {
            if ($this->input->post('login_otp_status') == "on") {
                $login_otp_status = 1;
            } else {
                $login_otp_status = 0;
            }
            if ($this->input->post('signup_otp_status') == "on") {
                $signup_otp_status = 1;
            } else {
                $signup_otp_status = 0;
            }
            if ($this->Admin_model->otp_system($login_otp_status, $signup_otp_status)) {
                $this->session->set_flashdata('success', 'OTP System Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'OTP System Setting Not Updated!');
            }
            redirect("android_setting");
        }

        if ($this->input->post('player_setting')) {
            if ($this->Admin_model->playerSetting($this->input->post('default_intro_video'))) {
                $this->session->set_flashdata('success', 'Player Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Player Setting Not Updated!');
            }
            redirect("android_setting");
        }
    }

    function dashboard_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('dashboard_setting', $data);
        if ($this->input->post('TMDB_Language')) {
            if ($this->Admin_model->TMDB_Language($this->input->post('Language'))) {
                $this->session->set_flashdata('success', 'TMDB Language Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'TMDB Language Not Updated!');
            }
            redirect("dashboard_setting");
        }
        if ($this->input->post('License_Setting')) {
            $User_name = $this->input->post('User_Name', TRUE);
            $License_Code = $this->input->post('License_Code', TRUE);
            if ($this->Admin_model->License_Setting($User_name, $License_Code)) {
                $this->session->set_flashdata('success', 'License Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'License Setting Not Updated!');
            }
            redirect("dashboard_setting");
        }
    }

    function ads_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('ads_setting', $data);
        if ($this->input->post('ads_setting')) {
            if ($this->Admin_model->ads_setting($this->input->post('ad_type'), $this->input->post('Admob_Publisher_ID'), $this->input->post('Admob_APP_ID')
                , $this->input->post('adMob_Native'), $this->input->post('adMob_Banner'), $this->input->post('adMob_Interstitial'), $this->input->post('adMob_appopen')
                , $this->input->post('StartApp_App_ID'), $this->input->post('facebook_app_id'), $this->input->post('facebook_banner_ads_placement_id')
                , $this->input->post('facebook_interstitial_ads_placement_id'), $this->input->post('AdColony_app_id'), $this->input->post('AdColony_BANNER_ZONE_ID')
                , $this->input->post('AdColony_INTERSTITIAL_ZONE_ID'), $this->input->post('UnityAds_game_id'), $this->input->post('UnityAds_BANNER_ID'), $this->input->post('UnityAds_Interstitial_ID'), $this->input->post('Custom_Banner_Url')
                , $this->input->post('Custom_Banner_Click_Url_Type'), $this->input->post('Custom_Banner_Click_Url'), $this->input->post('Custom_Interstitial_Url')
                , $this->input->post('Custom_Interstitial_Click_Url_Type'), $this->input->post('Custom_Interstitial_Click_Url')
                , $this->input->post('applovin_sdk_key'), $this->input->post('applovin_apiKey'), $this->input->post('applovin_Banner_ID')
                , $this->input->post('applovin_Interstitial_ID'), $this->input->post('ironSource_app_key'))) {
                $this->session->set_flashdata('success', 'Ads Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Ads Setting Not Updated!');
            }
            redirect("ads_setting");
        }
    }

    function email_setting()
    {
        if ($this->input->post('email_setting')) {
            if ($this->Admin_model->email_setting($this->input->post('contact_email'), $this->input->post('smtp_host')
                , $this->input->post('smtp_user'), $this->input->post('smtp_pass'), $this->input->post('smtp_port')
                , $this->input->post('smtp_crypto'))) {
                $this->session->set_flashdata('success', 'Email Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Email Setting Not Updated!');
            }
            redirect("email_setting");
        }else if ($this->input->post('testMail')) {
            $this->load->model('Mail_model');
            $this->Mail_model->mailType('text');
            $this->Mail_model->toMail($this->input->post('mail'));
            $this->Mail_model->subject('TEST MAIL');
            $this->Mail_model->body('This a Test Mail to Test Mail Configuration');
            if($this->Mail_model->send()) {
                echo "Message has been sent";
            } else {
                echo $this->Mail_model->print_debugger();
            }
        } else {
            $data['config'] = $this->Admin_model->getConfig();
            $this->load->view('email_setting', $data);
        }
    }

    function custom_slider()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $data['ImageSliders'] = $this->Admin_model->getImageSliders();
        $this->load->view('custom_slider', $data);
    }

    function report_manager()
    {
        $this->load->view('report_manager');
    }

    function request_manager()
    {
        $this->load->view('request_manager');
    }

    function manage_user()
    {
        if ($this->input->post('notify_user')) {
            $this->load->model('Notification_model');
            echo $this->Notification_model->sendNotification($this->input->post('heading'), $this->input->post('message'),
                $this->input->post('large_icon'), $this->input->post('big_picture'), $this->input->post('data'),
                $this->input->post('user_ids'));
        } else if ($this->input->post('get_subscription_list')) {
            echo json_encode($this->Admin_model->get_subscriptions());
        } else if ($this->input->post('add_subscription')) {
            echo $this->Admin_model->add_subscription($this->input->post('user_id'), $this->input->post('subscription_id'), $this->input->post('notify'));
        } else {
            $data['config'] = $this->Admin_model->getConfig();
            $this->load->view('manage_user', $data);
        }
    }

    function telegram_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('telegram_setting', $data);
    }

    function telegram_announcement()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('telegram_announcement', $data);
    }

    function payment_gateways()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('payment_gateways', $data);
    }

    function custom_gateways()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $data['custom_payment_type'] = $this->Admin_model->get_custom_payment_type();
        $this->load->view('custom_gateways', $data);
    }

    function sub_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('sub_setting', $data);
    }

    function sub_request()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('sub_request', $data);
    }

    function genres()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('genres', $data);
    }

    function sub_plan()
    {
        $this->load->view('sub_plan');
    }

    function coupon_manager()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('coupon_manager', $data);
    }

    function notification_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('notification_setting', $data);
    }

    function notification_external_browser()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('notification_external_browser', $data);
    }

    function notification_web_view()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('notification_web_view', $data);
    }

    function announcement()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('announcement', $data);
    }

    function notification_movie()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('notification_movie', $data);
    }

    function notification_web_series()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('notification_web_series', $data);
    }

    public function manage_movie_links($movieID)
    {
        $data['movieData'] = $this->Admin_model->movieData($movieID);
        $data['moviePlayLinks'] = $this->Admin_model->get_movie_play_links($movieID);
        $data['movieDownloadLinks'] = $this->Admin_model->movie_download_links($movieID);
        $data['movieID'] = $movieID;
        $this->load->view('manage_movie_links', $data);
    }

    public function subtitle_manager($ID, $ct)
    {
        if ($ct == 1) {
            $data['LinkDetails'] = $this->Admin_model->get_movie_link_details($ID);
        } else if ($ct == 2) {
            $data['LinkDetails'] = $this->Admin_model->get_WebSeries_link_details($ID);
        }
        $data['subtitles'] = $this->Admin_model->get_subtitles($ID, $ct);
        $data['ID'] = $ID;
        $data['ct'] = $ct;
        $this->load->view('subtitle_manager', $data);
    }

    public function search_movie()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('search_movie', $data);
    }

    public function search_webseries()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('search_webseries', $data);
    }

    public function add_bulk_movie()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('add_bulk_movie', $data);
    }

    public function add_bulk_webseries()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('add_bulk_webseries', $data);
    }

    public function all_channels()
    {
        if ($this->input->post('send_notification')) {
            $this->load->model('Notification_model');
            echo $this->Notification_model->sendNotification($this->input->post('heading'), $this->input->post('message'),
                $this->input->post('large_icon'), $this->input->post('big_picture'), array("Type" => "Announcement"),
                "");
        }
        if ($this->input->post('notify_data')) {
            echo json_encode($this->Admin_model->channelData($this->input->post('ID')));
        } else {
            $this->load->view('all_channels');
        }
    }

    public function all_web_series()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('all_web_series', $data);
    }

    public function add_channel()
    {
        $data['selectGenre'] = $this->Admin_model->getLiveTvSelectGenre();
        $this->load->view('add_channel', $data);
    }

    public function edit_channel($channelID)
    {
        $data['channelData'] = $this->Admin_model->channelData($channelID);
        $data['channelID'] = $channelID;
        $data['selectGenre'] = $this->Admin_model->getLiveTvSelectGenre();
        $this->load->view('edit_channel', $data);
    }

    public function add_web_series()
    {
        $data['config'] = (object)['tmdb_language' => $this->Admin_model->getConfig()->tmdb_language, 'license_code' => $this->Admin_model->getConfig()->license_code, 'image_storage_provider' => $this->Admin_model->getConfig()->image_storage_provider, 'imgbb_api_key' => $this->Admin_model->getConfig()->imgbb_api_key];
        $data['selectGenre'] = $this->Admin_model->getSelectGenre();
        $data['selectContentNetworks'] = $this->Admin_model->getSelectContentNetworks();
        $data['customTags'] = $this->Admin_model->getAllCustomTags();
        $this->load->view('add_web_series', $data);
    }

    public function edit_webSeries($WebSeriesID)
    {
        $data['webSeriesData'] = $this->Admin_model->webSeriesData($WebSeriesID);
        $data['WebSeriesID'] = $WebSeriesID;
        $data['selectGenre'] = $this->Admin_model->getSelectGenre();
        $data['selectContentNetworks'] = $this->Admin_model->getSelectContentNetworks();
        $data['networksRelatedToContent'] = $this->Admin_model->getNetworksRelatedToContent($WebSeriesID, 2);
        $data['customTags'] = $this->Admin_model->getAllCustomTags();
        $data['selectedCustomTags'] = $this->Admin_model->getCustomTag($WebSeriesID, 2);
        $this->load->view('edit_webSeries', $data);
    }

    public function manage_seasons($WebSeriesID)
    {
        $data['config'] = $this->Admin_model->getConfig();
        $data['webSeriesData'] = $this->Admin_model->webSeriesData($WebSeriesID);
        $data['webSeriesSeasons'] = $this->Admin_model->webSeriesSeasons($WebSeriesID);
        $data['WebSeriesID'] = $WebSeriesID;
        $this->load->view('manage_seasons', $data);
    }

    public function manage_episodes($seasonID)
    {
        $data['config'] = $this->Admin_model->getConfig();
        $data['seasonWebSeriesData'] = $this->Admin_model->seasonWebSeriesData($seasonID);
        $data['seasonData'] = $this->Admin_model->seasonData($seasonID);
        $data['seasonID'] = $seasonID;
        $data['webSeriesEpisoads'] = $this->Admin_model->webSeriesEpisoads($seasonID);
        $this->load->view('manage_episodes', $data);
    }

    public function manage_episode_links($episoadID)
    {
        $data['WebSeriesDownloadLinks'] = $this->Admin_model->WebSeriesDownloadLinks($episoadID);
        $data['WebSeriesStreamLinks'] = $this->Admin_model->WebSeriesStreamLinks($episoadID);
        $data['episoadID'] = $episoadID;
        $data['webSeriesData'] = $this->Admin_model->webSeriesByEpisodeID($episoadID);
        $data['seasionData'] = $this->Admin_model->seasionByEpisodeID($episoadID);
        $this->load->view('manage_episode_links', $data);
    }

    public function update()
    {
        if (!$this->instantVerify()) {
            $config = $this->Admin_model->getConfig();
            $this->load->model('LicenseModel');
            $licence = $this->LicenseModel->licence()['data'];

            $data['dashboardVersion'] = $config->Dashboard_Version;
            $data['latestVersion'] = $licence->update->version_name;
            if($config->Dashboard_Version_Code < $licence->update->version_code) {
                $data['isUpdateAvailable'] = true;
            } else {
                $data['isUpdateAvailable'] = false;
            }

            $this->load->view('update', $data);
        } else {
            redirect("index");
        }
    }

    public function cron_setting()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('cron_setting', $data);

        if ($this->input->post('dbc')) {
            if ($this->input->post('DB_bool') == "on") {
                $DB_bool = 1;
            } else {
                $DB_bool = 0;
            }
            if ($this->Admin_model->DatabaseBackupCronSettings($DB_bool, $this->input->post('db_backup_schedule'))) {
                $this->session->set_flashdata('success', 'Database Backup Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Database Backup Setting Not Updated!');
            }
            redirect("cron_setting");
        }

        if ($this->input->post('nc')) {
            if ($this->input->post('N_bool') == "on") {
                $N_bool = 1;
            } else {
                $N_bool = 0;
            }
            if ($this->Admin_model->NotificationCronSetting($N_bool, $this->input->post('auto_notification_schedule'))) {
                $this->session->set_flashdata('success', 'Notification Cron Setting Updated Successfully!');
            } else {
                $this->session->set_flashdata('error', 'Notification Cron Setting Not Updated!');
            }
            redirect("cron_setting");
        }
    }

    public function scrap_gogoanime()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('scrap_gogoanime', $data);
    }

    public function live_tv_genres()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('live_tv_genres', $data);
    }

    public function add_upcoming_contents()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('add_upcoming_contents', $data);
    }

    public function all_upcoming_contents()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('all_upcoming_contents', $data);
    }

    public function edit_upcoming_contents($ID)
    {
        $data['UpcomingContentData'] = $this->Admin_model->getUpcomingContent($ID);
        $data['UpcomingContentID'] = $ID;
        $this->load->view('edit_upcoming_contents', $data);
    }

    public function content_networks()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('content_networks', $data);
    }

    public function scrap_topcinema()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $this->load->view('scrap_topcinema', $data);
    }

    public function google_drive()
    {
        $data['config'] = $this->Admin_model->getConfig();
        $data['google_drive_accounts'] = $this->Admin_model->get_google_drive_accounts();
        $this->load->view('google_drive', $data);
    }

    public function custom_tags()
    {
        $this->load->model('Custom_tags_model');
        if ($this->input->post('addcustomtag')) {
            echo $this->Custom_tags_model->insert_tag($this->input->post('name'), $this->input->post('background_color'), $this->input->post('text_color'));
        } else if ($this->input->post('deletecustomtag')) {
            echo $this->Custom_tags_model->delete_tag($this->input->post('ID'));
        } else if ($this->input->post('getcustomtag')) {
            echo json_encode($this->Custom_tags_model->get_tag($this->input->post('ID')));
        } else if ($this->input->post('updatecustomtag')) {
            echo $this->Custom_tags_model->update_tag($this->input->post('id'), $this->input->post('name'), $this->input->post('background_color'), $this->input->post('text_color'));
        } else {
            $data['custom_tags'] = $this->Custom_tags_model->get_all_tags();
            $this->load->view('custom_tags', $data);
        }
    }

    public function email_templates()
    {
        $this->load->model('Mail_templates_model');

        if ($this->input->post('signup_HTML_edit')) {
            if($this->Mail_templates_model->update('signup', $this->input->post('signup_HTML'))) {
                echo $this->Mail_templates_model->get(array('type'=>'signup'))->data;
            }
        } else if ($this->input->post('login_otp_HTML_edit')) {
            if($this->Mail_templates_model->update('login_otp', $this->input->post('login_otp_HTML'))) {
                echo $this->Mail_templates_model->get(array('type'=>'login_otp'))->data;
            }
        } else if ($this->input->post('signup_otp_HTML_edit')) {
            if($this->Mail_templates_model->update('signup_otp', $this->input->post('signup_otp_HTML'))) {
                echo $this->Mail_templates_model->get(array('type'=>'signup_otp'))->data;
            }
        } else if ($this->input->post('password_reset_otp_HTML_edit')) {
            if($this->Mail_templates_model->update('password_reset_otp', $this->input->post('password_reset_otp_HTML'))) {
                echo $this->Mail_templates_model->get(array('type'=>'password_reset_otp'))->data;
            }
        } else if ($this->input->post('subscription_purchase_HTML_edit')) {
            if($this->Mail_templates_model->update('subscription_purchase', $this->input->post('subscription_purchase_HTML'))) {
                echo $this->Mail_templates_model->get(array('type'=>'subscription_purchase'))->data;
            }
        } else {
            $password_reset_otp = $this->Mail_templates_model->get(array('type'=>'password_reset_otp'));
            if($password_reset_otp != "") {
                $data['password_reset_otp'] = $password_reset_otp->data;
            } else {
                $data['password_reset_otp'] = "";
            }
            $signup_otp = $this->Mail_templates_model->get(array('type'=>'signup_otp'));
            if($signup_otp != "") {
                $data['signup_otp'] = $signup_otp->data;
            } else {
                $data['signup_otp'] = "";
            }
            $login_otp = $this->Mail_templates_model->get(array('type'=>'login_otp'));
            if($login_otp != "") {
                $data['login_otp'] = $login_otp->data;
            } else {
                $data['login_otp'] = "";
            }
            $signup = $this->Mail_templates_model->get(array('type'=>'signup'));
            if($signup != "") {
                $data['signup'] = $signup->data;
            } else {
                $data['signup'] = "";
            }
            $subscription_purchase = $this->Mail_templates_model->get(array('type'=>'subscription_purchase'));
            if($subscription_purchase != "") {
                $data['subscription_purchase'] = $subscription_purchase->data;
            } else {
                $data['subscription_purchase'] = "";
            }
            $this->load->view('email_templates', $data);
        }
    }

}
