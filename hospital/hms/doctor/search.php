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

?>









	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

	<head>
		<title> <?php echo $userTypeString; ?> | Search Patient</title>



		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


		<meta name="description" content="" />
		<?php include('../include/csslinks.php'); ?>

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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span>Search Patient</h4>

							<div class="col-xl">
								<div class="card mb-4">
									<div class="card-body">

										<div class="row">
											<div class="col-md-12">
												<form role="form" method="post" name="search">

													<div class="form-group">
														<label for="doctorname">
															Search by Name/Mobile No.
														</label>
														<input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
													</div>
													<br>
													<button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
														Search
													</button>
												</form>
												<?php
												if (isset($_POST['search'])) {

													$sdata = $_POST['searchdata'];
												?>
													<h4 align="center">Result against "<?php echo $sdata; ?>" keyword </h4>

													<table class="table table-hover" id="sample-table-1">
														<thead>
															<tr>
																<th class="center">#</th>
																<th>Student Name</th>
																<th>Student Contact Number</th>
																<th>Student Gender </th>
																<th>Creation Date </th>
																<th>Updation Date </th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = mysqli_query($con, "select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
															$num = mysqli_num_rows($sql);
															if ($num > 0) {
																$cnt = 1;
																while ($row = mysqli_fetch_array($sql)) {
															?>
																	<tr>
																		<td class="center"><?php echo $cnt; ?>.</td>
																		<td class="hidden-xs"><?php echo $row['PatientName']; ?></td>
																		<td><?php echo $row['PatientContno']; ?></td>
																		<td><?php echo $row['PatientGender']; ?></td>
																		<td><?php echo $row['CreationDate']; ?></td>
																		<td><?php echo $row['UpdationDate']; ?>
																		</td>
																		<td>

																			<a href="edit-patient.php?editid=<?php echo $row['ID']; ?>"><i class="fa fa-edit"></i></a> || <a href="view-patient.php?viewid=<?php echo $row['ID']; ?>"><i class="fa fa-eye"></i></a>

																		</td>
																	</tr>
																<?php
																	$cnt = $cnt + 1;
																}
															} else { ?>
																<tr>
																	<td colspan="8"> No record found against this search</td>

																</tr>

														<?php }
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