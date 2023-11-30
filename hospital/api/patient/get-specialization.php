<?php
header('Content-Type: application/json');

include_once($_SERVER['DOCUMENT_ROOT'] . '/hms/include/config.php');
$userType = UserTypeEnum::Patient->value;

$ret = mysqli_query($con, "select * from specializations;");
$specializations = array();

while ($row = mysqli_fetch_assoc($ret)) {
    $specializations[] = array(
        'id' => (int)$row['id'],  // Cast id to integer
        'name' => (string)$row['name']
    );
}

echo json_encode(array('specializations' => $specializations));
