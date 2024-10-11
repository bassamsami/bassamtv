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
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title"><?php echo lang('dashboard'); ?></h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Welcome to Dooo Dashboard</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                      <button class="btn btn-primary" type="button" id="dropdownMenuButton" onclick="window.location.href='<?= site_url('update') ?>'">
                                        <i class="ion ion-md-git-compare me-2"></i> Update
                                        <?php
                                        if($isUpdateAvailable) {
                                            echo '<span class="badge rounded-pill bg-warning">1</span>';
                                        }
                                        ?>
                                      </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?php
                        if(!(version_compare(phpversion(), '8.0', '>=') || version_compare(phpversion(), '8.0', '<')) || !function_exists("mysqli_connect") || !extension_loaded('gd') || !function_exists('gd_info')
                        || !function_exists("curl_version") || !ini_get('allow_url_fopen') || !ini_get('date.timezone')
                        || !is_writable("backup/db") || !is_writable("uploads/db") || !is_writable("uploads/images") || !is_writable("uploads/update")) {
                            ?>
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>Aww yeah, you successfully installed the Admin Panel. but it seems you may need to change some settings to fully support the panel requirements</p>
                                <hr>
                                <?php
                                if (!(version_compare(phpversion(), '8.0', '>=') && version_compare(phpversion(), '8.0', '<'))) {
                                    ?>
                                    <ul class="list-unstyled">
                                        <li><p class="h6">Please configure your PHP settings to match following requirements:</p>
                                            <ul>
                                                <li>Current PHP Version: <?php echo('<span class="badge bg-warning">'.phpversion().'</span>'); ?></li>
                                                <li>Required PHP Version: <?php echo('<span class="badge bg-success">8.0+</span>'); ?></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <?php
                                }
                                ?>
                                <?php
                                if(!function_exists("mysqli_connect") || !extension_loaded('gd') || !function_exists('gd_info')
                                    || !function_exists("curl_version") || !ini_get('allow_url_fopen') || !ini_get('date.timezone')) {
                                    ?>
                                    <ul class="list-unstyled">
                                        <li><p class="h6">Please make sure the extensions/settings listed below are installed/enabled:</p>
                                            <ul>
                                                <?php if (!function_exists("mysqli_connect")) { echo('<li>mysqli_connect</li>'); } ?>
                                                <?php if (!extension_loaded('gd') && !function_exists('gd_info')) { echo('<li>gd_info</li>'); } ?>
                                                <?php if (!function_exists("curl_version")) { echo('<li>curl_version</li>'); } ?>
                                                <?php if (!ini_get('allow_url_fopen')) { echo('<li>allow_url_fopen</li>'); } ?>
                                                <?php $timezone_settings = ini_get('date.timezone'); if(!$timezone_settings) { echo '<li>date.timezone</li>'; } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <?php
                                }
                                ?>

                                <?php
                                if(!is_writable("backup/db") || !is_writable("uploads/db")
                                || !is_writable("uploads/images") || !is_writable("uploads/update")) {
                                ?>
                                <ul class="list-unstyled">
                                    <li><p class="h6">Please make sure you have created  or set the writable
                                            permission on the following folders/files:</p>
                                        <ul>
                                            <?php if(!is_writable("backup/db")) { ?> <li>backup/db</li> <?php } ?>
                                            <?php if(!is_writable("uploads/db")) { ?> <li>uploads/db</li> <?php } ?>
                                            <?php if(!is_writable("uploads/images")) { ?> <li>uploads/images</li> <?php } ?>
                                            <?php if(!is_writable("uploads/update")) { ?> <li>uploads/update</li> <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                                    <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-start mini-stat-img me-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Total Movie</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $contentDetails->Total_Movie ?> <i
                                                    class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-end">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-start mini-stat-img me-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">UnPublished Movie</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $contentDetails->Total_Unpublished_Movie ?> <i
                                                    class="mdi mdi-arrow-down text-danger ms-2"></i></h4>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-end">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-start mini-stat-img me-4">
                                                <img src="assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Total Series</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $contentDetails->Total_WebSeries ?> <i
                                                    class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-end">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-start mini-stat-img me-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">UnPublished
                        						Series</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $contentDetails->Total_Unpublished_WebSeries ?> <i
                                                    class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-end">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <?php if(ini_get('open_basedir') && ini_get('shell_exec')) { ?>

                                <div class="col-xl-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Servers Usage</h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="text-center">
                                                                <p class="text-muted mb-2">Load status</p>
                                                                <div id="Load_status_chart" class="mb-1" style="height:100px;"></div>
                                                                <p class="text-muted" id="server_status"><?php echo $server_status['server']['status']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="text-center">
                                                                <p class="text-muted mb-2">CPU usage</p>
                                                                <div id="CPU_usage_chart" class="mb-1" style="height:100px;"></div>
                                                                <p class="text-muted" id="cpu_cores"><?php echo $server_status['cpu']['cores']; ?> Core(s)</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="text-center">
                                                                <p class="text-muted mb-2">RAM usage</p>
                                                                <div id="RAM_usage_chart" class="mb-1" style="height:100px;"></div>
                                                                <p class="text-muted" id="memory_free"><?php echo $server_status['memory']['free']; ?>/<?php echo $server_status['memory']['total']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="text-center">
                                                                <p class="text-muted mb-2">Storage usage</p>
                                                                <div id="Storage_usage_chart" class="mb-1" style="height:100px;"></div>
                                                                <p class="text-muted" id="storage_free"><?php echo $server_status['storage']['free']; ?>/<?php echo $server_status['storage']['total']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                    <!-- end card -->
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-xl-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Servers Usage</h4>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="alert alert-secondary mt-3 mb-5" role="alert">
                                                            <ul class="list-unstyled">
                                                                <li><p class="h6">Servers usage is disabled to enable Please make sure the extensions/settings listed below are installed/enabled:</p>
                                                                    <ul>
                                                                        <?php if (!ini_get('open_basedir')) { echo('<li>open_basedir</li>'); } ?>
                                                                        <?php if (!ini_get('shell_exec')) { echo('<li>shell_exec</li>'); } ?>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Cache</h4>
                                        <div class="text-center">
                                            <div class="py-4">
                                                <h1 class="text-warning" id="cache_size"><?php echo $cache_size; ?></h1>
                                                <h5 class="text mt-2">Total Cache Size</h5>
                                                <div class="mt-4">
                                                    <a onclick="clear_cache()" class="btn btn-danger btn-sm">Clear Cache</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">

                        	<div class="col-xl-3">
                        		<div class="card">
                        			<div class="card-body">
                        				<h4 class="card-title mb-4">Todays Content Report</h4>

                        				<div class="cleafix">
                        					<p class="float-start"><i class="mdi mdi-calendar mr-1 text-primary"></i>
                        						<?php echo date('M d', time())." (Total View)"; ?></p>
                        					<h5 class="font-18 text-end">
                        						<?php echo $contentDetails->todaysMoviesView+$contentDetails->todaysWebSeriesView; ?></h5>
                        				</div>

                        				<div id="ct-donut" class="ct-chart wid"></div>

                        				<div class="mt-1">
                        					<table class="table mb-0">
                        						<tbody>
                        							<tr>
                        								<td><span class="badge bg-primary">Movies</span></td>
                        								<td>Views</td>
                        								<td class="text-right"><?php echo $contentDetails->todaysMoviesView; ?></td>
                        							</tr>
                        							<tr>
                        								<td><span class="badge bg-success">Web Series</span></td>
                        								<td>Views</td>
                        								<td class="text-right"><?php echo $contentDetails->todaysWebSeriesView; ?></td>
                        							</tr>
                        						</tbody>
                        					</table>
                        				</div>
                        			</div>
                        		</div>

                        	</div>

                        	<div class="col-xl-9">
                        		<div class="card">
                        			<div class="card-body">

                        				<h4 class="card-title mb-4">User Report</h4>

                        				<div class="row justify-content-center">
                        					<div class="col-sm-4">
                        						<div class="text-center">
                        							<h5 class="mb-0 font-size-20">
                        								<?php echo $contentDetails->Total_device; ?></h5>
                        							<p class="text-muted">Total User</p>
                        						</div>
                        					</div>
                        					<div class="col-sm-4">
                        						<div class="text-center">
                        							<h5 class="mb-0 font-size-20">
                        								<?php echo $contentDetails->Total_user; ?></h5>
                        							<p class="text-muted">Registered User</p>
                        						</div>
                        					</div>
                        					<div class="col-sm-4">
                        						<div class="text-center">
                        							<h5 class="mb-0 font-size-20">
                        								<?php if($contentDetails->Total_device-$contentDetails->Total_user < 0) { echo "0"; } else { echo $contentDetails->Total_device-$contentDetails->Total_user; } ?>
                        							</h5>
                        							<p class="text-muted">Non Registered user</p>
                        						</div>
                        					</div>
                        				</div>


                        				<div id="pie-chart" style="height:300px;"></div>

                        			</div>
                        		</div>
                        	</div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                        	<div class="col-xl-12">
                        		<div class="card">
                        			<div class="card-body">
                        				<h4 class="card-title mb-4">Most viewed Today</h4>
                        				<div class="table-responsive">
                        					<table class="table table-hover table-centered table-nowrap mb-0">
                        						<thead>
                        							<tr>
                        								<th scope="col">#</th>
                        								<th scope="col">Name</th>
                        								<th scope="col">View</th>
                        								<th scope="col">Type</th>
                        								<th scope="col">Edit</th>
                        							</tr>
                        						</thead>
                        						<tbody>
                                      <?php
                                      $decodedMostViewedToday = json_decode($mostViewedToday);
                                      foreach($decodedMostViewedToday as $item) {
                                        ?>
                                        <tr>
                                        <th scope="row"><?php echo $item->_I; ?></th>
                        								<th scope="row"><?php echo $item->name; ?></th>
                        								<th scope="row"><?php echo $item->_V; ?></th>
                        								<th scope="row"><span class="badge bg-primary"><?php echo $item->c_type; ?></span></th>
                        								<td>
                        									<div>
                        										<a href="edit_movie?id=<?php echo $item->id; ?>"
                        											class="btn btn-primary btn-sm">Edit</a>
                        									</div>
                        								</td>
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

                        <div class="row">

                        	<div class="col-xl-6">
                        		<div class="card">
                        			<div class="card-body">
                        				<h4 class="card-title mb-4">Most Popular Movies</h4>
                        				<div class="table-responsive">
                        					<table class="table table-hover table-centered table-nowrap mb-0">
                        						<thead>
                        							<tr>
                        								<th scope="col">#</th>
                        								<th scope="col">Name</th>
                        								<th scope="col">View</th>
                        								<th scope="col">Edit</th>
                        							</tr>
                        						</thead>
                        						<tbody>
                                    <?php
                                      $decodedMostPopularMovies = json_decode($MostPopularMovies);
                                      foreach($decodedMostPopularMovies as $item) {
                                        ?>
                                        <tr>
                        							  	<th scope="row"><?php echo $item->M_I; ?></th>
                        							  	<th scope="row"><?php echo $item->name; ?></th>
                        							  	<th scope="row"><?php echo $item->T_M_V; ?></th>
                        							  	<td>
                        							  		<div>
                        							  			<a href="editMovie/<?php echo $item->id; ?>"
                        							  				class="btn btn-primary btn-sm">Edit</a>
                        							  		</div>
                        							  	</td>
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

                        	<div class="col-xl-6">
                        		<div class="card">
                        			<div class="card-body">
                        				<h4 class="card-title mb-4">Most Popular WebSeries</h4>
                        				<div class="table-responsive">
                        					<table class="table table-hover table-centered table-nowrap mb-0">
                        						<thead>
                        							<tr>
                        								<th scope="col">#</th>
                        								<th scope="col">Name</th>
                        								<th scope="col">View</th>
                        								<th scope="col">Edit</th>
                        							</tr>
                        						</thead>
                        						<tbody>
                                    <?php
                                      $decodedMostPopularWebSeries = json_decode($MostPopularWebSeries);
                                      foreach($decodedMostPopularWebSeries as $item) {
                                        ?>
                                        <tr>
                        								<th scope="row"><?php echo $item->S_I; ?></th>
                        								<th scope="row"><?php echo $item->name; ?></th>
                        								<th scope="row"><?php echo $item->T_S_V; ?></th>
                        								<td>
                        									<div>
                        										<a href="edit_web_series.php?id=<?php echo $item->id; ?>"
                        											class="btn btn-primary btn-sm">Edit</a>
                        									</div>
                        								</td>
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


                        <div class="row">

                        	<div class="col-xl-12">
                        		<div class="card">
                        			<div class="card-body">
                        				<h4 class="card-title mb-4">New users</h4>
                        				<div class="table-responsive">
                        					<table class="table table-hover table-centered table-nowrap mb-0">
                        						<thead>
                        							<tr>
                        								<th>#</th>
                        								<th>Full Name</th>
                        								<th>Email</th>
                        								<th>Role</th>
                        								<th>Subscription</th>
                        							</tr>
                        						</thead>
                        						<tbody>
                                    <?php
                                      $decodedNewUsers = json_decode($NewUsers);
                                      foreach($decodedNewUsers as $item) {
                                        ?>
                                        <tr>
                        								<th scope="row"><?php echo $item->M_I; ?></th>
                        								<th scope="row"><?php echo $item->name; ?></th>
                        								<th scope="row"><?php echo $item->email; ?></th>

                        								<?php
                                                            $f_role = "";
                                                                if ($item->role == 0) {
                                                                    $f_role = 'User';
                                                                } else if ($item->role == 1) {
                                                                    $f_role = 'Admin';
                                                                } else if ($item->role == 2) {
                                                                    $f_role = 'SubAdmin';
                                                                } else if ($item->role == 3) {
                                                                    $f_role = 'Editor';
                                                                } else if ($item->role == 4) {
                                                                    $f_role = 'Editor';
                                                                }
                                                            ?>
                        								<th scope="row"><?php echo $f_role; ?></th>

                        								<th scope="row"><?php echo $item->active_subscription; ?></th>
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

                        <!-- Panel Update Modal -->
            <div class="modal fade" id="PanelUpdateModal" tabindex="-1" aria-labelledby="PanelUpdateModallLabel"
              aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0">

                  </div>
                  <div class="modal-body">
                    <div class="text-center mb-4">
                      <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title rounded-circle h1">
                          <i class="on ion-md-cloud-download"></i>
                        </div>
                      </div>

                      <div class="row justify-content-center">
                        <div class="col-xl-10">
                          <h4 class="text-primary">Time To Update !</h4>
                          <p class="text-muted font-size-14 mb-4">This Version of Dooo is out of date.</p>

                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Later</button>
            				<button type="button" onclick="window.location.href='<?= site_url('update') ?>'" class="btn btn-primary">Update
            				</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php include("partials/footer_rights.php"); ?>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->




        <?php include("partials/footer.php"); ?>

        <script>
        $(function() {
          if(<?php echo $isUpdateAvailable; ?>) {
            $('#PanelUpdateModal').modal('show');
          }
        });
        </script>
        <script>
            if(<?php echo $contentDetails->todaysMoviesView; ?> == "0" && <?php echo $contentDetails->todaysWebSeriesView; ?> == "0") {
                var chart = new Chartist.Pie('.ct-chart', {
                  series: ["1"],
                  labels: [1]
                }, {
                  donut: true,
                  showLabel: false
                });
            } else {
                var chart = new Chartist.Pie('.ct-chart', {
                  series: [<?php echo $contentDetails->todaysMoviesView; ?>, <?php echo $contentDetails->todaysWebSeriesView; ?>],
                  labels: [1, 2]
                }, {
                  donut: true,
                  showLabel: false,
                  plugins: [
                    Chartist.plugins.tooltip()
                  ]
                });
            }

            chart.on('draw', function(data) {
              if(data.type === 'slice') {
                // Get the total path length in order to use for dash array animation
                var pathLength = data.element._node.getTotalLength();

                // Set a dasharray that matches the path length as prerequisite to animate dashoffset
                data.element.attr({
                  'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
                });

                var animationDefinition = {
                  'stroke-dashoffset': {
                    id: 'anim' + data.index,
                    dur: 1000,
                    from: -pathLength + 'px',
                    to:  '0px',
                    easing: Chartist.Svg.Easing.easeOutQuint,
                    fill: 'freeze'
                  }
                };

                if(data.index !== 0) {
                  animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                }

                data.element.attr({
                  'stroke-dashoffset': -pathLength + 'px'
                });

                data.element.animate(animationDefinition, false);
              }
            });



            var myChart = echarts.init(document.getElementById('pie-chart'));
            option = {
              title: {
                text: '',
                subtext: '',
                left: 'center'
              },
              tooltip: {
                trigger: 'item'
              },
              legend: {
                orient: 'vertical',
                left: 'left',
                textStyle: {
                    color : "#B9B8CE"
                }
              },
              series: [
                {
                    name: '',
                  type: 'pie',
                  radius: ['40%', '70%'],
                  avoidLabelOverlap: false,
                  itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 0
                  },
                  label: {
                    show: false,
                    position: 'center'
                  },
                  emphasis: {
                    label: {
                      show: true,
                      fontSize: '40',
                      fontWeight: 'bold'
                    }
                  },
                  labelLine: {
                    show: false
                  },
                  data: [
                    { value: <?php echo $contentDetails->Total_user; ?>, name: 'Registered User' },
                    { value: <?php if($contentDetails->Total_device-$contentDetails->Total_user < 0) { echo "0"; } else { echo $contentDetails->Total_device-$contentDetails->Total_user; } ?>, name: 'Non Registered user' }
                  ]
                }
              ]
            };
            myChart.setOption(option);



            setInterval(function () {
                $.ajax({
                    type: "POST",
                    url: window.location.href,
                    data: {
                        server_status: 'server_status'
                    },
                    dataType: 'json',
                    success: function (response) {
                        if(response!=null) {
                            $('#server_status').text(response.server.status);
                            $('#cpu_cores').text(response.cpu.cores+" Core(s)");
                            $('#memory_free').text(response.memory.free+"/"+response.memory.total);
                            $('#storage_free').text(response.storage.free+"/"+response.storage.total);

                            Load_status_chart_gaugeData[0].value = response.server.load;
                            Load_status_chart.setOption({
                                series: [
                                    {
                                        data: Load_status_chart_gaugeData,
                                    }
                                ]
                            });


                            CPU_usage_chart_gaugeData[0].value = response.cpu.load;
                            CPU_usage_chart.setOption({
                                series: [
                                    {
                                        data: CPU_usage_chart_gaugeData,
                                    }
                                ]
                            });

                            RAM_usage_chart_gaugeData[0].value = response.memory.percentage;
                            RAM_usage_chart.setOption({
                                series: [
                                    {
                                        data: RAM_usage_chart_gaugeData,
                                    }
                                ]
                            });

                            Storage_usage_chart_gaugeData[0].value = response.storage.percentage;
                            Storage_usage_chart.setOption({
                                series: [
                                    {
                                        data: Storage_usage_chart_gaugeData,
                                    }
                                ]
                            });
                        }
                    }
                });

                $.ajax({
                    type: "POST",
                    url: window.location.href,
                    data: {
                        cache_size: 'cache_size'
                    },
                    dataType: 'text',
                    success: function (response) {
                        if(response!=null) {
                            $('#cache_size').text(response);
                        }
                    }
                });
            }, 3000);



            //Load_status_chart
            var Load_status_chart = echarts.init(document.getElementById('Load_status_chart'));
            const Load_status_chart_gaugeData = [
                {
                    value: <?php if(isset($server_status)) {echo $server_status['server']['load'];} else {echo "0";} ?>,
                    detail: {
                        valueAnimation: true,
                        offsetCenter: ['0%', '-0%']
                    }
                }
            ];
            Load_status_chart_option = {
                series: [
                    {
                        type: 'gauge',
                        startAngle: -90,
                        endAngle: 270,
                        pointer: {
                            show: false
                        },
                        progress: {
                            show: true,
                            overlap: false,
                            roundCap: true,
                            clip: false,
                            itemStyle: {
                                borderWidth: 1,
                                borderColor: '#464646'
                            }
                        },
                        axisLine: {
                            lineStyle: {
                                width: 8
                            }
                        },
                        splitLine: {
                            show: false,
                            distance: 0,
                            length: 10
                        },
                        axisTick: {
                            show: false
                        },
                        axisLabel: {
                            show: false,
                            distance: 50
                        },
                        data: Load_status_chart_gaugeData,
                        title: {
                            fontSize: 14
                        },
                        detail: {
                            width: 50,
                            height: 14,
                            fontSize: 12,
                            color: '#FFFFFF',
                            borderColor: 'inherit',
                            borderRadius: 0,
                            borderWidth: 0,
                            formatter: '{value}%'
                        }
                    }
                ]
            };
            Load_status_chart.setOption(Load_status_chart_option);


            //CPU_usage_chart
            var CPU_usage_chart = echarts.init(document.getElementById('CPU_usage_chart'));
            const CPU_usage_chart_gaugeData = [
              {
                value: <?php if(isset($server_status)) {echo $server_status['cpu']['load'];} else {echo "0";} ?>,
                detail: {
                  valueAnimation: true,
                  offsetCenter: ['0%', '-0%']
                }
              }
            ];
            CPU_usage_chart_option = {
              series: [
                {
                  type: 'gauge',
                  startAngle: -90,
                  endAngle: 270,
                  pointer: {
                    show: false
                  },
                  progress: {
                    show: true,
                    overlap: false,
                    roundCap: true,
                    clip: false,
                    itemStyle: {
                      borderWidth: 1,
                      borderColor: '#464646'
                    }
                  },
                  axisLine: {
                    lineStyle: {
                      width: 8
                    }
                  },
                  splitLine: {
                    show: false,
                    distance: 0,
                    length: 10
                  },
                  axisTick: {
                    show: false
                  },
                  axisLabel: {
                    show: false,
                    distance: 50
                  },
                  data: CPU_usage_chart_gaugeData,
                  title: {
                    fontSize: 14
                  },
                  detail: {
                    width: 50,
                    height: 14,
                    fontSize: 12,
                    color: '#FFFFFF',
                    borderColor: 'inherit',
                    borderRadius: 0,
                    borderWidth: 0,
                    formatter: '{value}%'
                  }
                }
              ]
            };
            CPU_usage_chart.setOption(CPU_usage_chart_option);



            //RAM_usage_chart
            var RAM_usage_chart = echarts.init(document.getElementById('RAM_usage_chart'));
            const RAM_usage_chart_gaugeData = [
              {
                value: <?php if(isset($server_status)) {echo $server_status['memory']['percentage'];} else {echo "0";} ?>,
                detail: {
                  valueAnimation: true,
                  offsetCenter: ['0%', '-0%']
                }
              }
            ];
            RAM_usage_chart_option = {
              series: [
                {
                  type: 'gauge',
                  startAngle: -90,
                  endAngle: 270,
                  pointer: {
                    show: false
                  },
                  progress: {
                    show: true,
                    overlap: false,
                    roundCap: true,
                    clip: false,
                    itemStyle: {
                      borderWidth: 1,
                      borderColor: '#464646'
                    }
                  },
                  axisLine: {
                    lineStyle: {
                      width: 8
                    }
                  },
                  splitLine: {
                    show: false,
                    distance: 0,
                    length: 10
                  },
                  axisTick: {
                    show: false
                  },
                  axisLabel: {
                    show: false,
                    distance: 50
                  },
                  data: RAM_usage_chart_gaugeData,
                  title: {
                    fontSize: 14
                  },
                  detail: {
                    width: 50,
                    height: 14,
                    fontSize: 12,
                    color: '#FFFFFF',
                    borderColor: 'inherit',
                    borderRadius: 0,
                    borderWidth: 0,
                    formatter: '{value}%'
                  }
                }
              ]
            };
            RAM_usage_chart.setOption(RAM_usage_chart_option);


            //Storage_usage_chart
            var Storage_usage_chart = echarts.init(document.getElementById('Storage_usage_chart'));
            const Storage_usage_chart_gaugeData = [
              {
                value: <?php if(isset($server_status)) {echo $server_status['storage']['percentage'];} else {echo "0";} ?>,
                detail: {
                  valueAnimation: true,
                  offsetCenter: ['0%', '-0%']
                }
              }
            ];
            Storage_usage_chart_option = {
              series: [
                {
                  type: 'gauge',
                  startAngle: -90,
                  endAngle: 270,
                  pointer: {
                    show: false
                  },
                  progress: {
                    show: true,
                    overlap: false,
                    roundCap: true,
                    clip: false,
                    itemStyle: {
                      borderWidth: 1,
                      borderColor: '#464646'
                    }
                  },
                  axisLine: {
                    lineStyle: {
                      width: 8
                    }
                  },
                  splitLine: {
                    show: false,
                    distance: 0,
                    length: 10
                  },
                  axisTick: {
                    show: false
                  },
                  axisLabel: {
                    show: false,
                    distance: 50
                  },
                  data: Storage_usage_chart_gaugeData,
                  title: {
                    fontSize: 14
                  },
                  detail: {
                    width: 50,
                    height: 14,
                    fontSize: 12,
                    color: '#FFFFFF',
                    borderColor: 'inherit',
                    borderRadius: 0,
                    borderWidth: 0,
                    formatter: '{value}%'
                  }
                }
              ]
            };
            Storage_usage_chart.setOption(Storage_usage_chart_option);

            function clear_cache() {
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
                type: "POST",
                url: window.location.href,
                data: {
                  clear_cache: 'clear_cache'
                },
                dataType: 'text',
                success: function (response) {
                  $('#cache_size').text(response);
                }
              });
              Swal.close();
            }


        </script>