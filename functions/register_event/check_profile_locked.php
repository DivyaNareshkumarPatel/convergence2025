<?php

    require_once "../config.php";

    $sql = "SELECT profile_lock FROM user where email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $param_email);
      $param_email = $_COOKIE['login_user'];
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $profile_lock);
        mysqli_stmt_fetch($stmt);
        echo $profile_lock;
      } else {
        echo "something wrong";
      }
    } else {
      echo "something wrong";
    }
?>