<?php

require_once "config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$university = $_POST['university'];
$department = $_POST['department'];
$year = $_POST['year'];
$enrollment = $_POST['enrollment'];
$password = $_POST['password'];
$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];

session_start();
if (isset($_SESSION['order_create_server_check']) and isset($_SESSION['email_server_check'])) {
    if ($_SESSION['order_create_server_check'] == true and $_SESSION['email_server_check'] == $email) {
        $sql = "INSERT INTO user (name, email, phone, gender, dob, university, department, year, enrollment, password, payment_id, order_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_name, $param_email, $param_phone, $param_gender, $param_dob, $param_university, $param_department, $param_year, $param_enrollment, $param_password, $param_payment_id, $param_order_id);

            $param_name = $name;
            $param_email = $email;
            $param_phone = $phone;
            $param_gender = $gender;
            $param_dob = $dob;
            $param_university = $university;
            $param_department = $department;
            $param_year = $year;
            $param_enrollment = $enrollment;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_payment_id = $payment_id;
            $param_order_id = $order_id;

            if (mysqli_stmt_execute($stmt)) {
                $expiry = time() + (60 * 60 * 24 * 7); // Cookie expires in 1 week
                $path = '/';
                setcookie('login_user', $email, $expiry, $path);
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else {
        echo "altered";
    }
} else {
    echo "altered";
}


?>