<?php

require_once "config.php";

$user_id = $_POST['user_id'];
$event_id = $_POST['event_id'];

$sql = "DELETE FROM registered_event WHERE user_id=? AND event_id=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_user_id, $param_event_id);
    $param_user_id = $user_id;
    $param_event_id = $event_id;
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    }
    else {
        echo "something wrong";
    }
}
else {
    echo "something wrong";
}

?>