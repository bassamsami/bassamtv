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

                            <h4 class="font-size-18">Custom Tags</h4>

                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Special</a></li>

                                <li class="breadcrumb-item active">Custom Tags</li>

                            </ol>

                        </div>

                    </div>

                    <div class="col-sm-6 row justify-content-end">
                        <a class="btn btn-primary dropdown-toggle waves-effect waves-light col-sm-3" data-bs-toggle="modal" data-bs-target="#add_custom_tag_Modal"> <i
                                class="mdi mdi-plus-box-multiple-outline mr-2"></i> Add Tag</a>
                    </div>

                </div>

                <!-- end page title -->


                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body">

                                <table id="datatable" class="table table-striped"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                    <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>##</th>
                                        <th>Tag</th>
                                        <th>Background Color</th>
                                        <th>Text Color</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach($custom_tags as $custom_tag) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $count; ?></th>
                                        <th scope="row">
                                            <div class="d-none d-sm-block">
                                                <div class="dropdown d-inline-block">
                                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                                       id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        Options <i class="mdi mdi-chevron-down"></i>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_custom_tag_Modal"
                                                           onclick="loadCustomTag('<?php echo $custom_tag->id; ?>')">Edit</a>
                                                        <a class="dropdown-item" onclick="deleteCustomTag('<?php echo $custom_tag->id; ?>')">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="row"><card class="pt-1 pb-1 ps-2 pe-2 rounded" style="background-color: <?= $custom_tag->background_color; ?>; color: <?= $custom_tag->text_color; ?>;"><strong><?= $custom_tag->name; ?></strong></card></th>
                                        <th scope="row"><div class="d-flex justify-content-center"><div class="rounded" style="width: 20px; height: 20px; background-color: <?= $custom_tag->background_color; ?>;"></div></div></th>
                                        <th scope="row"><div class="d-flex justify-content-center"><div class="rounded" style="width: 20px; height: 20px; background-color: <?= $custom_tag->text_color; ?>;"></div></div></th>
                                        <th scope="row"><?php echo date('F jS, Y - h:i A', $custom_tag->created_at); ?></th>
                                        <th scope="row"><?php echo date('F jS, Y - h:i A', $custom_tag->updated_at); ?></th>
                                    <tr>
                                        <?php $count++; } ?>
                                    </tbody>

                                </table>


                            </div>

                        </div>

                    </div> <!-- end col -->

                </div> <!-- end row -->

            </div>


            <?php include("partials/footer_rights.php"); ?>


        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Add Custom Tag Modal -->
    <div class="modal fade" id="add_custom_tag_Modal" tabindex="-1" role="dialog" aria-labelledby="add_custom_tag_Modal_Lebel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_custom_tag_Modal_Lebel">Add Custom Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label class="control-label">Name</label>
                        <input id="add_name" type="text" name="label" class="form-control" placeholder="" required="">
                    </div>

                    <div class="form-group mb-3">
                        <label class="control-label">Background Color</label>
                        <input type="text" class="form-control" id="add_background_color" name="add_background_color"
                               value="#000000">
                    </div>

                    <div class="form-group mb-3">
                        <label class="control-label">Text Color</label>
                        <input type="text" class="form-control" id="add_text_color" name="add_text_color"
                               value="#ffffff">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="addCustomTag()" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Custom Tag Modal -->
    <div class="modal fade" id="edit_custom_tag_Modal" tabindex="-1" role="dialog" aria-labelledby="edit_custom_tag_Modal_Lebel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_custom_tag_Modal_Lebel">Add Custom Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="edit_id" value="0">
                    <div class="form-group mb-3">
                        <label class="control-label">Name</label>
                        <input id="edit_name" type="text" name="label" class="form-control" placeholder="" required="">
                    </div>

                    <div class="form-group mb-3">
                        <label class="control-label">Background Color</label>
                        <input type="text" class="form-control" id="edit_background_color" name="edit_background_color"
                               value="#000000">
                    </div>

                    <div class="form-group mb-3">
                        <label class="control-label">Text Color</label>
                        <input type="text" class="form-control" id="edit_text_color" name="edit_text_color"
                               value="#ffffff">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updateCustomTag()" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <?php include("partials/footer.php"); ?>

    <script>
        $(document).ready(function() {
            $("#add_background_color").spectrum({
                allowEmpty:false,
                showInput:true,
                showAlpha:false,
                color: '#000000',
                change: function(color) { color.toHexString(); }
            });
            $("#add_text_color").spectrum({
                allowEmpty:false,
                showInput:true,
                showAlpha:false,
                color: '#ffffff',
                change: function(color) { color.toHexString(); }
            });
            $("#edit_background_color").spectrum({
                allowEmpty:false,
                showInput:true,
                showAlpha:false,
                color: '#000000',
                change: function(color) { color.toHexString(); }
            });
            $("#edit_text_color").spectrum({
                allowEmpty:false,
                showInput:true,
                showAlpha:false,
                color: '#ffffff',
                change: function(color) { color.toHexString(); }
            });
        });

        function addCustomTag() {
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

            var add_name = document.getElementById("add_name").value;
            var add_background_color = $("#add_background_color").spectrum("get").toHexString();
            var add_text_color = $("#add_text_color").spectrum("get").toHexString();

            var jsonObjects = {
                "addcustomtag": "addcustomtag",
                "name": add_name,
                "background_color": add_background_color,
                "text_color": add_text_color,
            };
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    Swal.close();
                    $('#add_custom_tag_Modal').modal('hide');
                    location.reload();
                }
            });
        }

        function deleteCustomTag(ID) {
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
                "deletecustomtag": "deletecustomtag",
                "ID": ID
            };
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    Swal.close();
                    location.reload();
                }
            });
        }

        function loadCustomTag(ID) {
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
                "getcustomtag": "getcustomtag",
                "ID": ID
            };
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: jsonObjects,
                dataType: 'json',
                success: function (response) {
                    Swal.close();
                    $("#edit_id").val(response.id);
                    $("#edit_name").val(response.name);
                    $("#edit_background_color").spectrum("set", response.background_color);
                    $("#edit_text_color").spectrum("set", response.text_color);
                }
            });
        }

        function updateCustomTag() {
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

            var edit_id = document.getElementById("edit_id").value;
            var edit_name = document.getElementById("edit_name").value;
            var edit_background_color = $("#edit_background_color").spectrum("get").toHexString();
            var edit_text_color = $("#edit_text_color").spectrum("get").toHexString();

            var jsonObjects = {
                "updatecustomtag": "updatecustomtag",
                "id": edit_id,
                "name": edit_name,
                "background_color": edit_background_color,
                "text_color": edit_text_color,
            };
            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: jsonObjects,
                dataType: 'text',
                success: function (response) {
                    Swal.close();
                    $('#edit_custom_tag_Modal').modal('hide');
                    location.reload();
                }
            });
        }
    </script>