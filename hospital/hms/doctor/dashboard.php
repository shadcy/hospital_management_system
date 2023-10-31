<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctor | Dashboard</title>

		<?php include_once("../include/head_links.php") ?>


	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">

				<?php include('include/header.php'); ?>

				<!-- end: TOP NAVBAR -->
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Doctor | Dashboard</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Profile</h2>

											<p class="links cl-effect-1">
												<a href="edit-profile.php">
													Update Profile
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Appointments</h2>

											<p class="cl-effect-1">
												<a href="appointment-history.php">
													View Appointment History
												</a>
											</p>
										</div>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> Pink Slip </h2>

											<p class="links cl-effect-1">
												<a href="gen.php">
													Generate
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-book fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Hospital Mail </h2>

											<p class="links cl-effect-1">
												<a href="mail.php">
													Generate
												</a>
											</p>
										</div>
									</div>
								</div>





								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-ambulance fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Ambulance </h2>

											<p class="links cl-effect-1">
												<a href="ambulance.php">
													Generate
												</a>
											</p>
										</div>
									</div>
								</div>


								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-search fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Search Patients </h2>

											<p class="links cl-effect-1">
												<a href="search.php">
													Search
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-user fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Add Patients </h2>

											<p class="links cl-effect-1">
												<a href="add-patient.php">
													Add :
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-ambulance fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Manage Patients </h2>

											<p class="links cl-effect-1">
												<a href="manage-patient.php">
													Manage
												</a>
											</p>
										</div>
									</div>
								</div>




								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Log Out </h2>

											<p class="links cl-effect-1">
												<a href="logout.php">
													Log Out
												</a>
											</p>
										</div>
									</div>
								</div>




							</div>
						</div>






						<!-- end: SELECT BOXES -->

					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
			<?php include('include/footer.php'); ?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
			<?php include('include/setting.php'); ?>

			<!-- end: SETTINGS -->
		</div>
		<?php include_once("../include/body_scripts.php") ?>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>

	</html>
<?php } ?>