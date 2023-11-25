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

	//updating Admin Remark
	if (isset($_POST['update'])) {
		$qid = intval($_GET['id']);
		$adminremark = $_POST['adminremark'];
		$isread = 1;
		$query = mysqli_execute_query($con, "update contact_us set adminRemark=?,isRead=? where id=?", [$adminremark, $isread, $qid]);
		if ($query) {
			echo "<script>alert('Admin Remark updated successfully.');</script>";
			echo "<script>window.location.href ='read-query.php'</script>";
		}
	}
?>



	<?php $userTypeString = UserTypeAsString[$userType] ?>
	<!DOCTYPE html>


	<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

	<head>
		<title> <?php echo $userTypeString; ?> | Doctor Specialization</title>



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
							<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Doctor Specialization</h4>






							<div class="col-xl">
								<div class="card mb-4">
									<div class="card-body">
										<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Query Details</span></h5>
										<hr />
										<table class="table table-hover" id="sample-table-1">

											<tbody>
												<?php
												$qid = intval($_GET['id']);
												$sql = mysqli_execute_query($con, "select * from contact_us where id=?", [$qid]);
												$cnt = 1;
												while ($row = mysqli_fetch_array($sql)) {
												?>

													<tr>
														<th>Full Name</th>
														<td><?php echo $row['fullName']; ?></td>
													</tr>

													<tr>
														<th>Email Id</th>
														<td><?php echo $row['email']; ?></td>
													</tr>
													<tr>
														<th>Conatact Numner</th>
														<td><?php echo $row['contactNumber']; ?></td>
													</tr>
													<tr>
														<th>Message</th>
														<td><?php echo $row['message']; ?></td>
													</tr>

													<tr>
														<th>Query Date</th>
														<td><?php echo $row['postingDate']; ?></td>
													</tr>

													<?php if ($row['adminRemark'] == "") { ?>
														<form name="query" method="post">
															<tr>
																<th>Admin Remark</th>
																<td><textarea name="adminremark" class="form-control" required="true"></textarea></td>
															</tr>
															<tr>
																<td>&nbsp;</td>
																<td>
																	<button type="submit" class="btn btn-primary pull-left" name="update">
																		Update <i class="fa fa-arrow-circle-right"></i>
																	</button>

																</td>
															</tr>

														</form>
													<?php } else { ?>

														<tr>
															<th>Admin Remark</th>
															<td><?php echo $row['adminRemark']; ?></td>
														</tr>

														<tr>
															<th>Last Updatation Date</th>
															<td><?php echo $row['updationDate']; ?></td>
														</tr>

												<?php
													}
												} ?>


											</tbody>
										</table>
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