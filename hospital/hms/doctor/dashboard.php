<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Doctor->value;

include_once("../include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
	exit;
}

$sql = mysqli_execute_query($con, "SELECT * from users where id = ?", [$_SESSION['id']]);
$userDetails = mysqli_fetch_array($sql);
?>
<?php $userTypeString = UserTypeAsString[$userType] ?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets2/" data-template="vertical-menu-template-free">
<link rel="stylesheet" href="chatapi.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Fonts Link For Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
<script src="chatapi.js" defer></script>

<head>
	<title> <?php echo $userTypeString; ?> | Dashboard</title>



	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


	<meta name="description" content="" />
	<?php include('../include/csslinks.php'); ?>

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
						<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Doctor/</span> Dashboard</h4>





						<div class="row">
							<div class="col-lg-8 mb-4 order-0">
								<div class="card">
									<div class="d-flex align-items-end row">
										<div class="col-sm-7">
											<div class="card-body">
												<h5 class="card-title text-primary">Hey <?php echo $userDetails['fullName']; ?> ! 👋</h5>
												<p class="mb-4">
													We got <span class="fw-bold"><?php echo $Appointments; ?></span> appointments today. Check doctors schedule
												</p>

												<!-- Enable Scrolling & Backdrop Offcanvas -->
												<div class="col-lg-4 col-md-6">

													<div class="mt-3">
														<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
															Appointments
														</button>
														<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
															<div class="offcanvas-header">
																<h5 id="offcanvasBothLabel" class="offcanvas-title">Appointments</h5>
																<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
															</div>
															<div class="offcanvas-body my-auto mx-0 flex-grow-0">
																<p class="text-center">
																	<!-- APPOINTMENTS -->


																<div class="card-body">
																	<div class="card-title d-flex align-items-start justify-content-between">
																		<div class="avatar flex-shrink-0">
																			<img src="/assets2/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
																		</div>
																		<div class="dropdown">
																			<button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				<i class="bx bx-dots-vertical-rounded"></i>
																			</button>
																			<div class="dropdown-menu" aria-labelledby="cardOpt1">
																				<a class="dropdown-item" href="javascript:void(0);">View More</a>
																				<a class="dropdown-item" href="javascript:void(0);">Delete</a>
																			</div>
																		</div>
																	</div>
																	<span class="fw-semibold d-block mb-1">Appointments</span>
																	<h3 class="card-title mb-2"><?php echo $Appointments; ?></h3>
																	<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>Get Schedule</small>
																</div>


																<!-- APPOINTMENTS -->

																<!--  -->




																</p>
																<a href="appointment-history.php"><button type="button" class="btn btn-primary mb-2 d-grid w-100">Get Schedule</button></a>
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

							<div class="col-lg-4 col-md-4 order-1">
								<div class="row">
									<div class="col-lg-6 col-md-12 col-6 mb-4">
										<div class="card">
											<div class="card-body">
												<div class="card-title d-flex align-items-start justify-content-between">
													<div class="avatar flex-shrink-0">
														<img src="/assets2/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
													</div>
													<div class="dropdown">
														<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="bx bx-dots-vertical-rounded"></i>
														</button>
														<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
															<a class="dropdown-item" href="javascript:void(0);">View More</a>
															<a class="dropdown-item" href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
												<span class="fw-semibold d-block mb-1">Total Doctors</span>
												<h3 class="card-title mb-2"><?php echo $DocCount; ?></h3>
												<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Get Schedule</small>
											</div>
										</div>
									</div>



									<div class="col-lg-6 col-md-12 col-6 mb-4">
										<div class="card">
											<div class="card-body">
												<div class="card-title d-flex align-items-start justify-content-between">
													<div class="avatar flex-shrink-0">
														<img src="/assets2/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
													</div>
													<div class="dropdown">
														<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="bx bx-dots-vertical-rounded"></i>
														</button>
														<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
															<a class="dropdown-item" href="javascript:void(0);">View More</a>
															<a class="dropdown-item" href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
												<span class="fw-semibold d-block mb-1">Total Patients</span>
												<h3 class="card-title mb-2"><?php echo $UserCount; ?></h3>
												<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Get Appointments</small>
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
															NXT Gen's AI assistant<a href="ai.php"> NXT AI</a> will help you out whenever you get stucked.
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
															Get Appointment Calander <a href="appointment-calander.php">Click Here</a>
														</p>
														<p class="mb-0">
															Google Calander Login <a href="#">Click Here</a>
														</p>
													</div>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>
							<!--/ Total Revenue -->
							<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
								<div class="row">
									<div class="col-6 mb-4">
										<div class="card">
											<div class="card-body">
												<div class="card-title d-flex align-items-start justify-content-between">
													<div class="avatar flex-shrink-0">
														<img src="/assets2/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
													</div>
													<div class="dropdown">
														<button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="bx bx-dots-vertical-rounded"></i>
														</button>
														<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
															<a class="dropdown-item" href="javascript:void(0);">View More</a>
															<a class="dropdown-item" href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
												<span class="d-block mb-1">Queries</span>
												<h3 class="card-title text-nowrap mb-2"><?php echo $Queries; ?></h3>
												<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> Read Queries</small>
											</div>
										</div>
									</div>
									<div class="col-6 mb-4">
										<div class="card">
											<div class="card-body">
												<div class="card-title d-flex align-items-start justify-content-between">
													<div class="avatar flex-shrink-0">
														<img src="/assets2/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
													</div>
													<div class="dropdown">
														<button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="bx bx-dots-vertical-rounded"></i>
														</button>
														<div class="dropdown-menu" aria-labelledby="cardOpt1">
															<a class="dropdown-item" href="javascript:void(0);">View More</a>
															<a class="dropdown-item" href="javascript:void(0);">Delete</a>
														</div>
													</div>
												</div>
												<span class="fw-semibold d-block mb-1">Appointments</span>
												<h3 class="card-title mb-2"><?php echo $Appointments; ?></h3>
												<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>Get Schedule</small>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 mb-4">
										<!-- <div class="card">
											<div class="card-body">
												<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
													<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
														<div class="card-title">
															<h5 class="text-nowrap mb-2">Appointments</h5>
															<span class="badge bg-label-warning rounded-pill">Year 2023</span>
														</div>
														<div class="mt-sm-auto">
															<small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i>Growth</small>
															<h3 class="mb-0"></h3>
														</div>
													</div>
													<div id="profileReportChart"></div>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>













					</div>
				</div>



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





</body>

</html>