<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include("../include/config.php");
// Code for updating Password
if (isset($_POST['change'])) {
	$cno = $_SESSION['cnumber'];
	$email = $_SESSION['email'];
	$newpassword = md5($_POST['password']);
	$query = mysqli_execute_query($con, "update users set password=? where contactNumber=? and email=?", [$newpassword, $cno, $email]);
	if ($query) {
		echo "<script>alert('Password successfully updated.');</script>";
		echo "<script>window.location.href ='index.php'</script>";
	}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Password Reset</title>

	<?php include_once("../include/head_links.php");
	echo generate_head_links("3", true); ?>

	<script type="text/javascript">
		function valid() {
			if (document.passwordreset.password.value != document.passwordreset.password_again.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.passwordreset.password_again.focus();
				return false;
			}
			return true;
		}
	</script>
</head>

<body class="login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">
				<a href="../index.php">
					<h2> HMS | Patient Reset Password</h2>
				</a>
			</div>

			<div class="box-login">
				<form class="form-login" name="passwordreset" method="post" onSubmit="return valid();">
					<fieldset>
						<legend>
							Patient Reset Password
						</legend>
						<p>
							Please set your new password.<br />
							<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg'] = ""; ?></span>
						</p>

						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								<i class="fa fa-lock"></i> </span>
						</div>


						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password_again" name="password_again" placeholder="Password Again" required>
								<i class="fa fa-lock"></i> </span>
						</div>


						<div class="form-actions">

							<button type="submit" class="btn btn-primary pull-right" name="change">
								Change <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							Already have an account?
							<a href="index.php">
								Log-in
							</a>
						</div>
					</fieldset>
				</form>

				<div class="copyright">
					<span class="text-bold text-uppercase">IITB Hospital Management System</span>
				</div>

			</div>

		</div>
	</div>

	<?php include_once("../include/login_body_scripts.php"); ?>

	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>
<!-- end: BODY -->

</html>