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

	if (isset($_POST['submit'])) {
		$docid = $_SESSION['id'];
		$patname = $_POST['patname'];
		$patcontact = $_POST['patcontact'];
		$patemail = $_POST['patemail'];
		$gender = $_POST['gender'];
		$pataddress = $_POST['pataddress'];
		$patage = $_POST['patage'];
		$medhis = $_POST['medhis'];
		$sql = mysqli_query($con, "insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
		if ($sql) {
			echo "<script>alert('Patient info added Successfully');</script>";
			header('location:add-patient.php');
		}
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








										<div class="panel-heading">
											<h5 class="panel-title">Add Student</h5>
										</div>
										<div class="panel-body">
											<form role="form" name="" method="post">

												<div class="form-group">
													<label for="doctorname">
														Student Name
													</label>
													<input type="text" name="patname" class="form-control" placeholder="Enter Patient Name" required="true">
												</div>
												<br>
												<div class="form-group">
													<label for="fess">
														Student Contact no
													</label>
													<input type="text" name="patcontact" class="form-control" placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
												</div><br>
												<div class="form-group">
													<label for="fess">
														Student Email
													</label>
													<input type="email" id="patemail" name="patemail" class="form-control" placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
													<span id="user-availability-status1" style="font-size:12px;"></span>
												</div><br>
												<div class="form-group">
													<label class="block">
														Gender
													</label>
													<br><br>
													<div class="clip-radio radio-primary">
														<input type="radio" id="rg-female" name="gender" value="female">
														<label for="rg-female">
															Female
														</label>
														<input type="radio" id="rg-male" name="gender" value="male">
														<label for="rg-male">
															Male
														</label>
													</div>
												</div><br>
												<div class="form-group">
													<label for="address">
														Student Address
													</label>
													<textarea name="pataddress" class="form-control" placeholder="Enter Patient Address" required="true"></textarea>
												</div>
												<div class="form-group">
													<label for="fess">
														Student Age
													</label>
													<input type="text" name="patage" class="form-control" placeholder="Enter Patient Age" required="true">
												</div><br>
												<div class="form-group">
													<label for="fess">
														Medical History
													</label>
													<textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
												</div><br>

												<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
													Add
												</button><br>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="panel panel-white">
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