<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {

	if (isset($_GET['cancel'])) {
		mysqli_execute_query($con, "update appointments set doctorStatus=0 where id =?", [$_GET['id']]);
		$_SESSION['msg'] = "Appointment canceled !!";
	}
?>

	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

	<head>
		<title> <?php echo $userTypeString; ?> | Generate Pink Slip</title>



		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


		<meta name="description" content="" />
		<?php include('../include/csslinks.php'); ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
		<!-- <link rel="stylesheet" href="./style.css"> -->

	</head>

	<body>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				<!-- Menu -->
				<?php include('../include/counter.php'); ?>
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
							<!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span>Generate Pink Slip</h4> -->

							<div class="col-xl">
								<div class="card mb-4">
									<div class="card-body">






										<div class="card">
											<div class="table-responsive text-nowrap">
												<div class="row">
													<div class="col-md-12">

														<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
															<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
														<table class="table table-hover" id="sample-table-1">
															<thead>
																<tr>
																	<th class="center">#</th>
																	<th class="hidden-xs">Student's Name</th>
																	<!-- <th>Specialization</th> -->
																	<th>Consultancy Fee</th>
																	<th>Appointment Date / Time </th>
																	<th>Appointment Creation Date </th>
																	<th>Current Status</th>
																	<th>Action</th>

																</tr>
															</thead>
															<tbody>
																<?php
																$sql = mysqli_execute_query($con, "select users.fullName as fname,appointments.*  from appointments join users on users.id=appointments.patientId where appointments.doctorId=?", [$_SESSION['id']]);
																$cnt = 1;
																while ($row = mysqli_fetch_array($sql)) {
																?>

																	<tr>
																		<td class="center"><?php echo $cnt; ?>.</td>
																		<td class="hidden-xs"><?php echo $row['fname']; ?></td>
																		<!-- <td><php echo $row['specialization'];></td> -->
																		<td><?php echo $row['consultancyFees']; ?></td>
																		<td><?php echo $row['date']; ?> / <?php echo
																											$row['time']; ?>
																		</td>
																		<td><?php echo $row['postingDate']; ?></td>
																		<td>
																			<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) {
																				echo "Active";
																			} elseif (($row['patientStatus'] == 0) && ($row['doctorStatus'] == 1)) {
																				echo "Cancel by Patient";
																			} elseif ($row['doctorStatus'] == 0) {
																				echo "Cancel by you";
																			}



																			?></td>
																		<td>
																			<div class="visible-md visible-lg hidden-sm hidden-xs">
																				<?php if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) { ?>


																					<a href="appointment-history.php?id=<?php echo $row['id'] ?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')" class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><i class="bx bx-trash"></i></a>
																				<?php } else {

																					echo "Canceled";
																				} ?>
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



												<div class="content-backdrop fade"></div>

												<!-- Content wrapper -->
											</div>
										</div>
									</div>
								</div>
								<!-- / Layout page -->


								<!-- Overlay -->
								<div class="layout-overlay layout-menu-toggle"></div>
							</div>

						</div>
					</div>
				</div>
				<!-- Main JS -->
				<!-- start: PDF GEN JAVASCRIPTS -->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
				<!-- partial -->
				<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
				<script src="./PinkSlip_Gen/script.js"></script>

				<?php include('../include/links.php'); ?>

				<script>
					jQuery(document).ready(function() {
						Main.init();
						FormElements.init();
					});
				</script>


	</body>



	</html>



	</var>

<?php } ?>