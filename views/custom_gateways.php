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

            						<h4 class="font-size-18">Subscription Setting</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Subscription Setting</a></li>

            							<li class="breadcrumb-item active">Custom Payment Gateways</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->

						<div class="row">

							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin mb-4">
                                        <div>
                                            <h4 class="mb-3 mb-md-0">Custom Gateway Types</h4>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap text-nowrap">
                                            <div class="panel-heading">
                                                <button data-bs-toggle="modal" data-bs-target="#custom_payment_type_Modal"
                                                    id="create_custom_payment_type"
                                                    class="btn btn-sm btn-primary waves-effect waves-light"><span
                                                        class="btn-label"><i class="fa fa-plus"></i></span>
                                                    add Payment Methode</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
										<div class="table-responsive">
											<table class="table table-hover table-centered table-nowrap mb-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Type</th>
														<th>Payment Details</th>
														<th>Status</th>
                                                        <th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
                                      $decoded_custom_payment_type = json_decode($custom_payment_type);
                                      foreach($decoded_custom_payment_type as $custom_payment_type_item) {
                                        ?>
													<tr>
														<th scope="row"><?php echo $custom_payment_type_item->M_I; ?></th>
														<th scope="row"><?php echo $custom_payment_type_item->type; ?></th>
														<th scope="row"><?php echo $custom_payment_type_item->payment_details; ?></th>

														<?php
                                                            if ($custom_payment_type_item->status == 0) {
                                                                ?><th scope="row"><span class="badge bg-danger">UnPublished</span></th><?php
                                                            } else if ($custom_payment_type_item->status == 1) {
                                                                ?><th scope="row"><span class="badge bg-success">Published</span></th><?php
                                                            }
                                                        ?>
                                                        <th>
                                                            <div class="d-flex gap-2 mb-3">
                                                                <button type="button" class="btn btn-danger" onclick="Delete_custom_payment_type('<?php echo $custom_payment_type_item->id; ?>')">
                                                                <i class="fa fa-solid fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </th>
													</tr>
													<?php
                                        }
                                        ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
            			

            		</div> <!-- container-fluid -->

                    <!-- Custom Payment Type Modal -->
                    <div class="modal fade" id="custom_payment_type_Modal" tabindex="-1" role="dialog"
                        aria-labelledby="custom_payment_type_Modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Add_Season_Modal_Lebel">Add Custom Payment Option</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group mb-3"> <label class="control-label">Payment Type</label>&nbsp;&nbsp;<input id="payment_type_modal" type="text"
                                        name="payment_type_modal" class="form-control" placeholder="" required=""> </div>

                                    <div class="form-group mb-3">
                                        <label class="col-sm-3 control-label">Payment Details</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" type="text" value="" name="payment_details_modal" id="payment_details_modal"
                                                placeholder="" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                                            id="modal_status_modal" class="form-control form-select" name="modal_status_modal">
                                            <option value="1" selected="">Published</option>
                                            <option value="0">UnPublished</option>
                                        </select> </div>

                                    <div class="modal-footer">
                                        <button type="button" onclick="custom_payment_type_add()" class="btn btn-primary"
                                            id="custom_payment_type_add_btn">Add</button>
                                    </div>
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

    <script>
        $( document ).ready(function() {
           
			
        });

        function custom_payment_type_add() {
            var payment_type_modal = document.getElementById("payment_type_modal").value;
            var payment_details_modal = document.getElementById("payment_details_modal").value;
            var modal_status_modal = document.getElementById("modal_status_modal").value;
            var jsonObjects = {
                "payment_type_modal": payment_type_modal,
                "payment_details_modal": payment_details_modal,
                "modal_status_modal": modal_status_modal,
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/add_custom_payment_type') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Custom Payment Type Added Successfully!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#556ee6',
                            cancelButtonColor: "#f46a6a"
                        }).then(function () {
                            location.reload();
                        });
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

        function Delete_custom_payment_type(ID) {
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
                    var jsonObjects = {
                        "ID": ID
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/Delete_custom_payment_type') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Payment Type Deleted successfully!',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#556ee6',
                                    cancelButtonColor: "#f46a6a"
                                }).then(function () {
                                    location.reload();
                                });
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
            });
        }
    </script>