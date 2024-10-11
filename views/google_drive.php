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

                		<div class="col-sm-12 row align-items-center">

                			<div class="col-sm-6">

                				<div class="page-title-box">

                					<h4 class="font-size-18">Google Drive</h4>

                					<ol class="breadcrumb mb-0">

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>

                						<li class="breadcrumb-item active">Google Drive</li>

                					</ol>

                				</div>

                			</div>

                			<div class="col-sm-6 row justify-content-end">
                					<a href="" class="btn btn-primary dropdown-toggle waves-effect waves-light col-sm-3"
                                    data-bs-toggle="modal" data-bs-target="#add_Accounts_Modal"> <i
                							class="mdi mdi-plus-box-multiple-outline mr-2"></i> add Account</a>
                			</div>

                		</div>

                		<!-- end page title -->

                		<div class="form" action="" method="post">

                			<div class="row">

                				<div class="col-md-12">

                					<div class="card card-body">

                						<table id="datatable" class="table table-striped"
                							style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                							<thead>

                								<tr>
                									<th>#</th>
                									<th>##</th>
                									<th>Email</th>
													<th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                								</tr>

                							</thead>
                							<tbody>
                                                <?php 
                                                $count = 1;
                                                foreach($google_drive_accounts as $google_drive_account) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $count; ?></th>
                                                    <th scope="row">
                										<div class="d-none d-sm-block">
                											<div class="dropdown d-inline-block">
                												<a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                													id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                													aria-expanded="false">
                													Options <i class="mdi mdi-chevron-down"></i>
                												</a>

                												<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                													<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Edit_Accounts_Modal"
                														onclick="loadAccount('<?php echo $google_drive_account->id; ?>')">Edit</a>
                													<a class="dropdown-item" onclick="deleteAccount('<?php echo $google_drive_account->id; ?>')">Delete</a>
                												</div>
                											</div>
                										</div>
                									</th>
                                                    <th scope="row"><?php echo $google_drive_account->email; ?></th>
                                                    <th scope="row"><?php if($google_drive_account->status==1) { echo '<span class="badge bg-success">Active</span>';} else { echo '<span class="badge bg-danger">Paused</span>';} ?></th>
                                                    <th scope="row"><?php echo date('F jS, Y - h:i A', $google_drive_account->created_at); ?></th>
                                                    <th scope="row"><?php echo date('F jS, Y - h:i A', $google_drive_account->updated_at); ?></th>
                                                <tr>
                                                <?php $count++; } ?>
                							</tbody>

                						</table>

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

        <!-- Add Account Modal -->
        <div class="modal fade" id="add_Accounts_Modal" tabindex="-1" role="dialog" aria-labelledby="add_Accounts_Modal_Lebel"
        	aria-hidden="true">
        	<div class="modal-dialog modal-dialog-centered" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="add_Accounts_Modal_Lebel">Add Account Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
        				</button>
        			</div>
        			<div class="modal-body">

        				<div class="form-group mb-3"> 
                            <label class="control-label">Email</label>
                            <input id="add_email" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> 
                            <label class="control-label">Client ID</label>
                            <input id="add_client_id" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> 
                            <label class="control-label">Client Secret</label>
                            <input id="add_client_secret" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> 
                            <label class="control-label">Refresh Token</label>
                            <input id="add_refresh_token" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                    		id="add_status" class="form-control form-select" name="status">
                    			<option value="1" selected="">Active</option>
                    			<option value="0">Pause</option>
                    	</select> </div>

        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        				<button type="button" onclick="addAccountDetails()" class="btn btn-primary">Add</button>
        			</div>
        		</div>
        	</div>
        </div>

        <!-- Edit Account Modal -->
        <div class="modal fade" id="Edit_Accounts_Modal" tabindex="-1" role="dialog" aria-labelledby="Edit_Accounts_Modal_Lebel"
        	aria-hidden="true">
        	<div class="modal-dialog modal-dialog-centered" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="Edit_Accounts_Modal_Lebel">Edit Account Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
        				</button>
        			</div>
        			<div class="modal-body">
                        <input type="hidden" id="edit_account_id" name="edit_account_id" value="000">

        				<div class="form-group mb-3"> 
                            <label class="control-label">Email</label>
                            <input id="edit_email" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> 
                            <label class="control-label">Client ID</label>
                            <input id="edit_client_id" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> 
                            <label class="control-label">Client Secret</label>
                            <input id="edit_client_secret" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> 
                            <label class="control-label">Refresh Token</label>
                            <input id="edit_refresh_token" type="text" name="label" class="form-control" placeholder="" required=""> 
                        </div>

                        <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                    		id="edit_status" class="form-control form-select" name="status">
                    			<option value="1" selected="">Active</option>
                    			<option value="0">Pause</option>
                    	</select> </div>

        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        				<button type="button" onclick="updateAccountDetails()" class="btn btn-primary">Save</button>
        			</div>
        		</div>
        	</div>
        </div>

        <?php include("partials/footer.php"); ?>

    <script>
        function addAccountDetails() {
            var add_email = document.getElementById("add_email").value;
            var add_client_id = document.getElementById("add_client_id").value;
            var add_client_secret = document.getElementById("add_client_secret").value;
            var add_refresh_token = document.getElementById("add_refresh_token").value;
            var add_status = document.getElementById("add_status").value;
    
            var jsonObjects = {
                "add_email": add_email,
                "add_client_id": add_client_id,
                "add_client_secret": add_client_secret,
                "add_refresh_token": add_refresh_token,
                "add_status": add_status
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/addGdriveAccount') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        if(response=="invalid credentials") {
                            swal.fire({
                                title: 'Danger',
                                text: 'Invalid credentials :(',
                                icon: 'Danger'
                            }).then(function () {
                                
                            });
                        } else {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Account Added successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: 'Something Went Wrong :(',
                            icon: 'error'
                        }).then(function () {
                            location.reload();
                        });
                    }
                }
            });
        }

		function loadAccount(ID) {
            var jsonObjects = {
                "ID": ID
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/getGdriveAccount') ?>',
                data: jsonObjects,
                dataType: 'json',
                success: function (response) {
                    if (!response == "") {
                        $("#edit_account_id").val(response.id);
                        $("#edit_email").val(response.email);
                        $("#edit_client_id").val(response.client_id);
                        $("#edit_client_secret").val(response.client_secret);
                        $("#edit_refresh_token").val(response.refresh_token);
                        $("#edit_status").val(response.status);
                    }
                }
            });
        }

        function updateAccountDetails() {
            var edit_account_id = document.getElementById("edit_account_id").value;
            var edit_email = document.getElementById("edit_email").value;
            var edit_client_id = document.getElementById("edit_client_id").value;
            var edit_client_secret = document.getElementById("edit_client_secret").value;
            var edit_refresh_token = document.getElementById("edit_refresh_token").value;
            var edit_status = document.getElementById("edit_status").value;
    
            var jsonObjects = {
                "edit_account_id": edit_account_id,
                "edit_email": edit_email,
                "edit_client_id": edit_client_id,
                "edit_client_secret": edit_client_secret,
                "edit_refresh_token": edit_refresh_token,
                "edit_status": edit_status
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/updateGdriveAccount') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        if(response=="invalid credentials") {
                            swal.fire({
                                title: 'Warning',
                                text: 'Invalid credentials :(',
                                icon: 'warning'
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Account Updated successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: 'Something Went Wrong :(',
                            icon: 'error'
                        }).then(function () {
                            location.reload();
                        });
                    }
                }
            });
        }

		function deleteAccount(ID) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(function (result) {
                if (result.value) {
    
	    			$.ajax({
                      url: '<?= site_url('Admin_api/deleteGdriveAccount') ?>',
                      type: 'POST',
	    			  data : { ID : ID },
                      dataType:'text',
                        success: function(result){
	    					if(result) {
	    						swal.fire({
                                    title: 'Successful!',
                                    text: 'Account Deleted successfully!',
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
    </script>