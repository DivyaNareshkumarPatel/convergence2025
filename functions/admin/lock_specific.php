<?php

require_once "../config.php";
$user_id = $_POST['user_id'];

$sql = "SELECT profile_lock FROM user WHERE user_id=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_user_id);
    $param_user_id = $user_id;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $profile_lock);
        mysqli_stmt_fetch($stmt);
        if($profile_lock == 1) {
            echo "lock already";
        }
        else {
            $sql = "UPDATE user SET profile_lock=1 WHERE user_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $param_user_id);
                $param_user_id = $user_id;
                if (mysqli_stmt_execute($stmt)) {
                    echo "success";
                }
            }
        }
    }
}

?>