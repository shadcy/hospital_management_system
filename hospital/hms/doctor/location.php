<?php

function haversineDistance($lat1, $lon1, $lat2, $lon2)
{
    $earthRadius = 6371000; // in meters

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c;

    return $distance;
}


// Desired location coordinates19.130903826762623, 72.9143064256012
$desiredLat = 19.130903826762623; // Replace with your desired latitude
$desiredLon = 72.9143064256012; // Replace with your desired longitude

// Loop through your attendance records
foreach ($attendanceRecords as $row) {
    // Coordinates of the current attendance record
    $rowLat = $row['latitude']; // Replace with the actual column name
    $rowLon = $row['longitude']; // Replace with the actual column name

    // Calculate the distance between the current record and the desired location
    $distance = haversineDistance($desiredLat, $desiredLon, $rowLat, $rowLon);

    // Check if the distance is within 200 meters
    if ($distance <= 200) {
        // The current record is within 200 meters of the desired location
        echo '<td>Attendance Marked</td>';
    } else {
        // The current record is more than 200 meters away from the desired location
        echo '<td>Absent</td>';
    }
}
