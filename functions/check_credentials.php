<?php

require_once "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT email, password FROM user where email = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) >= 1) {
            mysqli_stmt_bind_result($stmt, $email, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {
                    $expiry = time() + (60 * 60 * 24 * 7); // Cookie expires in 1 week
                    $path = '/';
                    setcookie('login_user', $email, $expiry, $path);
                    echo "success";
                }
                else {
                    echo "incorrect password";
                }
            }
        }
        else {
            echo "unregistered email";
        }
    }
    else {
        echo "error";
    }
}
else {
    echo "error";
}

?>