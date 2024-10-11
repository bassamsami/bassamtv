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

                					<h4 class="font-size-18">Genrer Manager</h4>

                					<ol class="breadcrumb mb-0">

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Special</a></li>

                						<li class="breadcrumb-item active">Genrer Manager</li>

                					</ol>

                				</div>

                			</div>

                			<div class="col-sm-6 row justify-content-end">
                				<a class="btn btn-primary dropdown-toggle waves-effect waves-light col-sm-3" data-bs-toggle="modal" data-bs-target="#Add_Genre_Modal"> <i
                                    class="mdi mdi-plus-box-multiple-outline mr-2"></i> Add genre</a>
                			</div>

                		</div>

            			<!-- end page title -->


                        <div class="form" action="" method="post">

                        	<div class="row">

                        		<div class="col-md-12">

                        			<div class="card card-body">
                                        <div class="table-responsive">
                        				    <table id="datatable" class="table table-striped"
                        				    	style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        				    	<thead>

                        				    		<tr>

                        				    			<th>#</th>

                        				    			<th>##</th>

                        				    			<th>Icon</th>

                        				    			<th>Name</th>

                        				    			<th>Description</th>

                        				    			<th>featured</th>

                        				    			<th>Status</th>

                        				    		</tr>

                        				    	</thead>

                                            </table>
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

        <!-- Add Genre Modal -->
    <div class="modal fade" id="Add_Genre_Modal" tabindex="-1" role="dialog" aria-labelledby="Add_Genre_Modal_Lebel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Add_Genre_Modal_Lebel">Add Genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <div class="panel-heading">
                        <h3 class="panel-title row justify-content-center">New Genre information</h3>
                    </div>

                    <hr>

                    <div class="form-group mb-3"> <label class="control-label">
                            Name</label>&nbsp;&nbsp;<input id="modal_Genre_Name" type="text" name="label"
                            class="form-control" placeholder="Genre 1" required=""> </div>

                    <div class="form-group mb-3"> <label class="control-label">
                            Icon</label>&nbsp;&nbsp;<input id="modal_Genre_Icon" type="text" name="label"
                            class="form-control" placeholder="" required=""> </div>

                    <div class="form-group mb-3"> <label class="control-label">description</label>
                        <textarea id="modal_Genre_Description" class="form-control" rows="3"
                            placeholder="Add Your Genre Description Here."
                            style="margin-top: 0px; margin-bottom: 0px; height: 145px;"></textarea>
                    </div>

                    <div class="form-group mb-3"> <label class="control-label">Featured</label> <select
                            id="modal_Genre_Featured" class="form-control" name="source" id="selected-source">
                            <option value="No" selected="">No</option>
                            <option value="Yes">Yes</option>
                        </select> </div>

                    <div class="form-group mb-3"> <label class="control-label">Status</label> <select id="modal_Genre_Status"
                            class="form-control" name="source" id="selected-source">
                            <option value="Publish" selected="">Publish</option>
                            <option value="Unpublish">Unpublish</option>
                        </select><br> </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="Add_Genre()" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Edit Genre Modal -->
    <div class="modal fade" id="Edit_Genre_Modal" tabindex="-1" role="dialog" aria-labelledby="Add_Genre_Modal_Lebel"
    	aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="Edit_Genre_Modal_Lebel">Edit Genre</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    				</button>
    			</div>
    			<div class="modal-body">
    				<input type="hidden" id="Edit_modal_Genre_id" name="Edit_modal_Genre_id" value="000">

    				<div class="panel-heading">
    					<h3 class="panel-title row justify-content-center">Edit Genre information</h3>
    				</div>

    				<hr>

    				<div class="form-group"> <label class="control-label">
    						Name</label>&nbsp;&nbsp;<input id="Edit_modal_Genre_Name" type="text" name="label"
    						class="form-control" placeholder="Genre 1" required=""> </div>

    				<div class="form-group"> <label class="control-label">
    						Icon</label>&nbsp;&nbsp;<input id="Edit_modal_Genre_Icon" type="text" name="label"
    						class="form-control" placeholder="" required=""> </div>

    				<div class="form-group"> <label class="control-label">description</label>
    					<textarea id="Edit_modal_Genre_Description" class="form-control" rows="3"
    						placeholder="Add Your Genre Description Here."
    						style="margin-top: 0px; margin-bottom: 0px; height: 145px;"></textarea>
    				</div>

    				<div class="form-group"> <label class="control-label">Featured</label> <select
    						id="Edit_modal_Genre_Featured" class="form-control" name="source" id="selected-source">
    						<option value="No" selected="">No</option>
    						<option value="Yes">Yes</option>
    					</select> </div>

    				<div class="form-group"> <label class="control-label">Status</label> <select
    						id="Edit_modal_Genre_Status" class="form-control" name="source" id="selected-source">
    						<option value="Publish" selected="">Publish</option>
    						<option value="Unpublish">Unpublish</option>
    					</select><br> </div>

    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    				<button type="button" onclick="Update_Genre()" class="btn btn-primary">Update</button>
    			</div>
    		</div>
    	</div>
    </div>

        <?php include("partials/footer.php"); ?>

    <script>
       $('#datatable').dataTable({
        "order": [],
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "ajax": '<?= site_url('Admin_api/get_all_genres') ?>',
        "columns": [{
                "data": "1",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "2",
                render: function (data) {
                    return '<div class="btn-group mr-1 mt-2"> <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">Edit</button> <div class="dropdown-menu" style=""> <a class="dropdown-item" onclick="Load_Data(' +
                        data + ')" href="#" data-bs-toggle="modal" data-bs-target="#Edit_Genre_Modal">Edit Genre</a> <a class="dropdown-item" id="Delete" onclick="Delete_Genre(' +
                        data + ')" href="#">Delete</a></div>';
                }
            },
            {
                "data": "3",
                render: function (data) {
                    if(data != "") {
                        return '<img class="d-flex align-self-center rounded mr-3 rounded-circle" src='+ data +' alt="Generic placeholder image" height="60" width="60">';
                    } else {
                        return '<img class="d-flex align-self-center rounded mr-3 rounded-circle" src="assets/images/placeholder.jpg" alt="Generic placeholder image" height="60" width="60">';
                    }
                   
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
                        return '<span class="badge bg-warning">Not Featured</span>';
                    } else if (data == 1) {
                        return '<span class="badge bg-info">Featured</span>';
                    }
                }
            },
            {
                "data": "7",
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

    function Delete_Genre(ID) {
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
                    genreID: ID
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/delete_genre') ?>',
                    data: jsonObjects,
                    dataType: 'text',
                    success: function (response) {
                        if (response) {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Genre Deleted Successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                title: 'Error',
                                text: 'Something Went Wrong :(',
                                icon: 'error'
                            }).then(function() {
                                location.reload();
                            });
                        }

                    }
                });
            }
        });
    }


    function Add_Genre() {
        var modal_Genre_Name = document.getElementById("modal_Genre_Name").value;
        var modal_Genre_Icon = document.getElementById("modal_Genre_Icon").value;
        var modal_Genre_Description = document.getElementById("modal_Genre_Description").value;

        var modal_Genre_Featured = document.getElementById("modal_Genre_Featured").value;
        var modal_Genre_Status = document.getElementById("modal_Genre_Status").value;

        if (modal_Genre_Featured == "Yes") {
            var Genre_Featured = "1";
        } else if (modal_Genre_Featured == "No") {
            var Genre_Featured = "0";
        }

        if (modal_Genre_Status == "Publish") {
            var Genre_Status = "1";
        } else if (modal_Genre_Status == "Unpublish") {
            var Genre_Status = "0";
        }

        var jsonObjects = {
            modal_Genre_Name: modal_Genre_Name,
            modal_Genre_Icon: modal_Genre_Icon,
            modal_Genre_Description: modal_Genre_Description,
            Genre_Featured: Genre_Featured,
            Genre_Status: Genre_Status
        };

        $.ajax({
            type: 'POST',
            url: '<?= site_url('Admin_api/add_genre') ?>',
            data: jsonObjects,
            dataType: 'text',
            success: function (response) {
                if (response != "") {
                    swal.fire({
                        title: 'Successful!',
                        text: 'Genre Added Successfully!',
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
                    }).then(function() {
                        location.reload();
                    });
                }
            }
        });
    }

    function Load_Data(ID) {
        var jsonObjects = {
            genreID: ID
        };
        $.ajax({
            type: 'POST',
            url: '<?= site_url('Admin_api/get_genre_details') ?>',
            data: jsonObjects,
            dataType: 'json',
            success: function (response) {
                var Edit_modal_Genre_id = response.id;
                var Edit_modal_Genre_Name = response.name;
                var Edit_modal_Genre_Icon = response.icon;
                var Edit_modal_Genre_Description = response.description;
                var Edit_modal_Genre_Featured = response.featured;
                var Edit_modal_Genre_Status = response.status;

                if (!Edit_modal_Genre_id == "") {
                    $("#Edit_modal_Genre_id").val(Edit_modal_Genre_id);
                    $("#Edit_modal_Genre_Name").val(Edit_modal_Genre_Name);
                    $("#Edit_modal_Genre_Icon").val(Edit_modal_Genre_Icon);
                    $("#Edit_modal_Genre_Description").val(Edit_modal_Genre_Description);

                    if (Edit_modal_Genre_Featured == "1") {
                        $("#Edit_modal_Genre_Featured").val("Yes");
                    } else if (Edit_modal_Genre_Featured == "0") {
                        $("#Edit_modal_Genre_Featured").val("No");
                    }

                    if (Edit_modal_Genre_Status == "1") {
                        $("#Edit_modal_Genre_Status").val("Publish");
                    } else if (Edit_modal_Genre_Status == "0") {
                        $("#Edit_modal_Genre_Status").val("Unpublish");
                    }
                }
            }
        });
    }

    function Update_Genre() {
        var Edit_modal_Genre_id = document.getElementById("Edit_modal_Genre_id").value;
        var Edit_modal_Genre_Name = document.getElementById("Edit_modal_Genre_Name").value;
        var Edit_modal_Genre_Icon = document.getElementById("Edit_modal_Genre_Icon").value;
        var Edit_modal_Genre_Description = document.getElementById("Edit_modal_Genre_Description").value;

        var Edit_modal_Genre_Featured = document.getElementById("Edit_modal_Genre_Featured").value;
        var Edit_modal_Genre_Status = document.getElementById("Edit_modal_Genre_Status").value;

        if (Edit_modal_Genre_Featured == "Yes") {
            var Edit_Genre_Featured = "1";
        } else if (Edit_modal_Genre_Featured == "No") {
            var Edit_Genre_Featured = "0";
        }

        if (Edit_modal_Genre_Status == "Publish") {
            var Edit_Genre_Status = "1";
        } else if (Edit_modal_Genre_Status == "Unpublish") {
            var Edit_Genre_Status = "0";
        }

        var jsonObjects = {
            Edit_modal_Genre_id: Edit_modal_Genre_id,
            Edit_modal_Genre_Name: Edit_modal_Genre_Name,
            Edit_modal_Genre_Icon: Edit_modal_Genre_Icon,
            Edit_modal_Genre_Description: Edit_modal_Genre_Description,
            Edit_Genre_Featured: Edit_Genre_Featured,
            Edit_Genre_Status: Edit_Genre_Status
        };
        $.ajax({
            type: 'POST',
            url: '<?= site_url('Admin_api/update_genre_details') ?>',
            data: jsonObjects,
            dataType: 'text',
            success: function (response) {
                if (response) {
                    swal.fire({
                        title: 'Successful!',
                        text: 'Genre Updated successfully!',
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
                    }).then(function() {
                        location.reload();
                    });
                }
            }
        });
    }

    </script>