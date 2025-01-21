<?php

require_once "../config.php";

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$sql = "SELECT username, password FROM admin_user where username = ? AND role = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_role);
    $param_username = $username;
    $param_role = $role;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) >= 1) {
            mysqli_stmt_bind_result($stmt, $username, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {
                    $expiry = time() + (60 * 60 * 24 * 7); // Cookie expires in 1 week
                    $path = '/';
                    if($role == "faculty") {
                        setcookie('admin_faculty_user', $username, $expiry, $path);
                    }
                    else {
                        setcookie('admin_student_user', $username, $expiry, $path);
                    }
                    echo "correct";
                }
                else {
                    echo "incorrect";
                }
            }
        }
        else {
            echo "incorrect";
        }
    }
}

?>