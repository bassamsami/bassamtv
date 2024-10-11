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

                					<h4 class="font-size-18">DB Export</h4>

                					<ol class="breadcrumb mb-0">

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

										<li class="breadcrumb-item"><a href="javascript: void(0);">System</a></li>

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Database</a></li>

                						<li class="breadcrumb-item active">DB Export</li>

                					</ol>

                				</div>

                			</div>

                			<div class="col-sm-6 row justify-content-end">
                					<a href="" class="btn btn-primary dropdown-toggle waves-effect waves-light col-sm-3"
                						data-bs-toggle="modal" data-bs-target="#Add_Genre_Modal" onclick='onCreateClick()'> <i
                							class="mdi mdi-plus-box-multiple-outline mr-2"></i> Create Backup</a>
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
                									<th>Name</th>
													<th>Size</th>
                									<th>##</th>
                								</tr>

                							</thead>
                							<tbody>
                								<?php $i = 0; foreach($files as $file) { 
                                                     if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                                                    $i++;
                ?>
                								<tr>
                									<th scope="row"><?php echo $i; ?></th>
                									<th scope="row"><?php echo $file; ?></th>
													<th scope="row"><?php echo sizeFilter(FCPATH . "backup/db/".$file); ?></th>
                									<th scope="row">
                										<div class="d-none d-sm-block">
                											<div class="dropdown d-inline-block">
                												<a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                													id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                													aria-expanded="false">
                													Options <i class="mdi mdi-chevron-down"></i>
                												</a>

                												<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                													<a class="dropdown-item"
                														onclick="downloadDB('<?php echo $file; ?>')">Download</a>
                													<a class="dropdown-item" onclick="deleteDB('<?php echo $file; ?>')">Delete</a>
                												</div>
                											</div>
                										</div>
                									</th>
                								</tr>
                								<?php
            } }?>
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

        <!-- Create DB Backup Modal -->
        <div class="modal fade" id="Add_Genre_Modal" tabindex="-1" role="dialog" aria-labelledby="Add_Genre_Modal_Lebel"
        	aria-hidden="true">
        	<div class="modal-dialog modal-dialog-centered" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="Add_Genre_Modal_Lebel">Create Backup</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
        				</button>
        			</div>
        			<div class="modal-body">

        				<div class="panel-heading">
        					<h3 class="panel-title row justify-content-center">Add Backup Information</h3>
        				</div>

        				<hr>

        				<div class="form-group"> <label class="control-label">
        						Name</label>&nbsp;&nbsp;<input id="modal_createBackup_Name" type="text" name="label"
        						class="form-control" placeholder="name" required=""> </div>

        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        				<button type="button" onclick="createBackup()" class="btn btn-primary">Create</button>
        			</div>
        		</div>
        	</div>
        </div>

        <?php include("partials/footer.php"); ?>

		<?php
		function sizeFilter($path)
		{
			$size = filesize($path);
			$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
			$power = $size > 0 ? floor(log($size, 1024)) : 0;
			return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
		}
		?>

    <script>
        function onCreateClick() {
            $("#modal_createBackup_Name").val("DB-Backup");
        }

		function createBackup() {
            var modal_createBackup_Name = document.getElementById("modal_createBackup_Name").value;

			$.ajax({
              url: '<?= site_url('Admin_api/createDbBackup') ?>',
              type: 'POST',
			  data : { name : modal_createBackup_Name },
              dataType:'text',
                success: function(result){
					if(result) {
						swal.fire({
                            title: 'Successful!',
                            text: 'Database Backup successfully!',
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

        function downloadDB(file) {
            var link = document.createElement("a");
            link.setAttribute('download', file);
            link.href = "<?php echo base_url()."backup/db/"; ?>"+file;
            document.body.appendChild(link);
            link.click();
            link.remove();
        }

		function deleteDB(file) {
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
                      url: '<?= site_url('Admin_api/deleteDB') ?>',
                      type: 'POST',
	    			  data : { file : file },
                      dataType:'text',
                        success: function(result){
	    					if(result) {
	    						swal.fire({
                                    title: 'Successful!',
                                    text: 'Database Deleted successfully!',
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