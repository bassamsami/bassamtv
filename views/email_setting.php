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

            				<div class="col-sm-8">

            					<div class="page-title-box">

            						<h4 class="font-size-18">Email Setting</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">SMTP Setting</a></li>

            							<li class="breadcrumb-item active">Email Setting</li>

            						</ol>

            					</div>

            				</div>

							<div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                      <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="testMail()">
                                        <i class="typcn typcn-link-outline me-2"></i> Test Mail
                                      </button>
                                    </div>
                                </div>

            			</div>

            			<!-- end page title -->

                        <div class="form" method="post">

                        	<div class="row">

                        		<form method="post">

                        			<div class="col-md-12">

                        				<div class="card card-body">

                        					<h3 class="card-title mt-0">Contact Email</h3>

                        					<hr>

                        					<div class="form-group row mb-3">
                        						<label class="col-sm-3 control-label">Contact Email</label>
                        						<div class="col-sm-9">
                        							<input type="email" value="<?php echo $config->Contact_Email; ?>"
                        								id="contact_email" class="form-control" name="contact_email">
                        							<p>All contact mail will send to this email..</p>
                        						</div>
                        					</div>


                        					<h3 class="card-title mt-0">Outgoing Server Configuration</h3>

                        					<hr>

                        					<div id="smtp" style="">
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 control-label">SMTP Security</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control form-select" id="smtp_crypto" name="smtp_crypto">
                                                            <option value="none" selected>None</option>
                                                            <option value="ssl">SSl</option>
                                                            <option value="tls">TLS</option>
                                                        </select>
                                                    </div>
                                                </div>
                        						<div class="form-group row mb-3">
                        							<label class="col-sm-3 control-label">SMTP Server Address</label>
                        							<div class="col-sm-9">
                        								<input type="text" value="<?php echo $config->SMTP_Host; ?>"
                        									id="smtp_host" class="form-control"
                        									placeholder="ex: smtp.gmail.com" name="smtp_host">
                        							</div>
                        						</div>
                        						<div class="form-group row mb-3">
                        							<label class="col-sm-3 control-label">SMTP Username</label>
                        							<div class="col-sm-9">
                        								<input type="text" value="<?php echo $config->SMTP_Username; ?>"
                        									id="smtp_user" class="form-control"
                        									placeholder="ex: example@gmail.com" name="smtp_user">
                        							</div>
                        						</div>
                        						<div class="form-group row mb-3">
                        							<label class="col-sm-3 control-label">SMTP Password</label>
                        							<div class="col-sm-9">
                        								<input type="password"
                        									value="<?php echo $config->SMTP_Password; ?>" id="smtp_pass"
                        									class="form-control" placeholder="ex: ******" name="smtp_pass">
                        							</div>
                        						</div>
                        						<div class="form-group row mb-3">
                        							<label class="col-sm-3 control-label">SMTP Port</label>
                        							<div class="col-sm-9">
                        								<input type="text" value="<?php echo $config->SMTP_Port; ?>"
                        									id="smtp_port" class="form-control" placeholder="ex: 25" name="smtp_port">
                        							</div>
                        						</div>
                        						<br>
                        					</div>
                        					<div class="form-group row mb-3 justify-content-end">

                        						<div class="col-md-2">

                        							<button
                        								class="btn btn-primary dropdown-toggle waves-effect waves-light"
                        								id="create_btn" name="email_setting" value="email_setting"
                        								type="submit" aria-haspopup="true" aria-expanded="false">

                        								<i class="mdi mdi-content-save-all"></i> SAVE CHANGES

                        							</button>

                        						</div>

                        					</div>
                        				</div>

                        			</div>
                        		</form>

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
        $(document).ready(function() {
            $("#smtp_crypto").val("<?php echo $config->SMTP_crypto; ?>");


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


		function testMail() {
            Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                },
                onClose: ()=>{

                }
            });
			var smtp_host = document.getElementById("smtp_host").value;
			var smtp_user = document.getElementById("smtp_user").value;
			var smtp_pass = document.getElementById("smtp_pass").value;
			var smtp_port = document.getElementById("smtp_port").value;
            var smtp_crypto = document.getElementById("smtp_crypto").value;
			if(smtp_host!=""&&smtp_port!="") {
				var mail = document.getElementById("contact_email").value;
				$.ajax({
                type: 'POST',
                url: window.location.href,
                data: {
                    'testMail': 'testMail',
                    'mail': mail
                },
                dataType: 'text',
                success: function (response) {
                    Swal.close();
                    if(response==="Message has been sent") {
                        swal.fire({
                            title: 'Successful!',
                            text: "Message has been sent successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#556ee6',
                            cancelButtonColor: "#f46a6a"
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        swal.fire({
                            title: 'Info',
                            text: 'Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.',
                            icon: 'info'
                        }).then(function () {
                            location.reload();
                        });
                    }
                }
            });
			} else {
                Swal.close();
				swal.fire({
                    title: 'Warning',
                    text: "Please Fill All the Mail Configuration!",
                    icon: 'warning'
                }).then(function () {
                    location.reload();
                });
			}
		}
    </script>