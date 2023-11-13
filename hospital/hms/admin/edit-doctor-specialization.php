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
	$id = intval($_GET['id']); // get value
	if (isset($_POST['submit'])) {
		$docspecialization = $_POST['doctorspecilization'];
		$sql = mysqli_execute_query($con, "update specializations set name=? where id=?", [$docspecialization, $id]);
		$_SESSION['msg'] = "Doctor Specialization updated successfully !!";
	}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Edit Doctor Specialization</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links("1"); ?>
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
									<h1 class="mainTitle">Admin | Edit Doctor Specialization</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Edit Doctor Specialization</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

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




														<button type="submit" name="submit" class="btn btn-o btn-primary">
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
<?php } ?>