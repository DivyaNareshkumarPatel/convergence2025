<?php

require_once "../config.php";

$department = $_POST['department'];
$name = $_POST['name'];

$details_arr = [];

$sql = "SELECT event_tagline, description, rules, evaluation_criteria, date, time, venue, faculty_coordinator, student_coordinator, volunteer, time_slot FROM event WHERE department_name=? AND event_name=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_department_name, $param_event_name);
    $param_department_name = $department;
    $param_event_name = $name;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $event_tagline, $event_description, $event_rules, $evaluation_criteria, $date, $time, $venue, $faculty_coordinator, $student_coordinator, $volunteer, $time_slot);
        mysqli_stmt_fetch($stmt);

        array_push($details_arr, $event_tagline);
        array_push($details_arr, $event_description);
        array_push($details_arr, $event_rules);
        array_push($details_arr, $evaluation_criteria);
        array_push($details_arr, $date);
        array_push($details_arr, $time);
        array_push($details_arr, $venue);
        array_push($details_arr, $faculty_coordinator);
        array_push($details_arr, $student_coordinator);
        array_push($details_arr, $volunteer);
        array_push($details_arr, $time_slot);

        $details_JSON = json_encode($details_arr);
        header('Content-Type: application/json');
        echo $details_JSON;
    } else {
        echo "something wrong";
    }
} else {
    echo "something wrong";
}

?>