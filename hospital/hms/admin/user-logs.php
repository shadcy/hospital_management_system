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
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | User Session Logs</title>

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
									<h1 class="mainTitle">Admin | User Session Logs</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin </span>
									</li>
									<li class="active">
										<span>User Session Logs</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


							<div class="row">
								<div class="col-md-12">

									<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
										<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-xs">User id</th>
												<th>Username</th>
												<th>User IP</th>
												<th>Login time</th>
												<th>Logout Time </th>
												<th> Status </th>


											</tr>
										</thead>
										<tbody>
											<?php
											$patientUserType = UserTypeEnum::Patient->value;
											$sql = mysqli_query($con, "select * from logs where type={$patientUserType};");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>

												<tr>
													<td class="center"><?php echo $cnt; ?>.</td>
													<td class="hidden-xs"><?php echo $row['userId']; ?></td>
													<td class="hidden-xs"><?php echo $row['username']; ?></td>
													<td><?php echo $row['ip']; ?></td>
													<td><?php echo $row['loginTime']; ?></td>
													<td><?php echo $row['logout']; ?>
													</td>

													<td>
														<?php if ($row['status'] == 1) {
															echo "Success";
														} else {
															echo "Failed";
														} ?>

													</td>

												</tr>

											<?php
												$cnt = $cnt + 1;
											} ?>


										</tbody>
									</table>
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