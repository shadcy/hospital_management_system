<?php
if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/hms/include/config.php');
$userType = UserTypeEnum::Patient->value;


$sql = mysqli_execute_query($con, "select users.fullName as docname, specializations.name as specializationName,appointments.*  from appointments join doctors on doctors.id=appointments.doctorId join specializations on specializations.id=doctors.specializationId join users on users.id=doctors.id where appointments.patientId = ?", [$_POST['user_id']]); #Done2

$mappedData = array();

enum apptStatusEnum: int
{
    case PENDING = 0b0111;
    case ACCEPTED = 0b1011;
    case COMPLETED = 0b1111;
    case REJECTED = 0b0011;
    case CANCELLED = 0;
}

$mappedData = array();

// Iterate over the results
while ($row = mysqli_fetch_assoc($sql)) {
    // Map the data to a new array with desired field names
    $mappedRow = array(
        'doctor_name' => $row['docname'],
        // 'specialization' => $row['specializationName'],
        'appointment_id' => $row['id'],
        'date' => $row['date'],
        'time' => $row['time'],
        'fees' => $row['consultancyFees'],
        'appointment_status' => $row['patientStatus'] * $row['doctorStatus'] ? apptStatusEnum::from((2 << 2) + 3)->name : 'CANCELLED'
    );

    // Add the mapped row to the result array
    $mappedData[] = $mappedRow;
}

echo json_encode(['appointmentList' => $mappedData]);
