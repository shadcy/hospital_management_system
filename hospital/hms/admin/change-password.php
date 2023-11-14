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



	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_POST['submit'])) {
		$sql = mysqli_execute_query($con, "SELECT 1 FROM users where id=? AND password=?", [$_SESSION['id'], md5($_POST['cpass'])]); #Done2
		$num = mysqli_num_rows($sql);
		if ($num > 0) {
			$ret = mysqli_execute_query($con, "update users set password=? where id=?", [md5($_POST['npass']), $_SESSION['id']]);
			$_SESSION['msg1'] = "Password changed successfully!!";
		} else {
			$_SESSION['msg1'] = "Old password does not match!";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Change Password</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<?php include_once("../include/head_links.php");
		echo generate_head_links("1"); ?>
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