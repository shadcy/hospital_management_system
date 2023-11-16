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
$dashItems = [
	[
		'icon' => 'smile-o',
		'title' => 'My Profile',
		'href' => 'edit-profile.php',
		'linkText' => 'Update Profile',
	],
	[
		'icon' => 'paperclip',
		'title' => 'My Appointments',
		'href' => 'appointment-history.php',
		'linkText' => 'View Appointment History',
	],
	[
		'icon' => 'terminal',
		'title' => 'Pink Slip',
		'href' => 'gen.php',
		'linkText' => 'Generate',
	],
	[
		'icon' => 'book',
		'title' => 'Hospital Mail',
		'href' => 'mail.php',
		'linkText' => 'Generate',
	],
	[
		'icon' => 'ambulance',
		'title' => 'Ambulance',
		'href' => 'ambulance.php',
		'linkText' => 'Generate',
	],
	[
		'icon' => 'search',
		'title' => 'Search Patients',
		'href' => 'search.php',
		'linkText' => 'Search',
	],
	[
		'icon' => 'user',
		'title' => 'Add Patients',
		'href' => 'add-patient.php',
		'linkText' => 'Add',
	],
	[
		'icon' => 'ambulance',
		'title' => 'Manage Patients',
		'href' => 'manage-patient.php',
		'linkText' => 'Manage',
	],
	[
		'icon' => 'lock',
		'title' => 'Encryption',
		'href' => 'encrypt.php',
		'linkText' => 'Encryption',
	],
	// Add more items as needed
];

include_once("../templates/dashboard.php");
