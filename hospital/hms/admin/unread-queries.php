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



?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
	<?php
	$pageName = 'New Queries';
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

						<div class="col-xl">
							<div class="card mb-4">
								<div class="card-body">

									<div class="card">
										<div class="table-responsive text-nowrap">
											<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Unread Queries</span></h5>
											<table class="table table-hover" id="sample-table-1">
												<thead>
													<tr>
														<th class="center">#</th>
														<th>Name</th>
														<th class="hidden-xs">Email</th>
														<th>Contact No. </th>
														<th>Message </th>
														<!-- <th>Query Date</th> -->
														<th>Action</th>

													</tr>
												</thead>
												<tbody>
													<?php
													$sql = mysqli_query($con, "select * from contact_us where isRead = 0;");
													$cnt = 1;
													while ($row = mysqli_fetch_array($sql)) {
													?>

														<tr>
															<td class="center"><?php echo $cnt; ?>.</td>
															<td class="hidden-xs"><?php echo $row['fullName']; ?></td>
															<td><?php echo $row['email']; ?></td>
															<td><?php echo $row['contactNumber']; ?></td>
															<td><?php echo $row['message']; ?></td>
															<!-- <td><?php #echo $row['postingDate']; 
																		?></td> -->

															<td>
																<div class="visible-md visible-lg hidden-sm hidden-xs">
																	<a href="query-details.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-lg" title="View Details"><i class="bx bx-pencil"></i></a>
																</div>
																<div class="visible-xs visible-sm hidden-md hidden-lg">

																</div>
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