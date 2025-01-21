<?php

//Run this script to add admin user into database
//Run two times, for 1.Faculty and 2.Student
//For Faculty, set username="faculty", password="faculty", role="faculty"
//For Student, set username="student", password="student", role="student"


require_once "functions/config.php";
$username = ""; //TODO
$password = ""; //TODO
$role = "";     //TODO

$sql = "INSERT INTO admin_user (username, password, role) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
if($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_role);
    $param_username = $username;
    $param_password = password_hash($password, PASSWORD_DEFAULT);;
    $param_role = $role;
    if (mysqli_stmt_execute($stmt)) {
        echo "record inserted successfully";
    }
}

?>