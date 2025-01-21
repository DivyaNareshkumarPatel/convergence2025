<?php
    
require_once "../config.php";
$department = $_POST['department'];
$events_arr = [];

$sql = "SELECT event_name FROM event WHERE department_name = '" . $department . "'";
$result = $conn->query($sql);
while ($rows = $result->fetch_assoc()) {
    array_push($events_arr, $rows['event_name']);
}
$events_JSON = json_encode($events_arr);
header('Content-Type: application/json');
echo $events_JSON;

?>