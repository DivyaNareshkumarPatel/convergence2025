<?php

require_once "../config.php";

$sql = "UPDATE user SET profile_lock=1";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    }
}

?>