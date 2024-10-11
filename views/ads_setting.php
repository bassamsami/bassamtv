<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">

    <head>
    
        <meta charset="utf-8">
        <title>Dashboard | Dooo - Movie & Web Series Portal App</title>

        <?php include("partials/header.php"); ?>
    
    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php include("partials/topbar.php"); ?>

            
            <?php include("partials/sidebar.php"); ?>
            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

            	<div class="page-content">

            		<div class="container-fluid">



            			<!-- start page title -->

            			<div class="row align-items-center">

            				<div class="col-sm-6">

            					<div class="page-title-box">

            						<h4 class="font-size-18">ADS Setting</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>

            							<li class="breadcrumb-item active">ADS Setting</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="card card-body">
                        			<form method="post">
                        				<h3 class="card-title mt-0">AD SETTING</h3>
                        				<hr>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Ads Network</label>
                        					<div class="col-sm-3 ">
                        						<select class="form-control form-select" id="mobile_ads_network_Controll" name="ad_type">
                        							<option value="0">Disable</option>
                        							<option value="1">AdMob</option>
                        							<option value="2">StartApp</option>
                        							<option value="3">Facebook</option>
                        							<option value="4">AdColony</option>
                        							<option value="5">UnityAds</option>
                        							<option value="6">CustomAds</option>
													<option value="7">AppLovin</option>
													<option value="8">IronSource</option>
                        						</select>
                        					</div>
                        				</div>

                        				<br>
                        				<br>
                        				<strong>Admob</strong>
                        				<hr>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Admob Publisher ID</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->Admob_Publisher_ID; ?>" data-parsley-minlength="10"
                        							id="admob_publisher_id" name="Admob_Publisher_ID" class="form-control">
                        					</div>
                        				</div>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Admob APP ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->Admob_APP_ID; ?>"
                        							data-parsley-minlength="10" id="admob_app_id" name="Admob_APP_ID"
                        							class="form-control">
                        					</div>
                        				</div>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Admob Banner Ad ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->adMob_Banner; ?>"
                        							data-parsley-minlength="10" id="admob_banner_ads_id"
                        							name="adMob_Banner" class="form-control">
                        					</div>
                        				</div>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Admob Interstitial Ad ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->adMob_Interstitial; ?>"
                        							data-parsley-minlength="10" id="admob_interstitial_ads_id"
                        							name="adMob_Interstitial" class="form-control">
                        					</div>
                        				</div>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Admob Native Ad ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->adMob_Native; ?>"
                        							data-parsley-minlength="10" id="admob_native_ads_id"
                        							name="adMob_Native" class="form-control">
                        					</div>
                        				</div>
										<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Admob AppOpen Ad ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->adMob_AppOpenAd; ?>"
                        							data-parsley-minlength="10" id="admob_appopen_ads_id"
                        							name="adMob_appopen" class="form-control">
                        					</div>
                        				</div>

                        				<br>
                        				<br>
                        				<strong>Facebook</strong>
                        				<hr>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Facebook APP ID</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->facebook_app_id; ?>" data-parsley-minlength="10"
                        							id="facebook_app_id" name="facebook_app_id" class="form-control">
                        					</div>
                        				</div>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Facebook Banner Ads Placement ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->facebook_banner_ads_placement_id; ?>"
                        							data-parsley-minlength="10" id="facebook_banner_ads_placement_id"
                        							name="facebook_banner_ads_placement_id" class="form-control">
                        					</div>
                        				</div>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Facebook Interstitial Ads Placement
                        						ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->facebook_interstitial_ads_placement_id; ?>"
                        							data-parsley-minlength="10" id="facebook_interstitial_ads_placement_id"
                        							name="facebook_interstitial_ads_placement_id" class="form-control">
                        					</div>
                        				</div>

                        				<br>
                        				<br>
                        				<strong>StartApp</strong>
                        				<hr>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">StartApp App ID</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->StartApp_App_ID; ?>" data-parsley-minlength="8"
                        							id="startapp_app_id" name="StartApp_App_ID" class="form-control">
                        					</div>
                        				</div>

                        				<br>
                        				<br>
                        				<strong>AdColony</strong>
                        				<hr>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">AdColony App ID</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->AdColony_app_id; ?>" data-parsley-minlength="8"
                        							id="AdColony_app_id" name="AdColony_app_id" class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Banner Zone ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->AdColony_banner_zone_id; ?>" data-parsley-minlength="8"
                        							id="AdColony_BANNER_ZONE_ID" name="AdColony_BANNER_ZONE_ID"
                        							class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Interstitial Zone ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->AdColony_interstitial_zone_id; ?>" data-parsley-minlength="8"
                        							id="AdColony_INTERSTITIAL_ZONE_ID" name="AdColony_INTERSTITIAL_ZONE_ID"
                        							class="form-control">
                        					</div>
                        				</div>

                        				<br>
                        				<br>
                        				<strong>Unity Ads</strong>
                        				<hr>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">UnityAds Game ID</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->unity_game_id; ?>" data-parsley-minlength="8"
                        							id="UnityAds_game_id" name="UnityAds_game_id" class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Banner Zone ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->unity_banner_id; ?>" data-parsley-minlength="8"
                        							id="UnityAds_BANNER_ID" name="UnityAds_BANNER_ID" class="form-control">
                        					</div>
                        				</div>

										<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Interstitial/Rewarded Zone ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->unity_interstitial_id; ?>" data-parsley-minlength="8"
                        							id="UnityAds_Interstitial_ID" name="UnityAds_Interstitial_ID" class="form-control">
                        					</div>
                        				</div>

                        				<br>
                        				<br>
                        				<strong>Custom Ads</strong>
                        				<hr>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Custom Banner Url</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->custom_banner_url; ?>" data-parsley-minlength="8"
                        							id="Custom_Banner_Url" name="Custom_Banner_Url" class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Custom Banner Click Url Type</label>
                        					<div class="col-sm-3 ">
                        						<select class="form-control form-select" id="Custom_Banner_Click_Url_Type" name="Custom_Banner_Click_Url_Type">
                        							<option value="0">None</option>
                        							<option value="1">External Browser</option>
                        							<option value="2">Internal Browser</option>
                        						</select>
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Custom Banner Click Url</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->custom_banner_click_url; ?>" data-parsley-minlength="8"
                        							id="Custom_Banner_Click_Url" name="Custom_Banner_Click_Url"
                        							class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Custom Interstitial Url</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->custom_interstitial_url; ?>" data-parsley-minlength="8"
                        							id="Custom_Interstitial_Url" name="Custom_Interstitial_Url"
                        							class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Custom Interstitial Click Url Type</label>
                        					<div class="col-sm-3 ">
                        						<select class="form-control form-select"
                        							id="Custom_Interstitial_Click_Url_Type" name="Custom_Interstitial_Click_Url_Type">
                        							<option value="0">None</option>
                        							<option value="1">External Browser</option>
                        							<option value="2">Internal Browser</option>
                        						</select>
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Custom Interstitial Click Url</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->custom_interstitial_click_url; ?>" data-parsley-minlength="8"
                        							id="Custom_Interstitial_Click_Url" name="Custom_Interstitial_Click_Url"
                        							class="form-control">
                        					</div>
                        				</div>
										<br>
                        				<br>
                        				<strong>AppLovin Ads</strong>
                        				<hr>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Applovin Sdk Key</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->applovin_sdk_key; ?>" data-parsley-minlength="8"
                        							id="applovin_sdk_key" name="applovin_sdk_key" class="form-control">
                        					</div>
                        				</div>

                        				<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Applovin ApiKey</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->applovin_apiKey; ?>" data-parsley-minlength="8"
                        							id="applovin_apiKey" name="applovin_apiKey" class="form-control">
                        					</div>
                        				</div>

										<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Applovin Banner ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->applovin_Banner_ID; ?>" data-parsley-minlength="8"
                        							id="applovin_Banner_ID" name="applovin_Banner_ID" class="form-control">
                        					</div>
                        				</div>

										<br>

                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">Applovin Interstitial ID</label>
                        					<div class="col-sm-6">
                        						<input type="text" value="<?php echo $config->applovin_Interstitial_ID; ?>" data-parsley-minlength="8"
                        							id="applovin_Interstitial_ID" name="applovin_Interstitial_ID" class="form-control">
                        					</div>
                        				</div>

										<br>
                        				<br>
                        				<strong>IronSource Ads</strong>
                        				<hr>
                        				<div class="form-group row mb-3">
                        					<label class="col-sm-3 control-label">IronSource App Key</label>
                        					<div class="col-sm-3">
                        						<input type="text" value="<?php echo $config->ironSource_app_key; ?>" data-parsley-minlength="8"
                        							id="ironSource_app_key" name="ironSource_app_key" class="form-control">
                        					</div>
                        				</div>


                        				<br>

                        				<div class="form-group mb-3 row justify-content-end">
                        					<div class="col-md-1">
                        						<button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                        							id="create_btn" type="submit" name="ads_setting" value="ads_setting" aria-haspopup="true"
                        							aria-expanded="false">
                        							<i class="mdi mdi-content-save-all"></i> Save
                        						</button>
                        					</div>
                        				</div>
                        			</form>
                        		</div>
                        	</div>
                        </div>
            			

            		</div> <!-- container-fluid -->

            	</div>


            	<?php include("partials/footer_rights.php"); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>

    <script>
        $( document ).ready(function() {
            var ad_type = '<?php echo $config->ad_type; ?>';
            if (ad_type == "0") {
                $("#mobile_ads_network_Controll").val("0");
            } else if (ad_type == "1") {
                $("#mobile_ads_network_Controll").val("1");
            } else if (ad_type == "2") {
                $("#mobile_ads_network_Controll").val("2");
            } else if (ad_type == "3") {
                $("#mobile_ads_network_Controll").val("3");
            } else if (ad_type == "4") {
                $("#mobile_ads_network_Controll").val("4");
            } else if (ad_type == "5") {
                $("#mobile_ads_network_Controll").val("5");
            } else if (ad_type == "6") {
                $("#mobile_ads_network_Controll").val("6");
			} else if (ad_type == "7") {
                $("#mobile_ads_network_Controll").val("7");
			} else if (ad_type == "8") {
                $("#mobile_ads_network_Controll").val("8");
            }else {
                $("#mobile_ads_network_Controll").val("0");
            }

            var Custom_Banner_Click_Url_Type_count = '<?php echo $config->custom_banner_click_url_type; ?>';
            if(Custom_Banner_Click_Url_Type_count == 0) {
                $("#Custom_Banner_Click_Url_Type").val("0");
            } else if(Custom_Banner_Click_Url_Type_count == 1) {
                $("#Custom_Banner_Click_Url_Type").val("1");
            } else if(Custom_Banner_Click_Url_Type_count == 2) {
                $("#Custom_Banner_Click_Url_Type").val("2");
            }

            var Custom_Interstitial_Click_Url_Type_count = '<?php echo $config->custom_interstitial_click_url_type; ?>';
            if(Custom_Interstitial_Click_Url_Type_count == 0) {
                $("#Custom_Interstitial_Click_Url_Type").val("0");
            } else if(Custom_Interstitial_Click_Url_Type_count == 1) {
                $("#Custom_Interstitial_Click_Url_Type").val("1");
            } else if(Custom_Interstitial_Click_Url_Type_count == 2) {
                $("#Custom_Interstitial_Click_Url_Type").val("2");
            }

			if('<?php if($this->session->flashdata('success') != "") {echo true;} else { echo false;} ?>') {
				swal.fire({
                    title: 'Successful!',
                    text: "<?php echo $this->session->flashdata('success'); ?>",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#556ee6',
                    cancelButtonColor: "#f46a6a"
                }).then(function () {
                    location.reload();
                });
			}
			if('<?php if($this->session->flashdata('error') != "") {echo true;} else { echo false;} ?>') {
				swal.fire({
                    title: 'Error',
                    text: "<?php echo $this->session->flashdata('error'); ?>",
                    icon: 'error'
                }).then(function () {
                    location.reload();
                });
			}
        });

    </script>