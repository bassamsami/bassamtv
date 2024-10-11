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

            						<h4 class="font-size-18">Coupon Manager</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Subscription</a></li>

            							<li class="breadcrumb-item active">Coupon Manager</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="card card-body">
                        			<div class="panel-heading">
                        				<button data-bs-toggle="modal" data-bs-target="#Add_Coupon_Modal" id="Add_Season"
                        					class="btn btn-sm btn-primary waves-effect waves-light"><span
                        						class="btn-label"><i class="fa fa-plus"></i></span> Create
                        					Coupon</button>

                        			</div>

                        			<br>
                        			<table id="datatable" class="table table-striped"
                        				style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        				<thead>

                        					<tr>

                        						<th>#</th>

                        						<th>##</th>

                        						<th>Name</th>

                        						<th>Coupon Code</th>

                        						<th>Time</th>

                        						<th>Amount</th>

                        						<th>Subscription Type</th>

                        						<th>Max Use</th>

                        						<th>used</th>

                        						<th>Used By</th>

                        						<th>Expire Date</th>

                        						<th>status</th>

                        					</tr>

                        				</thead>

                        			</table>

                        		</div>
                        	</div>
                        </div>
            			

            		</div> <!-- container-fluid -->

            	</div>

                <!-- Add Coupon Modal -->
                <div class="modal fade" id="Add_Coupon_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Add_Coupon_Modal_Lebel" aria-hidden="true">

                    <div class="modal-dialog" role="document">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="Add_Coupon_Modal_Lebel">Create Coupon</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="panel-body">

                                    <input type="hidden" id="Edit_modal_videos_id" name="modal_videos_id" value="000">

                                    <div class="form-group mb-3"> <label class="control-label">Name</label>&nbsp;&nbsp;<input
                                            id="Name" type="text" name="label" class="form-control"
                                            placeholder="Premium" required="">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="control-label">Coupon Code
                                        </label>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <input id="Coupon_Code" type="text" name="label" class="form-control"
                                                    placeholder="" required="">
                                            </div>

                                            <div class="col-lg-2">
                                                <span class="input-group-btn">
                                                    <button data-toggle="modal" onclick="Genarate_Coupon()"
                                                        id="Generate_Coupon"
                                                        class="btn btn-sm btn-primary waves-effect waves-light"><span
                                                            class="btn-label"><i class="typcn typcn-refresh"></i></span>
                                                        Generate</button>
                                                </span>

                                            </div>

                                        </div>

                                        <div class="form-group mb-3"> <label class="control-label">Time (Days)</label> <input
                                                id="Time" type="number" name="order" class="form-control"
                                                placeholder="0 to 9999" required=""> </div>

                                        <div class="form-group mb-3"> <label class="control-label">Amount</label> <input
                                                id="Amount" type="number" name="order" class="form-control"
                                                placeholder="0 to 9999" required=""> </div>

                                        <div class="form-group mb-3"> <label class="control-label">Max Use</label> <input
                                                id="Max_Use" type="number" name="order" class="form-control"
                                                placeholder="0 to 9999" required=""> </div>


                                        <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                                                id="Status" class="form-control" name="source">

                                                <option value="Valid" selected="">Valid</option>

                                                <option value="Expired">Expired</option>

                                            </select><br> </div>


                                        <label class="control-label">Subscription Type</label>
                                        <hr>

                                        <div class="form-group row mb-3">
                                            <label class="control-label col-sm-6 ">Remove Ads</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Remove_Ads_bool" switch="bool">
                                                <label for="Remove_Ads_bool" data-on-label="" data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="control-label col-sm-6 ">Watch Premium Contents</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Watch_Premium_Contents_bool" switch="bool">
                                                <label for="Watch_Premium_Contents_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="control-label col-sm-6 ">Download Premium Contents</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Download_Premium_Contents_bool"
                                                    switch="bool">
                                                <label for="Download_Premium_Contents_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>

                                        <label class="control-label">Expire</label>
                                        <hr>

                                        <div class="form-group mb-3">
                                            <label>Expire Date</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input type="text" id="add_expire_date"
                                                    class="form-control datetimepicker-input" data-target="#add_expire_date"
                                                    placeholder="YYYY-MM-DD" />
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <button type="button" onclick="Create_Coupon()" class="btn btn-primary">Add
                                        Coupon</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Edit Coupon Modal -->
                <div class="modal fade" id="Edit_Coupon_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Edit_Coupon_Modal_Lebel" aria-hidden="true">

                    <div class="modal-dialog" role="document">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="Edit_Coupon_Modal_Lebel">Edit Coupon</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="panel-body">

                                    <input id="Edit_ID" type="text" name="label" class="form-control" placeholder=""
                                        required="" style="display: none;">

                                    <input type="hidden" id="Edit_modal_videos_id" name="modal_videos_id" value="000">

                                    <div class="form-group mb-3"> <label class="control-label">Name</label>&nbsp;&nbsp;<input
                                            id="Edit_Name" type="text" name="label" class="form-control"
                                            placeholder="Premium" required="">

                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="control-label">Coupon Code
                                        </label>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <input id="Edit_Coupon_Code" type="text" name="label"
                                                    class="form-control" placeholder="" required="">
                                            </div>

                                            <div class="col-lg-2">
                                                <span class="input-group-btn">
                                                    <button data-toggle="modal" onclick="Edit_Genarate_Coupon()"
                                                        id="Generate_Coupon"
                                                        class="btn btn-sm btn-primary waves-effect waves-light"><span
                                                            class="btn-label"><i class="typcn typcn-refresh"></i></span>
                                                        Generate</button>
                                                </span>

                                            </div>

                                        </div>

                                        <div class="form-group mb-3"> <label class="control-label">Time (Days)</label> <input
                                                id="Edit_Time" type="number" name="order" class="form-control"
                                                placeholder="0 to 9999" required=""> </div>

                                        <div class="form-group mb-3"> <label class="control-label">Amount</label> <input
                                                id="Edit_Amount" type="number" name="order" class="form-control"
                                                placeholder="0 to 9999" required=""> </div>

                                        <div class="form-group mb-3"> <label class="control-label">Max Use</label> <input
                                                id="Edit_Max_Use" type="number" name="order" class="form-control"
                                                placeholder="0 to 9999" required=""> </div>


                                        <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                                                id="Edit_Status" class="form-control" name="source">

                                                <option value="Valid" selected="">Valid</option>

                                                <option value="Expired">Expired</option>

                                            </select><br> </div>

                                        <label class="control-label">Subscription Type</label>
                                        <hr>

                                        <div class="form-group row mb-3">
                                            <label class="control-label col-sm-6 ">Remove Ads</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Edit_Remove_Ads_bool" switch="bool">
                                                <label for="Edit_Remove_Ads_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="control-label col-sm-6 ">Watch Premium Contents</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Edit_Watch_Premium_Contents_bool"
                                                    switch="bool">
                                                <label for="Edit_Watch_Premium_Contents_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="control-label col-sm-6 ">Download Premium Contents</label>
                                            <div class="col-sm-6">
                                                <input type="checkbox" id="Edit_Download_Premium_Contents_bool"
                                                    switch="bool">
                                                <label for="Edit_Download_Premium_Contents_bool" data-on-label=""
                                                    data-off-label=""></label>
                                            </div>
                                        </div>

                                        <label class="control-label">Expire</label>
                                        <hr>

                                        <div class="form-group mb-3">
                                        <label>Expire Date</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="expire_date"
                                                class="form-control datetimepicker-input" data-target="#expire_date"
                                                placeholder="YYYY-MM-DD" />
                                            <div class="input-group-append" data-target="#expire_date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <button type="button" onclick="Update_Coupon()" class="btn btn-primary">Update
                                        Coupon</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Show Users Modal -->
                <div class="modal fade" id="Show_Users_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Show_Users_Modal_Lebel" aria-hidden="true">

                    <div class="modal-dialog modal-lg" role="document">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="Show_Users_Modal_Lebel">Edit Coupon</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="panel-body">
                                    <table id="Show_User_datatable" class="table table-striped"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Name</th>

                                                <th>Email</th>

                                                <th>Role</th>

                                                <th>Subscription</th>

                                            </tr>

                                        </thead>

                                    </table>
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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
        var name = "<?php echo $config->name ?>";

        $(function () {
            $('#expire_date').datetimepicker({
                format: 'YYYY-MM-DD',
                allowInputToggle: true
            });
            $('#add_expire_date').datetimepicker({
                format: 'YYYY-MM-DD',
                allowInputToggle: true
            });
        });

        $('#datatable').dataTable({
            "order": [],
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": '<?= site_url('Admin_api/get_all_coupons') ?>',
            "columns": [{
                    "data": "1",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "2",
                    render: function (data) {
                        return '<div class="btn-group"> <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Edit</button> <div class="dropdown-menu" style=""> <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Edit_Coupon_Modal" onclick="Load_Coupon_Data(' +
                            data + ')">Edit</a> <a class="dropdown-item" onclick="Delete_Coupon(' +
                            data + ')" href="#">Delete</a> </div> </div>';
                    }
                },
                {
                    "data": "3"
                },
                {
                    "data": "4",
                    render: function (data) {
                        return '<label>'+data+'</label>';
                    }
                },
                {
                    "data": "5",
                    render: function (data) {
                        return data + "Days";
                    }
                },
                {
                    "data": "6"
                },
                {
                    "data": "7"
                },
                {
                    "data": "8"
                },
                {
                    "data": "9"
                },
                {
                    "data": "10",
                    render: function (data) {
                        return "<button type='button' class='btn btn-info btn-sm waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#Show_Users_Modal' onclick=init_usersData('" + data + "'); href='#'>Users</button>";
                    }
                },
                {
                    "data": "11"
                },
                {
                    "data": "12",
                    render: function (data) {
                        if (data == 0) {
                            return '<span class="badge bg-danger">Expired</span';
                        } else if (data == 1) {
                            return '<span class="badge bg-success">Valid</span>';
                        }
                    }
                }
            ]
        });

        function init_usersData(data) {
            var userID_arr = data.split(',');
            var user_list_count = 1;
            for (const userID of userID_arr) {
                var jsonObjects = {
                    userID: userID
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/get_user_Details') ?>',
                    data: jsonObjects,
                    dataType: 'json',
                    success: function (response) {
                        if(response != "") { 
                            var name = response.name;
                            var email = response.email;
                            var role = response.role;
                            var active_subscription = response.active_subscription;
                            var Show_User_datatable = $('#Show_User_datatable').dataTable({
                                    "order": [],
                                    "ordering": false,
                                    "paging": false,
                                    "info": false,
                                    "filter": false,
                                    "pageLength": 100,
                                    "destroy": true
                                });
                            $('#Show_User_datatable').DataTable().row.add([
                                user_list_count, name, email, detect_role(role), active_subscription
                            ]).draw();
                            user_list_count++;
                        }
                    }
                });
            }
        }

        function detect_role(data) {
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

        function Genarate_Coupon() {
            if(name != "") {
                document.getElementById('Coupon_Code').value = name+'-' + Get_Rand(8);
            } else {
                document.getElementById('Coupon_Code').value = Get_Rand(12);
            }
            
        }

        function Edit_Genarate_Coupon() {
            if(name != "") {
                document.getElementById('Edit_Coupon_Code').value = name+'-' + Get_Rand(8);
            } else {
                document.getElementById('Edit_Coupon_Code').value = Get_Rand(12);
            }
            
        }

        function Get_Rand(length) {
            var result = [];
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result.push(characters.charAt(Math.floor(Math.random() *
                    charactersLength)));
            }
            return result.join('');
        }

        function Load_Coupon_Data(ID) {
            var jsonObjects = {
                couponID: ID
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/get_coupon_details') ?>',
                data: jsonObjects,
                dataType: 'json',
                success: function (response) {
                    var id = response.id;
                    var name = response.name;
                    var coupon_code = response.coupon_code;
                    var time = response.time;
                    var amount = response.amount;
                    var subscription_type = response.subscription_type;
                    var status = response.status;
                    var max_use = response.max_use;
                    var expireDate = response.expire_date;
                    if (!id == "") {
                        $("#Edit_ID").val(id);
                        $("#Edit_Name").val(name);
                        $("#Edit_Coupon_Code").val(coupon_code);
                        $("#Edit_Time").val(time);
                        $("#Edit_Amount").val(amount);
                        $("#Edit_Max_Use").val(max_use);
                        if (status == "0") {
                            $("#Edit_Status").val("Expired");
                        } else if (status == "1") {
                            $("#Edit_Status").val("Valid");
                        }
                        var sNumber = subscription_type.toString();
                        $('#Edit_Remove_Ads_bool').attr('checked', false);
                        $('#Edit_Watch_Premium_Contents_bool').attr('checked', false);
                        $('#Edit_Download_Premium_Contents_bool').attr('checked', false);
                        for (var i = 0, len = sNumber.length; i < len; i += 1) {
                            if (sNumber.charAt(i) == 1) {
                                $('#Edit_Remove_Ads_bool').attr('checked', true);
                            }
                            if (sNumber.charAt(i) == 2) {
                                $('#Edit_Watch_Premium_Contents_bool').attr('checked', true);
                            }
                            if (sNumber.charAt(i) == 3) {
                                $('#Edit_Download_Premium_Contents_bool').attr('checked', true);
                            }
                        }
                        $("#expire_date").data("datetimepicker").date(expireDate);
                    }
                }
            });
        }

        function Create_Coupon() {
            var Name = document.getElementById("Name").value;
            var Coupon_Code = document.getElementById("Coupon_Code").value;
            var Time = document.getElementById("Time").value;
            var Amount = document.getElementById("Amount").value;
            var Max_Use = document.getElementById("Max_Use").value;
            var Status = document.getElementById("Status").value;
            var add_expire_date = document.getElementById('add_expire_date').value;
            if (Status == "Valid") {
                var Status_Count = 1;
            } else if (Status == "Expired") {
                var Status_Count = 0;
            }
            if ($('#Remove_Ads_bool').is(':checked')) {
                var Remove_Ads = 1;
            } else {
                var Remove_Ads = 0;
            }
            if ($('#Watch_Premium_Contents_bool').is(':checked')) {
                var Watch_Premium_Contents = 2;
            } else {
                var Watch_Premium_Contents = 0;
            }
            if ($('#Download_Premium_Contents_bool').is(':checked')) {
                var Download_Premium_Contents = 3;
            } else {
                var Download_Premium_Contents = 0;
            }
            var Subscription_Type = "";
            if (Remove_Ads != "0") {
                Subscription_Type = "" + Remove_Ads;
            }
            if (Watch_Premium_Contents != "0") {
                Subscription_Type = "" + Subscription_Type + Watch_Premium_Contents;
            }
            if (Download_Premium_Contents != "0") {
                Subscription_Type = "" + Subscription_Type + Download_Premium_Contents;
            }
            if (Subscription_Type != "") {
                var f_Subscription_Type = Subscription_Type;
            } else {
                var f_Subscription_Type = 0;
            }
            var jsonObjects = {
                Name: Name,
                Coupon_Code: Coupon_Code,
                Time: Time,
                Amount: Amount,
                Max_Use: Max_Use,
                Status_Count: Status_Count,
                f_Subscription_Type: f_Subscription_Type,
                add_expire_date: add_expire_date
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/create_coupon') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        location.reload();
                    }
                }
            });
        }

        function Delete_Coupon(ID) {
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
                        couponID: ID
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/delete_coupon') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Coupon Deleted Successfully!',
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

        function Update_Coupon() {
            var Edit_ID = document.getElementById("Edit_ID").value;
            var Edit_Name = document.getElementById("Edit_Name").value;
            var Edit_Coupon_Code = document.getElementById("Edit_Coupon_Code").value;
            var Edit_Time = document.getElementById("Edit_Time").value;
            var Edit_Amount = document.getElementById("Edit_Amount").value;
            var Edit_Max_Use = document.getElementById("Edit_Max_Use").value;
            var Edit_Status = document.getElementById("Edit_Status").value;
            var expire_date = document.getElementById('expire_date').value;
            
            if (Edit_Status == "Valid") {
                var Edit_Status_Count = 1;
            } else if (Edit_Status == "Expired") {
                var Edit_Status_Count = 0;
            }
            if ($('#Edit_Remove_Ads_bool').is(':checked')) {
                var Edit_Remove_Ads = 1;
            } else {
                var Edit_Remove_Ads = 0;
            }
            if ($('#Edit_Watch_Premium_Contents_bool').is(':checked')) {
                var Edit_Watch_Premium_Contents = 2;
            } else {
                var Edit_Watch_Premium_Contents = 0;
            }
            if ($('#Edit_Download_Premium_Contents_bool').is(':checked')) {
                var Edit_Download_Premium_Contents = 3;
            } else {
                var Edit_Download_Premium_Contents = 0;
            }
            var Edit_Subscription_Type = "";
            if (Edit_Remove_Ads != "0") {
                Edit_Subscription_Type = "" + Edit_Remove_Ads;
            }
            if (Edit_Watch_Premium_Contents != "0") {
                Edit_Subscription_Type = "" + Edit_Subscription_Type + Edit_Watch_Premium_Contents;
            }
            if (Edit_Download_Premium_Contents != "0") {
                Edit_Subscription_Type = "" + Edit_Subscription_Type + Edit_Download_Premium_Contents;
            }
            if (Edit_Subscription_Type != "") {
                var f_Edit_Subscription_Type = Edit_Subscription_Type;
            } else {
                var f_Edit_Subscription_Type = 0;
            }
            var jsonObjects = {
                Edit_ID: Edit_ID,
                Edit_Name: Edit_Name,
                Edit_Coupon_Code: Edit_Coupon_Code,
                Edit_Time: Edit_Time,
                Edit_Amount: Edit_Amount,
                Edit_Max_Use: Edit_Max_Use,
                Edit_Status_Count: Edit_Status_Count,
                f_Edit_Subscription_Type: f_Edit_Subscription_Type,
                expire_date: expire_date
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/update_coupon_details') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Coupon Details Updated successfully!',
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