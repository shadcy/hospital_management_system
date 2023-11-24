<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;
$pageHref = basename(__FILE__);

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {
	if (isset($_POST['submit'])) {
		$docspecialization = $_POST['Doctorspecialization'];
		$docname = $_POST['docname'];
		$docaddress = $_POST['clinicaddress'];
		$docfees = $_POST['docfees'];
		$doccontactno = $_POST['doccontact'];
		$docemail = $_POST['docemail'];

		mysqli_begin_transaction($con);
		try {
			mysqli_execute_query($con, "Update doctors set specilizationId=?,fees=?,contactNumber=? where id=?", [$docspecialization, $docfees, $doccontactno, $did]);
			mysqli_execute_query($con, "Update users set address=?,fullName=?,contactNumber=? where id=?", [$docaddress, $docname, $personalcontactno, $did]);

			/* If code reaches this point without errors then commit the data in the database */
			mysqli_commit($con);
			$msg = "Doctor Details updated Successfully";
		} catch (mysqli_sql_exception $exception) {
			mysqli_rollback($con);
			$msg = "There was an issue with the changes. Please try again.";
		}
		/* $sql = mysqli_query($con, "Update doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno' where id='" . $_SESSION['id'] . "'");
		if ($sql) {
			echo "<script>alert('Doctor Details updated Successfully');</script>";
		} */
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
				<?php include('../include/header.php'); ?>
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
													$did = $_SESSION['id'];
													$sql = mysqli_execute_query($con, "select doctors.*, specializations.name as specName, users.fullName, users.email, users.address, users.contactNumber as personalNumber from doctors join users on users.id = doctors.id join specializations on specializations.id = doctors.specializationId where id=?", [$did]);
													while ($data = mysqli_fetch_array($sql)) {
													?>
														<h4><?php echo htmlentities($data['fullName']); ?>'s Profile</h4>
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
																	<option value="<?php echo htmlentities($data['specializationId']); ?>">
																		<?php echo htmlentities($data['specName']); ?></option>
																	<?php $ret = mysqli_query($con, "select * from specializations;");
																	while ($row = mysqli_fetch_array($ret)) {
																	?>
																		<option value="<?php echo htmlentities($row['id']); ?>">
																			<?php echo htmlentities($row['name']); ?>
																		</option>
																	<?php } ?>

																</select>
															</div>

															<div class="form-group">
																<label for="doctorname">
																	Doctor Name
																</label>
																<input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['fullName']); ?>">
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
																<input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['fees']); ?>">
															</div>

															<div class="form-group">
																<label for="fess">
																	Doctor Contact no
																</label>
																<input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactNumber']); ?>">
															</div>

															<div class="form-group">
																<label for="fess">
																	Personal Contact no
																</label>
																<input type="text" name="personalcontact" class="form-control" required="required" value="<?php echo htmlentities($data['personalNumber']); ?>">
															</div>

															<div class="form-group">
																<label for="fess">
																	Doctor Email
																</label>
																<input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
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