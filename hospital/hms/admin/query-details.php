<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

	//updating Admin Remark
	if (isset($_POST['update'])) {
		$qid = intval($_GET['id']);
		$adminremark = $_POST['adminremark'];
		$isread = 1;
		$query = mysqli_query($con, "update tblcontactus set  AdminRemark='$adminremark',IsRead='$isread' where id='$qid'");
		if ($query) {
			echo "<script>alert('Admin Remark updated successfully.');</script>";
			echo "<script>window.location.href ='read-query.php'</script>";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Query Details</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>
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
									<h1 class="mainTitle">Admin | Query Details</h1>
								</div>

								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Query Details</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Query Details</span></h5>
									<hr />
									<table class="table table-hover" id="sample-table-1">

										<tbody>
											<?php
											$qid = intval($_GET['id']);
											$sql = mysqli_query($con, "select * from tblcontactus where id='$qid'");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>

												<tr>
													<th>Full Name</th>
													<td><?php echo $row['fullname']; ?></td>
												</tr>

												<tr>
													<th>Email Id</th>
													<td><?php echo $row['email']; ?></td>
												</tr>
												<tr>
													<th>Conatact Numner</th>
													<td><?php echo $row['contactno']; ?></td>
												</tr>
												<tr>
													<th>Message</th>
													<td><?php echo $row['message']; ?></td>
												</tr>

												<tr>
													<th>Query Date</th>
													<td><?php echo $row['PostingDate']; ?></td>
												</tr>

												<?php if ($row['AdminRemark'] == "") { ?>
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
														<td><?php echo $row['AdminRemark']; ?></td>
													</tr>

													<tr>
														<th>Last Updatation Date</th>
														<td><?php echo $row['LastupdationDate']; ?></td>
													</tr>

											<?php
												}
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