<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
include "common/config.php";
include 'common/header.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$room = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rooms WHERE id='$id'"));

// Fetch Booked Dates
$booked = mysqli_query($conn, "SELECT checkin, checkout FROM booking WHERE room_id='$id' AND status != 'Cancelled'");
$dates = [];
while($row = mysqli_fetch_assoc($booked)){
    $period = new DatePeriod(
        new DateTime($row['checkin']),
        new DateInterval('P1D'),
        (new DateTime($row['checkout']))->modify('+1 day')
    );
    foreach ($period as $date) {
        $dates[] = $date->format("Y-m-d");
    }
}
$dates_json = json_encode($dates);
?>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_orange.css">

<style>
    :root {
        --gold: #c5a059;
        --dark: #1a1a1a;
        --light-bg: #f8f9fa;
    }

    body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

    .booking-section { padding: 80px 0; }
    
    /* Room Summary Sidebar */
    .room-summary-card {
        background: white;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        position: sticky;
        top: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .room-summary-img { width: 100%; height: 200px; object-fit: cover; }
    .summary-details { padding: 25px; }
    .price-circle {
        background: var(--dark);
        color: var(--gold);
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
        text-align: center;
        color: #e1e1e1;
    }

    /* Booking Form Card */
    .booking-form-card {
        background: white;
        border: none;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        margin-bottom: 30px;
        color: var(--dark);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #777;
        margin-bottom: 8px;
    }
    .form-control {
        border: 1px solid #e1e1e1;
        padding: 12px 15px;
        border-radius: 8px;
        transition: 0.3s;
    }
    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.1);
    }

    /* Status Selector Styling */
    .status-badge-input {
        background: #f1f1f1;
        font-weight: bold;
        color: var(--dark);
    }

    /* Button Styling */
    .btn-confirm-stay {
        background: var(--dark);
        color: white;
        padding: 18px;
        border-radius: 8px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: none;
        transition: 0.4s;
        width: 100%;
    }
    .btn-confirm-stay:hover {
        background: var(--gold);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    /* Flatpickr Customization */
    .flatpickr-day.flatpickr-disabled { color: #ff4d4d !important; text-decoration: line-through; }

    .mb-0, .my-0 {
    margin-bottom: 0 !important;
    color: antiquewhite;
}

</style>

<div class="booking-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 order-lg-2">
                <div class="room-summary-card">
                    <img src="admin/uploads/<?php echo $room['image']; ?>" class="room-summary-img">
                    <div class="summary-details">
                        <small class="text-uppercase text-muted">You are booking</small>
                        <h4 class="fw-bold mt-1"><?php echo $room['name']; ?></h4>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Max Occupancy:</span>
                            <strong>2 Adults</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Room Size:</span>
                            <strong>450 sqft</strong>
                        </div>
                        <div class="price-circle">
                            <small class="d-block text-uppercase">Total Price per Night</small>
                            <h3 class="mb-0 fw-bold">₹<?php echo number_format($room['price']); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 order-lg-1">
                <div class="booking-form-card">
                    <h2 class="section-title">Guest Information</h2>
                    
                    <form action="php/book_room.php" method="POST">
                        <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">First & Last Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 00000 00000" required>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label"><i class="fa fa-calendar-check me-2"></i>Check-In</label>
                                <input type="text" id="checkin" name="checkin" class="form-control" placeholder="Select Date" readonly required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label"><i class="fa fa-calendar-xmark me-2"></i>Check-Out</label>
                                <input type="text" id="checkout" name="checkout" class="form-control" placeholder="Select Date" readonly required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Number of Guests</label>
                                <select name="guests" class="form-select form-control" required>
                                    <option value="1">1 Person</option>
                                    <option value="2" selected>2 Persons</option>
                                    <option value="3">3 Persons</option>
                                    <option value="4">4+ Persons</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Reservation Type</label>
                                <select name="status" class="form-select form-control status-badge-input" required>
                                    <option value="pending">Standard Reservation</option>
                                    <option value="confirm">Instant Confirmation</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" id="bookBtn" name="book_now" class="btn-confirm-stay">
                                Confirm Reservation <i class="fa fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
let bookedDates = <?php echo $dates_json; ?>;
let btn = document.getElementById("bookBtn");

function checkAvailability(){
    let cin = document.getElementById("checkin").value;
    let cout = document.getElementById("checkout").value;
    if(!cin || !cout) return;

    let start = new Date(cin);
    let end = new Date(cout);
    let isBooked = false;

    for(let d = new Date(start); d <= end; d.setDate(d.getDate()+1)){
        let dateStr = d.toISOString().split('T')[0];
        if(bookedDates.includes(dateStr)){
            isBooked = true;
            break;
        }
    }

    if(isBooked){
        btn.disabled = true;
        btn.style.background = "#ff4d4d";
        btn.innerText = "Room Occupied for Selected Dates";
    } else {
        btn.disabled = false;
        btn.style.background = "#1a1a1a";
        btn.innerText = "Confirm Reservation";
    }
}

const checkin = flatpickr("#checkin", {
    minDate: "today",
    dateFormat: "Y-m-d",
    disable: bookedDates,
    onChange: function(selectedDates, dateStr){
        checkout.set("minDate", dateStr);
        checkAvailability();
    }
});

const checkout = flatpickr("#checkout", {
    minDate: "today",
    dateFormat: "Y-m-d",
    disable: bookedDates,
    onChange: function(){
        checkAvailability();
    }
});
</script>

<?php include 'common/footer.php'; ?>