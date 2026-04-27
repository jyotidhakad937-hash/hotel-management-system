<?php
session_start();
include "common/config.php";

$booking_id = $_GET['booking_id'];

// booking data
$booking = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM booking WHERE id='$booking_id'"));

// Room price fetch
$room = mysqli_fetch_assoc(mysqli_query($conn,"SELECT price FROM rooms WHERE id='{$booking['room_id']}'"));
$price_per_day = $room['price'];

// Date calculation
$checkin = strtotime($booking['checkin']);
$checkout = strtotime($booking['checkout']);
$days = ($checkout - $checkin) / (60 * 60 * 24);

if($days <= 0) { $days = 1; }

$amount = $price_per_day * $days;
$amountInPaise = $amount * 100;

// --- QR CODE FIX ---
$dummy_upi = "hotel.test@paytm"; 
$hotel_name = "Hotel Booking";
// UPI String create karna
$upi_url = "upi://pay?pa=$dummy_upi&pn=".urlencode($hotel_name)."&am=$amount&cu=INR&tn=Booking_$booking_id";
// Hum dusri fast API use kar rahe hain jo localhost par behtar chalti hai
$qr_image = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($upi_url);
// -------------------

// Razorpay Keys
define('RAZOR_KEY_ID', 'rzp_test_wNRznW3pfPWGYZ');
define('RAZOR_KEY_SECRET', 'nuY9acfKYQR1TPkLc0xms8oO');

// Order Create API
$ch = curl_init();
$orderData = [
    'receipt' => 'booking_'.$booking_id,
    'amount' => $amountInPaise,
    'currency' => 'INR'
];

curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, RAZOR_KEY_ID . ":" . RAZOR_KEY_SECRET);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($orderData));
$result = curl_exec($ch);
curl_close($ch);

$order = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment | Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .payment-card { max-width: 480px; margin: 50px auto; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); background: #fff; overflow: hidden; }
        .header-box { background: #28a745; color: white; padding: 25px; text-align: center; }
        .nav-tabs { border: none; justify-content: center; background: #f8f9fa; }
        .nav-link { color: #666; border: none !important; font-weight: 600; padding: 12px 25px; }
        .nav-link.active { color: #28a745 !important; border-bottom: 3px solid #28a745 !important; background: transparent !important; }
        .qr-section { text-align: center; padding: 10px; }
        .qr-img-wrapper { 
            background: #fff; 
            padding: 10px; 
            border: 1px solid #eee; 
            display: inline-block; 
            border-radius: 10px;
            min-height: 200px;
            min-width: 200px;
        }
        .btn-pay { background: #28a745; color: white; padding: 12px; font-weight: 600; border-radius: 8px; width: 100%; border: none; transition: 0.3s; }
        .btn-pay:hover { background: #218838; }
    </style>
</head>
<body>

<div class="container">
    <div class="card payment-card">
        <div class="header-box">
            <h5 class="mb-0 text-uppercase" style="font-size: 0.8rem; opacity: 0.9;">Payable Amount</h5>
            <h1 class="mt-2 mb-0">₹<?php echo number_format($amount); ?></h1>
        </div>

        <ul class="nav nav-tabs" id="paymentTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="online-tab" data-bs-toggle="tab" data-bs-target="#online" type="button">Online Gateway</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="qr-tab" data-bs-toggle="tab" data-bs-target="#qr" type="button">Scan QR Code</button>
            </li>
        </ul>

        <div class="tab-content price-details p-4">
            <div class="tab-pane fade show active" id="online" role="tabpanel">
                <div class="d-flex justify-content-between mb-2 text-muted">
                    <span>Booking ID</span><span>#<?php echo $booking_id; ?></span>
                </div>
                <hr>
                <button id="payBtn" class="btn btn-pay btn-lg shadow-sm">Confirm & Pay via Razorpay</button>
                <p class="text-center mt-3 text-muted" style="font-size: 0.75rem;">Cards, UPI, Netbanking Supported</p>
            </div>

            <div class="tab-pane fade" id="qr" role="tabpanel">
                <div class="qr-section">
                    <div class="qr-img-wrapper mb-3">
                        <img src="<?php echo $qr_image; ?>" 
                             alt="Scan QR" 
                             style="width: 200px; height: 200px;" 
                             onerror="this.src='https://placehold.co/200x200?text=Reload+Page';">
                    </div>
                    <p class="small text-muted mb-3">Scan with any UPI App (Paytm, GPay, PhonePe)</p>
                    
                    <form action="manual_verify.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                        <input type="text" name="utr_no" class="form-control mb-3 text-center" placeholder="Enter 12-digit UTR/Ref No." required maxlength="12" minlength="12">
                        <button type="submit" class="btn btn-dark w-100">Submit UTR to Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="success.php" method="POST" id="payForm">
    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
    <input type="hidden" name="razorpay_payment_id" id="payment_id">
</form>

<script>
var options = {
    "key": "<?php echo RAZOR_KEY_ID; ?>",
    "amount": "<?php echo $order['amount']; ?>",
    "currency": "INR",
    "name": "Hotel Booking",
    "description": "Room Reservation",
    "order_id": "<?php echo $order['id']; ?>",
    "handler": function (response){
        document.getElementById('payment_id').value = response.razorpay_payment_id;
        document.getElementById('payForm').submit();
    },
    "prefill": {
        "name": "<?php echo $booking['name']; ?>",
        "email": "<?php echo $booking['email']; ?>"
    },
    "theme": { "color": "#28a745" }
};
var rzp = new Razorpay(options);
document.getElementById('payBtn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>
</body>
</html>