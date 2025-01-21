<?php

require_once "../config.php";

$department = $_POST['department'];
$event = $_POST['event'];

$num_arr = [];

$sql = "SELECT re.* 
FROM registered_event re 
JOIN event e ON re.event_id = e.event_id 
WHERE e.event_name = ? AND e.department_name = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $param_event_name, $param_department_name);
    $param_event_name = $event;
    $param_department_name = $department;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        $total_reg_num = mysqli_stmt_num_rows($stmt);
        array_push($num_arr, $total_reg_num);

        $sql = "SELECT *
        FROM user
        WHERE user_id IN (
          SELECT user_id
          FROM registered_event
          WHERE event_id IN (
            SELECT event_id
            FROM event
            WHERE event_name = ? AND department_name = ?
          )
        ) AND profile_lock = 1;
        ";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $param_event_name, $param_department_name);
            $param_event_name = $event;
            $param_department_name = $department;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $lock_reg_num = mysqli_stmt_num_rows($stmt);
                array_push($num_arr, $lock_reg_num);

                $sql = "SELECT *
                FROM user
                WHERE user_id IN (
                  SELECT user_id
                  FROM registered_event
                  WHERE event_id IN (
                    SELECT event_id
                    FROM event
                    WHERE event_name = ? AND department_name = ?
                  )
                ) AND profile_lock = 0;
                ";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $param_event_name, $param_department_name);
                    $param_event_name = $event;
                    $param_department_name = $department;
                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_store_result($stmt);
                        $unlock_reg_num = mysqli_stmt_num_rows($stmt);
                        array_push($num_arr, $unlock_reg_num);

                        $sql = "SELECT reg_close FROM event WHERE event_name=? AND department_name=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, "ss", $param_event_name, $param_department_name);
                            $param_event_name = $event;
                            $param_department_name = $department; 
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                                mysqli_stmt_bind_result($stmt, $reg_close);
                                mysqli_stmt_fetch($stmt);
                                array_push($num_arr, $reg_close);

                                $num_JSON = json_encode($num_arr);
                                header('Content-Type: application/json');
                                echo $num_JSON;
                            }
                        }
                    }
                }
            }
        }
    }
}

?>