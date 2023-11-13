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
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Reg Users | View Medical History</title>

	<?php include_once("../include/head_links.php");
	echo generate_head_links(); ?>

</head>

<body>
	<div id="app">
		<?php include('include/sidebar.php'); ?>
		<div class="app-content">
			<?php include('../include/header.php'); ?>
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Students | Medical History</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Users</span>
								</li>
								<li class="active">
									<span>View Medical History</span>
								</li>
							</ol>
						</div>
					</section>
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<h5 class="over-title margin-bottom-15">View <span class="text-bold">Medical History</span></h5>

								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th>Creation Date</th>
											<th>Blood Pressure</th>
											<th>Blood Sugar</th>
											<th>Weight</th>
											<th>Temperature</th>
											<th>Medical Prescription</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = mysqli_execute_query($con, "select * from medical_history where patientId.id=?", [$_SESSION['id']]);
										$cnt = 1;
										while ($row = mysqli_fetch_array($sql)) {
										?>
											<tr>
												<td class="center"><?php echo $cnt; ?>.</td>
												<td><?php echo $row['creationDate']; ?></td>
												<td><?php echo $row['bloodPressure']; ?></td>
												<td><?php echo $row['bloodSugar']; ?></td>
												<td><?php echo $row['weight']; ?></td>
												<td><?php echo $row['temperature']; ?></td>
												<td><?php echo $row['medicalPrescription']; ?></td>
												<td>
													<a href="view-medhistory.php?viewid=<?php echo $row['id']; ?>"><i class="fa fa-eye"></i></a>
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
				</div>
			</div>
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
	<?php include_once("../include/body_scripts.php"); ?>
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