<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {
	if (isset($_POST['submit'])) {
		$docspecialization = $_POST['Doctorspecialization'];
		$docname = $_POST['docname'];
		$docaddress = $_POST['clinicaddress'];
		$docfees = $_POST['docfees'];
		$doccontactno = $_POST['doccontact'];
		$docemail = $_POST['docemail'];
		$sql = mysqli_query($con, "Update doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno' where id='" . $_SESSION['id'] . "'");
		if ($sql) {
			echo "<script>alert('Doctor Details updated Successfully');</script>";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctr | Edit Doctor Details</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>


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
									<h1 class="mainTitle">Doctor | Edit Doctor Details</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Doctor</span>
									</li>
									<li class="active">
										<span>Edit Doctor Details</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Edit Doctor</h5>
												</div>
												<div class="panel-body">
													<?php
													$did = $_SESSION['dlogin'];
													$sql = mysqli_query($con, "select * from doctors where docEmail='$did'");
													while ($data = mysqli_fetch_array($sql)) {
													?>
														<h4><?php echo htmlentities($data['doctorName']); ?>'s Profile</h4>
														<p><b>Profile Reg. Date: </b><?php echo htmlentities($data['creationDate']); ?></p>
														<?php if ($data['updationDate']) { ?>
															<p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
														<?php } ?>
														<hr />
														<form role="form" name="adddoc" method="post" onSubmit="return valid();">
															<div class="form-group">
																<label for="DoctorSpecialization">
																	Doctor Specialization
																</label>
																<select name="Doctorspecialization" class="form-control" required="required">
																	<option value="<?php echo htmlentities($data['specilization']); ?>">
																		<?php echo htmlentities($data['specilization']); ?></option>
																	<?php $ret = mysqli_query($con, "select * from doctorspecilization");
																	while ($row = mysqli_fetch_array($ret)) {
																	?>
																		<option value="<?php echo htmlentities($row['specilization']); ?>">
																			<?php echo htmlentities($row['specilization']); ?>
																		</option>
																	<?php } ?>

																</select>
															</div>

															<div class="form-group">
																<label for="doctorname">
																	Doctor Name
																</label>
																<input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']); ?>">
															</div>


															<div class="form-group">
																<label for="address">
																	Doctor Clinic Address
																</label>
																<textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
															</div>
															<div class="form-group">
																<label for="fess">
																	Doctor Consultancy Fees
																</label>
																<input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['docFees']); ?>">
															</div>

															<div class="form-group">
																<label for="fess">
																	Doctor Contact no
																</label>
																<input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactno']); ?>">
															</div>

															<div class="form-group">
																<label for="fess">
																	Doctor Email
																</label>
																<input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['docEmail']); ?>">
															</div>




														<?php } ?>


														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Update
														</button>
														</form>
												</div>
											</div>
										</div>

									</div>
								</div>

							</div>

							<!-- end: BASIC EXAMPLE -->






							<!-- end: SELECT BOXES -->

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