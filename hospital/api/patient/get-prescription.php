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

// $sql = mysqli_execute_query($con, "select patientId from appointments where id =? AND doctorId=?", [$_POST['id'], $_SESSION['id']]);
// $ret = mysqli_fetch_assoc($sql);

// Replace these values with your own
$bucketName = 'iitbhms-test-bucket-123';
$fileName = 'prescriptions/' . $_SESSION['id'] . '/' .  $_POST['id']  . '.png';

// Create a StorageClient
$storage = new StorageClient([
    'keyFilePath' => $_SERVER['DOCUMENT_ROOT'] . '/vendor/php/vast-reality-405314-a522a0fd7428.json'
]);

// Get the bucket
$bucket = $storage->bucket($bucketName);

// Define the duration for the signed URL (in seconds)
$expiration = time() + 60 * 1; // 10 minutes from now

// Generate a signed URL
$bucket = $storage->bucket($bucketName);
$object = $bucket->object($fileName);
$signedUrl = $object->signedUrl($expiration, [
    'version' => 'v4',
    'method' => 'GET',
]);

// echo "Signed URL for file '$fileName':<br>";
// echo "<a href='$signedUrl' target='_blank'>$signedUrl</a>";

echo json_encode(['success' => true, 'url' => $signedUrl]);
