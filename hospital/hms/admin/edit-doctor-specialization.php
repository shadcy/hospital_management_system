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
}

$id = intval($_GET['id']); // get value
if (isset($_POST['submit'])) {
	$docspecialization = $_POST['doctorspecilization'];
	$sql = mysqli_execute_query($con, "update specializations set name=? where id=?", [$docspecialization, $id]);
	$_SESSION['msg'] = "Doctor Specialization updated successfully !!";
}

?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
	<?php
	$pageName = 'Doctor Specialization';
	include('../include/new-header.php');
	?>
</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

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
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><?php echo UserTypeAsString[$userType]; ?> /</span> <?php echo $pageName; ?></h4>

						<div class="row">


							<div class="row margin-top-30">
								<div class="col-lg-6 col-md-12">
									<div class="panel panel-white">
										<div class="panel-heading">
											<h5 class="panel-title">Edit Doctor Specialization</h5>
										</div>
										<div class="panel-body">
											<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
												<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
											<form role="form" name="dcotorspcl" method="post">
												<div class="form-group">
													<label for="exampleInputEmail1">
														Edit Doctor Specialization
													</label>

													<?php

													$id = intval($_GET['id']);
													$sql = mysqli_execute_query($con, "select * from specializations where id=?", [$id]);
													while ($row = mysqli_fetch_array($sql)) {
													?> <input type="text" name="doctorspecilization" class="form-control" value="<?php echo $row['name']; ?>">
													<?php } ?>
												</div>



												<br>
												<button type="submit" name="submit" class="btn btn-o btn-primary">
													Update
												</button>
											</form>
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