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

if (isset($_POST['submit'])) {

	$vid = $_GET['viewid'];
	$bp = $_POST['bp'];
	$bs = $_POST['bs'];
	$weight = $_POST['weight'];
	$temp = $_POST['temp'];
	$pres = $_POST['pres'];


	$query = mysqli_execute_query($con, "insert into medical_history(patientId,bloodPressure,bloodSugar,weight,temperature,medicalPrescription) value(?,?,?,?,?,?)", [$vid, $bp, $bs, $weight, $temp, $pres]);
	if ($query) {
		echo '<script>alert("Medicle history has been added.")</script>';
		echo "<script>window.location.href ='manage-patient.php'</script>";
	} else {
		echo '<script>alert("Something Went Wrong. Please try again")</script>';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Students | Medical History</title>

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
									<span>Medical History</span>
								</li>
							</ol>
						</div>
					</section>
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<h5 class="over-title margin-bottom-15">Users <span class="text-bold">Medical History</span></h5>
								<?php
								$vid = $_GET['viewid'];
								$ret = mysqli_execute_query($con, "select * from users where id=?", [$vid]);
								$cnt = 1;
								while ($row = mysqli_fetch_array($ret)) {
								?>
									<table border="1" class="table table-bordered">
										<tr align="center">
											<td colspan="4" style="font-size:20px;color:blue">
												Patient Details</td>
										</tr>

										<tr>
											<th scope>Student Name</th>
											<td><?php echo $row['fullName']; ?></td>
											<th scope>Patient Email</th>
											<td><?php echo $row['email']; ?></td>
										</tr>
										<tr>
											<th scope>Student Mobile Number</th>
											<td><?php echo $row['contactNumber']; ?></td>
											<th>Student Address</th>
											<td><?php echo $row['address']; ?></td>
										</tr>
										<tr>
											<th>Student Gender</th>
											<td><?php echo $row['gender']; ?></td>
											<th>Student Age</th>
											<td><?php echo $row['age']; ?></td>
										</tr>
										<tr>
											<th>Student Reg Date</th>
											<td><?php echo $row['registrationDate']; ?></td>
										</tr>

									<?php } ?>
									</table>
									<?php

									$ret = mysqli_execute_query($con, "select * from medical_history where patientId=?", [$vid]);
									?>
									<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<tr align="center">
											<th colspan="8">Medical History</th>
										</tr>
										<tr>
											<th>#</th>
											<th>Blood Pressure</th>
											<th>Weight</th>
											<th>Blood Sugar</th>
											<th>Body Temprature</th>
											<th>Medical Prescription</th>
											<th>Visit Date</th>
										</tr>
										<?php
										while ($row = mysqli_fetch_array($ret)) {
										?>
											<tr>
												<td><?php echo $cnt; ?></td>
												<td><?php echo $row['bloodPressure']; ?></td>
												<td><?php echo $row['weight']; ?></td>
												<td><?php echo $row['bloodSugar']; ?></td>
												<td><?php echo $row['temperature']; ?></td>
												<td><?php echo $row['medicalPrescription']; ?></td>
												<td><?php echo $row['creationDate']; ?></td>
											</tr>
										<?php $cnt = $cnt + 1;
										} ?>
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