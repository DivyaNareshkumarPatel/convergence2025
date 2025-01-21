<?php

require_once "../config.php";
$user_id = $_POST['user_id'];
$event_id = $_POST['event_id'];

$sql = "SELECT * FROM registered_event WHERE user_id = ? AND event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_user_id, $param_event_id);
    $param_user_id = $user_id;
    $param_event_id = $event_id;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) >= 1) {
            echo "already registered";
        }
        else {
            $sql = "INSERT INTO registered_event VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $param_user_id, $param_event_id);
                $param_user_id = $user_id;
                $param_event_id = $event_id;
                if (mysqli_stmt_execute($stmt)) {
                    echo "registered";
                } else {
                    echo "something wrong";
                }
            } else {
                echo "something wrong";
            } 
        }
    } else {
        echo "something wrong";
    }
} else {
    echo "something wrong";
}

?>