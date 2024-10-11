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

            						<h4 class="font-size-18">Custom Slider</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Slider</a></li>

            							<li class="breadcrumb-item active">Custom Slider</li>

            						</ol>

            					</div>

            				</div>

                            <div class="col-sm-6 row justify-content-end">
                            	<a class="btn btn-primary dropdown-toggle waves-effect waves-light col-sm-2"
                            		data-bs-toggle="modal" data-bs-target="#Add_cs_Modal"> <i
                            			class="mdi mdi-plus-box-multiple-outline mr-2"></i> Add</a>
                            </div>

            			</div>

            			<!-- end page title -->

                        <div class="form" action="" method="post">

                        	<div class="row">

                        		<div class="col-md-12">

                        			<div class="card card-body">

                        				<h3 class="card-title mt-0">Custom Slider</h3>

                        				<br>

                        				<table id="datatable" class="table table-striped"
                        					style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        					<thead>

                        						<tr>

                        							<th>#</th>

                        							<th>##</th>

                        							<th>Title</th>

                        							<th>Banner</th>

                        							<th>Type</th>

                        							<th>Status</th>

                        						</tr>

                        					</thead>

                        					<tbody>
                                                <?php
                                            $int_table_id = 1;
                                           foreach($ImageSliders as $ImageSlider) {
                                               ?>
                        						<tr>
                        							<th><?php echo($int_table_id); ?></th>

                        							<td>
													    <div class="btn-group mr-1 mt-2"> 
															<button type="button" class="btn btn-primary btn-sm dropdown-bs-toggle" data-bs-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">Edit</button>
															    <div class="dropdown-menu" style=""> 
																	<a class="dropdown-item" id="Edit"data-bs-toggle="modal" data-bs-target="#Edit_cs_Modal" onclick="load_cs_details(<?php echo stripslashes($ImageSlider->id); ?>)">Edit</a> 
																	<a class="dropdown-item" id="Delete" onclick="Delete_cs(<?php echo stripslashes($ImageSlider->id); ?>)">Delete</a>
																</div>
                                                        </div>

                        							</td>

                        							<td><?php echo stripslashes($ImageSlider->title); ?></td>

                        							<td><img class="img-fluid" height="100" width="80"
                        									src=<?php echo $ImageSlider->banner; ?>
                        									data-holder-rendered="true"></td>

                        							<?php
                                            if($ImageSlider->content_type== 0) {
                                                ?>
                        							<td><span class="badge bg-info">Movie</span></td>
                        							<?php
                                            }
                                            if($ImageSlider->content_type == 1) {
                                                ?>
                        							<td><span class="badge bg-info">WebSeries</span></td>
                        							<?php
                                            }
                                            if($ImageSlider->content_type == 2) {
                                                ?>
                        							<td><span class="badge bg-info">WebView</span></td>
                        							<?php
                                            }
                                            if($ImageSlider->content_type == 3) {
                                                ?>
                        							<td><span class="badge bg-info">External Browser </span></td>
                        							<?php
                                            }
                                            ?>




                        							<?php
                                            if($ImageSlider->status == 0) {
                                                ?>
                        							<td><span class="badge bg-danger">UnPublished</span></td>
                        							<?php
                                            }
                                            if($ImageSlider->status == 1) {
                                                ?>
                        							<td><span class="badge bg-success">Published</span></td>
                        							<?php
                                            }

                                            ?>



                        							<?php ++$int_table_id ?>
                        						</tr>
                        						<?php
                                              }
                                              ?>
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

            <!-- Add Custom Slider Modal -->
            <div class="modal fade" id="Add_cs_Modal" tabindex="-1" role="dialog" aria-labelledby="Add_cs_Modal_Lebel"
            	aria-hidden="true">
            	<div class="modal-dialog" role="document">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h5 class="modal-title" id="Add_cs_Modal_Lebel">Custom Slider</h5>
            				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            				</button>
            			</div>
            			<div class="modal-body">

            				<div class="panel-heading">
            					<h3 class="panel-title row justify-content-center">Slider information</h3>
            				</div>

            				<hr>

            				<input type="hidden" id="add_cs_content_id" name="add_cs_content_id" value="0">

            				<div class="form-group mb-3"> <label class="control-label">Slider Type</label>
            					<select id="add_slider_type" class="form-control" name="source">
            						<option value="0" selected="">Movie</option>
            						<option value="1">WebSeries</option>
            						<option value="2">WebView</option>
            						<option value="3">External Browser</option>
            					</select> </div>

            				<div class="form-group mb-3" id="add_cs_Movie_div">
            					<label class="control-label">Movie</label>
            					<div>
            						<select id="Movie_id" class="select2 form-control" style="width:100%;" data-dropdown-parent="#Add_cs_Modal"></select>
            					</div>
            				</div>

            				<div class="form-group mb-3" id="add_cs_Web_Series_div">
            					<label class="control-label">Web Series</label>
            					<div>
            						<select id="Web_Series_id" class="select2 form-control" style="width:100%;" data-dropdown-parent="#Add_cs_Modal"></select>
            					</div>
            				</div>

            				<div class="form-group mb-3"> <label class="control-label">
            						Title</label>&nbsp;&nbsp;<input id="add_cs_Title" type="text" name="label"
            						class="form-control" placeholder="" required=""> </div>

            				<div class="form-group mb-3"> <label class="control-label">
            						Banner</label>&nbsp;&nbsp;<input id="add_cs_Banner" type="text" name="label"
            						class="form-control" placeholder="" required=""> </div>

            				<div class="form-group mb-3" id="add_cs_URL_div"> <label class="control-label">
            						URL</label>&nbsp;&nbsp;<input id="add_cs_URL" type="text" name="label"
            						class="form-control" placeholder="" required=""> </div>

            				<div class="form-group"> <label class="control-label">Status</label> <select
            						id="add_cs_Status" class="form-control" name="source" id="selected-source">
            						<option value="1" selected="">Publish</option>
            						<option value="0">Unpublish</option>
            					</select><br> </div>

            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            				<button type="button" class="btn btn-primary" id="add_cs">Add</button>
            			</div>
            		</div>
            	</div>
            </div>

            <!-- Edit Custom Slider Modal -->
            <div class="modal fade" id="Edit_cs_Modal" tabindex="-1" role="dialog" aria-labelledby="Edit_cs_Modal_Lebel"
            	aria-hidden="true">
            	<div class="modal-dialog" role="document">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h5 class="modal-title" id="Edit_cs_Modal_Lebel">Custom Slider</h5>
            				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            				</button>
            			</div>
            			<div class="modal-body">

            				<div class="panel-heading">
            					<h3 class="panel-title row justify-content-center">Slider information</h3>
            				</div>

            				<hr>

            				<input type="hidden" id="Edit_cs_id" name="Edit_cs_id" value="0">

            				<input type="hidden" id="Edit_cs_content_id" name="Edit_cs_content_id" value="0">

            				<div class="form-group mb-3"> <label class="control-label">Slider Type</label>
            					<select id="Edit_slider_type" class="form-control" name="source">
            						<option value="0" selected="">Movie</option>
            						<option value="1">WebSeries</option>
            						<option value="2">WebView</option>
            						<option value="3">External Browser</option>
            					</select> </div>

            				<div class="form-group mb-3" id="Edit_cs_Movie_div">
            					<label class="control-label">Movie</label>
            					<div>
            						<select id="Edit_Movie_id" class="select2 form-control" style="width:100%;" data-dropdown-parent="#Edit_cs_Modal"></select>
            					</div>
            				</div>

            				<div class="form-group mb-3" id="Edit_cs_Web_Series_div">
            					<label class="control-label">Web Series</label>
            					<div>
            						<select id="Edit_Web_Series_id" class="select2 form-control" style="width:100%;" data-dropdown-parent="#Edit_cs_Modal"></select>
            					</div>
            				</div>

            				<div class="form-group mb-3"> <label class="control-label">
            						Title</label>&nbsp;&nbsp;<input id="Edit_cs_Title" type="text" name="label"
            						class="form-control" placeholder="" required=""> </div>

            				<div class="form-group mb-3"> <label class="control-label">
            						Banner</label>&nbsp;&nbsp;<input id="Edit_cs_Banner" type="text" name="label"
            						class="form-control" placeholder="" required=""> </div>

            				<div class="form-group mb-3" id="Edit_cs_URL_div"> <label class="control-label">
            						URL</label>&nbsp;&nbsp;<input id="Edit_cs_URL" type="text" name="label"
            						class="form-control" placeholder="" required=""> </div>

            				<div class="form-group"> <label class="control-label">Status</label> <select
            						id="Edit_cs_Status" class="form-control" name="source" id="selected-source">
            						<option value="1" selected="">Publish</option>
            						<option value="0">Unpublish</option>
            					</select><br> </div>

            			</div>
            			<div class="modal-footer">
            				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            				<button type="button" class="btn btn-primary" id="Edit_cs">Edit</button>
            			</div>
            		</div>
            	</div>
            </div>

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>

    <script>
	    $(document).ready(function () {

			$('#Movie_id').select2({
			    placeholder: 'Select Movie',
			    minimumInputLength: 2,
			    ajax: {
			        url: '<?= site_url('Admin_api/getNotificationContentList') ?>',
			        dataType: 'json',
			        delay: 250,
			        data: function (params) {
			            var query = {
			                search: params.term,
			                type: 'movie'
			            }
			             return query;
			        },
			        processResults: function (data) {
			            return {
			                results: data
			            };
			        },
			        cache: true
			    }
			});
			
			$("#Movie_id").change(function () {
                var Movie_id = $("#Movie_id option:selected").val();
                if (Movie_id != '' && Movie_id != null) {
					$.ajax({
                        url: '<?= site_url('Admin_api/getMovieByID') ?>',
                        type: 'POST',
				        data : { movieID : Movie_id },
                        dataType:'json',
                        success: function(result){
				        	$("#add_cs_content_id").val(result.id);
		            	    $("#add_cs_Banner").val(result.poster);
		            	    $("#add_cs_Title").val(result.name);
                        }
                    });
                }
            });


			$('#Web_Series_id').select2({
                placeholder: 'Select Web Series',
                minimumInputLength: 2,
                ajax: {
                	url: '<?= site_url('Admin_api/getNotificationContentList') ?>',
                	dataType: 'json',
                	delay: 250,
                	data: function (params) {
                		var query = {
                			search: params.term,
                			type: 'web_series'
                		}
                		return query;
                	},
                	processResults: function (data) {
                		return {
                			results: data
                		};
                	},
                	cache: true
                }
            });

            $("#Web_Series_id").change(function () {
                var Web_Series_id = $("#Web_Series_id option:selected").val();
                if (Web_Series_id != '' && Web_Series_id != null) {
                	$.ajax({
                		url: '<?= site_url('Admin_api/getWebSeriesByID') ?>',
                		type: 'POST',
                		data : { WebSeriesID : Web_Series_id },
                		dataType: 'json'
                	})
                	.done(function (response) {
                		$("#add_cs_content_id").val(response.id);
                		$("#add_cs_Banner").val(response.poster);
                		$("#add_cs_Title").val(response.name);
                	})
                	.fail(function (response) {
                		//alert('Something went wrong..');
                	})
                }
            });

			
			$('#add_cs').click(function(){
                var add_cs_content_id = document.getElementById("add_cs_content_id").value;
                var add_slider_type = document.getElementById("add_slider_type").value;
                var add_cs_Title = document.getElementById("add_cs_Title").value;
                var add_cs_Banner = document.getElementById("add_cs_Banner").value;
                var add_cs_URL = document.getElementById("add_cs_URL").value;
                var add_cs_Status = document.getElementById("add_cs_Status").value;
            
            
                var jsonObjects = {
                    "add_cs_content_id": add_cs_content_id,
                    "add_slider_type": add_slider_type,
                    "add_cs_Title": add_cs_Title,
                    "add_cs_Banner": add_cs_Banner,
                    "add_cs_URL": add_cs_URL,
                    "add_cs_Status": add_cs_Status
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/add_cs') ?>',
                    data: jsonObjects,
                    dataType: 'text',
                    success: function (response) {
                        if (response != "") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Custom Slider Added Successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong!',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            });



			$('#Edit_Movie_id').select2({
                placeholder: 'Select Movie',
                minimumInputLength: 2,
                ajax: {
                    url: '<?= site_url('Admin_api/getNotificationContentList') ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'movie'
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });


			$("#Edit_Movie_id").change(function () {
                var Edit_Movie_id = $("#Edit_Movie_id option:selected").val();
                if (Edit_Movie_id != '' && Edit_Movie_id != null) {
                    $.ajax({
                        url: '<?= site_url('Admin_api/getMovieByID') ?>',
                        type: 'POST',
                        data: {
                            movieID: Edit_Movie_id
                        },
                        dataType: 'json'
                    })
                    .done(function (response) {
                        $("#Edit_cs_content_id").val(response.id);
                        $("#Edit_cs_Banner").val(response.poster);
                        $("#Edit_cs_Title").val(response.name);
                    })
                    .fail(function (response) {
                        //alert('Something went wrong..');
                    })
                }
            });

			$('#Edit_Web_Series_id').select2({
                placeholder: 'Select Web Series',
                minimumInputLength: 2,
                ajax: {
                    url: '<?= site_url('Admin_api/getNotificationContentList') ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'web_series'
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

			$("#Edit_Web_Series_id").change(function () {
                var Edit_Web_Series_id = $("#Edit_Web_Series_id option:selected").val();
                if (Edit_Web_Series_id != '' && Edit_Web_Series_id != null) {
                    $.ajax({
                        url: '<?= site_url('Admin_api/getWebSeriesByID') ?>',
                        type: 'POST',
                        data: {
                            WebSeriesID: Edit_Web_Series_id
                        },
                        dataType: 'json'
                    })
                    .done(function (response) {
                        $("#Edit_cs_content_id").val(response.id);
                        $("#Edit_cs_Banner").val(response.poster);
                        $("#Edit_cs_Title").val(response.name);
                    })
                    .fail(function (response) {
                        //alert('Something went wrong..');
                    })
                }
            });



	    	document.getElementById('add_cs_URL_div').setAttribute("hidden", "");
	    	document.getElementById('add_cs_Web_Series_div').setAttribute("hidden", "");
	    	$("#add_slider_type").change(function () {
	    		if ($(this).val() == 0 || $(this).val() == 1) {
	    			document.getElementById('add_cs_URL_div').setAttribute("hidden", "");
	    			if ($(this).val() == 0) {
	    				document.getElementById('add_cs_Movie_div').removeAttribute("hidden");
	    				document.getElementById('add_cs_Web_Series_div').setAttribute("hidden", "");
	    			} else if ($(this).val() == 1) {
	    				document.getElementById('add_cs_Movie_div').setAttribute("hidden", "");
	    				document.getElementById('add_cs_Web_Series_div').removeAttribute("hidden");
	    			}
	    		} else {
	    			document.getElementById('add_cs_Movie_div').setAttribute("hidden", "");
	    			document.getElementById('add_cs_Web_Series_div').setAttribute("hidden", "");
	    			document.getElementById('add_cs_URL_div').removeAttribute("hidden");
	    		}
	    	});

	    	document.getElementById('Edit_cs_URL_div').setAttribute("hidden", "");
	    	document.getElementById('Edit_cs_Web_Series_div').setAttribute("hidden", "");
	    	$("#Edit_slider_type").change(function () {
	    		if ($(this).val() == 0 || $(this).val() == 1) {
	    			document.getElementById('Edit_cs_URL_div').setAttribute("hidden", "");
	    			if ($(this).val() == 0) {
	    				document.getElementById('Edit_cs_Movie_div').removeAttribute("hidden");
	    				document.getElementById('Edit_cs_Web_Series_div').setAttribute("hidden", "");
	    			} else if ($(this).val() == 1) {
	    				document.getElementById('Edit_cs_Movie_div').setAttribute("hidden", "");
	    				document.getElementById('Edit_cs_Web_Series_div').removeAttribute("hidden");
	    			}
	    		} else {
	    			document.getElementById('Edit_cs_Movie_div').setAttribute("hidden", "");
	    			document.getElementById('Edit_cs_Web_Series_div').setAttribute("hidden", "");
	    			document.getElementById('Edit_cs_URL_div').removeAttribute("hidden");
	    		}

	    		$("#Edit_Movie_id").empty().trigger('change')
	    		$("#Edit_Web_Series_id").empty().trigger('change')
	    	});

			
		});

		function Delete_cs(ID) {
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
                        url: '<?= site_url('Admin_api/delete_cs') ?>',
                        data: {
                            "ID": ID
                        },
                        dataType: 'text',
                        success: function (response) {
                            if (response != "") {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Custom Slider Deleted successfully!',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#556ee6',
                                    cancelButtonColor: "#f46a6a"
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
								swal.fire({
                                    title: 'Error!',
                                    text: 'Something Went Wrong!',
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#556ee6',
                                    cancelButtonColor: "#f46a6a"
                                }).then(function() {
                                    location.reload();
                                });
                            }
    
                        }
                    });
                }
            });
		}

		function load_cs_details(ID) {
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Admin_api/get_cs_details') ?>',
				data: {
				    "ID": ID
			    },
				dataType: 'json',
				success: function (response) {
					if (response != "") {
						$("#Edit_cs_id").val(response.id);

						$("#Edit_slider_type").val(response.content_type);

						if (response.content_type == 0 || response.content_type == 1) {
							document.getElementById('Edit_cs_URL_div').setAttribute("hidden", "");
							if (response.content_type == 0) {
								document.getElementById('Edit_cs_Movie_div').removeAttribute("hidden");
								document.getElementById('Edit_cs_Web_Series_div').setAttribute("hidden", "");
							} else if (response.content_type == 1) {
								document.getElementById('Edit_cs_Movie_div').setAttribute("hidden", "");
								document.getElementById('Edit_cs_Web_Series_div').removeAttribute("hidden");
							}
						} else {
							document.getElementById('Edit_cs_Movie_div').setAttribute("hidden", "");
							document.getElementById('Edit_cs_Web_Series_div').setAttribute("hidden", "");
							document.getElementById('Edit_cs_URL_div').removeAttribute("hidden");
						}

						$("#Edit_cs_Title").val(response.title);
						$("#Edit_cs_Banner").val(response.banner);
						$("#Edit_cs_content_id").val(response.content_id);
						$("#Edit_cs_URL").val(response.url);
						$("#Edit_cs_Status").val(response.status);



						var $Edit_Movie_id_option = $("<option selected></option>").val(response.content_id).text(response.title);
						$('#Edit_Movie_id').append($Edit_Movie_id_option).trigger('change');
						var $Edit_Web_Series_id_option = $("<option selected></option>").val(response.content_id).text(response.title);
						$('#Edit_Web_Series_id').append($Edit_Web_Series_id_option).trigger('change');

					}
				}
			});
		}

		$('#Edit_cs').click(function(){
            var Edit_cs_id = document.getElementById("Edit_cs_id").value;
            var Edit_cs_content_id = document.getElementById("Edit_cs_content_id").value;
            var Edit_slider_type = document.getElementById("Edit_slider_type").value;
            var Edit_cs_Title = document.getElementById("Edit_cs_Title").value;
            var Edit_cs_Banner = document.getElementById("Edit_cs_Banner").value;
            var Edit_cs_URL = document.getElementById("Edit_cs_URL").value;
            var Edit_cs_Status = document.getElementById("Edit_cs_Status").value;
        
        
                var jsonObjects = {
                    "Edit_cs_id": Edit_cs_id,
                    "Edit_cs_content_id": Edit_cs_content_id,
                    "Edit_slider_type": Edit_slider_type,
                    "Edit_cs_Title": Edit_cs_Title,
                    "Edit_cs_Banner": Edit_cs_Banner,
                    "Edit_cs_URL": Edit_cs_URL,
                    "Edit_cs_Status": Edit_cs_Status
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/edit_cs') ?>',
                    data: jsonObjects,
                    dataType: 'text',
                    success: function (response) {
                        if (response != "") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Custom Slider Updated Successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                title: 'Error!',
                                text: 'Something Went Wrong!',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
        });

    </script>