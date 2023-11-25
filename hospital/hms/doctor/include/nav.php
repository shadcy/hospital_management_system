<?php

$navItems
    = [
        [
            'href' => 'dashboard.php',
            'icon' => 'home-circle',
            'name' => 'Dashboard',
        ],
        [
            'icon' => 'terminal',
            'name' => 'Login History',
            'subitems' => [
                [
                    'href' => 'logs.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Login History',
                ],

                [
                    'href' => 'logs.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Attendance',
                ],
            ],
        ],
        'Patients', // This will create a menu header with the text 'Doctors'
        [
            'icon' => 'user',
            'name' => 'Patient',
            'subitems' => [
                [
                    'href' => 'add-patient.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Add Patients',
                ],

                [
                    'href' => 'manage-patient.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Manage Patient',
                ],

                [
                    'href' => 'appointment-history.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Appointments',
                ],
            ],
        ],
        [
            'icon' => 'lock-open-alt',
            'name' => 'Medical Certificate',
            'subitems' => [
                [
                    'href' => 'gen.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Pink Slip',
                ],
                [
                    'href' => '#',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Format',
                ],
            ],
        ],
        [
            'icon' => 'bot',
            'name' => 'AI Assistant',
            'subitems' => [
                [
                    'href' => 'ai.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Chat Bot',
                ],
                [
                    'href' => 'ai.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'AI Assistant',
                ],
            ],
        ],
        'Patient Management', // This will create a menu header with the text 'Patients'
        [
            'href' => 'search.php',
            'icon' => 'collection',
            'name' => 'Patient Search',
        ],
        [
            'icon' => 'lock',
            'name' => 'Appointments',
            'subitems' => [
                [
                    'href' => 'appointment-history.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'New Appointments',
                ],
                [
                    'href' => 'appointment-calander.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Appointment Calander',
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
        'Doctors Profile', // This will create a menu header with the text 'Website & Management'
        [
            'icon' => 'folder',
            'name' => 'HMS Mail',
            'subitems' => [
                [
                    'href' => 'mail.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => ' HMS Mail',
                ],

            ],
        ],
        [
            'icon' => 'user',
            'name' => 'Profile',
            'subitems' => [
                [
                    'href' => 'edit-profile.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'My Profile',
                ],
                [
                    'href' => 'logs.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Login History',
                ],
                [
                    'href' => 'reset-password.php',
                    'icon' => 'some-icon', // Add the appropriate icon
                    'name' => 'Reset Password',
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
            'href' => 'maintenance.php',
            'name' => 'Under Maintenance',
        ],
    ];


include_once("../include/nav.php");