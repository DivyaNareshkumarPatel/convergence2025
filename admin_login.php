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
</head>

<body>
    <div class="wrapper">
        <div id="wizard">
            <form>
                <h4></h4>
                <section id="admin-section-1">
                    <h3>Admin Login</h3>
                    <label style="color: black;"> Username </label>
                    <div class="form-holder">
                        <i class="zmdi zmdi-email"></i>
                        <input type="text" class="form-control" name="username" id="username" />
                    </div>
                    <div id="username_error" class="error"></div>
                    <br>
                    <label style="color: black;"> Password </label>
                    <div class="form-holder password">
                        <i class="zmdi zmdi-eye" id="view_pass"></i>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    <div id="password_error" class="error"></div>
                    <br>
                    <label style="color: black;"> Role </label>
                    <div class="form-holder">
                        <span>Faculty</span><input type="radio" name="role" id="role1" value="faculty" />
                        <span>Student</span><input type="radio" name="role" id="role2" value="student" />
                        <div id="role_error" class="error"></div>
                    </div>
                    <br>
                    <h3>
                        <button id="enter_btn" class="button-43" role="button">Enter</button>
                    </h3>
                </section>
            </form>
        </div>
    </div>

    <script>
        var username = "";
        var password = "";
        var role = "";

        $(document).ready(function () {
            var valid = true;

            $("#enter_btn").click(function (event) {
                event.preventDefault();

                username = $("#username").val().trim();
                password = $("#password").val().trim();
                role = $(":radio[name=role]:checked").val();

                if (username == "") {
                    $("#username_error").text("Username is a required field");
                    valid = false;
                }
                else {
                    $("#username_error").text("");
                }

                if (password == "") {
                    $("#password_error").text("Password is a required field");
                    valid = false;
                }
                else {
                    $("#password_error").text("");
                }

                if (role == undefined) {
                    $("#role_error").text("Role is a required field");
                    valid = false;
                }
                else {
                    $("#role_error").text("");
                }

                if (valid) {
                    $.ajax({
                        url: "functions/admin/check_admin_credentials.php",
                        type: "POST",
                        data: {
                            username: username,
                            password: password,
                            role: role
                        },
                        success: function (response) {
                            if(response == "incorrect") {
                                alert("Incorrect username or password");
                            }
                            else if(response == "correct") {
                                window.location.href = './admin_dashboard.php';
                            }
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>