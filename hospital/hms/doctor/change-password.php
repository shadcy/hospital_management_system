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
}



date_default_timezone_set('Asia/Kolkata'); // change according timezone
$currentTime = date('d-m-Y h:i:s A', time());
$errMsg = "";

if (isset($_POST['submit'])) {
	$sql = mysqli_execute_query($con, "SELECT 1 FROM users where id=? AND password=?", [$_SESSION['id'], md5($_POST['cpass'])]); #Done2
	$num = mysqli_num_rows($sql);
	if ($num > 0) {
		$ret = mysqli_execute_query($con, "update users set password=? where id=?", [md5($_POST['npass']), $_SESSION['id']]);
		echo "<script>alert('Password changed successfully');</script>";
		echo "<script>window.location.href ='dashboard.php'</script>";
		exit;
	} else {
		$errMsg = "Old password does not match!";
		echo "<script>alert('Old password does not match');</script>";
	}
}
?>

<?php include_once("../templates/change-password.php"); ?>