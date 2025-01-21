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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets//css//dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/dashboard.scss">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 left">
                <div class="functions">
                    <div class="title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                        </svg>
                        <span>Admin Panel - Faculty</span>
                    </div>
                    <a href="admin_dashboard.php">
                        <div class="function">Dashboard</div>
                    </a>
                    <a href="#">
                        <div class="function selected">Add/Edit/Delete Department</div>
                    </a>
                    <a href="add_event.php">
                        <div class="function">Add/Edit/Delete Event</div>
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
            <div class="col-10 right d-flex align-items-center justify-content-center flex-column">
                <div class="department-container py-3 w-100 d-flex align-items-center justify-content-center flex-column">
                    <div class="row w-75 d-flex align-items-center justify-content-center flex-column">
                        <h1 id="title"></h1>
                        <select class="form-select" id="selection" aria-label="Default select example">
                            <option selected disabled>Select a Department</option>
                            <?php
                            $sql = "SELECT department_name FROM department";
                            $result = $conn->query($sql);
                            while ($rows = $result->fetch_assoc()) {
                                $department_name = $rows['department_name'];
                                echo "<option value='$department_name'>$department_name</option>";
                            }
                            ?>
                        </select>
                        <div id="selection_error" class="error"></div>
                        <div id="input_container" class="card px-5 py-3 mt-5">
                            <div class="w-100 my-1">
                                <label for="exampleFormControlInput1" class="form-label">Department Name</label>
                                <input id="dep_name" type="email" class="form-control" name="department_name" placeholder="Enter Department Name">
                                <div id="dep_name_error" class="error"></div>
                            </div>
                            <div class="w-100 my-1">
                                <label class="form-label" for="inputGroupFile01">Upload Icon</label>
                                <input id="upload_icon" type="file" class="form-control" id="inputGroupFile01">
                                <div id="upload_icon_error" class="error"></div>
                            </div>
                            <button id="add_btn" style="width: 10%; margin: 0 auto; margin-top: 13px;" type="button" class="btn btn-primary">Add</button>
                            <button id="edit_btn" style="width: 10%; margin: 0 auto; margin-top: 13px;" type="button" class="btn btn-primary">Edit</button>
                        </div>
                        <button id="delete_btn" style="width: 10%; margin: 0 auto; margin-top: 13px;" type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="btn-container">
            <button id="add_nav" class="floating-btn text-center" data-bs-toggle="tooltip" data-bs-title="Add Department" name="add_department">
                +
            </button>
        </div>
        <div class="edit-btn-container">
            <button id="edit_nav" class="floating-btn text-center" data-bs-toggle="tooltip" data-bs-title="Edit Department" name="edit_department">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg>
            </button>
        </div>
        <div class="delete-btn-container">
            <button id="delete_nav" class="floating-btn text-center" data-bs-toggle="tooltip" data-bs-title="Delete Event" name="add_event">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                </svg>
            </button>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        var dep_name = "";

        $(document).ready(function() {
            $("#title").text("Add Department");
            $("#selection").hide();
            $("#edit_btn").hide();
            $("#delete_btn").hide();

            $("#add_nav").click(function() {
                $("#title").text("Add Department");
                $("#edit_btn").hide();
                $("#selection").hide();
                $("#delete_btn").hide();
                $("#input_container").show();
                $("#add_btn").show();
            });

            $("#edit_nav").click(function() {
                $("#title").text("Edit Department");
                $("#add_btn").hide();
                $("#delete_btn").hide();
                $("#edit_btn").show();
                $("#selection").show();
                $("#input_container").show();
            });

            $("#delete_nav").click(function() {
                $("#title").text("Delete Department");
                $("#selection").show();
                $("#input_container").hide();
                $("#delete_btn").show();
            });

            $("#add_btn").click(function() {
                var valid = true;
                dep_name = $("#dep_name").val().trim();
                const fileInput = $("#upload_icon")[0];
                if (dep_name == "") {
                    $("#dep_name_error").text("Department is a required field");
                    valid = false;
                } else {
                    $("#dep_name_error").text("");
                }

                if (!fileInput.files || !fileInput.files[0]) {
                    $("#upload_icon_error").text("Department icon is a required field");
                    valid = false;
                } else {
                    $("#upload_icon_error").text("");
                }

                if (valid) {
                    const formData = new FormData();
                    formData.append('file', fileInput.files[0]);
                    formData.append('dep_name', dep_name);
                    $.ajax({
                        url: "functions/admin/add_department_server.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response == "exist") {
                                $("#dep_name_error").text(dep_name + " already exist");
                            } else if (response == "invalid file extension") {
                                $("#upload_icon_error").text("Invalid File | Icon can be image only");
                            } else if (response == "error") {
                                alert("Error uploading file ....");
                            } else if (response == "success") {
                                alert("Department '" + dep_name + "' added successfully");
                                location.reload();
                            } else {
                                alert("something wrong");
                            }
                        }
                    });
                }
            });

            $("#selection").change(function() {
                select_dep_name = $("#selection").val();
                $("#dep_name").val(select_dep_name);
            });

            $("#edit_btn").click(function() {
                var valid = true;
                dep_name = $("#dep_name").val().trim();
                select_dep_name = $("#selection").val();
                const fileInput = $("#upload_icon")[0];

                if (select_dep_name == null) {
                    $("#selection_error").text("Select department");
                    valid = false;
                } else {
                    $("#selection_error").text("");
                }

                if (dep_name == "") {
                    $("#dep_name_error").text("Department is a required field");
                    valid = false;
                } else {
                    $("#dep_name_error").text("");
                }

                if (!fileInput.files || !fileInput.files[0]) {
                    $("#upload_icon_error").text("Department icon is a required field");
                    valid = false;
                } else {
                    $("#upload_icon_error").text("");
                }

                if (valid) {
                    const formData = new FormData();
                    formData.append('file', fileInput.files[0]);
                    formData.append('dep_name', dep_name);
                    formData.append('select_dep_name', select_dep_name);
                    $.ajax({
                        url: "functions/admin/edit_department_server.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response == "invalid file extension") {
                                $("#upload_icon_error").text("Invalid File | Icon can be image only");
                            } else if (response == "error") {
                                alert("Error uploading file ....");
                            } else if (response == "success") {
                                alert("Department '" + select_dep_name + "' edited successfully");
                                location.reload();
                            } else {
                                alert("something wrong");
                            }
                        }
                    });
                }

            });

            $("#delete_btn").click(function() {
                select_dep_name = $("#selection").val();
                if (select_dep_name == null) {
                    $("#selection_error").text("Select department");
                } else {
                    $("#selection_error").text("");
                    $.ajax({
                        url: "functions/admin/delete_department_server.php",
                        type: "POST",
                        data: {
                            select_dep_name: select_dep_name
                        },
                        success: function(response) {
                            if (response == "success") {
                                alert("Department '" + select_dep_name + "' deleted successfully");
                                location.reload();
                            } else {
                                alert("something wrong");
                            }
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>