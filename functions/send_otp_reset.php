<?php
require_once "send_otp_mail_reset.php";
require_once "config.php";

$email = $_POST['email'];
$otp = $_POST['otp'];
$name = "";

$sql = "SELECT name FROM user where email = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $name);
        mysqli_stmt_fetch($stmt);
        $mail_status = sendOTP($email, $otp, $name);
        if ($mail_status == 1) {
            echo "sent";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}

?>