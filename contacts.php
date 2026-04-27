<?php include '../common/config.php'; 
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $message=$_POST['message'];

    $sql="INSERT INTO contacts(name,email,phone,message)VALUES('$name','$email','$phone','$message')";

    if(mysqli_query($conn,$sql)){
        // echo "success";
        echo "<script>window.location.href='../index.php';</script>";
    }else{
        echo "error";
    }
}
?>