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

            						<h4 class="font-size-18">User Manager</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Miscellaneous</a></li>

            							<li class="breadcrumb-item active">Users</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="card card-body">
                        			<div class="panel-heading">
                        				<button data-bs-toggle="modal" data-bs-target="#Add_User_Modal" id="Add_User"
                        					class="btn btn-sm btn-primary waves-effect waves-light"><span
                        						class="btn-label"><i class="fa fa-plus"></i></span>Add User</button>

                        			</div>

                        			<br>
                                    <div class="table-responsive">
                        			    <table id="datatable" class="table table-striped"
                        			    	style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    
                        			    	<thead>
    
                        			    		<tr>
    
                        			    			<th>#</th>
    
                        			    			<th>##</th>
    
                        			    			<th>Full Name</th>
    
                        			    			<th>Email</th>
    
                        			    			<th>Role</th>
    
                        			    			<th>Subscription</th>
    
                        			    		</tr>
    
                        			    	</thead>
    
                        			    </table>
                                    </div>
                        		</div>
                        	</div>
                        </div>


                        <!-- Add User Modal -->
                        <div class="modal fade" id="Add_User_Modal" tabindex="-1" role="dialog"
                             aria-labelledby="Add_User_Modal_Lebel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="Add_User_Modal_Lebel">Add New User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel-body">
                                            <input type="hidden" id="Add_modal_User_id" name="modal_videos_id" value="000">
                                            <div class="form-group mb-3"> <label class="control-label">User
                                                    Name</label>&nbsp;&nbsp;<input id="add_modal_User_Name" type="text"
                                                                                   name="label" class="form-control" placeholder="" required="">
                                            </div>
                                            <div class="form-group mb-3"> <label class="control-label">Email
                                                </label>&nbsp;&nbsp;<input id="Add_modal_Email" type="text" name="label"
                                                                           class="form-control" placeholder="" required="">
                                            </div>
                                            <div class="form-group mb-3"> <label class="control-label">Password
                                                </label>&nbsp;&nbsp;<input id="Add_modal_Password" type="text" name="label"
                                                                           class="form-control" placeholder="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="Add_User()" class="btn btn-primary">Add
                                            User</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit User Modal -->
                        <div class="modal fade" id="Edit_this_User_Modal" tabindex="-1" role="dialog"
                             aria-labelledby="Edit_this_User_Modal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="Edit_this_User_Modal">Edit User Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel-body">
                                            <input type="hidden" id="Edit_this_modal_User_id" name="Edit_modal_User_id" value="000">
                                            <div class="form-group mb-3"> <label class="control-label">User
                                                    Name</label>&nbsp;&nbsp;<input id="Edit_this_modal_User_Name" type="text"
                                                                                   name="label" class="form-control" placeholder="" required="">
                                            </div>
                                            <div class="form-group mb-3"> <label class="control-label">Email
                                                </label>&nbsp;&nbsp;<input id="Edit_this_modal_Email" type="text"
                                                                           name="label" class="form-control" placeholder="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="Update_User()" class="btn btn-primary">Update
                                            User</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notify User Modal -->
                        <div class="modal fade" id="send_Notification_Modal" tabindex="-1" role="dialog"
                             aria-labelledby="send_Notification_Modal_Lebel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="send_Notification_Modal_Lebel">Send Notification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="nUserID" name="nUserID" value="000">
                                        <div class="form-group mb-3">
                                            <label>Heading</label>
                                            <input class="form-control col-md-12" type="text" value="" id="Heading">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Message</label>
                                            <div>
                                    <textarea required="" class="form-control col-md-12" id="Message"
                                              rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Large Icon</label>
                                            <input class="form-control col-md-12" type="text" value="" id="Large_Icon">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Big Picture</label>
                                            <input class="form-control col-md-12" type="text" value="" id="Big_Picture">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="NotifyUser()" class="btn btn-primary">Notify
                                            User</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Subscription Modal -->
                        <div class="modal fade" id="add_subscription_Modal" tabindex="-1" role="dialog"
                             aria-labelledby="add_subscription_Modal_Lebel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add_subscription_Modal_Lebel">Add Subscription</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="user_id_add_subscription_Modal" name="user_id_add_subscription_Modal" value="0">
                                        <div class="form-group mb-3">
                                            <label>Subscription Plan</label>
                                            <select class="form-select" id="sub_plan" aria-label="Default select"></select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="addSubscription()" class="btn btn-primary">Add</button>
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

    var Onesignal_Api_Key = "<?php echo $config->onesignal_api_key ?>";
    var Onesignal_Appid = "<?php echo $config->onesignal_appid ?>";

    $('#datatable').dataTable({
        "order": [],
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "ajax": '<?= site_url('Admin_api/get_all_users') ?>',
        "columns": [{
                "data": "1",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "data": "2",
                render: function (data) {
                    return '<div class="btn-group mr-1" data-container="body"> <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu" style="" data-container="body"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add_subscription_Modal" onclick="loadSubscriptionList(' +
                        data + ')" href="#">Add Subscription</a> <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#send_Notification_Modal" onclick="initNotification(' +
                        data + ')" href="#">Send Notification</a> <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Edit_this_User_Modal" onclick="Load_User_Data(' +
                        data + ')" href="#">Edit User</a> <a class="dropdown-item" onclick="Delete_User(' +
                        data + ')" href="#">Delete User</a> </div> </div>';
                }
            },
            {
                "data": "3"
            },
            {
                "data": "4"
            },
            {
                "data": "5",
                render: function (data) {
                    if (data == 0) {
                        return 'User';
                    } else if (data == 1) {
                        return 'Admin';
                    } else if (data == 2) {
                        return 'SubAdmin';
                    } else if (data == 3) {
                        return 'Editor';
                    } else if (data == 4) {
                        return 'Editor';
                    }
                }
            },
            {
                "data": "6",
                render: function (data) {
                    return data;
                }
            }
        ]

    });

    function Add_User() {
        var add_modal_User_Name = document.getElementById("add_modal_User_Name").value;
        var Add_modal_Email = document.getElementById("Add_modal_Email").value;
        var Add_modal_Password = document.getElementById("Add_modal_Password").value;

        var jsonObjects = {
            add_modal_User_Name: add_modal_User_Name,
            Add_modal_Email: Add_modal_Email,
            Add_modal_Password: Add_modal_Password
        };

        $.ajax({
            url: '<?= site_url('Admin_api/add_user') ?>',
            type: 'POST',
            data: jsonObjects,
            dataType: 'text',
            success: function (response) {
                if (response == "User Added successfully") {
                    swal.fire({
                        title: 'Successful!',
                        text: 'User Added successfully!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: "#f46a6a"
                    }).then(function() {
                        location.reload();
                    });
                }else  if (response == "Email Already Regestered") { 
                    swal.fire({
                        title: 'Warning!',
                        text: 'Email Already Regestered!',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: "#f46a6a"
                    }).then(function() {
                        swal.close()
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

    function Load_User_Data(userID) {
        $.ajax({
            type: 'POST',
            url: '<?= site_url('Admin_api/get_user_Details') ?>',
            data: {
                userID: userID
            },
            dataType: 'json',
            success: function (response) {
                if(response != "") { 
                    $("#Edit_this_modal_User_id").val(response.id);
                    $("#Edit_this_modal_User_Name").val(response.name);
                    $("#Edit_this_modal_Email").val(response.email);
                }
            }
        });
    }

    function Update_User() {
        var Edit_modal_User_id = document.getElementById("Edit_this_modal_User_id").value;
        var Edit_modal_User_Name = document.getElementById("Edit_this_modal_User_Name").value;
        var Edit_modal_Email = document.getElementById("Edit_this_modal_Email").value;

        var jsonObjects = {
            Edit_modal_User_id: Edit_modal_User_id,
            Edit_modal_User_Name: Edit_modal_User_Name,
            Edit_modal_Email: Edit_modal_Email
        };

        $.ajax({
            type: 'POST',
            url: '<?= site_url('Admin_api/update_user_data') ?>',
            data: jsonObjects,
            dataType: 'text',
            success: function (response) {
                if (response == "User Updated successfully") {
                    swal.fire({
                        title: 'Successful!',
                        text: 'User Updated successfully!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: "#f46a6a"
                    }).then(function() {
                        location.reload();
                    });
                }else  if (response == "Email Already Regestered") { 
                    swal.fire({
                        title: 'Warning!',
                        text: 'Email Already Regestered!',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: "#f46a6a"
                    }).then(function() {
                        swal.close()
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

    function initNotification(ID) {
        $("#nUserID").val(ID);
    }
    
    function NotifyUser() {
        var nUserID = document.getElementById("nUserID").value;
        var Heading = document.getElementById("Heading").value;
        var Message = document.getElementById("Message").value;
        var Large_Icon = document.getElementById("Large_Icon").value;
        var Big_Picture = document.getElementById("Big_Picture").value;
    
        if(Heading != "" && Message != "") {
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
            var jsonObjects = {
                notify_user: 'notify_user',
                heading: Heading,
                message: Message,
                large_icon: Large_Icon,
                big_picture: Big_Picture,
                data: {"Type": "Announcement"},
                user_ids: [nUserID],
            };
            $.ajax({
              type: "POST",
              url: window.location.href,
              dataType: 'json',
              data: jsonObjects,
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

    function Delete_User(user_id) {
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
                    type: 'POST',
                    url: '<?= site_url('Admin_api/delete_user') ?>',
                    data: {
                        user_id: user_id
                    },
                    dataType: 'text',
                    success: function (response) {
                        if (response) {
                            swal.fire({
                                title: 'Successful!',
                                text: 'User Deleted successfully!',
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

    function loadSubscriptionList(user_id) {
        $("#user_id_add_subscription_Modal").val(user_id);
        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                get_subscription_list: 'get_subscription_list'
            },
            dataType: 'json',
            success: function (response) {
                $('#sub_plan')
                    .empty()
                    .append($("<option selected></option>")
                        .attr("value", "0")
                        .text("Default (Free)"));
                for(var key in response){
                    $('#sub_plan')
                        .append($("<option></option>")
                            .attr("value", response[key].id)
                            .text(response[key].name));
                }
            }
        });
    }
    
    function addSubscription() {
        $('#add_subscription_Modal').modal('toggle');

        Swal.fire({
            title: "Do you want to update subscription?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "With Notification",
            denyButtonText: `Without Notification`
        }).then((result) => {
            if (result.isConfirmed) {
                addSubscriptionReq(1);
            } else if (result.isDenied) {
                addSubscriptionReq(0);
            }
        });
    }

    function addSubscriptionReq(notify) {
        var user_id = document.getElementById("user_id_add_subscription_Modal").value;
        var subscription_id = $('#sub_plan').find(":selected").val();
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
        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                add_subscription: 'add_subscription',
                user_id: user_id,
                subscription_id: subscription_id,
                notify: notify
            },
            dataType: 'text',
            success: function (response) {
                $('#datatable').DataTable().ajax.reload();
                Swal.close();
                if (response) {
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
                    toastr.success("Subscription Added Successfully!");
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
                    toastr.error("Something Went Wrong :(");
                }
            }
        });
    }
    </script>