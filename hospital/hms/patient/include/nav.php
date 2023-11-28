<?php
$navItems = [
    [
        'href' => 'dashboard.php',
        'icon' => 'home',
        'name' => 'Dashboard',
    ],
    [
        'href' => 'edit-profile.php',
        'icon' => 'user',
        'name' => 'My Profile',
    ],
    'Appointments & AI Help', // This will create a menu header with the text 'Doctors'
    [
        'href' => 'ambulance.php',
        'icon' => 'car',
        'name' => 'Ambulance',
    ],
    [
        'href' => 'mail.php',
        'icon' => 'file',
        'name' => 'HMS Mail',
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
    'Apps & Queries', // This will create a menu header with the text 'Patients'
    [
        'href' => 'getourapp.php',
        'icon' => 'mobile',
        'name' => 'Get Our App',
    ],
    [
        'href' => 'queries.php',
        'icon' => 'error',
        'name' => 'Queries',
    ],

];


include_once("../include/nav.php");
