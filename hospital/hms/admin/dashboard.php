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
		<title>Admin | Dashboard</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>
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
									<h1 class="mainTitle">Admin | Dashboard</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
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
											<h2 class="StepTitle">Manage Users</h2>

											<p class="links cl-effect-1">
												<a href="manage-users.php" style="font-weight:bold; color: #1AA7EC;">
													<?php $result = mysqli_query($con, "SELECT COUNT(*) as userCount FROM users;");
													$row = mysqli_fetch_array($result); {
													?>
														Total Users :<?php echo htmlentities($row['userCount']);
																	} ?>
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Manage Doctors</h2>

											<p class="cl-effect-1">
												<a href="manage-doctors.php">
													<?php $result = mysqli_query($con, "SELECT COUNT(*) as doctorCount FROM doctors;");
													$row = mysqli_fetch_array($result); {
													?>
														Total Doctors :<?php echo htmlentities($row['doctorCount']);
																	} ?>
												</a>

											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> Appointments</h2>

											<p class="links cl-effect-1">
												<a href="book-appointment.php">
													<a href="appointment-history.php">
														<?php $sql = mysqli_query($con, "SELECT COUNT(*) as appointmentCount FROM appointments;");
														$row = mysqli_fetch_array($result); {
														?>
															Total Appointments :<?php echo htmlentities($row['appointmentCount']);
																			} ?>
													</a>
												</a>
											</p>
										</div>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="ti-files fa-1x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> New Queries</h2>

											<p class="links cl-effect-1">
												<a href="book-appointment.php">
													<a href="unread-queries.php">
														<?php
														$sql = mysqli_query($con, "SELECT COUNT(*) as queryCount FROM contact_us where isRead is 0;");
														$row = mysqli_fetch_array($result);
														?>
														Total New Queries :<?php echo htmlentities($row['queryCount']);   ?>
													</a>
												</a>
											</p>
										</div>
									</div>
								</div>


								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-user fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Appointment History</h2>

											<p class="links cl-effect-1">
												<a href="appointment-history.php">
													History
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-file fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Unread Query</h2>

											<p class="links cl-effect-1">
												<a href="unread-queries.php">
													check
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-book fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> Read Query</h2>

											<p class="links cl-effect-1">
												<a href="read-query.php">
													Read
												</a>
											</p>
										</div>
									</div>
								</div>




								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Doctor Logs</h2>

											<p class="links cl-effect-1">
												<a href="doctor-logs.php">
													Cheak
												</a>
											</p>
										</div>
									</div>
								</div>




								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Patient Logs</h2>

											<p class="links cl-effect-1">
												<a href="user-logs.php">
													Check
												</a>
											</p>
										</div>
									</div>
								</div>





								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-search fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Patient search</h2>

											<p class="links cl-effect-1">
												<a href="patient-search.php">
													Search
												</a>
											</p>
										</div>
									</div>
								</div>





								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-reddit fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">B/W Dates Report</h2>

											<p class="links cl-effect-1">
												<a href="between-dates-reports.php">
													Check
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-file fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">About Us</h2>

											<p class="links cl-effect-1">
												<a href="about-us.php">
													Check
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-phone fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Contact Us</h2>

											<p class="links cl-effect-1">
												<a href="contact.php">
													Check
												</a>
											</p>
										</div>
									</div>
								</div>



								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center" style="border: 2px solid #1AA7EC;">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-user fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Admin Profile</h2>

											<p class="links cl-effect-1">
												<a href="logout.php">
													Check
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