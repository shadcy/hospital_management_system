<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
include_once("../include/check_login_and_perms.php");

$userType = UserTypeEnum::Admin->value;

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
		$password = md5($_POST['npass']);
		$newUserType = UserTypeEnum::Doctor->value;
		try {
			$sql = mysqli_execute_query($con, "insert into users (type,email,password,fullName,contactNumber,address) values({$newUserType},?,?,?,?,?)", [$docemail, $password, $docname, $doccontactno, $docaddress]);

			if ($sql) {
				$sql = mysqli_execute_query($con, "insert into doctors (id,specializationId,fees,contactNumber,nonce) values(?,?,?,?,?)", [mysqli_insert_id($con), $docspecialization, $docfees, $doccontactno, random_bytes(48)]);
				if ($sql) {
					echo "<script>alert('Doctor info added successfully');</script>";
					echo "<script>window.location.href ='manage-doctors.php'</script>";
				}
			} else {
				echo "<script>alert('There was an issue while creating the user for the doctor.');</script>";
				echo "<script>window.location.href ='add-doctor.php'</script>";
			}
		} catch (mysqli_sql_exception $exp) {
			if ($exp->getCode() === 1062) {
				echo "<script>alert('A user with that email already exists.');</script>";
			} else {
				echo "<script>alert('There was an issue while creating the user for the doctor.');</script>";
			}
			echo "<script>window.location.href ='add-doctor.php'</script>";
		}
	}
?>



	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">
	<script type="text/javascript">
		function valid() {
			if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.adddoc.cfpass.focus();
				return false;
			}
			return true;
		}

		function checkemailAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'emailid=' + $("#docemail").val(),
				type: "POST",
				success: function(data) {
					$("#email-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>

	<head>
		<title> <?php echo $userTypeString; ?> | Add Doctor</title>



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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Add doctor</h4>




							<div class="row">


								<?php include_once("../templates/add-doctor.php") ?>


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