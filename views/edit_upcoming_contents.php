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

                					<h4 class="font-size-18">Upcoming Contents</h4>

                					<ol class="breadcrumb mb-0">

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                						<li class="breadcrumb-item"><a href="javascript: void(0);">Special</a></li>

                						<li class="breadcrumb-item active">Edit Upcoming Contents</li>

                					</ol>

                				</div>

                			</div>

                		</div>

                		<!-- end page title -->

                		<div class="form">
                			<div class="row">
                				<div class="col-lg-6">
                					<div class="card card-body">
                						<h3 class="card-title mt-0">Content Info</h3>
                						<hr>

                						<div class="mb-3">
                							<label>Title</label>
                							<input class="form-control" type="text" value="<?php echo $UpcomingContentData->name; ?>" id="title">
                						</div>

                						<div class="mb-3">
                							<label>Description</label>
                							<div class="summernote" id="description"><?php echo $UpcomingContentData->description; ?></div>
                						</div>

                						<div class="mb-3">
                							<label>Release Date</label>
                							<div class="input-group date" data-target-input="nearest">
                								<input type="text" id="release_date"
                									class="form-control datetimepicker-input"
                									data-target="#release_date" placeholder="YYYY-MM-DD"
                                                    value="<?php echo $UpcomingContentData->release_date; ?>"/>
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                							</div>
                						</div>

                						<div class="mb-3">
                							<label>Trailer URL(YouTube Only)</label>
											<div class="input-group date" data-target-input="nearest">
											    <input class="form-control" type="text" value="<?php echo $UpcomingContentData->trailer_url; ?>"
                								    id="trailler_youtube_source">
                                                <div class="input-group-text"><i class="fa fa-play"></i></div>
                							</div>
                						</div>
                					</div>
                				</div>
                				<div class="col-lg-6">
                					<div class="card card-body">
                						<h3 class="card-title mt-0">Additional Info</h3>
                						<hr>

                						<div class="mb-3">
                							<label>Thumbnail</label>
                							<div class="row justify-content-center">
                								<img class="img-fluid" id="thumb_image"
                									style="padding: 0.20rem; background-color: #FFF; border: 1px solid #dee2e6; border-radius: 0.25rem; max-width: 150px; height: auto;"
                									width="150" src="<?php echo $UpcomingContentData->poster; ?>"
                									data-holder-rendered="true">
                							</div>
                							<br>
                							<div class="row justify-content-center">
                								<div class="col-lg-10">
                									<div class="input-group" data-target-input="nearest">

                										<input class="form-control" id="Thumbnail_URL" type="text"
                											placeholder="Image URL (Best Fit = 500 x 750)" value="" id="example-text-input">

                										<button type="submit" onclick="SET_Thumbnail()" id="import_btn"
                											class="btn btn-primary waves-effect waves-light"> SET
                										</button>
                									</div>
                								</div>
											</div>
                						</div>

                                        <div class="mb-3">
                							<label>Content Type</label>
                							<select class="form-control form-select" id="content_type">
                								<option value="1">Movie</option>
                								<option value="2">Webseries</option>
                							</select>
                						</div>

                						<div class="mb-3">
                							<label>Publish</label>
                							<div>
                								<input type="checkbox" id="Publish_toggle" switch="bool" checked />
                								<label for="Publish_toggle" data-on-label="" data-off-label=""></label>
                							</div>
                						</div>

                						<div class="mb-3">
                							<div class="col-md-12 row justify-content-end">
                								<button class="btn btn-primary waves-effect waves-light col-md-4"
                									id="create_btn" type="submit" onclick="UpdateUpcommingContent()">
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
                height: 230
            });

            $('#release_date').datetimepicker({
                format: 'yyyy-MM-DD',
                allowInputToggle: true,
                todayHighlight: true
            });

            $("#content_type").val(<?php echo $UpcomingContentData->type; ?>);

            var status = <?php echo $UpcomingContentData->status; ?>;
            if (status == "0") {
                $('#Publish_toggle').attr('checked', false);
            } else if (status == "1") {
                $('#Publish_toggle').attr('checked', true);
            }
        });

        function SET_Thumbnail() {
            var Thumbnail_URL = document.getElementById("Thumbnail_URL").value;
            $('#thumb_image').attr('src', Thumbnail_URL);
        }

        function UpdateUpcommingContent() {
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


			var Name = document.getElementById("title").value;
            var DESCRIPTION = $(".summernote").summernote("code");
			var RELEASE_DATE = document.getElementById('release_date').value;
			var THUMBNAIL = document.getElementById("thumb_image").src;
			var trailler_youtube_source = document.getElementById("trailler_youtube_source").value;
			var content_type = document.getElementById("content_type").value;
			if ($('#Publish_toggle').is(':checked')) {
                    var Publish_toggle_Count = 1;
                } else {
                    var Publish_toggle_Count = 0;
                }


                var jsonObjects = {
                    "ID": <?php echo $UpcomingContentID; ?>,
                    "name": Name,
                    "description": DESCRIPTION,
                    "release_date": RELEASE_DATE,
                    "poster": THUMBNAIL,
                    "youtube_trailer": trailler_youtube_source,
                    "content_type": content_type,
                    "status": Publish_toggle_Count
                };
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Admin_api/UpdateUpcommingContent') ?>',
                    data: jsonObjects,
                    dataType: 'text',
                    success: function (response) {
						Swal.close();
                        if (response != "") {
                            swal.fire({
                                title: 'Successful!',
                                text: 'Upcoming Content Updated Successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
        }

        </script>

