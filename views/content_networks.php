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

            						<h4 class="font-size-18">Content Networks</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Special</a></li>

            							<li class="breadcrumb-item active">Content Networks</li>

            						</ol>

            					</div>

            				</div>

                            <div class="col-sm-6 row justify-content-end">
                				<a class="btn btn-primary dropdown-toggle waves-effect waves-light col-sm-3" data-bs-toggle="modal" data-bs-target="#add_content_network_modal"> <i
                                    class="mdi mdi-plus-box-multiple-outline mr-2"></i> Add Network</a>
                			</div>

            			</div>

            			<!-- end page title -->

            			<div class="row">

            				<div class="col-12">

            					<div class="card">

            						<div class="card-body">

            							<table id="datatable" class="table table-striped"
            								style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            								<thead>

            									<tr>

            										<th>#</th>

            										<th>##</th>

            										<th>Logo</th>

            										<th>Name</th>

            										<th>Networks Order</th>

            										<th>Status</th>

            									</tr>

            								</thead>

            							</table>



            						</div>

            					</div>

            				</div> <!-- end col -->

            			</div> <!-- end row -->



            		</div> <!-- container-fluid -->

                    <!-- Add Network Modal -->
                    <div class="modal fade" id="add_content_network_modal" tabindex="-1" role="dialog"
                        aria-labelledby="add_content_network_modal_Lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add_content_network_modal_Lebel">Add Content Network</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group mb-3"> 
                                        <label class="control-label">Network Name</label>
                                        <input id="add_network_name" type="text" name="label" class="form-control" placeholder="" required=""> 
                                    </div>

                                    <div class="form-group mb-3"> 
                                        <label class="control-label">Network Logo</label>
                                        <input id="add_network_logo" type="text" name="label" class="form-control" placeholder="" required=""> 
                                    </div>

                                    <div class="form-group mb-3"> 
                                        <label class="control-label">Network Order</label>
                                        <input id="add_network_order" type="number" name="label" class="form-control" placeholder="" required=""> 
                                    </div>

                                    <div class="form-group mb-3"> 
                                       <label class="control-label">Status</label> 
                                        <select id="add_network_status" class="form-control form-select" name="source">
                    						<option value="Publish" selected="">Publish</option>
                    						<option value="Unpublish">Unpublish</option>
                    				    </select>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="addContentNetwork()" class="btn btn-primary"
                                            id="save_btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Network Modal -->
                    <div class="modal fade" id="edit_content_network_modal" tabindex="-1" role="dialog"
                        aria-labelledby="edit_content_network_modal_Lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_content_network_modal_Lebel">Edit Content Network</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="edit_networkID" name="edit_networkID" value="000">
    
                                    <div class="form-group mb-3"> 
                                        <label class="control-label">Network Name</label>
                                        <input id="edit_network_name" type="text" name="label" class="form-control" placeholder="" required=""> 
                                    </div>

                                    <div class="form-group mb-3"> 
                                        <label class="control-label">Network Logo</label>
                                        <input id="edit_network_logo" type="text" name="label" class="form-control" placeholder="" required=""> 
                                    </div>

                                    <div class="form-group mb-3"> 
                                        <label class="control-label">Network Order</label>
                                        <input id="edit_network_order" type="number" name="label" class="form-control" placeholder="" required=""> 
                                    </div>

                                    <div class="form-group mb-3"> 
                                       <label class="control-label">Status</label> 
                                        <select id="edit_network_status" class="form-control form-select" name="source">
                    						<option value="Publish" selected="">Publish</option>
                    						<option value="Unpublish">Unpublish</option>
                    				    </select>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="editContentNetwork()" class="btn btn-primary"
                                            id="edit_btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            	</div>
            	<!-- End Page-content -->

            	<?php include("partials/footer_rights.php"); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>

        <script>
            $('#datatable').dataTable({
                "order": [],
                "ordering": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('Admin_api/getAllContentNetworks') ?>",
                    "type":"GET",
                },
                "columns": [{
                        "data": "1",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "2",
                        render: function (data) {
                            return '<div class="d-none d-sm-block"><div class="dropdown d-inline-block"><a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"aria-expanded="false">Options <i class="mdi mdi-chevron-down"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#edit_content_network_modal" onclick="loadContentNetwork(' +
                                data + ')">Edit Network</a><a class="dropdown-item" onclick="DeleteContentNetwork(' +
                                data + ')">Delete</a></div></div>';
                        }
                    },
                    {
                        "data": "3",
                        render: function (data) {
                           return '<img class="img-fluid" height="100" width="80" src='+ data +' data-holder-rendered="true">';
                        }
                    },
                    {
                        "data": "4"
                    },
                    {
                        "data": "5"
                    },
                    {
                        "data": "6",
                        render: function (data) {
                            if (data == 0) {
                                return '<span class="badge bg-danger">UnPublished</span>';
                            } else if (data == 1) {
                                return '<span class="badge bg-success">Published</span>';
                            }
                        }
                    }
                ]
            });

            function DeleteContentNetwork(ID) {
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
                          url: '<?= site_url('Admin_api/DeleteContentNetwork') ?>',
                          type: 'POST',
				          data : { ID : ID },
                          dataType:'json',
                            success: function(result){
				        		if(result) {
				        			swal.fire({
                                        title: 'Successful!',
                                        text: 'Content Network Deleted successfully!',
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

            function loadContentNetwork(ID) {
                var jsonObjects = {
                    "networkID": ID
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/getContentNetworkDetails') ?>',
                    data: jsonObjects,
                    dataType: 'json',
                    success: function (response) {
                        var id = response.id;
                        var name = response.name;
                        var logo = response.logo;
                        var networks_order = response.networks_order;
                        var status = response.status;
        
        
                        if (!id == "") {
                            $("#edit_networkID").val(id);
                            $("#edit_network_name").val(name);
                            $("#edit_network_logo").val(logo);
                            $("#edit_network_order").val(networks_order);
                            
                            if (status == "1") {
                                $("#edit_network_status").val("Publish");
                            } else if (status == "0") {
                                $("#edit_network_status").val("Unpublish");
                            }
                        }
                    }
                });
            }

            function editContentNetwork() {
                var edit_networkID = document.getElementById("edit_networkID").value;
                var edit_network_name = document.getElementById("edit_network_name").value;
                var edit_network_logo = document.getElementById("edit_network_logo").value;
                var edit_network_order = document.getElementById("edit_network_order").value;

                var edit_network_status = document.getElementById("edit_network_status").value;
                if (edit_network_status == "Publish") {
                    var edit_network_status_int = "1";
                } else if (edit_network_status == "Unpublish") {
                    var edit_network_status_int = "0";
                }

                var jsonObjects = {
                    "edit_networkID": edit_networkID,
                    "edit_network_name": edit_network_name,
                    "edit_network_logo": edit_network_logo,
                    "edit_network_order": edit_network_order,
                    "edit_network_status": edit_network_status_int
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/updateContentNetwork') ?>',
                    data: jsonObjects,
                    dataType: 'text',
                    success: function (response) {
                        if (response) {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Content Network Updated successfully!',
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

            function addContentNetwork() {
                var add_network_name = document.getElementById("add_network_name").value;
                var add_network_logo = document.getElementById("add_network_logo").value;
                var add_network_order = document.getElementById("add_network_order").value;

                var add_network_status = document.getElementById("add_network_status").value;
                if (add_network_status == "Publish") {
                    var add_network_status_int = "1";
                } else if (add_network_status == "Unpublish") {
                    var add_network_status_int = "0";
                }

                var jsonObjects = {
                    "add_network_name": add_network_name,
                    "add_network_logo": add_network_logo,
                    "add_network_order": add_network_order,
                    "add_network_status": add_network_status_int
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/addContentNetwork') ?>',
                    data: jsonObjects,
                    dataType: 'text',
                    success: function (response2) {
                        if (response2 != "") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Content Network Added Successfully!',
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
            
        </script>