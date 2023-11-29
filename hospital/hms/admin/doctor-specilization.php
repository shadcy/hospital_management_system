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

if (isset($_POST['submit'])) {
	$doctorspecialization = $_POST['doctorspecilization'];
	$sql = mysqli_execute_query($con, "insert into specializations(name) values(?)", [$doctorspecialization]);
	$_SESSION['msg'] = "Doctor Specialization added successfully !!";
}
//Code Deletion
if (isset($_GET['del'])) {
	$sid = $_GET['id'];
	$sql = mysqli_execute_query($con, "delete from specializations where id = ?", [$sid]);
	if ($sql) {
		$_SESSION['msg'] = "data deleted !!";
	} else {
		$_SESSION['msg'] = "An error occured";
	}
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
							<div class="col-xl">


								<div class="card mb-4">
									<div class="card-body">
										<div class="row margin-top-30">
											<div class="col-lg-6 col-md-12">
												<div class="panel panel-white">
													<div class="panel-heading">
														<h5 class="panel-title">Add Specialization</h5>
													</div>
													<div class="panel-body">
														<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
															<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
														<form role="form" name="dcotorspcl" method="post">
															<div class="form-group">
																<label for="exampleInputEmail1">
																	Doctor Specialization
																</label>
																<input type="text" name="doctorspecilization" class="form-control" placeholder="Enter Doctor Specialization">
															</div>



															<br>
															<button type="submit" name="submit" class="btn btn-o btn-primary">
																Submit
															</button>
														</form>
													</div>
													<br><br>

												</div>
											</div>

										</div>



										<div>
											<div class="card">
												<div class="table-responsive text-nowrap">
													<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Specializations</span></h5>

													<table class="table table-hover" id="sample-table-1">
														<thead>
															<tr>
																<th class="center">#</th>
																<th>Specialization</th>
																<th class="hidden-xs">Creation Date</th>
																<th>Updation Date</th>
																<th>Action</th>

															</tr>
														</thead>
														<tbody>
															<?php
															$sql = mysqli_query($con, "select * from specializations;");
															$cnt = 1;
															while ($row = mysqli_fetch_array($sql)) {
															?>

																<tr>
																	<td class="center"><?php echo $cnt; ?>.</td>
																	<td class="hidden-xs"><?php echo $row['name']; ?></td>
																	<td><?php echo $row['creationDate']; ?></td>
																	<td><?php echo $row['updationDate']; ?>
																	</td>

																	<td>
																		<div class="visible-md visible-lg hidden-sm hidden-xs">
																			<a href="edit-doctor-specialization.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="bx bx-pencil"></i></a>

																			<a href="doctor-specilization.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class='bx bxs-message-minus'></i></a>
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