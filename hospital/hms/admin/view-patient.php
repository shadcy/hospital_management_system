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
	if (isset($_POST['submit'])) {

		$vid = $_GET['viewid'];
		$bp = $_POST['bp'];
		$bs = $_POST['bs'];
		$weight = $_POST['weight'];
		$temp = $_POST['temp'];
		$pres = $_POST['pres'];


		$query = mysqli_execute_query($con, "insert medical_history(patientID,bloodPressure,bloodSugar,weight,temperature,medicalPrescription)value(?,?,?,?,?,?)", [$vid, $bp, $bs, $weight, $temp, $pres]);
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
		<title>Doctor | Manage Patients</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links("1"); ?>
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
									<h1 class="mainTitle">Doctor | Manage Patients</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Doctor</span>
									</li>
									<li class="active">
										<span>Manage Patients</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
									<?php
									$vid = $_GET['viewid'];
									$ret = mysqli_query($con, "select * from tblpatient where ID='$vid'");
									$cnt = 1;
									while ($row = mysqli_fetch_array($ret)) {
									?>
										<table border="1" class="table table-bordered">
											<tr align="center">
												<td colspan="4" style="font-size:20px;color:blue">
													Patient Details</td>
											</tr>

											<tr>
												<th scope>Patient Name</th>
												<td><?php echo $row['PatientName']; ?></td>
												<th scope>Patient Email</th>
												<td><?php echo $row['PatientEmail']; ?></td>
											</tr>
											<tr>
												<th scope>Patient Mobile Number</th>
												<td><?php echo $row['PatientContno']; ?></td>
												<th>Patient Address</th>
												<td><?php echo $row['PatientAdd']; ?></td>
											</tr>
											<tr>
												<th>Patient Gender</th>
												<td><?php echo $row['PatientGender']; ?></td>
												<th>Patient Age</th>
												<td><?php echo $row['PatientAge']; ?></td>
											</tr>
											<tr>

												<th>Patient Medical History(if any)</th>
												<td><?php echo $row['PatientMedhis']; ?></td>
												<th>Patient Reg Date</th>
												<td><?php echo $row['CreationDate']; ?></td>
											</tr>

										<?php } ?>
										</table>
										<?php

										$ret = mysqli_query($con, "select * from tblmedicalhistory  where PatientID='$vid'");



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
													<td><?php echo $row['BloodPressure']; ?></td>
													<td><?php echo $row['Weight']; ?></td>
													<td><?php echo $row['BloodSugar']; ?></td>
													<td><?php echo $row['Temperature']; ?></td>
													<td><?php echo $row['MedicalPres']; ?></td>
													<td><?php echo $row['CreationDate']; ?></td>
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