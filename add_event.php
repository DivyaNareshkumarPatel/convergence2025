<?php


if (!isset($_COOKIE['admin_faculty_user'])) {
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
                        <span>Admin Panel - Faculty</span>
                    </div>
                    <a href="admin_dashboard.php">
                        <div class="function">Dashboard</div>
                    </a>
                    <a href="add_department.php">
                        <div class="function">Add/Edit/Delete Department</div>
                    </a>
                    <a href="#">
                        <div class="function selected">Add/Edit/Delete Event</div>
                    </a>
                    <a href="event_statistics.php">
                        <div class="function">Event Statistics</div>
                    </a>
                </div>
                <div class="logout">
                    <a href="admin_logout.php?page=./admin_login.php">
                        <div class="function"><span>Logout</span></div>
                    </a>
                </div>
            </div>
            <div class="col-10 right">
                <div class="event-container py-3 w-100 d-flex align-items-center justify-content-center flex-column">
                    <h1 id="title"></h1>
                    <div class="row w-75 d-flex align-items-center justify-content-center flex-column">
                        <div class="col">
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
                        </div>
                        <div class="col">
                            <select class="form-select" id="select_event" aria-label="Default select example">

                            </select>
                            <div id="select_event_error" class="error"></div>
                        </div>
                    </div>
                    <div class="row card pt-3 pb-2 my-2">
                        <div id="field_container">
                            <div class="row ms-auto me-auto">
                                <div class="col w-50 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Event Name</span>
                                        <input type="text" class="form-control" id="name" name="event_name"
                                            placeholder="Event Name">
                                    </div>
                                    <div id="name_error" class="error"></div>
                                </div>
                                <div class="col w-50 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Event Tagline</span>
                                        <input type="text" class="form-control" id="tagline" name="event_tagline"
                                            placeholder="Event Tagline">
                                    </div>
                                    <div id="tagline_error" class="error"></div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Event Description</span>
                                        <textarea id="desc" class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div id="desc_error" class="error"></div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Evaluation Criteria</span>
                                        <textarea id="eval" class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div id="eval_error" class="error"></div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Event Rules</span>
                                        <textarea id="rules" class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div id="rules_error" class="error"></div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1 w-50">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            Event Venue
                                        </span>
                                        <input type="text" class="form-control" id="venue" name="event_venue"
                                            placeholder="Event Venue">
                                    </div>
                                    <div id="venue_error" class="error"></div>
                                </div>
                                <div class="col w-50 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Event Date</span>
                                        <input type="date" class="form-control" id="date" name="event_date"
                                            placeholder="Event Date">
                                    </div>
                                    <div id="date_error" class="error"></div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col w-50 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            From
                                        </span>
                                        <input type="time" class="form-control" id="time_from" name="event_date"
                                            placeholder="Event Date">
                                    </div>
                                    <div id="time_from_error" class="error"></div>
                                </div>
                                <div class="col w-50 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            To
                                        </span>
                                        <input type="time" class="form-control" id="time_to" name="event_date"
                                            placeholder="Event Date">

                                    </div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Faculty Coordinators</span>
                                        <textarea id="faculty" class="form-control"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                    <div id="faculty_error" class="error"></div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Student Coordinators</span>
                                        <textarea id="student" class="form-control"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                    <div id="student_error" class="error"></div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Volunteers</span>
                                        <textarea id="volunteer" class="form-control"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                    <div id="volunteer_error" class="error"></div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="col my-1">
                                    <div class="input-group">
                                        <span class="input-group-text">Time Slot</span>
                                        <input id="time_slot" class="form-control"
                                            aria-label="With textarea"></textarea>
                                    </div>
                                    <div id="time_slot_error" class="error"></div>
                                </div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="w-100 my-1">
                                    <span class="input-group-text">Upload icon</span>
                                    <input type="file" class="form-control" id="icon">
                                </div>
                                <div id="icon_error" class="error"></div>
                            </div>
                            <div class="row ms-auto me-auto">
                                <div class="w-100 my-1">
                                    <span class="input-group-text">Upload flyer</span>
                                    <input type="file" class="form-control" id="flyer">
                                </div>
                                <div id="flyer_error" class="error"></div>
                            </div>
                        </div>
                        <div class="row ms-auto me-auto">
                            <div class="col w-100 text-center my-2">
                                <button id="add_btn" class="btn btn-primary">Add</button>
                                <button id="edit_btn" class="btn btn-primary">Edit</button>
                                <button id="delete_btn" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="btn-container">
                        <button id="add_nav" class="floating-btn text-center" data-bs-toggle="tooltip"
                            data-bs-title="Add Event" name="add_event">
                            +
                        </button>
                    </div>
                    <div class="edit-btn-container">
                        <button id="edit_nav" class="floating-btn text-center" data-bs-toggle="tooltip"
                            data-bs-title="Edit Event" name="edit_event">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    </div>
                    <div class="delete-btn-container">
                        <button id="delete_nav" class="floating-btn text-center" data-bs-toggle="tooltip"
                            data-bs-title="Delete Event" name="add_event">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

            var action = "add";

            var department = "";
            var name = "";
            var tagline = "";
            var desc = "";
            var eval = ""; //NOT mandatory
            var rules = ""; //NOT mandatory
            var venue = "";
            var date = "";
            var time_from = "";
            var time_to = "";
            var final_time = "";
            var faculty = "";
            var student = "";
            var volunteer = "";
            var time_slot = "";

            function convert_to_AMPM(time24) {
                var time = new Date("01/01/2021 " + time24);
                var hours = time.getHours();
                var minutes = time.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12;
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var formattedTime = hours + ':' + minutes + ' ' + ampm;
                return formattedTime;
            }

            function convert_to_24(timeAMPM) {
                var startHours = parseInt(timeAMPM.split(":")[0]);
                var startMinutes = parseInt(timeAMPM.split(":")[1]);
                var startMeridian = timeAMPM.split(" ")[1].toUpperCase();
                if (startMeridian == "PM" && startHours != 12) {
                    startHours += 12;
                }
                var formattedTime = ("0" + startHours).slice(-2) + ":" + ("0" + startMinutes).slice(-2);
                return formattedTime;
            }

            $(document).ready(function () {
                $("#title").text("Add event");
                $("#select_dep").show();
                $("#select_event").hide();
                $("#add_btn").hide();
                $("#edit_btn").hide();
                $("#delete_btn").hide();
                $("#field_container").hide();

                $("#add_nav").click(function () {
                    $("#title").text("Add event");
                    $("#select_dep").show();
                    $("#select_event").hide();
                    $("#add_btn").hide();
                    $("#edit_btn").hide();
                    $("#delete_btn").hide();
                    $("#field_container").hide();
                    $("#select_dep").val("def");

                    action = "add";
                });

                $("#edit_nav").click(function () {
                    $("#title").text("Edit event");
                    $("#select_dep").show();
                    $("#select_event").hide();
                    $("#add_btn").hide();
                    $("#edit_btn").hide();
                    $("#delete_btn").hide();
                    $("#field_container").hide();
                    $("#select_dep").val("def");

                    action = "edit";
                });

                $("#delete_nav").click(function () {
                    $("#title").text("Delete event");
                    $("#select_dep").show();
                    $("#select_event").hide();
                    $("#add_btn").hide();
                    $("#edit_btn").hide();
                    $("#delete_btn").hide();
                    $("#field_container").hide();
                    $("#select_dep").val("def");

                    action = "delete";
                });

                $("#select_dep").change(function () {
                    $("#select_event").empty();
                    department = $("#select_dep").val();
                    if (action == "add") {
                        $("#field_container").show();
                        $("#add_btn").show();
                    }
                    else if (action == "edit" || action == "delete") {
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
                    }
                });

                $("#select_event").change(function () {
                    name = $("#select_event").val();
                    if (action == "edit") {
                        $.ajax({
                            url: "functions/admin/fetch_event_details.php",
                            type: "POST",
                            data: {
                                department: department,
                                name: name
                            },
                            success: function (response) {
                                var times = response[5].split("to");
                                time_from = convert_to_24(times[0].trim());
                                time_to = convert_to_24(times[1].trim());

                                $("#name").val(name);
                                $("#tagline").val(response[0]);
                                $("#desc").val(response[1]);
                                $("#rules").val(response[2]);
                                $("#eval").val(response[3]);
                                $("#date").val(response[4]);
                                $("#time_from").val(time_from);
                                $("#time_to").val(time_to);
                                $("#venue").val(response[6]);
                                $("#faculty").val(response[7]);
                                $("#student").val(response[8]);
                                $("#volunteer").val(response[9]);
                                $("#time_slot").val(response[10]);

                                $("#field_container").show();
                                $("#edit_btn").show();
                            }
                        });
                    }
                    else if (action == "delete") {
                        $("#delete_btn").show();
                    }
                });

                $("#add_btn").click(function () {
                    var valid = true;

                    name = $("#name").val().trim();
                    tagline = $("#tagline").val().trim();
                    desc = $("#desc").val().trim();
                    eval = $("#eval").val().trim();
                    rules = $("#rules").val().trim();
                    venue = $("#venue").val().trim();
                    date = $("#date").val().trim();
                    time_slot = $("#time_slot").val().trim();

                    time_from = $("#time_from").val();
                    if (time_from != "") {
                        time_from = convert_to_AMPM(time_from);
                    }

                    time_to = $("#time_to").val();
                    if (time_to != "") {
                        time_to = convert_to_AMPM(time_to);
                    }

                    faculty = $("#faculty").val().trim();
                    student = $("#student").val().trim();
                    volunteer = $("#volunteer").val().trim();
                    const icon = $("#icon")[0];
                    const flyer = $("#flyer")[0];

                    if (name == "") {
                        $("#name_error").text("Name is a required field");
                        valid = false;
                    }
                    else {
                        $("#name_error").text("");
                    }

                    if (tagline == "") {
                        $("#tagline_error").text("Tagline is a required field");
                        valid = false;
                    }
                    else {
                        $("#tagline_error").text("");
                    }

                    if (desc == "") {
                        $("#desc_error").text("Description is a required field");
                        valid = false;
                    }
                    else {
                        $("#desc_error").text("");
                    }

                    if (venue == "") {
                        $("#venue_error").text("Venue is a required field");
                        valid = false;
                    }
                    else {
                        $("#venue_error").text("");
                    }

                    if (date == "") {
                        $("#date_error").text("Date is a required field");
                        valid = false;
                    }
                    else {
                        $("#date_error").text("");
                    }

                    if (time_from == "") {
                        $("#time_from_error").text("Time is a required field");
                        valid = false;
                    }
                    else {
                        $("#time_from_error").text("");
                    }

                    if (faculty == "") {
                        $("#faculty_error").text("Faculty Coordinators is a required field");
                        valid = false;
                    }
                    else {
                        $("#faculty_error").text("");
                    }

                    if (student == "") {
                        $("#student_error").text("Student Coordinators is a required field");
                        valid = false;
                    }
                    else {
                        $("#student_error").text("");
                    }

                    if (volunteer == "") {
                        $("#volunteer_error").text("Volunteers is a required field");
                        valid = false;
                    }
                    else {
                        $("#volunteer_error").text("");
                    }

                    if (time_slot == "") {
                        $("#time_slot_error").text("Time Slot is a required field");
                        valid = false;
                    }
                    else {
                        var regex = /^[A-Z]+$/;
                        if (!regex.test(time_slot)) {
                            $("#time_slot_error").text("[A-Z] only, without any space");
                            valid = false;
                        }
                        else {
                            $("#time_slot_error").text("");
                        }
                    }

                    if (!icon.files || !icon.files[0]) {
                        $("#icon_error").text("Icon is a required field");
                        valid = false;
                    }
                    else {
                        $("#icon_error").text("");
                    }

                    if (!flyer.files || !flyer.files[0]) {
                        $("#flyer_error").text("Flyer is a required field");
                        valid = false;
                    }
                    else {
                        $("#flyer_error").text("");
                    }

                    if (valid) {
                        if (time_to != "") {
                            final_time = time_from + " to " + time_to;
                        }
                        else {
                            final_time = time_from;
                        }
                        const formData = new FormData();
                        formData.append('department', department);
                        formData.append('name', name);
                        formData.append('tagline', tagline);
                        formData.append('desc', desc);
                        formData.append('eval', eval);
                        formData.append('rules', rules);
                        formData.append('venue', venue);
                        formData.append('date', date);
                        formData.append('time', final_time);
                        formData.append('faculty', faculty);
                        formData.append('student', student);
                        formData.append('volunteer', volunteer);
                        formData.append('time_slot', time_slot);
                        formData.append('icon', icon.files[0]);
                        formData.append('flyer', flyer.files[0]);
                        $.ajax({
                            url: "functions/admin/add_event_server.php",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response == "exist") {
                                    $("#name_error").text(name + " already exist");
                                }
                                else if (response == "invalid icon") {
                                    $("#icon_error").text("Invalid File | Icon can be image only");
                                }
                                else if (response == "invalid flyer") {
                                    $("#flyer_error").text("Invalid File | Flyer can be image only");
                                }
                                else if (response == "error") {
                                    alert("Error uploading file ....");
                                }
                                else if (response == "success") {
                                    alert("Event '" + name + "' added successfully");
                                    location.reload();
                                }
                                else {
                                    alert("something wrong");
                                }
                            }
                        });
                    }
                });

                $("#edit_btn").click(function () {
                    var valid = true;

                    field_name = $("#name").val().trim();
                    tagline = $("#tagline").val().trim();
                    desc = $("#desc").val().trim();
                    eval = $("#eval").val().trim();
                    rules = $("#rules").val().trim();
                    venue = $("#venue").val().trim();
                    date = $("#date").val().trim();
                    time_slot = $("#time_slot").val().trim();

                    time_from = $("#time_from").val();
                    if (time_from != "") {
                        time_from = convert_to_AMPM(time_from);
                    }

                    time_to = $("#time_to").val();
                    if (time_to != "") {
                        time_to = convert_to_AMPM(time_to);
                    }

                    faculty = $("#faculty").val().trim();
                    student = $("#student").val().trim();
                    volunteer = $("#volunteer").val().trim();
                    const icon = $("#icon")[0];
                    const flyer = $("#flyer")[0];

                    if (field_name == "") {
                        $("#name_error").text("Name is a required field");
                        valid = false;
                    }
                    else {
                        $("#name_error").text("");
                    }

                    if (tagline == "") {
                        $("#tagline_error").text("Tagline is a required field");
                        valid = false;
                    }
                    else {
                        $("#tagline_error").text("");
                    }

                    if (desc == "") {
                        $("#desc_error").text("Description is a required field");
                        valid = false;
                    }
                    else {
                        $("#desc_error").text("");
                    }

                    if (venue == "") {
                        $("#venue_error").text("Venue is a required field");
                        valid = false;
                    }
                    else {
                        $("#venue_error").text("");
                    }

                    if (date == "") {
                        $("#date_error").text("Date is a required field");
                        valid = false;
                    }
                    else {
                        $("#date_error").text("");
                    }

                    if (time_from == "") {
                        $("#time_from_error").text("Time is a required field");
                        valid = false;
                    }
                    else {
                        $("#time_from_error").text("");
                    }

                    if (faculty == "") {
                        $("#faculty_error").text("Faculty Coordinators is a required field");
                        valid = false;
                    }
                    else {
                        $("#faculty_error").text("");
                    }

                    if (student == "") {
                        $("#student_error").text("Student Coordinators is a required field");
                        valid = false;
                    }
                    else {
                        $("#student_error").text("");
                    }

                    if (volunteer == "") {
                        $("#volunteer_error").text("Volunteers is a required field");
                        valid = false;
                    }
                    else {
                        $("#volunteer_error").text("");
                    }

                    if (time_slot == "") {
                        $("#time_slot_error").text("Time Slot is a required field");
                        valid = false;
                    }
                    else {
                        var regex = /^[A-Z]+$/;
                        if (!regex.test(time_slot)) {
                            $("#time_slot_error").text("[A-Z] only, without any space");
                            valid = false;
                        }
                        else {
                            $("#time_slot_error").text("");
                        }
                    }

                    if (!icon.files || !icon.files[0]) {
                        $("#icon_error").text("Icon is a required field");
                        valid = false;
                    }
                    else {
                        $("#icon_error").text("");
                    }

                    if (!flyer.files || !flyer.files[0]) {
                        $("#flyer_error").text("Flyer is a required field");
                        valid = false;
                    }
                    else {
                        $("#flyer_error").text("");
                    }

                    if (valid) {
                        if (time_to != "") {
                            final_time = time_from + " to " + time_to;
                        }
                        else {
                            final_time = time_from;
                        }
                        const formData = new FormData();
                        formData.append('department', department);
                        formData.append('name', name);
                        formData.append('field_name', field_name);
                        formData.append('tagline', tagline);
                        formData.append('desc', desc);
                        formData.append('eval', eval);
                        formData.append('rules', rules);
                        formData.append('venue', venue);
                        formData.append('date', date);
                        formData.append('time', final_time);
                        formData.append('faculty', faculty);
                        formData.append('student', student);
                        formData.append('volunteer', volunteer);
                        formData.append('time_slot', time_slot);
                        formData.append('icon', icon.files[0]);
                        formData.append('flyer', flyer.files[0]);

                        $.ajax({
                            url: "functions/admin/edit_event_server.php",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response == "invalid icon") {
                                    $("#icon_error").text("Invalid File | Icon can be image only");
                                }
                                else if (response == "invalid flyer") {
                                    $("#flyer_error").text("Invalid File | Flyer can be image only");
                                }
                                else if (response == "error") {
                                    alert("Error uploading file ....");
                                }
                                else if (response == "success") {
                                    alert("Event '" + name + "' edited successfully");
                                    location.reload();
                                }
                                else {
                                    alert("something wrong");
                                }
                            }
                        });
                    }
                });

                $("#delete_btn").click(function () {
                    $.ajax({
                        url: "functions/admin/delete_event_server.php",
                        type: "POST",
                        data: {
                            department: department,
                            name: name
                        },
                        success: function (response) {
                            alert(response);
                            if (response == "success") {
                                alert("Event '" + name + "' deleted successfully");
                                location.reload();
                            }
                            else {
                                alert("something wrong");
                            }
                        }
                    });
                });
            });

        </script>

</body>

</html>