var email = "";
var password = "";
var confirm_password = "";

function validate_email(clicked) {
    email = $("#email").val().trim();
    if (email == "") {
        $("#email").css("background-color", "#fce4e4");
        if (clicked) {
            $("#email_error").text("Email ID is a requried field");
        }
        return false;
    } else {
        var email_pattern =
            /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
        if (!email_pattern.test(email)) {
            $("#email").css("background-color", "#fce4e4");
            if (clicked) {
                $("#email_error").text("Email ID must be valid");
            }
            return false;
        }
    }
    $("#email").css("background-color", "#E8F0FE");
    $("#email_error").text("");
    return true;
}

function validate_otp(clicked) {
    entered_otp = $("#otp").val().trim();
    if (entered_otp == "") {
        $("#otp").css("background-color", "#fce4e4");
        if (clicked) {
            $("#otp_error").text("OTP a required field");
        }
        return false;
    } else {
        $("#otp").css("background-color", "#E8F0FE");
        $("#otp_error").text("");
        return true;
    }
}

function validate_password(clicked) {
    password = $("#password").val().trim();
    if (password == "") {
        $("#password").css("background-color", "#fce4e4");
        if (clicked) {
            $("#password_error").text("Password a required field");
        }
        return false;
    } else if (password.length < 4) {
        $("#password").css("background-color", "#fce4e4");
        $("#password_error").text(
            "Password must contain at least 4 characters"
        );
        return false;
    } else {
        $("#password").css("background-color", "#E8F0FE");
        $("#password_error").text("");
        return true;
    }
}

function validate_confirm_password(clicked) {
    confirm_password = $("#confirm_password").val().trim();
    if (confirm_password == "") {
        $("#confirm_password").css("background-color", "#fce4e4");
        if (clicked) {
            $("#confirm_password_error").text("Confirm Password a required field");
        }
        return false;
    } else {
        if (password != confirm_password) {
            $("#confirm_password").css("background-color", "#fce4e4");
            $("#confirm_password_error").text("Passwords doesn't match");
            return false;
        } else {
            $("#confirm_password").css("background-color", "#E8F0FE");
            $("#confirm_password_error").text("");
            return true;
        }
    }
}

$(document).ready(function () {
    $("#section-2").hide();
    $("#section-3").hide();

    $("#email").on("keyup", function () {
        validate_email(false);
    });

    $("#section-1").submit(function (event) {
        event.preventDefault();

        if (validate_email(true)) {
            $.ajax({
                type: "POST",
                url: "functions/check_register_email.php",
                data: {
                    email: email
                },
                success: function (response) {
                    // alert(response);
                    if (response == "error") {
                        alert("something wrong");
                    }
                    else if (response == "not exist") {
                        $("#email").css("background-color", "#fce4e4");
                        $("#email_error").text("Given Email ID is not registered");
                    }
                    else if (response == "exist") {
                        var otp = Math.floor(Math.random() * 1000000 + 1);
                        $.ajax({
                            type: "POST",
                            url: "functions/send_otp_reset.php",
                            data: {
                                email: email,
                                otp: otp
                            },
                            success: function (response) {
                                // alert(response);
                                if (response == "error") {
                                    alert("something wrong");
                                }
                                else if (response == "sent") {
                                    $("#show_email").text(email);
                                    $("#section-1").fadeOut("slow", function () {
                                        $("#section-2").fadeIn("slow");
                                    });
                                    $("#otp").on("keyup", function () {
                                        validate_otp(false);
                                    });
                                    $("#section-2").submit(function (event) {
                                        event.preventDefault();

                                        if (validate_otp(true)) {
                                            if (entered_otp == otp) {
                                                $("#section-2").fadeOut("slow", function () {
                                                    $("#section-3").fadeIn("slow");
                                                });
                                                $("#view_pass").click(function () {
                                                    if ($("#password").attr("type") == "password") {
                                                        $("#password").attr("type", "text");
                                                    } else {
                                                        $("#password").attr("type", "password");
                                                    }
                                                });
                                                $("#password").on("keyup", function () {
                                                    validate_password(false);
                                                });
                                                $("#view_con_pass").click(function () {
                                                    if ($("#confirm_password").attr("type") == "password") {
                                                        $("#confirm_password").attr("type", "text");
                                                    } else {
                                                        $("#confirm_password").attr("type", "password");
                                                    }
                                                });
                                                $("#confirm_password").on("keyup", function () {
                                                    validate_confirm_password(false);
                                                });
                                                $("#section-3").submit(function (event) {
                                                    event.preventDefault();
                                                    var section_3_valid = true;

                                                    if (!validate_password(true)) {
                                                        section_3_valid = false;
                                                    }
                                                    if (!validate_confirm_password(true)) {
                                                        section_3_valid = false;
                                                    }

                                                    if (section_3_valid) {
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "functions/reset_password.php",
                                                            data: {
                                                                email: email,
                                                                password: password
                                                            },
                                                            success: function (response) {
                                                                //alert(response);
                                                                if (response == "error") {
                                                                    alert("something wrong");
                                                                }
                                                                else if (response == "success") {
                                                                    window.location.href = '/convergence2023';
                                                                }
                                                                else {
                                                                    alert("something wrong");
                                                                }
                                                            }
                                                        })
                                                    }
                                                })
                                            }
                                            else {
                                                $("#otp_error").text("Incorrect OTP");
                                            }
                                        }
                                    })
                                }
                                else {
                                    alert("something wrong");
                                }
                            }
                        })
                    }
                    else {
                        alert("something wrong");
                    }
                }
            })
        }
    })
})