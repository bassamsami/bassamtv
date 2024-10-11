<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
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

                                <h4 class="font-size-18">All Channels</h4>

                                <ol class="breadcrumb mb-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Live TV</a></li>

                                    <li class="breadcrumb-item active">All Channels</li>

                                </ol>

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
                                                    <th>Stream Type</th>
                                                    <th>Url</th>
                                                    <th>Status</th>
                                                    <th>Featured</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>

                            </div>

                        </div> <!-- end col -->

                    </div> <!-- end row -->

                </div> <!-- container-fluid -->

            </div>


            <?php include("partials/footer_rights.php"); ?>

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
                                <input class="form-control col-md-9" type="text" value="" id="NDescription">
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
                            <button type="button" onclick="sendNotification()" class="btn btn-primary" data-bs-dismiss="modal"><i class="mdi mdi-telegram" aria-hidden="true"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>


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
                "url": "<?= site_url('Admin_api/get_all_channel') ?>",
                "type": "GET",
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
                        return '<div class="btn-group mr-1 mt-2"> <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu" style=""> <a class="dropdown-item" onclick="Edit_Channel(' +
                            data +
                            ')" href="#">Edit Channel</a> <a class="dropdown-item" id="Delete" onclick="Delete_Data(' +
                            data +
                            ')" href="#">Delete</a> <div class="dropdown-divider"></div> <a class="dropdown-item" onclick="loadNotificationData(' +
                            data +
                            ')" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#Notification_Modal">Send Push Notification</a> </div> </div>';
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
                        var length = 55;
                        return data.length > length ?
                            data.substring(0, length - 3) + "..." :
                            data;
                    }
                },
                {
                    "data": "7",
                    render: function (data) {
                        if (data == 0) {
                            return '<span class="badge bg-danger">UnPublished</span';
                        } else if (data == 1) {
                            return '<span class="badge bg-success">Published</span>';
                        }
                    }
                },
                {
                    "data": "8",
                    render: function (data) {
                        if (data == 0) {
                            return '<i class="typcn typcn-times"></i>';
                        } else if (data == 1) {
                            return '<i class="typcn typcn-tick"></i>';
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
                        "channelID": ID
                    };
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('Admin_api/delete_channel') ?>",
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Channel Deleted Successfully!',
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

        function Edit_Channel(ID) {
            window.location.assign("edit_channel/" + ID);
        }

        function loadNotificationData(ID) {
            $.ajax({
                type: "POST",
                url: window.location.href,
                data: {
                    notify_data: 'notify_data',
                    ID: ID
                },
                dataType: 'json',
                success: function (response) {
                    $('#contentID').val(response.id);
                    $('#NName').val(response.name);
                    $('#NDescription').val("🔴 Live: Watch Now");
                    $('#N_Large_Icon').val(response.banner);
                    $('#N_Big_Picture').val(response.banner);
                }
              });
              Swal.close();
        }

        function sendNotification() {
            var contentID = document.getElementById("contentID").value;
            var Heading = document.getElementById("NName").value;
            var Message = document.getElementById("NDescription").value;
            var Large_Icon = document.getElementById("N_Large_Icon").value;
            var Big_Picture = document.getElementById("N_Big_Picture").value;

            Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                },
                onClose: () => {

                }
            });
            $.ajax({
                type: "POST",
                url: window.location.href,
                data: {
                    send_notification: 'send_notification',
                    heading: Heading,
                    message: Message,
                    large_icon: Large_Icon,
                    big_picture: Big_Picture
                },
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
            });
            Swal.close();
        }
    </script>