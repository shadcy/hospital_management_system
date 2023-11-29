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
$patientUserType = UserTypeEnum::Patient->value;
if (isset($_GET['del'])) {
	$uid = $_GET['id'];
	if ($uid == $_SESSION['id']) {
		$_SESSION['msg'] = "Cannot delete yourself!";
	} else {
		mysqli_execute_query($con, "Update users set isActive=0 where id =? and type={$patientUserType}", [$uid]);
		$_SESSION['msg'] = "data deleted !!";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin | Manage Users</title>

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
								<h1 class="mainTitle">Admin | Manage Users</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Admin</span>
								</li>
								<li class="active">
									<span>Manage Users</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">


						<div class="row">
							<div class="col-md-12">
								<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Users</span></h5>
								<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
									<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th>Full Name</th>
											<th class="hidden-xs">Adress</th>
											<th>Gender </th>
											<th>Email </th>
											<th>Creation Date </th>
											<th>Updation Date </th>
											<th>Action</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$sql = mysqli_query($con, "select * from users where type ={$patientUserType} and isActive=1;");
										$cnt = 1;
										while ($row = mysqli_fetch_array($sql)) {
										?>

											<tr>
												<td class="center"><?php echo $cnt; ?>.</td>
												<td class="hidden-xs"><?php echo $row['fullName']; ?></td>
												<td><?php echo $row['address']; ?></td>
												<td><?php echo $row['gender']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['registrationDate']; ?></td>
												<td><?php echo $row['updationDate']; ?>
												</td>
												<td>
													<div class="visible-md visible-lg hidden-sm hidden-xs">


														<a href="manage-users.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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