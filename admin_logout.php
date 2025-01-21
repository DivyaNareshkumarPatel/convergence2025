<?php

if (isset($_GET['page'])) {
    $redirect_page =  $_GET['page'];
    if (isset($_COOKIE['admin_faculty_user'])) {
        $username = $_COOKIE['admin_faculty_user'];
        $expiry = time() - 3600;
        $path = '/';
        setcookie('admin_faculty_user', $username, $expiry, $path);
        header("location: $redirect_page");
    }
    else if(isset($_COOKIE['admin_student_user'])) {
        $username = $_COOKIE['admin_student_user'];
        $expiry = time() - 3600;
        $path = '/';
        setcookie('admin_student_user', $username, $expiry, $path);
        header("location: $redirect_page");
    }
    else {
        header("location: ./");  
    }
}
else {
    header("location: ./");
}

?>