<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
include_once("../include/check_login_and_perms.php");

$userType = UserTypeEnum::Admin->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
} else {

	if (isset($_POST['submit'])) {

		$docspecialization = $_POST['Doctorspecialization'];
		$docname = $_POST['docname'];
		$docaddress = $_POST['clinicaddress'];
		$docfees = $_POST['docfees'];
		$doccontactno = $_POST['doccontact'];
		$docemail = $_POST['docemail'];
		$password = md5($_POST['npass']);

		try {
			$sql = mysqli_execute_query($con, "insert into users (email,password,fullName,contactNumber,address) values(?,?,?,?,?)", [$docemail, $password, $docname, $doccontactno, $docaddress]);

			if ($sql) {
				$sql = mysqli_execute_query($con, "insert into doctors (id,specializationId,fees,contactNumber) values(?,?,?,?)", [mysqli_insert_id($con), $docspecialization, $docfees, $doccontactno]);
				if ($sql) {
					echo "<script>alert('Doctor info added successfully');</script>";
					echo "<script>window.location.href ='manage-doctors.php'</script>";
				}
			} else {
				echo "<script>alert('There was an issue while creating the user for the doctor.');</script>";
				echo "<script>window.location.href ='add-doctor.php'</script>";
			}
		} catch (mysqli_sql_exception $exp) {
			if ($exp->getCode() === 1062) {
				echo "<script>alert('A user with that email already exists.');</script>";
			} else {
				echo "<script>alert('There was an issue while creating the user for the doctor.');</script>";
			}
			echo "<script>window.location.href ='add-doctor.php'</script>";
		}
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Admin | Add Doctor</title>

		<?php include_once("../include/head_links.php");
		echo generate_head_links(); ?>
		<script type="text/javascript">
			function valid() {
				if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
					alert("Password and Confirm Password Field do not match  !!");
					document.adddoc.cfpass.focus();
					return false;
				}
				return true;
			}

			function checkemailAvailability() {
				$("#loaderIcon").show();
				jQuery.ajax({
					url: "check_availability.php",
					data: 'emailid=' + $("#docemail").val(),
					type: "POST",
					success: function(data) {
						$("#email-availability-status").html(data);
						$("#loaderIcon").hide();
					},
					error: function() {}
				});
			}
		</script>
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
									<h1 class="mainTitle">Admin | Add Doctor</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Add Doctor</span>
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
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Add Doctor</h5>
												</div>
												<div class="panel-body">

													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														<div class="form-group">
															<label for="DoctorSpecialization">
																Doctor Specialization
															</label>
															<select name="Doctorspecialization" class="form-control" required="true">
																<option value="">Select Specialization</option>
																<?php $ret = mysqli_query($con, "select * from specializations;");
																while ($row = mysqli_fetch_array($ret)) {
																?>
																	<option value="<?php echo htmlentities($row['id']); ?>">
																		<?php echo htmlentities($row['name']); ?>
																	</option>
																<?php } ?>

															</select>
														</div>

														<div class="form-group">
															<label for="doctorname">
																Doctor Name
															</label>
															<input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true">
														</div>


														<div class="form-group">
															<label for="address">
																Doctor Clinic Address
															</label>
															<textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea>
														</div>
														<div class="form-group">
															<label for="fess">
																Doctor Consultancy Fees
															</label>
															<input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees" required="true">
														</div>

														<div class="form-group">
															<label for="fess">
																Doctor Contact no
															</label>
															<input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no" required="true">
														</div>

														<div class="form-group">
															<label for="fess">
																Doctor Email
															</label>
															<input type="email" id="docemail" name="docemail" class="form-control" placeholder="Enter Doctor Email id" required="true" onBlur="checkemailAvailability()">
															<span id="email-availability-status"></span>
														</div>




														<div class="form-group">
															<label for="exampleInputPassword1">
																Password
															</label>
															<input type="password" name="npass" class="form-control" placeholder="New Password" required="required">
														</div>

														<div class="form-group">
															<label for="exampleInputPassword2">
																Confirm Password
															</label>
															<input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required="required">
														</div>



														<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
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