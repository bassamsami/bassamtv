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
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="font-size-18">All Web Series</h4>

                                    <ol class="breadcrumb mb-0">

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Web Series</a></li>

                                        <li class="breadcrumb-item active">All Web Series</li>

                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                      <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="publish_all()">
                                      <i class="fas fa-share"></i> Publish All
                                      </button>
                                      <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="window.location.href='<?= site_url('add_web_series') ?>'">
                                        <i class="fas fa-plus me-2"></i> Add
                                      </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            			<!-- end page title -->

                        <div class="row">
                        	<div class="col-12">
                        		<div class="card">
                        			<div class="card-body">
                                        <div class="table-responsive">
                        				    <table id="datatable" class="table table-striped"
                        				    	style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        				    	<thead>
                        				    		<tr>
                        				    			<th>#</th>
                        				    			<th>##</th>
                        				    			<th>Thumbnail</th>
                        				    			<th>Name</th>
                        				    			<th>Description</th>
                        				    			<th>Status</th>
                        				    		</tr>
                        				    	</thead>
                        				    </table>
                                        </div>
                        			</div>
                        		</div>
                        	</div> <!-- end col -->

                        </div> <!-- end row -->
                       

            		</div> <!-- container-fluid -->

                    <!-- Telegram Notification Modal -->
                    <div class="modal fade" id="Telegram_Notification_Modal" tabindex="-1" role="dialog"
                        aria-labelledby="Telegram_Notification_Modal_Lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Add_Season_Modal_Lebel">Send Telegram Notification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
    
                                    <div class="form-group mb-3">
                        				<label>Name</label>
                        				<input class="form-control col-md-9" type="text" value="" id="TNName">
                        			</div>
                                    <div class="form-group mb-3">
                        			    <label>Description</label>
                        				<div>
                        					<textarea required="" class="form-control col-md-9" id="TNDescription" rows="5"></textarea>
                        				</div>
                        			</div>
                                    <div class="form-group mb-3">
                        				<label>Image</label>
                        				<input class="form-control col-md-9" type="text" value="" id="TNImage">
                        			</div>
                                </div>
                                <div class="modal-footer">
                            		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            		<button type="button" onclick="sendTelegramNotification()" class="btn btn-primary">Send</button>
                            	</div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Modal -->
                    <div class="modal fade" id="Notification_Modal" tabindex="-1" role="dialog"
                        aria-labelledby="Notification_Modal_Lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Add_Season_Modal_Lebel">Send Notification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="contentID" name="contentID" value="0">

                                    <div class="form-group mb-3">
                        				<label>Name</label>
                        				<input class="form-control col-md-9" type="text" value="" id="NName">
                        			</div>
                                    <div class="form-group mb-3">
                        			    <label>Description</label>
                        				<div>
                        					<textarea required="" class="form-control col-md-9" id="NDescription" rows="5"></textarea>
                        				</div>
                        			</div>
                                    <div class="form-group mb-3">
                        				<label>Large Icon</label>
                        				<input class="form-control col-md-9" type="text" value="" id="N_Large_Icon">
                        			</div>
                                    <div class="form-group mb-3">
                        				<label>Big Picture</label>
                        				<input class="form-control col-md-9" type="text" value="" id="N_Big_Picture">
                        			</div>
                                </div>
                                <div class="modal-footer">
                            		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            		<button type="button" onclick="sendNotification()" class="btn btn-primary">Send</button>
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
        var Onesignal_Api_Key = "<?php echo $config->onesignal_api_key ?>";
        var Onesignal_Appid = "<?php echo $config->onesignal_appid ?>";

        $('#datatable').dataTable({
            "order": [],
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('Admin_api/get_all_webseries') ?>",
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
                        return '<div class="btn-group mr-1 mt-2"> <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu" style=""> <a class="dropdown-item" onclick="Edit_Movie(' +
                            data +
                            ')" href="#">Edit WebSeries</a> <a class="dropdown-item" onclick="Manage_Seasons(' +
                            data +
                            ')" href="#">Manage Seasons</a> <a class="dropdown-item" id="Delete" onclick="Delete_Data(' +
                            data +
                            ')" href="#">Delete</a> <div class="dropdown-divider"></div> <a class="dropdown-item" onClick="loadNotificationData(' +
                                data + ')" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#Notification_Modal">Send Push Notification</a> <a class="dropdown-item" onClick="loadTelegramData(' +
                            data + ')" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#Telegram_Notification_Modal">Send Telegram Notification</a> </div> </div>';
                    }
                },
                {
                    "data": "3",
                    render: function (data) {
                        return '<img class="img-fluid" height="100" width="80" src=' + data +
                            ' data-holder-rendered="true">';
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

        function Delete_Data(ID) {

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
                        "WebSeriesID": ID
                    };
            
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('Admin_api/delete_web_series') ?>",
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Web Series Deleted Successfully!',
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

        function Edit_Movie(ID) {
            window.location.assign("edit_webSeries/" + ID);
        }

        function Manage_Seasons(ID) {
            window.location.assign("manage_seasons/" + ID);
        }

        function loadTelegramData(WebSeriesID) {
            $.ajax({
              url: '<?= site_url('Admin_api/getWebSeriesByID') ?>',
              type: 'POST',
			  data : { WebSeriesID : WebSeriesID },
              dataType:'json',
                success: function(result){
					if(result) {
                        $('#TNName').val(result.name);
                        $('#TNDescription').val(result.description);
                        $('#TNImage').val(result.banner);
					}
                }
            });
        }

        function sendTelegramNotification() {
            var TNName = document.getElementById("TNName").value;
            var TNDescription = document.getElementById("TNDescription").value;
            var TNImage = document.getElementById("TNImage").value;
            if(TNName != "" && TNDescription != "") {
                var jsonObjects = {
                    telegram_token: '<?php echo $config->telegram_token; ?>',
	                telegram_chat_id: '<?php echo $config->telegram_chat_id; ?>',
	                Heading: TNName,
                    Message: TNDescription,
	                image: TNImage
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/teligram') ?>',
                    data: jsonObjects,
                    dataType: 'text',
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
                        toastr.success("Sended Successfully!");
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

        function loadNotificationData(WebSeriesID) {
            $.ajax({
              url: '<?= site_url('Admin_api/getWebSeriesByID') ?>',
              type: 'POST',
			  data : { WebSeriesID : WebSeriesID },
              dataType:'json',
                success: function(result){
					if(result) {
                        $('#contentID').val(result.id);
                        $('#NName').val(result.name);
                        $('#NDescription').val(result.description);
                        $('#N_Large_Icon').val(result.poster);
                        $('#N_Big_Picture').val(result.banner);
					}
                }
            });
        }
        function sendNotification() {
            var idd = document.getElementById("contentID").value;
            var Heading = document.getElementById("NName").value;
            var Message = document.getElementById("NDescription").value;
            var Large_Icon = document.getElementById("N_Large_Icon").value;
            var Big_Picture = document.getElementById("N_Big_Picture").value;

            var Web_series_id = document.getElementById("contentID").value;

            if (Heading != "" && Message != "") {
                var jsonObjects = {
                    "included_segments": ["All"],
                    "app_id": Onesignal_Appid,
                    "contents": {
                        "en": Message
                    },
                    "headings": {
                        "en": Heading
                    },
                    "data": {
                        "Type": "Web Series",
                        "Web_Series_id": Web_series_id
                    },
                    "big_picture": Big_Picture,
                    "large_icon": Large_Icon
                };

                $.ajax({
                    type: 'POST',
                    url: 'https://onesignal.com/api/v1/notifications',
                    headers: {
                        'Authorization': 'Basic ' + Onesignal_Api_Key,
                        'Content-Type': 'application/json'
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
                        toastr.success("Notification Sended Successfully!");
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
        
        function publish_all() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, publish all!"
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            title: 'Please Wait',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            onOpen: ()=>{
                                Swal.showLoading();
                            },
                            onClose: ()=>{
                                $('#datatable').DataTable().ajax.reload();
                            }
                        });

                        $.ajax({
                          url: '<?= site_url('Admin_api/publish_all/2') ?>',
                          type: 'GET',
                            success: function(result){
                                Swal.close();
                                if(result > 0) {
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
                                    toastr.success("Total Published: " + result, "Published Successfully!");
                                } else{
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
                                    toastr.warning("Nothing to Publish!");
                                }
                            }
                        });
                    }
                });
            }
    </script>