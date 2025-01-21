<?php

require_once "../config.php";
$user_id = $_POST['user_id'];

$sql = "SELECT event_limit FROM event_reg_limit WHERE id=1";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $event_limit);
        mysqli_stmt_fetch($stmt);

        $sql = "SELECT * FROM registered_event WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_user_id);
            $param_user_id = $user_id;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) >= $event_limit) { //Number 2 would be dynamic
                    echo "max reached";
                } else {
                    echo "NOT max reached";
                }
            } else {
                echo "something wrong";
            }
        } else {
            echo "something wrong";
        }
    }
}

?>