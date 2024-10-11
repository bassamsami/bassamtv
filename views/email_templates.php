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

                    <div class="col-sm-8">

                        <div class="page-title-box">

                            <h4 class="font-size-18">Email Templates</h4>

                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                <li class="breadcrumb-item"><a href="javascript: void(0);">SMTP Setting</a></li>

                                <li class="breadcrumb-item active">Email Templates</li>

                            </ol>

                        </div>

                    </div>

                </div>

                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Email Templates</h4>
                                <p class="card-title-desc">Modify as you need</p>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#signup" role="tab" aria-selected="true" tabindex="0">
                                            <span class="d-none d-md-block">Welcome Mail</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#login_otp" role="tab" aria-selected="false" tabindex="1">
                                            <span class="d-none d-md-block">Login OTP</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#signup_otp" role="tab" aria-selected="false" tabindex="2">
                                            <span class="d-none d-md-block">Signup OTP</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#password_reset_otp" role="tab" aria-selected="false" tabindex="3">
                                            <span class="d-none d-md-block">Password Reset OTP</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#subscription_purchase" role="tab" aria-selected="false" tabindex="4">
                                            <span class="d-none d-md-block">Subscription Purchase</span><span class="d-block d-md-none"><i class="mdi mdi-cog h5"></i></span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" id="setting_tabs">
                                    <div class="tab-pane p-3 active show" id="signup" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <i class="mdi mdi-xml"></i> Short Codes: <code>{{APP_NAME}}, {{APP_LOGO}}, {{USER_MAIL}}, {{CURRENT_DATE}},
                                                {{CURRENT_TIME}}, {{CURRENT_DATE_TIME}}, {{CURRENT_YEAR}}, {{USER_NAME}}</code>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="summernote" id="signup_HTML_edit"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="float-end d-none d-md-block">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="showPreview('signup_HTML_edit')">
                                                    <i class="mdi mdi-xml"></i> Preview
                                                </button>
                                                <button class="btn btn-primary" type="button" onclick="saveSignup()">
                                                    <i class="mdi mdi-content-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="login_otp" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <i class="mdi mdi-xml"></i> Short Codes: <code>{{APP_NAME}}, {{APP_LOGO}}, {{USER_MAIL}}, {{CURRENT_DATE}},
                                                {{CURRENT_TIME}}, {{CURRENT_DATE_TIME}}, {{CURRENT_YEAR}}, {{VERIFICATION_CODE}}, {{USER_NAME}}</code>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="summernote" id="login_otp_HTML_edit"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="float-end d-none d-md-block">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="showPreview('login_otp_HTML_edit')">
                                                    <i class="mdi mdi-xml"></i> Preview
                                                </button>
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="saveLoginOTP()">
                                                    <i class="mdi mdi-content-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="signup_otp" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <i class="mdi mdi-xml"></i> Short Codes: <code>{{APP_NAME}}, {{APP_LOGO}}, {{USER_MAIL}}, {{CURRENT_DATE}},
                                                {{CURRENT_TIME}}, {{CURRENT_DATE_TIME}}, {{CURRENT_YEAR}}, {{VERIFICATION_CODE}}, {{USER_NAME}}</code>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="summernote" id="signup_otp_HTML_edit"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="float-end d-none d-md-block">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="showPreview('signup_otp_HTML_edit')">
                                                    <i class="mdi mdi-xml"></i> Preview
                                                </button>
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="saveSignupOTP()">
                                                    <i class="mdi mdi-content-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="password_reset_otp" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <i class="mdi mdi-xml"></i> Short Codes: <code>{{APP_NAME}}, {{APP_LOGO}}, {{USER_MAIL}}, {{CURRENT_DATE}},
                                                {{CURRENT_TIME}}, {{CURRENT_DATE_TIME}}, {{CURRENT_YEAR}}, {{VERIFICATION_CODE}}, {{USER_NAME}}</code>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="summernote" id="password_reset_otp_HTML_edit"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="float-end d-none d-md-block">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="showPreview('password_reset_otp_HTML_edit')">
                                                    <i class="mdi mdi-xml"></i> Preview
                                                </button>
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="savePasswordResetOTP()">
                                                    <i class="mdi mdi-content-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="subscription_purchase" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <i class="mdi mdi-xml"></i> Short Codes: <code>{{APP_NAME}}, {{APP_LOGO}}, {{USER_MAIL}}, {{CURRENT_DATE}},
                                                {{CURRENT_TIME}}, {{CURRENT_DATE_TIME}}, {{CURRENT_YEAR}}, {{USER_NAME}}, {{SUBSCUIPTION_NAME}},
                                                {{SUBSCUIPTION_TIME}}, {{SUBSCUIPTION_AMOUNT}}, {{SUBSCUIPTION_START}}, {{SUBSCUIPTION_EXPIRE}}</code>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="summernote" id="subscription_purchase_HTML_edit"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="float-end d-none d-md-block">
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="showPreview('subscription_purchase_HTML_edit')">
                                                    <i class="mdi mdi-xml"></i> Preview
                                                </button>
                                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="saveSubscriptionPurchase()">
                                                    <i class="mdi mdi-content-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div> <!-- container-fluid -->

            <!-- Modal -->
            <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div>
                            <iframe id="previewWindow" style="overflow:hidden;height:100%;width:100%;border:0;" height="100%" width="100%" scrolling="no" border="0"></iframe>
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
    $(document).ready(function() {
        $('.nav-tabs a[href="#' + localStorage.getItem("currentTabIndex") + '"]').tab('show');
        $('.nav-tabs > li > a').click( function() {
            localStorage.setItem("currentTabIndex", $(this).attr('href').slice(1));
        });


        $('.summernote').each(function() {
            $(this).summernote({
                height: 250
            });
        });
        $('#signup_HTML_edit').summernote('editor.insertText', `<?php echo $signup; ?>`);
        $('#login_otp_HTML_edit').summernote('editor.insertText', `<?php echo $login_otp; ?>`);
        $('#signup_otp_HTML_edit').summernote('editor.insertText', `<?php echo $signup_otp; ?>`);
        $('#password_reset_otp_HTML_edit').summernote('editor.insertText', `<?php echo $password_reset_otp; ?>`);
        $('#subscription_purchase_HTML_edit').summernote('editor.insertText', `<?php echo $subscription_purchase; ?>`);
    });

    function showPreview(summernote_id) {
        var signup_HTML = jQuery($("#"+summernote_id).summernote("code")).text();

        var tempDiv = $("<div>").html(signup_HTML).hide().appendTo("body");
        var contentHeight = tempDiv.height();
        tempDiv.remove();

        $('#previewWindow').height(contentHeight);

        $('#previewWindow').attr("srcdoc", signup_HTML);

        $("#previewModal").modal("show");
    }

    function saveSignup() {
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

        var signup_HTML = jQuery($("#signup_HTML_edit").summernote("code")).text();
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                'signup_HTML_edit': 'signup_HTML_edit',
                'signup_HTML': signup_HTML
            },
            dataType: 'text',
            success: function(result){
                Swal.close();
                if(result) {
                    $('#signup_HTML_edit').summernote('reset');
                    $('#signup_HTML_edit').summernote('editor.insertText', result);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success("Welcome Mail Template Saved Successfully");
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error("Something Went Wrong!");
                }
            },
            error: function (response) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Something Went Wrong!");
            }
        });
    }

    function saveLoginOTP() {
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

        var login_otp_HTML = jQuery($("#login_otp_HTML_edit").summernote("code")).text();
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                'login_otp_HTML_edit': 'login_otp_HTML_edit',
                'login_otp_HTML': login_otp_HTML
            },
            dataType: 'text',
            success: function(result){
                Swal.close();
                if(result) {
                    $('#login_otp_HTML_edit').summernote('reset');
                    $('#login_otp_HTML_edit').summernote('editor.insertText', result);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success("Login OTP Template Saved Successfully");
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error("Something Went Wrong!");
                }
            },
            error: function (response) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Something Went Wrong!");
            }
        });
    }

    function saveSignupOTP() {
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

        var signup_otp_HTML = jQuery($("#signup_otp_HTML_edit").summernote("code")).text();
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                'signup_otp_HTML_edit': 'signup_otp_HTML_edit',
                'signup_otp_HTML': signup_otp_HTML
            },
            dataType: 'text',
            success: function(result){
                Swal.close();
                if(result) {
                    $('#signup_otp_HTML_edit').summernote('reset');
                    $('#signup_otp_HTML_edit').summernote('editor.insertText', result);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success("Signup OTP Template Saved Successfully");
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error("Something Went Wrong!");
                }
            },
            error: function (response) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Something Went Wrong!");
            }
        });
    }

    function savePasswordResetOTP() {
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

        var password_reset_otp_HTML = jQuery($("#password_reset_otp_HTML_edit").summernote("code")).text();
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                'password_reset_otp_HTML_edit': 'password_reset_otp_HTML_edit',
                'password_reset_otp_HTML': password_reset_otp_HTML
            },
            dataType: 'text',
            success: function(result){
                Swal.close();
                if(result) {
                    $('#password_reset_otp_HTML_edit').summernote('reset');
                    $('#password_reset_otp_HTML_edit').summernote('editor.insertText', result);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success("Password Reset OTP Template Saved Successfully");
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error("Something Went Wrong!");
                }
            },
            error: function (response) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Something Went Wrong!");
            }
        });
    }

    function saveSubscriptionPurchase() {
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

        var subscription_purchase_HTML = jQuery($("#subscription_purchase_HTML_edit").summernote("code")).text();
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: {
                'subscription_purchase_HTML_edit': 'subscription_purchase_HTML_edit',
                'subscription_purchase_HTML': subscription_purchase_HTML
            },
            dataType: 'text',
            success: function(result){
                Swal.close();
                if(result) {
                    $('#subscription_purchase_HTML_edit').summernote('reset');
                    $('#subscription_purchase_HTML_edit').summernote('editor.insertText', result);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success("Subscription Purchase Template Saved Successfully");
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error("Something Went Wrong!");
                }
            },
            error: function (response) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Something Went Wrong!");
            }
        });
    }
</script>