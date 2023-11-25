<?php $items = [
	[
		'name' => 'Dashboard',
		'href' => 'dashboard.php',
		'icon' => 'home',
	],
	[
		'name' => 'Doctors',
		'icon' => 'user',
		'subitems' => [
			['name' => 'Doctor Specialization', 'href' => 'doctor-specialization.php'],
			['name' => 'Add Doctor', 'href' => 'add-doctor.php'],
			['name' => 'Manage Doctors', 'href' => 'Manage-doctors.php'],
		],
	],
	[
		'name' => 'Users',
		'icon' => 'user',
		'subitems' => [
			['name' => 'Manage Users', 'href' => 'manage-users.php'],
		],
	],
	[
		'name' => 'Patients',
		'icon' => 'user',
		'subitems' => [
			['name' => 'Manage Patients', 'href' => 'manage-patient.php'],
		],
	],
	[
		'name' => 'Appointment History',
		'href' => 'appointment-history.php',
		'icon' => 'file',
	],
	[
		'name' => 'Contactus Queries',
		'icon' => 'files',
		'subitems' => [
			['name' => 'Unread Query', 'href' => 'unread-queries.php'],
			['name' => 'Read Query', 'href' => 'read-query.php'],
		],
	],
	[
		'name' => 'Doctor Session Logs',
		'href' => 'doctor-logs.php',
		'icon' => 'list',
	],
	[
		'name' => 'User Session Logs',
		'href' => 'user-logs.php',
		'icon' => 'list',
	],
	[
		'name' => 'Reports',
		'icon' => 'files',
		'subitems' => [
			['name' => 'B/w dates reports', 'href' => 'between-dates-reports.php'],
		],
	],
	[
		'name' => 'Pages',
		'icon' => 'file',
		'subitems' => [
			['name' => 'About Us', 'href' => 'about-us.php'],
			['name' => 'Contact Us', 'href' => 'contact.php'],
		],
	],
	[
		'name' => 'Patient Search',
		'href' => 'patient-search.php',
		'icon' => 'search',
	],
];

include_once("../include/sidebar.php");
