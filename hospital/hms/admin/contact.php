<?php
session_start();
error_reporting(0);
include('../include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {
	//Code for Update the Content

	if (isset($_POST['submit'])) {

		$pagetitle = $_POST['pagetitle'];
		$pagedes = $_POST['pagedes'];
		$email = $_POST['email'];
		$mobnum = $_POST['mobnum'];
		$query = mysqli_query($con, "update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes',Email='$email',MobileNumber='$mobnum' where  PageType='contactus'");
		if ($query) {

			echo '<script>alert("Contact Us has been updated.")</script>';
		} else {
			echo '<script>alert("Something Went Wrong. Please try again.")</script>';
		}
	}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Cotnact Us </title>

		<?php include_once("../include/head_links.php") #1 
		?>
		<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(nicEditors.allTextAreas);
		</script>
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
									<h1 class="mainTitle">Admin | Update the Cotnact us Content</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin </span>
									</li>
									<li class="active">
										<span>Update the Cotnact us Content</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">


							<div class="row">
								<div class="col-md-12">


									<form class="forms-sample" method="post">
										<?php

										$ret = mysqli_query($con, "select * from  tblpage where PageType='contactus'");
										$cnt = 1;
										while ($row = mysqli_fetch_array($ret)) {

										?>
											<div class="form-group">
												<label for="exampleInputUsername1">Page Title</label>
												<input id="pagetitle" name="pagetitle" type="text" class="form-control" required="true" value="<?php echo $row['PageTitle']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Page Description</label>
												<textarea class="form-control" name="pagedes" id="pagedes" rows="5"><?php echo $row['PageDescription']; ?></textarea>
											</div>
											<div class="form-group">
												<label for="exampleInputUsername1">Email Addresss</label>
												<input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" required='true'>
											</div>
											<div class="form-group">
												<label for="exampleInputUsername1">Mobile Number</label>
												<input type="text" class="form-control" name="mobnum" value="<?php echo $row['MobileNumber']; ?>" required='true' maxlength="10" pattern='[0-9]+'>
											</div>

										<?php } ?>
										<button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
									</form>
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