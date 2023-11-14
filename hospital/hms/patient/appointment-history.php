<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {
	if (isset($_GET['cancel'])) {
		mysqli_execute_query($con, "update appointments set patientStatus='0' where id = ?", [$_GET['id']]); #Done2
		$_SESSION['msg'] = "Your appointment canceled !!";
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Student | Appointment History</title>

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
									<h1 class="mainTitle">Student | Appointment History</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Student </span>
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
											$sql = mysqli_execute_query($con, "select users.fullName as docname, appointments.*  from appointments join doctors on doctors.id=appointments.doctorId join users on users.id=doctors.id where appointments.patientId = ?", [$_SESSION['id']]); #Done2
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>

												<tr>
													<td class="center"><?php echo $cnt; ?>.</td>
													<td class="hidden-xs"><?php echo $row['docname']; ?></td>
													<td><?php echo $row['specialization']; ?></td>
													<td><?php echo $row['consultancyFees']; ?></td>
													<td><?php echo $row['date']; ?> / <?php echo $row['time']; ?>
													</td>
													<td><?php echo $row['postingDate']; ?></td>
													<td>
														<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) {
															echo "Active";
														}
														if (($row['patientStatus'] == 0) && ($row['doctorStatus'] == 1)) {
															echo "Cancelled by You";
														}

														if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 0)) {
															echo "Cancelled by Doctor";
														}
														?></td>
													<td>
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>


																<a href="appointment-history.php?id=<?php echo $row['id'] ?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment?')" class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
															<?php } else {

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
<?php } ?>