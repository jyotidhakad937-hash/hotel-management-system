<?php 
session_start();
if(isset($_SESSION['user_id'])){
header("location:login.php");
    exit();
}
$check=mysqli_query($conn,"SELECT * FROM booking
WHERE room_id='$room_id'AND(checkin<='$checkout' AND checkout='$checkin')");
if(mysqli_num_rows($result)>0);
"<script>alert(already book)window.location.href='book_room.php';</script>";
?>