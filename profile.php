<?php

if (!isset($_COOKIE['login_user'])) {
    header("location: ./");
    die();
}

require_once 'functions/config.php';

$name = "";
$email = "";

$sql = "SELECT name, email, user_id, profile_lock FROM user where email = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $_COOKIE['login_user'];
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $name, $email, $user_id, $profile_lock);
        mysqli_stmt_fetch($stmt);
    } else {
        echo "<script>alert('something wrong');</script>";
    }
} else {
    echo "<script>alert('something wrong');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>
        Profile
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon1.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/modal_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        #slider {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        #slider img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        #slider img.active {
            opacity: 1;
        }

        .div_container {
            margin-top: 100px;
            display: flex;
            justify-content: center;
            /* horizontally center the divs */
            align-items: center;
            /* vertically center the divs */
        }

        .div1,
        .div2 {
            flex: 1;
            /* evenly distribute available space between the divs */
            height: 300px;
            margin: 30px;
            /* add some space in between */
        }

        .div1 {
            background-color: #f2f2f2;
            /* background-image: url('your-image-url'); */
            background-size: cover;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background-position: center;
            /* filter: blur(5px); */
            /* Adjust blur intensity as needed */
            background-color: rgba(255, 255, 255, 1);
        }

        .div2 {
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background-color: #f2f2f2;
            background-color: rgba(255, 255, 255, 1);
        }

        h3 {
            text-align: center;
        }

        h5 {
            text-align: center;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <!-- <header id="header" class="d-flex align-items-center header-inner">
        <div class="container-fluid container-xxl d-flex align-items-center">

            <div id="logo" class="me-auto">
                <a href="index.php" class="scrollto"><img src="assets/img/Conve.png" alt="" title=""></a>
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <?php
                    // if (isset($_COOKIE['login_user'])) {
                    ?>
                        <li class="buy-tickets scrollto dropdown me-5"><a href="#"><span>Hi,
                                    <?php //echo $name; ?>
                                </span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">Email -
                                        <?php //echo $email; ?>
                                    </a></li>
                                <li><a href="#">View Profile</a></li>
                                <li>
                                    <a href="#">Logout</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                        // }
                        ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

            <?php
            //if (!isset($_COOKIE['login_user'])) {
            ?>
                <a class="buy-tickets scrollto" href="login.php">Login</a>
                <?php
                //}
                ?>

        </div>
    </header> -->
    <!-- End Header -->

    <div id="slider">
        <img src="test/383243.jpg" class="active">
        <img src="test/pexels-simon-berger-1323550.jpg">
        <img src="test/1575732757.jpg">
    </div>
    <div style="margin-top: 90px;">
        <h1 style="text-align: center;">Welcome to your profile,
            <?php echo $name; ?>
        </h1>
    </div>
    <div class="div_container">
        <div class="div1">
            <!-- <img src="assets/img/apple-touch-icon.png" alt="Profile Picture" class="rounded-circle img-fluid"> -->
            <br>
            <h3 class="mt-1">
                <?php echo $name; ?>
            </h3>
            <h5 class="mt-3">
                <?php echo $email; ?>
            </h5>

            <div style="text-align:center;">
                <button id="lock_btn" class="btn btn-primary" <?php echo $profile_lock == 1 ? "disabled" : ""; ?>>Lock
                    Profile</button>
            </div>
            <h6 style="text-align: center" class="mt-4">
                <?php
                if ($profile_lock == 1) {
                    echo "You have locked your profile<br>
                        No events can be registered or unregisterd now";
                }
                ?>
            </h6>
            <div style="text-align:center;">
                <a href="logout.php?page=./" class="btn btn-primary">Logout</a href="logout.php?page=./">
            </div>
        </div>
        <div class="div2">
            <h3>Your Registrations</h3>
            <?php
            $sql = "SELECT event.event_id, event.event_name, event.date, event.time, event.venue
            FROM event
            INNER JOIN registered_event ON event.event_id = registered_event.event_id
            WHERE registered_event.user_id = '" . $user_id . "'";
            $result = $conn->query($sql);
            $no_of_events = mysqli_num_rows($result);
            if ($no_of_events == 0) {
                echo "<h6 style='text-align: center'>Nothing to show</h6>";
            } else {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th class="hidden">Event ID</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <?php
                            if ($profile_lock == 0) {
                                echo "<th>Action</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rows = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="hidden">
                                    <?php echo $rows['event_id']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['event_name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['date']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['time']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['venue']; ?>
                                </td>
                                <?php
                                if ($profile_lock == 0) {
                                    echo "<td>
                                        <button type='submit' class='btn btn-sm btn-danger'>Remove Event</button>
                                        </td>";
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="modal__container" id="modal-container-lock-confirm">
        <div class="modal__content">
            <div class="modal__close close-modal" title="Close">
                <i class='bx bx-x'></i>
            </div>

            <img src="assets/img/profile_lock.png" alt="" class="modal__img">

            <h1 class="modal__title">Are you sure?</h1>
            <p class="modal__description">
                No events would be registered or unregistered if you LOCK your profile
            </p>
            <button id="lock_profile_confirm" class="modal__button modal__button-width">
                Lock Profile
            </button>
            <button class="modal__button-link close-modal">
                Close
            </button>
        </div>
    </div>

    <div class="modal__container" id="modal-container-zero">
        <div class="modal__content">
            <div class="modal__close close-modal" title="Close">
                <i class='bx bx-x'></i>
            </div>

            <img src="assets/img/profile_lock.png" alt="" class="modal__img">

            <h1 class="modal__title">You haven't registerd any event yet</h1>
            <p class="modal__description">
                Register at least one event in order to LOCK your profile.
            </p>
            <button class="modal__button-link close-modal">
                Close
            </button>
        </div>
    </div>


    <!-- ======= Footer ======= -->
    <footer id="footer" style="position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Convergence</strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="">JK|PB|AB</a>
            </div>
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        // get all images
        const images = document.querySelectorAll('#slider img');
        // set initial image index
        let index = 0;

        function changeImage() {
            // hide current image
            images[index].classList.remove('active');
            // update index
            index = (index + 1) % images.length;
            // show next image
            images[index].classList.add('active');
        }

        // start changing images every 3 seconds
        setInterval(changeImage, 3000);

        $(document).ready(function () {
            $("#lock_btn").click(function () {
                $.ajax({
                    url: "functions/check_for_zero.php",
                    type: "POST",
                    data: {
                        no_of_events: <?php echo $no_of_events; ?>
                    },
                    success: function (response) {
                        if (response == 0) {
                            document.getElementById('modal-container-zero').classList.add('show-modal');
                        }
                        else if (response == 1) {
                            document.getElementById('modal-container-lock-confirm').classList.add('show-modal');
                        }
                        else {
                            alert("something wrong");
                        }
                    }
                });
            });

            $("#lock_profile_confirm").click(function () {
                $.ajax({
                    url: "functions/prepare_html_table.php",
                    type: "POST",
                    data: {
                        user_id: <?php echo $user_id; ?>
                    },
                    success: function (response) {
                        $.ajax({
                            url: "functions/lock_profile.php",
                            type: "POST",
                            data: {
                                user_id: <?php echo $user_id; ?>,
                                name: '<?php echo $name; ?>',
                                email: '<?php echo $email; ?>',
                                table_html: response
                            },
                            success: function (response) {
                                if (response == "success") {
                                    location.reload();
                                }
                                else {
                                    alert("something wrong");
                                }
                            }
                        });
                    }
                });
            });

            $(".btn-danger").click(function () {
                var row = $(this).closest('tr');
                var event_id = row.find('td:eq(0)').text().trim();
                $.ajax({
                    url: "functions/remove_event.php",
                    type: "POST",
                    data: {
                        user_id: <?php echo $user_id; ?>,
                        event_id: event_id
                    },
                    success: function (response) {
                        if (response == "success") {
                            location.reload();
                        }
                        else {
                            alert("something wrong");
                        }
                    }
                });
            });

        });

        const closeBtn = document.querySelectorAll('.close-modal');

        function closeModal() {
            const modalContainer = this.closest('.modal__container');
            modalContainer.classList.remove('show-modal');
        }
        closeBtn.forEach(c => c.addEventListener('click', closeModal));
    </script>

</body>

</html>