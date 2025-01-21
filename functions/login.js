var email = "";
var password = "";

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

function validate_password(clicked) {
    password = $("#password").val().trim();
    if (password == "") {
        $("#password").css("background-color", "#fce4e4");
        if (clicked) {
            $("#password_error").text("Password a required field");
        }
        return false;
    } else {
        $("#password").css("background-color", "#E8F0FE");
        $("#password_error").text("");
        return true;
    }
}

$(document).ready(function () {
    $("#email").on("keyup", function () {
        validate_email(false);
    })
    $("#password").on("keyup", function () {
        validate_password(false);
    })

    $("#view_pass").click(function () {
        if ($("#password").attr("type") == "password") {
            $("#password").attr("type", "text");
        } else {
            $("#password").attr("type", "password");
        }
    });

    $("#section-1").submit(function (event) {
        event.preventDefault();
        var section_1_valid = true;

        if (!validate_email(true)) {
            section_1_valid = false;
        }
        if (!validate_password(true)) {
            section_1_valid = false;
        }

        if (section_1_valid) {
            $.ajax({
                type: "POST",
                url: "functions/check_credentials.php",
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    // alert(response);
                    if (response == "error") {
                        alert("something wrong");
                    }
                    else if (response == "unregistered email") {
                        $("#email").css("background-color", "#fce4e4");
                        $("#email_error").text(
                            "Given Email ID is not registered"
                        );
                    }
                    else if (response == "incorrect password") {
                        $("#password").css("background-color", "#fce4e4");
                        $("#password_error").text(
                            "Incorrect Password"
                        );
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
})