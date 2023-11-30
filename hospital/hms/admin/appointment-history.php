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
}

include_once("../include/appointments.php");

if (isset($_GET['action'])) {
	if ($_GET['action'] === 'cancel') {
		mysqli_execute_query($con, "update appointments set status=0 where id =?", [$_GET['id']]);
		$_SESSION['msg'] = "The appointment has been cancelled";
	} elseif ($_GET['action'] === 'accept') {
		mysqli_execute_query($con, "update appointments set status=2 where id =?", [$_GET['id']]);
		$_SESSION['msg'] = "The appointment has been confirmed";
	}
}
?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
	<?php
	$pageName = 'Appointment History';
	include('../include/new-header.php');
	?>

</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

			<?php include('./include/nav.php'); ?>

			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->

				<?php include('../include/navbar.php'); ?>

				<!-- / Navbar -->

				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Content -->
					<div class="container-xxl flex-grow-1 container-p-y">
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>

						<div class="col-xl">

							<div class="card mb-4">
								<div class="card-body">

									<div class="card">
										<div class="table-responsive text-nowrap">
											<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
												<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
											<table class="table table-hover" id="sample-table-1">
												<thead>
													<tr>
														<th class="center">#</th>
														<th class="hidden-xs">Doctor Name</th>
														<th>Patient Name</th>
														<th>Specialization</th>
														<th>Fees</th>
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
															<td><?php echo $row['date']; ?> / <?php echo $row['time']; ?></td>
															<td><?php echo $row['postingDate']; ?></td>
															<td><?php echo getAppointmentStatus($row); ?></td>
															<td>
																<div class="visible-md visible-lg hidden-sm hidden-xs">
																	<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1) && ($row['status'] == 2 || $row['status'] == 1)) {
																		if ($row['status'] == 1) { ?>
																			<a href="appointment-history.php?id=<?php echo $row['id'] ?>&action=accept" onClick="return confirm('Are you sure you want to accept this appointment?')" class="btn btn-transparent btn-xs tooltips" title="Accept Appointment" tooltip-placement="top" tooltip="Remove"><i class="bx bx-check-square"></i></a>
																		<?php } ?>
																		<a href="appointment-history.php?id=<?php echo $row['id'] ?>&action=cancel" onClick="return confirm('Are you sure you want to cancel this appointment?')" class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><i class="bx bx-trash"></i></a>
																	<?php } ?>
																</div>
																<div class="visible-xs visible-sm hidden-md hidden-lg">

																</div>
															</td>
														</tr>

													<?php
														$cnt = $cnt + 1;
													} ?>


												</tbody>
											</table>
										</div>


										<div class="content-backdrop fade"></div>
									</div>
									<!-- Content wrapper -->
								</div>
								<!-- / Layout page -->
							</div>
						</div>
						<!-- Overlay -->
						<div class="layout-overlay layout-menu-toggle"></div>
					</div>
				</div>
				<!-- Main JS -->

				<?php include('../include/links.php'); ?>

				<?php include_once("../include/body_scripts.php") ?>
				<script>
					jQuery(document).ready(function() {
						Main.init();
						FormElements.init();
					});
				</script>

			</div>

</body>



</html>