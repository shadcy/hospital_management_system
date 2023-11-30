<?php
header('Content-Type: application/json');

include_once($_SERVER['DOCUMENT_ROOT'] . '/hms/include/config.php');
$userType = UserTypeEnum::Patient->value;

$ret = mysqli_query($con, "select doctors.* , users.fullName from doctors join users on users.id = doctors.id;");
$doctors = array();

while ($row = mysqli_fetch_assoc($ret)) {
    $doctors[] = array(
        'id' => (int)$row['id'],  // Cast id to integer
        'name' => $row['fullName'],
        'specialization_id' => (int) $row['specializationId']
    );
}

echo json_encode(array('doctorsList' => $doctors));
