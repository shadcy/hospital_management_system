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
		$pagedes = $con->real_escape_string($_POST['pagedes']);
		$query = mysqli_execute_query($con, "INSERT into pages(type, title, description) values('about',?,?) ON DUPLICATE KEY UPDATE title=?, description=?", [$pagetitle, $pagedes, $pagetitle, $pagedes]);
		if ($query) {
			echo '<script>alert("About Us has been updated.")</script>';
		} else {
			echo '<script>alert("Something Went Wrong. Please try again.")</script>';
		}
	}

?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

	<head>
		<title> <?php echo UserTypeAsString[$userType]; ?> | About Us</title>

		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>

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
				<?php include('./include/nav.php'); ?>

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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span>About Us</h4>




							<div class="col-xl">
								<div class="card mb-4">
									<div class="card-body">



										<form class="forms-sample" method="post">
											<?php

											$ret = mysqli_query($con, "select * from pages where type='about';");

											if (mysqli_num_rows($ret) === 0) {
												$row = ['title' => "", 'description' => ""];
											} else {
												$row = mysqli_fetch_array($ret);
											}

											?>
											<div class="form-group">
												<label for="exampleInputUsername1">Page Title</label>
												<input id="pagetitle" name="pagetitle" type="text" class="form-control" required="true" value="<?php echo $row['title']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Page Description</label>
												<textarea class="form-control" name="pagedes" id="pagedes" rows="12"><?php echo $row['description']; ?></textarea>
											</div>

											<?php ?>
											<br>
											<button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
										</form>
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

<?php } ?>