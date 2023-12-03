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

include_once("../include/appointments.php");

if (isset($_GET['action'])) {
	if ($_GET['action'] === 'cancel') {
		mysqli_execute_query($con, "update appointments set doctorStatus=0 where id =? AND doctorId=?", [$_GET['id'], $_SESSION['id']]);
		$_SESSION['msg'] = "The appointment has been cancelled!";
	} elseif ($_GET['action'] === 'start') {
		$sql = mysqli_execute_query($con, "select * from appointments where id =? AND doctorId=? AND status = 2 AND doctorStatus = 1 AND userStatus = 1", [$_GET['id'], $_SESSION['id']]);
		$row = mysqli_fetch_assoc($sql);

		if ($row) {
			$toAppointmentPage = true; # Set false if needed

			if ($isset($_SESSION['current_appt_id'])) {
				if(isset($_SESSION['current_appt_overwrite_time']) && $_SERVER['REQUEST_TIME']-$_SESSION['current_appt_overwrite_time']>15e3){
					unset($_SESSION['current_appt_overwrite_time']);
				}else{
					echo "<script>alert('It would seem that you are already in an active appointment.\n\nTo switch to this appointment, redo the start action within 15 seconds.');</script>";
					$_SESSION['current_appt_overwrite_time'] = $_SERVER['REQUEST_TIME'];
					$toAppointmentPage = false;
				}
			}

			if($toAppointmentPage){
				$_SESSION['current_appt_id'] = $_GET['id'];
				$_SESSION['current_appt_pId'] = $row['patientId'];
				$_SESSION['current_appt_timestamp'] = $_SERVER['REQUEST_TIME'];
				echo "<script>window.location.href = 'appointment.php'</script>";
				exit;
			}
		} else {
			echo "<script>alert('No appointment matching the given details was found.');</script>";
			// echo "<script>window.location.href = 'index.php'</script>";
			$_SESSION['msg'] = "The appointment was not found";
		}
	}
}

$FILTER_OPTIONS = ['acc' => 'Accepted', 'cmp' => 'Completed', 'cncl' => 'Cancelled'];
$filter_value = getFilterValue('acc');

$queryStr = "select users.fullName as fname,appointments.*  from appointments join users on users.id=appointments.patientId";
$countStr = "select COUNT(*) from appointments";
$whereClause = " WHERE appointments.doctorId=?";
$queryParams = [$_SESSION['id']];

switch ($filter_value) {
	case 'acc':
		$whereClause .= " AND appointments.status = 2 AND appointments.patientStatus = 1 AND appointments.doctorStatus = 1";
		break;
	case 'cncl':
		$whereClause .= " AND appointments.status = 2 AND (appointments.patientStatus = 0 OR appointments.doctorStatus = 0)";
		break;
	case 'cmp':
		$whereClause .= " AND appointments.status = 3";
		break;
	default:
		$whereClause .= " AND appointments.status >= 2";
		break;
}

$ITEMS_PER_PAGE = 20;
$tableColCount = 6;
$tableHeadRow = '<th class="center">#</th>
<th class="hidden-xs">Student\'s Name</th>
<!-- <th>Specialization</th> -->
<th>Consultancy Fee</th>
<th>Appointment Date / Time </th>
<th>Appointment Creation Date </th>
<th>Current Status</th>
<th>Action</th>';

function getTableRowContents($row)
{
	$rowContents = [
		['class' => 'hidden-xs', 'value' => $row['fname']],
		$row['consultancyFees'],
		$row['date'] . ' / ' . $row['time'],
		$row['postingDate'],
		getAppointmentStatus($row)
	];

	if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1) && ($row['status'] == 2)) {
		$rowContents[] = [[
			'href' => 'appointment-history.php?id=' . $row['id'] . '&action=start',
			'prompt' => "Are you sure you want to start this appointment scheduled for" . $row['date'] . ' / ' . $row['time'] . '?',
			'title' => 'Start Appointment', 'icon' => 'flag'
		], [
			'href' => 'appointment-history.php?id=' . $row['id'] . '&action=cancel',
			'prompt' => 'Are you sure you want to cancel this appointment?',
			'title' => 'Cancel Appointment', 'icon' => 'trash'
		]];
	} else {
		$rowContents[] = '';
	}

	return $rowContents;
}

include_once("../templates/appointment-list.php");
