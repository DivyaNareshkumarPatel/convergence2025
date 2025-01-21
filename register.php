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
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="colorlib.com" />

  <!-- MATERIAL DESIGN ICONIC FONT -->
  <link rel="stylesheet" href="assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css" />

  <!-- DATE-PICKER -->
  <link rel="stylesheet" href="assets/vendor/date-picker/css/datepicker.min.css" />

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
          <h3>Register</h3>
          <div class="form-row">
            <div class="form-col">
              <label for=""> First Name </label>
              <div class="form-holder">
                <i class="zmdi zmdi-account-o"></i>
                <input type="text" class="form-control" name="first_name" id="first_name" />
              </div>
              <div id="first_name_error" class="error"></div>
            </div>
            <div class="form-col">
              <label for=""> Last Name </label>
              <div class="form-holder">
                <i class="zmdi zmdi-account-o"></i>
                <input type="text" class="form-control" name="last_name" id="last_name" />
              </div>
              <div id="last_name_error" class="error"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-col">
              <label for=""> Email ID </label>
              <div class="form-holder">
                <i class="zmdi zmdi-email"></i>
                <input type="text" class="form-control" name="email" id="email" />
              </div>
              <div id="email_error" class="error"></div>
            </div>
            <div class="form-col">
              <label for=""> Phone Number </label>
              <div class="form-holder">
                <i class="zmdi zmdi-smartphone-android"></i>
                <input type="text" class="form-control" name="phone" id="phone" />
              </div>
              <div id="phone_error" class="error"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-col">
              <label for=""> Gender </label>
              <br />
              <div class="form-holder">
                <!-- <i class="zmdi zmdi-spellcheck"></i>
                                <input type="text" class="form-control"> -->
                <label id="gender_field" for="">
                  Male
                  <input type="radio" name="gender" id="gender1" value="male" />
                  Female
                  <input type="radio" name="gender" id="gedner2" value="female" />
                </label>
              </div>
              <div id="gender_field_error" class="error"></div>
            </div>
            <div class="form-col">
              <label for=""> Date of Birth </label>
              <div class="form-holder">
                <i class="zmdi zmdi-calendar"></i>
                <input type="text" class="form-control datepicker-here" data-language="en"
                  data-date-format="dd - mm - yyyy" id="dob" name="dob" readonly />
              </div>
              <div id="dob_error" class="error"></div>
            </div>
          </div>
          <h3>
            <button class="button-43" role="button">Next</button>
          </h3>
          <p>Already a user? <a href="login.php">Click Here</a> to login</p>
        </section>
      </form>

      <!-- SECTION 2 -->
      <form id="section-2">
        <div id="section-2">
          <h4></h4>
          <div id="loading-screen">
            <div class="lds-dual-ring"></div>
          </div>
          <section>
            <h3>Register</h3>
            <div class="form-row">
              <div class="form-col">
                <label for=""> University </label>
                <div class="form-holder">
                  <i class="zmdi zmdi-assignment-o"></i>
                  <select name="university" id="university" class="form-control">
                    <option selected class="option">Select University</option>
                    <option value="ganpat_university" class="option">
                      Ganpat University
                    </option>
                    <option value="other" class="option">Other</option>
                  </select>
                  <i class="zmdi zmdi-chevron-down"></i>
                  <br />
                </div>
                <div id="university_error" class="error"></div>
                <div id="specify_uni">
                  Specify University :
                  <input type="text" name="other_uni" id="other_uni" />
                </div>
                <div id="other_uni_error" class="error"></div>
              </div>
              <div class="form-col">
                <label for=""> Department </label>
                <div class="form-holder">
                  <i class="zmdi zmdi-assignment"></i>
                  <select name="department" id="department" class="form-control">
                    <option selected class="option">Select Department</option>
                    <option value="ce" class="option">
                      Computer Engineering
                    </option>
                    <option value="ce_ai" class="option">
                      Computer Engineering - AI
                    </option>
                    <option value="it" class="option">
                      Information Technology
                    </option>
                    <option value="csbs" class="option">
                      Computer Science and Business Systems
                    </option>
                    <option value="civil" class="option">Civil Engineering</option>
                    <option value="me" class="option">
                      Mechanical Engineering
                    </option>
                    <option value="electrical" class="option">
                      Electrical Engineering
                    </option>
                    <option value="ece" class="option">
                      Electronics and Communication Engineering
                    </option>
                    <option value="mecha" class="option">
                      Mechatronics Engineering
                    </option>
                    <option value="auto" class="option">
                      Automobile Engineering
                    </option>
                    <option value="marine" class="option">
                      Marine Engineering
                    </option>
                    <option value="biomedical" class="option">
                      Biomedical Engineering
                    </option>
                    <option value="petro" class="option">
                      Petrochemical Engineering
                    </option>
                    <option value="chemical" class="option">
                      Chemical Engineering
                    </option>
                    <option value="other" class="option">Other</option>
                  </select>
                  <i class="zmdi zmdi-chevron-down"></i>
                  <br />
                </div>
                <div id="department_error" class="error"></div>
                <div id="specify_dep">
                  Specify Department :
                  <input type="text" name="other_dep" id="other_dep" />
                </div>
                <div id="other_dep_error" class="error"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-col">
                <label for=""> Year </label>
                <div class="form-holder">
                  <i class="zmdi zmdi-calendar"></i>
                  <select name="year" id="year" class="form-control">
                    <option selected class="option">Select Year</option>
                    <option value="1" class="option">1</option>
                    <option value="2" class="option">2</option>
                    <option value="3" class="option">3</option>
                    <option value="4" class="option">4</option>
                  </select>
                  <i class="zmdi zmdi-chevron-down"></i>
                  <br />
                </div>
                <div id="year_error" class="error"></div>
              </div>
              <div class="form-col">
                <label for=""> Enrollment Number </label>
                <div class="form-holder">
                  <i class="zmdi zmdi-account"></i>
                  <input name="enrollment" id="enrollment" type="text" class="form-control" />
                </div>
                <div id="enrollment_error" class="error"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-col">
                <label for=""> Create Password </label>
                <div class="form-holder password">
                  <i class="zmdi zmdi-eye" id="view_pass"></i>
                  <input name="password" id="password" type="password" class="form-control" />
                </div>
                <div id="password_error" class="error"></div>
              </div>
              <div class="form-col">
                <label for=""> Confirm Password </label>
                <div class="form-holder password">
                  <i class="zmdi zmdi-eye" id="view_con_pass"></i>
                  <input name="confirm_password" id="confirm_password" type="password" class="form-control" />
                </div>
                <div id="confirm_password_error" class="error"></div>
              </div>
            </div>
            <h3>
              <button class="button-43" id="otp-btn" role="button">Send OTP</button>
            </h3>
          </section>
        </div>
      </form>

      <!-- SECTION 3 -->
      <form id="section-3">
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
    </div>
  </div>

  <!-- <script src="js/jquery-3.3.1.min.js"></script> -->

  <!-- JQUERY STEP -->
  <!-- <script src="js/jquery.steps.js"></script> -->

  <!-- DATE-PICKER -->
  <script src="assets/vendor/date-picker/js/datepicker.js"></script>
  <script src="assets/vendor/date-picker/js/datepicker.en.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/dotenv@16.0.3/lib/main.min.js"></script>
  <script src="functions/register.js"></script>
</body>

</html>