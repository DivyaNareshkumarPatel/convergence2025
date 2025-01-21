<?php

require_once "config.php";
$entered_otp = $_POST['entered_otp'];
$email = $_POST['email'];

session_start();
if (isset($_SESSION['send_otp_server_check'])) {
    $sql = "SELECT * FROM otp where otp = ? AND email = ? AND NOW()<=DATE_ADD(created_at, INTERVAL 2 MINUTE)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $param_entered_otp, $param_email);
        $param_entered_otp = $entered_otp;
        $param_email = $email;
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) >= 1) {
                $_SESSION['otp_server_check_pass'] = true;
                echo "valid";
            } else {
                echo "invalid";
            }
        }
    }
}
else {
    echo "altered";
}
?>