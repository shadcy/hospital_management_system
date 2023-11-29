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
}

$did = intval($_GET['id']); // get doctor id
if (isset($_POST['submit'])) {
	$docspecialization = $_POST['Doctorspecialization'];
	$docname = $_POST['docname'];
	$docaddress = $_POST['clinicaddress'];
	$docfees = $_POST['docfees'];
	$doccontactno = $_POST['doccontact'];
	$personalcontactno = $_POST['personalcontact'];
	$docemail = $_POST['docemail']; #Not allowing email to be changed atm, add back if needed

	$msg = "Doctor Details updated Successfully";

	mysqli_begin_transaction($con);
	try {
		mysqli_execute_query($con, "Update doctors set specializationId=?,fees=?,contactNumber=? where id=?", [$docspecialization, $docfees, $doccontactno, $did]);
		mysqli_execute_query($con, "Update users set address=?,fullName=?,contactNumber=? where id=?", [$docaddress, $docname, $personalcontactno, $did]);

		/* If code reaches this point without errors then commit the data in the database */
		mysqli_commit($con);
	} catch (mysqli_sql_exception $exception) {
		mysqli_rollback($con);
		$msg = "There was an issue with the changes. Please try again.";
		throw $exception;
	}
}
?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">


<head>
	<?php
	$pageName = 'Edit Doctor';
	include('../include/new-header.php');
	?>

</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

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
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>

						<div class="row">


							<h5 style="color: green; font-size:15px; ">
								<?php if ($msg) {
									echo htmlentities($msg);
								} ?> </h5>


							<?php $sql = mysqli_execute_query($con, "select doctors.*,specializations.name as specName, users.fullName, users.email, users.address, users.contactNumber as personalNumber from doctors join users on users.id = doctors.id join specializations on specializations.id = doctors.specializationId where doctors.id=?", [$did]);
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
									<br>
									<div class="form-group">
										<label for="doctorname">
											Doctor Name
										</label>
										<input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['fullName']); ?>">
									</div>

									<br>
									<div class="form-group">
										<label for="address">
											Doctor Clinic Address
										</label>
										<textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
									</div>
									<br>
									<div class="form-group">
										<label for="fess">
											Doctor Consultancy Fees
										</label>
										<input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['fees']); ?>">
									</div>
									<br>
									<div class="form-group">
										<label for="fess">
											Doctor Contact no
										</label>
										<input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactNumber']); ?>">
									</div>
									<br>
									<div class="form-group">
										<label for="fess">
											Personal Contact no
										</label>
										<input type="text" name="personalcontact" class="form-control" required="required" value="<?php echo htmlentities($data['personalNumber']); ?>">
									</div>
									<br>
									<div class="form-group">
										<label for="fess">
											Doctor Email
										</label>
										<input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
									</div>



									<br>
									<button type="submit" name="submit" class="btn btn-o btn-primary">
										Update
									</button>
									<br>

								</form>



							<?php } ?>


							<div class="content-backdrop fade"></div>
						</div>
						<!-- Content wrapper -->
					</div>
					<!-- / Layout page -->
				</div>

				<!-- Overlay -->
				<div class="layout-overlay layout-menu-toggle"></div>
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


</body>



</html>