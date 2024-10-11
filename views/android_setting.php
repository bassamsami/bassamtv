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

            						<h4 class="font-size-18">Android Setting</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Android Setting</a></li>

            							<li class="breadcrumb-item active">Android Setting</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->

						<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Setting</h4>
                                        <p class="card-title-desc">Modify as you need</p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom mb-3" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#android_setting" role="tab" aria-selected="true" tabindex="0">
                                                    <span class="d-none d-md-block">Android Setting</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#login_setting" role="tab" aria-selected="false" tabindex="1">
                                                    <span class="d-none d-md-block">Auth Setting</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#safe_mode" role="tab" aria-selected="false" tabindex="2">
                                                    <span class="d-none d-md-block">Safe Mode</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#content_setting" role="tab" aria-selected="false" tabindex="3">
                                                    <span class="d-none d-md-block">Content Setting</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#comment_settings" role="tab" aria-selected="false" tabindex="4">
                                                    <span class="d-none d-md-block">Comment Settings</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#message_setting" role="tab" aria-selected="false" tabindex="5">
                                                    <span class="d-none d-md-block">Message Setting</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#android_update" role="tab" aria-selected="false" tabindex="6">
                                                    <span class="d-none d-md-block">Android Update</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#onscreen_effects" role="tab" aria-selected="false" tabindex="7">
                                                    <span class="d-none d-md-block">OnScreen Effects</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#content_item_ui" role="tab" aria-selected="false" tabindex="8">
                                                    <span class="d-none d-md-block">Content Item UI</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#splash_screen_ui" role="tab" aria-selected="false" tabindex="9">
                                                    <span class="d-none d-md-block">Splash Screen UI</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#pin_lock_setting" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">Pin Lock Setting</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<!-- <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#default_stream" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">Default Stream</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li> -->
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#otp_system" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">OTP System</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#disposable_emails" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">Disposable Emails</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
											<li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#embed_custom_error" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">Embed Custom Error</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#player_setting" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">Player Settings</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#image_settings" role="tab" aria-selected="false" tabindex="10">
                                                    <span class="d-none d-md-block">Image Settings</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content" id="setting_tabs">
                                            <div class="tab-pane p-3 active show" id="android_setting" role="tabpanel">
											    <form method="post">

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">App Name</label>
                                            			<div class="col-sm-6">
                                            				<input type="text" value="" name="apk_name" id="apk_name"
                                            					placeholder="Ex: Dooo" class="form-control">
                                            			</div>
                                            		</div>

													<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">App Logo</label>
                                            			<div class="col-sm-6">
                                            				<input type="text" value="" name="apk_logo" id="apk_logo"
                                            					placeholder="" class="form-control">
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">Package Name</label>
                                            			<div class="col-sm-6">
                                            				<input type="text" value="" name="package_name"
                                            					id="package_name" placeholder="Ex: com.dooo.android"
                                            					class="form-control">
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Login Mandatory?</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="login_mandatory_bool"
                                            						name="login_mandatory_bool">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>
                                            		<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Maintenance</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="maintenance_bool" name="maintenance_bool">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">All Live TV Type</label>
                                            			<div class="col-sm-3 ">
                                            				<select class="form-control form-select"
                                            					id="All_Live_TV_Type" name="All_Live_TV_Type">
                                            					<option value="0">Default</option>
                                            					<option value="1">Free</option>
                                            					<option value="2">Premium</option>
                                            				</select>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">All Movies Type</label>
                                            			<div class="col-sm-3 ">
                                            				<select class="form-control form-select"
                                            					id="All_Movies_Type" name="All_Movies_Type">
                                            					<option value="0">Default</option>
                                            					<option value="1">Free</option>
                                            					<option value="2">Premium</option>
                                            				</select>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">All Series Type</label>
                                            			<div class="col-sm-3 ">
                                            				<select class="form-control form-select"
                                            					id="All_Series_Type" name="All_Series_Type">
                                            					<option value="0">Default</option>
                                            					<option value="1">Free</option>
                                            					<option value="2">Premium</option>
                                            				</select>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">LiveTV Visiable in
                                            				Home</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="LiveTV_Visiable_in_Home_bool"
                                            						name="LiveTV_Visiable_in_Home_bool">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Genre List Visiable in
                                            				Home</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="genreList_Visiable_in_Home_bool"
                                            						name="genreList_Visiable_in_Home_bool">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">Primery Theme
                                            				Color</label>
                                            			<div class="col-sm-3 ">
                                            				<input type="text" class="form-control"
                                            					id="primeryThemeColor" name="primeryThemeColor"
                                            					value="#DF4674">
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">Region Blocker</label>
                                            			<div class="col-sm-3">
                                            				<select class="select2 form-control select2-multiple"
                                            					multiple="" id="blocked_regions"
                                            					name="blocked_regions[]" multiple="multiple" multiple
                                            					data-placeholder="Choose ...">
                                            					<?php include("partials/source/country_code_list.php"); ?>
                                            				</select>
                                            			</div>
                                            		</div>

                                            		<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Onboarding Status</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="onboarding_status" name="onboarding_status">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

													<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Single Account Single Device</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="SASD_status" name="SASD_status">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

													<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Live Tv Genre List Visiable in
                                            				Home</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="livetv_genreList_Visiable_in_Home_bool"
                                            						name="livetv_genreList_Visiable_in_Home_bool">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

													<div class="form-group row mb-3">
                                            			<label class="control-label col-sm-3 ">Home Bottom Floting Menu Status</label>
                                            			<div class="col-sm-6">
                                            				<label class="switch">
                                            					<input type="checkbox" class="toggleclass"
                                            						id="home_bottom_floting_menu_status_bool"
                                            						name="home_bottom_floting_menu_status_bool">
                                            					<span class="slider round"></span>
                                            				</label>
                                            			</div>
                                            		</div>

													<div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">Default Download Manager (internal)</label>
                                            			<div class="col-sm-3 ">
                                            				<select class="form-control form-select"
                                            					id="download_manager" name="download_manager">
                                            					<option value="0">Dooo Download Manager (DDM)</option>
                                            					<option value="1">Advance Download Manager (ADM)</option>
                                            				</select>
                                            			</div>
                                            		</div>

                                            		<div class="form-group mb-3 row justify-content-end">

                                            			<div class="col-md-1">

                                            				<button
                                            					class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                            					id="create_btn" type="submit" name="androidSetting"
                                            					value="androidSetting" aria-haspopup="true"
                                            					aria-expanded="false">

                                            					<i class="mdi mdi-content-save-all"></i> SAVE

                                            				</button>

                                            			</div>

                                            		</div>

                                                </form>
                                            </div>

                                            <div class="tab-pane p-3" id="login_setting" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">Google Login</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="google_login_bool"
											    					name="google_login_bool">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>

											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="loginSetting" value="loginSetting" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

                                            <div class="tab-pane p-3" id="safe_mode" role="tabpanel">
                                                <form method="post">
                                                	<div class="form-group row mb-3">
                                                		<label class="col-sm-3 control-label">App Versions</label>
                                                		<div class="col-sm-6">
                                                			<select class="select2 form-control select2-multiple"
                                                				multiple="" id="safeMode_versions"
                                                				name="safeMode_versions[]" multiple="multiple" multiple
                                                				data-placeholder="Add ...">
                                                			</select>
                                                			<p><small>Leave Empty To apply to all Versions.</small></p>
                                                		</div>
                                                	</div>

                                                	<div class="form-group row mb-3">
                                                		<label class="control-label col-sm-3 ">Safe Mode</label>
                                                		<div class="col-sm-6">
                                                			<label class="switch">
                                                				<input type="checkbox" class="toggleclass"
                                                					id="safe_mode_bool" name="safe_mode_bool">
                                                				<span class="slider round"></span>
                                                			</label>
                                                		</div>
                                                	</div>

                                                	<div class="form-group mb-3 row justify-content-end">
                                                		<div class="col-md-1">
                                                			<button
                                                				class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                				id="safeMode" type="submit" name="safeMode"
                                                				value="safeMode" aria-haspopup="true"
                                                				aria-expanded="false">
                                                				<i class="mdi mdi-content-save-all"></i> SAVE
                                                			</button>
                                                		</div>
                                                	</div>
                                                </form>
                                            </div>

                                            <div class="tab-pane p-3" id="content_setting" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">shuffle contents</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="shuffle_contents_bool"
											    					name="shuffle_contents_bool">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">

											    		<label class="control-label col-md-3">Home Rand Max Movie Show</label>
											    		<div class="col-sm-6">
											    			<input class="form-control" type="number" value="0" id="Home_Rand_Max_Movie_Show"
											    				name="Home_Rand_Max_Movie_Show">
											    		</div>
											    	</div>
											    	<div class="form-group row mb-3">

											    		<label class="control-label col-md-3">Home Rand Max Series Show</label>
											    		<div class="col-sm-6">
											    			<input class="form-control" type="number" value="0" id="Home_Rand_Max_Series_Show"
											    				name="Home_Rand_Max_Series_Show">
											    		</div>

											    	</div>
											    	<div class="form-group row mb-3">

											    		<label class="control-label col-md-3">Home Recent Max Movie Show</label>
											    		<div class="col-sm-6">
											    			<input class="form-control" type="number" value="0" id="Home_Recent_Max_Movie_Show"
											    				name="Home_Recent_Max_Movie_Show">
											    		</div>

											    	</div>
											    	<div class="form-group row mb-3">

											    		<label class="control-label col-md-3">Home Recent Max Series Show</label>
											    		<div class="col-sm-6">
											    			<input class="form-control" type="number" value="0" id="Home_Recent_Max_Series_Show"
											    				name="Home_Recent_Max_Series_Show">
											    		</div>

											    	</div>

											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="contentSetting" value="contentSetting" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="comment_settings" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">Movies Comment</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="moviesComment" name="moviesComment">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>
											    	<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">WebSeries Comment</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="webSeriesComment" name="webSeriesComment">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>


											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="commentSettings" value="commentSettings" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="message_setting" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">Show Message</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="Show_Message_bool"
											    					name="Show_Message_bool">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Message Animation (<a href="https://lottiefiles.com/"
											    				target="_blank">Lottie Animation</a>)</label>
											    		<div class="col-sm-6">
											    			<input type="text" value="" name="Message_Animation" id="Message_Animation" placeholder=""
											    				class="form-control">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Message Title</label>
											    		<div class="col-sm-6">
											    			<input type="text" value="" name="Message_Title" id="Message_Title" placeholder="Ex: Dooo"
											    				class="form-control" required="">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Message</label>
											    		<div class="col-sm-6">
											    			<textarea rows="3" type="text" value="" name="Message" id="Message"
											    				placeholder="Ex: Thank You For Using Our app" class="form-control"
											    			><?php echo $config->Message; ?></textarea>
											    		</div>
											    	</div>

											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="messageSetting" value="messageSetting" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="android_update" role="tabpanel">
											    <form method="post">
											    	<div class="alert alert-success"><strong>Note: </strong>An update popup will
											    		be display to old version user based on bellow APK information.</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Update Type</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="Update_Type" name="Update_Type">
											    				<option value="0">In App Update</option>
											    				<option value="1">External Browser</option>
											    				<option value="2">Google Play In App Update</option>
											    			</select>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="GooglePlay_Update_Type_form">
											    		<label class="col-sm-3 control-label">Googleplay App Update Type</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="GooglePlay_Update_Type"
											    				name="GooglePlay_Update_Type">
											    				<option value="0">Flexible</option>
											    				<option value="1">Immediate</option>
											    			</select>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="apk_version_name_form">
											    		<label class="col-sm-3 control-label">Latest APK Version Name</label>
											    		<div class="col-sm-9">
											    			<input type="text" value="" name="apk_version_name" id="apk_version_name"
											    				placeholder="Ex: V1.0.0" class="form-control">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="apk_version_code_form">
											    		<label class="col-sm-3 control-label">Latest APK Version Code</label>
											    		<div class="col-sm-9">
											    			<input type="number" value="" name="apk_version_code" id="apk_version_code"
											    				placeholder="Ex: 0" class="form-control">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="latest_apk_url_form">
											    		<label class="control-label col-sm-3 ">APK File URL</label>
											    		<div class="col-sm-9">
											    			<input type="text" value="" name="latest_apk_url" id="latest_apk_url"
											    				placeholder="Ex: PlayStore URL or any other direct download URL" class="form-control">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="apk_whats_new_form">
											    		<label class="col-sm-3 control-label">What's new on latest APK</label>
											    		<div class="col-sm-9">
											    			<textarea type="text" rows="6" name="apk_whats_new" id="apk_whats_new"
											    				class="form-control"></textarea>
											    			<p><small>Separate Line By Comma ( , ).</small></p>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="update_skipable_form">
											    		<label class="control-label col-sm-3 ">Update Skipable?</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="update_skipable" name="update_skipable">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>


											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="androidUpdate" value="androidUpdate" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="onscreen_effects" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Effect Type</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="Effect_Type" name="Effect_Type">
											    				<option value="0">Nothing</option>
											    				<option value="1">SnowFall</option>
											    			</select>
											    		</div>
											    	</div>




											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="onScreenEffets" value="onScreenEffets" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="content_item_ui" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Movie/WebSeries Item UI</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="MW_Item_Type" name="MW_Item_Type">
											    				<option value="0">Default</option>
											    				<option value="1">V2</option>
											    			</select>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Live TV Item UI</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="LT_Item_Type" name="LT_Item_Type">
											    				<option value="0">Default</option>
											    				<option value="1">V2</option>
											    			</select>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Episodes UI</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="EP_Type" name="EP_Type">
											    				<option value="0">Default</option>
											    				<option value="1">V2</option>
											    			</select>
											    		</div>
											    	</div>


											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" name="contentItemUI" value="contentItemUI" aria-haspopup="true"
											    				aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="splash_screen_ui" role="tabpanel">
											    <form method="post">
											    	<div class="alert alert-success" role="alert">
											    		<strong>Note: </strong> The Changes will Take Effect Form Second time App Open.
											    	</div>
											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Splash Screen Background Color</label>
											    		<div class="col-sm-3 ">
											    			<input type="text" class="form-control" id="splashScreenBgColor" name="splashScreenBgColor"
											    				value="#1B242F">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3">
											    		<label class="col-sm-3 control-label">Splash Screen UI Type</label>
											    		<div class="col-sm-3 ">
											    			<select class="form-control form-select" id="splash_screen_ui_type"
											    				name="splash_screen_ui_type">
											    				<option value="0">Default</option>
											    				<option value="1">Image/Animated Image</option>
											    				<option value="2">Lottie Animation</option>
											    				<option value="3">Custom Page</option>
											    			</select>
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="splash_image_url_form">
											    		<label class="control-label col-sm-3 ">Image/Animated Image URL</label>
											    		<div class="col-sm-6">
											    			<input type="text" value="" name="splash_image_url" id="splash_image_url"
											    				class="form-control">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="splash_lottie_animation_url_form">
											    		<label class="control-label col-sm-3 ">Lottie Animation URL</label>
											    		<div class="col-sm-6">
											    			<input type="text" value="" name="splash_lottie_animation_url"
											    				id="splash_lottie_animation_url" class="form-control">
											    		</div>
											    	</div>

											    	<div class="form-group row mb-3" id="summernote_splash_code_form">
											    		<label class="control-label col-sm-3 ">Custom Code</label>
											    		<div class="col-sm-9">
											    			<div class="summernote_splash_code" id="summernote_splash_code"></div>
											    		</div>
											    	</div>

											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="create_btn"
											    				type="submit" onclick="customSplashUiCode()" name="SplashScreenUI" value="SplashScreenUI"
											    				aria-haspopup="true" aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="pin_lock_setting" role="tabpanel">
											    <form method="post">
											    	<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">Pin Lock Status</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="pinLockStatus_bool"
											    					name="pinLockStatus_bool">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>
											    	<div class="form-group row mb-3" id="pinLockcode_form">
											    		<label class="control-label col-sm-3 ">Pin Lock Code</label>
											    		<div class="col-sm-4">
											    			<input type="number" value="" name="pinLockcode" id="pinLockcode" class="form-control"
											    				placeholder="0000">
											    		</div>
											    	</div>


											    	<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="pinLock"
											    				type="submit" name="pinLock" value="pinLock" aria-haspopup="true" aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="default_stream" role="tabpanel">
											    <form method="post">
												    <div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">Movie Default Stream Link Status 
															<i class="ion ion-md-information-circle-outline text-info" data-toggle="tooltip" title="When Enable It will Show a Stream link (M3u8) to each Movie you import from TMDB!"></i>
														</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="movieDefaultStreamLinkStatus"
											    					name="movieDefaultStreamLinkStatus">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>

												    <div class="form-group row mb-3">
                                            			<label class="col-sm-3 control-label">Movie Default Stream Link Type
														<i class="ion ion-md-information-circle-outline text-info" data-toggle="tooltip" title="It will set the Content type to Free or Premium for every Stream link show automatically by above system!"></i>
														</label>
                                            			<div class="col-sm-3 ">
                                            				<select class="form-control form-select"
                                            					id="movieDefaultStreamLinkType" name="movieDefaultStreamLinkType">
                                            					<option value="0">Free</option>
                                            					<option value="1">Premium</option>
                                            				</select>
                                            			</div>
                                            		</div>

													<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="default_stream_link"
											    				type="submit" name="default_stream" value="default_stream" aria-haspopup="true" aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>

											<div class="tab-pane p-3" id="otp_system" role="tabpanel">
											    <form method="post">
												    <div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">login Otp Status
															<i class="ion ion-md-information-circle-outline text-info" data-toggle="tooltip" title="When Enabled it will ask for otp at the time of login."></i>
														</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="login_otp_status"
											    					name="login_otp_status">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>

													<div class="form-group row mb-3">
											    		<label class="control-label col-sm-3 ">Signup Otp Status
															<i class="ion ion-md-information-circle-outline text-info" data-toggle="tooltip" title="When Enabled it will ask for otp at the time of Signup."></i>
														</label>
											    		<div class="col-sm-6">
											    			<label class="switch">
											    				<input type="checkbox" class="toggleclass" id="signup_otp_status"
											    					name="signup_otp_status">
											    				<span class="slider round"></span>
											    			</label>
											    		</div>
											    	</div>

													<div class="form-group mb-3 row justify-content-end">

											    		<div class="col-md-1">

											    			<button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="otp_system"
											    				type="submit" name="otp_system" value="otp_system" aria-haspopup="true" aria-expanded="false">

											    				<i class="mdi mdi-content-save-all"></i> SAVE

											    			</button>

											    		</div>

											    	</div>
											    </form>
                                            </div>
											
											<div class="tab-pane p-3" id="disposable_emails" role="tabpanel">
											    <div class="btn-group" role="group" aria-label="Basic">
												  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Add_disposable_email_Modal">Add New</button>
                                                  <button type="button" class="btn btn-warning" onclick="AutoFetchDisposableEmails()">Auto Fetch</button>
                                                  <button type="button" class="btn btn-danger" onclick="ClearAllDisposableEmails()">Clear All</button>
                                                </div>
												<div class="row">

													<div class="col-12">

														<div class="card">

															<div class="card-body">

																<table id="DisposableEmailDatatable" class="table table-striped"
																	style="border-collapse: collapse; border-spacing: 0; width: 100%;">

																	<thead>

																		<tr>

																			<th>#</th>

																			<th>Email</th>

                                                                            <th>##</th>

																		</tr>

																	</thead>

																</table>



															</div>

														</div>

													</div> <!-- end col -->

												</div> <!-- end row -->
											</div>

											<div class="tab-pane p-3" id="embed_custom_error" role="tabpanel">
											    <div class="btn-group mb-3" role="group" aria-label="Basic">
												  <button type="button" class="btn btn-warning" onclick="embed_custom_error_reset()">Reset to Default</button>
                                                </div>
												<div class="row">

													<div class="col-12">

													    <div class="summernote_embed_custom_error" id="summernote_embed_custom_error"></div>
														<br>
                                                        <div class="col-md-12 row justify-content-end">
                                                            <button class="btn btn-primary waves-effect waves-light col-md-2"
                                                                id="submit" name="submit" onclick="Save_embed_custom_error()">
                                                                <i class="mdi mdi-content-save-all"></i> Save
                                                            </button>
                                                        </div>

													</div> <!-- end col -->

												</div> <!-- end row -->
											</div>

                                            <div class="tab-pane p-3" id="player_setting" role="tabpanel">
                                                <form method="post">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-sm-3 control-label">Default Intro Video</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" value="<?= $config->player_intro; ?>" name="default_intro_video" id="default_intro_video"
                                                                   placeholder="" class="form-control">
                                                            <p><small>supported: mkv, mp4</small></p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row justify-content-end">

                                                        <div class="col-md-1">

                                                            <button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="player_setting"
                                                                    type="submit" name="player_setting" value="player_setting" aria-haspopup="true" aria-expanded="false">

                                                                <i class="mdi mdi-content-save-all"></i> SAVE

                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>
                                            </div>


                                            <div class="tab-pane p-3" id="image_settings" role="tabpanel">
                                                <form method="post">
                                                    <div class="form-group row mb-3">
                                                        <label class="control-label col-sm-3 ">Proxy Content Images</label>
                                                        <div class="col-sm-6">
                                                            <label class="switch">
                                                                <input type="checkbox" class="toggleclass"
                                                                       id="image_proxy_status"
                                                                       name="image_proxy_status">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-sm-3 control-label">Image Storage Provider
                                                            <i class="ion ion-md-information-circle-outline text-info" data-toggle="tooltip" title="It will be used as a image storage to store all the images."></i>
                                                        </label>
                                                        <div class="col-sm-3 ">
                                                            <select class="form-control form-select"
                                                                    id="image_storage_provider" name="image_storage_provider">
                                                                <option value="0">Default</option>
                                                                <option value="1">Imgbb</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-sm-3 control-label">Imgbb Api Key</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" value="<?= $config->imgbb_api_key; ?>" name="imgbb_api_key" id="imgbb_api_key"
                                                                   placeholder="" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row justify-content-end">

                                                        <div class="col-md-1">

                                                            <button class="btn btn-primary dropdown-toggle waves-effect waves-light" id="image_settings"
                                                                    type="submit" name="image_settings" value="image_settings" aria-haspopup="true" aria-expanded="false">

                                                                <i class="mdi mdi-content-save-all"></i> SAVE

                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
										
                                    </div>
                                </div>
                            </div>

                        </div>

            		</div> <!-- container-fluid -->

					<div class="modal fade" id="Add_disposable_email_Modal" tabindex="-1" role="dialog" aria-labelledby="Add_disposable_email_Modal_Lebel"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="Add_disposable_email_Modal_Lebel">Add New Disposable Email</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									</button>
								</div>
								<div class="modal-body">
									<div class="panel-body">
										<div class="form-group mb-3"> <label class="control-label">Email Domain
											</label>&nbsp;&nbsp;<input id="Add_modal_disposable_Email" type="text" name="label"
												class="form-control" placeholder="gmail.com" required="">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="button" onclick="Add_disposable_email()" class="btn btn-primary">Add</button>
								</div>
							</div>
						</div>
					</div>

            	</div>


            	<?php include("partials/footer_rights.php"); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>
		<?php $splash_custom_code = htmlspecialchars(trim(preg_replace('/\s+/', ' ', file_get_contents(APPPATH.'views/extras/splash.php')))); ?>
    <script>
        $(document).ready(function() {
			
			$('.nav-tabs a[href="#' + localStorage.getItem("currentTabIndex") + '"]').tab('show');
			$('.nav-tabs > li > a').click( function() {
                localStorage.setItem("currentTabIndex", $(this).attr('href').slice(1));
            });

			$('#blocked_regions').select2({
				placeholder: "Choose...",
                allowClear: true,
                width: "100%"
			});
			$('#blocked_regions').val(<?php echo json_encode(explode(",", "$config->blocked_regions")); ?>).change();

			$("#safeMode_versions").select2({
                tags: true,
			    "language":{
                  "noResults" : function () { return ''; }
                }
            });

			if ('<?php echo $config->onboarding_status; ?>' == 1) {
                document.getElementById("onboarding_status").checked = true;
            } else {
                document.getElementById("onboarding_status").checked = false;
            }

			if ('<?php echo $config->force_single_device; ?>' == 1) {
                document.getElementById("SASD_status").checked = true;
            } else {
                document.getElementById("SASD_status").checked = false;
            }

			<?php echo json_encode(explode(",", "$config->safeModeVersions")); ?>.forEach(function (arrayItem) {
                var newOption = new Option(arrayItem, arrayItem, false, false);
                 $('#safeMode_versions').append(newOption).trigger('change');
            });
			$('#safeMode_versions').val(<?php echo json_encode(explode(",", "$config->safeModeVersions")); ?>).change();

			if ('<?php echo $config->safeMode; ?>' == 1) {
                document.getElementById("safe_mode_bool").checked = true;
            } else {
                document.getElementById("safe_mode_bool").checked = false;
            }

            $('#apk_name').val(`<?php echo $config->name; ?>`);

			$('#apk_logo').val(`<?php echo $config->logo; ?>`);

			$('#package_name').val(`<?php echo $config->package_name; ?>`);

			if ('<?php echo $config->login_mandatory; ?>' == 1) {
                document.getElementById("login_mandatory_bool").checked = true;
            } else {
                document.getElementById("login_mandatory_bool").checked = false;
			}

            if ('<?php echo $config->maintenance; ?>' == 1) {
                document.getElementById("maintenance_bool").checked = true;
            } else {
                document.getElementById("maintenance_bool").checked = false;
            }

			$('#All_Live_TV_Type').val(`<?php echo $config->all_live_tv_type; ?>`);
			$('#All_Movies_Type').val(`<?php echo $config->all_movies_type; ?>`);
			$('#All_Series_Type').val(`<?php echo $config->all_series_type; ?>`);

			$('#download_manager').val(`<?php echo $config->download_manager; ?>`);

			if ('<?php echo $config->LiveTV_Visiable_in_Home; ?>' == 1) {
                document.getElementById("LiveTV_Visiable_in_Home_bool").checked = true;
            } else {
                document.getElementById("LiveTV_Visiable_in_Home_bool").checked = false;
			}

            if ('<?php echo $config->genre_visible_in_home; ?>' == 1) {
                document.getElementById("genreList_Visiable_in_Home_bool").checked = true;
            } else {
                document.getElementById("genreList_Visiable_in_Home_bool").checked = false;
            }

			if ('<?php echo $config->live_tv_genre_visible_in_home; ?>' == 1) {
                document.getElementById("livetv_genreList_Visiable_in_Home_bool").checked = true;
            } else {
                document.getElementById("livetv_genreList_Visiable_in_Home_bool").checked = false;
            }

			if ('<?php echo $config->home_bottom_floting_menu_status; ?>' == 1) {
                document.getElementById("home_bottom_floting_menu_status_bool").checked = true;
            } else {
                document.getElementById("home_bottom_floting_menu_status_bool").checked = false;
            }

            if ('<?php echo $config->image_proxy_status; ?>' == 1) {
                document.getElementById("image_proxy_status").checked = true;
            } else {
                document.getElementById("image_proxy_status").checked = false;
            }

			if ('<?php echo $config->google_login; ?>' == 1) {
                document.getElementById("google_login_bool").checked = true;
            } else {
                document.getElementById("google_login_bool").checked = false;
            }

			if ('<?php echo $config->shuffle_contents; ?>' == 1) {
                document.getElementById("shuffle_contents_bool").checked = true;
            } else {
                document.getElementById("shuffle_contents_bool").checked = false;
            }
            $('#Home_Rand_Max_Movie_Show').val(`<?php echo $config->Home_Rand_Max_Movie_Show; ?>`);
            $('#Home_Rand_Max_Series_Show').val(`<?php echo $config->Home_Rand_Max_Series_Show; ?>`);
            $('#Home_Recent_Max_Movie_Show').val(`<?php echo $config->Home_Recent_Max_Movie_Show; ?>`);
            $('#Home_Recent_Max_Series_Show').val(`<?php echo $config->Home_Recent_Max_Series_Show; ?>`);

			if ('<?php echo $config->movie_comments; ?>' == 1) {
                document.getElementById("moviesComment").checked = true;
            } else {
                document.getElementById("moviesComment").checked = false;
            }
            if ('<?php echo $config->webseries_comments; ?>' == 1) {
                document.getElementById("webSeriesComment").checked = true;
            } else {
                document.getElementById("webSeriesComment").checked = false;
            }

			if ('<?php echo $config->Show_Message; ?>' == 1) {
                document.getElementById("Show_Message_bool").checked = true;
            } else {
                document.getElementById("Show_Message_bool").checked = false;
			}
        
			$('#Message_Animation').val(`<?php echo $config->message_animation_url; ?>`);
            $('#Message_Title').val(`<?php echo $config->Message_Title; ?>`);

			$('#apk_version_name').val(`<?php echo $config->Latest_APK_Version_Name; ?>`);
            $('#apk_version_code').val(`<?php echo $config->Latest_APK_Version_Code; ?>`);
            $('#latest_apk_url').val(`<?php echo $config->APK_File_URL; ?>`);
            $('#apk_whats_new').val(`<?php echo $config->Whats_new_on_latest_APK; ?>`);

			$('#Update_Type').val(`<?php echo $config->Update_Type; ?>`);
			$('#GooglePlay_Update_Type').val(`<?php echo $config->googleplayAppUpdateType; ?>`);

			if ('<?php echo $config->Update_Skipable; ?>' == 1) {
                document.getElementById("update_skipable").checked = true;
            } else {
                document.getElementById("update_skipable").checked = false;
            }

			$('#Effect_Type').val('<?php echo $config->onscreen_effect; ?>');

			$('#MW_Item_Type').val(`<?php echo $config->content_item_type; ?>`);
			$('#LT_Item_Type').val(`<?php echo $config->live_tv_content_item_type; ?>`);
			$('#EP_Type').val(`<?php echo $config->webSeriesEpisodeitemType; ?>`);

			if(document.getElementById("Update_Type").value == 0 || document.getElementById("Update_Type").value == 1) {
				$("#GooglePlay_Update_Type_form").hide();

				$("#apk_version_name_form").show();
				$("#apk_version_code_form").show();
				$("#latest_apk_url_form").show();
				$("#apk_whats_new_form").show();
				$("#update_skipable_form").show();
			  } else if(document.getElementById("Update_Type").value == 2) {
				$("#GooglePlay_Update_Type_form").show();

				$("#apk_version_name_form").hide();
				$("#apk_version_code_form").hide();
				$("#latest_apk_url_form").hide();
				$("#apk_whats_new_form").hide();
				$("#update_skipable_form").hide();
			  }
			document.getElementById("Update_Type").addEventListener('change', function() {
              if(this.value == 0 || this.value == 1) {
				$("#GooglePlay_Update_Type_form").hide();

				$("#apk_version_name_form").show();
				$("#apk_version_code_form").show();
				$("#latest_apk_url_form").show();
				$("#apk_whats_new_form").show();
				$("#update_skipable_form").show();
			  } else if(this.value == 2) {
				$("#GooglePlay_Update_Type_form").show();

				$("#apk_version_name_form").hide();
				$("#apk_version_code_form").hide();
				$("#latest_apk_url_form").hide();
				$("#apk_whats_new_form").hide();
				$("#update_skipable_form").hide();
			  }
            }, false);
			

			$("#splashScreenBgColor").spectrum({
				allowEmpty:false,
				showInput:true,
                showAlpha:false,
				color: "<?php echo $config->splash_bg_color; ?>",
				
				change: function(color) { color.toHexString(); }
            });

			//$('#splashScreenBgColor').val();
			$('#splash_screen_ui_type').val(`<?php echo $config->splash_screen_type; ?>`);
			$('#splash_image_url').val(`<?php echo $config->splash_image_url; ?>`);
			$('#splash_lottie_animation_url').val(`<?php echo $config->splash_lottie_url; ?>`);

			if('<?php echo $config->splash_screen_type; ?>' == 0) {
				$("#splash_image_url_form").hide();
				$("#splash_lottie_animation_url_form").hide();
				$("#summernote_splash_code_form").hide();
			} else if('<?php echo $config->splash_screen_type; ?>' == 1) {
				$("#splash_image_url_form").show();
				$("#splash_lottie_animation_url_form").hide();
				$("#summernote_splash_code_form").hide();
			} else if('<?php echo $config->splash_screen_type; ?>' == 2) {
				$("#splash_image_url_form").hide();
				$("#splash_lottie_animation_url_form").show();
				$("#summernote_splash_code_form").hide();
			} else if('<?php echo $config->splash_screen_type; ?>' == 3) {
				$(document).ready(function() {
                    $('.summernote_splash_code').summernote({
                        height: 250
                    });
					$('#summernote_splash_code').summernote('code', `<?php echo $splash_custom_code; ?>`);
                });
				$("#splash_image_url_form").hide();
				$("#splash_lottie_animation_url_form").hide();
				$("#summernote_splash_code_form").show();
			}
			document.getElementById("splash_screen_ui_type").addEventListener('change', function() {
				if(this.value == 0) {
					$("#splash_image_url_form").hide();
					$("#splash_lottie_animation_url_form").hide();
				    $("#summernote_splash_code_form").hide();
				}else if(this.value == 1) {
					$("#splash_image_url_form").show();
					$("#splash_lottie_animation_url_form").hide();
				    $("#summernote_splash_code_form").hide();
				}else if(this.value == 2) {
					$("#splash_image_url_form").hide();
					$("#splash_lottie_animation_url_form").show();
				    $("#summernote_splash_code_form").hide();
				}else if(this.value == 3) {
					$(document).ready(function() {
                        $('.summernote_splash_code').summernote({
                            height: 250
                        });
			            $('#summernote_splash_code').summernote('code', `<?php echo $splash_custom_code; ?>`);
                    });
					$("#splash_image_url_form").hide();
					$("#splash_lottie_animation_url_form").hide();
				    $("#summernote_splash_code_form").show();
				}
			}, false);

			
			

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

			$("#primeryThemeColor").spectrum({
				allowEmpty:false,
				showInput:true,
                showAlpha:false,
				color: "<?php echo $config->primeryThemeColor; ?>",
				
				change: function(color) { color.toHexString(); }
            });

			if ('<?php echo $config->pinLockStatus; ?>' == 1) {
                document.getElementById("pinLockStatus_bool").checked = true;
            } else {
                document.getElementById("pinLockStatus_bool").checked = false;
            }
			$('#pinLockcode').val('<?php echo $config->pinLockPin; ?>');


			//default_stream_link
			$('#movieDefaultStreamLinkType').val('<?php echo $config->movieDefaultStreamLinkType; ?>');
			if ('<?php echo $config->movieDefaultStreamLinkStatus; ?>' == 1) {
                document.getElementById("movieDefaultStreamLinkStatus").checked = true;
            } else {
                document.getElementById("movieDefaultStreamLinkStatus").checked = false;
            }

			//OTP STstem
			if ('<?php echo $config->login_otp_status; ?>' == 1) {
                document.getElementById("login_otp_status").checked = true;
            } else {
                document.getElementById("login_otp_status").checked = false;
            }
			if ('<?php echo $config->signup_otp_status; ?>' == 1) {
                document.getElementById("signup_otp_status").checked = true;
            } else {
                document.getElementById("signup_otp_status").checked = false;
            }

			//Disposable Emails
			$('#DisposableEmailDatatable').dataTable({
                "order": [],
                "ordering": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('Admin_api/getAlldisposableEmails') ?>",
                    "type":"GET",
                },
                "columns": [{
                        "data": "1",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "2"
                    },
                    {
                        "data": "3",
                        render: function (data) {
                            return `
							<button type="button" class="btn btn-danger" onClick="deletedisposableEmail(`+data+`)">
							<i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
							`;
                        }
                    }
                ]
            });

			$('.summernote_embed_custom_error').summernote({height: 250});
			$('#summernote_embed_custom_error').summernote('code', `<?php echo $config->embed_error_code; ?>`);

            //image_storage_provider
            $('#image_storage_provider').val('<?php echo $config->image_storage_provider; ?>');
			
        });

		function decodeHTMLEntities(text) {
          return $("<encoder/>").html(text).text();
        }

		function encodeHTMLEntities(text) {
          return $("<encoder/>").text(text).html();
        }

		function Save_embed_custom_error() {
			var summernote_embed_custom_error = encodeHTMLEntities(decodeHTMLEntities($('#summernote_embed_custom_error').summernote('code')));
			$.ajax({
              url: '<?= site_url('Admin_api/embed_custom_error_code') ?>',
              type: 'POST',
	    	  data : { code : summernote_embed_custom_error },
              dataType:'text',
                success: function(result){
	    			if(result) {
							swal.fire({
                                title: 'Successful!',
                                text: 'Custom Embed Error Code Updated successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
						}
                }
            });
		}

		function embed_custom_error_reset() {
			Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, Reset it!"
            }).then(function (result) {
                if (result.value) {
					$.ajax({
                      url: '<?= site_url('Admin_api/embed_custom_error_code_reset') ?>',
                      type: 'POST',
                      dataType:'text',
                        success: function(result){
	    	        		if(result) {
			        				swal.fire({
                                        title: 'Successful!',
                                        text: 'Custom Embed Error Code Reseted successfully!',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#556ee6',
                                        cancelButtonColor: "#f46a6a"
                                    }).then(function () {
                                        location.reload();
                                    });
			        			}
                        }
                    });
				}
            });
		}

		function customSplashUiCode() {
			var summernote_splash_code_form = $('#summernote_splash_code').summernote('code');
			$.ajax({
              url: '<?= site_url('Admin_api/customSplashUiCode') ?>',
              type: 'POST',
	    	  data : { code : summernote_splash_code_form },
              dataType:'text',
                success: function(result){
	    			if(result) {
	    				
	    			}
                }
            });
		}

		function Add_disposable_email() {
			Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                },
                onClose: ()=>{
					$('#DisposableEmailDatatable').DataTable().ajax.reload();
					$('#Add_disposable_email_Modal').modal('hide');
                }
            });
			$.ajax({
              url: '<?= site_url('Admin_api/Add_disposable_email') ?>',
              type: 'POST',
	    	  data : { disposable_Email : $('#Add_modal_disposable_Email').val() },
              dataType:'text',
                success: function(result){
					Swal.close();
	    			if(result) {
	    				toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.success("Disposable Email Added Successfully!", 'Success!');
	    			} else {
						toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "2000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.error("Something Went Wrong!", 'Error!');
					}
                }
            });
		}

		function deletedisposableEmail(ID) {
			Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                },
                onClose: ()=>{
					$('#DisposableEmailDatatable').DataTable().ajax.reload();
                }
            });
			$.ajax({
              url: '<?= site_url('Admin_api/deletedisposableEmail') ?>',
              type: 'POST',
	    	  data : { ID : ID },
              dataType:'text',
                success: function(result){
	    			Swal.close();
                }
            });
		}

		function ClearAllDisposableEmails() {
			Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, Clear all!"
                }).then(function (result) {
                    if (result.value) {
						Swal.fire({
                            title: 'Please Wait',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            onOpen: ()=>{
                                Swal.showLoading();
                            },
                            onClose: ()=>{
                                $('#DisposableEmailDatatable').DataTable().ajax.reload();
                            }
                        });

						$.ajax({
                          url: '<?= site_url('Admin_api/ClearAllDisposableEmails') ?>',
                          type: 'GET',
                          dataType:'text',
                            success: function(result){
	    	            		Swal.close();
                            }
                        });
					}
                });
		}

		function AutoFetchDisposableEmails() {
			Swal.fire({
                    title: "Are you sure?",
                    text: "Disposable Emails will be fetched from multiple sources!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, Fetch All!"
                }).then(function (result) {
                    if (result.value) {
						Swal.fire({
                            title: 'Please Wait',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            onOpen: ()=>{
                                Swal.showLoading();
                            },
                            onClose: ()=>{
                                $('#DisposableEmailDatatable').DataTable().ajax.reload();
                            }
                        });

						$.ajax({
                          url: '<?= site_url('Admin_api/AutoFetchDisposableEmails') ?>',
                          type: 'GET',
                          dataType:'text',
                            success: function(result){
	    	            		Swal.close();
								if(result) {
									swal.fire({
                                        title: 'Successful!',
                                        text: 'Disposable Emails Fetched successfully!',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#556ee6',
                                        cancelButtonColor: "#f46a6a"
                                    }).then(function () {
                                        
                                    });
								} else {
									swal.fire({
                                        title: 'Error!',
                                        text: 'Something Went Wrong!',
                                        icon: 'error',
                                        showCancelButton: false,
                                        confirmButtonColor: '#556ee6',
                                        cancelButtonColor: "#f46a6a"
                                    }).then(function () {
                                        
                                    });
								}
                            }
                        });
					}
                });
		}

    </script>