<?php
function getAppointmentStatus($row)
{
    if (($row['patientStatus'] == 1) && ($row['doctorStatus'] == 1)) {
        switch ($row['status']) {
            case 0:
                return 'Cancelled by Admin';
            case 1:
                return 'Pending';
            case 2:
                return 'Accepted';
            case 3:
                return 'Completed';
            default:
                return 'Unknown Status';
        }
    } elseif (($row['patientStatus'] == 0) && ($row['doctorStatus'] == 1)) {
        return "Cancelled by Patient";
    } elseif ($row['doctorStatus'] == 0) {
        return "Cancelled by Doctor";
    }
}

function getFilterValue($defaultFilterValue)
{
    global $FILTER_OPTIONS;

    if (isset($_GET['filter']) && (array_key_exists($_GET['filter'], $FILTER_OPTIONS) || $_GET['filter'] === '')) {
        return $_GET['filter'];
    } else {
        return $defaultFilterValue;
    }
}
