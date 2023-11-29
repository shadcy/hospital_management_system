<?php
include_once('../hms/include/config.php');
if (!empty($_POST["emailid"])) {
	$email = $_POST["emailid"];

	$result = mysqli_execute_query($con, "SELECT 1 FROM users WHERE email=?", [$email]); #https://stackoverflow.com/questions/4253960/sql-how-to-properly-check-if-a-record-exists
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		echo json_encode([
			'html' => "<span style='color:red'> Email already exists .</span>",
			'valid' => false
		]);
	} else {
		echo json_encode([
			'html' => "<span style='color:green'> Email available for Registration .</span>",
			'valid' => true
		]);
	}
}
