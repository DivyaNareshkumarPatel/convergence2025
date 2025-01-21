<?php

if (!isset($_COOKIE['admin_student_user']) and !isset($_COOKIE['admin_faculty_user'])) {
        header("location: ./admin_login.php");
        die();
}

require_once "functions/config.php";

$sql = "SELECT * FROM user";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        $total_reg_num = mysqli_stmt_num_rows($stmt);
    }
}

$sql = "SELECT * FROM user WHERE profile_lock=1";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        $lock_profile_num = mysqli_stmt_num_rows($stmt);
    }
}

$sql = "SELECT * FROM user WHERE profile_lock=0";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        $unlock_profile_num = mysqli_stmt_num_rows($stmt);
    }
}

$sql = "SELECT event_limit FROM event_reg_limit WHERE id=1";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $event_limit);
        mysqli_stmt_fetch($stmt);
    }
}

$dep_arr = ['ce', 'ce_ai', 'it', 'csbs', 'civil', 'electrical', 'ece', 'mecha', 'auto', 'marine', 'biomedical', 'petro', 'chemical'];
$dep_arr_show = ['Computer Engineering', 'Computer Engineering - AI', 'Information Technology', 'Computer Science and Business Systems', 'Mechanical Engineering', 'Electrical Engineering', 'Electronics and Communication Engineering', 'Mechatronics Engineering', 'Automobile Engineering', 'Marine Engineering', 'Biomedical Engineering', 'Petrochemical Engineering', 'Chemical Engineering'];
$dep_reg = [];
$dep_reg_lock = [];
$dep_reg_unlock = [];

foreach ($dep_arr as $value) {
    $sql = "SELECT * FROM user WHERE department='" . $value . "'";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            array_push($dep_reg, mysqli_stmt_num_rows($stmt));
        }
    }
    $sql = "SELECT * FROM user WHERE department='" . $value . "' AND profile_lock=1";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            array_push($dep_reg_lock, mysqli_stmt_num_rows($stmt));
        }
    }
    $sql = "SELECT * FROM user WHERE department='" . $value . "' AND profile_lock=0";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            array_push($dep_reg_unlock, mysqli_stmt_num_rows($stmt));
        }
    }
}

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
    <link rel="stylesheet" href="./assets/css/dashboard.scss">
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
                    <a href="#">
                        <div class="function selected">Dashboard</div>
                    </a>
                    <a id="hidden2" href="add_department.php">
                        <div class="function">Add/Edit/Delete Department</div>
                    </a>
                    <a id="hidden3" href="add_event.php">
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
            <div class="col-10 right">
                <div class="dashboard-container w-100 d-flex align-items-center justify-content-center flex-column">
                    <div class="row w-100 py-3">
                        <div class="col m-2 py-2 card data-card d-flex align-items-center justify-content-center">
                            <h4>Total Number of Registrations</h4>
                            <span class="display-5">
                                <?php echo $total_reg_num; ?>
                            </span>
                        </div>
                        <div class="col m-2 py-2 card data-card d-flex align-items-center justify-content-center">
                            <h4>Number of Locked Profiles</h4>
                            <span class="display-5">
                                <?php echo $lock_profile_num; ?>
                            </span>
                        </div>
                        <div class="col m-2 py-2 card data-card d-flex align-items-center justify-content-center">
                            <h4>Number of Unlocked Profiles</h4>
                            <span class="display-5">
                                <?php echo $unlock_profile_num; ?>
                            </span>
                        </div>
                    </div>
                    <div id="hidden" class="row w-100">
                        <div class="col w-50 d-flex align-items-center justify-content-center">
                            <button id="change_reg_limit" class="btn btn-primary">
                                Event Registrations Limit <br>
                                <?php echo $event_limit; ?>
                            </button>
                        </div>
                        <div class="col w-50 d-flex align-items-center justify-content-center">
                            <button id="lock_all_profile" class="btn btn-primary">
                                Lock All profiles
                            </button>
                        </div>
                        <div class="col w-50 d-flex align-items-center justify-content-center">
                            <button id="unlock_all_profile" class="btn btn-primary">
                                Unlock All profiles
                            </button>
                        </div>
                    </div>
                    <hr class="w-100">
                    <div class="row w-75">
                        <div class="col">
                            <h4>Department Wise Registrations:</h4>
                        </div>
                    </div>
                    <br>
                    <div class="row w-75">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Total Registrations</th>
                                        <th scope="col">Number of Lock profiles</th>
                                        <th scope="col">Number of Unlocked profiles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($dep_arr); $i++) {
                                        $no = $i + 1;
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $no; ?>
                                            </th>
                                            <td>
                                                <?php echo $dep_arr_show[$i]; ?>
                                            </td>
                                            <td>
                                                <?php echo $dep_reg[$i]; ?>
                                            </td>
                                            <td>
                                                <?php echo $dep_reg_lock[$i]; ?>
                                            </td>
                                            <td>
                                                <?php echo $dep_reg_unlock[$i]; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row w-100 text-center">
                        <div class="col">
                            <label>Download Data : </label>
                        </div>
                        <div class="col">
                            <button id="download_btn" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-download"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                    <path
                                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <hr class="w-100">
                    <div class="row w-100">
                        <div class="col">
                            <h4>Users :</h4>
                        </div>
                    </div>
                    <div class="row w-100 overflow-auto">
                        <div class="col w-100">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="display:none">user_id</th>
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
                                        <th id="hidden4" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM user";
                                    $result = $conn->query($sql);
                                    $i = 1;
                                    while ($rows = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $i;
                                                $i = $i + 1; ?>
                                            </th>
                                            <td scope="col" style="display: none;">
                                                <?php echo $rows['user_id'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['name'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['email'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['phone'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['gender'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['dob'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['university'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['department'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['year'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['enrollment'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['payment_id'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['order_id'] ?>
                                            </td>
                                            <td scope="col">
                                                <?php echo $rows['profile_lock'] == 0 ? "Unlocked" : "Locked"; ?>
                                            </td>
                                            <td id="hidden4">
                                                <div>
                                                    <div>
                                                        <button class="btn btn-danger">Lock</button>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-success">Unlock</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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
        $(document).ready(function () {
            $.ajax({
                url: "functions/admin/check_admin_role.php",
                type: "POST",
                success: function (response) {
                    if (response == "student") {
                        $("#hidden").hide();
                        $("#hidden2").hide();
                        $("#hidden3").hide();
                        $("table #hidden4").hide();
                    }
                }
            });

            $("#change_reg_limit").click(function () {
                var event_limit = prompt("Enter Event Registrations Limit : ", <?php echo $event_limit; ?>);
                if (event_limit === null) {

                }
                else {
                    if (event_limit == "") {
                        alert("Cannot be empty!");
                    }
                    else {
                        let pattern = /^[0-9]+$/;
                        if (pattern.test(event_limit)) {
                            $.ajax({
                                url: "functions/admin/change_reg_limit.php",
                                type: "POST",
                                data: {
                                    event_limit: event_limit
                                },
                                success: function (response) {
                                    if (response == "success") {
                                        alert("Changed successfully");
                                        location.reload();
                                    }
                                    else {
                                        alert("something wrong");
                                    }
                                }
                            });
                        }
                        else {
                            alert("Invalid Input");
                        }
                    }
                }
            });

            $("#lock_all_profile").click(function () {
                $.ajax({
                    url: "functions/admin/lock_all_profile.php",
                    type: "POST",
                    success: function (response) {
                        if (response == "success") {
                            alert("All profiles are locked successfully");
                            location.reload();
                        }
                        else {
                            alert("something wrong");
                        }
                    }
                });
            });

            $("#unlock_all_profile").click(function () {
                $.ajax({
                    url: "functions/admin/unlock_all_profile.php",
                    type: "POST",
                    success: function (response) {
                        if (response == "success") {
                            alert("All profiles are unlocked successfully");
                            location.reload();
                        }
                        else {
                            alert("something wrong");
                        }
                    }
                });
            });

            $(".btn-danger").click(function () {
                var row = $(this).closest('tr');
                var user_id = row.find('td:eq(0)').text().trim();
                $.ajax({
                    url: "functions/admin/lock_specific.php",
                    type: "POST",
                    data: {
                        user_id: user_id
                    },
                    success: function (response) {
                        if (response == "lock already") {
                            alert("Profile is already locked");
                        }
                        else if (response == "success") {
                            alert("Profile locked successfully");
                            location.reload();
                        }
                        else {
                            alert("something wrong");
                        }
                    }
                });
            });

            $(".btn-success").click(function () {
                var row = $(this).closest('tr');
                var user_id = row.find('td:eq(0)').text().trim();
                $.ajax({
                    url: "functions/admin/unlock_specific.php",
                    type: "POST",
                    data: {
                        user_id: user_id
                    },
                    success: function (response) {
                        if (response == "unlock already") {
                            alert("Profile is already unlocked");
                        }
                        else if (response == "success") {
                            alert("Profile unlocked successfully");
                            location.reload();
                        }
                        else {
                            alert("something wrong");
                        }
                    }
                });
            });

            $("#download_btn").click(function () {
                const now = new Date();
                const options = { timeZone: 'Asia/Kolkata' };
                const istDateTime = now.toLocaleString('en-US', options);

                $.ajax({
                    url: "functions/admin/download_overall_data.php",
                    method: "POST",
                    data: {
                        time: istDateTime
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = "General Data" + '_' + istDateTime + '.xlsx';
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