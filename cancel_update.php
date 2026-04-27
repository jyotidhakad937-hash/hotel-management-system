<?php include '../common/config.php';
if(isset($_POST['id'])){
    $book_id=$_POST['book_id'];
    $name=$_POST['name'];
    $checkin=$_POST['checkin'];
    $checkout=$_POST['checkout'];
    
    $sql="INSERT * INTO rooms(book_id,name,checkin,checkout)VALUES('$book_id','$name','$checkin','$checkout')";

    if(mysqli_query($conn,$sql)){
        echo "success";
        echo "<script>window.location.href='room.php';</script>";
    }else{
        echo "something went wrong";
    }
}
?>