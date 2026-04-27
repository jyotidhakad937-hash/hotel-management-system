<?php
session_start();
include "../common/config.php";

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO register (name,email,phone,password)
VALUES('$name','$email','$phone','$hash')";

if(mysqli_query($conn,$query)){

echo "Registration Successful";
echo "<script>window.location.href='../index.php';</script>";

}else{

echo "Error: ".mysqli_error($conn);

}

}
?>