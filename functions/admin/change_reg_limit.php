<?php

require_once "../config.php";
$event_limit = $_POST['event_limit'];

$sql = "UPDATE event_reg_limit SET event_limit=? WHERE id=1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $param_event_limit);
$param_event_limit = $event_limit;
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    }
}

?>