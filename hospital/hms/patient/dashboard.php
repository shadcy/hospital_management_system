<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
	error_reporting(0);
}

include('../include/config.php');
$userType = UserTypeEnum::Patient->value;
$pageHref = basename(__FILE__);

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
		'title' => 'Book Appointment',
		'href' => 'book-appointment.php',
		'linkText' => 'Book Appointment',
	],
	[
		'icon' => 'ambulance',
		'title' => 'Ambulance',
		'href' => 'ambulance.php',
		'linkText' => 'Get Ambulance',
	],
	[
		'icon' => 'book',
		'title' => 'Mailer',
		'href' => 'mail.php',
		'linkText' => 'Mail Prof.',
	],
	// Add more items as needed
];

include_once("../templates/dashboard.php");
