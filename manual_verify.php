<?php
session_start();
include "common/config.php"; 

// 1. Files ko sahi order mein load karein
require_once __DIR__ . '/Exception.php';
require_once __DIR__ . '/PHPMailer.php';
require_once __DIR__ . '/SMTP.php';
// Agar aap OAuth use nahi kar rahe toh niche wali line ko hata bhi sakte hain
// require_once __DIR__ . '/OAuthTokenProvider.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $utr  = mysqli_real_escape_string($conn, $_POST['utr_no']);
    
    // Database Update
    $sql = "UPDATE booking SET status='Success', payment_id='QR_$utr' WHERE id='$b_id'";

    if ($conn->query($sql) === TRUE) {
        
        $booking_query = mysqli_query($conn, "SELECT * FROM booking WHERE id='$b_id'");
        $booking_data = mysqli_fetch_assoc($booking_query);
        $user_email = $booking_data['email'];
        $user_name = $booking_data['name'];

        $mail = new PHPMailer(true);

        try {
            // SMTP Settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';             // Gmail SMTP server
            $mail->SMTPAuth   = true;                         // Authentication on
            $mail->Username   = 'jyotidhakad937@gmail.com';   // Aapka Email
            $mail->Password   = 'fspypaxatoxowgug';           // BINA SPACE KE 16-digit App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // SSL Encryption (Port 465 ke liye)
            $mail->Port       = 465;                          // Sahi Port for SSL

            // Localhost (XAMPP) ke liye SSL Certificate ignore karne ki settings
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Sender and Recipient
            $mail->setFrom('jyotidhakad937@gmail.com', 'Hotel Booking System'); // Aapka naam/brand
            $mail->addAddress($user_email, $user_name); 

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Confirmation - Hotel Booking';
            $mail->Body    = "<h3>Success!</h3><p>Namaste <b>$user_name</b>, aapki payment verify ho gayi hai.</p><p>Booking ID: #$b_id</p>";

            $mail->send();
            $msg = "Success! Payment submitted and email sent.";
        } catch (Exception $e) {
            // Sirf debugging ke liye aap yahan $mail->ErrorInfo print kar sakti hain
            $msg = "Payment recorded, but Email Error: Authentication Failed.";
        }

       echo "<div style='text-align:center; margin-top:50px; font-family:sans-serif;'>
        <div style='display:inline-block; padding:30px; border:1px solid #ddd; border-radius:10px;'>
            <h2 style='color:green;'>$msg ✅</h2>
            <p>Booking ID: #$b_id</p>
            <div style='margin-top:20px;'>
                <a href='generate_invoice.php?id=$b_id' style='background:#007bff; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; margin-right:10px;'>Download Invoice 📄</a>
                <a href='index.php' style='background:green; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;'>Home Pe Jayein</a>
            </div>
        </div>
      </div>";
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>