<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;
$userType = UserTypeEnum::Doctor->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());
	if (isset($_POST['submit'])) {
		$cpass = md5($_POST['cpass']);
		$did = $_SESSION['id'];
		$sql = mysqli_execute_query($con, "SELECT 1 FROM users where password=? && id=?", [$cpass, $did]);
		$num = mysqli_num_rows($sql);
		if ($num > 0) {
			$npass = md5($_POST['npass']);
			$con = mysqli_execute_query($con, "update users set password=? where id=?", [$npass, $did]);
			$_SESSION['msg1'] = "Password Changed Successfully !!";
		} else {
			$_SESSION['msg1'] = "Old Password not match !!";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctor | change Password</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>
		<script type="text/javascript">
			function valid() {
				if (document.chngpwd.cpass.value == "") {
					alert("Current Password Filed is Empty !!");
					document.chngpwd.cpass.focus();
					return false;
				} else if (document.chngpwd.npass.value == "") {
					alert("New Password Filed is Empty !!");
					document.chngpwd.npass.focus();
					return false;
				} else if (document.chngpwd.cfpass.value == "") {
					alert("Confirm Password Filed is Empty !!");
					document.chngpwd.cfpass.focus();
					return false;
				} else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
					alert("Password and Confirm Password Field do not match  !!");
					document.chngpwd.cfpass.focus();
					return false;
				}
				return true;
			}
		</script>

	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">

				<?php include('../include/header.php'); ?>

				<!-- end: TOP NAVBAR -->
				<?php include_once("../templates/change-password.php"); ?>
			</div>
			<!-- start: FOOTER -->
			<?php include('../include/footer.php'); ?>
			<!-- end: FOOTER -->

			<!-- start: SETTINGS -->
			<?php include('../include/setting.php'); ?>
			<>
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