<?php

require_once "../config.php";

$department = $_POST['department'];
$event = $_POST['event'];

$sql = "SELECT reg_close FROM event WHERE department_name=? AND event_name=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_department, $param_event);
    $param_department = $department;
    $param_event = $event;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $reg_close);
        mysqli_stmt_fetch($stmt);
        echo $reg_close;
    }
    else {
        echo "something wrong";
    }
}
else {
    echo "something wrong";
}

?>