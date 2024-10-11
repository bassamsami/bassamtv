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

            						<h4 class="font-size-18">Manage Season</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Web Series</a></li>

            							<li class="breadcrumb-item active">Manage Season</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <div class="panel-heading">

                                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                                    <div>
                                        <h4 class="mb-3 mb-md-0"><?php echo $webSeriesData->name; ?></h4>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap text-nowrap">
                                        <div class="panel-heading">
                                            <button data-bs-toggle="modal" data-bs-target="#Add_Season_Modal" id="Add_Season"
                                                class="btn btn-sm btn-primary waves-effect waves-light"><span
                                                    class="btn-label"><i class="fa fa-plus"></i></span> Add
                                                Season</button>

                                            <button data-bs-toggle="modal" onClick="Fetch_All_Data()"
                                                class="btn btn-sm btn-primary waves-effect waves-light"><span
                                                    class="btn-label"><i class="mdi mdi-ballot-recount"></i></span>
                                                Fetch
                                                All Season</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="panel-body">
                                <div>

                                    <table id="datatable" class="table table-striped"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Session Name</th>

                                                <th>Order</th>

                                                <th>Episodes</th>

                                                <th>Status</th>

                                                <th>Option</th>

                                            </tr>

                                        </thead>

                                        <tbody>
                                            <?php $int_table_id = 1; foreach($webSeriesSeasons as $item) { ?>
                                        	<tr>
                                        		<th><?php echo($int_table_id); ?></th>
                                        		<td><?php echo $item->Session_Name; ?></td>
                                        		<td><?php echo $item->season_order; ?></td>

                                        		<td>
                                        			<?php
                                                        echo get_instance()->Admin_model->web_series_Season_episoades($item->id);
                                                    ?>
                                        		</td>

                                        		<?php
                                                if($item->status == 0) {
                                                    ?>
                                        	    	<td><span class="badge bg-danger">UnPublished</span></td>
                                        	    	<?php
                                                }
                                                if($item->status == 1) {
                                                    ?>
                                        	    	<td><span class="badge bg-success">Published</span></td>
                                        	    	<?php
                                                }
    
                                                ?>

                                        		<td>
                                        			<?php $Row_ID = $item->id ?>

                                        			<a class="btn btn-primary btn-sm"
                                        				onclick="Manage_Episodes(<?php echo($Row_ID); ?>)">Manage
                                        				Episodes</a>
                                        			<a class="btn btn-primary btn-sm"
                                        				onclick="Load_Season_Data(<?php echo($Row_ID); ?>)"
                                        				data-bs-toggle="modal" data-bs-target="#Edit_Season_Modal"
                                        				id="Edit_Season"><span class="btn-label"><i
                                        						class="typcn typcn-edit"></i></span>Edit</a>
                                        			<a class="btn btn-primary btn-sm"
                                        				onclick="Delete_Season(<?php echo($Row_ID); ?>)"><span
                                        					class="btn-label"><i
                                        						class="typcn typcn-delete"></i></span>Delete</a>

                                        		</td>



                                        		<?php ++$int_table_id ?>
                                        	</tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>





                                    </table>

                                </div>
                            </div>

                            <!-- Add Season Modal -->
                            <div class="modal fade" id="Add_Season_Modal" tabindex="-1" role="dialog"
                            	aria-labelledby="Add_Season_Modal_Lebel" aria-hidden="true">
                            	<div class="modal-dialog" role="document">
                            		<div class="modal-content">
                            			<div class="modal-header">
                            				<h5 class="modal-title" id="Add_Season_Modal_Lebel">Add Season</h5>
                            				<button type="button" class="btn-close" data-bs-dismiss="modal"
                            					aria-label="Close">
                            				</button>
                            			</div>
                            			<div class="modal-body">

                            				<div class="panel-heading">
                            					<h3 class="panel-title row justify-content-center">New Seasons
                            						information</h3>
                            				</div>

                            				<hr>

                            				<div class="form-group mb-3"> <label class="control-label">Seasons
                            						Name</label>&nbsp;&nbsp;<input id="modal_Season_Name" type="text"
                            						name="label" class="form-control" placeholder="Seasons 1"
                            						required=""> </div>

                            				<div class="form-group  mb-3"> <label class="control-label">Order</label>
                            					<input id="modal_Order" type="number" name="order" class="form-control"
                            						placeholder="Ex: 1" required=""> </div>

                            				<div class="form-group  mb-3"> <label class="control-label">Status</label>
                            					<select id="modal_Status" class="form-control" name="source"
                            						id="selected-source">
                            						<option value="Publish" selected="">Publish</option>
                            						<option value="Unpublish">Unpublish</option>
                            					</select><br> </div>

                            			</div>
                            			<div class="modal-footer">
                            				<button type="button" class="btn btn-secondary"
                            					data-bs-dismiss="modal">Close</button>
                            				<button type="button" onclick="Add_season()"
                            					class="btn btn-primary">Create</button>
                            			</div>
                            		</div>
                            	</div>
                            </div>

                            <!-- Edit Season Modal -->
                            <div class="modal fade" id="Edit_Season_Modal" tabindex="-1" role="dialog"
                            	aria-labelledby="Edit_Season_Modal_Lebel" aria-hidden="true">
                            	<div class="modal-dialog" role="document">
                            		<div class="modal-content">
                            			<div class="modal-header">
                            				<h5 class="modal-title" id="Edit_Season_Modal_Lebel">Edit Season</h5>
                            				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            				</button>
                            			</div>
                            			<div class="modal-body">

                            				<div class="panel-heading">
                            					<h3 class="panel-title row justify-content-center">Edit Seasons
                            						information</h3>
                            				</div>

                            				<hr>

                            				<input type="hidden" id="modal_season_id" name="modal_season_id"
                            					value="000">

                            				<div class="form-group mb-3"> <label class="control-label">Seasons
                            						Name</label>&nbsp;&nbsp;<input id="edit_modal_Season_Name"
                            						type="text" name="label" class="form-control"
                            						placeholder="Seasons 1" required=""> </div>

                            				<div class="form-group mb-3"> <label class="control-label">Order</label> <input
                            						id="edit_modal_Order" type="number" name="order"
                            						class="form-control" placeholder="Ex: 1" required=""> </div>

                            				<div class="form-group mb-3"> <label class="control-label">Status</label> <select
                            						id="edit_modal_Status" class="form-control" name="source"
                            						id="selected-source">
                            						<option value="Publish" selected="">Publish</option>
                            						<option value="Unpublish">Unpublish</option>
                            					</select><br> </div>

                            			</div>
                            			<div class="modal-footer">
                            				<button type="button" class="btn btn-secondary"
                            					data-bs-dismiss="modal">Close</button>
                            				<button type="button" onclick="Update_Season_Data()"
                            					class="btn btn-primary">Update</button>
                            			</div>
                            		</div>
                            	</div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Season Fetch Modal -->
                <div class="modal fade" id="Fetch_Season_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Fetch_Season_Modal_Lebel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Fetch_Season_Modal_Lebel">Fetch Season</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="panel-heading">
                                    <h3 class="panel-title row justify-content-center">Fetch Seasons information</h3>
                                </div>

                                <hr>

                                <div class="panel-body">
                                    <table id="fetch_season_datatable" class="table table-striped"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Session Name</th>

                                                <th>Order</th>

                                                <th>Publish</th>

                                                <th>Add</th>

                                            </tr>

                                        </thead>

                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" onclick="Fetch_season()" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Season No Modal -->
                <div class="modal fade" id="Add_TMDB_ID_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Add_TMDB_ID_Modal_Lebel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Add_TMDB_ID_Modal_Lebel">Add TMDB ID</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="panel-heading">
                                    <h3 class="panel-title row justify-content-center">Add TMDB ID To Fech All
                                        Seasons</h3>
                                </div>

                                <hr>

                                <div class="form-group"> <label class="control-label">TMDB
                                        ID</label>&nbsp;&nbsp;<input id="modal_TMDB_ID" type="number" name="label"
                                        class="form-control" placeholder="Ex. 12345" required=""> </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" onclick="Fetch_All_Data_CustomID()" class="btn btn-primary"
                                        id="Fetch_btn">Fetch</button>
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

        <?php include("partials/footer.php"); ?>

    <script>
        var code = "<?php echo $config->license_code; ?>";
        if("<?php echo $config->tmdb_language; ?>" == "") {
            var tmdb_language = "en-US";
        } else {
            var tmdb_language = "<?php echo $config->tmdb_language; ?>";
        }

        $('#datatable').dataTable({
            "order": [],
            "ordering": false,
            "paging": false,
            "info": false,
            "filter": false,
            "pageLength": 100
        });

        function Add_season() {
            var modal_Season_Name = document.getElementById("modal_Season_Name").value;
            var modal_Order = document.getElementById("modal_Order").value;
            var modal_Status_txt = document.getElementById("modal_Status").value;
            if (modal_Status_txt == "Publish") {
                var Modal_Status = "1";
            } else if (modal_Status_txt == "Unpublish") {
                var Modal_Status = "0";
            }
    
            var jsonObjects = {
                "webseries_id": "<?php echo $WebSeriesID; ?>",
                "modal_Season_Name": modal_Season_Name,
                "modal_Order": modal_Order,
                "Modal_Status": Modal_Status
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/add_season') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Season Added Successfully!',
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

        function Delete_Season(ID) {
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
                        url: '<?= site_url('Admin_api/delete_season') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Season Deleted successfully!',
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

        function Load_Season_Data(ID) {
            var jsonObjects = {
                "seasonID": ID
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/getSeasonData') ?>',
                data: jsonObjects,
                dataType: 'json',
                success: function (response2) {
                    var id = response2.id;
                    var Session_Name = response2.Session_Name;
                    var season_order = response2.season_order;
                    var Status = response2.status;
                    if (!id == "") {
                        $("#modal_season_id").val(id);
                        $("#edit_modal_Season_Name").val(Session_Name);
                        $("#edit_modal_Order").val(season_order);
                        if(Status == "1") {
                            $("#edit_modal_Status").val("Publish");
                        } else if(Status == "0") {
                            $("#edit_modal_Status").val("Unpublish");
                        }
                    }
                }
            });
        }

        function Update_Season_Data() {
            var modal_season_id = document.getElementById("modal_season_id").value;
            var edit_modal_Season_Name = document.getElementById("edit_modal_Season_Name").value;
            var edit_modal_Order = document.getElementById("edit_modal_Order").value;
            var modal_Status_txt = document.getElementById("edit_modal_Status").value;
            if (modal_Status_txt == "Publish") {
                var Modal_Status = "1";
            } else if (modal_Status_txt == "Unpublish") {
                var Modal_Status = "0";
            }
    
            var jsonObjects = {
                "modal_season_id": modal_season_id,
                "edit_modal_Season_Name": edit_modal_Season_Name,
                "edit_modal_Order": edit_modal_Order,
                "Modal_Status": Modal_Status
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/update_season') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response6) {
                    if (response6) {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Season Updated successfully!',
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

        function Manage_Episodes(ID) {
            window.location.assign("../manage_episodes/"+ID);
        }

        function Fetch_All_Data() {
            Swal.fire({
                title: "Are you sure?",
                text: "It Will Fetch All Season Data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, Fetch All!"
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

                        }
                    });
                    var jsonObjects = {
                        "Type": "Webseries_id",
                        "id": <?php echo $webSeriesData->id; ?>
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/get_tmdb_id') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (IMDB_ID) {
                            if (IMDB_ID != '0') {
                                $.ajax({
                                    type: 'GET',
                                    url: "https://cloud.team-dooo.com/Dooo/TMDB/?code="+ code +"&filter=single&type=tv&id=" + IMDB_ID +"&id_type=TMDB&language=" + tmdb_language+"&image_storage_provider="+"<?php echo $config->image_storage_provider; ?>"+"&key="+"<?php echo $config->imgbb_api_key; ?>",
                                    dataType: 'json',
                                    beforeSend: function () {
                                        //$("#import_btn").html('Fetching...');
                                    },
                                    success: function (response) {
                                        Swal.close();
                                        var season_arr = response.seasons;
                                        var seasons = new Array();
    
                                        for(let i = 0; i < season_arr.length; i++){
                                            var season_data = season_arr[i];
    
                                            if(season_data.name != "Specials") {
                                                var season = {};
                                                season['name'] = season_data.name;
                                                season['season_number'] = season_data.season_number;
                                                seasons.push(season);
                                            }
    
    
                                            if(i == season_arr.length - 1){
                                                $('#Fetch_Season_Modal').modal('show');
                                            
                                                var tabl = $('#fetch_season_datatable').dataTable({
                                                "order": [],
                                                "ordering": false,
                                                "paging": false,
                                                "info": false,
                                                "filter": false,
                                                "pageLength": 100,
                                                "destroy": true,
                                                data: seasons,
                                                columns: [
                                                    { 
                                                        data: 'id',
                                                        render: function (data, type, row, meta) {
                                                            return meta.row + meta.settings._iDisplayStart + 1;
                                                        }
                                                    },
                                                    { 
                                                        data: 'name',
                                                        render: function name(data, type, row, meta) {
                                                            return '<input class="form-control form-control-sm" type="text" id='+ meta.row+1 +' value="'+data+'">';
                                                        }
                                                    },
                                                    { 
                                                        data: 'season_number',
                                                        render: function name(data, type, row, meta) {
                                                            return '<input class="form-control form-control-sm" type="number" id='+ meta.row+2 +' value='+data+'>';
                                                        }
        
                                                    },
                                                    { 
                                                        data: 'Status',
                                                        render: function (data, type, row, meta) {
                                                            return '<div class="col-sm-0"> <input type="checkbox" id='+ meta.row+3 +' switch="bool"> <label for='+ meta.row+3 +' data-on-label="" data-off-label=""></label> </div>';
                                                        }
        
                                                    },
                                                    { 
                                                        data: 'Add',
                                                        render: function (data, type, row, meta) {
                                                            var Add = "Add";
                                                            return '<div class="col-sm-0"> <input type="checkbox" id='+ meta.row+4 +' switch="bool" checked> <label for='+ meta.row+4 +' data-on-label="" data-off-label=""></label> </div>';
                                                        }
        
                                                    }
                                                ]
                                                });
                                            }
                                          
                                        }
                    
                                    },
                                    error: function (jq, status, message) {
                                        Swal.close();
                                        Error(); 
                                    }
                                });
    
                            } else {
                                Swal.close();
                                $('#Add_TMDB_ID_Modal').modal('show');
    
    
                               /* swal.fire({
                                    title: 'Error',
                                    text: 'WebSeries Not Added From TMDB :(',
                                    type: 'error'
                                }).then(function () {
                                    location.reload();
                                });*/
                            }
                        }
                    });
                }
            });
        }

        function Fetch_All_Data_CustomID() {
            var modal_TMDB_ID = document.getElementById("modal_TMDB_ID").value;
    
            Swal.fire({
                title: "Are you sure?",
                text: "It Will Fetch All Season Data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, Fetch All!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "https://api.themoviedb.org/3/tv/" + modal_TMDB_ID +
                            "?api_key=1bfdbff05c2698dc917dd28c08d41096&language=" + tmdb_language,
                        dataType: 'json',
                        beforeSend: function () {
                            //$("#import_btn").html('Fetching...');
                        },
                        success: function (response) {
                            $('#Add_TMDB_ID_Modal').modal('hide');
    
                            var seasons = new Array();
                            for (var season_data of response.seasons) {
                                if(season_data.name != "Specials") {
                                    var season = {};
                                    season['name'] = season_data.name;
                                    season['season_number'] = season_data.season_number;
                                    seasons.push(season);
                                }
                            }
    
                            $('#Fetch_Season_Modal').css('overflow-y', 'auto');
                            $('#Fetch_Season_Modal').modal('show');
                                        
                                    var tabl = $('#fetch_season_datatable').dataTable({
                                        "order": [],
                                        "ordering": false,
                                        "paging": false,
                                        "info": false,
                                        "filter": false,
                                        "pageLength": 100,
                                        "destroy": true,
                                        data: seasons,
                                        columns: [
                                            { 
                                                data: 'id',
                                                render: function (data, type, row, meta) {
                                                    return meta.row + meta.settings._iDisplayStart + 1;
                                                }
                                            },
                                            { 
                                                data: 'name',
                                                render: function name(data, type, row, meta) {
                                                    return '<input class="form-control form-control-sm" type="text" id='+ meta.row+1 +' value="'+data+'">';
                                                }
                                            },
                                            { 
                                                data: 'season_number',
                                                render: function name(data, type, row, meta) {
                                                    return '<input class="form-control form-control-sm" type="number" id='+ meta.row+2 +' value='+data+'>';
                                                }
                                            },
                                            { 
                                                data: 'Status',
                                                render: function (data, type, row, meta) {
                                                    return '<div class="col-sm-0"> <input type="checkbox" id='+ meta.row+3 +' switch="bool"> <label for='+ meta.row+3 +' data-on-label="" data-off-label=""></label> </div>';
                                                }
                                            },
                                            { 
                                                data: 'Add',
                                                render: function (data, type, row, meta) {
                                                    var Add = "Add";
                                                    return '<div class="col-sm-0"> <input type="checkbox" id='+ meta.row+4 +' switch="bool" checked> <label for='+ meta.row+4 +' data-on-label="" data-off-label=""></label> </div>';
                                                }
                                            }
                                        ]
                                    });
        
                        },
                        error: function (jq, status, message) {
                            Error(); 
                        }
                    });
                }
            });
        }

        function Fetch_season() {
    
            var table = $('#fetch_season_datatable').DataTable();
    
            Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                },
                onClose: ()=>{
                    $('#Fetch_Season_Modal').modal('hide');
                    location.reload();
                }
            });
    
            table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                var data = this.data();
            
                var Name = $("#"+ rowIdx+1).val();
            
                var Order = $("#"+ rowIdx+2).val();
            
                if ($('#'+rowIdx+3).is(':checked')) {
                    var Publish_toggle_Count = 1;
                } else {
                    var Publish_toggle_Count = 0;
                }
            
                if ($('#'+ rowIdx+4).is(':checked')) {
                    var Add_toggle_Count = 1;
                } else {
                    var Add_toggle_Count = 0;
                }
            
                if(Add_toggle_Count == 1) {
                    var jsonObjects = {
                        "webseries_id": "<?php echo $webSeriesData->id; ?>",
                        "modal_Season_Name": Name,
                        "modal_Order": Order,
                        "Modal_Status": Publish_toggle_Count
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/add_season') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        timeout: 0,
                        success: function (response10) {
                            if(data.counter >= table.rows().count()) {
                                data.counter++; 
                            } else {
                                Swal.close();
                            }
                        }
                    });
                }    
                        
            });
        }
    </script>