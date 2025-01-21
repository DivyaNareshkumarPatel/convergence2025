<?php
require_once "config.php";
require_once "send_otp_mail.php";

$email = $_POST['email'];
$first_name = $_POST['first_name'];
$otp = rand(100000, 999999);

session_start();
if(isset($_SESSION['email_server_check'])) {
    if ($_SESSION['email_server_check'] == $email) {
        $mail_status = sendOTP($email, $otp, $first_name);
        if ($mail_status == 1) {
            $sql = "INSERT INTO otp (email, otp) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_otp);
                $param_email = $email;
                $param_otp = $otp;
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['send_otp_server_check'] = $otp;
                    echo "success";
                }
            }
        } else {
            echo "something wrong";
        }
    }
    else {
        echo "altered";
    }
}
else {
    echo "altered";
}
?>