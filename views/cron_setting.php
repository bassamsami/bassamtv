<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
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

                                <h4 class="font-size-18">Cron Setting</h4>

                                <ol class="breadcrumb mb-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Setting</a></li>

                                    <li class="breadcrumb-item active">Cron Setting</li>

                                </ol>

                            </div>

                        </div>

                    </div>

                    <!-- end page title -->

                    <div class="form" method="post">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card card-body">

                                    <h3 class="card-title mt-0">Cron Setting</h3>

                                    <hr>
                                    <div class="alert alert-info" role="alert">
                                        <strong>Daily Cron: </strong> <code>wget -O /dev/null <?php echo base_url(); ?>Cron/daily/<?php echo $config->cron_key; ?></code>
                                    </div>
                                    <div class="alert alert-info" role="alert">
                                        <strong>Weekly Cron: </strong> <code>wget -O /dev/null <?php echo base_url(); ?>Cron/weekly/<?php echo $config->cron_key; ?></code>
                                    </div>
                                    <div class="alert alert-info" role="alert">
                                        <strong>Monthly Cron: </strong> <code>wget -O /dev/null <?php echo base_url(); ?>Cron/monthly/<?php echo $config->cron_key; ?></code>
                                    </div>
                                    <br>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-3 control-label"><strong>Cron Key</strong></label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="cron_key" name="cron_secret_key"
                                                    class="form-control" required="" value="<?php echo $config->cron_key; ?>" disabled="">
                                                <span class="input-group-text waves-effect waves-light" id="option-date"
                                                    onclick="copyToClipboard('cron_key')">Copy</span>
                                                <a class="btn btn-primary" id="gsk" onclick="Generate_Secrate_cron_Key()">Generate New
                                                    Key</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="control-label col-sm-3 ">Cron Enable?</label>
                                        <div class="col-sm-6">
                                            <input type="checkbox" id="C_bool" name="C_bool"
                                                switch="bool">
                                            <label for="C_bool" data-on-label=""
                                                data-off-label=""></label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card card-body">

                                <h4 class="card-title">Notification Cron</h4>
                                <p class="card-title-desc">Notification Cron Setting</p>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#NBasic" role="tab">
                                            <span class="d-none d-md-block">Basic</span><span
                                                class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#NAdvanced" role="tab">
                                            <span class="d-none d-md-block">Advanced</span><span
                                                class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="NBasic" role="tabpanel">
                                        <div class="form">
                                            <form method="post">
                                                <div class="form-group row mb-3">
                                                    <label class="control-label col-sm-3 ">Notification Cron
                                                        Enable?</label>
                                                    <div class="col-sm-6">
                                                        <input type="checkbox" id="N_bool" name="N_bool" switch="bool">
                                                        <label for="N_bool" data-on-label="" data-off-label=""></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 control-label">Notification Cron
                                                        Schedule</label>
                                                    <div class="col-sm-3 ">
                                                        <select class="form-control form-select"
                                                            id="auto_notification_schedule"
                                                            name="auto_notification_schedule">
                                                            <option value="1" selected="">Daily</option>
                                                            <option value="7">Weekly</option>
                                                            <option value="30">Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="float-end d-none d-md-block">
                                                    <button
                                                        class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                        id="save_notification_btn" type="submit" name="nc"
                                                        value="nc" aria-haspopup="true"
                                                        aria-expanded="false">

                                                        <i class="mdi mdi-content-save-all"></i> SAVE

                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-3" id="NAdvanced" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <strong>Notification Cron: </strong> <code>wget -O /dev/null
                                                <?php echo base_url(); ?>Cron/notification/<?php echo $config->cron_key; ?></code>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="card card-body">

                                <h4 class="card-title">Database Backup Cron</h4>
                                <p class="card-title-desc">Database Backup Setting</p>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#DBBasic" role="tab">
                                            <span class="d-none d-md-block">Basic</span><span
                                                class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#DBAdvanced" role="tab">
                                            <span class="d-none d-md-block">Advanced</span><span
                                                class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="DBBasic" role="tabpanel">
                                        <div class="form">
                                            <form method="post">
                                                <div class="form-group row mb-3">
                                                    <label class="control-label col-sm-3 ">Database Backup Cron
                                                        Enable?</label>
                                                    <div class="col-sm-6">
                                                        <input type="checkbox" id="DB_bool" name="DB_bool"
                                                            switch="bool">
                                                        <label for="DB_bool" data-on-label="" data-off-label=""></label>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 control-label">Database Backup Cron
                                                        Schedule</label>
                                                    <div class="col-sm-3 ">
                                                        <select class="form-control form-select" id="db_backup_schedule"
                                                            name="db_backup_schedule">
                                                            <option value="1">Daily</option>
                                                            <option value="7">Weekly</option>
                                                            <option value="30" selected="">Monthly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="float-end d-none d-md-block">
                                                    <button
                                                        class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                        id="save_db_btn" type="submit" name="dbc"
                                                        value="dbc" aria-haspopup="true"
                                                        aria-expanded="false">

                                                        <i class="mdi mdi-content-save-all"></i> SAVE

                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-3" id="DBAdvanced" role="tabpanel">
                                        <div class="alert alert-info" role="alert">
                                            <strong>Database Backup Cron: </strong> <code>wget -O /dev/null
                                                <?php echo base_url(); ?>Cron/dbbackup/<?php echo $config->cron_key; ?></code>
                                        </div>
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
            function copyToClipboard(element) {
                document.getElementById(element).disabled = false;
                var copyText = document.getElementById(element);
                copyText.focus();
                copyText.select();
                try {
                  var successful = document.execCommand('copy');
                  var msg = successful ? 'successful' : 'unsuccessful';
                    swal.fire({
                        title: 'Copied!',
                        html: copyText.value + '<br>Now just paste into android configuration file',
                        icon: 'success'
                    });
                } catch (err) {
                    swal.fire({
                        title: 'Error',
                        text: 'Something Went Wrong :(',
                        icon: 'error'
                    }).then(function () {
                        location.reload();
                    });
                }
                document.getElementById(element).disabled = true;
            }

            $(document).ready(function() {
                if ('<?php echo $config->cron_status; ?>' == 1) {
                    document.getElementById("C_bool").checked = true;
                    var shuffle = true;
                } else {
                    document.getElementById("C_bool").checked = false;
                    var shuffle = false;
			    }

                $("#C_bool").on('click', function() {
                    shuffle = !shuffle;
                    $.ajax({
                      url: '<?= site_url('Admin_api/CronStatus') ?>',
                      type: 'POST',
                      data: {"cron_status": (shuffle)?1:0},
                      dataType:'text',
                        success: function(result){
                            swal.fire({
                                title: 'Successful!',
                                text: 'Cron Status Updated successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    });
                });

                if ('<?php echo $config->auto_notification_status; ?>' == 1) {
                    document.getElementById("N_bool").checked = true;
                } else {
                    document.getElementById("N_bool").checked = false;
			    }
                $('#auto_notification_schedule').val('<?php echo $config->auto_notification_schedule; ?>');

                if ('<?php echo $config->db_backup_status; ?>' == 1) {
                    document.getElementById("DB_bool").checked = true;
                } else {
                    document.getElementById("DB_bool").checked = false;
			    }
                $('#db_backup_schedule').val('<?php echo $config->db_backup_schedule; ?>');
            });

            $(document).ready(function() {
                if('<?php if($this->session->flashdata('success') != "") {echo true;} else { echo false;} ?>') {
			        swal.fire({
                        title: 'Successful!',
                        text: "<?php echo $this->session->flashdata('success'); ?>",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: "#f46a6a"
                    }).then(function () {
                        location.reload();
                    });
			    }
			    if('<?php if($this->session->flashdata('error') != "") {echo true;} else { echo false;} ?>') {
			    	swal.fire({
                        title: 'Error',
                        text: "<?php echo $this->session->flashdata('error'); ?>",
                        icon: 'error'
                    }).then(function () {
                        location.reload();
                    });
			    }
            });

            function Generate_Secrate_cron_Key() {
                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, Generate New Key!"
            }).then(function (result) {
                if (result.value) {
    
                    $.ajax({
                      url: '<?= site_url('Admin_api/GenerateSecrateCronKey') ?>',
                      type: 'GET',
                      dataType:'text',
                        success: function(result){
                            swal.fire({
                                title: 'Successful!',
                                text: 'Cron Key Updated successfully!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#556ee6',
                                cancelButtonColor: "#f46a6a"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    });
                }
            });
        }

        
        </script>