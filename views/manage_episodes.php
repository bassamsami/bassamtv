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

            						<h4 class="font-size-18">Manage Episodes</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Web Series</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>

            							<li class="breadcrumb-item active">Manage Episodes</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="row">
                        	<div class="col-md-12">
                        		<div class="card card-body">
                        			<div class="panel-heading">

                        				<div
                        					class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                        					<div>
                        						<h4 class="mb-3 mb-md-0">
                        							<?php echo $seasonWebSeriesData->name." - ".$seasonData->Session_Name; ?>
                        						</h4>
                        					</div>
                        					<div class="d-flex align-items-center flex-wrap text-nowrap">
                        						<div class="panel-heading">
                        							<button data-bs-toggle="modal" data-bs-target="#Add_Episode_Modal"
                        								id="Add_Season"
                        								class="btn btn-sm btn-primary waves-effect waves-light"><span
                        									class="btn-label"><i class="fa fa-plus"></i></span>Add
                        								Episode</button>
                        							<button data-toggle="modal" data-bs-toggle="modal"
                        								data-bs-target="#Add_Season_no_Modal"
                        								class="btn btn-sm btn-primary waves-effect waves-light"><span
                        									class="btn-label"><i
                        										class="mdi mdi-ballot-recount"></i></span>
                        								Fetch All Episodes</button>
                        						</div>
                        					</div>
                        				</div>

                        			</div>
                        			<br>
                        			<div>

                        				<table id="datatable" class="table table-striped"
                        					style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        					<thead>

                        						<tr>

                        							<th>#</th>

                        							<th>Action</th>

                        							<th>Thumbnail</th>

                        							<th>Episodes Name</th>

                        							<th>Description</th>

                        							<th>Order</th>

                        							<th>Downloadable</th>

                        							<th>Type</th>

                        							<th>Status</th>

                        						</tr>

                        					</thead>





                        					<tbody>
                        						<?php $int_table_id = 1; foreach($webSeriesEpisoads as $item) { ?>
                        						<tr>
                        							<th><?php echo($int_table_id); ?></th>
                        							<td>

                        								<div class="btn-group mr-1 mt-2">

                        									<?php $Row_ID = $item->id; ?>

                        									<button type="button"
                        										class="btn btn-secondary dropdown-toggle"
                        										data-bs-toggle="dropdown" aria-haspopup="true"
                        										aria-expanded="false">Options <i class="mdi mdi-chevron-down"></i></button>

                        									<div class="dropdown-menu" style="">

                        										<a class="dropdown-item"
                        											onclick="Load_Episode_Data(<?php echo($Row_ID); ?>)"
                        											data-bs-toggle="modal"
                        											data-bs-target="#Edit_Episode_Modal">Edit
                        											Episode</a>

                        										<a class="dropdown-item"
                        											onclick="Manage_Downloads(<?php echo($Row_ID); ?>)">Manage
                        											Links</a>

                        										<a class="dropdown-item" id="Delete"
                        											onclick="Manage_Subtitle(<?php echo($Row_ID); ?>)">Manage
                        											Subtitle</a>

                        										<a class="dropdown-item"
                        											onclick="Delete_Episode(<?php echo($Row_ID); ?>)">Delete</a>

                        									</div>

                        								</div>

                        							</td>
                        							<td>

                        								<div>

                        									<img class="img-fluid" height="100" width="80"
                        										src=<?php echo $item->episoade_image; ?>
                        										data-holder-rendered="true">

                        								</div>

                        							</td>
                        							<td><?php echo $item->Episoade_Name; ?></td>
                        							<td><?php echo wordwrap(mb_strimwidth($item->episoade_description, 0, 50, "..."),40,"<br>\n",TRUE); ?></td>
                        							<td><?php echo $item->episoade_order; ?></td>
                        							<td>
                        								<?php
                                          if($item->downloadable == "0") {
                                              ?>
                        								<span class="badge bg-danger">No</span>
                        								<?php
                                          } else if($item->downloadable == "1") {
                                            ?>
                        								<span class="badge bg-success">Yes</span>
                        								<?php
                                          }
                                          ?>
                        							</td>
                        							<td>
                        								<?php
                                          if($item->type == "0") {
                                              ?>
                        								<span class="badge bg-danger">Not Premium</span>
                        								<?php
                                          } else if($item->type == "1") {
                                            ?>
                        								<span class="badge bg-warning">Premium</span>
                        								<?php
                                          }
                                          ?>
                        							</td>
                        							<td>
                        								<?php
                                          if($item->status == "0") {
                                              ?>
                        								<span class="badge bg-danger">Not Released</span>
                        								<?php
                                          } else if($item->status == "1") {
                                            ?>
                        								<span class="badge bg-success">Released</span>
                        								<?php
                                          }
                                          ?>
                        							</td>


                        							<?php ++$int_table_id ?>
                        						</tr>
                        						<?php
                                        } ?>
                        					</tbody>

                        				</table>

                        			</div>

                        		</div>
                        	</div>
                        </div>
            			

            		</div> <!-- container-fluid -->

                    <!-- Add Episode Modal -->
                    <div class="modal fade" id="Add_Episode_Modal" tabindex="-1" role="dialog"
                    	aria-labelledby="Add_Episode_Modal_Lebel" aria-hidden="true">
                    	<div class="modal-dialog" role="document">
                    		<div class="modal-content">
                    			<div class="modal-header">
                    				<h5 class="modal-title" id="Add_Episode_Modal_Lebel">Edit Link</h5>
                    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    				</button>
                    			</div>
                    			<div class="modal-body">
                    				<div class="panel-body">
                    					<input type="hidden" id="modal_videos_id" name="modal_videos_id" value="000">
                    					<div class="form-group mb-3"> <label class="control-label">Episodes
                    							Name</label>&nbsp;&nbsp;<input id="modal_Episodes_Name" type="text"
                    							name="label" class="form-control" placeholder="Episode 1" required="">
                    					</div>
                    					<div class="form-group mb-3"> <label class="control-label">Thumbnail
                    							Url</label>&nbsp;&nbsp;<input id="modal_Thumbnail" type="text"
                    							name="label" class="form-control" placeholder="" required=""> </div>
                    					<div class="form-group mb-3"> <label class="control-label">Order</label> <input
                    							id="modal_Order" type="number" name="order" class="form-control"
                    							placeholder="0 to 9999" required=""> </div>
                    					<div class="form-group mb-3">
                    						<label>Description</label>
                    						<div>
                    							<textarea required="" class="form-control col-md-9"
                    								id="modal_Description" rows="5" spellcheck="false"></textarea>
                    						</div>
                    					</div>


                    					<div class="form-group mb-3"> <label class="control-label">Downloadable</label>
                    						<select id="modal_Downloadable" class="form-control form-select" name="source">
                    							<option value="No" selected="">No</option>
                    							<option value="Yes">Yes</option>
                    						</select> </div>

                    					<div class="form-group mb-3"> <label class="control-label">Type</label> <select
                    							id="modal_Type" class="form-control form-select" name="source">
                    							<option value="Free" selected="">Free</option>
                    							<option value="Premium">Premium</option>
                    						</select> </div>

                    					<div class="form-group mb-3"> <label class="control-label">Status</label> <select
                    							id="modal_Status" class="form-control form-select" name="source">
                    							<option value="Publish" selected="">Publish</option>
                    							<option value="Unpublish">Unpublish</option>
                    						</select><br> </div>

                    					<div class="form-group row mb-3" hidden>
                    						<label class="control-label col-sm-4 ">Intro Skip Avaliable?</label>
                    						<div class="col-sm-6">
                    							<input type="checkbox" id="add_modal_skip_available" switch="bool">
                    							<label for="add_modal_skip_available" data-on-label="Yes"
                    								data-off-label="No"></label>
                    						</div>
                    					</div>

                    					<div class="form-group mb-3" hidden> <label class="control-label">Intro Start</label>
                    						<div class="input-group date col-10" data-target-input="nearest">
                    							<input type="text" id="add_modal_intro_start"
                    								class="form-control datetimepicker-input"
                    								data-target="#add_modal_intro_start" placeholder="HH:MM:SS" />
                                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                    						</div>
                    					</div>

                    					<div class="form-group mb-3" hidden> <label class="control-label">Intro End</label>
                    						<div class="input-group date col-10" data-target-input="nearest">
                    							<input type="text" id="add_modal_intro_end"
                    								class="form-control datetimepicker-input"
                    								data-target="#add_modal_intro_end" placeholder="HH:MM:SS" />
                                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    			<div class="modal-footer">
                    				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    				<button type="button" onclick="Add_Episode()" class="btn btn-primary">Add
                    					Episode</button>
                    			</div>
                    		</div>
                    	</div>
                    </div>

					<!-- Edit Episode Modal -->
					<div class="modal fade" id="Edit_Episode_Modal" tabindex="-1" role="dialog"
						aria-labelledby="Edit_Episode_Modal_Lebel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="Edit_Episode_Modal_Lebel">Edit Link</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									</button>
								</div>
								<div class="modal-body">
									<div class="panel-body">
										<input type="hidden" id="Edit_modal_videos_id" name="modal_videos_id" value="000">
										<div class="form-group mb-3"> <label class="control-label">Episodes
												Name</label>&nbsp;&nbsp;<input id="Edit_modal_Episodes_Name" type="text" name="label"
												class="form-control" placeholder="Episode 1" required="">
										</div>
										<div class="form-group mb-3"> <label class="control-label">Thumbnail
												Url</label>&nbsp;&nbsp;<input id="Edit_modal_Thumbnail" type="text" name="label"
												class="form-control" placeholder="" required=""> </div>
										<div class="form-group mb-3"> <label class="control-label">Order</label> <input
												id="Edit_modal_Order" type="number" name="order" class="form-control"
												placeholder="0 to 9999" required=""> </div>
										<div class="form-group mb-3">
											<label>Description</label>
											<div>
												<textarea required="" class="form-control col-md-9" id="Edit_modal_Description"
													rows="5" spellcheck="false"></textarea>
											</div>
										</div>


										<div class="form-group mb-3"> <label class="control-label">Downloadable</label> <select
												id="Edit_modal_Downloadable" class="form-control form-select" name="source">
												<option value="No" selected="">No</option>
												<option value="Yes">Yes</option>
											</select> </div>

										<div class="form-group mb-3"> <label class="control-label">Type</label> <select id="Edit_modal_Type"
												class="form-control form-select" name="source">
												<option value="Free" selected="">Free</option>
												<option value="Premium">Premium</option>
											</select> </div>

										<div class="form-group mb-3"> <label class="control-label">Status</label> <select
												id="Edit_modal_Status" class="form-control form-select" name="source">
												<option value="Publish" selected="">Publish</option>
												<option value="Unpublish">Unpublish</option>
											</select><br> </div>

										<div class="form-group row mb-3" hidden>
											<label class="control-label col-sm-4 ">Intro Skip Avaliable?</label>
											<div class="col-sm-6">
												<input type="checkbox" id="edit_modal_skip_available" switch="bool">
												<label for="edit_modal_skip_available" data-on-label="Yes" data-off-label="No"></label>
											</div>
										</div>

										<div class="form-group" hidden> <label class="control-label">Intro Start</label>
											<div class="input-group date col-10" data-target-input="nearest">
												<input type="text" id="edit_modal_intro_start"
													class="form-control datetimepicker-input" data-target="#edit_modal_intro_start"
													placeholder="HH:MM:SS" />
												<div class="input-group-text"><i class="fas fa-clock"></i></div>
											</div>
										</div>

										<div class="form-group" hidden> <label class="control-label">Intro End</label>
											<div class="input-group date col-10" data-target-input="nearest">
												<input type="text" id="edit_modal_intro_end" class="form-control datetimepicker-input"
													data-target="#edit_modal_intro_end" placeholder="HH:MM:SS" />
												<div class="input-group-text"><i class="fas fa-clock"></i></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="button" onclick="Update_Episode_Data()" class="btn btn-primary">Update
										Episode</button>
								</div>
							</div>
						</div>
					</div>

                    <!-- Episode Fetch Modal -->
                <div class="modal fade" id="Fetch_Episode_Modal" tabindex="-1" role="dialog" 
                aria-labelledby="Fetch_Episode_Modal_Lebel"aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Fetch_Episode_Modal_Lebel">Fetch Episode</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                
                                <div class="panel-heading">
                                    <h3 class="panel-title row justify-content-center">Fetch Episode information</h3>
                                </div>
                
                                <hr>
                
                                <div class="panel-body">
                                    <table id="fetch_episode_datatable" class="table table-striped"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                
                                        <thead>
                
                                            <tr>
                
                                                <th>#</th>
                
                                                <th>Name</th>
                
                                                <th>Thumbnail</th>
                
                                                <th>Description</th>
                
                                                <th>Order</th>
                
                                                <th>Downloadable</th>
                
                                                <th>Type</th>
                
                                                <th>Status</th>
                
                                                <th>Add</th>
                
                                            </tr>
                
                                        </thead>
                
                                    </table>
                                </div>
                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" onclick="Fetch_Episode()" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Season No Modal -->
                <div class="modal fade" id="Add_Season_no_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="Add_Season_no_Modal_Lebel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Add_Season_Modal_Lebel">Add Season Number</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="panel-heading">
                                    <h3 class="panel-title row justify-content-center">Add Seasons No. To Fech All
                                        Episodes</h3>
                                </div>

                                <hr>

                                <div class="form-group"> <label class="control-label">Seasons
                                        Number</label>&nbsp;&nbsp;<input id="modal_Season_No" type="number" name="label"
                                        class="form-control" placeholder="Ex. 1" required=""> </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" onclick="Fetch_All_Data()" class="btn btn-primary"
                                        id="Fetch_btn">Fetch</button>
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
        var code = "<?php echo $config->license_code; ?>";
        if("<?php echo $config->tmdb_language; ?>" == "") {
            var tmdb_language = "en-US";
        } else {
            var tmdb_language = "<?php echo $config->tmdb_language; ?>";
        }

        $(function () {
            $('#add_modal_intro_start').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true,
    
            });
            $('#add_modal_intro_end').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true
            });
            $('#edit_modal_intro_start').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true
            });
            $('#edit_modal_intro_end').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true
            });
        });

        $('#datatable').dataTable({
            "order": [],
            "ordering": false,
            "paging": false,
            "info": false,
            "filter": false,
            "pageLength": 100
        });

        function Manage_Downloads(ID) {
            window.location.assign("../manage_episode_links/"+ID);
        }

        function Manage_Subtitle(ID) {
            window.location.assign("../subtitle_manager/"+ID+"/"+2);
        }

        function Add_Episode() {
            var modal_Episodes_Name = document.getElementById("modal_Episodes_Name").value;
            var modal_Thumbnail = document.getElementById("modal_Thumbnail").value;
            var modal_Order = document.getElementById("modal_Order").value;
            var modal_Description = document.getElementById("modal_Description").value;
    
            var modal_Downloadable = document.getElementById("modal_Downloadable").value;
            var modal_Type = document.getElementById("modal_Type").value;
            var modal_Status = document.getElementById("modal_Status").value;
    
            if (modal_Downloadable == "No") {
                var Downloadable = "0";
            } else if (modal_Downloadable == "Yes") {
                var Downloadable = "1";
            }
    
            if (modal_Type == "Free") {
                var Type = "0";
            } else if (modal_Type == "Premium") {
                var Type = "1";
            }
    
            if (modal_Status == "Publish") {
                var Status = "1";
            } else if (modal_Status == "Unpublish") {
                var Status = "0";
            }
    
            if ($('#add_modal_skip_available').is(':checked')) {
                var add_modal_skip_available_Count = 1;
            } else {
                var add_modal_skip_available_Count = 0;
            }
            var add_modal_intro_start = document.getElementById('add_modal_intro_start').value;
            var add_modal_intro_end = document.getElementById('add_modal_intro_end').value;
    
            var jsonObjects = {
                "season_id": "<?php echo $seasonID; ?>",
                "modal_Episodes_Name": modal_Episodes_Name,
                "modal_Thumbnail": modal_Thumbnail,
                "modal_Order": modal_Order,
                "modal_Source": "",
                "modal_Url": "",
                "modal_Description": modal_Description,
                "Downloadable": Downloadable,
                "Type": Type,
                "Status": Status,
                "add_modal_skip_available_Count": add_modal_skip_available_Count,
                "add_modal_intro_start": add_modal_intro_start,
                "add_modal_intro_end": add_modal_intro_end,
                "end_credits_marker": '0',
                "drm_uuid_addModal": "",
                "drm_license_uri_addModal": ""
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/add_episode') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response2) {
                    if (response2 != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Episode Added Successfully!',
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

        function Delete_Episode(ID) {
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
                        "episoadID": ID
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/delete_episode') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Episode Deleted successfully!',
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

		function Load_Episode_Data(ID) {
            var jsonObjects = {
                "episoadID": ID
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/getEpisodeDetails') ?>',
                data: jsonObjects,
                dataType: 'json',
                success: function (response3) {
                    var id = response3.id;
                    var Episoade_Name = response3.Episoade_Name;
                    var episoade_image = response3.episoade_image;
                    var episoade_description = response3.episoade_description;
                    var episoade_order = response3.episoade_order;
                    var season_id = response3.season_id;
                    var downloadable = response3.downloadable;
                    var type = response3.type;
                    var status = response3.status;
                    var source = response3.source;
                    var url = response3.url;
                    var edit_modal_skip_available = response3.skip_available;
                    var edit_modal_intro_start = response3.intro_start;
                    var edit_modal_intro_end = response3.intro_end;
    
    
                    if (!id == "") {
                        $("#Edit_modal_videos_id").val(id);
                        $("#Edit_modal_Episodes_Name").val(Episoade_Name);
                        $("#Edit_modal_Thumbnail").val(episoade_image);
                        $("#Edit_modal_Order").val(episoade_order);
                        $("#editSource").val(source);
                        $("#Edit_modal_Url").val(url);
                        $("#Edit_modal_Description").val(episoade_description);
    
                        if (downloadable == "1") {
                            $("#Edit_modal_Downloadable").val("Yes");
                        } else if (downloadable == "0") {
                            $("#Edit_modal_Downloadable").val("No");
                        }
    
                        if (type == "1") {
                            $("#Edit_modal_Type").val("Premium");
                        } else if (type == "0") {
                            $("#Edit_modal_Type").val("Free");
                        }
    
                        if (status == "1") {
                            $("#Edit_modal_Status").val("Publish");
                        } else if (status == "0") {
                            $("#Edit_modal_Status").val("Unpublish");
                        }
    
                        if (edit_modal_skip_available == "1") {
                            $('#edit_modal_skip_available').attr('checked', true);
                        } else if (edit_modal_skip_available == "0") {
                            $('#edit_modal_skip_available').attr('checked', false);
                        }
    
                        $("#edit_modal_intro_start").data("datetimepicker").date(edit_modal_intro_start);
                        $("#edit_modal_intro_end").data("datetimepicker").date(edit_modal_intro_end);
                    }
                }
            });
        }

		function Update_Episode_Data() {
            var Edit_modal_videos_id = document.getElementById("Edit_modal_videos_id").value;
            var Edit_modal_Episodes_Name = document.getElementById("Edit_modal_Episodes_Name").value;
            var Edit_modal_Thumbnail = document.getElementById("Edit_modal_Thumbnail").value;
            var Edit_modal_Order = document.getElementById("Edit_modal_Order").value;
            var Edit_modal_Description = document.getElementById("Edit_modal_Description").value;
            var Edit_modal_Downloadable = document.getElementById("Edit_modal_Downloadable").value;
            var Edit_modal_Type = document.getElementById("Edit_modal_Type").value;
            var Edit_modal_Status = document.getElementById("Edit_modal_Status").value;
    
            if (Edit_modal_Downloadable == "No") {
                var Edit_Downloadable = "0";
            } else if (Edit_modal_Downloadable == "Yes") {
                var Edit_Downloadable = "1";
            }
    
            if (Edit_modal_Type == "Free") {
                var Edit_Type = "0";
            } else if (Edit_modal_Type == "Premium") {
                var Edit_Type = "1";
            }
    
            if (Edit_modal_Status == "Publish") {
                var Edit_Status = "1";
            } else if (Edit_modal_Status == "Unpublish") {
                var Edit_Status = "0";
            }
    
            if ($('#edit_modal_skip_available').is(':checked')) {
                var edit_modal_skip_available_Count = 1;
            } else {
                var edit_modal_skip_available_Count = 0;
            }
            var edit_modal_intro_start = document.getElementById('edit_modal_intro_start').value;
            var edit_modal_intro_end = document.getElementById('edit_modal_intro_end').value;
    
    
            var jsonObjects = {
                "Edit_modal_videos_id": Edit_modal_videos_id,
                "Edit_modal_Episodes_Name": Edit_modal_Episodes_Name,
                "Edit_modal_Thumbnail": Edit_modal_Thumbnail,
                "Edit_modal_Order": Edit_modal_Order,
                "Edit_modal_Source": "",
                "Edit_modal_Url": "",
                "Edit_modal_Description": Edit_modal_Description,
                "Edit_Downloadable": Edit_Downloadable,
                "Edit_Type": Edit_Type,
                "Edit_Status": Edit_Status,
                "edit_modal_skip_available_Count": edit_modal_skip_available_Count,
                "edit_modal_intro_start": edit_modal_intro_start,
                "edit_modal_intro_end": edit_modal_intro_end,
				"end_credits_marker": '0',
                "drm_uuiddrm_uuid_editModal": "",
                "drm_license_uri_editModal": ""
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/updateEpisode') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response4) {
                    if (response4) {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Episode Updated successfully!',
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

        function Fetch_All_Data() {
            var modal_Season_No = document.getElementById("modal_Season_No").value;
    
            Swal.fire({
                title: "Are you sure?",
                text: "It Will Fetch All Episode Data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, Fetch All!"
            }).then(function (result) {
                if (result.value) {
                    var jsonObjects = {
                        "Type": "Webseries_id",
                        "id": <?php echo $seasonWebSeriesData->id; ?>
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/get_tmdb_id') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (IMDB_ID) {
                            if (IMDB_ID != '') {
    
                                $.ajax({
                                    type: 'GET',
                                    url: "https://cloud.team-dooo.com/Dooo/TMDB/?code="+ code +"&filter=season&type=tv&id=" + IMDB_ID +"&season_no="+ modal_Season_No +"&language=" + tmdb_language+"&image_storage_provider="+"<?php echo $config->image_storage_provider; ?>"+"&key="+"<?php echo $config->imgbb_api_key; ?>",
                                    dataType: 'json',
                                    beforeSend: function () {
                                        $("#Fetch_btn").html('Fetching...');
                                    },
                                    success: function (response) {
                                        $("#Fetch_btn").html('Fetch');
                                        $('#Add_Season_no_Modal').modal('hide');
    
                                        var episodes_arr = response.episodes;
                                        var episodes = new Array();
    
                                        for(let i = 0; i < episodes_arr.length; i++){
                                            var episode_data = episodes_arr[i];
    
                                            var episode = {};
                                            episode['name'] = episode_data.name;
                                            episode['still_path'] = episode_data.still_path;
                                            episode['overview'] = episode_data.overview;
                                            episode['episode_number'] = episode_data.episode_number;
                                            episodes.push(episode);
    
    
                                            if(i == episodes_arr.length - 1){
                                                $('#Fetch_Episode_Modal').css('overflow-y', 'auto');
                                                $('#Fetch_Episode_Modal').modal('show');
            
                                                var tabl = $('#fetch_episode_datatable').dataTable({
                                                    "order": [],
                                                    "ordering": false,
                                                    "paging": false,
                                                    "info": false,
                                                    "filter": false,
                                                    "pageLength": 100,
                                                    "destroy": true,
                                                    data: episodes,
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
                                                                return '<textarea class="form-control" maxlength="225" rows="5" type="text" id='+ meta.row+1 +'>'+data+'</textarea>';
                                                            }
                                                        },
                                                        { 
                                                            data: 'still_path',
                                                            render: function name(data, type, row, meta) {
                                                                if (data.includes("https")) {
                                                                    return '<textarea class="form-control" maxlength="225" rows="8" type="text" id='+ meta.row+2 +'>'+data+'</textarea>';
                                                                } else {
                                                                    return '<textarea class="form-control" maxlength="225" rows="8" type="text" id='+ meta.row+2 +'>https://www.themoviedb.org/t/p/original'+data+'</textarea>';
                                                                }
                                                            }
                                                        },
                                                        { 
                                                            data: 'overview',
                                                            render: function name(data, type, row, meta) {
                                                                return '<textarea class="form-control" maxlength="225" rows="10" placeholder="" id='+ meta.row+3 +'>'+data+'</textarea>';
                                                            }
            
                                                        },
                                                        //{
                                                        //    data: 'Source',
                                                        //    render: function (data, type, row, meta) {
                                                        //        return '<div class="form-group"><select id='+ meta.row+4 +' class="form-control" name="source" id="selected-source"><?php //include("partials/source/stream_source.php"); ?>//</div>';
                                                        //    }
                                                        //
                                                        //},
                                                        { 
                                                            data: 'episode_number',
                                                            render: function name(data, type, row, meta) {
                                                                return '<input class="form-control form-control-sm" type="number" id='+ meta.row+5 +' value='+data+'>';
                                                            }
            
                                                        },
                                                        // {
                                                        //     data: 'Url',
                                                        //     render: function (data, type, row, meta) {
                                                        //         return '<textarea id='+ meta.row+6 +' type="text" maxlength="225" rows="6" name="url" value="" class="form-control" placeholder="" required=""></textarea>';
                                                        //     }
                                                        //
                                                        // },
                                                        { 
                                                            data: 'Downloadable',
                                                            render: function (data, type, row, meta) {
                                                                return '<select id='+ meta.row+7 +' class="form-control" name="source"> <option value="No" selected="">No</option> <option value="Yes">Yes</option> </select>';
                                                            }
            
                                                        },
                                                        { 
                                                            data: 'Type',
                                                            render: function (data, type, row, meta) {
                                                                return '<select id='+ meta.row+8 +' class="form-control" name="source"> <option value="Free" selected="">Free</option> <option value="Premium">Premium</option> </select>';
                                                            }
            
                                                        },
                                                        { 
                                                            data: 'Status',
                                                            render: function (data, type, row, meta) {
                                                                return '<input type="checkbox" id='+ meta.row+9 +' switch="bool" checked> <label for='+ meta.row+9 +' data-on-label="" data-off-label=""></label>';
                                                            }
            
                                                        },
                                                        { 
                                                            data: 'Add',
                                                            render: function (data, type, row, meta) {
                                                                var Add = "Add";
                                                                return '<input type="checkbox" id='+ meta.row+10 +' switch="bool" checked> <label for='+ meta.row+10 +' data-on-label="" data-off-label=""></label>';
                                                            }
            
                                                        }
                                                    ]
                                                });
                                            }
                                          
                                        }
                                    },
                                    error: function (jq, status, message) {
                                        $("#Fetch_btn").html('Fetch');
                                        $('#Add_Season_no_Modal').modal('hide');
                                        swal.fire({
                                            title: 'Error',
                                            text: 'No Episodes Avaliable For the Season No. You Entered :(',
                                            type: 'warning'
                                        }).then(function () {
                                            location.reload();
                                        });
                                    }
                                });
    
                            } else {
                                swal.fire({
                                    title: 'Error',
                                    text: 'WebSeries Not Added From TMDB :(',
                                    type: 'error'
                                }).then(function () {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
    
           /* Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                }
    
                // timer: 3000,
                // timerProgressBar: true
            });*/
        }

        function Fetch_Episode() {
            var table = $('#fetch_episode_datatable').DataTable();
    
            Swal.fire({
                title: 'Please Wait',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: ()=>{
                    Swal.showLoading();
                },
                onClose: ()=>{
                    $('#Fetch_Episode_Modal').modal('hide');
                    location.reload();
                }
            });
    
            table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                    var data = this.data();
                
                    var modal_Episodes_Name = $("#"+ rowIdx+1).val();
                    var modal_Thumbnail = $("#"+ rowIdx+2).val();
                    var modal_Order = $("#"+ rowIdx+5).val();
                    var modal_Description = $("#"+ rowIdx+3).val();
    
                    var modal_Downloadable = $("#"+ rowIdx+7).val();
                    var modal_Type = $("#"+ rowIdx+8).val();
    
                    if (modal_Downloadable == "No") {
                      var Downloadable = "0";
                    } else if (modal_Downloadable == "Yes") {
                        var Downloadable = "1";
                    }
                
                    if (modal_Type == "Free") {
                        var Type = "0";
                    } else if (modal_Type == "Premium") {
                        var Type = "1";
                    }
                
                    if ($('#'+rowIdx+9).is(':checked')) {
                        var Publish_toggle_Count = 1;
                    } else {
                        var Publish_toggle_Count = 0;
                    }
                
                    if ($('#'+ rowIdx+10).is(':checked')) {
                        var Add_toggle_Count = 1;
                    } else {
                        var Add_toggle_Count = 0;
                    }
                
                    if(Add_toggle_Count == 1) {
                        var jsonObjects = {
                            "season_id": "<?php echo $seasonID; ?>",
                            "modal_Episodes_Name": modal_Episodes_Name,
                            "modal_Thumbnail": modal_Thumbnail,
                            "modal_Order": modal_Order,
                            "modal_Source": "",
                            "modal_Url": "",
                            "modal_Description": modal_Description,
                            "Downloadable": Downloadable,
                            "Type": Type,
                            "Status": Publish_toggle_Count,
                            "add_modal_skip_available_Count": "0",
                            "add_modal_intro_start": "",
                            "add_modal_intro_end": "",
                            "end_credits_marker": "",
                            "drm_uuid_addModal": "",
                            "drm_license_uri_addModal": "",
                        };
                        $.ajax({
                            type: 'POST',
                            url: '<?= site_url('Admin_api/add_episode') ?>',
                            data: jsonObjects,
                            dataType: 'text',
                            timeout: 0,
                            success: function (response) {
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