<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

	if (isset($_POST['submit'])) {
		$doctorspecilization = $_POST['doctorspecilization'];
		$sql = mysqli_query($con, "insert into doctorSpecilization(specilization) values('$doctorspecilization')");
		$_SESSION['msg'] = "Doctor Specialization added successfully !!";
	}
	//Code Deletion
	if (isset($_GET['del'])) {
		$sid = $_GET['id'];
		mysqli_query($con, "delete from doctorSpecilization where id = '$sid'");
		$_SESSION['msg'] = "data deleted !!";
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Doctor Specialization</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links("1"); ?>
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">

				<?php include('include/header.php'); ?>

				<!-- end: TOP NAVBAR -->
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Add Doctor Specialization</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Add Doctor Specialization</span>
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
													<h5 class="panel-title">Doctor Specialization</h5>
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




														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Submit
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

							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Docter Specialization</span></h5>

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
											$sql = mysqli_query($con, "select * from doctorSpecilization");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>

												<tr>
													<td class="center"><?php echo $cnt; ?>.</td>
													<td class="hidden-xs"><?php echo $row['specilization']; ?></td>
													<td><?php echo $row['creationDate']; ?></td>
													<td><?php echo $row['updationDate']; ?>
													</td>

													<td>
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="edit-doctor-specialization.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>

															<a href="doctor-specilization.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
														</div>
														<div class="visible-xs visible-sm hidden-md hidden-lg">
															<div class="btn-group" dropdown is-open="status.isopen">
																<button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
																	<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
																</button>
																<ul class="dropdown-menu pull-right dropdown-light" role="menu">
																	<li>
																		<a href="#">
																			Edit
																		</a>
																	</li>
																	<li>
																		<a href="#">
																			Share
																		</a>
																	</li>
																	<li>
																		<a href="#">
																			Remove
																		</a>
																	</li>
																</ul>
															</div>
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
				<!-- end: BASIC EXAMPLE -->
				<!-- end: SELECT BOXES -->

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