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
    <title>Login</title>
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
            <form id="section-1">
                <h4></h4>
                <section>
                    <h3>Login</h3>
                    <label style="color: black;"> Email </label>
                    <div class="form-holder">
                        <i class="zmdi zmdi-email"></i>
                        <input type="text" class="form-control" name="email" id="email" />
                    </div>
                    <div id="email_error" class="error"></div>
                    <br>
                    <label style="color: black;"> Password </label>
                    <div class="form-holder password">
                        <i class="zmdi zmdi-eye" id="view_pass"></i>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    <div id="password_error" class="error"></div>
                    <br>
                    <h3>
                        <button class="button-43" role="button">Enter</button>
                    </h3>
                    <p>Not having an account? <a href="register.php">Click Here</a> to Register</p>
                    <br>
                    <p>Forgot Password? <a href="reset_password.php">Click Here</a> to Reset</p>
                </section>
            </form>
        </div>
    </div>

    <script src="functions/login.js"></script>

</body>

</html>