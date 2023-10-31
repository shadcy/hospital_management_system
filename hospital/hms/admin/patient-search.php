<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | View Patients</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links("1"); ?>
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">
				<?php include('include/header.php'); ?>
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | View Patients</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>View Patients</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" method="post" name="search">

										<div class="form-group">
											<label for="doctorname">
												Search by Name/Mobile No.
											</label>
											<input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
										</div>

										<button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
											Search
										</button>
									</form>
									<?php
									if (isset($_POST['search'])) {

										$sdata = $_POST['searchdata'];
									?>
										<h4 align="center">Result against "<?php echo $sdata; ?>" keyword </h4>
										<table class="table table-hover" id="sample-table-1">
											<thead>
												<tr>
													<th class="center">#</th>
													<th>Patient Name</th>
													<th>Patient Contact Number</th>
													<th>Patient Gender </th>
													<th>Creation Date </th>
													<th>Updation Date </th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$sql = mysqli_query($con, "select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
												$num = mysqli_num_rows($sql);
												if ($num > 0) {
													$cnt = 1;
													while ($row = mysqli_fetch_array($sql)) {
												?>
														<tr>
															<td class="center"><?php echo $cnt; ?>.</td>
															<td class="hidden-xs"><?php echo $row['PatientName']; ?></td>
															<td><?php echo $row['PatientContno']; ?></td>
															<td><?php echo $row['PatientGender']; ?></td>
															<td><?php echo $row['CreationDate']; ?></td>
															<td><?php echo $row['UpdationDate']; ?>
															</td>
															<td>

																<a href="view-patient.php?viewid=<?php echo $row['ID']; ?>"><i class="fa fa-eye"></i></a>

															</td>
														</tr>
													<?php
														$cnt = $cnt + 1;
													}
												} else { ?>
													<tr>
														<td colspan="8"> No record found against this search</td>

													</tr>

											<?php }
											} ?>
											</tbody>
										</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- start: FOOTER -->
		<?php include('include/footer.php'); ?>
		<!-- end: FOOTER -->

		<!-- start: SETTINGS -->
		<?php include('include/setting.php'); ?>

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