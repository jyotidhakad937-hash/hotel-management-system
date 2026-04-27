<?php
include "../common/config.php";

$booking_id = $_GET['id'];


$sql = "UPDATE booking SET status = 'Cancelled' WHERE id = '$booking_id'";

if(mysqli_query($conn, $sql)) {
    header("Location: ../cancel.php?msg=Cancelled Successfully");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>