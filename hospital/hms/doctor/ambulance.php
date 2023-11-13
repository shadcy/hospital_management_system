<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Doctor | Dashboard</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>

		<style>
			.card {
				width: 600px;
				height: 350px;
				margin: auto;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
				display: flex;
			}

			.card .image {
				width: 300px;
				height: 350px;
				background: url('qr.png') no-repeat center;
				/* background-size: contain; */
				padding: 20px;
				/* flex-shrink: 0; */
			}

			.card .content {
				flex: 1;
				padding: 20px;
				width: 300px;
				height: 350px;
			}

			.content h2 {
				font-family: Arial, sans-serif;
				font-size: 24px;
				margin-top: 60px;
				width: 100px;
				height: 130px;

			}

			.content p {
				font-family: Arial, sans-serif;
				font-size: 16px;
				color: #555;
				width: 300px;
				height: 350px;
			}
		</style>
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
									<h1 class="mainTitle">Doctor | Dashboard</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">



								<div class="card">
									<div class="image"></div>
									<div class="content">
										<h2>Ambulance 24/7</h2>
										<p>Scan the qr given or contact on the number to get the ambulance</p>

										<br>


										<br>

										<br>

									</div>
								</div>



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