<?php

require "../rzp/razorpay/razorpay/src/Api.php";
require "../rzp/autoload_rzp.php";
use Razorpay\Api\Api;

session_start();
if(isset($_SESSION['otp_server_check_pass'])) {
    if($_SESSION['otp_server_check_pass'] == true) {
        $api = new Api($_POST['key_id'], $_POST['secret']);

        $order_data = [
            'amount' => $_POST['amount'],
            'currency' => 'INR',
        ];
        try {
            $order = $api->order->create($order_data);
            $_SESSION['order_create_server_check'] = true;
            echo $order->id;
        } catch (\Exception $e) {
            echo "error";
        }
    }
    else {
        echo "altered";
    }
}
else {
    echo "altered";
}

?>