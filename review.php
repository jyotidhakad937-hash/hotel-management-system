<?php
// 1. Check karein ki form submit hua hai ya nahi
if (isset($_POST['submit_review'])) {
    
    // 2. Data ko fetch aur secure karein (SQL Injection se bachne ke liye)
    $room_id = mysqli_real_escape_string($conn, $_GET['id']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // 3. Validation: Check karein ki rating select ki hai ya nahi
    if(empty($rating)) {
        echo "<script>alert('Please select a star rating!');</script>";
    } else {
        // 4. Database mein insert karein
        $query = "INSERT INTO reviews (room_id, user_name, rating, message) 
                  VALUES ('$room_id', '$user_name', '$rating', '$message')";
        
        $run = mysqli_query($conn, $query);

        if ($run) {
            echo "<script>alert('Review submitted successfully!'); window.location.href='room_details.php?id=$room_id';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>