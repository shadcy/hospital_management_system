<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
	<?php
	$pageName = "Change Password";
	include('../include/new-header.php');
	?>

	<script type="text/javascript">
		function valid() {
			if (document.chngpwd.cpass.value == "") {
				alert("Current Password Filed is Empty !!");
				document.chngpwd.cpass.focus();
				return false;
			} else if (document.chngpwd.npass.value == "") {
				alert("New Password Filed is Empty !!");
				document.chngpwd.npass.focus();
				return false;
			} else if (document.chngpwd.cfpass.value == "") {
				alert("Confirm Password Filed is Empty !!");
				document.chngpwd.cfpass.focus();
				return false;
			} else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.chngpwd.cfpass.focus();
				return false;
			}
			return true;
		}
	</script>
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
									<div class="card-header d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Change Password</h5>

										<small class="text-muted float-end">Admin</small>
									</div>

									<div class="card-body">

										<p style="color:red;"><?php echo htmlentities($errMsg); ?></p>

										<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
											<br>
											<div class="form-group">
												<label for="exampleInputEmail1">
													Current Password
												</label>
												<input type="password" name="cpass" class="form-control" placeholder="Enter Current Password">
											</div>
											<br>
											<div class="form-group">
												<label for="exampleInputPassword1">
													New Password
												</label>
												<input type="password" name="npass" class="form-control" placeholder="New Password">
											</div>
											<br>
											<div class="form-group">
												<label for="exampleInputPassword1">
													Confirm Password
												</label>
												<input type="password" name="cfpass" class="form-control" placeholder="Confirm Password">
											</div>
											<br><br>
											<button type="submit" name="submit" class="btn btn-primary">Submit</button>
										</form>
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