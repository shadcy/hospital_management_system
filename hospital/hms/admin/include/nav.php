<?php
$navItems = [
    [
        'href' => 'dashboard.php',
        'icon' => 'home-circle',
        'name' => 'Dashboard',
    ],
    [
        'icon' => 'terminal',
        'name' => 'Pink Slip',
        'subitems' => [
            [
                'href' => 'maintenance.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Verification',
            ],
            [
                'href' => 'maintenance.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Pink Slip V2.2.2',
            ],
            [
                'href' => 'maintenance.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Format',
            ],
        ],
    ],
    'Doctors', // This will create a menu header with the text 'Doctors'
    [
        'icon' => 'user',
        'name' => 'Doctor',
        'subitems' => [
            [
                'href' => 'add-doctor.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Add Doctor',
            ],
            [
                'href' => 'manage-doctors.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Manage Doctor',
            ],
        ],
    ],
    [
        'icon' => 'lock-open-alt',
        'name' => 'Authentications',
        'subitems' => [
            [
                'href' => 'doctor-logs.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Doctor Session Logs',
            ],
            [
                'href' => 'doctor-logs.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Attendance',
            ],
        ],
    ],
    [
        'icon' => 'cube-alt',
        'name' => 'Specialization',
        'subitems' => [
            [
                'href' => 'doctor-specilization.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Add Specialization',
            ],
            [
                'href' => 'maintenance.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Under Maintenance',
            ],
        ],
    ],
    'Patients', // This will create a menu header with the text 'Patients'
    [
        'href' => 'patient-search.php',
        'icon' => 'collection',
        'name' => 'Patient Search',
    ],
    [
        'icon' => 'lock',
        'name' => 'Appointments & Logs',
        'subitems' => [
            [
                'href' => 'user-logs.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Patient Session Logs',
            ],
            [
                'href' => 'appointment-history.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Appointment History',
            ],
        ],
    ],
    [
        'icon' => 'copy',
        'name' => 'Reports',
        'subitems' => [
            [
                'href' => 'between-dates-reports.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Date B/W Reports',
            ],
        ],
    ],
    'Website & Management', // This will create a menu header with the text 'Website & Management'
    [
        'icon' => 'detail',
        'name' => 'Web Pages',
        'subitems' => [
            [
                'href' => 'about-us.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'About Us',
            ],
            [
                'href' => 'contact.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Contact Us',
            ],
        ],
    ],
    [
        'icon' => 'book',
        'name' => 'Read Queries',
        'subitems' => [
            [
                'href' => 'read-query.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'Read Queries',
            ],
            [
                'href' => 'unread-queries.php',
                'icon' => 'some-icon', // Add the appropriate icon
                'name' => 'New Queries',
            ],
        ],
    ],
    [
        'icon' => 'car',
        'name' => 'Ambulance',
        'href' => 'maintenance.php',
    ],
    'Website', // This will create a menu header with the text 'Website'
    [
        'icon' => 'support',
        'href' => 'http://nxt.nxtdevelopers.xyz/',
        'name' => 'Support',
    ],
    [
        'icon' => 'file',
        'href' => 'documentation.php',
        'name' => 'Documentation',
    ],
];


include_once("../include/nav.php");
