<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/RestController.php');
use chriskacerguis\RestServer\RestController;

require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class Android_api extends RestController {
    private int $cacheExp = 300;
    function __construct()
    {
        parent::__construct();
        $this->load->model('RestApi/Android/Android_api_model');
        $this->load->model('Password_reset_model');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    public function appConfig_get() {
        $JWTkey = $this->Android_api_model->AppConfig()['api_key'];
        $token['config'] = $this->Android_api_model->AppConfig();
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
        $token['exp'] = $date->getTimestamp() + 60*60*5;
        $output['token'] = JWT::encode($token,$JWTkey );
        $this->set_response($output, RestController::HTTP_OK);
    }

    public function dmVyaWZ5_get() {
		echo "false";
        $license_code = $this->Android_api_model->AppConfig()['license_code'];
        $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://cloud.team-dooo.com/Dooo/verify/?code=$license_code",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
              ),
            ));
            
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                echo "false";
            } else {
                echo $response;
            }
    }

    public function authentication_post() {
        $decoded = base64_decode($this->post('encoded'));
        list($Request_Type) = explode(":",$decoded);
        if($Request_Type == "login") {
          list($Type,$Email,$Password) = explode(":",$decoded);
        } else if($Request_Type == "signup") {
            list($Type,$Username,$Email,$Password) = explode(":",$decoded);
        }

        $device_id = $this->post('device');

        if($Type == "login") {
            $userLogin = $this->Android_api_model->login($Email, $Password);
            if ($userLogin != false) {  
                $Today = date_create(date("Y-m-d"));
                   $User_ID = $userLogin['id'];
                    $subscription_remaining = 0;
                    $exp = date_create($userLogin['subscription_exp']);
                    $diff=date_diff($Today,$exp);
                    if($diff->format('%R') == "+") {
                        $subscription_remaining = $diff->format('%a');
                    } else if($diff->format('%R') == "-") {
                        $subscription_remaining = 0;

                        $this->db->set('active_subscription', "Free");
                        $this->db->set('subscription_type', "0");
                        $this->db->set('time', "0");
                        $this->db->set('amount', "0");
                        $this->db->set('subscription_start', "0000-00-00");
                        $this->db->set('subscription_exp', "0000-00-00");
                        $this->db->where('id', $User_ID);
                        $this->db->update('user_db');

                        if($userLogin['active_subscription'] != "Free" || $userLogin['subscription_type'] != 0 || $userLogin['time'] != 0 || $userLogin['amount'] != 0 || $userLogin['subscription_start'] != "0000-00-00" || $userLogin['subscription_exp'] !="0000-00-00") {
                            $this->db->set('name', $userLogin['name']);
                            $this->db->set('amount', $userLogin['amount']);
                            $this->db->set('time', $userLogin['time']);
                            $this->db->set('subscription_start', $userLogin['subscription_start']);
                            $this->db->set('subscription_exp', $userLogin['subscription_exp']);
                            $this->db->set('user_id', $User_ID);
                            $this->db->insert('subscription_log');
                        }
                    }

                $userLogin = $this->Android_api_model->login($Email, $Password);
                $this->Android_api_model->update_device_id($device_id, $User_ID);
                $output = array("Status"=>"Successful", "ID"=>$userLogin['id'], "Name"=>$userLogin['name'], "Email"=>$userLogin['email'], "Password"=>$userLogin['password'], "Role"=>$userLogin['role'], "active_subscription"=>$userLogin['active_subscription'], "subscription_type"=>$userLogin['subscription_type'], "subscription_exp"=>$userLogin['subscription_exp'], "subscription_remaining"=>$subscription_remaining);
                $this->set_response($output, RestController::HTTP_OK);
            } else {
                $output['Status'] = "Invalid Credential";
                $this->set_response($output, RestController::HTTP_OK);
            }  
        }else if($Type == "signup") {
            if($this->Android_api_model->checkIfDisposableEmail($Email)) {
                $output['Status'] = "Disposable Emails are not allowed";
                $this->set_response($output, RestController::HTTP_OK);
            } else {
                if($this->Android_api_model->signup($Username, $Email, $Password)) {
                    $userLogin = $this->Android_api_model->login($Email, $Password);
                    $this->Android_api_model->update_device_id($device_id, $userLogin['id']);
                    $output = array("Status"=>"Successful", "ID"=>$userLogin['id'], "Name"=>$userLogin['name'], "Email"=>$userLogin['email'], "Password"=>$userLogin['password'], "Role"=>$userLogin['role'], "active_subscription"=>$userLogin['active_subscription'], "subscription_type"=>$userLogin['subscription_type'], "subscription_exp"=>$userLogin['subscription_exp']);
                    $this->set_response($output, RestController::HTTP_OK);
                } else {
                    $output['Status'] = "Email Already Regestered";
                    $this->set_response($output, RestController::HTTP_OK);
                }
            }
        }else {
            header("HTTP/1.1 401 Unauthorized");
        }
    }

    public function getCustomImageSlider_get() {
        if ( ! $CustomImageSliderData = $this->cache->get('getCustomImageSlider_get')) {
            $CustomImageSliderData = $this->Android_api_model->getCustomImageSlider();
            $this->cache->save('getCustomImageSlider_get', $CustomImageSliderData, $this->cacheExp);
        }
        if($CustomImageSliderData != "") {
            $this->set_response($CustomImageSliderData, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
        
    }

    public function getMovieImageSlider_get() {
        if ( ! $MovieImageSliderData = $this->cache->get('getMovieImageSlider_get')) {
            $MovieImageSliderData = $this->Android_api_model->getMovieImageSlider();
            $this->cache->save('getMovieImageSlider_get', $MovieImageSliderData, $this->cacheExp);
        }
        if($MovieImageSliderData != "") {
            $this->set_response($MovieImageSliderData, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getWebSeriesImageSlider_get() {
        if ( ! $WebSeriesImageSliderData = $this->cache->get('getWebSeriesImageSlider_get')) {
            $WebSeriesImageSliderData = $this->Android_api_model->getWebSeriesImageSlider();
            $this->cache->save('getWebSeriesImageSlider_get', $WebSeriesImageSliderData, $this->cacheExp);
        }
        if($WebSeriesImageSliderData != "") {
            $this->set_response($WebSeriesImageSliderData, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getFeaturedLiveTV_get() {
        if ( ! $FeaturedLiveTV = $this->cache->get('getFeaturedLiveTV_get')) {
            $FeaturedLiveTV = $this->Android_api_model->getFeaturedLiveTV();
            $this->cache->save('getFeaturedLiveTV_get', $FeaturedLiveTV, $this->cacheExp);
        }
        if($FeaturedLiveTV != "") {
            $this->set_response($FeaturedLiveTV, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getAllLiveTV_get() {
        if ( ! $AllLiveTV = $this->cache->get('getAllLiveTV_get')) {
            $AllLiveTV = $this->Android_api_model->getAllLiveTV();
            $this->cache->save('getAllLiveTV_get', $AllLiveTV, $this->cacheExp);
        }
        if($AllLiveTV != "") {
            $this->set_response($AllLiveTV, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function searchLiveTV_post() {
        $SearchLiveTV = $this->Android_api_model->searchLiveTV($this->post('search'), $this->post('onlypremium'));
        if($SearchLiveTV != "") {
            $this->set_response($SearchLiveTV, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getRandMovies_get() {
        if ( ! $RandMovies = $this->cache->get('getRandMovies_get')) {
            $RandMovies = $this->Android_api_model->getRandMovies();
            $this->cache->save('getRandMovies_get', $RandMovies, $this->cacheExp);
        }
        if($RandMovies != "") {
            $this->set_response($RandMovies, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getRandWebSeries_get() {
        if ( ! $RandWebSeries = $this->cache->get('getRandWebSeries_get')) {
            $RandWebSeries = $this->Android_api_model->getRandWebSeries();
            $this->cache->save('getRandWebSeries_get', $RandWebSeries, $this->cacheExp);
        }
        if($RandWebSeries != "") {
            $this->set_response($RandWebSeries, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getMovieDetails_get($movieID) {
        if ( ! $MovieDetails = $this->cache->get('getMovieDetails_get_'.$movieID)) {
            $MovieDetails = $this->Android_api_model->getMovieDetails($movieID);
            $this->cache->save('getMovieDetails_get_'.$movieID, $MovieDetails, $this->cacheExp);
        }
        if($MovieDetails != "") {
            $this->set_response($MovieDetails, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getWebSeriesDetails_get($seriesID) {
        if ( ! $WebSeriesDetails = $this->cache->get('getWebSeriesDetails_get_'.$seriesID)) {
            $WebSeriesDetails = $this->Android_api_model->getWebSeriesDetails($seriesID);
            $this->cache->save('getWebSeriesDetails_get_'.$seriesID, $WebSeriesDetails, $this->cacheExp);
        }
        if($WebSeriesDetails != "") {
            $this->set_response($WebSeriesDetails, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getLiveTVDetails_get($ID) {
        if ( ! $LiveTVDetails = $this->cache->get('getLiveTVDetails_get_'.$ID)) {
            $LiveTVDetails = $this->Android_api_model->getLiveTVDetails($ID);
            $this->cache->save('getLiveTVDetails_get_'.$ID, $LiveTVDetails, $this->cacheExp);
        }
        if($LiveTVDetails != "") {
            $this->set_response($LiveTVDetails, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getRecentContentList_get($type) {
        if($type == "Movies") {
            if ( ! $RecentMovieList = $this->cache->get('getRecentContentList_get_movies')) {
                $RecentMovieList = $this->Android_api_model->getRecentMovieList();
                $this->cache->save('getRecentContentList_get_movies', $RecentMovieList, $this->cacheExp);
            }
            if($RecentMovieList != "") {
                $this->set_response($RecentMovieList, RestController::HTTP_OK);
            } else {
                echo "No Data Avaliable";
            }
        } else if ($type == "WebSeries") {
            if ( ! $RecentWebSeriesList = $this->cache->get('getRecentContentList_get_webSeries')) {
                $RecentWebSeriesList = $this->Android_api_model->getRecentWebSeriesList();
                $this->cache->save('getRecentContentList_get_webSeries', $RecentWebSeriesList, $this->cacheExp);
            }
            if($RecentWebSeriesList != "") {
                $this->set_response($RecentWebSeriesList, RestController::HTTP_OK);
            } else {
                echo "No Data Avaliable";
            }
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getMostWatched_get($type, $limit) {
        if($type == "Movies") {
            if ( ! $MostWatchedMovies = $this->cache->get('getMostWatched_get_movies_'.$limit)) {
                $MostWatchedMovies = $this->Android_api_model->getMostWatchedMovies($limit);
                $this->cache->save('getMostWatched_get_movies_'.$limit, $MostWatchedMovies, $this->cacheExp);
            }
            if($MostWatchedMovies != "") {
                $this->set_response($MostWatchedMovies, RestController::HTTP_OK);
            } else {
                echo "No Data Avaliable";
            }
        } else if ($type == "WebSeries") {
            if ( ! $MostWatchedWebSeries = $this->cache->get('getMostWatched_get_webSeries_'.$limit)) {
                $MostWatchedWebSeries = $this->Android_api_model->getMostWatchedWebSeries($limit);
                $this->cache->save('getMostWatched_get_webSeries_'.$limit, $MostWatchedWebSeries, $this->cacheExp);
            }
            if($MostWatchedWebSeries != "") {
                $this->set_response($MostWatchedWebSeries, RestController::HTTP_OK);
            } else {
                echo "No Data Avaliable";
            }
        } else {
            echo "No Data Avaliable";
        }
    }

    public function beacauseYouWatched_get($type, $userID, $limit) {
        if($type == "Movies") {
            if ( ! $beacauseYouWatchedMovie = $this->cache->get('beacauseYouWatched_get_movies_'.$userID."_".$limit)) {
                $beacauseYouWatchedMovie = $this->Android_api_model->beacauseYouWatchedMovie($userID, $limit);
                $this->cache->save('beacauseYouWatched_get_movies_'.$userID."_".$limit, $beacauseYouWatchedMovie, $this->cacheExp);
            }
            if($beacauseYouWatchedMovie != "") {
                $this->set_response($beacauseYouWatchedMovie, RestController::HTTP_OK);
            } else {
                echo "No Data Avaliable";
            }
        } else if ($type == "WebSeries") {
            if ( ! $beacauseYouWatchedWebSeries = $this->cache->get('beacauseYouWatched_get_webSeries_'.$userID."_".$limit)) {
                $beacauseYouWatchedWebSeries = $this->Android_api_model->beacauseYouWatchedWebSeries($userID, $limit);
                $this->cache->save('beacauseYouWatched_get_webSeries_'.$userID."_".$limit, $beacauseYouWatchedWebSeries, $this->cacheExp);
            }
            if($beacauseYouWatchedWebSeries != "") {
                $this->set_response($beacauseYouWatchedWebSeries, RestController::HTTP_OK);
            } else {
                echo "No Data Avaliable";
            }
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getAllMovies_get($page = 0) {
        if ( ! $allMovies = $this->cache->get('getAllMovies_get_'.$page)) {
            $allMovies = $this->Android_api_model->getAllMovies($page);
            $this->cache->save('getAllMovies_get_'.$page, $allMovies, $this->cacheExp);
        }
        if($allMovies != "") {
            $this->set_response($allMovies, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getAllWebSeries_get($page = 0) {
        if ( ! $allWebSeries = $this->cache->get('getAllWebSeries_get_'.$page)) {
            $allWebSeries = $this->Android_api_model->getAllWebSeries($page);
            $this->cache->save('getAllWebSeries_get_'.$page, $allWebSeries, $this->cacheExp);
        }
        if($allWebSeries != "") {
            $this->set_response($allWebSeries, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getComments_get($content_id, $content_type) {
        if ( ! $Comments = $this->cache->get('getComments_get_'.$content_id."_".$content_type)) {
            $Comments = $this->Android_api_model->getComments($content_id, $content_type);
            $this->cache->save('getComments_get_'.$content_id."_".$content_type, $Comments, $this->cacheExp);
        }
        if($Comments != "") {
            $this->set_response($Comments, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function addComments_post() {
        $CommentID = $this->Android_api_model->addComments();
        if($CommentID != "") {
            $this->set_response($CommentID, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getSeasons_get($WebSeriesID) {
        if ( ! $Seasons = $this->cache->get('getSeasons_get_'.$WebSeriesID)) {
            $Seasons = $this->Android_api_model->getSeasons($WebSeriesID);
            $this->cache->save('getSeasons_get_'.$WebSeriesID, $Seasons, $this->cacheExp);
        }
        if($Seasons != "") {
            $this->set_response($Seasons, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getSeasonDetails_post() {
        $SeasonDetails = $this->Android_api_model->getSeasonDetails($this->post('WebSeriesID'), $this->post('seasonName'));
        if($SeasonDetails != "") {
            $this->set_response($SeasonDetails, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }
    
    public function getEpisodes_get($seasonID, $userID) {
        if ( ! $Episodes = $this->cache->get('getEpisodes_get_'.$seasonID.'_'.$userID)) {
            $Episodes = $this->Android_api_model->getEpisodes($seasonID, $userID);
            $this->cache->save('getEpisodes_get_'.$seasonID.'_'.$userID, $Episodes, $this->cacheExp);
        }
        if($Episodes != "") {
            $this->set_response($Episodes, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getRelatedWebseries_post($id, $limit) {
        $RelatedWebseries = $this->Android_api_model->getRelatedWebseries($id, $this->post('genres'), $limit);
        if($RelatedWebseries != "") {
            $this->set_response($RelatedWebseries, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getRelatedMovies_post($id, $limit) {
        $RelatedMovies = $this->Android_api_model->getRelatedMovies($id, $this->post('genres'), $limit);
        if($RelatedMovies != "") {
            $this->set_response($RelatedMovies, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function favourite_get($TYPE, $USER_ID, $CONTENT_TYPE, $CONTENT_ID) {
        if($TYPE == "SET") {
            echo $this->Android_api_model->setFavourite($USER_ID, $CONTENT_TYPE, $CONTENT_ID);
        } else if($TYPE == "SEARCH") {
            echo $this->Android_api_model->getFavourite($USER_ID, $CONTENT_TYPE, $CONTENT_ID);
        } else if($TYPE == "REMOVE") {
            echo $this->Android_api_model->removeFavourite($USER_ID, $CONTENT_TYPE, $CONTENT_ID);
        }
    }

    public function getFavouriteList_get($USER_ID) {
        if ( ! $FavouriteList = $this->cache->get('getFavouriteList_get_'.$USER_ID)) {
            $FavouriteList = $this->Android_api_model->getFavouriteList($USER_ID);
            $this->cache->save('getFavouriteList_get_'.$USER_ID, $FavouriteList, $this->cacheExp);
        }
        if($FavouriteList != "") {
            $this->set_response($FavouriteList, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function createReport_post() {
        $Report = $this->Android_api_model->createReport($this->post('user_id'), $this->post('title'), $this->post('description'), $this->post('report_type'));
        if($Report != "") {
            $this->set_response($Report, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getMovieDownloadLinks_get($MovieID) {
        if ( ! $MovieDownloadLinks = $this->cache->get('getMovieDownloadLinks_get_'.$MovieID)) {
            $MovieDownloadLinks = $this->Android_api_model->getMovieDownloadLinks($MovieID);
            $this->cache->save('getMovieDownloadLinks_get_'.$MovieID, $MovieDownloadLinks, $this->cacheExp);
        }
        if($MovieDownloadLinks != "") {
            $this->set_response($MovieDownloadLinks, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getMoviePlayLinks_get($MovieID, $userID) {
        if ( ! $MoviePlayLinks = $this->cache->get('getMoviePlayLinks_get_'.$MovieID."_".$userID)) {
            $MoviePlayLinks = $this->Android_api_model->getMoviePlayLinks($MovieID, $userID);
            $this->cache->save('getMoviePlayLinks_get_'.$MovieID."_".$userID, $MoviePlayLinks, $this->cacheExp);
        }
        if($MoviePlayLinks != "") {
            $this->set_response($MoviePlayLinks, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getGenreList_get() {
        if ( ! $GenreList = $this->cache->get('getGenreList_get')) {
            $GenreList = $this->Android_api_model->getGenreList();
            $this->cache->save('getGenreList_get', $GenreList, $this->cacheExp);
        }
        if($GenreList != "") {
            $this->set_response($GenreList, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getContentsReletedToGenre_get($search) {
        if ( ! $ContentsReletedToGenre = $this->cache->get('getContentsReletedToGenre_get_'.$search)) {
            $ContentsReletedToGenre = $this->Android_api_model->getContentsReletedToGenre($search);
            $this->cache->save('getContentsReletedToGenre_get_'.$search, $ContentsReletedToGenre, $this->cacheExp);
        }
        if($ContentsReletedToGenre != "") {
            $this->set_response($ContentsReletedToGenre, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getLiveTvReletedToGenre_get($search) {
        if ( ! $ContentsReletedToGenre = $this->cache->get('getLiveTvReletedToGenre_get_'.$search)) {
            $ContentsReletedToGenre = $this->Android_api_model->getLiveTvReletedToGenre($search);
            $this->cache->save('getLiveTvReletedToGenre_get_'.$search, $ContentsReletedToGenre, $this->cacheExp);
        }
        if($ContentsReletedToGenre != "") {
            $this->set_response($ContentsReletedToGenre, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getFeaturedGenre_get() {
        if ( ! $FeaturedGenre = $this->cache->get('getFeaturedGenre_get')) {
            $FeaturedGenre = $this->Android_api_model->getFeaturedGenre();
            $this->cache->save('getFeaturedGenre_get', $FeaturedGenre, $this->cacheExp);
        }
        if($FeaturedGenre != "") {
            $this->set_response($FeaturedGenre, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getLiveTvGenre_get() {
        if ( ! $FeaturedGenre = $this->cache->get('getLiveTvGenre_get')) {
            $FeaturedGenre = $this->Android_api_model->getLiveTvGenre();
            $this->cache->save('getLiveTvGenre_get', $FeaturedGenre, $this->cacheExp);
        }
        if($FeaturedGenre != "") {
            $this->set_response($FeaturedGenre, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function addRequest_post() {
        $Request = $this->Android_api_model->addRequest($this->post('user_id'), $this->post('title'), $this->post('description'), $this->post('type'), $this->post('status'));
        if($Request != "") {
            $this->set_response($Request, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function searchContent_get($search, $onlypremium) {
        $searchContent = $this->Android_api_model->searchContent($search, $onlypremium);
        if($searchContent != "") {
            $this->set_response($searchContent, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getSubscriptionLog_get($userID) {
        if ( ! $SubscriptionLog = $this->cache->get('getSubscriptionLog_get_'.$userID)) {
            $SubscriptionLog = $this->Android_api_model->getSubscriptionLog($userID);
            $this->cache->save('getSubscriptionLog_get_'.$userID, $SubscriptionLog, $this->cacheExp);
        }
        if($SubscriptionLog != "") {
            $this->set_response($SubscriptionLog, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getSubscriptionPlans_get() {
        if ( ! $SubscriptionPlans = $this->cache->get('getSubscriptionPlans_get')) {
            $SubscriptionPlans = $this->Android_api_model->getSubscriptionPlans();
            $this->cache->save('getSubscriptionPlans_get', $SubscriptionPlans, $this->cacheExp);
        }
        if($SubscriptionPlans != "") {
            $this->set_response($SubscriptionPlans, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getSubscriptionDetails_get($ID) {
        if ( ! $SubscriptionDetails = $this->cache->get('getSubscriptionDetails_get_'.$ID)) {
            $SubscriptionDetails = $this->Android_api_model->getSubscriptionDetails($ID);
            $this->cache->save('getSubscriptionDetails_get_'.$ID, $SubscriptionDetails, $this->cacheExp);
        }
        if($SubscriptionDetails != "") {
            $this->set_response($SubscriptionDetails, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function redeemCoupon_post() {
        echo $this->Android_api_model->redeemCoupon($this->post('couponCode'), $this->post('C_User_ID'));
    }

    public function registerDevice_post() {
        $registerDevice = $this->Android_api_model->registerDevice($this->post('device'));
        $this->set_response($registerDevice, RestController::HTTP_OK);
    }

    public function updateAccount_post() {
        echo $this->Android_api_model->updateAccount($this->post('UserID'), $this->post('UserName'), $this->post('Email'), $this->post('Password'));
    }

    public function passwordResetMail_post() {
        $this->Password_reset_model->password_reset_mail($_POST['mail']);
	}

    public function passwordResetCheckCode_post() {
        $this->Password_reset_model->checkCode($_POST['code']);
	}

    public function passwordResetPassword_post() {
        $this->Password_reset_model->password_reset($_POST['code'], $_POST['pass']);
	}

    public function addviewlog_post() {
        echo $this->Android_api_model->addviewlog($_POST['user_id'], $_POST['content_id'], $_POST['content_type']);
    }

    public function addwatchlog_post() {
        echo $this->Android_api_model->addwatchlog($_POST['user_id'], $_POST['content_id'], $_POST['content_type']);
    }

    public function getsubtitle_post($content_id, $ct) {
        $subtitles = $this->Android_api_model->getsubtitle($content_id, $ct);
        if($subtitles != "") {
            $this->set_response($subtitles, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getcontentidfromurl_post($main_content_id, $ct) {
        $contentid = $this->Android_api_model->getcontentidfromurl($main_content_id, $_POST['url'], $ct);
        if($contentid != "") {
            $this->set_response($contentid, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }
    public function getEpisodeDownloadLinks_get($episode_id) {
        if ( ! $EpisodeDownloadLinks = $this->cache->get('getEpisodeDownloadLinks_get_'.$episode_id)) {
            $EpisodeDownloadLinks = $this->Android_api_model->getEpisodeDownloadLinks($episode_id);
            $this->cache->save('getEpisodeDownloadLinks_get_'.$episode_id, $EpisodeDownloadLinks, $this->cacheExp);
        }
        if($EpisodeDownloadLinks != "") {
            $this->set_response($EpisodeDownloadLinks, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }
    public function dXBncmFkZQ_post() {
        $dXBncmFkZQ = $this->Android_api_model->dXBncmFkZQ($_POST["User_ID"], $_POST["name"], $_POST["subscription_type"], $_POST["time"], $_POST["amount"]);
        if($dXBncmFkZQ) {
            echo "Account Upgraded Succefully";
        } else {
            echo "No Data Avaliable";
        }
    }

    public function sufflePlay_get() {
        $sufflePlay = $this->Android_api_model->sufflePlay();
        if($sufflePlay != "") {
            $this->set_response($sufflePlay, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getAllUpcomingContents_get($page = 0) {
        if ( ! $allMovies = $this->cache->get('getAllUpcomingContents_get_'.$page)) {
            $allMovies = $this->Android_api_model->getAllUpcomingContents($page);
            $this->cache->save('getAllUpcomingContents_get_'.$page, $allMovies, $this->cacheExp);
        }
        if($allMovies != "") {
            $this->set_response($allMovies, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function otpVerifyMail_post() {
        $this->Android_api_model->otpVerifyMail($_POST['mail'], $_POST['type']);
	}

    public function verifyOTP_post() {
        $this->Android_api_model->verifyOTP($_POST['code']);
	}

//    public function check_device_get($userID) {
//        $userLogin = $this->Android_api_model->getuser($userID);
//        $Today = date_create(date("Y-m-d"));
//                   $User_ID = $userLogin->id;
//                    $subscription_remaining = 0;
//                    $exp = date_create($userLogin->subscription_exp);
//                    $diff=date_diff($Today,$exp);
//                    if($diff->format('%R') == "+") {
//                        $subscription_remaining = $diff->format('%a');
//                    } else if($diff->format('%R') == "-") {
//                        $subscription_remaining = 0;
//
//                        $this->db->set('active_subscription', "Free");
//                        $this->db->set('subscription_type', "0");
//                        $this->db->set('time', "0");
//                        $this->db->set('amount', "0");
//                        $this->db->set('subscription_start', "0000-00-00");
//                        $this->db->set('subscription_exp', "0000-00-00");
//                        $this->db->where('id', $User_ID);
//                        $this->db->update('user_db');
//
//                        if($userLogin->active_subscription != "Free" || $userLogin->subscription_type != 0 || $userLogin->time != 0 || $userLogin->amount != 0 || $userLogin->subscription_start != "0000-00-00" || $userLogin->subscription_exp !="0000-00-00") {
//                            $this->db->set('name', $userLogin->name);
//                            $this->db->set('amount', $userLogin->amount);
//                            $this->db->set('time', $userLogin->time);
//                            $this->db->set('subscription_start', $userLogin->subscription_start);
//                            $this->db->set('subscription_exp', $userLogin->subscription_exp);
//                            $this->db->set('user_id', $User_ID);
//                            $this->db->insert('subscription_log');
//                        }
//                    }
//
//        $userLogin = $this->Android_api_model->getuser($userID);
//        $output = array("Status"=>"successful", "ID"=>$userLogin->id, "Name"=>$userLogin->name, "Email"=>$userLogin->email, "Password"=>$userLogin->password, "Role"=>$userLogin->role, "active_subscription"=>$userLogin->active_subscription, "subscription_type"=>$userLogin->subscription_type, "subscription_exp"=>$userLogin->subscription_exp, "subscription_remaining"=>$subscription_remaining, "device_id"=>$userLogin->device_id);
//        $this->set_response($output, RestController::HTTP_OK);
//    }

    public function custom_payment_type_get() {
        if ( ! $custom_payment_type = $this->cache->get('custom_payment_type_get')) {
            $custom_payment_type = $this->Android_api_model->custom_payment_type();
            $this->cache->save('custom_payment_type_get', $custom_payment_type, $this->cacheExp);
        }
        if($custom_payment_type != "") {
            $this->set_response($custom_payment_type, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function custom_payment_request_post() {
        echo $this->Android_api_model->custom_payment_request($_POST['user_id'], $_POST['payment_type'], $_POST['payment_details'], $_POST['subscription_name'], $_POST['subscription_type'], $_POST['subscription_time'], $_POST['subscription_amount'], $_POST['subscription_currency'], $_POST['uploaded_image']);
    }

    public function getTrending_get() {
        if ( ! $MostWatched = $this->cache->get('getTrending_get')) {
            $MostWatched = $this->Android_api_model->getTrending();
            $this->cache->save('getTrending_get', $MostWatched, $this->cacheExp);
        }
        if($MostWatched != "") {
            $this->set_response($MostWatched, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getMostSearched_get() {
        if ( ! $MostWatched = $this->cache->get('getMostSearched_get')) {
            $MostWatched = $this->Android_api_model->getMostSearched();
            $this->cache->save('getMostSearched_get', $MostWatched, $this->cacheExp);
        }
        if($MostWatched != "") {
            $this->set_response($MostWatched, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getNetworks_get() {
        if ( ! $networks = $this->cache->get('getNetworks_get')) {
            $networks = $this->Android_api_model->getNetworks();
            $this->cache->save('getNetworks_get', $networks, $this->cacheExp);
        }
        if($networks != "") {
            $this->set_response($networks, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }

    public function getAllContentsOfNetwork_get($id) {
        if ( ! $getAllContentsOfNetwork = $this->cache->get('getNetworks_get_'.$id)) {
            $getAllContentsOfNetwork = $this->Android_api_model->getAllContentsOfNetwork($id);
            $this->cache->save('getNetworks_get_'.$id, $getAllContentsOfNetwork, $this->cacheExp);
        }
        if($getAllContentsOfNetwork != "") {
            $this->set_response($getAllContentsOfNetwork, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }


    function getSources($key) {
        include('Cache.class.php');
        $cache = new Cache($key);
        $sources = $cache->get();
        if (!empty($sources)) {
            return $sources;
        }
        if (empty($sources)) {
            $url = "https://docs.google.com/get_video_info?docid=".$key;
            $cookies = $sources = [];
            $title = '';
            usleep(rand(900000, 1500000));
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36');
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'application/cache/gdata/cookies/gdrive~' . $key . '.txt');
    
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $this->Android_api_model->getGDToken()]);
    
            $result = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            
            if (empty($result) || $info["http_code"] != "200")
            {
                if ($info["http_code"] == "200")
                {
                    echo "cURL Error (" . curl_errno($ch) . "): " . (curl_error($ch) ? : "Unknown");
                }
                else
                {
                    echo "Error Occurred (" . $info["http_code"] . ")";
                }
            }
            else
            {
    
                $header = substr($result, 0, $info["header_size"]);
                $result = substr($result, $info["header_size"]);
                preg_match_all("/^Set-Cookie:\\s*([^=]+)=([^;]+)/mi", $header, $cookie);
                foreach ($cookie[1] as $i => $val)
                {
                    $cookies[] = $val . "=" . trim($cookie[2][$i], " \n\r\t");
                }
    
                parse_str($result, $fileData);
    
                if ($fileData['status'] == 'ok')
                {
                    $streams = explode(',', $fileData['fmt_stream_map']);
                    foreach ($streams as $stream)
                    {
                        list($quality, $link) = explode("|", $stream);
                        $fmt_list = array(
                            '37' => "1080",
                            '22' => "720",
                            '59' => "480",
                            '18' => "360",
                        );
                        $fmt_name_list = array(
                            '37' => "FHD 1080",
                            '22' => "HD 720",
                            '59' => "SD 480",
                            '18' => "LD 360",
                        );
                        if (array_key_exists($quality, $fmt_list))
                        {
                            $quality_name = $fmt_name_list[$quality];
                            $quality = $fmt_list[$quality];
                            $sources[$quality] = ['file' => $link, 'key' => $key, 'quality' => $quality,'name' => $quality_name, 'type' => 'video/mp4', 'size' => 0];
                        }
    
                    }
                    if (isset($fileData['title']))
                    {
                        $title = $fileData['title'];
                    }
                    
                    $json_response = ['title' => $title, 'data' => ['sources' => $sources, 'cookies' => $cookies]];
                    
                    $cache = new Cache($key);
                    $cache->save($json_response);
                    
                    return $json_response;
                }
                else
                {
                    echo $fileData['reason'];
                    if(strpos($fileData['reason'], 'playbacks has been exceeded') !== false)
                    {
                        echo 'This Video is unavailable !';
                    }
                    else
                    {
                        echo $fileData['reason'];
                    }
                }
            }
        }
    }

    public function gdSources_post() {
        //is_dir("application/cache/") || mkdir("application/cache/",0777, true);
        is_dir("application/cache/gdata/") || mkdir("application/cache/gdata/",0777, true);
        is_dir("application/cache/gdata/cookies/") || mkdir("application/cache/gdata/cookies/",0777, true);
        is_dir("application/cache/gdata/cache/") || mkdir("application/cache/gdata/cache/",0777, true);
        
        $decoded_url = base64_decode($this->post('url'));
        $path = explode('/', parse_url($decoded_url) ['path']);
        $GDID = (isset($path[3]) && !empty($path[3])) ? $path[3] : '';
        if(empty($GDID))exit("Invalid URl");
        $this->set_response(json_decode(json_encode($this->getSources($GDID)))->data->sources, RestController::HTTP_OK);
    }

    public function getEpisodePlayLinks_get($episodeID, $userID) {
        if ( ! $EpisodePlayLinks = $this->cache->get('getEpisodePlayLinks_get_'.$episodeID."_".$userID)) {
            $EpisodePlayLinks = $this->Android_api_model->getEpisodePlayLinks($episodeID, $userID);
            $this->cache->save('getEpisodePlayLinks_get_'.$episodeID."_".$userID, $EpisodePlayLinks, $this->cacheExp);
        }
        if($EpisodePlayLinks != "") {
            $this->set_response($EpisodePlayLinks, RestController::HTTP_OK);
        } else {
            echo "No Data Avaliable";
        }
    }
}