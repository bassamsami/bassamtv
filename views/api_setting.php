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

            						<h4 class="font-size-18">Api Setting</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>

            							<li class="breadcrumb-item active">Api Setting</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


            			<div class="form" method="post">

            				<div class="row">

            					<div class="col-md-12">

            						<div class="card card-body">

            							<h3 class="card-title mt-0">API</h3>

            							<hr>

            							<div class="tab-pane active" id="rest_api" role="tabpanel">

                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 control-label"><strong>API SERVER URL</strong></label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <input type="text" id="api_url" name="api_secret_url"
                                                            class="form-control" required=""
                                                            value="<?php echo $data->api_url; ?>" disabled="">
                                                        <span class="input-group-text waves-effect waves-light"
                                                            id="option-date"
                                                            onclick="copyToClipboard('api_url')">Copy</span>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 control-label"><strong>API KEY</strong></label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        <input type="text" id="api_key" name="api_secret_key"
                                                            class="form-control" required=""
                                                            value="<?php echo $data->api_key; ?>" disabled="">
                                                        <span class="input-group-text waves-effect waves-light"
                                                            id="option-date"
                                                            onclick="copyToClipboard('api_key')">Copy</span>
                                                        <a class="btn btn-primary" id="gsk" onclick="Generate_Secrate_Key()">
                                                            Generate New Key</a>
                                                    </div>
                                                </div>
                                            </div>

                                        <br>

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
        function copyToClipboard(element) {
            document.getElementById(element).disabled = false;
            var copyText = document.getElementById(element);
            copyText.focus();
            copyText.select();
            try {
              var successful = document.execCommand('copy');
              var msg = successful ? 'successful' : 'unsuccessful';
                swal.fire({
                    title: 'Copied!',
                    html: copyText.value + '<br>Now just paste into android configuration file',
                    icon: 'success'
                });
            } catch (err) {
                swal.fire({
                    title: 'Error',
                    text: 'Something Went Wrong :(',
                    icon: 'error'
                }).then(function () {
                    location.reload();
                });
            }
            document.getElementById(element).disabled = true;
        }

        function Generate_Secrate_Key() {
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, Generate New Key!"
        }).then(function (result) {
            if (result.value) {

                $.ajax({
                  url: '<?= site_url('Admin_api/genarateApiKey') ?>',
                  type: 'GET',
                  dataType:'text',
                    success: function(result){
                        swal.fire({
                            title: 'Successful!',
                            text: 'Api Key Updated successfully!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#556ee6',
                            cancelButtonColor: "#f46a6a"
                        }).then(function () {
                            location.reload();
                        });
                    }
                });
            }
        });
        }

    </script>