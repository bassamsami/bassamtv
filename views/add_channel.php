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

                        <div class="form" action="" method="post">
                        	<div class="row">
                        		<div class="col-md-6">
                        			<div class="card card-body">
                        				<h3 class="card-title mt-0">Channel Info</h3>
                        				<hr>

                        				<div class="form-group mb-3">
                        					<label>Title</label>
                        					<input class="form-control" type="text" value="" id="title">
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Stream Type</label>
                        					<select class="form-control form-select" id="Stream_Type">
											    <?php include("partials/source/live_source.php"); ?>
                        					</select>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Stream Link</label>
                        					<input class="form-control" type="text" value="" id="Stream_Link">
                        				</div>

                                        <div class="form-group mb-3" id="drm_uuid_div" hidden>
                                            <label class="control-label">DRM</label>
                                            <select class="form-control" name="drm_uuid" id="drm_uuid">
                        						<option value="" selected="">NO DRM</option>
                        						<option value="WIDEVINE">WIDEVINE</option>
                                                <option value="PLAYREADY">PLAYREADY</option>
                                                <option value="CLEARKEY">CLEARKEY</option>
                        					</select>
                        				</div>
                                        <div class="form-group mb-3" id="drm_license_uri_div" hidden>
                                            <label class="control-label">DRM License URI</label>
                        					<input id="drm_license_uri" type="text" name="drm_license_uri" class="form-control">
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Free/Premium</label>
                        					<select class="form-control form-select" id="Free_Premium">
                        						<option>Free</option>
                        						<option>Premium</option>
                        					</select>
                        				</div>

										<div class="form-group mb-3">
                        					<label>User Agent</label>
                        					<input class="form-control" type="text" value="" id="user_agent">
                        				</div>

                                        <div class="form-group mb-3">
                        					<label>Referer</label>
                        					<input class="form-control" type="text" value="" id="referer">
                        				</div>

                                        <div class="form-group mb-3">
                        					<label>Cookie</label>
                        					<textarea class="form-control" type="text" value="" id="cookie" row="5"></textarea>
                        				</div>

										<div class="form-group mb-3">
											<form class="headers" enctype="multipart/form-data">
												<div data-repeater-list="Headers">
													<div class="row" data-repeater-item>
														<div class="mb-4 col-lg-10">
															<label class="form-label" for="name">Header</label>
															<input type="text" id="header" name="header" class="form-control" placeholder="" />
														</div>
														<!-- end col -->
														<div class="col-lg-2 col-sm-4 align-self-center">
															<div class="d-grid">
																<input data-repeater-delete type="button" class="btn btn-primary mb-2" value="Delete" />
															</div>
														</div>
														<!-- end col -->
													</div>
													<!-- end row -->
												</div>
												<input data-repeater-create type="button" class="btn btn-success mt-2 mt-sm-0" value="Add Header" />
											</form>
										</div>
                        			</div>
                        		</div>
                        		<div class="col-md-6">
                        			<div class="card card-body">
                        				<h3 class="card-title mt-0">Additional Info</h3>
                        				<hr>

                        				<div class="form-group mb-3">
                        					<label>Poster</label>
                        					<div class="row justify-content-center mb-3">
                        						<img class="img-fluid" id="poster_image"
                        							style="padding: 0.20rem; background-color: #FFF; border: 1px solid #dee2e6; border-radius: 0.25rem; max-width: 350px; height: auto;"
                        							width="350" src="<?php echo base_url('assets/images/Dooo_poster_placeholder.png'); ?>"
                        							data-holder-rendered="true">
                        					</div>

                        					<div class="row justify-content-center">
                        						<div class="col-lg-10">
                        							<input class="form-control" id="Poster_URL" type="text"
                        								placeholder="Image URL (Best Fit = 2048 x 1152)" value=""
                        								id="example-text-input">
                        						</div>

                        						<div class="col-lg-1">
                        							<span class="input-group-btn">
                        								<button type="submit" onclick="SET_Poster()" id="import_btn"
                        									class="btn btn-primary waves-effect waves-light"> SET
                        								</button>
                        							</span>

                        						</div>

                        					</div>
                        				</div>

                                        <div class="form-group mb-3">
                							<label>Genres</label>
                							<!--<input class="form-control" type="text" value="" id="genres">-->
                							<select class="select2 form-control select2-multiple" id="genres"
                								multiple="multiple" multiple data-placeholder="Choose ..."></select>
                						</div>

                        				<div class="form-group mb-3">
                        					<label>Featured</label>
                        					<div>
                        						<input type="checkbox" id="Featured" switch="bool" checked />
                        						<label for="Featured" data-on-label="" data-off-label=""></label>
                        					</div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Publish</label>
                        					<div>
                        						<input type="checkbox" id="Publish_toggle" switch="bool" checked />
                        						<label for="Publish_toggle" data-on-label="" data-off-label=""></label>
                        					</div>
                        				</div>

                        				<div class="mb-3">
                        					<div class="col-md-12 row justify-content-end">
                        						<button class="btn btn-primary dropdown-toggle waves-effect waves-light col-md-4"
                        							onclick="Save_Movie_Data()" id="create_btn" type="submit"
                        							aria-haspopup="true" aria-expanded="false">
                        							<i class="fas fa-plus mr-2"></i> Create
                        						</button>
                        					</div>
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
		$(document).ready(function () {
            $('.headers').repeater({
                // (Optional)
                // start with an empty list of repeaters. Set your first (and only)
                // "data-repeater-item" with style="display:none;" and pass the
                // following configuration flag
                initEmpty: true,
                // (Optional)
                // "defaultValues" sets the values of added items.  The keys of
                // defaultValues refer to the value of the input's name attribute.
                // If a default value is not specified for an input, then it will
                // have its value cleared.
                defaultValues: {
                    'text-input': 'foo'
                },
                // (Optional)
                // "show" is called just after an item is added.  The item is hidden
                // at this point.  If a show callback is not given the item will
                // have $(this).show() called on it.
                show: function () {
                    $(this).slideDown();
                },
                // (Optional)
                // "hide" is called when a user clicks on a data-repeater-delete
                // element.  The item is still visible.  "hide" is passed a function
                // as its first argument which will properly remove the item.
                // "hide" allows for a confirmation step, to send a delete request
                // to the server, etc.  If a hide callback is not given the item
                // will be deleted.
                hide: function (deleteElement) {
                    if(confirm('Are you sure you want to delete this Header?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                // (Optional)
                // You can use this if you need to manually re-index the list
                // for example if you are using a drag and drop library to reorder
                // list items.
                ready: function (setIndexes) {
                    //$dragAndDrop.on('drop', setIndexes);
                },
                // (Optional)
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: false
            })

            var Stream_Type_value = document.getElementById("Stream_Type").value;
            if(Stream_Type_value == "M3u8" || Stream_Type_value == "Dash") {
                document.getElementById("drm_uuid_div").hidden = false; 
                document.getElementById("drm_license_uri_div").hidden = false;
            }

            var Stream_Type = document.getElementById('Stream_Type');
            Stream_Type.addEventListener('change', function () {
                if (this.value == "M3u8" || this.value == "Dash") {
                    document.getElementById("drm_uuid_div").hidden = false;
                } else {
                    document.getElementById("drm_uuid_div").hidden = true;
                    document.getElementById("drm_license_uri_div").hidden = true;
                }
            }, false);

            var drm_uuid = document.getElementById('drm_uuid');
            drm_uuid.addEventListener('change', function () {
                if (this.value == "WIDEVINE" || this.value == "PLAYREADY" || this.value == "CLEARKEY") {
                    document.getElementById("drm_license_uri_div").hidden = false;
                } else {
                    document.getElementById("drm_license_uri_div").hidden = true;
                }
            }, false);

            $("#genres").select2({
                data: <?php echo $selectGenre; ?>
            });
        });
		
        function SET_Poster() {
            var Poster = document.getElementById("Poster_URL").value;
            $('#poster_image').attr('src', Poster);
        }

        function Save_Movie_Data() {
            var Name = document.getElementById("title").value;
            var Stream_Type = document.getElementById("Stream_Type").value;
            var Stream_Link = document.getElementById("Stream_Link").value;
            var POSTER = document.getElementById("poster_image").src;
			var user_agent = document.getElementById("user_agent").value;
            var referer = document.getElementById("referer").value;
            var cookie = document.getElementById("cookie").value;
            var GENRES = $('#genres').select2('data');

            var add_channel_genre = "";
                GENRES.forEach((element, index, array) => {
                    if(add_channel_genre == "") {
                        add_channel_genre = element.text;
                    } else {
                        add_channel_genre = add_channel_genre+","+element.text;
                    }
                });

			var stringifyHeaders = [];
			try {
                var headers = $('.headers').repeaterVal();
                headers.Headers.forEach(function (item, index) {
                    if(item.header != "") {
                        stringifyHeaders.push({ 'header': item.header});
                    }
                });
            }
            catch(err) {
                console.log(err);
            }
			
            if ($('#Featured').is(':checked')) {
                var Featured_Count = 1;
            } else {
                var Featured_Count = 0;
            }
    
            if ($('#Publish_toggle').is(':checked')) {
                var Publish_toggle_Count = 1;
            } else {
                var Publish_toggle_Count = 0;
            }
    
            var Free_Premium = document.getElementById("Free_Premium").value;
            if (Free_Premium == "Free") {
                var Free_Premium_Count = 0;
            } else if (Free_Premium == "Premium") {
                var Free_Premium_Count = 1;
            }

            var drm_uuid = document.getElementById('drm_uuid').value;
            var drm_license_uri = document.getElementById('drm_license_uri').value;
    
            var jsonObjects = {
                "name": Name,
                "Stream_Type": Stream_Type,
                "Stream_Link": Stream_Link,
                "type": Free_Premium_Count,
                "POSTER": POSTER,
                "genres": add_channel_genre,
                "Featured": Featured_Count,
                "status": Publish_toggle_Count,
				"user_agent": user_agent,
                "referer": referer,
                "cookie": cookie,
				"headers": JSON.stringify(stringifyHeaders),
                drm_uuid: drm_uuid,
                drm_license_uri: drm_license_uri
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/add_channel') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Channel Added Successfully!',
                            icon: 'success',
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
    </script>