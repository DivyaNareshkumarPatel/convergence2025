<?php

require_once "../config.php";

$select_dep_name = $_POST['select_dep_name'];

$sql = "DELETE FROM department WHERE department_name=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_select_dep_name);
    $param_select_dep_name = $select_dep_name;
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "something wrong";
    }
} else {
    echo "something wrong";
}

?>