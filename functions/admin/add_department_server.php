<?php

require_once "../config.php";

$file = $_FILES['file'];
$fileName = $file['name'];
$fileTempName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$dep_name = $_POST['dep_name'];
$allowedExtensions = ['jpg', 'jpeg', 'png'];

$sql = "SELECT * FROM department WHERE department_name = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_department_name);
    $param_department_name = $dep_name;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) >= 1) {
            echo "exist";
        } else {
            if (in_array($fileExt, $allowedExtensions)) {
                if ($fileError === 0) {
                    $fileName = uniqid() . '_' . $fileName;
                    $uploadPath = '../../assets/img/mega_events/' . $fileName;
                    move_uploaded_file($fileTempName, $uploadPath);
                    $database_path = 'assets/img/mega_events/' . $fileName;
                    $sql = "INSERT INTO department (department_name, department_icon_path) VALUES (?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ss", $param_department_name, $param_department_icon_path);
                        $param_department_name = $dep_name;
                        $param_department_icon_path = $database_path;
                        if (mysqli_stmt_execute($stmt)) {
                            echo "success";
                        } else {
                            echo "something wrong";
                        }
                    } else {
                        echo "something wrong";
                    }
                } else {
                    echo "error";
                }
            } else {
                echo "invalid file extension";
            }
        }
    } else {
        echo "something wrong";
    }
} else {
    echo "something wrong";
}

?>