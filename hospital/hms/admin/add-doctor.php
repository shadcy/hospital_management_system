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

	$docspecialization = $_POST['Doctorspecialization'];
	$docname = $_POST['docname'];
	$docaddress = $_POST['clinicaddress'];
	$docfees = $_POST['docfees'];
	$doccontactno = $_POST['doccontact'];
	$docemail = $_POST['docemail'];
	$password = md5($_POST['npass']);
	$newUserType = UserTypeEnum::Doctor->value;
	try {
		$sql = mysqli_execute_query($con, "insert into users (type,email,password,fullName,contactNumber,address) values({$newUserType},?,?,?,?,?)", [$docemail, $password, $docname, $doccontactno, $docaddress]);

		if ($sql) {
			$sql = mysqli_execute_query($con, "insert into doctors (id,specializationId,fees,contactNumber,nonce) values(?,?,?,?,?)", [mysqli_insert_id($con), $docspecialization, $docfees, $doccontactno, random_bytes(48)]);
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


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">
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
			url: "/api/check_availability.php",
			data: 'emailid=' + $("#email").val(),
			type: "POST",
			dataType: "json",
			success: function(data) {
				$("#email-availability-status").html(data.html);
				$("#loaderIcon").hide();
				$('#submit').prop('disabled', !data.valid);
			},
			error: function() {}
		});
	}
</script>

<head>
	<?php
	$pageName = 'Add Doctor';
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
									<!-- <div class="card-header d-flex justify-content-between align-items-center">
										<h5 class="mb-0">Change Password</h5>

										<small class="text-muted float-end">Admin</small>
									</div> -->

									<div class="card-body">

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
											<br>
											<div class="form-group">
												<label for="doctorname">
													Doctor Name
												</label>
												<input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true">
											</div>

											<br>
											<div class="form-group">
												<label for="address">
													Doctor Clinic Address
												</label>
												<textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea>
											</div>
											<br>
											<div class="form-group">
												<label for="fess">
													Doctor Consultancy Fees
												</label>
												<input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees" required="true">
											</div>
											<br>
											<div class="form-group">
												<label for="fess">
													Doctor Contact no
												</label>
												<input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no" required="true">
											</div>
											<br>
											<div class="form-group">
												<label for="fess">
													Doctor Email
												</label>
												<input type="email" id="docemail" name="docemail" class="form-control" placeholder="Enter Doctor Email id" required="true" onBlur="checkemailAvailability()">
												<span id="email-availability-status"></span>
											</div>


											<br>

											<div class="form-group">
												<label for="exampleInputPassword1">
													Password
												</label>
												<input type="password" name="npass" class="form-control" placeholder="New Password" required="required">
											</div>
											<br>
											<div class="form-group">
												<label for="exampleInputPassword2">
													Confirm Password
												</label>
												<input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required="required">
											</div>

											<br>

											<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary" disabled>
												Submit
											</button>
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