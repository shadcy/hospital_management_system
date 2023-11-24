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
	$fname = $_POST['fname'];
	$address = $_POST['address'];
	#$city = $_POST['city'];
	$gender = $_POST['gender'];

	$sql = mysqli_execute_query($con, "Update users set fullName=?,address=?,gender=? where id=?", [$fname, $address, $gender, $_SESSION['id']]); #Done,c: removed city
	if ($sql) {
		$msg = "Your Profile updated Successfully";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>User | Edit Profile</title>

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
									<span>Student </span>
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


														<div class="form-group">
															<label for="address">
																Address
															</label>
															<textarea name="address" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
														</div>
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

														<div class="form-group">
															<label for="fess">
																Student Email
															</label>
															<input type="email" name="uemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
															<a href="change-emaild.php">Update your email id</a>
														</div>







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
	<!-- end: JavaScript Event Handlers for this page -->
	<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>