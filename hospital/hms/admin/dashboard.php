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


$dashItems = [
	[
		'icon' => 'smile-o',
		'title' => 'Manage Users',
		'href' => 'manage-users.php',
		'linkFunction' => function () {
			global $con;
			$result = mysqli_query($con, "SELECT COUNT(*) as userCount FROM users;");
			$row = mysqli_fetch_array($result);
			return 'Total Users: ' . htmlentities($row['userCount']);
		},
	],
	[
		'icon' => 'users',
		'title' => 'Manage Doctors',
		'href' => 'manage-doctors.php',
		'linkFunction' => function () {
			global $con;
			$result = mysqli_query($con, "SELECT COUNT(*) as doctorCount FROM doctors;");
			$row = mysqli_fetch_array($result);
			return 'Total Doctors: ' . htmlentities($row['doctorCount']);
		},
	],
	[
		'icon' => 'terminal',
		'title' => 'Appointments',
		'href' => 'appointment-history.php',
		'linkFunction' => function () {
			global $con;
			$result = mysqli_query($con, "SELECT COUNT(*) as appointmentCount FROM appointments;");
			$row = mysqli_fetch_array($result);
			return 'Total Appointments: ' . htmlentities($row['appointmentCount']);
		},
	],
	[
		'icon' => 'file',
		'title' => 'Unread Queries',
		'href' => 'unread-queries.php',
		'linkFunction' => function () {
			global $con;
			$result = mysqli_query($con, "SELECT COUNT(*) as queryCount FROM contact_us where isRead = 0;");
			$row = mysqli_fetch_array($result);
			return 'Total New Queries: ' . htmlentities($row['queryCount']);
		},
	],
	[
		'icon' => 'book',
		'title' => 'Read Queries',
		'href' => 'read-query.php',
		'linkText' => 'Read',
	],
	[
		'icon' => 'users',
		'title' => 'Doctor Logs',
		'href' => 'doctor-logs.php',
		'linkText' => 'Check',
	],
	[
		'icon' => 'users',
		'title' => 'Patient Logs',
		'href' => 'user-logs.php',
		'linkText' => 'Check',
	],
	[
		'icon' => 'search',
		'title' => 'Patient search',
		'href' => 'patient-search.php',
		'linkText' => 'Search',
	],
	[
		'icon' => 'reddit',
		'title' => 'B/W Dates Report',
		'href' => 'between-dates-reports.php',
		'linkText' => 'Check',
	],
	[
		'icon' => 'file',
		'title' => 'About Us',
		'href' => 'about-us.php',
		'linkText' => 'Check',
	],
	[
		'icon' => 'phone',
		'title' => 'Contact Us',
		'href' => 'contact.php',
		'linkText' => 'Check',
	],
	// [
	// 	'icon' => 'user',
	// 	'title' => 'Admin Profile',
	// 	'href' => 'logout.php',
	// 	'linkText' => 'Check',
	// ],
	// Add more items as needed
];

include_once("../templates/dashboard.php");
