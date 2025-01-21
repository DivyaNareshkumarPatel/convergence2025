<?php

require_once "send_lock_mail.php";
require_once "config.php";
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$table_html = $_POST['table_html'];

$sql = "UPDATE user SET profile_lock=1 WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_user_id);
    $param_user_id = $user_id;
    if (mysqli_stmt_execute($stmt)) {
        $mail_status = sendOTP($email, $name, $table_html);
        if ($mail_status == 1) {
            echo "success";
        }
        else {
            echo "something wrong";
        }
    }
    else {
        echo "something wrong";
    }
}
else {
    echo "something wrong";
}

?>