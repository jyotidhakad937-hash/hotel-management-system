<?php
// PHP ki errors ko PDF ke beech mein aane se rokne ke liye
error_reporting(0); 
ini_set('display_errors', 0);

require_once __DIR__ . '/libraries/autoload.inc.php'; 
include "common/config.php";

use Dompdf\Dompdf;
use Dompdf\Options;

if(isset($_GET['id'])) {
    $b_id = mysqli_real_escape_string($conn, $_GET['id']);
    
   
    $query = "SELECT booking.*, rooms.name AS room_name_display 
              FROM booking 
              INNER JOIN rooms ON booking.room_id = rooms.id 
              WHERE booking.id = '$b_id' AND booking.status = 'Success'";
    
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Simple HTML for PDF
        $html = "
        <div style='font-family: sans-serif; border: 1px solid #eee; padding: 20px;'>
            <h1 style='text-align:center; color: #28a745;'>Hotel Booking</h1>
            <p style='text-align:center;'>Official Booking Receipt</p>
            <hr>
            <table style='width:100%; margin-top:20px; border-collapse: collapse;'>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd;'><b>Booking ID:</b></td>
                    <td style='padding:10px; border:1px solid #ddd;'>#{$data['id']}</td>
                </tr>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd;'><b>Customer Name:</b></td>
                    <td style='padding:10px; border:1px solid #ddd;'>{$data['name']}</td>
                </tr>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd;'><b>Room Name:</b></td>
                    <td style='padding:10px; border:1px solid #ddd;'>{$data['room_name_display']}</td>
                </tr>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd;'><b>Check-in:</b></td>
                    <td style='padding:10px; border:1px solid #ddd;'>{$data['checkin']}</td>
                </tr>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd;'><b>Check-out:</b></td>
                    <td style='padding:10px; border:1px solid #ddd;'>{$data['checkout']}</td>
                </tr>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd; background:#f9f9f9;'><b>Total Amount:</b></td>
                    <td style='padding:10px; border:1px solid #ddd; background:#f9f9f9;'><b>INR {$data['price']}</b></td>
                </tr>
                <tr>
                    <td style='padding:10px; border:1px solid #ddd;'><b>Payment ID:</b></td>
                    <td style='padding:10px; border:1px solid #ddd;'>{$data['payment_id']}</td>
                </tr>
            </table>
            <p style='text-align:center; margin-top:30px; font-size:12px; color:#666;'>
                Thank you! This is a computer-generated invoice.
            </p>
        </div>";

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Output PDF
        $dompdf->stream("Invoice_#$b_id.pdf", array("Attachment" => 1));
        exit;
    } else {
        echo "Invoice generate nahi ho saki. 1. ID galat hai ya 2. Status 'Success' nahi hai.";
    }
}
?>