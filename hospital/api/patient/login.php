<?php
header("Access-Control-Allow-Origin:*");
// Other CORS headers as needed

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include("../../hms/include/config.php");

$userType = UserTypeEnum::Patient->value;

$puname = $_POST['username'];
$ppwd = md5($_POST['password']);
$sql = mysqli_execute_query($con, "SELECT * FROM users WHERE email=? and password=? and type = ? and isActive = 1;", [$puname, $ppwd, $userType]);
$ret = mysqli_fetch_array($sql);
if ($ret) {
    // $_SESSION['login'] = $_POST['username'];
    // $_SESSION['id'] = $ret['id'];
    // $_SESSION['userType'] = $userType;
    // $_SESSION['name'] = $ret['fullName'];
    $pid = $ret['id'];
    $host = $_SERVER['HTTP_HOST'];
    $uip = $_SERVER['REMOTE_ADDR'];
    $status = 1;
    // For stroing log if user login successfull
    mysqli_execute_query($con, "insert into logs(userId,username,ip,status,type) values(?,?,?,?,?)", [$pid, $puname, $uip, $status, $userType]);
    echo json_encode(['error' => false, 'full_name' => $ret['fullName'], 'user_id' => $ret['id']]);
} else {
    // For stroing log if user login unsuccessfull
    $_SESSION['login'] = $_POST['username'];
    $uip = $_SERVER['REMOTE_ADDR'];
    $status = 0;
    mysqli_execute_query($con, "insert into logs(username,ip,status,type) values(?,?,?,?)", [$puname, $uip, $status, $userType]);
    echo json_encode(['error' => true, 'message' => 'Invalid username or password']);
}
