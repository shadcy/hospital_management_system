<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;
$pageHref = basename(__FILE__);

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
}

date_default_timezone_set('Asia/Kolkata'); // change according timezone
$currentTime = date('d-m-Y h:i:s A', time());
if (isset($_POST['submit'])) {
	$sql = mysqli_execute_query($con, "SELECT id FROM users where id=? AND password=?", [$_SESSION['id'], md5($_POST['cpass'])]); #Done2
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
	<title>Student | Change Password</title>

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
			<?php include_once("templates/change-password.php"); ?>
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