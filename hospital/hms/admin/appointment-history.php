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

include_once("../include/appointments.php");

if (isset($_GET['action'])) {
	if ($_GET['action'] === 'cancel') {
		mysqli_execute_query($con, "update appointments set status=0 where id =?", [$_GET['id']]);
		$_SESSION['msg'] = "The appointment has been cancelled";
	} elseif ($_GET['action'] === 'accept') {
		mysqli_execute_query($con, "update appointments set status=2 where id =?", [$_GET['id']]);
		$_SESSION['msg'] = "The appointment has been accepted";
	}
}

$FILTER_OPTIONS = ['pnd' => 'Pending', 'acc' => 'Accepted', 'cmp' => 'Completed', 'cnca' => 'Cancelled by Admin', 'cncd' => 'Cancelled by Doctor', 'cncp' => 'Cancelled by Patient'];
$filter_value = getFilterValue('pnd');

$queryStr = "select doctor_users.fullName as docname, users.fullName as pname, specializations.name as doctorSpecialization, appointments.*, doctors.fees as consultancyFees from appointments join users on users.id=appointments.patientId join doctors on doctors.id=appointments.doctorId join specializations on specializations.id=doctors.specializationId join users as doctor_users on doctor_users.id=doctors.id";
$countStr = "select COUNT(*) from appointments";
$whereClause = "";
$queryParams = [];

switch ($filter_value) {
	case 'pnd':
		$whereClause .= " WHERE appointments.status = 1 AND appointments.patientStatus = 1";
		break;
	case 'acc':
		$whereClause .= " WHERE appointments.status = 2 AND appointments.patientStatus = 1 AND appointments.doctorStatus = 1";
		break;
	case 'cnca':
		$whereClause .= " WHERE appointments.status = 0";
		break;
	case 'cncd':
		$whereClause .= " WHERE appointments.doctorStatus = 0";
		break;
	case 'cncp':
		$whereClause .= " WHERE appointments.patientStatus = 0";
		break;
	case 'cmp':
		$whereClause .= " WHERE appointments.status = 3";
		break;
}

$ITEMS_PER_PAGE = 20;
$tableColCount = 9;
$tableHeadRow = '<th class="center">#</th>
<th class="hidden-xs">Doctor Name</th>
<th>Patient Name</th>
<th>Specialization</th>
<th>Fees</th>
<th>Appointment Date / Time </th>
<th>Appointment Creation Date </th>
<th>Current Status</th>
<th>Action</th>';

function getTableRowContents($row)
{
	$rowContents = [
		['class' => 'hidden-xs', 'value' => $row['docname']],
		['class' => 'hidden-xs', 'value' => $row['pname']],
		$row['doctorSpecialization'],
		$row['consultancyFees'],
		$row['date'] . ' / ' . $row['time'],
		$row['postingDate'],
		getAppointmentStatus($row)
	];

	if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1) && ($row['status'] == 2 || $row['status'] == 1)) {
		if ($row['status'] == 1) {
			$rowContents[] = [[
				'href' => 'appointment-history.php?id=' . $row['id'] . '&action=accept',
				'prompt' => 'Are you sure you want to acept this appointment?',
				'title' => 'Accept Appointment', 'icon' => 'check-square'
			], [
				'href' => 'appointment-history.php?id=' . $row['id'] . '&action=cancel',
				'prompt' => 'Are you sure you want to cancel this appointment?',
				'title' => 'Cancel Appointment', 'icon' => 'trash'
			]];
		} else {
			$rowContents[] = [[
				'href' => 'appointment-history.php?id=' . $row['id'] . '&action=cancel',
				'prompt' => 'Are you sure you want to cancel this appointment?',
				'title' => 'Cancel Appointment', 'icon' => 'trash'
			]];
		}
	} else {
		$rowContents[] = '';
	}

	return $rowContents;
}

include_once("../templates/appointment-list.php");
