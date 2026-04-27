<?php
session_start();
include "common/config.php";

if(isset($_POST['razorpay_payment_id'])){

    $payment_id = $_POST['razorpay_payment_id'];
    $booking_id = $_POST['booking_id'];

    mysqli_query($conn,"UPDATE booking 
    SET status='confirmed', payment_status='paid', payment_id='$payment_id'
    WHERE id='$booking_id'");

    echo "<script>
        alert('Payment Successful!');
        window.location.href='cancel.php';
    </script>";

} else {
    echo "<script>
        alert('Payment Failed!');
        window.location.href='room.php';
    </script>";
}
?>