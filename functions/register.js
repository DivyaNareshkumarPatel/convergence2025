var first_name = "";
var last_name = "";
var email = "";
var phone = "";
var gender = "";
var dob = "";
var section_1_valid = true;

var university = "";
var department = "";
var year = "";
var enrollment = "";
var password = "";
var confirm_password = "";
var otp = "";

const key_id = "rzp_test_22o2IJzsA1Hvzh";
const secret = "PruyexCHS7JLMMvJQcWnBzM1";
const amount = 10000;

function validate_first_name(clicked) {
    first_name = $("#first_name").val().trim();
    if (first_name == "") {
        $("#first_name").css("background-color", "#fce4e4");
        if (clicked) {
            $("#first_name_error").text("First Name is a requried field");
        }
        return false;
    } else {
        var name_pattern = /^[a-zA-Z]+$/;
        if (!name_pattern.test(first_name)) {
            $("#first_name").css("background-color", "#fce4e4");
            if (clicked) {
                $("#first_name_error").text("First Name must be valid");
            }
            return false;
        }
    }
    $("#first_name").css("background-color", "#E8F0FE");
    $("#first_name_error").text("");
    return true;
}

function validate_last_name(clicked) {
    last_name = $("#last_name").val().trim();
    if (last_name == "") {
        $("#last_name").css("background-color", "#fce4e4");
        if (clicked) {
            $("#last_name_error").text("Last Name is a requried field");
        }
        return false;
    } else {
        var name_pattern = /^[a-zA-Z]+$/;
        if (!name_pattern.test(last_name)) {
            $("#last_name").css("background-color", "#fce4e4");
            if (clicked) {
                $("#last_name_error").text("Last Name must be valid");
            }
            return false;
        }
    }
    $("#last_name").css("background-color", "#E8F0FE");
    $("#last_name_error").text("");
    return true;
}

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

function validate_phone(clicked) {
    phone = $("#phone").val().trim();
    if (phone == "") {
        $("#phone").css("background-color", "#fce4e4");
        if (clicked) {
            $("#phone_error").text("Phone Number is a requried field");
        }
        return false;
    } else {
        var phone_pattern = /^[6789]\d{9}$/;
        if (!phone_pattern.test(phone)) {
            $("#phone").css("background-color", "#fce4e4");
            if (clicked) {
                $("#phone_error").text("Phone must be valid");
            }
            return false;
        }
    }
    $("#phone").css("background-color", "#E8F0FE");
    $("#phone_error").text("");
    return true;
}

function validate_date(clicked) {
    dob = $("#dob").val().trim();
    if (dob == "") {
        $("#dob").css("background-color", "#fce4e4");
        if (clicked) {
            $("#dob_error").text("Date of Birth is a requried field");
        }
        return false;
    } else {
        var date_pattern = /^[0-9]{2}\s-\s[0-9]{2}\s-\s[0-9]{4}$/;
        if (!date_pattern.test(dob)) {
            $("#dob").css("background-color", "#fce4e4");
            if (clicked) {
                $("#dob_error").text("Date of Birth must be valid");
            }
            return false;
        }
    }
    $("#dob").css("background-color", "#E8F0FE");
    $("#dob_error").text("");
    return true;
}

function validate_gender() {
    gender = $(":radio[name=gender]:checked").val();
    if (gender == undefined) {
        $("#gender_field").css("background-color", "#fce4e4");
        $("#gender_field_error").text("Gender is a requried field");
        return false;
    } else {
        $("#gender_field").css("background-color", "#E8F0FE");
        $("#gender_field_error").text("");
        return true;
    }
}

function validate_university(clicked) {
    university = $("#university").val();
    if (university == "Select University") {
        $("#specify_uni").hide();
        $("#university").css("background-color", "#fce4e4");
        if (clicked) {
            $("#university_error").text("University is a required field");
        }
        return false;
    } else if (university == "ganpat_university") {
        $("#specify_uni").hide();
        $("#university").css("background-color", "#E8F0FE");
        $("#university_error").text("");
        return true;
    } else {
        $("#university").css("background-color", "#FFFFFF");
        $("#university_error").text("");
        $("#specify_uni").show();
        university = $("#other_uni").val().trim();
        if (clicked && university == "") {
            $("#other_uni").css("background-color", "#fce4e4");
            $("#other_uni_error").text("University is a requried field");
            return false;
        }
        if (clicked && university != "") {
            $("#other_uni").css("background-color", "#E8F0FE");
            $("#other_uni_error").text("");
            return true;
        }
        $("#other_uni").on("keyup", function () {
            university = $("#other_uni").val().trim();
            if (university == "") {
                $("#other_uni").css("background-color", "#fce4e4");
                if (clicked) {
                    $("#other_uni_error").text("University is a requried field");
                }
                return false;
            } else {
                $("#other_uni").css("background-color", "#E8F0FE");
                $("#other_uni_error").text("");
                return true;
            }
        });
    }
}

function validate_department(clicked) {
    department = $("#department").val();
    if (department == "Select Department") {
        $("#specify_dep").hide();
        $("#department").css("background-color", "#fce4e4");
        if (clicked) {
            $("#department_error").text("Department is a required field");
        }
        return false;
    } else if (department == "other") {
        $("#department").css("background-color", "#FFFFFF");
        $("#department_error").text("");
        $("#specify_dep").show();
        department = $("#other_dep").val();
        if (clicked && department == "") {
            $("#other_dep").css("background-color", "#fce4e4");
            $("#other_dep_error").text("Department a requried field");
            return false;
        }
        if (clicked && department != "") {
            $("#other_dep").css("background-color", "#E8F0FE");
            $("#other_dep_error").text("");
            return true;
        }
        $("#other_dep").on("keyup", function () {
            department = $("#other_dep").val();
            if (department == "") {
                $("#other_dep").css("background-color", "#fce4e4");
                if (clicked) {
                    $("#other_dep_error").text("Department a requried field");
                }
                return false;
            } else {
                $("#other_dep").css("background-color", "#E8F0FE");
                $("#other_dep_error").text("");
                return true;
            }
        });
    } else {
        $("#specify_dep").hide();
        $("#department").css("background-color", "#E8F0FE");
        $("#department_error").text("");
        return true;
    }
}

function validate_year(clicked) {
    year = $("#year").val();
    if (year == "Select Year") {
        $("#year").css("background-color", "#fce4e4");
        if (clicked) {
            $("#year_error").text("Year is a required field");
        }
        return false;
    } else {
        $("#year").css("background-color", "#E8F0FE");
        $("#year_error").text("");
        return true;
    }
}

function validate_enrollment(clicked) {
    enrollment = $("#enrollment").val().trim();
    if (enrollment == "") {
        $("#enrollment").css("background-color", "#fce4e4");
        if (clicked) {
            $("#enrollment_error").text("Enrollment Number a required field");
        }
        return false;
    } else {
        $("#enrollment").css("background-color", "#E8F0FE");
        $("#enrollment_error").text("");
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

$(document).ready(function () {
    $("#section-2").hide();
    $("#section-3").hide();
    $("#specify_uni").hide();
    $("#specify_dep").hide();
    $("#loading-screen").hide();

    // $("#section-1").hide();
    // $("#section-3").show();

    $("#first_name").on("keyup", function () {
        validate_first_name(false);
    });
    $("#last_name").on("keyup", function () {
        validate_last_name(false);
    });
    $("#email").on("keyup", function () {
        validate_email(false);
    });
    $("#phone").on("keyup", function () {
        validate_phone(false);
    });
    $("#dob").on("change", function () {
        validate_date(false);
    });
    $("input[type=radio][name=gender]").on("change", function () {
        validate_gender();
    });

    $("#section-1").submit(function (event) {
        event.preventDefault();
        var section_1_valid = true;

        if (!validate_first_name(true)) {
            section_1_valid = false;
        }
        if (!validate_last_name(true)) {
            section_1_valid = false;
        }
        if (!validate_email(true)) {
            section_1_valid = false;
        }
        if (!validate_phone(true)) {
            section_1_valid = false;
        }
        if (!validate_date(true)) {
            section_1_valid = false;
        }
        if (!validate_gender()) {
            section_1_valid = false;
        }

        if (section_1_valid) {
            $.ajax({
                type: "POST",
                url: "functions/check_register_email.php",
                data: {
                    email: email,
                    
                },
                success: function (response) {
                    if (response == "exist") {
                        $("#email").css("background-color", "#fce4e4");
                        $("#email_error").text(
                            "Given Email ID is already registered"
                        );
                    }
                    else if (response == "error") {
                        alert("something wrong");
                    }
                    else if (response == "not exist") {
                        $("#section-1").fadeOut("slow", function () {
                            $("#section-2").fadeIn("slow");
                        });
                        $("#university").change(function () {
                            validate_university(false);
                        });
                        $("#department").change(function () {
                            validate_department(false);
                        });
                        $("#year").change(function () {
                            validate_year(false);
                        });
                        $("#enrollment").on("keyup", function () {
                            validate_enrollment(false);
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

                        $("#section-2").submit(function (event) {
                            event.preventDefault();
                            var section_2_valid = true;

                            if (!validate_university(true)) {
                                section_2_valid = false;
                            }
                            if (!validate_department(true)) {
                                section_2_valid = false;
                            }
                            if (!validate_year(true)) {
                                section_2_valid = false;
                            }
                            if (!validate_enrollment(true)) {
                                section_2_valid = false;
                            }
                            if (!validate_password(true)) {
                                section_2_valid = false;
                            }
                            if (!validate_confirm_password(true)) {
                                section_2_valid = false;
                            }

                            if (section_2_valid) {
                                $("#loading-screen").show();
                                $("#otp-btn").hide();
                                $.ajax({
                                    type: "POST",
                                    url: "functions/send_otp.php",
                                    data: {
                                        email: email,
                                        first_name: first_name,
                                    },
                                    success: function (response) {
                                        if (response == "success") {
                                            $("#show_email").text(email);
                                            $("#section-2").fadeOut("slow", function () {
                                                $("#section-3").fadeIn("slow");
                                            });
                                            $("#otp").on("keyup", function () {
                                                validate_otp(false);
                                            });

                                            $("#section-3").submit(function (event) {
                                                event.preventDefault();

                                                if (validate_otp(true)) {
                                                    $.ajax({
                                                        url: "functions/check_otp.php",
                                                        type: "POST",
                                                        data: {
                                                            email: email,
                                                            entered_otp: entered_otp
                                                        },
                                                        success: function (response) {
                                                            if (response == "valid") {
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "functions/create_order.php",
                                                                    data: {
                                                                        key_id: key_id,
                                                                        secret: secret,
                                                                        amount: amount
                                                                    },
                                                                    success: function (response) {
                                                                        if (response == "error") {
                                                                            alert("something wrong");
                                                                        }
                                                                        else if(response == "altered") {

                                                                        }
                                                                        else {
                                                                            const o_id = response;
                                                                            var options = {
                                                                                "key": key_id,
                                                                                "amount": amount.toString(),
                                                                                "currency": "INR",
                                                                                "name": "Convergence 2023",
                                                                                "description": "",
                                                                                "image": "",
                                                                                "order_id": o_id,
                                                                                "prefill": {
                                                                                    "name": "",
                                                                                    "email": "",
                                                                                    "contact": ""
                                                                                },
                                                                                "theme": {
                                                                                    "color": "#3399cc"
                                                                                },
                                                                                "handler": function (response) {
                                                                                    const generated_signature = CryptoJS.HmacSHA256(o_id + "|" + response.razorpay_payment_id, secret).toString();

                                                                                    if (generated_signature == response.razorpay_signature) {
                                                                                        var name = first_name + " " + last_name;
                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "functions/register_user.php",
                                                                                            data: {
                                                                                                name: name,
                                                                                                email: email,
                                                                                                phone: phone,
                                                                                                gender: gender,
                                                                                                dob: dob,
                                                                                                university: university,
                                                                                                department: department,
                                                                                                year: year,
                                                                                                enrollment: enrollment,
                                                                                                password: password,
                                                                                                payment_id: response.razorpay_payment_id,
                                                                                                order_id: response.razorpay_order_id
                                                                                            },
                                                                                            success: function (response) {
                                                                                                if (response == "error") {
                                                                                                    alert("something wrong");
                                                                                                }
                                                                                                else if(response == "altered") {

                                                                                                }
                                                                                                else {
                                                                                                    window.location.href = '/convergence2023';
                                                                                                }
                                                                                            }
                                                                                        })
                                                                                    }
                                                                                },
                                                                            };
                                                                            var rzp1 = new Razorpay(options);
                                                                            $("#section-3").fadeOut("slow");
                                                                            rzp1.open();
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                            else if (response == "invalid") {
                                                                $("#otp_error").text("Incorrect OTP");
                                                            }
                                                            else if (response == "altered") {

                                                            }
                                                            else {
                                                                alert("something wrong");
                                                            }
                                                        }
                                                    });
                                                }
                                            });
                                        } 
                                        else if (response == "altered") {
                                            
                                        }
                                        else {
                                            alert("something wrong");
                                        }
                                    },
                                });
                            }
                        });
                    }
                },
            });
        }
    });
});