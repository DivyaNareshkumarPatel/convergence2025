<?php

require_once "../config.php";

$file = $_FILES['file'];
$fileName = $file['name'];
$fileTempName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$dep_name = $_POST['dep_name'];
$select_dep_name = $_POST['select_dep_name'];
$allowedExtensions = ['jpg', 'jpeg', 'png'];

if (in_array($fileExt, $allowedExtensions)) {
    if ($fileError === 0) {
        $fileName = uniqid() . '_' . $fileName;
        $uploadPath = '../../assets/img/mega_events/' . $fileName;
        move_uploaded_file($fileTempName, $uploadPath);
        $database_path = 'assets/img/mega_events/' . $fileName;
        $sql = "UPDATE department SET department_name=?, department_icon_path=? WHERE department_name=?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_department_name, $param_department_icon_path, $param_select_dep_name);
            $param_department_name = $dep_name;
            $param_department_icon_path = $database_path;
            $param_select_dep_name = $select_dep_name;
            if (mysqli_stmt_execute($stmt)) {
                $sql = "UPDATE event SET department_name=? WHERE department_name=?";
                $stmt = mysqli_prepare($conn, $sql);
                if($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $param_department_name, $param_select_dep_name);
                    $param_department_name = $dep_name;
                    $param_select_dep_name = $select_dep_name;
                    if (mysqli_stmt_execute($stmt)) {
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
        }
        else {
            echo "something wrong";
        }
    }
    else {
        echo "error";
    }
}
else {
    echo "invalid file extension";
}

?>