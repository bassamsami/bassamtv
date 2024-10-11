<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Login | Dooo - Movie & Web Series Portal App</title>
        
        <?php include("partials/header.php"); ?>
    </head>

<body>

    <div class="home-btn d-none d-sm-block">
        <a href="" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20"><?php echo lang('welcome_back'); ?></h5>
                                <p class="text-white-50"><?php echo lang('sign_in_to_continue_to_dooo'); ?></p>
                                <a href="" class="logo logo-admin">
                                    <img src="assets/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="mt-4" method="post">

                                    <div class="mb-3">
                                        <label class="form-label" for="username">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password" required>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customControlInline">
                                                <label class="form-check-label" for="customControlInline"><?php echo lang('remember_me'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="submit" value="submit"><?php echo lang('log_in'); ?></button>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                    	<div class="col-lg-12">
                                    		<div id="result" class="m-t-15"></div>

                                            <?php 
                                            if ($this->session->flashdata('error') == "Invalid Login") {
                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Please</strong> Enter Valid Login Details.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                            } else if ($this->session->flashdata('error') == "Login BLocked") {
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">You Dont Have <strong>Permission</strong> To Login.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                            }
                                            ?>
                                    	</div>

                                    </div>

                                    <div class="mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="<?= site_url('recoverpw') ?>"><i class="mdi mdi-lock"></i> <?php echo lang('forgot_your_password'); ?></a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Dooo. Crafted with <i class="mdi mdi-heart text-danger"></i> by OneByte Solution.</p>
                    </div>


                </div>
            </div>
        </div>
    </div>

                    <!-- JAVASCRIPT -->
                    <script src="assets/libs/jquery/jquery.min.js"></script>
                <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="assets/libs/metismenu/metisMenu.min.js"></script>
                <script src="assets/libs/simplebar/simplebar.min.js"></script>
                <script src="assets/libs/node-waves/waves.min.js"></script>


        <!-- Peity chart-->
        <script src="assets/libs/peity/jquery.peity.min.js"></script>

        <!-- Plugin Js-->
        <script src="assets/libs/chartist/chartist.min.js"></script>
        <script src="assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <!-- QR Code-->
        <script src="assets/libs/qrcode/jquery.qrcode.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

</html>

    <script>
        $(".alert").alert('close');
        </script>

<script type="module">
          import devtools from "<?php echo base_url('/assets/js/devtools.js'); ?>";
          $(document).ready(function() {
              if (devtools.isOpen) {
                  var all = document.querySelectorAll("*");
              
                  for (var each of all) {
                      each.classList.add(`asdjaljsdliasud8ausdijaisdluasdjasildahjdsk${Math.random()}`);
                  }
              }
          });
          window.addEventListener('devtoolschange', event => {
            var all = document.querySelectorAll("*");
              
                  for (var each of all) {
                      each.classList.add(`asdjaljsdliasud8ausdijaisdluasdjasildahjdsk${Math.random()}`);
                  }
	        });
          
        </script>