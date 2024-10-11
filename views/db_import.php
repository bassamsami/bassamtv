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

            						<h4 class="font-size-18">Api Import</h4>

            						<ol class="breadcrumb mb-0">

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">System</a></li>
                                        
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Database</a></li>
                                        
                                        <li class="breadcrumb-item active">DB Import</li>

            						</ol>

            					</div>

            				</div>

            			</div>

            			<!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">DB Import</h4>
                                        <p class="card-title-desc">Add your Database file here to import From backup
                                        </p>

                                        <div class="mb-5">
                                            <form action="#" class="dropzone" id="myDropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple="multiple">
                                                </div>

                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="mdi mdi-cloud-upload display-4 text-muted"></i>
                                                    </div>
                                                    
                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </form><!-- end form -->
                                        </div>
    
                                        
                                        <div class="form-group mb-3 row justify-content-end">
            								<div class="col-md-1">
            									<button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                type="submit" onclick="processUploadedFile()"
            										aria-haspopup="true" aria-expanded="false">
            										<i class="mdi mdi-import"></i> Import
            									</button>
            								</div>
            							</div>

                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
            			

            		</div> <!-- container-fluid -->

            	</div>


            	<?php include("partials/footer_rights.php"); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include("partials/footer.php"); ?>

        <script>
            var fullPath = "";
            Dropzone.options.myDropzone = {
                url: "<?= site_url('Admin_api/ImportDbFile') ?>",
                uploadMultiple: false,
                maxFiles: 1,
                acceptedFiles: ".sql,.csv,",
                maxFilesize: 256,
                timeout: 180000,
                clickable: true,
                addRemoveLinks: true,
                dictDefaultMessage: "Drop files here to upload",
                dictFallbackMessage:
                    "Your browser does not support drag'n'drop file uploads.",
                dictFallbackText:
                    "Please use the fallback form below to upload your files like in the olden days.",
                dictFileTooBig:
                    "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
                dictInvalidFileType: "You can't upload files of this type.",
                dictResponseError: "Server responded with {{statusCode}} code.",
                dictCancelUpload: "Cancel upload",
                dictUploadCanceled: "Upload canceled.",
                dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
                dictRemoveFile: "Remove file",
                dictRemoveFileConfirmation: null,
                dictMaxFilesExceeded: "You can not upload any more files.",
                dictFileSizeUnits: { tb: "TB", gb: "GB", mb: "MB", kb: "KB", b: "b" },
                success: function(file, response){
                    fullPath = response;
                }
            };

            function processUploadedFile() {
                if(fullPath != "") {
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
                        url: '<?= site_url('Admin_api/processImportedDb') ?>',
                        type: 'POST',
                        data: {
                            "fullPath": fullPath
                        },
                        dataType:'json',
                        success: function(result){
                            Swal.close();
                            if(result) {
                                swal.fire({
                                    title: 'Successful!',
                                    text: 'Database File Imported successfully!',
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
                        },
                        error: function (jq, status, message) {
                            Swal.close();
                            swal.fire({
                                title: 'Error',
                                text: 'Something Went Wrong :(',
                                icon: 'error'
                            }).then(function () {
                                location.reload();
                            });
                        }
                    });
                }
            }
        </script>