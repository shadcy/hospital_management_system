<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../include/config.php');
include_once("../include/check_login_and_perms.php");

$userType = UserTypeEnum::Doctor->value;
$pageHref = basename(__FILE__);

if (!check_login_and_perms($userType)) {
    exit;
}


if (isset($_GET['roll'])) {
    $ret = mysqli_execute_query($con, "SELECT users.fullName,students.rollNumber,departments.name from students join users on users.id=students.id join departments on departments.id=students.departmentId where students.rollNumber = ?", [$_GET['roll']]);
    $row = mysqli_fetch_array($ret);

    if ($row === null) {
        http_response_code(400);
        $response = array('error' => "No student with this roll number exists.");
        echo json_encode($response);
        exit;
    }

    $response = array('name' => $row['fullName'], 'department' => $row['name'], 'rollNumber' => $row['rollNumber']);
    echo json_encode($response);
}
