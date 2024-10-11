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

            						<h4 class="font-size-18">DB Manager</h4>

            						<ol class="breadcrumb mb-0">

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">System</a></li>
                                        
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Database</a></li>
                                        
                                        <li class="breadcrumb-item active">DB Manager</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">DB Manager</h4>
                                        <p class="card-title-desc">Manage your Database Tables
                                        </p>

                                        
                                            <?php foreach ($tables as $table) { ?>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                                id="<?php echo $table ?>" name="value[]" value="<?php echo $table ?>">
                                                    <label class="custom-control-label" for="<?php echo $table ?>"><?php echo $table ?></label>
                                                                        
                                                </div>
                                                                
                                            <?php } ?>
                                        
    
                                            <div class="mb-3">
                                                <div class="col-md-12 row justify-content-end">
                                                    <button class="btn btn-danger waves-effect waves-light col-md-2"
                                                        id="create_btn" type="submit" onclick="Truncate()">
                                                        <i class="mdi mdi-delete"></i> TRUNCATE
                                                    </button>
                                                </div>
                                            </div>

                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
            			

            		</div> <!-- container-fluid -->

            	</div>


            	<?php include("partials/footer_rights.php"); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>

        <script>
            function Truncate(){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f46a6a",
                    cancelButtonColor: "#34c38f",
                    confirmButtonText: "Yes, delete it!"
                }).then(function (result) {
                    if (result.value) {
                        var checked = document.querySelectorAll(':checked');
                        var res = Array.from(checked).map(c => c.value).join(',');
                        $.ajax({
                          url: '<?= site_url('Admin_api/TruncateTables') ?>',
                          type: 'POST',
				          data: {"tables": res},
                          dataType:'text',
                            success: function(result){
				        		if(result) {
				        			swal.fire({
                                        title: 'Successful!',
                                        text: 'Table Deleted successfully!',
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