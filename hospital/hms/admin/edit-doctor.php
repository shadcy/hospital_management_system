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

	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">


	<head>
		<title> <?php echo $userTypeString; ?> | Edit Doctor</title>



		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


		<meta name="description" content="" />
		<?php include('../include/csslinks.php'); ?>

	</head>

	<body>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				<!-- Menu -->
				<?php include('../include/counter.php'); ?>
				<?php include('../include/nav.php'); ?>

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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Edit Doctor</h4>




							<div class="row">


								<?php include_once("../templates/edit-doctor.php") ?>


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

<?php } ?>