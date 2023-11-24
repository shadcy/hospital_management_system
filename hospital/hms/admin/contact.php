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
	//Code for Update the Content

	if (isset($_POST['submit'])) {

		$pagetitle = $_POST['pagetitle'];
		$pagedes = $_POST['pagedes'];
		$email = $_POST['email'];
		$mobnum = $_POST['mobnum'];
		$query = mysqli_execute_query($con, "INSERT into pages(type,title,description,email,contactNumber) values('contact',?,?,?,?) ON DUPLICATE KEY UPDATE title=?,description=?,email=?,contactNumber=?", [$pagetitle, $pagedes, $email, $mobnum, $pagetitle, $pagedes, $email, $mobnum]);
		if ($query) {
			echo '<script>alert("Contact Us has been updated.")</script>';
		} else {
			echo '<script>alert("Something Went Wrong. Please try again.")</script>';
		}
	}

?>






	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">


	<head>
		<title> <?php echo $userTypeString; ?> | Contact Us</title>



		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

		<meta name="description" content="" />
		<?php include('../include/csslinks.php'); ?>

	</head>

	<body>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				<!-- Menu -->
				<?php include('../include/counter.php'); ?>
				<?php include('../include/nav.php'); ?>

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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Contact Us</h4>




							<div class="col-xl">
								<div class="card mb-4">

									<div class="card-body">
										<form class="forms-sample" method="post">
											<?php

											$ret = mysqli_query($con, "select * from pages where type='contact';");

											if (mysqli_num_rows($ret) === 0) {
												$row = ['title' => "", 'description' => "", 'email' => "", 'contactNumber' => ""];
											} else {
												$row = mysqli_fetch_array($ret);
											}

											?>
											<div class="form-group">
												<label for="exampleInputUsername1">Page Title</label>
												<input id="pagetitle" name="pagetitle" type="text" class="form-control" required="true" value="<?php echo $row['title']; ?>">
											</div>
											<br>
											<div class="form-group">
												<label for="exampleInputEmail1">Page Description</label>
												<textarea class="form-control" name="pagedes" id="pagedes" rows="5"><?php echo $row['description']; ?></textarea>
											</div>
											<br>
											<div class="form-group">
												<label for="exampleInputUsername1">Email Addresss</label>
												<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required='true'>
											</div>
											<br>
											<div class="form-group">
												<label for="exampleInputUsername1">Mobile Number</label>
												<input type="text" class="form-control" name="mobnum" value="<?php echo $row['contactNumber']; ?>" required='true' maxlength="10" pattern='[0-9]+'>
											</div>

											<br>
											<button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
										</form>
									</div>
								</div>

								<div class="content-backdrop fade"></div>

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

<?php } ?>