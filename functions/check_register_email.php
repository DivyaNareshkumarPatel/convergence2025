<?php
    require_once "config.php";

    $email = $_POST['email'];

    $sql = "SELECT user_id from user where email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) >= 1) {
                echo "exist";
            }
            else {
                session_start();
                $_SESSION['email_server_check'] = $email;
                echo "not exist";
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