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

            						<h4 class="font-size-18">Edit Web Series</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Web Series</a></li>

            							<li class="breadcrumb-item active">Edit Web Series</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->

                        <div class="form" action="" method="post">
                        	<div class="row">
                        		<div class="col-md-6">
                        			<div class="card card-body">
                        				<h3 class="card-title mt-0">WebSeries Info</h3>
                        				<hr>

                        				<div class="form-group mb-3">
                        					<label>Title</label>
                        					<input class="form-control" type="text" value="<?php echo $webSeriesData->name; ?>" id="title">
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Description</label>
                        					<div class="summernote" id="description"><?php echo $webSeriesData->description; ?></div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Genres</label>
                        					<!--<input class="form-control" type="text" value="" id="genres">-->
                        					<select class="select2 form-control select2-multiple" id="genres"
                        						multiple="multiple" multiple data-placeholder="Choose ..."></select>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Release Date</label>
                        					<div class="input-group date" data-target-input="nearest">
                        						<input type="text" id="release_date"
                        							class="form-control datetimepicker-input" value="<?php echo $webSeriesData->release_date; ?>"
                        							data-target="#release_date" placeholder="YYYY-MM-DD" />
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        					</div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Trailer URL(YouTube Only)</label>
                        					<input class="form-control" type="text" value="<?php echo $webSeriesData->youtube_trailer; ?>"
                        						id="trailler_youtube_source">
                        				</div>

                                        <div class="mb-3">
                							<label>Content Networks</label>
                							<select class="select2 form-control select2-multiple" id="content_networks"
                								multiple="multiple" multiple data-placeholder="Choose ..."></select>
                						</div>

                                        <div class="mb-3">
                                            <label>Custom Tag</label>
                                            <select class="form-control form-select" id="custom_tag">
                                                <option value="0" selected>None</option>
                                            </select>
                                        </div>
                        			</div>
                        		</div>
                        		<div class="col-md-6">
                        			<div class="card card-body">
                        				<h3 class="card-title mt-0">Additional Info</h3>
                        				<hr>

                        				<div class="form-group mb-3">
                        					<label>Thumbnail</label>
                        					<div class="row justify-content-center mb-3">
                        						<img class="img-fluid" id="thumb_image"
                        							style="padding: 0.20rem; background-color: #FFF; border: 1px solid #dee2e6; border-radius: 0.25rem; max-width: 150px; height: auto;"
                        							width="150" src="<?php echo $webSeriesData->poster; ?>"
                        							data-holder-rendered="true">
                        					</div>

                        					<div class="row justify-content-center">
                        						<div class="col-lg-10">
                        							<input class="form-control" id="Thumbnail_URL" type="text"
                        								placeholder="Image URL (Best Fit = 500 x 750)" value="<?php echo $webSeriesData->poster; ?>"
                        								id="example-text-input">
                        						</div>

                        						<div class="col-lg-1">
                        							<span class="input-group-btn">
                        								<button type="submit" onclick="SET_Thumbnail()" id="import_btn"
                        									class="btn btn-primary waves-effect waves-light"> SET
                        								</button>
                        							</span>

                        						</div>

                        					</div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Poster</label>
                        					<div class="row justify-content-center mb-3">
                        						<img class="img-fluid" id="poster_image"
                        							style="padding: 0.20rem; background-color: #FFF; border: 1px solid #dee2e6; border-radius: 0.25rem; max-width: 350px; height: auto;"
                        							width="350" src="<?php echo $webSeriesData->banner; ?>"
                        							data-holder-rendered="true">
                        					</div>

                        					<div class="row justify-content-center">
                        						<div class="col-lg-10">
                        							<input class="form-control" id="Poster_URL" type="text"
                        								placeholder="Image URL (Best Fit = 2048 x 1152)" value="<?php echo $webSeriesData->banner; ?>"
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
                        					<label>Free/Premium</label>
                        					<select class="form-control form-select" id="Free_Premium">
                        						<option>Default</option>
                        						<option>Free</option>
                        						<option>Premium</option>
                        					</select>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Enable Download</label>
                        					<div>
                        						<input type="checkbox" id="Enable_Download" switch="bool" checked />
                        						<label for="Enable_Download" data-on-label="" data-off-label=""></label>
                        					</div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Publish</label>
                        					<div>
                        						<input type="checkbox" id="Publish_toggle" switch="bool" checked />
                        						<label for="Publish_toggle" data-on-label="" data-off-label=""></label>
                        					</div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<div class="col-md-12 row justify-content-end">
                        						<button class="btn btn-primary dropdown-toggle waves-effect waves-light col-md-4"
                        							onclick="Save_WebSeries_Data(<?php echo($WebSeriesID) ?>)"
                        							id="create_btn" type="submit" aria-haspopup="true"
                        							aria-expanded="false">
                        							<i class="fas fa-redo mr-2"></i> Update
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
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });
    
            $(function () {
                $('#release_date').datetimepicker({
                    format: 'yyyy-MM-DD',
                    allowInputToggle: true,
                    todayHighlight: true
                });
            });
    
            $("#genres").select2({
                data: <?php echo $selectGenre; ?>
            });

            var type = <?php echo $webSeriesData->type; ?>;
            if (type == "0") {
                $("#Free_Premium").val("Default");
            } else if (type == "1") {
                $("#Free_Premium").val("Free");
            } else if (type == "2") {
                $("#Free_Premium").val("Premium");
            }

            var downloadable = <?php echo $webSeriesData->downloadable; ?>;
            if (downloadable == "0") {
                $('#Enable_Download').attr('checked', false);
            } else if (downloadable == "1") {
                $('#Enable_Download').attr('checked', true);
            }

            var status = <?php echo $webSeriesData->status; ?>;
            if (status == "0") {
                $('#Publish_toggle').attr('checked', false);
            } else if (status == "1") {
                $('#Publish_toggle').attr('checked', true);
            }

            var genres = '<?php echo $webSeriesData->genres; ?>';
			var jsonObjects3 = {
                "GenreList": genres
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/initiateGenres') ?>',
                data: jsonObjects3,
                dataType: 'json',
                success: function (response3) {
                    if(response3 != "") {
                        var genre_arr = [];
                        response3.forEach((element, index, array) => {
                            genre_arr.push(element.id);
                        });
                        $("#genres").val(genre_arr).trigger("change");
                    }
                }
            });

            $("#content_networks").select2({
                data: <?php echo $selectContentNetworks; ?>
            });
            var networksRelatedToContent =<?php echo json_encode($networksRelatedToContent );?>;
            var networksRelatedToContent_arr = [];
            networksRelatedToContent.forEach((element, index, array) => {
                networksRelatedToContent_arr.push(element.network_id);
            });
            $("#content_networks").val(networksRelatedToContent_arr).trigger("change");

            $.each(<?php echo $customTags; ?>,function(index,itemData){
                $('#custom_tag').append($('<option/>', {
                    value: itemData.id,
                    text : itemData.text
                }));
            });
            $("#custom_tag").val("<?php echo $selectedCustomTags; ?>");
        });

        function SET_Thumbnail() {
            var Thumbnail_URL = document.getElementById("Thumbnail_URL").value;
            $('#thumb_image').attr('src', Thumbnail_URL);
        }

        function SET_Poster() {
            var Poster = document.getElementById("Poster_URL").value;
            $('#poster_image').attr('src', Poster);
        }

        function Save_WebSeries_Data(ID) {
            var Name = document.getElementById("title").value;
            var DESCRIPTION = $(".summernote").summernote("code");
            var GENRES = $('#genres').select2('data');
            var RELEASE_DATE = document.getElementById("release_date").value;
            var THUMBNAIL = document.getElementById("thumb_image").src;
            var POSTER = document.getElementById("poster_image").src;
            var trailler_youtube_source = document.getElementById("trailler_youtube_source").value;
            var Free_Premium = document.getElementById("Free_Premium").value;
            
            if (Free_Premium == "Default") {
                var Free_Premium_Count = 0;

            }else if (Free_Premium == "Free") {
                var Free_Premium_Count = 1;

            } else if (Free_Premium == "Premium") {
                var Free_Premium_Count = 2;
            }

            if ($('#Enable_Download').is(':checked')) {
                var Enable_Download_Count = 1;
            } else {
                var Enable_Download_Count = 0;
            }

            if ($('#Publish_toggle').is(':checked')) {
                var Publish_toggle_Count = 1;
            } else {
                var Publish_toggle_Count = 0;
            }

            var add_WebSeries_genre = "";
            GENRES.forEach((element, index, array) => {
                if(add_WebSeries_genre == "") {
                    add_WebSeries_genre = element.text;
                } else {
                    add_WebSeries_genre = add_WebSeries_genre+","+element.text;
                }
            });

            var content_networks = $('#content_networks').select2('data');
            var add_Series_content_networks = "";
            content_networks.forEach((element, index, array) => {
                if(add_Series_content_networks == "") {
                    add_Series_content_networks = element.id;
                } else {
                    add_Series_content_networks = add_Series_content_networks+","+element.id;
                }
            });

            var custom_tag = document.getElementById("custom_tag").value;

            var jsonObjects = {
                "WebSeriesID": ID,
                "name": Name,
                "description": DESCRIPTION,
                "genres": add_WebSeries_genre,
                "release_date": RELEASE_DATE,
                "poster": THUMBNAIL,
                "banner": POSTER,
                "youtube_trailer": trailler_youtube_source,
                "downloadable": Enable_Download_Count,
                "type": Free_Premium_Count,
                "status": Publish_toggle_Count,
                "content_networks": add_Series_content_networks,
                "custom_tag": custom_tag,
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/Update_web_series') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response) {
                        swal.fire({
                            title: 'Successful!',
                            text: 'WebSeries Updated Successfully!',
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

       
    </script>