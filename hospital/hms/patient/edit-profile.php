<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;
if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$address = $_POST['address'];
	#$city = $_POST['city'];
	$gender = $_POST['gender'];

	$sql = mysqli_execute_query($con, "Update users set fullName=?,address=?,gender=? where id=?", [$fname, $address, $gender, $_SESSION['id']]); #Done,c: removed city
	if ($sql) {
		$msg = "Your Profile updated Successfully";
	}
}
include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
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


									<div class="col-md-12">
										<p style="color: green; font-size:13px; ">
											<?php if ($msg) {
												echo htmlentities($msg);
											} ?> </p>

										<div class="panel-heading">
											<h5 class="panel-title">Edit Profile</h5>
										</div>
										<div class="panel-body">
											<?php
											$sql = mysqli_execute_query($con, "select * from users where id=?", [$_SESSION['id']]);
											while ($data = mysqli_fetch_array($sql)) {
											?>
												<h4><?php echo htmlentities($data['fullName']); ?>'s Profile</h4>
												<p><b>Profile Reg. Date: </b><?php echo htmlentities($data['registrationDate']); ?></p>
												<?php if ($data['updationDate']) { ?>
													<p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']); ?></p>
												<?php } ?>
												<hr />
												<form role="form" name="edit" method="post">


													<div class="form-group">
														<label for="fname">
															User Name
														</label>
														<input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']); ?>">
													</div>
													<br>

													<div class="form-group">
														<label for="address">
															Address
														</label>
														<textarea name="address" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
													</div>
													<br>
													<!-- <div class="form-group">
															<label for="city">
																City
															</label>
															<input type="text" name="city" class="form-control" required="required" value="<?php /*echo htmlentities($data['city']);*/ ?>">
														</div> -->

													<div class="form-group">
														<label for="gender">
															Gender
														</label>

														<select name="gender" class="form-control" required="required">
															<option value="<?php echo htmlentities($data['gender']); ?>"><?php echo htmlentities($data['gender']); ?></option>
															<option value="male">Male</option>
															<option value="female">Female</option>
															<option value="other">Other</option>
														</select>

													</div>
													<br>
													<div class="form-group">
														<label for="fess">
															Student Email
														</label>
														<input type="email" name="uemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
														<a href="change-emaild.php">Update your email id</a>
													</div>


													<br>




													<button type="submit" name="submit" class="btn btn-o btn-primary">
														Update
													</button>
												</form>
											<?php } ?>
										</div>
									</div>
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


</body>



</html>

<?php  ?>