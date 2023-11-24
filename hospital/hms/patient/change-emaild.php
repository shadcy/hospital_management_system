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

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$sql = mysqli_execute_query($con, "Update users set email=? where id=?", [$email, $_SESSION['id']]); #Done
	if ($sql) {
		$msg = "Your email was updated successfully";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Student | Edit Profile</title>

	<?php include_once("../include/head_links.php");
	echo generate_head_links(); ?>



</head>

<body>
	<div id="app">
		<?php include('include/sidebar.php'); ?>
		<div class="app-content">

			<?php include('../include/header.php'); ?>

			<!-- end: TOP NAVBAR -->
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Student | Edit Profile</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Student</span>
								</li>
								<li class="active">
									<span>Edit Profile</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<h5 style="color: green; font-size:18px; ">
									<?php if ($msg) {
										echo htmlentities($msg);
									} ?> </h5>
								<div class="row margin-top-30">
									<div class="col-lg-8 col-md-12">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h5 class="panel-title">Edit Profile</h5>
											</div>
											<div class="panel-body">
												<form name="registration" id="updatemail" method="post">
													<div class="form-group">
														<label for="fess">
															User Email
														</label>
														<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="Email" required>

														<span id="user-availability-status1" style="font-size:12px;"></span>
													</div>







													<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
														Update
													</button>
												</form>

											</div>
										</div>
									</div>

								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="panel panel-white">


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
	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>

</body>

</html>