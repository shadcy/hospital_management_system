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
	$doctorName = "";
	if (isset($_SESSION['id'])) {
		$query = mysqli_execute_query($con, "select fullName from users where id=?", [$_SESSION['id']]);
		while ($row = mysqli_fetch_array($query)) {
			$doctorName = $row['fullName']; // storing the value in the variable
		}
	}
?>





	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

	<head>
		<title> <?php echo $userTypeString; ?> | Generate Pink Slip</title>



		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


		<meta name="description" content="" />
		<?php include('../include/csslinks.php'); ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
		<!-- <link rel="stylesheet" href="./style.css"> -->

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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span>Generate Pink Slip</h4>

							<div class="col-xl">
								<div class="card mb-4">
									<div class="card-body">

										<?php include('../include/templates/pinkslip.php'); ?>
										<?php include('../include/templates/pinkslipcss.php'); ?>






										<div class="content-backdrop fade"></div>

										<!-- Content wrapper -->
									</div>
								</div>
							</div>
						</div>
						<!-- / Layout page -->


						<!-- Overlay -->
						<div class="layout-overlay layout-menu-toggle"></div>
					</div>

				</div>
			</div>
		</div>
		<!-- Main JS -->
		<!-- start: PDF GEN JAVASCRIPTS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
		<!-- partial -->
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js'></script>
		<script src="./PinkSlip_Gen/script.js"></script>

		<?php include('../include/links.php'); ?>

		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>


	</body>



	</html>



	</var>

<?php } ?>