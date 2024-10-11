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

            						<h4 class="font-size-18">Announcement</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>

            							<li class="breadcrumb-item active">Announcement</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="form" action="" method="post">
                        	<div class="row">
                        		<div class="col-md-12">
                        			<div class="card card-body">
                        				<h3 class="card-title mt-0">SEND PUSH NOTIFICATION (Announcement)</h3>
                        				<hr>

                        				<div class="form-group mb-3 col-md-9">
                        					<label>Heading</label>
                        					<input class="form-control" type="text" value="" id="Heading">
                        				</div>

                        				<div class="form-group mb-3 col-md-9">
                        					<label>Message</label>
                        					<div>
                        						<textarea required="" class="form-control" id="Message"
                        							rows="5"></textarea>
                        					</div>
                        				</div>

                        				<div class="form-group mb-3 col-md-9">
                        					<label>Large Icon</label>
                        					<input class="form-control" type="text" value="" id="Large_Icon">
                        				</div>

                        				<div class="form-group mb-3 col-md-9">
                        					<label>Big Picture</label>
                        					<input class="form-control" type="text" value="" id="Big_Picture">
                        				</div>

                        				<div class="form-group mb-3 row justify-content-end">
                        					<div class="col-md-1">
                        						<button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                        							onclick="Save_Onesignal_Data()" id="create_btn" type="submit"
                        							aria-haspopup="true" aria-expanded="false">
                        							<i class="ion ion-md-send"></i> SEND
                        						</button>
                        					</div>
                        				</div>
                        			</div>
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
        var Onesignal_Api_Key = "<?php echo $config->onesignal_api_key ?>";
        var Onesignal_Appid = "<?php echo $config->onesignal_appid ?>";

        function Save_Onesignal_Data() {
            var Heading = document.getElementById("Heading").value;
            var Message = document.getElementById("Message").value;
            var Large_Icon = document.getElementById("Large_Icon").value;
            var Big_Picture = document.getElementById("Big_Picture").value;
        
            if(Heading != "" && Message != "") {
                var jsonObjects = {
                    "included_segments": ["All"],
        	        "app_id": Onesignal_Appid,
        	        "contents": {"en": Message},
        	        "headings": {"en": Heading},
        	        "data": {"Type": "Announcement"},
        	        "big_picture": Big_Picture,
        	        "large_icon": Large_Icon
                };
        
                $.ajax({
                    type: 'POST',
                    url: 'https://onesignal.com/api/v1/notifications',
                    headers: {
                        'Authorization': 'Basic ' + Onesignal_Api_Key,
                        'Content-Type':'application/json'
                    },
                    contentType: 'application/json',
                    data: JSON.stringify(jsonObjects),
                    dataType: 'json',
                    success: function (response) {
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
                        toastr.success("Total Recipients= " + response.recipients, "Sended Successfully!");
                    },
                    error: function (response) {
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
                        toastr.error("Something Went Wrong!");
                    }
                })
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
                toastr.warning("Fill All Details Correctly!");
            }
            
        }

    </script>