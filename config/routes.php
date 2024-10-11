<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//extras
$route['android/splash'] = 'Extras/splash';

$route['index'] = 'admin';
$route['login'] = 'admin/login';
$route['logout'] = 'admin/logout';
$route['recoverpw'] = 'admin/recoverpw';
$route['changepass'] = 'admin/changepass';

$route['api_setting'] = 'admin/api_setting';
$route['privacy_policy'] = 'admin/privacy_policy';
$route['terms_and_conditions'] = 'admin/terms_and_conditions';
$route['db_manager'] = 'admin/db_manager';
$route['db_import'] = 'admin/db_import';
$route['db_export'] = 'admin/db_export';
$route['slider_settings'] = 'admin/slider_settings';
$route['add_movie'] = 'admin/add_movie';
$route['movie_link_manager/(:num)'] = 'admin/movie_link_manager/$1';
$route['all_movies'] = 'admin/all_movies';
$route['editMovie/(:num)'] = 'admin/editMovie/$1';
$route['android_setting'] = 'admin/android_setting';
$route['dashboard_setting'] = 'admin/dashboard_setting';
$route['ads_setting'] = 'admin/ads_setting';
$route['email_setting'] = 'admin/email_setting';
$route['custom_slider'] = 'admin/custom_slider';
$route['report_manager'] = 'admin/report_manager';
$route['request_manager'] = 'admin/request_manager';
$route['manage_user'] = 'admin/manage_user';
$route['telegram_setting'] = 'admin/telegram_setting';
$route['telegram_announcement'] = 'admin/telegram_announcement';
$route['payment_gateways'] = 'admin/payment_gateways';
$route['custom_gateways'] = 'admin/custom_gateways';
$route['sub_setting'] = 'admin/sub_setting';
$route['sub_request'] = 'admin/sub_request';
$route['genres'] = 'admin/genres';
$route['sub_plan'] = 'admin/sub_plan';
$route['coupon_manager'] = 'admin/coupon_manager';
$route['notification_setting'] = 'admin/notification_setting';
$route['notification_external_browser'] = 'admin/notification_external_browser';
$route['notification_web_view'] = 'admin/notification_web_view';
$route['announcement'] = 'admin/announcement';
$route['notification_movie'] = 'admin/notification_movie';
$route['notification_web_series'] = 'admin/notification_web_series';
$route['manage_movie_links/(:num)'] = 'admin/manage_movie_links/$1';
$route['subtitle_manager/(:num)/(:num)'] = 'admin/subtitle_manager/$1/$2';
$route['search_movie'] = 'admin/search_movie';
$route['search_webseries'] = 'admin/search_webseries';
$route['add_bulk_movie'] = 'admin/add_bulk_movie';
$route['add_bulk_webseries'] = 'admin/add_bulk_webseries';
$route['all_channels'] = 'admin/all_channels';
$route['all_web_series'] = 'admin/all_web_series';
$route['add_channel'] = 'admin/add_channel';
$route['edit_channel/(:num)'] = 'admin/edit_channel/$1';
$route['add_web_series'] = 'admin/add_web_series';
$route['edit_webSeries/(:num)'] = 'admin/edit_webSeries/$1';
$route['manage_seasons/(:num)'] = 'admin/manage_seasons/$1';
$route['manage_episodes/(:num)'] = 'admin/manage_episodes/$1';
$route['manage_episode_links/(:num)'] = 'admin/manage_episode_links/$1';
$route['update'] = 'admin/update';
$route['cron_setting'] = 'admin/cron_setting';
$route['scrap_gogoanime'] = 'admin/scrap_gogoanime';
$route['live_tv_genres'] = 'admin/live_tv_genres';
$route['add_upcoming_contents'] = 'admin/add_upcoming_contents';
$route['all_upcoming_contents'] = 'admin/all_upcoming_contents';
$route['edit_upcoming_contents/(:num)'] = 'admin/edit_upcoming_contents/$1';
$route['publish_all/(:num)'] = 'admin/publish_all/$1';
$route['content_networks'] = 'admin/content_networks';
$route['scrap_topcinema'] = 'admin/scrap_topcinema';
$route['google_drive'] = 'admin/google_drive';
$route['custom_tags'] = 'admin/custom_tags';
$route['email_templates'] = 'admin/email_templates';

//Web View
$route['privacy_policy/webview'] = 'webview/privacy_policy_webview';
$route['terms_and_conditions/webview'] = 'webview/terms_and_conditions_webview';

///User APi
$route['android/get_config'] = 'RestApi/Android/Android_api/appConfig';
$route['android/dmVyaWZ5'] = 'RestApi/Android/Android_api/dmVyaWZ5';
$route['android/authentication'] = 'RestApi/Android/Android_api/authentication';
$route['android/getCustomImageSlider'] = 'RestApi/Android/Android_api/getCustomImageSlider';
$route['android/getMovieImageSlider'] = 'RestApi/Android/Android_api/getMovieImageSlider';
$route['android/getWebSeriesImageSlider'] = 'RestApi/Android/Android_api/getWebSeriesImageSlider';
$route['android/getFeaturedLiveTV'] = 'RestApi/Android/Android_api/getFeaturedLiveTV';
$route['android/getAllLiveTV'] = 'RestApi/Android/Android_api/getAllLiveTV';
$route['android/searchLiveTV'] = 'RestApi/Android/Android_api/searchLiveTV';
$route['android/getRandMovies'] = 'RestApi/Android/Android_api/getRandMovies';
$route['android/getRandWebSeries'] = 'RestApi/Android/Android_api/getRandWebSeries';
$route['android/getMovieDetails/(:num)'] = 'RestApi/Android/Android_api/getMovieDetails/$1';
$route['android/getWebSeriesDetails/(:num)'] = 'RestApi/Android/Android_api/getWebSeriesDetails/$1';
$route['android/getLiveTVDetails/(:num)'] = 'RestApi/Android/Android_api/getLiveTVDetails/$1';
$route['android/getRecentContentList/(:any)'] = 'RestApi/Android/Android_api/getRecentContentList/$1';
$route['android/getMostWatched/(:any)/(:num)'] = 'RestApi/Android/Android_api/getMostWatched/$1/$2';
$route['android/beacauseYouWatched/(:any)/(:any)/(:num)'] = 'RestApi/Android/Android_api/beacauseYouWatched/$1/$2/$3';
$route['android/getAllMovies'] = 'RestApi/Android/Android_api/getAllMovies';
$route['android/getAllMovies/(:num)'] = 'RestApi/Android/Android_api/getAllMovies/$1';
$route['android/getAllWebSeries'] = 'RestApi/Android/Android_api/getAllWebSeries';
$route['android/getAllWebSeries/(:num)'] = 'RestApi/Android/Android_api/getAllWebSeries/$1';
$route['android/getComments/(:num)/(:num)'] = 'RestApi/Android/Android_api/getComments/$1/$2';
$route['android/addComments'] = 'RestApi/Android/Android_api/addComments';
$route['android/getSeasons/(:num)'] = 'RestApi/Android/Android_api/getSeasons/$1';
$route['android/getSeasonDetails'] = 'RestApi/Android/Android_api/getSeasonDetails';
$route['android/getEpisodes/(:num)/(:num)'] = 'RestApi/Android/Android_api/getEpisodes/$1/$2';
$route['android/getRelatedWebseries/(:num)/(:num)'] = 'RestApi/Android/Android_api/getRelatedWebseries/$1/$2';
$route['android/getRelatedMovies/(:num)/(:num)'] = 'RestApi/Android/Android_api/getRelatedMovies/$1/$2';
$route['android/favourite/(:any)/(:any)/(:any)/(:num)'] = 'RestApi/Android/Android_api/favourite/$1/$2/$3/$4';
$route['android/getFavouriteList/(:any)'] = 'RestApi/Android/Android_api/getFavouriteList/$1';
$route['android/createReport'] = 'RestApi/Android/Android_api/createReport';
$route['android/getMovieDownloadLinks/(:num)'] = 'RestApi/Android/Android_api/getMovieDownloadLinks/$1';
$route['android/getMoviePlayLinks/(:num)/(:num)'] = 'RestApi/Android/Android_api/getMoviePlayLinks/$1/$2';
$route['android/getGenreList'] = 'RestApi/Android/Android_api/getGenreList';
$route['android/getContentsReletedToGenre/(:any)'] = 'RestApi/Android/Android_api/getContentsReletedToGenre/$1';
$route['android/getFeaturedGenre'] = 'RestApi/Android/Android_api/getFeaturedGenre';
$route['android/addRequest'] = 'RestApi/Android/Android_api/addRequest';
$route['android/searchContent/(:any)/(:num)'] = 'RestApi/Android/Android_api/searchContent/$1/$2';
$route['android/getSubscriptionLog/(:num)'] = 'RestApi/Android/Android_api/getSubscriptionLog/$1';
$route['android/getSubscriptionPlans'] = 'RestApi/Android/Android_api/getSubscriptionPlans';
$route['android/getSubscriptionDetails/(:num)'] = 'RestApi/Android/Android_api/getSubscriptionDetails/$1';
$route['android/redeemCoupon'] = 'RestApi/Android/Android_api/redeemCoupon';
$route['android/registerDevice'] = 'RestApi/Android/Android_api/registerDevice';
$route['android/updateAccount'] = 'RestApi/Android/Android_api/updateAccount';
$route['android/passwordResetMail'] = 'RestApi/Android/Android_api/passwordResetMail';
$route['android/passwordResetCheckCode'] = 'RestApi/Android/Android_api/passwordResetCheckCode';
$route['android/passwordResetPassword'] = 'RestApi/Android/Android_api/passwordResetPassword';
$route['android/addwatchlog'] = 'RestApi/Android/Android_api/addwatchlog';
$route['android/addviewlog'] = 'RestApi/Android/Android_api/addviewlog';
$route['android/getsubtitle/(:any)/(:any)'] = 'RestApi/Android/Android_api/getsubtitle/$1/$2';
$route['android/getcontentidfromurl/(:any)/(:any)'] = 'RestApi/Android/Android_api/getcontentidfromurl/$1/$2';
$route['android/getEpisodeDownloadLinks/(:num)'] = 'RestApi/Android/Android_api/getEpisodeDownloadLinks/$1';
$route['android/dXBncmFkZQ'] = 'RestApi/Android/Android_api/dXBncmFkZQ';
$route['android/getLiveTvGenreList'] = 'RestApi/Android/Android_api/getLiveTvGenre';
$route['android/getLiveTvReletedToGenre/(:any)'] = 'RestApi/Android/Android_api/getLiveTvReletedToGenre/$1';
$route['android/sufflePlay'] = 'RestApi/Android/Android_api/sufflePlay';
$route['android/getAllUpcomingContents'] = 'RestApi/Android/Android_api/getAllUpcomingContents';
$route['android/getAllUpcomingContents/(:num)'] = 'RestApi/Android/Android_api/getAllUpcomingContents/$1';
$route['android/otpVerifyMail'] = 'RestApi/Android/Android_api/otpVerifyMail';
$route['android/verifyOTP'] = 'RestApi/Android/Android_api/verifyOTP';
//$route['android/check_device/(:num)'] = 'RestApi/Android/Android_api/check_device/$1';
$route['android/custom_payment_type'] = 'RestApi/Android/Android_api/custom_payment_type';
$route['android/custom_payment_request'] = 'RestApi/Android/Android_api/custom_payment_request';
$route['android/getTrending'] = 'RestApi/Android/Android_api/getTrending';
$route['android/getMostSearched'] = 'RestApi/Android/Android_api/getMostSearched';
$route['android/getNetworks'] = 'RestApi/Android/Android_api/getNetworks';
$route['android/getAllContentsOfNetwork/(:num)'] = 'RestApi/Android/Android_api/getAllContentsOfNetwork/$1';
$route['android/gdSources'] = 'RestApi/Android/Android_api/gdSources';
$route['android/imageProxy/(:any)'] = 'RestApi/Android/Proxy/imageProxy/$1';

$route['android/getEpisodePlayLinks/(:num)/(:num)'] = 'RestApi/Android/Android_api/getEpisodePlayLinks/$1/$2';


//Google Drive Stream
$route['android/gdstream/(:any)/(:any)'] = 'RestApi/Android/Gdstream/stream/$1/$2';