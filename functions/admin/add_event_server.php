<?php

require_once "../config.php";

$department = $_POST['department'];
$name = $_POST['name'];
$tagline = $_POST['tagline'];
$desc = $_POST['desc'];
$eval = $_POST['eval'];
$rules = $_POST['rules'];
$venue = $_POST['venue'];
$date = $_POST['date'];
$time = $_POST['time'];
$faculty = $_POST['faculty'];
$student = $_POST['student'];
$volunteer = $_POST['volunteer'];
$time_slot = $_POST['time_slot'];

$icon_file = $_FILES['icon'];
$icon_fileName = $icon_file['name'];
$icon_fileTempName = $icon_file['tmp_name'];
$icon_fileError = $icon_file['error'];
$icon_fileExt = strtolower(pathinfo($icon_fileName, PATHINFO_EXTENSION));

$flyer_file = $_FILES['flyer'];
$flyer_fileName = $flyer_file['name'];
$flyer_fileTempName = $flyer_file['tmp_name'];
$flyer_fileError = $flyer_file['error'];
$flyer_fileExt = strtolower(pathinfo($flyer_fileName, PATHINFO_EXTENSION));

$allowedExtensions = ['jpg', 'jpeg', 'png'];

$sql = "SELECT * FROM event WHERE event_name = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_event_name);
    $param_event_name = $name;
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) >= 1) {
            echo "exist";
        }
        else {
            if(in_array($icon_fileExt, $allowedExtensions)) {
                if(in_array($flyer_fileExt, $allowedExtensions)) {
                    if ($icon_fileError === 0 and $flyer_fileError ===0) {
                        $icon_fileName = uniqid() . '_' . $icon_fileName;
                        $icon_uploadPath = '../../assets/img/events/' . $icon_fileName;
                        move_uploaded_file($icon_fileTempName, $icon_uploadPath);
                        $icon_database_path = 'assets/img/events/' . $icon_fileName;

                        $flyer_fileName = uniqid() . '_' . $flyer_fileName;
                        $flyer_uploadPath = '../../assets/img/event_flyer/' . $flyer_fileName;
                        move_uploaded_file($flyer_fileTempName, $flyer_uploadPath);
                        $flyer_database_path = 'assets/img/event_flyer/' . $flyer_fileName;

                        $sql = "INSERT INTO event (department_name, event_name, event_icon_path, event_tagline, flyer_path, description, rules, evaluation_criteria, date, time, venue, faculty_coordinator, student_coordinator, volunteer, time_slot) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = mysqli_prepare($conn, $sql);
                        if($stmt) {
                            mysqli_stmt_bind_param($stmt, "sssssssssssssss", $param_department_name, $param_event_name, $param_event_icon_path, $param_event_tagline, $param_flyer_path, $param_description, $param_rules, $param_evaluation_criteria, $param_date, $param_time, $param_venue, $param_faculty_coordinator, $param_student_coordinator, $param_volunteer, $param_time_slot);
                            $param_department_name = $department;
                            $param_event_name = $name;
                            $param_event_icon_path = $icon_database_path;
                            $param_event_tagline = $tagline;
                            $param_flyer_path = $flyer_database_path;
                            $param_description = $desc;
                            $param_rules = $rules;
                            $param_evaluation_criteria = $eval;
                            $param_date = $date;
                            $param_time = $time;
                            $param_venue = $venue;
                            $param_faculty_coordinator = $faculty;
                            $param_student_coordinator = $student;
                            $param_volunteer = $volunteer;
                            $param_time_slot = $time_slot;
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
                        echo "error";
                    }
                }
                else {
                    echo "invalid flyer";
                }
            }
            else {
                echo "invalid icon";
            }
        }
    }
    else {
        echo "something wrong";
    }
}
else {
    echo "something wrong";
}

?>