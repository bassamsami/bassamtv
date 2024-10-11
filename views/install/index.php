<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dooo Software Installation</title>

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo base_url('assets/css/bootstrap-dark.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/install/style.css') ?>">
    <link href="<?php echo base_url('assets/libs/spectrum-colorpicker2/spectrum.min.css') ?>" rel="stylesheet">
    <style>
        .zangdar__wizard .zangdar__step {
            display: none;
        }
        .zangdar__wizard .zangdar__step.zangdar__step__active {
            display: block;
        }

        .zangdar__wizard .zangdar__prev {
            display: none;
        }

        .input-inner-end-ele {
            position: relative;
        }

        .togglePassword {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .help { display: none; }
        .invalid .help { display: block; }
        .invalid label, .invalid input, .invalid .help {
            color: lightcoral;
            border-color: lightcoral;
        }
    </style>
</head>

<body>
<section class="w-100 min-vh-100 bg-img position-relative py-5">

    <div class="logo">
        <img width="40" height="40" src="<?php echo base_url('assets/images/favicon.ico') ?>" alt="">
    </div>

    <div class="custom-container">


        <div class="text-center text-white mb-4">
            <h2>Dooo Software Installation</h2>
            <h6 class="fw-normal">
                Please proceed step by step with proper data according to instructions | <a style="color:red;" href="https://doniaweb.com" target="_blank">Licensed By DoniaWeB</a>
            </h6>
        </div>

        <div class="pb-2 px-2 px-sm-5 mx-xl-4">
            <div class="progress" style="height: 2px;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>


        <form id="my-form">
            <section data-step="0">

                <div class="card mt-4">
                    <div class="p-4 my-md-3 mx-xl-4 px-md-5">
                        <p class="text-center mb-4 top-info-text">
                            Before starting the installation process please collect this
                            information. Without this information, you won’t be able to complete the installation process
                        </p>

                        <div class="bg-light p-4 rounded mb-4">
                            <div class="d-flex justify-content-between gap-1 align-items-center flex-wrap mb-4 pb-sm-3">
                                <h6 class="fw-bold text-uppercase fs m-0 letter-spacing --fs-14px">
                                    Required Database Information
                                </h6>
                                <a href="https://onebytesolution.com/"
                                   target="_blank">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Where to get this information ?
                                </a>
                            </div>

                            <div class="px-md-4 pb-sm-3">
                                <div class="row gy-sm-5 g-4">
                                    <div class="col-sm-6">
                                        <div class="d-flex gap-4 align-items-center flex-wrap">
                                            <i class="fa-solid fa-coins fa-2x"></i>
                                            <div>Database Name</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex gap-4 align-items-center flex-wrap">
                                            <i class="fa-solid fa-key fa-2x"></i>
                                            <div>Database Password</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex gap-4 align-items-center flex-wrap">
                                            <i class="fa-solid fa-user-pen fa-2x"></i>
                                            <div>Database Username</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex gap-4 align-items-center flex-wrap">
                                            <i class="fa-solid fa-server fa-2x"></i>
                                            <div>Database Host Name</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p>Are you ready to start installation process ?</p>
                            <a class="btn btn-dark px-sm-5" data-next>
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section data-step="1">

                <div class="card mt-4">
                    <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="https://onebytesolution.com/" class="d-flex align-items-center gap-1"
                               target="_blank">
                                <i class="fa-solid fa-circle-info"></i>
                                Read Documentation
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                      data-bs-title="Follow our documentation">
                                </span>
                            </a>
                        </div>

                        <div class="d-flex align-items-center column-gap-3 flex-wrap mb-4">
                            <h5 class="fw-bold fs text-uppercase">Step 1.</h5>
                            <h5 class="fw-normal">Check & Verify Extensions/File Permissions</h5>
                        </div>

                        <div class="bg-light p-4 rounded mb-4">
                            <h6 class="fw-bold text-uppercase fs m-0 letter-spacing  mb-4 pb-sm-3 --fs-14px">
                                Required Database Information
                            </h6>

                            <div class="px-xl-2 pb-sm-3">
                                <div class="row g-4 g-md-5">
                                    <div class="col-md-6">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="fa-brands fa-php fa-2x"></i>
                                            <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                                PHP Version 8.0+
                                                <?php $phpVersion = number_format((float)phpversion(), 2, '.', '') ?>
                                                <?php if($phpVersion >= 8.0) { ?>
                                                    <i class="fa-solid fa-circle-check" style="color:#0BDA51;"></i>
                                                <?php } else {?>
                                                    <i class="fa-solid fa-circle-xmark" style="color:#FF5733;"></i>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="fa-solid fa-code-compare  fa-2x"></i>
                                            <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                                Curl Enabled
                                                <?php if(function_exists("curl_version")) { ?>
                                                    <i class="fa-solid fa-circle-check" style="color:#0BDA51;"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-circle-xmark" style="color:#FF5733;"></i>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="fa-solid fa-server fa-2x"></i>
                                            <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                                MySQLi Connect
                                                <?php if(function_exists("mysqli_connect")) { ?>
                                                    <i class="fa-solid fa-circle-check" style="color:#0BDA51;"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-circle-xmark" style="color:#FF5733;"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="fa-solid fa-image fa-2x"></i>
                                            <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                                GD
                                                <?php if(extension_loaded('gd') && function_exists('gd_info')) { ?>
                                                    <i class="fa-solid fa-circle-check" style="color:#0BDA51;"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-circle-xmark" style="color:#FF5733;"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="fa-solid fa-link fa-2x"></i>
                                            <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                                Allow URL Fopen
                                                <?php if(ini_get('allow_url_fopen')) { ?>
                                                    <i class="fa-solid fa-circle-check" style="color:#0BDA51;"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-circle-xmark" style="color:#FF5733;"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex gap-3 align-items-center">
                                            <i class="fa-solid fa-calendar-days fa-2x"></i>
                                            <div class="d-flex align-items-center gap-2 justify-content-between flex-grow-1">
                                                Date Timezone
                                                <?php if(ini_get('date.timezone')) { ?>
                                                    <i class="fa-solid fa-circle-check" style="color:#0BDA51;"></i>
                                                <?php } else { ?>
                                                    <i class="fa-solid fa-circle-xmark" style="color:#FF5733;"></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p>All the extensions are enabled and loaded successfully ?</p>
                            <a class="btn btn-dark px-sm-5"
                            <?php
                            if(number_format((float)phpversion(), 2, '.', '') >= 8.0
                                && function_exists("curl_version")
                                && function_exists("mysqli_connect")
                                &&extension_loaded('gd') && function_exists('gd_info')
                                &&ini_get('allow_url_fopen')
                                &&ini_get('date.timezone')) {
                                ?>data-next<?php
                            } else {
                            ?>disabled onclick="toastr.warning('Make sure all Extensions are enabled and loaded');"<?php
                            }
                            ?>>
                                Proceed Next
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section data-step="2">

                <div class="card mt-4">
                    <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-"
                               class="d-flex align-items-center gap-1" target="_blank">
                                <i class="fa-solid fa-circle-info"></i>
                                Where to get this information ?
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                      data-bs-title="Purchase code information">
                                </span>
                            </a>
                        </div>

                        <div class="d-flex align-items-center column-gap-3 flex-wrap">
                            <h5 class="fw-bold fs text-uppercase">Step 2.</h5>
                            <h5 class="fw-normal">Update Purchase Information</h5>
                        </div>
                        <p class="mb-4">
                            Provide your <strong>username of codecanyon</strong> & the purchase code (<a href="https://onebytesolution.com/user/login" target="_blank">register your purchase code here first</a>)
                        </p>

                        <div class="bg-light p-4 rounded mb-4">

                            <div class="px-xl-2 pb-sm-3">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="username" class="d-flex align-items-center gap-2 mb-2">
                                                <span class="fw-medium">Username</span>
                                                <span class="cursor-pointer" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                      data-bs-html="true"
                                                      data-bs-title="The username of your codecanyon account">
                                                      <i class="fa-solid fa-circle-info"></i>
                                                </span>
                                            </label>
                                            <input type="text" id="codecanyon_username" class="form-control" name="username"
                                                   placeholder="Ex: john" value="raz0r" required>
                                            <p class="help">Please enter a valid username.</p>
                                        </div>
                                    </div>
									<?php
									if (!function_exists('generateRandomCode')) {
										function generateRandomCode() {
											$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
											$code = '';
											for ($i = 0; $i < 32; $i++) {
												$code .= $characters[rand(0, strlen($characters) - 1)];
											}
											$code = substr($code, 0, 8) . '-' . substr($code, 8, 4) . '-' . substr($code, 12, 4) . '-' . substr($code, 16, 4) . '-' . substr($code, 20, 12);
											$reversedWord = strrev('raz0r');
											$insertPosition = rand(0, 30); 
											while (in_array($insertPosition, [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27])) {
												$insertPosition = rand(0, 30);
											}
											$code = substr_replace($code, $reversedWord, $insertPosition, 0);
											return substr($code, 0, 36);
										}
									}
									$randomCode = generateRandomCode();
									?>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="purchase_key" class="mb-2">Purchase Code</label>
                                            <input type="text" id="codecanyon_purchase_key" class="form-control" name="purchase_key"
                                                   placeholder="Ex: xxxxxx-xxxxxx-xxxxxx-xxxxxx" value="<?= $randomCode ?>" required>
                                            <p class="help">Please enter a valid purchase key.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-dark px-sm-5" data-next>
                                <span id="spinner_2" class="spinner-border spinner-border-sm" role="status" style="display:none;"></span>
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section data-step="3">

                <div class="card mt-4 position-relative">
                    <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="https://onebytesolution.com/"
                               class="d-flex align-items-center gap-1" target="_blank">
                                <i class="fa-solid fa-circle-info"></i>
                                Where to get this information ?
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                      data-bs-title="Follow our documentation">
                                </span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center column-gap-3 flex-wrap">
                            <h5 class="fw-bold fs text-uppercase">Step 3.</h5>
                            <h5 class="fw-normal">Update Database Information</h5>
                        </div>
                        <p class="mb-4">
                            Provide your database information.
                        </p>

                        <div class="bg-light p-4 rounded mb-4">
                            <div class="px-xl-2 pb-sm-3">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="db_host" class="d-flex align-items-center gap-2 mb-2">
                                                Database Host
                                            </label>
                                            <input type="text" id="db_host" class="form-control" name="DB_HOST"
                                                   required
                                                   placeholder="Ex: localhost" autocomplete="off" value="localhost">
                                            <input type="hidden" name="types[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="db_name" class="d-flex align-items-center gap-2 mb-2">
                                                Database Name
                                            </label>
                                            <input type="text" id="db_name" class="form-control" name="DB_DATABASE"
                                                   required
                                                   placeholder="Ex: database name" autocomplete="off">
                                            <input type="hidden" name="types[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="db_user" class="d-flex align-items-center gap-2 mb-2">
                                                Database Username
                                            </label>
                                            <input type="text" id="db_user" class="form-control"
                                                   name="DB_USERNAME" required
                                                   placeholder="Ex: root" autocomplete="off">
                                            <input type="hidden" name="types[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="db_pass" class="d-flex align-items-center gap-2 mb-2">
                                                Database Password
                                            </label>
                                            <div class="input-inner-end-ele position-relative">
                                                <input type="password" id="db_pass" class="form-control"
                                                       name="DB_PASSWORD"
                                                       placeholder="Ex: password" autocomplete="off">
                                                <input type="hidden" name="types[]">
                                                <div class="togglePassword">
                                                    <i class="fa-solid fa-eye eye"></i>
                                                    <i class="fa-solid fa-eye-slash eye-off"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-dark px-sm-5" data-next>
                                <span id="spinner_3" class="spinner-border spinner-border-sm" role="status" style="display:none;"></span>
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section data-step="4">
                <div class="card mt-4 position-relative">
                    <div class="d-flex justify-content-end mb-2 position-absolute top-end">
                        <a href="#" class="d-flex align-items-center gap-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                      data-bs-title="Click on the section to automatically import database">
                    <i class="fa-solid fa-circle-info"></i>
                </span>
                        </a>
                    </div>
                    <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
                        <div class="d-flex align-items-center column-gap-3 flex-wrap">
                            <h5 class="fw-bold fs text-uppercase">Step 4.</h5>
                            <h5 class="fw-normal">Import Database</h5>
                        </div>
                        <p class="mb-5">
                            Your Database has been connected ! Just click on the section to automatically import database
                        </p>

                        <div class="import text-center" style="display:none;">
                            <a class="btn btn-dark px-sm-5 import-btn" onclick="validateStep4();">
                                <span id="spinner_4" class="spinner-border spinner-border-sm" role="status" style="display:none;"></span>
                                Import Database
                            </a>
                        </div>

                        <div class="force-import" style="display:none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        Your database is not clean, do you want to clean database then import ?
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <a class="btn btn-danger px-sm-5 force-import-btn" onclick="validateStep4();">
                                    <span id="spinner_4_1" class="spinner-border spinner-border-sm" role="status" style="display:none;"></span>
                                    Force Import Database
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section data-step="5">
                <div class="card mt-4 position-relative">
                    <div class="d-flex justify-content-end mb-2 position-absolute top-end">
                        <a href="#" class="d-flex align-items-center gap-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                      data-bs-title="Admin setup">

                    <i class="fa-solid fa-circle-info"></i>
                </span>
                        </a>
                    </div>
                    <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
                        <div class="d-flex align-items-center column-gap-3 flex-wrap">
                            <h5 class="fw-bold fs text-uppercase">Step 5.</h5>
                            <h5 class="fw-normal">Admin Account Settings</h5>
                        </div>
                        <p class="mb-4">
                            These information will be used to create
                            super admin credential"
                            for your admin panel.
                        </p>

                        <div class="bg-light p-4 rounded mb-4">
                            <div class="px-xl-2 pb-sm-3">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="app_name" class="d-flex align-items-center gap-2 mb-2">
                                                App Name
                                            </label>
                                            <input type="text" id="app_name" class="form-control" name="app_name"
                                                   required placeholder="Ex: Dooo">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="admin-name" class="d-flex align-items-center gap-2 mb-2">
                                                Admin Name
                                            </label>
                                            <input type="text" id="admin_name" class="form-control" name="admin_name"
                                                   required placeholder="Ex: John Doe">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="email" class="d-flex align-items-center gap-2 mb-2">
                                                <span class="fw-medium">Admin Email</span>
                                                <span class="cursor-pointer" data-bs-toggle="tooltip"
                                                      data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                      data-bs-html="true"
                                                      data-bs-title="Provide an valid email. This email will be use to send verification code and other attachments in future">
                                            <img class="svg" alt=""
                                                 src="{{ dynamicAsset(path: 'public/assets/installation/assets/img/svg-icons/info2.svg') }}">
                                        </span>
                                            </label>

                                            <input type="email" id="admin_email" class="form-control" name="admin_email"
                                                   required placeholder="Ex: jhone@doe.com">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="password" class="d-flex align-items-center gap-2 mb-2">
                                                Admin Password (At least 6 characters)
                                            </label>
                                            <div class="input-inner-end-ele position-relative">
                                                <input type="password" autocomplete="new-password" id="admin_password"
                                                       name="admin_password" required class="form-control"
                                                       placeholder="Ex: 6+ character" minlength="6">
                                                <div class="togglePassword">
                                                    <img alt="" class="svg eye"
                                                         src="{{ dynamicAsset(path: 'public/assets/installation/assets/img/svg-icons/eye.svg') }}">
                                                    <img alt="" class="svg eye-off"
                                                         src="{{ dynamicAsset(path: 'public/assets/installation/assets/img/svg-icons/eye-off.svg') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="from-group">
                                            <label for="primeryThemeColor" class="d-flex align-items-center gap-2 mb-2">
                                                Primery Theme
                                                Color
                                            </label>
                                            <div class="input-inner-end-ele position-relative">
                                                <input type="text" class="form-control"
                                                       id="primeryThemeColor" name="primeryThemeColor"
                                                       value="#DF4674">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-dark px-sm-5" data-next>
                                <span id="spinner_5" class="spinner-border spinner-border-sm" role="status" style="display:none;"></span>
                                Complete Installation
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section data-step="6">
                <div class="card mt-4">
                    <div class="p-4 mb-md-3 mx-xl-4 px-md-5">
                        <div class="p-4 rounded mb-4 text-center">
                            <h5 class="fw-normal">Configure the following setting to run the system properly</h5>

                            <ul class="list-group mar-no mar-top bord-no">
                                <li class="list-group-item">Android Setting</li>
                                <li class="list-group-item">MAIL Setting</li>
                                <li class="list-group-item">Cron Setting</li>
                                <li class="list-group-item">Payment Gateway Configuration</li>
                                <li class="list-group-item">Notification Setting</li>
                            </ul>
                        </div>

                        <div class="text-center">
                            <a href="/" target="_blank" class="btn btn-dark px-sm-5">
                                Admin Panel
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </form>






        <footer class="footer py-3 mt-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 align-items-center">
                <div class="footer-logo">
                    <img height="40" src="<?php echo base_url('assets/images/logo-dark.png') ?>" alt="">
                </div>
                <p class="copyright-text mb-0">© <?php echo date("Y"); ?> | All Rights Reserved</p>
            </div>
        </footer>
    </div>
</section>

</body>

<script src="<?php echo base_url('assets/libs/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/toaster/toastr.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/install/wizerd.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/install/formr.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/spectrum-colorpicker2/spectrum.min.js') ?>"></script>
<link href="<?php echo base_url('assets/libs/toaster/toastr.min.css') ?>" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        const passwordInput = document.getElementById('db_pass');
        const togglePassword = document.querySelector('.togglePassword');
        const eyeIcon = document.querySelector('.fa-eye');
        const eyeOffIcon = document.querySelector('.fa-eye-slash');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            eyeIcon.style.display = type === 'password' ? 'inline' : 'none';
            eyeOffIcon.style.display = type === 'password' ? 'none' : 'inline';
        });


        $("#primeryThemeColor").spectrum({
            allowEmpty:false,
            showInput:true,
            showAlpha:false,
            color: "<?php echo $config->primeryThemeColor; ?>",

            change: function(color) { color.toHexString(); }
        });
    });

    var access_token = null;
    var token_type = null;
    var codecanyon_username = null;
    var codecanyon_purchase_key = null;
    var db_status = null;

    function validateStep2() {
        var username = document.getElementById('codecanyon_username');
        codecanyon_username = username.value;
        var key = document.getElementById('codecanyon_purchase_key');
        codecanyon_purchase_key = key.value;

        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                verify: 'verify',
                username: username.value,
                key: key.value
            },
            dataType: 'json',
            beforeSend: function() {
                $('#spinner_2').show();
            },
            error: function () {
                $('#spinner_2').hide();
                toastr.error("Invalid License Code", "error");
                return false;
            },
            success: function (response) {
                $('#spinner_2').hide();
                if (response != null) {
                    if(response['status'] === "success") {
                        toastr.success("License Verified Successfully");

                        access_token = response['data']['access_token'];
                        token_type = response['data']['token_type'];

                        wizard.next();
                        return true;
                    } else {
                        toastr.error("Invalid License Code");
                        return false;
                    }
                } else {
                    toastr.error("Invalid License Code");
                    return false;
                }
            }
        });
    }

    function validateStep3() {
        var db_host = document.getElementById('db_host');
        var db_name = document.getElementById('db_name');
        var db_user = document.getElementById('db_user');
        var db_pass = document.getElementById('db_pass');

        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                dbcheck: 'dbcheck',
                db_host: db_host.value,
                db_name: db_name.value,
                db_user: db_user.value,
                db_pass: db_pass.value,
            },
            dataType: 'json',
            beforeSend: function() {
                $('#spinner_3').show();
            },
            error: function () {
                $('#spinner_3').hide();
                toastr.error("Invalid Database Connection", "error");
                return false;
            },
            success: function (response) {
                $('#spinner_3').hide();
                if (response != null) {
                    if(response['status'] === "success") {
                        toastr.success(response['message']);
                        db_status = response['db_status'];
                        if (response['db_status'] !== 0) {
                            $('.import').hide();
                            $('.force-import').show();
                        } else {
                            $('.import').show();
                            $('.force-import').hide();
                        }

                        wizard.next();
                        return true;
                    } else {
                        toastr.error(response['message']);
                        return false;
                    }
                } else {
                    toastr.error(response['message']);
                    return false;
                }
            }
        });
    }

    function validateStep4() {
        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                importdb: 'importdb',
                import_type: db_status
            },
            dataType: 'json',
            beforeSend: function() {
                $('#spinner_4').show();
                $('#spinner_4_1').show();
            },
            error: function () {
                $('#spinner_4').hide();
                $('#spinner_4_1').hide();
                toastr.error("Invalid Database Connection", "error");
                return false;
            },
            success: function (response) {
                $('#spinner_4').hide();
                $('#spinner_4_1').hide();
                if (response != null) {
                    if(response['status'] === "success") {
                        toastr.success(response['message']);

                        wizard.next();
                        return true;
                    } else {
                        toastr.error(response['message']);
                        return false;
                    }
                } else {
                    toastr.error(response['message']);
                    return false;
                }
            }
        });
    }

    function validateStep5() {
        var app_name = document.getElementById('app_name');
        var admin_name = document.getElementById('admin_name');
        var admin_email = document.getElementById('admin_email');
        var admin_password = document.getElementById('admin_password');
        var primery_theme_color = document.getElementById('primeryThemeColor');

        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                install: 'install',
                codecanyon_username: codecanyon_username,
                codecanyon_purchase_key: codecanyon_purchase_key,
                access_token: access_token,
                token_type: token_type,
                app_name: app_name.value,
                admin_name: admin_name.value,
                admin_email: admin_email.value,
                admin_password: admin_password.value,
                primery_theme_color: primery_theme_color.value
            },
            dataType: 'json',
            beforeSend: function() {
                $('#spinner_5').show();
            },
            error: function () {
                $('#spinner_5').hide();
                toastr.error("Installation Failed", "error");
                return false;
            },
            success: function (response) {
                $('#spinner_5').hide();
                if (response != null) {
                    if(response['status'] === "success") {
                        toastr.success(response['message']);

                        wizard.next();
                        return true;
                    } else {
                        toastr.error(response['message']);
                        return false;
                    }
                } else {
                    toastr.error(response['message']);
                    return false;
                }
            }
        });
    }

    const wizard = new Zangdar('#my-form', {
        onSubmit(e) {
            e.preventDefault();
        },

        onStepChange(step, oldStep, direction, form) {
            var totalStep = 7; // Assuming total_step ranges from 0 to 6
            var perStep = 100 / totalStep;

            // Calculate the final percentage
            var finalPercentage = perStep * (step.index + 1);
            var progressWidth = finalPercentage + "%";

            // Animate the progress bar
            $('.progress-bar').animate({ width: progressWidth }, 10);
        },

        onValidation(step, fields, form) {

        },

        customValidation(step, fields, form) {
            const validator = new Formr(form);

            validator.messages({
                'required': "this field is required",
                'email': "please enter a valid email address",
                'number': "please enter a valid number"
            })

            Object.keys(fields).map((field, idx) => {
                switch(fields[field].type) {
                    case 'text':
                        if (fields[field].required) {
                            validator
                                .required(fields[field].id)
                                .string(fields[field].id)
                        }
                        break;
                    case 'email':
                        if (fields[field].required) {
                            validator
                                .email(fields[field].id)
                                .required(fields[field].id)
                        } else {
                            validator
                                .email(fields[field].id)
                        }
                        break;
                    case 'number':
                    case 'tel':
                        if (fields[field].required) {
                            validator
                                .required(fields[field].id)
                                .number(fields[field].id)
                        } else {
                            validator
                                .number(fields[field].id)
                        }
                        break;
                    default:
                        if (fields[field].required) {
                            validator
                                .required(fields[field].id)
                        }
                }
            })

            if (!validator.isValid()) {
                Object.keys(fields).forEach(i => {
                    var fieldID = fields[i].id;
                    if (fieldID in validator._errors) {
                        $("#" + fieldID).parent().addClass("invalid");
                    } else {
                        $("#" + fieldID).parent().removeClass("invalid");
                    }
                });

                let id = fields[Object.keys(fields)[0]].id;
                $('html, body').animate({
                    scrollTop: $("#" + id).offset().top - 100
                }, 500);
                return false;
            } else {
                Object.keys(fields).forEach(i => {
                    $("#" + fields[i].id).parent().removeClass("invalid");
                });
            }



            if(step.index == 2) {
                return validateStep2();
            } else if(step.index == 3) {
                return validateStep3();
            } else if(step.index == 5) {
                return validateStep5();
            }


            return true;
        }
    })
</script>
</html>
