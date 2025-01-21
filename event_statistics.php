<?php

if (!isset($_COOKIE['admin_student_user']) and !isset($_COOKIE['admin_faculty_user'])) {
    header("location: ./admin_login.php");
    die();
}

require_once "functions/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <!-- <link rel="stylesheet" href="./assets/css/dashboard.scss"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 left">
                <div class="functions">
                    <div class="title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path
                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                        </svg>
                        <span>
                            Admin Panel
                            <?php
                            if (isset($_COOKIE['admin_student_user'])) {
                                echo " - Student";
                            } else {
                                echo " - Faculty";
                            }
                            ?>
                        </span>
                    </div>
                    <a href="admin_dashboard.php">
                        <div class="function">Dashboard</div>
                    </a>
                    <a id="hidden" href="add_department.php">
                        <div class="function">Add/Edit/Delete Department</div>
                    </a>
                    <a id="hidden2" href="add_event.php">
                        <div class="function">Add/Edit/Delete Event</div>
                    </a>
                    <a href="#">
                        <div class="function selected">Event Statistics</div>
                    </a>
                </div>
                <div class="logout">
                    <a href="admin_logout.php?page=./admin_login.php">
                        <div class="function"><span>Logout</span></div>
                    </a>
                </div>
            </div>
            <div class="col-10 right">
                <div class="dashboard-container w-100 d-flex align-items-center justify-content-center flex-column">
                    <div class="row w-100">
                        <div class="row w-100">
                            <div class="col">
                                <h1 id="title">Event Statistics</h1>
                                <select class="form-select" id="select_dep" aria-label="Default select example">
                                    <option value="def" selected disabled>Select a Department</option>
                                    <?php
                                    $sql = "SELECT department_name FROM department";
                                    $result = $conn->query($sql);
                                    while ($rows = $result->fetch_assoc()) {
                                        $department_name = $rows['department_name'];
                                        echo "<option value='$department_name'>$department_name</option>";
                                    }
                                    ?>
                                </select>
                                <select class="form-select my-2" id="select_event" aria-label="Default select example">

                                </select>
                            </div>
                        </div>
                        <div id="event_stat">
                            <div class="row w-100">
                                <div
                                    class="col m-2 py-2 card data-card d-flex align-items-center justify-content-center">
                                    <h4>Total Number of Registrations</h4>
                                    <span id="total_reg" class="display-5"></span>
                                </div>
                                <div
                                    class="col m-2 py-2 card data-card d-flex align-items-center justify-content-center">
                                    <h4>Number of Locked Profiles</h4>
                                    <span id="lock_reg" class="display-5"></span>
                                </div>
                                <div
                                    class="col m-2 py-2 card data-card d-flex align-items-center justify-content-center">
                                    <h4>Number of Unlocked Profiles</h4>
                                    <span id="unlock_reg" class="display-5"></span>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="row my-2">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <h4>Registrations for <mark id="event_name"></mark> are <mark
                                            id="open_close_text"></mark></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <div id="hidden3" class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="open_close_checkbox">
                                        <label id="open_close_text2"
                                            class="form-check-label d-flex align-items-center justify-content-center p-2"
                                            for="flexSwitchCheckChecked"></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row w-100 text-center">
                                <div class="col">
                                    <label>Download Data : </label>
                                </div>
                                <div class="col">
                                    <button id="download_btn" class="btn btn-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path
                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="row w-100">
                                <div class="col">
                                    <h4>Users :</h4>
                                </div>
                            </div>
                            <div class="row w-100 overflow-auto">
                                <div class="col w-100">
                                    <table id="record" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">DOB</th>
                                                <th scope="col">University</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Enrollment No</th>
                                                <th scope="col">Payment ID</th>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Profile Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="record_rows">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <script>
        var department = "";
        var event = "";
        $(document).ready(function () {
            $("#event_stat").hide();
            $("#select_event").hide();

            $.ajax({
                url: "functions/admin/check_admin_role.php",
                type: "POST",
                success: function (response) {
                    if (response == "student") {
                        $("#hidden").hide();
                        $("#hidden2").hide();
                        $("#hidden3").hide();
                    }
                }
            });

            $("#select_dep").change(function () {
                $("#select_event").empty();
                department = $("#select_dep").val();
                $.ajax({
                    url: "functions/admin/fetch_events.php",
                    type: "POST",
                    data: {
                        department: department
                    },
                    success: function (response) {
                        $("#select_event").append('<option selected disabled>Select an event</option>')
                        response.forEach(function (event) {
                            $('#select_event').append('<option value="' + event + '">' + event + '</option>');
                        });
                        $("#select_event").show();
                    }
                });
            });

            $("#select_event").change(function () {
                $('#record_rows').empty();
                event = $("#select_event").val();

                $.ajax({
                    url: "functions/admin/get_event_stat_num.php",
                    type: "POST",
                    data: {
                        department: department,
                        event: event
                    },
                    success: function (response) {
                        $("#total_reg").text(response[0]);
                        $("#lock_reg").text(response[1]);
                        $("#unlock_reg").text(response[2]);

                        $("#event_name").text(event);

                        if (response[3] == 1) {
                            $('#open_close_checkbox').prop('checked', false);
                            $("#open_close_text2").text("Click to OPEN Registrations");
                            $("#open_close_text").text("Close");
                        }
                        else if (response[3] == 0) {
                            $('#open_close_checkbox').prop('checked', true);
                            $("#open_close_text2").text("Click to CLOSE Registrations");
                            $("#open_close_text").text("Open");
                        }

                        $.ajax({
                            url: "functions/admin/fetch_specific_event_record.php",
                            type: "POST",
                            data: {
                                department: department,
                                event: event
                            },
                            success: function (response) {
                                for ($i = 0; $i < response[0].length; $i++) {
                                    var row = '<tr>' +
                                        '<td scope="col">' + response[0][$i] + '</td>' +
                                        '<td scope="col">' + response[1][$i] + '</td>' +
                                        '<td scope="col">' + response[2][$i] + '</td>' +
                                        '<td scope="col">' + response[3][$i] + '</td>' +
                                        '<td scope="col">' + response[4][$i] + '</td>' +
                                        '<td scope="col">' + response[5][$i] + '</td>' +
                                        '<td scope="col">' + response[6][$i] + '</td>' +
                                        '<td scope="col">' + response[7][$i] + '</td>' +
                                        '<td scope="col">' + response[8][$i] + '</td>' +
                                        '<td scope="col">' + response[9][$i] + '</td>' +
                                        '<td scope="col">' + response[10][$i] + '</td>' +
                                        '<td scope="col">' + response[11][$i] + '</td>' +
                                        '</tr>';
                                    $("#record tbody").append(row);
                                }
                                $("#event_stat").show();
                            }
                        });
                    }
                });

            });
            $("#open_close_checkbox").change(function () {
                if ($("#open_close_checkbox").is(':checked')) {
                    $.ajax({
                        url: "functions/admin/open_reg.php",
                        type: "POST",
                        data: {
                            event: event,
                            department: department
                        },
                        success: function (response) {
                            if (response == "success") {
                                // alert("Registrations for '" + event + "' has been opened");
                                $("#open_close_text").text("Open");
                                $("#open_close_text2").text("Click to CLOSE Registrations");
                            }
                            else {
                                alert("something wrong");
                            }
                        }
                    });
                }
                else {
                    $.ajax({
                        url: "functions/admin/close_reg.php",
                        type: "POST",
                        data: {
                            event: event,
                            department: department
                        },
                        success: function (response) {
                            if (response == "success") {
                                // alert("Registrations for '" + event + "' has been closed");
                                $("#open_close_text").text("Close");
                                $("#open_close_text2").text("Click to OPEN Registrations");
                            }
                            else {
                                alert("something wrong");
                            }
                        }
                    });
                }
            });

            $("#download_btn").click(function () {
                const now = new Date();
                const options = { timeZone: 'Asia/Kolkata' };
                const istDateTime = now.toLocaleString('en-US', options);
                
                $.ajax({
                    url: "functions/admin/download_event_data.php",
                    method: "POST",
                    data: {
                        department: department,
                        event: event,
                        time: istDateTime
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = event + '_' + istDateTime + '.xlsx';
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                });
            });
        });
    </script>

</body>

</html>