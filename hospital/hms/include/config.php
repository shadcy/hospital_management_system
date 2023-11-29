<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hms_new');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

enum UserTypeEnum: int
{
    case Admin = 1;
    case Doctor = 2;
    case Patient = 0;
}

const UserTypeAsString = [
    0 => "Student",
    1 => "Admin",
    2 => "Doctor"
];
