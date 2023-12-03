<?php
session_start();
if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/php/vendor/autoload.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hms/include/config.php');
$userType = UserTypeEnum::Doctor->value;

include_once($_SERVER['DOCUMENT_ROOT'] . "/hms/include/check_login_and_perms.php");
if (!check_login_and_perms($userType)) {
    exit;
}

use Google\Cloud\Storage\StorageClient;

if (!isset($_POST['id'])) {
    error_log(serialize($_POST));
    echo json_encode(['success' => false, 'answer' => 420]);
    exit;
}

$sql = mysqli_execute_query($con, "select patientId from appointments where id =? AND doctorId=?", [$_POST['id'], $_SESSION['id']]);
$ret = mysqli_fetch_assoc($sql);

// Replace these values with your own
$bucketName = 'iitbhms-test-bucket-123';
$fileName = 'prescriptions/' . $ret['patientId'] . '/' .  $_POST['id']  . '.png';
$dataUrl = $_POST['data']; // Your PNG data URL

// Decode the data URL to get the binary data
$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl));

// Create a StorageClient
$storage = new StorageClient([
    'keyFilePath' => $_SERVER['DOCUMENT_ROOT'] . '/vendor/php/vast-reality-405314-a522a0fd7428.json'
]);

// Get the bucket
$bucket = $storage->bucket($bucketName);

// Upload the file
$object = $bucket->upload($data, [
    'name' => $fileName,
]);

mysqli_execute_query($con, "update appointments set status=3 where id =? AND doctorId=?", [$_POST['id'], $_SESSION['id']]);
mysqli_execute_query($con, "insert into files(userId,type,location,appointmentId) value(?,2,?,?)", [$ret['patientId'], $fileName, $_POST['id']]); #Done2

echo json_encode(['success' => true, 'answer' => 420]);
