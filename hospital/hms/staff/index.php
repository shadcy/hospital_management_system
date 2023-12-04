<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include("../include/config.php");

$userType = UserTypeEnum::LabTechnician->value; //Only for compatibility with template

if (isset($_SESSION['id'])) {
    if ($_SESSION['userType'] === UserTypeEnum::LabTechnician->value) {
        header("location:/hms/technician/dashboard.php");
        exit;
    } elseif ($_SESSION['userType'] === UserTypeEnum::Pharmacist->value) {
        header("location:/hms/pharmacist/dashboard.php");
        exit;
    }
}

if (isset($_POST['submit'])) {
    $puname = $_POST['username'];
    $ppwd = md5($_POST['password']);
    $ret = mysqli_execute_query($con, "SELECT * FROM users WHERE email=? and password=? and (type=? or type=?) and isActive = 1;", [$puname, $ppwd, UserTypeEnum::LabTechnician->value, UserTypeEnum::Pharmacist->value]);
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $_SESSION['name'] = $num['fullName'];
        $_SESSION['userType'] = (int) $num['type'];
        $pid = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        // For stroing log if user login successfull
        mysqli_execute_query($con, "insert into logs(userId,username,ip,status,type) values(?,?,?,?,?)", [$pid, $puname, $uip, $status, $_SESSION['userType']]);

        if ($_SESSION['userType'] === UserTypeEnum::LabTechnician->value) {
            header("location:/hms/technician/dashboard.php");
            exit;
        } elseif ($_SESSION['userType'] === UserTypeEnum::Pharmacist->value) {
            header("location:/hms/pharmacist/dashboard.php");
            exit;
        }
    } else {
        // For stroing log if user login unsuccessfull
        $_SESSION['login'] = $_POST['username'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        mysqli_execute_query($con, "insert into logs(username,ip,status,type) values(?,?,?,?)", [$puname, $uip, $status, $userType]);
        $_SESSION['errmsg'] = "Invalid username or password";

        header("location:");
    }
}
?>


<?php include_once("../templates/login.php"); ?>