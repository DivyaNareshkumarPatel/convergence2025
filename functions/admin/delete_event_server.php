<?php

require_once "../config.php";

$department = $_POST['department'];
$name = $_POST['name'];

$sql = "DELETE FROM event WHERE department_name=? AND event_name=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_department_name, $param_event_name);
    $param_department_name = $department;
    $param_event_name = $name;
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "something wrong";
    }
} else {
    echo "something wrong";
}

?>