<?php
session_start();
include "../common/config.php";

if(isset($_POST['book_now'])){

    $user_id = $_SESSION['user_id']; 
    $room_id = $_POST['room_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $guests = $_POST['guests'];
    $phone = $_POST['phone'];

    // ✅ Force status = pending (payment se pehle confirm nahi hoga)
    $status = "pending";

    // Check booking availability
    $check = mysqli_query($conn," SELECT * FROM booking 
        WHERE room_id='$room_id' 
        AND status != 'Cancelled' 
        AND (checkin <= '$checkout' AND checkout >= '$checkin')
    ");

    if(mysqli_num_rows($check) > 0){

        echo "<script>alert('Room already booked for selected dates');history.back();</script>";

    } else {

        // Insert booking (pending)
        $query = "INSERT INTO booking
        (user_id, room_id, name, email, checkin, checkout, guests, phone, status)
        VALUES('$user_id', '$room_id', '$name', '$email', '$checkin', '$checkout', '$guests', '$phone', '$status')";
        
        if(mysqli_query($conn, $query)){

            // ✅ last booking id
            $booking_id = mysqli_insert_id($conn);

            // ✅ redirect to payment page
            header("Location: ../payments.php?booking_id=$booking_id");
            exit();

        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>