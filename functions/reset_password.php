<?php

require_once "config.php";
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "UPDATE user SET password = ? WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
if($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_email);
    $param_password = password_hash($password, PASSWORD_DEFAULT);
    $param_email = $email;
    if (mysqli_stmt_execute($stmt)) {
        $expiry = time() + (60 * 60 * 24 * 7); // Cookie expires in 1 week
        $path = '/';
        setcookie('login_user', $email, $expiry, $path);
        echo "success";
    }
    else {
        echo "error";
    }
}
else {
    echo "error";
}

?>