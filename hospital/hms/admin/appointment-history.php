<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Admin->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {
	try {
?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<title>Patients | Appointment History</title>

			<?php include_once("../include/head_links.php");
			echo generate_head_links(); ?>
		</head>

		<body>
			<div id="app">
				<?php include('include/sidebar.php'); ?>
				<div class="app-content">


					<?php include('../include/header.php'); ?>
					<!-- end: TOP NAVBAR -->
					<div class="main-content">
						<div class="wrap-content container" id="container">
							<!-- start: PAGE TITLE -->
							<section id="page-title">
								<div class="row">
									<div class="col-sm-8">
										<h1 class="mainTitle">Patients | Appointment History</h1>
									</div>
									<ol class="breadcrumb">
										<li>
											<span>Patients </span>
										</li>
										<li class="active">
											<span>Appointment History</span>
										</li>
									</ol>
								</div>
							</section>
							<!-- end: PAGE TITLE -->
							<!-- start: BASIC EXAMPLE -->
							<div class="container-fluid container-fullw bg-white">


								<div class="row">
									<div class="col-md-12">

										<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
											<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
										<table class="table table-hover" id="sample-table-1">
											<thead>
												<tr>
													<th class="center">#</th>
													<th class="hidden-xs">Doctor Name</th>
													<th>Patient Name</th>
													<th>Specialization</th>
													<th>Consultancy Fee</th>
													<th>Appointment Date / Time </th>
													<th>Appointment Creation Date </th>
													<th>Current Status</th>
													<th>Action</th>

												</tr>
											</thead>
											<tbody>
												<?php
												$sql = mysqli_query($con, "select doctor_users.fullName as docname, users.fullName as pname, specializations.name as doctorSpecialization, appointments.*, doctors.fees as consultancyFees from appointments join users on users.id=appointments.patientId join doctors on doctors.id=appointments.doctorId join specializations on specializations.id=doctors.specializationId join users as doctor_users on doctor_users.id=doctors.id;"); #Done2
												$cnt = 1;
												while ($row = mysqli_fetch_array($sql)) {
												?>

													<tr>
														<td class="center"><?php echo $cnt; ?>.</td>
														<td class="hidden-xs"><?php echo $row['docname']; ?></td>
														<td class="hidden-xs"><?php echo $row['pname']; ?></td>
														<td><?php echo $row['doctorSpecialization']; ?></td>
														<td><?php echo $row['consultancyFees']; ?></td>
														<td><?php echo $row['date']; ?> / <?php echo
																							$row['time']; ?>
														</td>
														<td><?php echo $row['postingDate']; ?></td>
														<td>
															<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) {
																echo "Active";
															}
															if (($row['patientStatus'] == 0) && ($row['doctorStatus'] == 1)) {
																echo "Cancel by Patient";
															}
															if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 0)) {
																echo "Cancel by Doctor";
															}



															?></td>
														<td>
															<div class="visible-md visible-lg hidden-sm hidden-xs">
																<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) {


																	echo "No Action yet";
																} else {

																	echo "Canceled";
																} ?>
															</div>
															<div class="visible-xs visible-sm hidden-md hidden-lg">
																<div class="btn-group" dropdown is-open="status.isopen">
																	<button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
																		<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
																	</button>
																	<ul class="dropdown-menu pull-right dropdown-light" role="menu">
																		<li>
																			<a href="#">
																				Edit
																			</a>
																		</li>
																		<li>
																			<a href="#">
																				Share
																			</a>
																		</li>
																		<li>
																			<a href="#">
																				Remove
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</td>
													</tr>

												<?php
													$cnt = $cnt + 1;
												} ?>


											</tbody>
										</table>
									</div>
								</div>
							</div>

							<!-- end: BASIC EXAMPLE -->
							<!-- end: SELECT BOXES -->

						</div>
					</div>
				</div>
				<!-- start: FOOTER -->
				<?php include('../include/footer.php'); ?>
				<!-- end: FOOTER -->

				<!-- start: SETTINGS -->
				<?php include('../include/setting.php'); ?>

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
<?php } catch (Exception $exp) {
		echo $exp;
	}
} ?>