<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
}




include_once("./include/nav.php");

$userTypeString = UserTypeAsString[$userType];


$sql = mysqli_execute_query($con, "SELECT * from users where id = ?", [$_SESSION['id']]);
$userDetails = mysqli_fetch_array($sql);

if (isset($_POST['submit'])) {
	#$specilization = $_POST['Doctorspecialization'];
	$doctorid = $_POST['doctor'];
	$userid = $_SESSION['id'];
	$fees = $_POST['fees'];
	$appdate = $_POST['appdate'];
	$time = $_POST['apptime'];
	$userstatus = 1;
	$docstatus = 1;
	$query = mysqli_execute_query($con, "insert into appointments(doctorId,patientId,consultancyFees,date,time) values(?,?,?,?,?)", [$doctorid, $userid, $fees, $appdate, $time]);
	if ($query) {
		echo "<script>alert('Your appointment was booked successfully.');</script>";
		echo "<script>window.location.href ='appointment-history.php?filter=pnd'</script>";
	}
}


?>
<?php $userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">

<head>
	<title> <?php echo $userTypeString; ?> | Dashboard</title>



	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<link rel="stylesheet" href="chatapi.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Google Fonts Link For Icons -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
	<link href="/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
	<link href="/vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">'
	<script src="chatapi.js" defer></script>
	<meta name="description" content="" />
	<?php include('../include/csslinks.php'); ?>

	<script>
		function getdoctor(val) {
			$.ajax({
				type: "POST",
				url: "get_doctor.php",
				data: 'specialization_id=' + val,
				success: function(data) {
					$("#doctor").html(data);
				}
			});
		}
	</script>


	<script>
		function getfee(val) {
			$.ajax({
				type: "POST",
				url: "get_doctor.php",
				data: 'doctor_id=' + val,
				success: function(data) {
					$("#fees").html(data);
				}
			});
		}
	</script>
</head>

<body>
	<!-- Chat Bot API -->
	<button class="chatbot-toggler">
		<span class="material-symbols-rounded">robot</span>
		<span class="material-symbols-outlined">close</span>
	</button>
	<div class="chatbot">
		<header>

			<h2 style="color: white;"><b> </b></h2>
			<span class="close-btn material-symbols-outlined">close</span>
		</header>
		<ul class="chatbox">
			<li class="chat incoming">
				<span class="material-symbols-outlined">robot</span>
				<p>Hi there 👋<br>How can I help you today?</p>
			</li>
			<li class="chat incoming">
				<span class="material-symbols-outlined">smart_toy</span>
				<p>Get AI support <a href="ai.php">Click Here</a> </p>

			</li>
			<li class="chat incoming">
				<span class="material-symbols-outlined">smart_toy</span>

				<p>Call Ambulance <a href="ambulance.php">Click Here</a> </p>
			</li>
		</ul>
		<div class="chat-input">
			<textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
			<span id="send-btn" class="material-symbols-rounded">send</span>
		</div>
	</div>

	<!-- Chat Bot API -->
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->
			<?php include('../include/counter.php'); ?>
			<?php include('../include/nav.php'); ?>

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
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Student/</span> Dashboard</h4>



						<div class="row">
							<div class="col-lg-8 mb-4 order-0">
								<div class="card">
									<div class="d-flex align-items-end row">
										<div class="col-sm-7">
											<div class="card-body">
												<h5 class="card-title text-primary">Hey <?php echo $userDetails['fullName']; ?> ! 👋</h5>
												<p class="mb-4">
													Wanna book appointment ? <span class="fw-bold"></span> Check doctors schedule
												</p>

												<!-- Enable Scrolling & Backdrop Offcanvas -->
												<div class="col-lg-4 col-md-6">

													<div class="mt-3">
														<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
															Book Appointment
														</button>
														<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
															<div class="offcanvas-header">
																<h5 id="offcanvasBothLabel" class="offcanvas-title">Appointments</h5>
																<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
															</div>
															<div class="offcanvas-body my-auto mx-0 flex-grow-0">
																<p class="text-center">
																	<!-- APPOINTMENTS -->


																<div class="panel panel-white">
																	<div class="panel-heading">
																		<h5 class="panel-title">Book Appointment</h5>
																	</div>
																	<div class="panel-body">
																		<p style="color:red;">
																			<?php echo htmlentities($_SESSION['msg1']); ?>
																			<?php echo htmlentities($_SESSION['msg1'] = ""); ?>
																		</p>
																		<form role="form" name="book" method="post">


																			<br><br>
																			<div class="form-group">
																				<label for="DoctorSpecialization">
																					Doctor Specialization
																				</label>
																				<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
																					<option value="">Select Specialization</option>
																					<?php $ret = mysqli_query($con, "select * from specializations;"); #Done
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
																				<label for="doctor">
																					Doctors
																				</label>
																				<select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
																					<option value="">Select Doctor</option>
																				</select>
																			</div>


																			<br>


																			<div class="form-group">
																				<label for="consultancyfees">
																					Consultancy Fees
																				</label>
																				<select name="fees" class="form-control" id="fees" readonly>

																				</select>
																			</div>
																			<br>
																			<div class="form-group">
																				<label for="AppointmentDate">
																					Date
																				</label>
																				<input class="form-control datepicker" name="appdate" required="required" data-date-format="yyyy-mm-dd">

																			</div>
																			<br>
																			<div class="form-group">
																				<label for="Appointmenttime">

																					Time

																				</label>
																				<input class="form-control timepicker" name="apptime" required="required">eg : 10:00 PM
																			</div>
																			<br>
																			<button type="submit" name="submit" class="btn btn-o btn-primary">
																				Submit
																			</button>
																		</form>
																	</div>
																</div>


																<!-- APPOINTMENTS -->

																<!--  -->




																</p>

																<button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
																	Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
												<!-- Enable Scrolling & Backdrop Offcanvas -->
											</div>
										</div>
										<div class="col-sm-5 text-center text-sm-left">
											<div class="card-body pb-0 px-0 px-md-4">
												<img src="/assets2/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Total Revenue -->
							<div class="" style="padding:10px;">
								<div class="card" style="padding:10px; background-color:transparent; box-shadow:none;">
									<div class="row row-bordered g-0">
										<div class="col-md-8">
											<h5 class="card-header m-0 me-2 pb-3">Hospital Management Tools</h5>

										</div>

										<div class="col-xl-6" style="padding:10px;">

											<div class="nav-align-top mb-4">
												<ul class="nav nav-pills mb-3" role="tablist">
													<li class="nav-item">
														<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
															<i class="bx bx-home" style="margin-top:-1.5px;"></i> Home
														</button>
													</li>
													<li class=" nav-item">
														<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
															<i class="bx bx-file" style="margin-top:-1.5px;"></i><span> Pink Slip</span>
														</button>
													</li>
													<li class="nav-item">
														<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
															<i class="bx bx-folder" style="margin-top:-1.5px;"></i><span> Mail</span>
														</button>
													</li>
													<li class="nav-item">
														<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-appointments" aria-controls="navs-pills-top-messages" aria-selected="false">
															<i class="bx bx-book" style="margin-top:-1.5px;"></i><span>Appointments</span>
														</button>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
														<p>
															IIT Bombay Hospital Management System, Get AI Help <a href="ai.php"> Click Here </a>
														</p>
														<p class="mb-0">
															NXT Gen's AI assistant<a href="aichat.php"> NXT AI</a> will help you out whenever you get stucked.
														</p>
													</div>
													<div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
														<p>
															IIT Bombay's hospital system, Pink slip Generator : <a href="gen.php">Generate Slip</a>
														</p>
														<p class="mb-0">
															For Pink Slip Verification <a href="verification.php">Click Here</a>
														</p>
													</div>
													<div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
														<p>
															IIT Bombay Hospital mail : no-reply@iitbhms.online
														</p>
														<p class="mb-0">
															Generate <a href="mail.php">Click Here</a>
														</p>
													</div>
													<div class="tab-pane fade" id="navs-pills-top-appointments" role="tabpanel">
														<p>
															Get AI Appointment Manager
														<div class="col-lg-4 col-md-6">
															<div class="mt-3">
																<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#appointmentModal">
																	AI Manager
																</button>

																<!-- Modal -->
																<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="appointmentModalLabel">Appointments</h5>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																			</div>
																			<div class="modal-body">















																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>

														</p>

													</div>
												</div>
											</div>







										</div>
									</div>

									<!-- Examples -->
									<div class="row mb-5">
										<div class="col-md-6 col-lg-4 mb-3">
											<div class="card h-100">
												<img class="card-img-top" src="/assets2/img/elements/2.jpg" alt="Card image cap" />
												<div class="card-body">
													<h5 class="card-title">Order Fruits Online</h5>
													<p class="card-text">
														<span class="badge bg-primary">Sponsored</span> <b>by zepto.in</b>
													</p>
													<a href="https://www.zeptonow.com/" class="btn btn-outline-primary">Order</a>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-4 mb-3">
											<div class="card h-100">
												<div class="card-body">
													<h5 class="card-title">Get Doctor</h5>
													<h6 class="card-subtitle text-muted">24/7 doctors available</h6>
												</div>
												<img class="img-fluid" src="/assets2/img/elements/patient-mri-test.png" alt="Card image cap" />
												<div class="card-body">
													<p class="card-text">Book Appointment with doctor</p>
													<a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth" class="card-link">Get Appointment</a>

												</div>
											</div>
										</div>

										<div class="col-md-6 col-lg-4 mb-3">
											<div class="card h-100">
												<div class="card-body">
													<h5 class="card-title">Order Medicines</h5>
													<h6 class="card-subtitle text-muted"><span class="badge bg-primary">Sponsored</span> </h6>
												</div>
												<img class="img-fluid" src="/assets2/img/elements/doctor-checking-patient.png" alt="Card image cap" />
												<div class="card-body">
													<p class="card-text">Order Medicines Online</p>
													<a href="https://www.medplusmart.com/" class="card-link">Order</a>

												</div>
											</div>
										</div>
									</div>
								</div>
								<!--/ Total Revenue -->



								<div class="row">


									<!-- Footer -->
									<footer class="content-footer footer bg-footer-theme">
										<div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
											<div class="mb-2 mb-md-0">
												©
												<script>
													document.write(new Date().getFullYear());
												</script>
												, made with ❤️ by
												<a href="http://nxt.nxtdevelopers.xyz/" target="_blank" class="footer-link fw-bolder">NXT GEN </a>
											</div>
											<div>
												<a href="#" class="footer-link me-4" target="_blank">License</a>
												<a href="#" target="_blank" class="footer-link me-4">Softwares</a>

												<a href="#" target="_blank" class="footer-link me-4">Documentation</a>

												<a href="#" target="_blank" class="footer-link me-4">Support</a>
											</div>
										</div>
									</footer>
									<!-- / Footer -->

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
					<script src="/assets/js/form-elements.js"></script>
					<script src="/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
					<script src="/vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
					<script>
						$('.datepicker').datepicker({
							format: 'yyyy-mm-dd',
							startDate: '-3d'
						});

						$('.timepicker').timepicker();
					</script>




</body>

</html>