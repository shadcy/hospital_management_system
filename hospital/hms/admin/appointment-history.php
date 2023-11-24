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


?>







	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

	<head>
		<title> <?php echo $userTypeString; ?> | Appointment History</title>



		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


		<meta name="description" content="" />
		<?php include('../include/csslinks.php'); ?>

	</head>

	<body>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				<!-- Menu -->
				<?php include('../include/counter.php'); ?>
				<?php include('../include/nav.php'); ?>

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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Appointment History</h4>




							<div class="col-xl">
								<div class="card mb-4">
									<div class="card-body">
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

<?php }  ?>