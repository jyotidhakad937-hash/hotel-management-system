<?php
// 1. Sabse pehle saari files ko load karein
require 'OAuthTokenProvider.php';
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// In namespaces ka use karna zaroori hai
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Object banayein
$mail = new PHPMailer(true);

try {
    // 2. Mailtrap SMTP Settings (Inhe Mailtrap dashboard se verify karein)
    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'Aapka_Mailtrap_Username'; // Yahan apna username dalein
    $mail->Password   = 'Aapka_Mailtrap_Password'; // Yahan apna password dalein
    $mail->Port       = 2525; // Aap 587 ya 465 bhi try kar sakte hain

    // 3. Sender aur Receiver details
    $mail->setFrom('admin@vps-school.com', 'Vaishnavi Public School'); // Aapka naam/brand
    $mail->addAddress('customer@gmail.com'); // Jise mail bhejni hai

    // 4. Content (Email ka message)
    $mail->isHTML(true); // HTML allow karne ke liye
    $mail->Subject = 'Booking Confirmation - Success';
    
    // Yahan aap Bootstrap styles bhi use kar sakte hain
    $mail->Body    = "
        <h3>Namaste Jyoti,</h3>
        <p>Aapki booking successfully confirm ho gayi hai.</p>
        <p><b>Booking ID:</b> #BK12345</p>
        <br>
        <p>Dhanyawad!</p>
    ";

    // 5. Mail bhejhein
    if($mail->send()){
        echo "<h2 style='color:green;'>Badhai ho! Email bhej di gayi hai.</h2>";
        echo "<p>Ab Mailtrap.io par jaakar apna 'Inbox' check karein.</p>";
    }

} catch (Exception $e) {
    // Agar koi error aaye toh yahan dikhega
    echo "Galti: Email nahi gayi. PHPMailer Error: {$mail->ErrorInfo}";
}
?>