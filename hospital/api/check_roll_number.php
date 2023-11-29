<?php
include_once('../hms/include/config.php');
if (!empty($_POST["rollNumber"])) {
    $result = mysqli_execute_query($con, "SELECT 1 FROM students WHERE rollNumber=?", [$_POST["rollNumber"]]); #https://stackoverflow.com/questions/4253960/sql-how-to-properly-check-if-a-record-exists
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo json_encode([
            'html' => "<span style='color:red'> Roll number already registered.</span>",
            'valid' => false
        ]);
    } else {
        echo json_encode([
            'html' => "<span style='color:green'> Roll number not yet registered.</span>",
            'valid' => true
        ]);
    }
}
