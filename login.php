<?php
session_start();
include "../common/config.php";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,"SELECT * FROM register WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];

header("Location: ../index.php");

}else{

echo "Invalid Email or Password";

}

}
?>