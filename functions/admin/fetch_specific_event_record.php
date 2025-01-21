<?php

require_once "../config.php";

$department = $_POST['department'];
$event = $_POST['event'];

$name_arr = [];
$email_arr = [];
$phone_arr = [];
$gender_arr = [];
$dob_arr = [];
$university_arr = [];
$department_arr = [];
$year_arr = [];
$enrollment_arr = [];
$payment_id_arr = [];
$order_id_arr = [];
$profile_lock_arr = [];

$final_arr = [];

$sql = "SELECT u.*
FROM user u
INNER JOIN registered_event re ON u.user_id = re.user_id
INNER JOIN event e ON e.event_id = re.event_id
WHERE e.department_name = '" . $department . "' AND e.event_name = '" . $event . "';
";
$result = $conn->query($sql);
while ($rows = $result->fetch_assoc()) {
    array_push($name_arr, $rows['name']);
    array_push($email_arr, $rows['email']);
    array_push($phone_arr, $rows['phone']);
    array_push($gender_arr, $rows['gender']);
    array_push($dob_arr, $rows['dob']);
    array_push($university_arr, $rows['university']);
    array_push($department_arr, $rows['department']);
    array_push($year_arr, $rows['year']);
    array_push($enrollment_arr, $rows['enrollment']);
    array_push($payment_id_arr, $rows['payment_id']);
    array_push($order_id_arr, $rows['order_id']);
    array_push($profile_lock_arr, $rows['profile_lock']);
}

array_push($final_arr, $name_arr);
array_push($final_arr, $email_arr);
array_push($final_arr, $phone_arr);
array_push($final_arr, $gender_arr);
array_push($final_arr, $dob_arr);
array_push($final_arr, $university_arr);
array_push($final_arr, $department_arr);
array_push($final_arr, $year_arr);
array_push($final_arr, $enrollment_arr);
array_push($final_arr, $payment_id_arr);
array_push($final_arr, $order_id_arr);
array_push($final_arr, $profile_lock_arr);

$final_JSON = json_encode($final_arr);
header('Content-Type: application/json');
echo $final_JSON;

?>