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

if (isset($_GET['del'])) {
	$docid = $_GET['id'];
	mysqli_execute_query($con, "delete from doctors where id =?;", [$docid]);
	mysqli_execute_query($con, "update users set isActive=0 where id =?;", [$docid]);
	$_SESSION['msg'] = "data deleted !!";
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
	$pageName = 'Manage Doctors';
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

						<div class="card">
							<div class="table-responsive text-nowrap">

								<br>
								<br>
								<div class="col-xl">
									<div class="card mb-4">
										<div class="card-body">
											<p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
												<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
											<table class="table table-hover" id="sample-table-1">
												<thead>
													<tr>
														<th class="center">#</th>
														<th>Specialization</th>
														<th class="hidden-xs">Doctor Name</th>
														<th>Creation Date </th>
														<th>Action</th>

													</tr>
												</thead>
												<tbody>
													<?php
													$sql = mysqli_query($con, "select doctors.*,users.fullName, specializations.name as specialization from doctors join users on users.id = doctors.id join specializations on specializations.id = doctors.specializationId;");
													$cnt = 1;
													while ($row = mysqli_fetch_array($sql)) {
													?>

														<tr>
															<td class="center"><?php echo $cnt; ?>.</td>
															<td class="hidden-xs"><?php echo $row['specialization']; ?></td>
															<td><?php echo $row['fullName']; ?></td>
															<td><?php echo $row['creationDate']; ?>
															</td>

															<td>
																<div class="visible-md visible-lg hidden-sm hidden-xs">
																	<a href="edit-doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="bx bx-pencil"></i></a>

																	<a href="manage-doctors.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class='bx bxs-message-square-x'></i></a>
																</div>
																<div class="visible-xs visible-sm hidden-md hidden-lg">
																	<!-- <div class="btn-group" dropdown is-open="status.isopen">
                            <button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
                                <i class="bx bx-dots-vertical-rounded"></i>&nbsp;<span class="caret"></span>
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
                        </div> -->
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