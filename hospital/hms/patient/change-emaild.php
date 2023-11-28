<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;

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



$userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">


<head>
	<title> <?php echo $userTypeString; ?> | Profile</title>



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
			<?php include_once("./include/nav.php"); ?>


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
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Student/</span>Edit Profile</h4>




						<div class="col-xl">
							<div class="card mb-4">
								<div class="card-body">


									<div class="row">
										<div class="col-md-12">

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




																<br>


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

<?php  ?>