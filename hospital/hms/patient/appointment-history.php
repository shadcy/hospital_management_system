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

include_once("../include/appointments.php");

if (isset($_GET['action'])) {
	mysqli_execute_query($con, "update appointments set patientStatus='0' where id = ? AND patientId = ?", [$_GET['id'], $_SESSION['id']]); #Done2
	$_SESSION['msg'] = "Your appointment has been cancelled!";
}

$FILTER_OPTIONS = ['pnd' => 'Pending', 'acc' => 'Accepted', 'cmp' => 'Completed', 'cnca' => 'Cancelled by Admin', 'cncd' => 'Cancelled by Doctor', 'cncp' => 'Cancelled by Patient'];
$filter_value = getFilterValue('acc');

$queryStr = "select users.fullName as docname, specializations.name as specializationName,appointments.*  from appointments join doctors on doctors.id=appointments.doctorId join specializations on specializations.id=doctors.specializationId join users on users.id=doctors.id";
$countStr = "select COUNT(*) from appointments";
$whereClause = " where appointments.patientId = ?";
$queryParams = [$_SESSION['id']];

switch ($filter_value) {
	case 'pnd':
		$whereClause .= " AND appointments.status = 1 AND appointments.patientStatus = 1";
		break;
	case 'acc':
		$whereClause .= " AND appointments.status = 2 AND appointments.patientStatus = 1 AND appointments.doctorStatus = 1";
		break;
	case 'cnca':
		$whereClause .= " AND appointments.status = 0";
		break;
	case 'cncd':
		$whereClause .= " AND appointments.doctorStatus = 0";
		break;
	case 'cncp':
		$whereClause .= " AND appointments.patientStatus = 0";
		break;
	case 'cmp':
		$whereClause .= " AND appointments.status = 3";
		break;
}

$ITEMS_PER_PAGE = 20;
$tableColCount = 9;
$tableHeadRow = '<th class="center">#</th>
<th class="hidden-xs">Doctor Name</th>
<th>Specialization</th>
<th>Consultancy Fee</th>
<th>Appointment Date / Time </th>
<th>Appointment Creation Date </th>
<th>Current Status</th>
<th>Action</th>';

function getTableRowContents($row)
{
	$rowContents = [
		['class' => 'hidden-xs', 'value' => $row['docname']],
		$row['specializationName'],
		$row['consultancyFees'],
		$row['date'] . ' / ' . $row['time'],
		$row['postingDate'],
		getAppointmentStatus($row)
	];

	if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1) && ($row['status'] == 2 || $row['status'] == 1)) {
		$rowContents[] = [[
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
