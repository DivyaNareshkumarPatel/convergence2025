<?php

require_once "../config.php";

$department = $_POST['department'];
$event = $_POST['event'];

$sql = "UPDATE event SET reg_close=1 WHERE department_name=? AND event_name=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_department_name, $param_event_name);
    $param_department_name = $department;
    $param_event_name = $event;
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } 
}

?>