<?php $userTypeString = UserTypeAsString[$userType];
$docCount = function () {
    global $con;
    $result = mysqli_query($con, "SELECT COUNT(*) as doctorCount FROM doctors;");
    $row = mysqli_fetch_array($result);
    return '' . htmlentities($row['doctorCount']);
};

// Call the function and store the result in a variable
$DocCount = $docCount();

$userCount = function () {
    global $con;
    $result = mysqli_query($con, "SELECT COUNT(*) as userCount FROM users;");
    $row = mysqli_fetch_array($result);
    return '' . htmlentities($row['userCount']);
};

$UserCount = $userCount();


$appointments = function () {
    global $con;
    $result = mysqli_query($con, "SELECT COUNT(*) as appointmentCount FROM appointments;");
    $row = mysqli_fetch_array($result);
    return '' . htmlentities($row['appointmentCount']);
};

$Appointments = $appointments();


$queries = function () {
    global $con;
    $result = mysqli_query($con, "SELECT COUNT(*) as queryCount FROM contact_us where isRead = 0;");
    $row = mysqli_fetch_array($result);
    return '' . htmlentities($row['queryCount']);
};

$Queries = $queries();
