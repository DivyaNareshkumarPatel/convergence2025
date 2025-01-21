<?php

require_once "../config.php";
$user_id = $_POST['user_id'];
$time_slot = $_POST['time_slot'];

$sql = "SELECT event.time_slot
        FROM event
        INNER JOIN registered_event ON event.event_id = registered_event.event_id
        WHERE registered_event.user_id = '" . $user_id . "'";
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0) {
    echo "register";
} else {
    $time_slot_str = "";
    while ($rows = $result->fetch_assoc()) {
        $time_slot_str = $time_slot_str . $rows['time_slot'];
    }
    $check_time_slot_str = $time_slot_str . $time_slot;
    $chars = str_split($check_time_slot_str);
    $count = array();
    foreach ($chars as $char) {
        if (isset($count[$char])) {
            $count[$char]++;
        } else {
            $count[$char] = 1;
        }
    }
    $repeated = false;
    foreach ($count as $char => $count) {
        if ($count > 1) {
            $repeated = true;
            break;
        }
    }
    if ($repeated) {
        echo "clash";
    } else {
        echo "register";
    }
}

?>