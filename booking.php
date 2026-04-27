<?php
session_start();
include "../common/config.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

if(isset($_POST['book'])){

$user_id = $_SESSION['user_id'];
$arrival = $_POST['arrival'];
$departure = $_POST['departure'];

if($arrival >= $departure){
echo "Departure date must be after arrival date";
exit();
}

$check = mysqli_query($conn,"
SELECT * FROM bookings
WHERE arrival < '$departure'
AND departure > '$arrival'
");

if(mysqli_num_rows($check) > 0){

echo "Room not available for selected dates";

}else{

mysqli_query($conn,"
INSERT INTO bookings(user_id,arrival,departure,status)
VALUES('$user_id','$arrival','$departure','pending')
");

echo "Booking Successful";
echo "<script>window.location.href='../index.php';</script>";

}

}

?>