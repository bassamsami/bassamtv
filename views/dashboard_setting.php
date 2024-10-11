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

            						<h4 class="font-size-18">Dashboard Setting</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>

            							<li class="breadcrumb-item active">Dashboard Setting</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="form">

                        	<div class="row">

                        		<div class="col-md-12">

                        			<div class="card card-body">
                        				<form method="post">

                        					<h3 class="card-title mt-0">TMDB Setting</h3>

                        					<hr>

                        					<div class="form-group row mb-3">
                        						<label class="col-sm-3 control-label">TMDB Language</label>
                        						<div class="col-sm-6">
                        							<div class="form-group">
                        								<select class="form-control form-select" id="Language" name="Language">
                        								</select>
                        							</div>
                        						</div>
                        					</div>

                        					<div class="form-group mb-3 row justify-content-end">
                        						<div class="col-md-1">
                        							<button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                        								id="create_btn" type="submit" name="TMDB_Language" value="TMDB_Language" aria-haspopup="true"
                        								aria-expanded="false">
                        								<i class="mdi mdi-content-save-all"></i> Save
                        							</button>
                        						</div>
                        					</div>
                        				</form>
                        			</div>

                        			<div class="card card-body">
                        				<form method="post">

                        					<h3 class="card-title mt-0">License Setting</h3>

                        					<hr>

                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 control-label">User Name</label>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" value="" name="User_Name" id="User_Name"
                                                               placeholder=""
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                        					<div class="form-group row mb-3">
                        						<label class="col-sm-3 control-label">License Code</label>
                        						<div class="col-sm-6">
                        							<div class="form-group">
                        								<input type="password" value="" name="License_Code" id="License_Code"
                        									placeholder="Ex: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
                        									class="form-control">
                        							</div>
                        						</div>
                        					</div>



                        					<div class="form-group row mb-3" id="Item_Name_div">
                        						<label class="col-sm-3 control-label">Item Name</label>
                        						<div class="col-sm-5">
                        							<div class="form-group">
                        								<input type="text" value="" id="Item_Name"
                        									placeholder="" class="form-control" required="" disabled="">
                        							</div>
                        						</div>
                        					</div>
                        					<div class="form-group row mb-3">
                        						<label class="col-sm-3 control-label">License Provider</label>
                        						<div class="col-sm-5">
                        							<div class="form-group">
                        								<input type="text" value="" id="license_provider"
                        									placeholder="" class="form-control" required="" disabled="">
                        							</div>
                        						</div>
                        					</div>
                        					<div class="form-group row mb-3">
                        						<label class="col-sm-3 control-label">License Type</label>
                        						<div class="col-sm-4">
                        							<div class="form-group">
                        								<input type="text" value="" id="License_Type"
                        									placeholder="" class="form-control" required="" disabled="">
                        							</div>
                        						</div>
                        					</div>
                        					<div class="form-group row mb-3">
                        						<label class="col-sm-3 control-label">Purchased At</label>
                        						<div class="col-sm-2">
                        							<div class="form-group">
                        								<input type="text" value=""
                        									id="Purchased_At_date" placeholder="" class="form-control"
                        									required="" disabled="">
                        							</div>
                        						</div>
                        						<div class="col-sm-2">
                        							<div class="form-group">
                        								<input type="text" value=""
                        									id="Purchased_At_time" placeholder="" class="form-control"
                        									required="" disabled="">
                        							</div>
                        						</div>
                        					</div>


                        					<div class="form-group mb-3 row justify-content-end">
                        						<div class="col-md-1">
                        							<button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                        								id="create_btn" type="submit" name="License_Setting" value="License_Setting"
                        								aria-haspopup="true" aria-expanded="false">
                        								<i class="mdi mdi-content-save-all"></i> Save
                        							</button>
                        						</div>
                        					</div>
                        				</form>
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
        $( document ).ready(function() {
            $("#User_Name").val('<?php echo $config->license_user; ?>')
            $("#License_Code").val('<?php echo $config->license_code; ?>')
            if(document.getElementById("License_Code").value != "") {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/verify') ?>',
                    dataType: 'text',
                    success: function (response0) {
                        console.log(response0);
                        if(response0 != false){
                            const dataObj = JSON.parse(response0);
                            $("#Item_Name").val(dataObj.item_name);
                             $("#license_provider").val(dataObj.license_provider);
                             $("#License_Type").val(dataObj.license);
                             var _dt = dataObj.purchased_at;
                             var _dtArr = _dt.split(" ");
                             $("#Purchased_At_date").val(_dtArr[0]);
                             $("#Purchased_At_time").val(_dtArr[1]);

                        } else {
                            swal.fire({
                                title: 'Error',
                                text: 'Invalid purchase code!',
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });
                        }
                    }

                });
            }

            $.ajax({
                type: 'GET',
                url: "https://api.themoviedb.org/3/configuration/primary_translations?api_key=1bfdbff05c2698dc917dd28c08d41096",
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    var Language = document.getElementById('Language');
                    for (var key of response) {
                        Language.add(new Option(key));
                    }
                    $("#Language").val('<?php echo $config->tmdb_language; ?>');
                }

            });

            

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