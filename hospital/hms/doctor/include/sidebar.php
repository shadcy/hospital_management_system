<?php $items = [
	[
		'name' => 'Dashboard',
		'href' => 'dashboard.php',
		'icon' => 'home',
	],
	[
		'name' => 'Appointment History',
		'href' => 'appointment-history.php',
		'icon' => 'list',
	],
	[
		'name' => 'Patients',
		'icon' => 'user',
		'subitems' => [
			['name' => 'Add Patient', 'href' => 'add-patient.php'],
			['name' => 'Manage Patient', 'href' => 'manage-patient.php'],
		],
	],
	[
		'name' => 'Search',
		'href' => 'search.php',
		'icon' => 'search',
	],
	[
		'name' => 'Pink slip',
		'icon' => 'user',
		'subitems' => [
			['name' => 'Pink slip V4.2.4', 'href' => './PinkSlip_Gen/PSlip.php'],
			['name' => 'Pink slip V4.2.5', 'href' => 'gen.php'],
		],
	],
	[
		'name' => 'HMS Mail',
		'href' => 'mail.php',
		'icon' => 'email',
	],
	[
		'name' => 'Ambulance',
		'href' => 'ambulance.php',
		'icon' => 'car',
	],
	[
		'name' => 'Encryption',
		'href' => 'enc.php',
		'icon' => 'key',
	],
];
include_once("../include/sidebar.php");
