<?php
// echo "logout file";
if (isset($_GET['page'])) {
    $redirect_page =  $_GET['page'];
    if (isset($_COOKIE['login_user'])) {
        // echo $redirect_page;
        $email = $_COOKIE['login_user'];
        $expiry = time() - 3600;
        $path = '/';
        setcookie('login_user', $email, $expiry, $path);
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