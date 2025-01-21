<?php

if (!isset($_GET['department'])) {
  header("location: ./");
  die();
}

require_once 'functions/config.php';
$department = $_GET['department'];

$sql = "SELECT * FROM department WHERE department_name = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
  mysqli_stmt_bind_param($stmt, "s", $param_department);
  $param_department = $department;
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

$name = "";
$email = "";

if (isset($_COOKIE['login_user'])) {
  $sql = "SELECT name, email FROM user where email = ?";
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $_COOKIE['login_user'];
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      mysqli_stmt_bind_result($stmt, $name, $email);
      mysqli_stmt_fetch($stmt);
    } else {
      echo "<script>alert('something wrong');</script>";
    }
  } else {
    echo "<script>alert('something wrong');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    <?php echo $department; ?>
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
</head>

<body>

  <!-- ======= Header ======= -->
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center header-inner">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="index.html">The<span>Event</span></a></h1>-->
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
                <li>
                  <a href="logout.php?page=./events.php?department=<?php echo $department; ?>">Logout</a>
                </li>
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

  <main id="main">

    <!-- ======= Hotels Section ======= -->
    <section id="hotels" class="section-with-bg">

      <div class="container" data-aos="fade-up" ali>
        <div class="section-header"><br>
          <br>
          <h2>
            <?php echo $department ?>
          </h2>
          <p>Mega Events| 2023</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <?php
          $sql = "SELECT * FROM event WHERE department_name = '" . $department . "'";
          $result = $conn->query($sql);
          if (mysqli_num_rows($result) == 0) {
            ?>
            <p style="text-align: center;">No events are available for
              <?php echo $department ?>
            </p>
            <?php
          } else {
            while ($rows = $result->fetch_assoc()) {
              ?>
              <div class="col-lg-4 col-md-6">
                <a href="event_details.php?department=<?php echo $department ?>&event=<?php echo $rows['event_name'] ?>">
                  <div class="hotel">
                    <div class="hotel-img">
                      <img src="<?php echo $rows['event_icon_path'] ?>" alt="Event" class="img-fluid">
                    </div>
                    <h3 style="text-align: center;"><a href="event_details.php?department=<?php echo $department ?>&event=<?php echo $rows['event_name'] ?>">
                        <?php echo $rows['event_name'] ?>
                      </a></h3>
                    <p style="text-align: center;">
                      <?php echo $rows['event_tagline'] ?>
                    </p>
                  </div>
                </a>
              </div>
              <?php
            }
          }
          ?>

        </div>
      </div>

    </section><!-- End Hotels Section -->


    <!-- ======= Gallery Section ======= -->
    <section id="gallery">

      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check out some glimps of 2022 Blockbuster of
            <?php echo $department ?>
          </p>
        </div>
      </div>

      <div class="gallery-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><a href="assets/img/gallery/SSIP_LOGo.png" class="gallery-lightbox"><img
                src="assets/img/gallery/SSIP_LOGo.png" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/2.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/2.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/3.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/3.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/4.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/4.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/5.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/5.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/6.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/6.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/7.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/7.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/8.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/8.jpg" class="img-fluid" alt=""></a></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </section><!-- End Gallery Section -->



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <!-- <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="assets/img/Conve.png" alt="TheEvenet">
            <p>Convergence 2022 is one of the most awaited events of the year, making campus vibrant, 
              full of energy, excitement, and youthfulness. It is the combination of nine wings, namely - Infocrats, CIVESTA, 
              Mech-Mechato, PetroX, Biotechnica, Electabuzz, MARITECH, MATHMAGIX, General Events. The Nine Wings encourages 
              students from various field such as Technology, Computer 
              Engineering, IT, Civil, Electrical Engineering and many more to showcase and test their skillset on a national platform.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Ganpat Vidyanagar </br>
              Mehsana-Gozaria, Highway, Kherva</br>
              Gujarat 384012</br>
              <strong>Phone:</strong> +91 81006 16161<br>
              <strong>Email:</strong> info@ganpatuniversity.ac.in<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div> -->

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Convergence</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
      -->
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

</body>

</html>