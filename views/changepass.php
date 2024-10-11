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
                                <h5 class="text-white font-size-20">Change Password</h5>
                                <p class="text-white-50">Enter new Passsword</p>
                                <a href="" class="logo logo-admin">
                                    <img src="assets/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">

                            <div class="p-3">

                                <div class="alert alert-success mt-5" role="alert">
                                    Enter your New Password!
                                </div>


                                <div class="form-group mb-3">
                                    <label for="useremail">Password</label>
                                    <input type="email" class="form-control" id="Password" placeholder="Enter Password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="useremail">Confirm Password</label>
                                    <input type="email" class="form-control" id="Confirm_Password"
                                        placeholder="Confirm Password">
                                </div>

                                <div class="form-group row  mb-0">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary w-md waves-effect waves-light"
                                            id="Update_btn" onclick="Update_Password()">Update</button>
                                    </div>
                                </div>

                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div id="result" class="m-t-15"></div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Dooo. Crafted with <i class="mdi mdi-heart text-danger"></i> by Team Dooo</p>
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
        function Update_Password() {
            var Password = document.getElementById("Password").value;
            var Confirm_Password = document.getElementById("Confirm_Password").value;

            var code = "<?php echo $code ?>";

            if (Password == Confirm_Password) {

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('Password_reset/password_reset') ?>',
                    data: {
                        'code': code,
                        'pass': Password
                    },
                    dataType: 'text',
                    beforeSend: function () {
                        $("#Update_btn").html('Updating...');
                    },
                    success: function (response) {
                        $("#Update_btn").html('Update');

                        if (response == "") {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>Something Went Wrong!</div>'
                            );
                        } else if (response == "Invalid Request") {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>Invalid Request!</div>'
                            );
                        } else if (response == "Expired!") {
                            $('#result').html(
                                '<div class="alert alert-danger alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>Code Expired!</div>'
                            );
                        } else if (response == "Password Updated successfully") {
                            $('#result').html(
                                '<div class="alert alert-success alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"></button>Password Updated successfully!</div>'
                            );
                        }
                    }
                });

            } else {
                $('#result').html(
                    '<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Password and Confirm Password Not Matching!</div>'
                );
            }
        }
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