<?php
  if(isset($_COOKIE['login_user'])) {
    header("location: /convergence2023");
    die();
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Reset Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="colorlib.com" />

  <!-- MATERIAL DESIGN ICONIC FONT -->
  <link rel="stylesheet" href="assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css" />

  <!-- STYLE CSS -->
  <link rel="stylesheet" href="assets/css/form_style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <div action="" id="wizard">
      <!-- SECTION 1 -->
      <form id="section-1">
        <h4></h4>
        <section>
          <h3>Reset Password</h3>
          <label style="color: black;"> Email </label>
          <div class="form-holder">
            <i class="zmdi zmdi-email"></i>
            <input type="text" class="form-control" name="email" id="email" />
          </div>
          <div id="email_error" class="error"></div>
          <br>
          <br>
          <h3>
            <button class="button-43" role="button">Send OTP</button>
          </h3>
        </section>
      </form>

      <!-- SECTION 2 -->
      <form id="section-2">
        <h4></h4>
        <section>
          <h3>Verification</h3>
          <h2 align="center">
            OTP has been sent to <span id="show_email"></span>
          </h2>
          <br />
          <div class="form-col" style="width: 75%; margin: auto">
            <label for=""> Enter OTP </label>
            <div class="form-holder password">
              <i class="zmdi zmdi-code"></i>
              <input name="otp" id="otp" type="text" class="form-control" />
            </div>
            <div id="otp_error" class="error"></div>
          </div>
          <br />
          <h3>
            <button class="button-43" role="button">Enter</button>
          </h3>
        </section>
      </form>

      <!-- SECTION 3 -->
      <form id="section-3">
        <h4></h4>
        <section>
          <h3>Reset Password</h3>
          <label style="color: black;"> Create New Password </label>
          <div class="form-holder password">
            <i class="zmdi zmdi-eye" id="view_pass"></i>
            <input type="password" class="form-control" name="password" id="password" />
          </div>
          <div id="password_error" class="error"></div>
          <br>

          <label style="color: black;"> Confirm Password </label>
          <div class="form-holder password">
            <i class="zmdi zmdi-eye" id="view_con_pass"></i>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" />
          </div>
          <div id="confirm_password_error" class="error"></div>
          <br>
          <h3>
            <button class="button-43" role="button">Enter</button>
          </h3>
        </section>
      </form>
    </div>
  </div>

  <script src="functions/reset_password_js.js"></script>
</body>

</html>