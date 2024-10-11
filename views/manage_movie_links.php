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

            						<h4 class="font-size-18">Manage Movie Links</h4>

            						<ol class="breadcrumb mb-0">

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

            							<li class="breadcrumb-item"><a href="javascript: void(0);">Movies</a></li>

            							<li class="breadcrumb-item active">Manage Movie Links</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Manage Links</h4>
                                        <p class="card-title-desc">Add & Modify as you need</p>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-custom mb-3" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#streamlinks" role="tab" aria-selected="true" tabindex="0">
                                                    <span class="d-none d-md-block">Stream Links</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" data-bs-toggle="tab" href="#downloadlinks" role="tab" aria-selected="false" tabindex="1">
                                                    <span class="d-none d-md-block">Download Links</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content" id="setting_tabs">

											<div class="tab-pane p-3 active show" id="streamlinks" role="tabpanel">
											    <div class="panel-heading mb-3">
											        
											        <div class="row align-items-center">
											            <div class="col-md-8">
                                                             <h3 class="panel-title">Video List (<?php echo $movieData->name; ?>)</h3>
											            </div>
											            <div class="col-md-4">
											                <div class="float-end d-none d-md-block">
											                    <button class="btn btn-primary" type="button" id="button"
                                                                   data-bs-toggle="modal" data-bs-target="#Movie_Stream_Link_Add_Modal">
											                        <i class="fa fa-plus"></i> Add Stream Link
											                    </button>
											                </div>
											            </div>
											        </div>
											    </div>
											    <div>

											        <table id="datatable" class="table table-striped"
											            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

											            <thead>

											                <tr>

											                    <th>#</th>

											                    <th>Action</th>

											                    <th>Source</th>

											                    <th>Order</th>

											                    <th>Label</th>

											                    <th>Quality</th>

											                    <th>Size</th>

											                    <th>Url</th>

											                    <th>Status</th>

											                    <th>Type</th>

											                </tr>

											            </thead>





											            <tbody>
											                <?php
                                                $int_table_id = 1;
                                                foreach ($moviePlayLinks as $row) {
                                                   ?>
											                <tr>
											                    <th><?php echo($int_table_id); ?></th>

											                    <td>

											                        <div class="btn-group mr-1 mt-2">
											                            <?php $Row_ID = $row->id; ?>

											                            <button type="button" class="btn btn-secondary dropdown-toggle"
											                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options
											                                <i class="mdi mdi-chevron-down"></i></button>

											                            <div class="dropdown-menu">

											                                <a class="dropdown-item" onclick="Load_Link_Data(<?php echo($Row_ID); ?>)"
											                                    data-bs-toggle="modal" data-bs-target="#Movie_Link_Edit_Modal">Edit
											                                    Link</a>

											                                <a class="dropdown-item" id="Delete"
											                                    href="<?= site_url('subtitle_manager') ?>/<?php echo($Row_ID); ?>/1">Manage
											                                    Subtitle</a>

											                                <a class="dropdown-item" id="Delete"
											                                    onclick="Delete_StreamLink(<?php echo($Row_ID); ?>)">Delete</a>

											                            </div>

											                        </div>

											                    </td>

											                    <td><?php echo stripslashes($row->type); ?></td>
											                    <td><?php echo stripslashes($row->link_order); ?></td>
											                    <td><?php echo stripslashes($row->name); ?></td>
											                    <td><?php echo stripslashes($row->quality); ?></td>
											                    <td><?php echo stripslashes($row->size); ?></td>
											                    <td><?php echo wordwrap($row->url,60,"<br>\n",TRUE); ?></td>

											                    <?php
                                                    if($row->status == 0) {
                                                        ?>
											                    <td><span class="badge bg-danger">UnPublished</span></td>
											                    <?php
                                                    }
                                                    if($row->status == 1) {
                                                        ?>
											                    <td><span class="badge bg-success">Published</span></td>
											                    <?php
                                                    }

                                                    ?>

											                    <?php
                                                    if($row->link_type == 0) {
                                                        ?>
											                    <td><span>Free</span></td>
											                    <?php
                                                    }
                                                    if($row->link_type == 1) {
                                                        ?>
											                    <td><span>Premium</span></td>
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

											<div class="tab-pane p-3" id="downloadlinks" role="tabpanel">
                                                <div class="panel-heading mb-3">
											        
											        <div class="row align-items-center">
											            <div class="col-md-8">
                                                            <h3 class="panel-title">Download Link List (<?php echo $movieData->name; ?>)</h3>
											            </div>
											            <div class="col-md-4">
											                <div class="float-end d-none d-md-block">
											                    <button class="btn btn-primary" type="button" id="button"
                                                                   data-bs-toggle="modal" data-bs-target="#Movie_Download_Link_Add_Modal">
											                        <i class="fa fa-plus"></i> Add Download Link
											                    </button>
											                </div>
											            </div>
											        </div>
											    </div>
											    <div>

											        <table id="datatable_download_links" class="table table-striped"
											            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

											            <thead>

											                <tr>

											                    <th>#</th>

											                    <th>Action</th>

											                    <th>Source</th>

											                    <th>Order</th>

											                    <th>Name</th>

											                    <th>Quality</th>

											                    <th>Size</th>

											                    <th>Url</th>

											                    <th>Type</th>

											                    <th>Status</th>

											                </tr>

											            </thead>





											            <tbody>
											                <?php
                                                    $int_table_id = 1;
                                                    foreach ($movieDownloadLinks as $row) {
                                                        ?>
											                <tr>
											                    <th><?php echo($int_table_id); ?></th>

											                    <td>

											                        <div class="btn-group mr-1 mt-2">
											                            <?php $Row_ID = $row->id; ?>

											                            <button type="button" class="btn btn-secondary dropdown-toggle"
											                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options
											                                <i class="mdi mdi-chevron-down"></i></button>

											                            <div class="dropdown-menu" style="">

											                                <a class="dropdown-item" onclick="Load_download_Link_Data(<?php echo($Row_ID); ?>)"
											                                    data-bs-toggle="modal" data-bs-target="#Movie_Download_Link_Edit_Modal">Edit
											                                    Link</a>

											                                <a class="dropdown-item" id="Delete"
											                                    onclick="Delete_DownloadLink(<?php echo($Row_ID); ?>)">Delete</a>

											                            </div>

											                        </div>

											                    </td>

											                    <td><?php echo stripslashes($row->type); ?></td>
											                    <td><?php echo stripslashes($row->link_order); ?></td>
											                    <td><?php echo stripslashes($row->name); ?></td>
											                    <td><?php echo stripslashes($row->quality); ?></td>
											                    <td><?php echo stripslashes($row->size); ?></td>
											                    <td><?php echo wordwrap($row->url,60,"<br>\n",TRUE); ?></td>
											                    <td><?php echo stripslashes($row->download_type); ?></td>

											                    <?php
                                                     if($row->status == 0) {
                                                         ?>
											                    <td><span class="badge bg-danger">UnPublished</span></td>
											                    <?php
                                                     }
                                                     if($row->status == 1) {
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
                                </div>
                            </div>

                        </div>

            		</div> <!-- container-fluid -->

            	</div>

				<!-- Edit Movie Link Modal -->
                <div class="modal fade" id="Movie_Link_Edit_Modal" tabindex="-1" role="dialog"
                	aria-labelledby="Movie_Link_Edit_Modal_Lebel" aria-hidden="true">
                	<div class="modal-dialog" role="document">
                		<div class="modal-content">
                			<div class="modal-header">
                				<h5 class="modal-title" id="Movie_Link_Edit_Modal_Lebel">Edit Stream Link</h5>
                				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                				</button>
                			</div>
                			<div class="modal-body">
                				<div class="panel-body">
                					<input type="hidden" id="modal_videos_id" name="modal_videos_id" value="000">
                					<div class="form-group"> <label
                							class="control-label">Label</label>&nbsp;&nbsp;<input id="modal_Label"
                							type="text" name="label" class="form-control" placeholder="Server#1"
                							required=""> </div>

                					<div class="form-group"> <label class="control-label">Order</label> <input
                							id="modal_Order" type="number" name="order" class="form-control"
                							placeholder="0 to 9999" required=""> </div>

                					<div class="form-group"> <label
                							class="control-label">Quality</label>&nbsp;&nbsp;<input id="modal_Quality"
                							type="text" name="label" class="form-control" placeholder="1080p"
                							required=""> </div>

                					<div class="form-group"> <label class="control-label">Size</label>&nbsp;&nbsp;<input
                							id="modal_Size" type="text" name="label" class="form-control"
                							placeholder="1.0GB" required=""> </div>

                					<div class="form-group"> <label class="control-label">Source</label> 
                                        <select id="editSource" class="form-control" name="source">
                                            <?php include("partials/source/stream_source.php"); ?>
                                        </select>
									</div>
                					<div class="form-group" id="url-input"> <label class="control-label">Url</label>
                						<input id="modal_Url" type="text" name="url" value="" class="form-control"
                							placeholder="https://server-1.com/movies/Avengers.mp4" required="">
                					</div>

                                    <div class="form-group mb-3" id="drm_uuid_div_modal" hidden>
                                        <label class="control-label">DRM</label>
                                        <select class="form-control" name="drm_uuid_modal" id="drm_uuid_modal">
                                            <option value="" selected="">NO DRM</option>
                                            <option value="WIDEVINE">WIDEVINE</option>
                                            <option value="PLAYREADY">PLAYREADY</option>
                                            <option value="CLEARKEY">CLEARKEY</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" id="drm_license_uri_div_modal" hidden>
                                        <label class="control-label">DRM License URI</label>
                                        <input id="drm_license_uri_modal" type="text" name="drm_license_uri_modal"
                                            class="form-control">
                                    </div>

                					<div class="form-group"> <label class="control-label">Status</label> <select
                							id="modal_Status" class="form-control" name="source">
                							<option value="Publish" selected="">Publish</option>
                							<option value="Unpublish">Unpublish</option>
                						</select> </div>

                					<div class="form-group"> <label class="control-label">Type</label> <select
                							id="modal_Type" class="form-control" name="type">
                							<option value="Free" selected="">Free</option>
                							<option value="Premium">Premium</option>
                						</select><br> </div>

                					<div class="form-group row">
                						<label class="control-label col-sm-4 ">Intro Skip Avaliable?</label>
                						<div class="col-sm-6">
                							<input type="checkbox" id="modal_skip_available" switch="bool">
                							<label for="modal_skip_available" data-on-label="Yes"
                								data-off-label="No"></label>
                						</div>
                					</div>

                					<div class="form-group"> <label class="control-label">Intro Start</label>
                						<div class="input-group date col-10" data-target-input="nearest">
                							<input type="text" id="modal_intro_start"
                								class="form-control datetimepicker-input"
                								data-target="#modal_intro_start" placeholder="HH:MM:SS" />
                							<div class="input-group-append" data-target="#modal_intro_start"
                								data-toggle="datetimepicker">
                								<div class="input-group-text"><i class="fas fa-clock"></i></div>
                							</div>
                						</div>
                					</div>

                					<div class="form-group"> <label class="control-label">Intro End</label>
                						<div class="input-group date col-10" data-target-input="nearest">
                							<input type="text" id="modal_intro_end"
                								class="form-control datetimepicker-input" data-target="#modal_intro_end"
                								placeholder="HH:MM:SS" />
                							<div class="input-group-append" data-target="#modal_intro_end"
                								data-toggle="datetimepicker">
                								<div class="input-group-text"><i class="fas fa-clock"></i></div>
                							</div>
                						</div>
                					</div>
                				</div>
                			</div>
                			<div class="modal-footer">
                				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                				<button type="button" onclick="Update_Link_Data()" class="btn btn-primary">Save
                					changes</button>
                			</div>
                		</div>
                	</div>
                </div>

                <!-- Edit Movie Download Link Modal -->
                <div class="modal fade" id="Movie_Download_Link_Edit_Modal" tabindex="-1" role="dialog"
                	aria-labelledby="Movie_Download_Link_Edit_Modal_Lebel" aria-hidden="true">
                	<div class="modal-dialog" role="document">
                		<div class="modal-content">
                			<div class="modal-header">
                				<h5 class="modal-title" id="Movie_Download_Link_Edit_Modal_Lebel">Edit Download Link</h5>
                				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                				</button>
                			</div>
                			<div class="modal-body">
                				<div class="panel-body">
                					<input type="hidden" id="modal_videos_id_download" name="modal_videos_id_download" value="000">
                					<div class="form-group mb-3"> <label class="control-label">Name</label>&nbsp;&nbsp;<input
                							id="modal_Label_download" type="text" name="label" class="form-control"
                							placeholder="Name#1" required=""> </div>

                					<div class="form-group mb-3"> <label class="control-label">Order</label> <input
                							id="modal_Order_download" type="number" name="order" class="form-control"
                							placeholder="0 to 9999" required=""> </div>

                					<div class="form-group mb-3"> <label
                							class="control-label">Quality</label>&nbsp;&nbsp;<input id="modal_Quality_download"
                							type="text" name="label" class="form-control" placeholder="1080p"
                							required=""> </div>

                					<div class="form-group mb-3"> <label class="control-label">Size</label>&nbsp;&nbsp;<input
                							id="modal_Size_download" type="text" name="label" class="form-control"
                							placeholder="1.0GB" required=""> </div>

                					<div class="form-group mb-3"> <label class="control-label">Source</label> 
                                        <select id="modal_Source_download" class="form-control" name="source">
                                            <?php include("partials/source/download_source.php"); ?>
                                        </select>
                                    </div>

                					<div class="form-group mb-3" id="url-input"> <label class="control-label">Url</label>
                						<input id="modal_url_download" type="text" name="url" value="" class="form-control"
                							placeholder="https://server-1.com/movies/Avengers.mp4" required="">
                					</div>

                					<div class="form-group mb-3"> <label class="control-label">Download type</label> <select
                							id="modal_download_type_download" class="form-control" name="modal_download_type"
                							id="selected-source">
                							<option value="Internal" selected="">Internal</option>
                							<option value="External">External</option>
                						</select></div>

                					<div class="form-group mb-3"> <label class="control-label">Status</label> <select
                							id="modal_Status_download" class="form-control" name="source">
                							<option value="Publish" selected="">Publish</option>
                							<option value="Unpublish">Unpublish</option>
                						</select><br> </div>
                				</div>
                			</div>
                			<div class="modal-footer">
                				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                				<button type="button" onclick="Update_download_Link_Data()" class="btn btn-primary">Save
                					changes</button>
                			</div>
                		</div>
                	</div>
                </div>


                <!-- Add Movie Stream Link Modal -->
                <div class="modal fade" id="Movie_Stream_Link_Add_Modal" tabindex="-1" role="dialog"
                	aria-labelledby="Movie_Stream_Link_Add_Modal_Lebel" aria-hidden="true">
                	<div class="modal-dialog" role="document">
                		<div class="modal-content">
                			<div class="modal-header">
                				<h5 class="modal-title" id="Movie_Stream_Link_Add_Modal_Lebel">Add Stream Link (<?php echo $movieData->name; ?>)</h5>
                				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                				</button>
                			</div>
                			<div class="modal-body">
                            <div class="panel-body">
                                <input type="hidden" name="videos_id" value="615">
                                <div class="form-group mb-3"> <label
                                        class="control-label">Label</label>&nbsp;&nbsp;<input id="Label" type="text"
                                        name="label" class="form-control" placeholder="Server#1" required=""> </div>

                                <div class="form-group mb-3"> <label class="control-label">Order</label> <input
                                        id="Order" type="number" name="order" class="form-control"
                                        placeholder="0 to 9999" required=""> </div>

                                <div class="form-group mb-3"> <label
                                        class="control-label">Quality</label>&nbsp;&nbsp;<input id="Quality" type="text"
                                        name="label" class="form-control" placeholder="1080p" required="">
                                </div>

                                <div class="form-group mb-3"> <label
                                        class="control-label">Size</label>&nbsp;&nbsp;<input id="Size" type="text"
                                        name="label" class="form-control" placeholder="1.0GB" required=""> </div>

                                <div class="form-group mb-3"> <label class="control-label">Source</label>
                                    <select id="addSource" class="form-control" name="source">
                                        <?php include("partials/source/stream_source.php"); ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="url-input"> <label class="control-label">Url</label>
                                    <input id="Url" type="text" name="url" id="url-input-field" value=""
                                        class="form-control" placeholder="https://server-1.com/movies/Avengers.mp4"
                                        required="">
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

                                <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                                        id="Status" class="form-control" name="source" id="selected-source">
                                        <option value="Publish" selected="">Publish</option>
                                        <option value="Unpublish">Unpublish</option>
                                    </select> </div>

                                <div class="form-group mb-3"> <label class="control-label">Type</label> <select
                                        id="Type" class="form-control" name="type">
                                        <option value="Free" selected="">Free</option>
                                        <option value="Premium">Premium</option>
                                    </select><br> </div>

                                <div class="form-group row mb-3">
                                    <label class="control-label col-sm-4 ">Intro Skip Avaliable?</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="skip_available" switch="bool">
                                        <label for="skip_available" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>

                                <div class="form-group col-12 mb-3"> <label class="control-label">Intro Start</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" id="intro_start" class="form-control datetimepicker-input"
                                            data-target="#intro_start" placeholder="HH:MM:SS" />
                                        <div class="input-group-text" data-target="#intro_start"
                                            data-toggle="datetimepicker">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 mb-3"> <label class="control-label">Intro End</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" id="intro_end" class="form-control datetimepicker-input"
                                            data-target="#intro_end" placeholder="HH:MM:SS" />
                                        <div class="input-group-text" data-target="#intro_end"
                                            data-toggle="datetimepicker">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                			<div class="modal-footer">
                				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                				<button type="button" onclick="add_movie_links()" class="btn btn-primary">Add</button>
                			</div>
                		</div>
                	</div>
                </div>

                <!-- Add Movie Download Link Modal -->
                <div class="modal fade" id="Movie_Download_Link_Add_Modal" tabindex="-1" role="dialog"
                	aria-labelledby="Movie_Download_Link_Add_Modal_Lebel" aria-hidden="true">
                	<div class="modal-dialog" role="document">
                		<div class="modal-content">
                			<div class="modal-header">
                				<h5 class="modal-title" id="Movie_Download_Link_Add_Modal_Lebel">Add Download Link (<?php echo $movieData->name; ?>)</h5>
                				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                				</button>
                			</div>
                			<div class="modal-body">
                			    <div class="panel-body">
                			        <input type="hidden" name="videos_id" value="615">
                			        <div class="form-group mb-3"> <label class="control-label">Name</label>&nbsp;&nbsp;<input
                			                id="Label_download" type="text" name="label" class="form-control"
                			                placeholder="Name#1" required=""> </div>

                			        <div class="form-group mb-3"> <label class="control-label">Order</label> <input
                			                id="Order_download" type="number" name="order" class="form-control"
                			                placeholder="0 to 9999" required=""> </div>

                			        <div class="form-group mb-3"> <label class="control-label">Quality</label>&nbsp;&nbsp;<input
                			                id="Quality_download" type="text" name="label" class="form-control"
                			                placeholder="1080p" required="">
                			        </div>

                			        <div class="form-group mb-3"> <label class="control-label">Size</label>&nbsp;&nbsp;<input
                			                id="Size_download" type="text" name="label" class="form-control" placeholder="1.0GB"
                			                required=""> </div>

                			        <div class="form-group mb-3"> <label class="control-label">Source</label>
                			            <select id="addSource_download" class="form-control" name="source">
                			                <?php include("partials/source/download_source.php"); ?>
                			            </select>
                			        </div>
                			        <div class="form-group mb-3" id="url-input"> <label class="control-label">Url</label>
                			            <input id="url_download" type="text" name="url_download" id="url-input-field" value=""
                			                class="form-control" placeholder="https://server-1.com/movies/Avengers.mp4"
                			                required="">
                			        </div>

                			        <div class="form-group mb-3"> <label class="control-label">Download type</label>
                			            <select id="download_type_download" class="form-control" name="source"
                			                id="selected-source">
                			                <option value="Internal" selected="">Internal</option>
                			                <option value="External">External</option>
                			            </select></div>

                			        <div class="form-group mb-3"> <label class="control-label">Status</label> <select
                			                id="Status_download" class="form-control" name="source" id="selected-source">
                			                <option value="Publish" selected="">Publish</option>
                			                <option value="Unpublish">Unpublish</option>
                			            </select> 
                                    </div>
                			    </div>
                			</div>
                			<div class="modal-footer">
                				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                				<button type="button" onclick="add_download_links()" class="btn btn-primary">Add</button>
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

        <!-- Stream Link -->
    <script>
        $(function () {
            $('.nav-tabs a[href="#' + localStorage.getItem("currentTabIndex") + '"]').tab('show');
			$('.nav-tabs > li > a').click( function() {
                localStorage.setItem("currentTabIndex", $(this).attr('href').slice(1));
            });


            $('#intro_start').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true,
    
            });
            $('#intro_end').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true
            });
            $('#modal_intro_start').datetimepicker({
                format: 'HH:mm:ss',
                allowInputToggle: true
            });
            $('#modal_intro_end').datetimepicker({
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

        function add_movie_links() {
            var Label = document.getElementById("Label").value;
            var Order = document.getElementById("Order").value;
            var Quality = document.getElementById("Quality").value;
            var Size = document.getElementById("Size").value;
            var Source = document.getElementById("addSource").value;
            var Url = document.getElementById("Url").value;
    
            var Status_Txt = document.getElementById("Status").value;
            if (Status_Txt == "Publish") {
                var Status = "1";
            } else if (Status_Txt == "Unpublish") {
                var Status = "0";
            }
    
            var Type_Txt = document.getElementById("Type").value;
            if (Type_Txt == "Premium") {
                var Type = "1";
            } else if (Type_Txt == "Free") {
                var Type = "0";
            }
    
            if ($('#skip_available').is(':checked')) {
                var skip_available_Count = 1;
            } else {
                var skip_available_Count = 0;
            }
            var intro_start = document.getElementById('intro_start').value;
            var intro_end = document.getElementById('intro_end').value;

            var drm_uuid = document.getElementById('drm_uuid').value;
            var drm_license_uri = document.getElementById('drm_license_uri').value;
    
            var jsonObjects = {
                Movie_id: <?php echo $movieID; ?>,
                Label: Label,
                Order: Order,
                Quality: Quality,
                Size: Size,
                Source: Source,
                Url: Url,
                Status: Status,
                skip_available_Count: skip_available_Count,
                intro_start: intro_start,
                intro_end: intro_end,
                link_type: Type,
				end_credits_marker: '0',
                drm_uuid: drm_uuid,
                drm_license_uri: drm_license_uri
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/add_movie_links') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Movie Link Added Successfully!',
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

		function Load_Link_Data(ID) {
            var jsonObjects = {
                movie_play_link_ID: ID
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/get_movie_link_details') ?>',
                data: jsonObjects,
                dataType: 'json',
                success: function (response4) {
                    var id = response4.id;
                    var Label = response4.name;
                    var Order = response4.link_order;
                    var Quality = response4.quality;
                    var Size = response4.size;
                    var Source = response4.type;
                    var Url = response4.url;
                    var Status = response4.status;
                    var skip_available = response4.skip_available;
                    var intro_start = response4.intro_start;
                    var intro_end = response4.intro_end;
                    var link_type = response4.link_type;
                    var drm_uuid_modal = response4.drm_uuid;
                    var drm_license_uri_modal = response4.drm_license_uri;
    
                    if (!id == "") {
                        $("#modal_videos_id").val(id);
                        $("#modal_Label").val(Label);
                        $("#modal_Order").val(Order);
                        $("#modal_Quality").val(Quality);
                        $("#modal_Size").val(Size);
                        $("#editSource").val(Source);
                        $("#modal_Url").val(Url);
                        $("#drm_uuid_modal").val(drm_uuid_modal);
                        $("#drm_license_uri_modal").val(drm_license_uri_modal);

                        if(Source == "M3u8" || Source == "Dash") {
                            document.getElementById("drm_uuid_div_modal").hidden = false; 
                            document.getElementById("drm_license_uri_div_modal").hidden = false;
                        }
    
                        if (Status == "1") {
                            $("#modal_Status").val("Publish");
                        } else if (Status == "0") {
                            $("#modal_Status").val("Unpublish");
                        }
    
                        if (link_type == "1") {
                            $("#modal_Type").val("Premium");
                        } else if (link_type == "0") {
                            $("#modal_Type").val("Free");
                        }
    
                        if (skip_available == "1") {
                            $('#modal_skip_available').attr('checked', true);
                        } else if (skip_available == "0") {
                            $('#modal_skip_available').attr('checked', false);
                        }
    
                        $("#modal_intro_start").data("datetimepicker").date(intro_start);
                        $("#modal_intro_end").data("datetimepicker").date(intro_end);
                    }
                }
            });
        }

		function Update_Link_Data() {
            var modal_videos_id = document.getElementById("modal_videos_id").value;
            var Label = document.getElementById("modal_Label").value;
            var Order = document.getElementById("modal_Order").value;
            var Quality = document.getElementById("modal_Quality").value;
            var Size = document.getElementById("modal_Size").value;
            var Source = document.getElementById("editSource").value;
            var Url = document.getElementById("modal_Url").value;
    
            var Status_Txt = document.getElementById("modal_Status").value;
            if (Status_Txt == "Publish") {
                var Status = "1";
            } else if (Status_Txt == "Unpublish") {
                var Status = "0";
            }
    
            var Type_Txt = document.getElementById("modal_Type").value;
            if (Type_Txt == "Premium") {
                var modal_Type = "1";
            } else if (Type_Txt == "Free") {
                var modal_Type = "0";
            }
    
            if ($('#modal_skip_available').is(':checked')) {
                var modal_skip_available_Count = 1;
            } else {
                var modal_skip_available_Count = 0;
            }
            var modal_intro_start = document.getElementById('modal_intro_start').value;
            var modal_intro_end = document.getElementById('modal_intro_end').value;

            var drm_uuid_modal = document.getElementById('drm_uuid_modal').value;
            var drm_license_uri_modal = document.getElementById('drm_license_uri_modal').value;
    
            var jsonObjects = {
                ID: modal_videos_id,
                Label: Label,
                Order: Order,
                Quality: Quality,
                Size: Size,
                Source: Source,
                Url: Url,
                Status: Status,
                modal_skip_available_Count: modal_skip_available_Count,
                modal_intro_start: modal_intro_start,
                modal_intro_end: modal_intro_end,
                link_type: modal_Type,
				end_credits_marker: '0',
                drm_uuid_modal: drm_uuid_modal,
                drm_license_uri_modal: drm_license_uri_modal
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/update_movie_link_data') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response5) {
                    if (response5 != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Movie Link Updated Successfully!',
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

		function Delete_StreamLink(ID) {
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
                        movie_play_link_ID: ID
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/delete_movie_link_api') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Movie Link Deleted Successfully!',
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


        
        var addSource = document.getElementById('addSource');
        addSource.addEventListener('change', function() {
          if(this.value == "M3u8" || this.value == "Dash") {
            document.getElementById("drm_uuid_div").hidden = false;   
          } else {
            document.getElementById("drm_uuid_div").hidden = true; 
            document.getElementById("drm_license_uri_div").hidden = true; 
          }
        }, false);
        
        var drm_uuid = document.getElementById('drm_uuid');
        drm_uuid.addEventListener('change', function() {
          if(this.value == "WIDEVINE" || this.value == "PLAYREADY" || this.value == "CLEARKEY") {
            document.getElementById("drm_license_uri_div").hidden = false;   
          } else {
            document.getElementById("drm_license_uri_div").hidden = true;
          }
        }, false);

        var editSource = document.getElementById('editSource');
        editSource.addEventListener('change', function() {
          if(this.value == "M3u8" || this.value == "Dash") {
            document.getElementById("drm_uuid_div_modal").hidden = false;   
          } else {
            document.getElementById("drm_uuid_div_modal").hidden = true;
            document.getElementById("drm_license_uri_div_modal").hidden = true; 
          }
        }, false);
        
        var drm_uuid_modal = document.getElementById('drm_uuid_modal');
        drm_uuid_modal.addEventListener('change', function() {
          if(this.value == "WIDEVINE" || this.value == "PLAYREADY" || this.value == "CLEARKEY") {
            document.getElementById("drm_license_uri_div_modal").hidden = false;   
          } else {
            document.getElementById("drm_license_uri_div_modal").hidden = true;  
          }
        }, false);

        //Download Link

        $('#datatable_download_links').dataTable({
            "order": [],
            "ordering": false,
            "paging": false,
            "info": false,
            "filter": false,
            "pageLength": 100
        });

        function add_download_links() {
            var Label = document.getElementById("Label_download").value;
            var Order = document.getElementById("Order_download").value;
            var Quality = document.getElementById("Quality_download").value;
            var Size = document.getElementById("Size_download").value;
            var Source = document.getElementById("addSource_download").value;
            var Url = document.getElementById("url_download").value;
            var download_type = document.getElementById("download_type_download").value;
    
    
            var Status_Txt = document.getElementById("Status_download").value;
            if (Status_Txt == "Publish") {
                var Status = "1";
            } else if (Status_Txt == "Unpublish") {
                var Status = "0";
            }
    
            var jsonObjects = {
                Movie_id: "<?php echo $movieID; ?>",
                Label: Label,
                Order: Order,
                Quality: Quality,
                Size: Size,
                Source: Source,
                Url: Url,
                download_type: download_type,
                Status: Status
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/add_movie_download_links') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Download Link Added Successfully!',
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

		function Load_download_Link_Data(ID) {
            var jsonObjects = {
                movie_download_link_id: ID
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/get_movie_download_link_details') ?>',
                data: jsonObjects,
                dataType: 'json',
                success: function (response4) {
                    var id = response4.id;
                    var Label = response4.name;
                    var Order = response4.link_order;
                    var Quality = response4.quality;
                    var Size = response4.size;
                    var Source = response4.type;
                    var Url = response4.url;
                    var Status = response4.status;
                    var download_type = response4.download_type;
    
                    if (!id == "") {
                        $("#modal_videos_id_download").val(id);
                        $("#modal_Label_download").val(Label);
                        $("#modal_Order_download").val(Order);
                        $("#modal_Quality_download").val(Quality);
                        $("#modal_Size_download").val(Size);
                        $("#modal_Source_download").val(Source);
                        $("#modal_url_download").val(Url);
                        $("#modal_download_type_download").val(download_type);
    
                        if (Status == "1") {
                            $("#modal_Status_download").val("Publish");
                        } else if (Status == "0") {
                            $("#modal_Status_download").val("Unpublish");
                        }
                    }
                }
            });
        }

		function Update_download_Link_Data() {
            var modal_videos_id = document.getElementById("modal_videos_id_download").value;
            var Label = document.getElementById("modal_Label_download").value;
            var Order = document.getElementById("modal_Order_download").value;
            var Quality = document.getElementById("modal_Quality_download").value;
            var Size = document.getElementById("modal_Size_download").value;
            var Source = document.getElementById("modal_Source_download").value;
            var Url = document.getElementById("modal_url_download").value;
            var download_type = document.getElementById("modal_download_type_download").value;
    
    
            var Status_Txt = document.getElementById("modal_Status_download").value;
            if (Status_Txt == "Publish") {
                var Status = "1";
            } else if (Status_Txt == "Unpublish") {
                var Status = "0";
            }
    
            var jsonObjects = {
                ID: modal_videos_id,
                Label: Label,
                Order: Order,
                Quality: Quality,
                Size: Size,
                Source: Source,
                Url: Url,
                download_type: download_type,
                Status: Status
    
            };
            $.ajax({
                type: 'POST',
                url: '<?= site_url('Admin_api/update_movie_download_link_data') ?>',
                data: jsonObjects,
                dataType: 'text',
                success: function (response5) {
                    if (response5) {
                        swal.fire({
                            title: 'Successful!',
                            text: 'Download Link Updated Successfully!',
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

		function Delete_DownloadLink(ID) {
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
                        movie_download_link_ID: ID
                    };
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('Admin_api/delete_download_link') ?>',
                        data: jsonObjects,
                        dataType: 'text',
                        success: function (response) {
                            if (response) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Download Link Deleted Successfully!',
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

    </script>