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

            						<h4 class="font-size-18">Add Web Series</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Web Series</a></li>

            							<li class="breadcrumb-item active">Add Web Series</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->


                        <div class="row justify-content-center  pb-3">
                        	<div class="col-lg-6">
                                <select class="form-control form-select" id="contentSearchType">
                                    <option selected value="title">Search by Title</option>
                                    <option value="id">Search by ID</option>
                                </select>
<!--                        		<div class="alert alert-info bg-info text-white border-0" role="alert">-->
<!--                        			Import Contents From TMDB/IMDB-->
<!--                        		</div>-->
                        	</div>
                        </div>
                        <div class="row justify-content-center searchByTitle">
                            <div class="col-lg-6">
                                <div class="input-group flex-nowrap" data-target-input="nearest">
                                    <div class="input-group-text"><i class="fa fa-search"></i></div>

                                    <select class="form-control" id="content_title" type="text"
                                            placeholder="Search for a web series" value="" id="example-text-input"></select>

                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <h6>
                                        <p> Get Content Title from here: <a href="https://www.themoviedb.org/tv/"
                                                                              target="_blank">TheMovieDB.org</a> or <a href="https://www.imdb.com/"
                                                                                                                       target="_blank">Imdb.com</a> </p>
                                    </h6>
                                </div>

                            </div>
                        </div>
                        <div class="row justify-content-center searchByID" style="display: none;">
                            <div class="col-lg-1">
                                <select class="form-control form-select" id="contentDataSourceType">
                                    <option selected>TMDB</option>
                                    <option>IMDB</option>
                                </select>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group" data-target-input="nearest">
                                    <div class="input-group-text"><i class="fa fa-hashtag"></i></div>

                                    <input class="form-control" id="imdb_id" type="text"
                                           placeholder="Enter TMDB ID. Ex: 101010" value="" id="example-text-input">

                                    <button type="submit" onclick="Load_Movie_Data()" id="import_btn"
                                            class="btn btn-primary waves-effect waves-light"> Fetch </button>

                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <h6>
                                        <p> Get IMDB or IMDB ID from here: <a href="https://www.themoviedb.org/tv/"
                                                                              target="_blank">TheMovieDB.org</a> or <a href="https://www.imdb.com/"
                                                                                                                       target="_blank">Imdb.com</a> </p>
                                    </h6>
                                </div>

                            </div>
                        </div>

                        <div class="row justify-content-center">
                        	<div class="col-lg-6">
                        		<div id="result" class="m-t-15"></div>
                        	</div>

                        </div>


                        <br>

                        <div class="form" action="" method="post">
                        	<div class="row">
                        		<div class="col-md-6">
                        			<div class="card card-body">
                        				<h3 class="card-title mt-0">Web Series Info</h3>
                        				<hr>

                                        <input type="hidden" id="contentID" name="contentID" value="0">

                        				<div class="form-group mb-3">
                        					<label>Title</label>
                        					<input class="form-control" type="text" value="" id="title">
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Description</label>
                        					<div class="summernote" id="description"></div>
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
                        							class="form-control datetimepicker-input"
                        							data-target="#release_date" placeholder="YYYY-MM-DD" />
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        					</div>
                        				</div>

                        				<div class="mb-3">
                							<label>Trailer URL(YouTube Only)</label>
											<div class="input-group date" data-target-input="nearest">
											    <input class="form-control" type="text" value=""
                								    id="trailler_youtube_source">
                                                <div class="input-group-text"><i class="fa fa-play"></i></div>
                							</div>
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
                        							width="150" src="assets/images/dooo_thumbnail_placeholder.png"
                        							data-holder-rendered="true">
                        					</div>

                                            <div class="row justify-content-center">
                								<div class="col-lg-10">
                									<div class="input-group" data-target-input="nearest">

                                                    <input class="form-control" id="Thumbnail_URL" type="text"
                        								placeholder="Image URL (Best Fit = 500 x 750)" value=""
                        								id="example-text-input">

                										<button type="submit" onclick="SET_Thumbnail()" id="import_btn"
                        									class="btn btn-primary waves-effect waves-light"> SET
                        								</button>
                									</div>
                								</div>
											</div>
                        				</div>

                        				<div class="form-group mb-3">
                        					<label>Poster</label>
                        					<div class="row justify-content-center mb-3">
                        						<img class="img-fluid" id="poster_image"
                        							style="padding: 0.20rem; background-color: #FFF; border: 1px solid #dee2e6; border-radius: 0.25rem; max-width: 350px; height: auto;"
                        							width="350" src="assets/images/Dooo_poster_placeholder.png"
                        							data-holder-rendered="true">
                        					</div>

                                            <div class="row justify-content-center">
                								<div class="col-lg-10">
                									<div class="input-group" data-target-input="nearest">

                                                    <input class="form-control" id="Poster_URL" type="text"
                        								placeholder="Image URL (Best Fit = 2048 x 1152)" value=""
                        								id="example-text-input">

                										<button type="submit" onclick="SET_Poster()" id="import_btn"
                        									class="btn btn-primary waves-effect waves-light"> SET
                        								</button>
                									</div>
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
        var code = "<?php echo $config->license_code; ?>";
        if("<?php echo $config->tmdb_language; ?>" == "") {
            var tmdb_language = "en-US";
        } else {
            var tmdb_language = "<?php echo $config->tmdb_language; ?>";
        }
       

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });

            $('#release_date').datetimepicker({
                format: 'yyyy-MM-DD',
                allowInputToggle: true,
                todayHighlight: true
            });

            $("#genres").select2({
                data: <?php echo $selectGenre; ?>
            });

            $("#content_networks").select2({
                data: <?php echo $selectContentNetworks; ?>
            });

            $.each(<?php echo $customTags; ?>,function(index,itemData){
                $('#custom_tag').append($('<option/>', {
                    value: itemData.id,
                    text : itemData.text
                }));
            });

            $('#contentSearchType').on('change', function() {
                if(this.value == "title") {
                    $('.searchByTitle').show();
                    $('.searchByID').hide();
                } else if(this.value == "id") {
                    $('.searchByTitle').hide();
                    $('.searchByID').show();
                }
            });

            $("#content_title").select2({
                ajax: {
                    url: "https://cloud.team-dooo.com/Dooo/TMDB/index.php",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            query: params.term,
                            code: "<?php echo $config->license_code; ?>",
                            filter: "search",
                            type: "tv",
                            language: tmdb_language
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a web series',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo (repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    `<div class='row'>
                            <div class='col-md-2'>
                                <img class='img-fluid' height='100' width='80' src='https://www.themoviedb.org/t/p/original` + repo.poster_path + `' />
                            </div>
                            <div class='col-md-10'>
                                <div class='title'></div>
                                <div class='release_date'></div>
                                <div class='overview'></div>
                            </div>
                        </div>`
                );

                $container.find(".title").text(repo.name);
                $container.find(".release_date").text(repo.first_air_date);
                $container.find(".overview").text(repo.overview.substring(0,150)+"...");
                return $container;
            }

            function formatRepoSelection (repo) {
                initWebSeriesData(repo.id, false);
                return repo.name || repo.text;
            }
        });

        function SET_Thumbnail() {
            var Thumbnail_URL = document.getElementById("Thumbnail_URL").value;
            $('#thumb_image').attr('src', Thumbnail_URL);
        }

        function SET_Poster() {
            var Poster = document.getElementById("Poster_URL").value;
            $('#poster_image').attr('src', Poster);
        }

        function Load_Movie_Data() {
            var contentDataSourceType = document.getElementById("contentDataSourceType").value;
            if(contentDataSourceType == "TMDB") {
                var IMDB_ID = document.getElementById("imdb_id").value;
                initWebSeriesData(IMDB_ID);
            } else if(contentDataSourceType == "IMDB") {
                var TMDB_ID = document.getElementById("imdb_id").value;
                $.ajax({
                    type: 'GET',
                    url: "https://cloud.team-dooo.com/Dooo/TMDB/?code="+"<?php echo $config->license_code; ?>"+"&filter=find&id="+TMDB_ID,
                    dataType: 'json',
                    success: function (response20) {
                       if(response20 != false) {
                            var IMDB_ID = response20.tv_results[0].id;
                            initWebSeriesData(IMDB_ID);
                        }
                    }
                });
            }
        }

        function initWebSeriesData(IMDB_ID, noAlert=false) {
            $("#contentID").val(IMDB_ID);
            if (IMDB_ID != '') {
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
                    type: 'GET',
                    url: "https://cloud.team-dooo.com/Dooo/TMDB/?code="+ code +"&filter=single&type=tv&id=" + IMDB_ID +"&id_type=TMDB&language=" + tmdb_language+"&image_storage_provider="+"<?php echo $config->image_storage_provider; ?>"+"&key="+"<?php echo $config->imgbb_api_key; ?>",
                    dataType: 'json',
                    beforeSend: function () {
                        $("#import_btn").html('Fetching...');
                    },
                    success: function (response) {
                        if(response != false) {
                            var TMDB_ID = response.id;
                            var NAME = response.name;
                            var DESCRIPTION = response.overview;
                            var GENRES = response.genres;
                            var RELEASE_DATE = response.first_air_date;
    
                            var THUMBNAIL = response.poster_path;
                            var Poster = response.backdrop_path;
    
                            if (!TMDB_ID == "") {
                                $("#title").val(NAME);
                                $('#description').summernote('editor.insertText', DESCRIPTION);
                                $('#release_date').data("datetimepicker").date(new Date(RELEASE_DATE));

                                if (THUMBNAIL.includes("https")) {
                                    $('#thumb_image').attr('src', THUMBNAIL);
                                } else {
                                    $('#thumb_image').attr('src', "https://www.themoviedb.org/t/p/original" +
                                        THUMBNAIL);
                                }
                                if (Poster.includes("https")) {
                                    $('#poster_image').attr('src', Poster);
                                } else {
                                    $('#poster_image').attr('src', "https://www.themoviedb.org/t/p/original" +
                                        Poster);
                                }
    
                                var GENRES_json_obj = "";
                                for (var GENRE_Json_Content of GENRES) {
                                    if (GENRES_json_obj == "") {
                                        GENRES_json_obj = GENRE_Json_Content.name + ", ";
                                    } else {
                                        GENRES_json_obj = GENRES_json_obj + GENRE_Json_Content.name + ", ";
                                    }
                                }
                                var GENRE_list = GENRES_json_obj.slice(0, -2);
    
                                var jsonObjects3 = {
                                    "GenreList": GENRE_list
                                };
                                $.ajax({
                                    type: 'POST',
                                    url: '<?= site_url('Admin_api/initiateGenres') ?>',
                                    data: jsonObjects3,
                                    dataType: 'json',
                                    success: function (response3) {
                                        if(response3 != "") {
                                            $("#genres").select2({
                                                data: response3
                                            })
                                            var genre_arr = [];
                                            response3.forEach((element, index, array) => {
                                                genre_arr.push(element.id);
                                            });
                                            $("#genres").val(genre_arr).trigger("change");
                                        }
                                    }
                                });
    
                                $.ajax({
                                    type: 'GET',
                                    url: "https://cloud.team-dooo.com/Dooo/TMDB/video.php?id="+IMDB_ID+"&type=tv&code="+"<?php echo $config->license_code; ?>",
                                    dataType: 'json',
                                    success: function (response2) {
                                        var Video_Data_Json = response2.results;
                                        for (var Video_Json_Content of Video_Data_Json) {
                                            if (Video_Json_Content.type == "Trailer") {
                                                if (Video_Json_Content.site == "YouTube") {
                                                    var trailler_youtube_source =
                                                        "https://www.youtube.com/watch?v=" +
                                                        Video_Json_Content.key;
                                                    $("#trailler_youtube_source").val(
                                                        trailler_youtube_source);
                                                }
                                            }
                                        }
    
                                    }
    
                                });
    
    
                                $('#result').html(
                                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>Data <strong>imported</strong> successfully.</div>'
                                );
                                $('#import_btn').html('Fetch');
                            }
                        } else {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>No data found in <strong>database</strong>.</div>'
                            );
                            $('#import_btn').html('Fetch');
                        }
                        Swal.close();
                    },
                    error: function (jq, status, message) {
                        $('#result').html(
                                '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>No data found in <strong>database</strong>.</div>'
                            );
                            $('#import_btn').html('Fetch');
							Swal.close();
                    }
                });

            } else {
                if(noAlert) {
                    alert('Please input TMDB ID');
                }
            }
        }

		function Save_Movie_Data() {
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


            if (document.getElementById("contentID").value == "0") {
                var contentID = 0;
            } else {
                var contentID = document.getElementById("contentID").value;
            }
            var Name = document.getElementById("title").value;
            var DESCRIPTION = jQuery($(".summernote").summernote("code")).text();
            var GENRES = $('#genres').select2('data');
            var RELEASE_DATE = document.getElementById("release_date").value;
            var THUMBNAIL = document.getElementById("thumb_image").src;
            var POSTER = document.getElementById("poster_image").src;
            var trailler_youtube_source = document.getElementById("trailler_youtube_source").value;
            var Free_Premium = document.getElementById("Free_Premium").value;
            if (Free_Premium == "Default") {
                var Free_Premium_Count = 0;

            } else if (Free_Premium == "Free") {
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
                "TMDB_ID": contentID,
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
                url: '<?= site_url('Admin_api/add_web_series') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    Swal.close();
                    if (response != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'WebSeries Added Successfully!',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#556ee6',
                            cancelButtonColor: "#f46a6a"
                        }).then(function () {
                            window.location.assign("<?php echo base_url(); ?>manage_seasons/" + response);
                        });
                    }
                }
            });
        }
    </script>