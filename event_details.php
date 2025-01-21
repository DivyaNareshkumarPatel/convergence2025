<?php

if (!isset($_GET['department']) or !isset($_GET['event'])) {
  header("location: ./");
  die();
}

require_once 'functions/config.php';
$department = $_GET['department'];
$event = $_GET['event'];

$sql = "SELECT * FROM event WHERE department_name = ? AND event_name = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
  mysqli_stmt_bind_param($stmt, "ss", $param_department, $param_event);
  $param_department = $department;
  $param_event = $event;
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_store_result($stmt);
    if (!(mysqli_stmt_num_rows($stmt) >= 1)) {
      header("location: ./");
      die();
    }
  } else {
    echo "something wrong";
  }
} else {
  echo "something wrong";
}

$user_id = 0;
if (isset($_COOKIE['login_user'])) {
  $sql = "SELECT name, email, user_id FROM user where email = ?";
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $_COOKIE['login_user'];
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_bind_result($stmt, $name, $email, $user_id);
      mysqli_stmt_fetch($stmt);
    } else {
      echo "<script>alert('something wrong');</script>";
    }
  } else {
    echo "<script>alert('something wrong');</script>";
  }
}

$sql = "SELECT event_icon_path, event_tagline, flyer_path, description, rules, evaluation_criteria, date, time, venue, faculty_coordinator, student_coordinator, volunteer, event_id, time_slot from event WHERE department_name=? AND event_name=?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
  mysqli_stmt_bind_param($stmt, "ss", $param_department, $param_event);
  $param_department = $department;
  $param_event = $event;
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $event_icon_path, $event_tagline, $flyer_path, $description, $rules, $evaluation_criteria, $date, $time, $venue, $faculty_coordinator, $student_coordinator, $volunteer, $event_id, $time_slot);
    mysqli_stmt_fetch($stmt);
  } else {
    echo "something wrong";
  }
} else {
  echo "something wrong";
}

$registered_event_arr = [];
$sql = "SELECT event.event_id
        FROM event
        INNER JOIN registered_event ON event.event_id = registered_event.event_id
        WHERE registered_event.user_id = '" . $user_id . "'";
$result = $conn->query($sql);
while ($rows = $result->fetch_assoc()) {
  array_push($registered_event_arr, $rows['event_id']);
}

$event_limit = 0;
$sql = "SELECT event_limit FROM event_reg_limit WHERE id=1";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
  if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $event_limit);
    mysqli_stmt_fetch($stmt);
  }
}

$page_value = "event_details.php?department=$department&event=$event";
$page_url_encoded = urlencode($page_value);
$logout_url = "logout.php?page=" . $page_url_encoded;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    <?php echo $event ?>
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon1.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
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
  <!-- <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script> -->

  <style>
    #style-3::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar {
      width: 6px;
      background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar-thumb {
      background-color: #000000;
    }

    .register:hover {
      color: black;
    }

    .poster {
      aspect-ratio: 16/11;
      cursor: pointer;
    }

    #register_event_btn:disabled:hover+.tooltiptext {
      visibility: visible;
    }

    #register_event_btn:disabled {
      cursor: not-allowed;
    }

    .tooltiptext {
      visibility: hidden;
      width: 400px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;

      /* Position the tooltip */
      position: absolute;
      z-index: 10;
      margin-left: 15px;
      margin-bottom: 75px;
    }

    #register_event_btn:hover .tooltiptext {
      visibility: visible;
    }

    @media screen and (width < 1440px) {
      .poster {
        aspect-ratio: 1/1;
      }
    }

    @media screen and (width <=768px) {
      .contents {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
      }

      .contents>.col {
        padding: 1.1rem !important;
      }

      .details {
        height: auto !important;
      }

      #style-3::-webkit-scrollbar {
        width: 0px;
      }
    }

    /* Hide the overlay initially */
    .overlay {
      display: none;
      position: fixed;
      z-index: 9998;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      /* semi-transparent black color */
    }

    /* Show the overlay when the image is clicked */
    .overlay.show {
      display: block;
    }

    /* Hide the image initially */
    .image-fullscreen {
      display: none;
      position: fixed;
      z-index: 9999;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    /* Center the image */
    .image-fullscreen img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-width: 100%;
      max-height: 100%;
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body style="min-height: 100vh;
  display: flex;
  flex-direction: column;">

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center header-inner">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <a href="index.php" class="scrollto"><img src="assets/img/Conve.png" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <?php
          if (isset($_COOKIE['login_user'])) {
            ?>
            <li class="buy-tickets scrollto dropdown me-5"><a href="#"><span>Hi,
                  <?php echo $name; ?>
                </span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="profile.php">Email -
                    <?php echo $email; ?>
                  </a></li>
                <li><a href="profile.php">View Profile</a></li>
                <li><a href=<?php echo $logout_url; ?>>Logout</a></li>
              </ul>
            </li>
            <?php
          }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <?php
      if (!isset($_COOKIE['login_user'])) {
        ?>
        <a class="buy-tickets scrollto" href="login.php">Login</a>
        <?php
      }
      ?>

    </div>
  </header><!-- End Header -->

  <main id="main" class="main-page" style="flex: 1;">

    <!-- ======= Speaker Details Sectionn ======= -->
    <section id="speakers-details">
      <div class="container">
        <div class="row mt-2">
          <div class="col d-flex align-items-center justify-content-center flex-column" style="height:100%">
            <div class="section-header pb-2 mb-3">
              <h2 class="m-0">
                <?php echo $event; ?>
              </h2>
              <p>
                <?php echo $event_tagline; ?>
              </p>
              <p>by
                <?php echo $department ?>
              </p>
            </div>
          </div>
        </div>
        <div class="row contents">
          <div class="col pe-5">
            <img src=<?php echo $flyer_path; ?> class="poster" width="100%" alt="Event Flyer">
            <div class="overlay"></div>
          </div>
          <div class="col">
            <div class="details" style="height:45vh;">
              <h2>Details</h2>
              <p style="height:100%;overflow-y:scroll;" id="style-3">
                <?php
                echo nl2br($description . '<br><br>');
                if ($rules != "") {
                  echo nl2br('<b>Rules & Regulations:</b><br>' . $rules . '<br><br>');
                }
                if ($evaluation_criteria != "") {
                  echo nl2br('<b>Evaluation Criteria:</b><br>' . $evaluation_criteria . '<br><br>');
                }
                echo nl2br('<b>Date & Time: </b>' . $date . ', ' . $time . '<br><br>');
                echo nl2br('<b>Venue: </b>' . $venue . '<br><br>');
                echo nl2br('<b>Faculty Coordinators:</b><br>' . $faculty_coordinator . '<br><br>');
                echo nl2br('<b>Student Coordinators:</b><br>' . $student_coordinator . '<br><br>');
                echo nl2br('<b>Volunteers:</b><br>' . $volunteer);
                ?>
              </p>
              <form action="" id="register_form">
                <div class="d-flex align-items-center justify-content-center">
                  <button <?php 
                    echo in_array($event_id, $registered_event_arr)?"disabled":"";
                  ?> id="register_event_btn" name="register_event" type="submit"><a
                      class="buy-tickets scrollto register"><?php 
                        echo in_array($event_id, $registered_event_arr)?"Registered":"Register";
                      ?></a></button>
                  <span class="tooltiptext">You've already registered this event</span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="height:10vh;">

    <div class="container">
      <div class="copyright" style="padding-top:15px !important;">
        &copy; Copyright <strong>Convergence</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="">JK|PB|AB</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div class="modal__container" id="modal-container-login">
    <div class="modal__content">
      <div class="modal__close close-modal" title="Close">
        <i class='bx bx-x'></i>
      </div>

      <img src="assets/img/modal_login.png" alt="" class="modal__img">

      <h1 class="modal__title">Login to continue</h1>
      <!-- <p class="modal__description">Click the button to close</p> -->

      <a href="login.php">
        <button class="modal__button modal__button-width">
          Login
        </button>
      </a>

      <button class="modal__button-link close-modal">
        Close
      </button>
    </div>
  </div>

  <div class="modal__container" id="modal-container-regclose">
    <div class="modal__content">
      <div class="modal__close close-modal" title="Close">
        <i class='bx bx-x'></i>
      </div>

      <img src="assets/img/regclose.png" alt="" class="modal__img">

      <h1 class="modal__title">Oh, Registration for '
        <?php echo $event ?>' has been closed!
      </h1>
      <p class="modal__description">Check out more events!</p>

      <button class="modal__button-link close-modal">
        Close
      </button>
    </div>
  </div>

  <div class="modal__container" id="modal-container-profileLock">
    <div class="modal__content">
      <div class="modal__close close-modal" title="Close">
        <i class='bx bx-x'></i>
      </div>

      <img src="assets/img/profile_lock.png" alt="" class="modal__img">

      <h1 class="modal__title">You have Locked your profile</h1>
      <p class="modal__description">No events can be Registered or Unregistered now.<br>Contact admin if you think this
        is a mistake.</p>

      <button class="modal__button-link close-modal">
        Close
      </button>
    </div>
  </div>

  <div class="modal__container" id="modal-container-max-reached">
    <div class="modal__content">
      <div class="modal__close close-modal" title="Close">
        <i class='bx bx-x'></i>
      </div>

      <img src="assets/img/max_reached.png" alt="" class="modal__img">

      <h1 class="modal__title">Maximum number of event reached</h1>
      <p class="modal__description">You have already registered in <?php echo $event_limit; ?> events.</p>

      <button class="modal__button-link close-modal">
        Close
      </button>
    </div>
  </div>

  <div class="modal__container" id="modal-container-clash">
    <div class="modal__content">
      <div class="modal__close close-modal" title="Close">
        <i class='bx bx-x'></i>
      </div>

      <img src="assets/img/time_clash.png" alt="" class="modal__img">

      <h1 class="modal__title">Time Clash found!</h1>
      <p class="modal__description">Time of
        <?php echo $event ?> might conflict with other events that you have registered.
      </p>

      <form action="" id="continue_anyway">
        <a>
          <button type="submit" class="modal__button modal__button-width">
            Continue anyway
          </button>
        </a>
      </form>

      <button class="modal__button-link close-modal">
        Close
      </button>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <!-- <script src="assets/js/main.js"></script> -->
  <script>
    $(document).ready(function () {
      $('.poster').on('click', function () {
        var imageSrc = $(this).attr('src');
        $('body').append('<div class="image-fullscreen"><img src="' + imageSrc + '"></div>');
        $('.overlay').addClass('show');
        $('.image-fullscreen').fadeIn();
      });

      $('body').on('click', '.image-fullscreen', function () {
        $(this).fadeOut(function () {
          $(this).remove();
          $('.overlay').removeClass('show');
        });
      });

      const closeBtn = document.querySelectorAll('.close-modal');

      function closeModal() {
        const modalContainer = this.closest('.modal__container');
        modalContainer.classList.remove('show-modal');
      }
      closeBtn.forEach(c => c.addEventListener('click', closeModal));

      $("#register_form").submit(function (event) {
        event.preventDefault();
        $.ajax({
          url: "functions/register_event/check_logged_in.php",
          type: "POST",
          success: function (response) {
            if (response == "0") {
              document.getElementById('modal-container-login').classList.add('show-modal');
            }
            else if (response == "1") {
              $.ajax({
                url: "functions/register_event/check_profile_locked.php",
                type: "POST",
                success: function (response) {
                  if (response == 1) {
                    document.getElementById('modal-container-profileLock').classList.add('show-modal');
                  }
                  else if (response == 0) {
                    $.ajax({
                      url: "functions/register_event/check_reg_closed.php",
                      type: "POST",
                      data: {
                        department: '<?php echo $department; ?>',
                        event: '<?php echo $event; ?>'
                      },
                      success: function (response) {
                        if (response == 1) {
                          document.getElementById('modal-container-regclose').classList.add('show-modal');
                        }
                        else if (response == 0) {
                          $.ajax({
                            url: "functions/register_event/check_max_reached.php",
                            type: "POST",
                            data: {
                              user_id: '<?php echo $user_id; ?>'
                            },
                            success: function (response) {
                              if (response == "max reached") {
                                document.getElementById('modal-container-max-reached').classList.add('show-modal');
                              }
                              else if (response == "NOT max reached") {
                                $.ajax({
                                  url: "functions/register_event/check_time_clash.php",
                                  type: "POST",
                                  data: {
                                    user_id: <?php echo $user_id; ?>,
                                    time_slot: '<?php echo $time_slot; ?>'
                                  },
                                  success: function (response) {
                                    if (response == "clash") {
                                      document.getElementById('modal-container-clash').classList.add('show-modal');
                                    }
                                    else if (response == "register") {
                                      $.ajax({
                                        url: "functions/register_event/register_event.php",
                                        type: "POST",
                                        data: {
                                          user_id: <?php echo $user_id; ?>,
                                          event_id: <?php echo $event_id; ?>
                                        },
                                        success: function (response) {
                                          if (response == "already registered") {

                                          }
                                          else if (response == "registered") {
                                            $('#register_event_btn').prop('disabled', true).text('Registered');
                                          }
                                          else {
                                            alert("something wrong");
                                          }
                                        }
                                      });
                                    }
                                    else {
                                      alert("something wrong");
                                    }
                                  }
                                });
                              }
                              else {
                                alert("something wrong");
                              }
                            }
                          });
                        }
                        else {
                          alert("something wrong");
                        }
                      }
                    });
                  }
                  else {
                    alert("something wrong");
                  }
                }
              });
            }
            else {
              alert("something wrong");
            }
          }
        });
      });

      $("#continue_anyway").submit(function (event) {
        event.preventDefault();
        $.ajax({
          url: "functions/register_event/register_event.php",
          type: "POST",
          data: {
            user_id: <?php echo $user_id; ?>,
            event_id: <?php echo $event_id; ?>
          },
          success: function (response) {
            if (response == "already registered") {

            }
            else if (response == "registered") {
              const modalContainer = document.getElementById('modal-container-clash');
              modalContainer.classList.remove('show-modal');
              $('#register_event_btn').prop('disabled', true).text('Registered');
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