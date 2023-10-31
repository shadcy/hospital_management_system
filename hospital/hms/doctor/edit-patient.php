<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$eid = $_GET['editid'];
		$patname = $_POST['patname'];
		$patcontact = $_POST['patcontact'];
		$patemail = $_POST['patemail'];
		$gender = $_POST['gender'];
		$pataddress = $_POST['pataddress'];
		$patage = $_POST['patage'];
		$medhis = $_POST['medhis'];
		$sql = mysqli_query($con, "update tblpatient set PatientName='$patname',PatientContno='$patcontact',PatientEmail='$patemail',PatientGender='$gender',PatientAdd='$pataddress',PatientAge='$patage',PatientMedhis='$medhis' where ID='$eid'");
		if ($sql) {
			echo "<script>alert('Patient info updated Successfully');</script>";
			header('location:manage-patient.php');
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctor | Add Student</title>

		<?php include_once("../include/head_links.php") ?>


	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">
				<?php include('include/header.php'); ?>

				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Student | Add Student</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Student</span>
									</li>
									<li class="active">
										<span>Add Student</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Add Student</h5>
												</div>
												<div class="panel-body">
													<form role="form" name="" method="post">
														<?php
														$eid = $_GET['editid'];
														$ret = mysqli_query($con, "select * from tblpatient where ID='$eid'");
														$cnt = 1;
														while ($row = mysqli_fetch_array($ret)) {

														?>
															<div class="form-group">
																<label for="doctorname">
																	Student Name
																</label>
																<input type="text" name="patname" class="form-control" value="<?php echo $row['PatientName']; ?>" required="true">
															</div>
															<div class="form-group">
																<label for="fess">
																	Student Contact no
																</label>
																<input type="text" name="patcontact" class="form-control" value="<?php echo $row['PatientContno']; ?>" required="true" maxlength="10" pattern="[0-9]+">
															</div>
															<div class="form-group">
																<label for="fess">
																	Student Email
																</label>
																<input type="email" id="patemail" name="patemail" class="form-control" value="<?php echo $row['PatientEmail']; ?>" readonly='true'>
																<span id="email-availability-status"></span>
															</div>
															<div class="form-group">
																<label class="control-label">Gender: </label>
																<?php if ($row['Gender'] == "Female") { ?>
																	<input type="radio" name="gender" id="gender" value="Female" checked="true">Female
																	<input type="radio" name="gender" id="gender" value="male">Male
																<?php } else { ?>
																	<label>
																		<input type="radio" name="gender" id="gender" value="Male" checked="true">Male
																		<input type="radio" name="gender" id="gender" value="Female">Female
																	</label>
																<?php } ?>
															</div>
															<div class="form-group">
																<label for="address">
																	Patient Address
																</label>
																<textarea name="pataddress" class="form-control" required="true"><?php echo $row['PatientAdd']; ?></textarea>
															</div>
															<div class="form-group">
																<label for="fess">
																	Patient Age
																</label>
																<input type="text" name="patage" class="form-control" value="<?php echo $row['PatientAge']; ?>" required="true">
															</div>
															<div class="form-group">
																<label for="fess">
																	Medical History
																</label>
																<textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"><?php echo $row['PatientMedhis']; ?></textarea>
															</div>
															<div class="form-group">
																<label for="fess">
																	Creation Date
																</label>
																<input type="text" class="form-control" value="<?php echo $row['CreationDate']; ?>" readonly='true'>
															</div>
														<?php } ?>
														<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
															Update
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="panel panel-white">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- start: FOOTER -->
		<?php include('include/footer.php'); ?>
		<!-- end: FOOTER -->

		<!-- start: SETTINGS -->
		<?php include('include/setting.php'); ?>

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