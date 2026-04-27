<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hotel Facilities</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (Icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body {
    background: #f8f9fa;
}

/* Section Title */
.section-title {
    text-align: center;
    margin-bottom: 40px;
}

.section-title h2 {
    font-weight: bold;
}

/* Facility Card */
.facility-card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.facility-card i {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 15px;
}

.facility-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
</style>
</head>

<body>

<div class="container py-5">

    <!-- Title -->
    <div class="section-title">
        <h2>Our Facilities</h2>
        <p>Enjoy the best services and amenities during your stay</p>
    </div>

    <!-- Facilities -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="facility-card">
                <i class="fas fa-wifi"></i>
                <h5>Free WiFi</h5>
                <p>High-speed internet available in all rooms.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="facility-card">
                <i class="fas fa-car"></i>
                <h5>Parking</h5>
                <p>Secure and spacious parking for guests.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="facility-card">
                <i class="fas fa-swimmer"></i>
                <h5>Swimming Pool</h5>
                <p>Relax and enjoy our luxury pool area.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="facility-card">
                <i class="fas fa-dumbbell"></i>
                <h5>Gym</h5>
                <p>Modern fitness center with latest equipment.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="facility-card">
                <i class="fas fa-utensils"></i>
                <h5>Restaurant</h5>
                <p>Delicious food with multiple cuisines.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="facility-card">
                <i class="fas fa-concierge-bell"></i>
                <h5>Room Service</h5>
                <p>24/7 room service for your comfort.</p>
            </div>
        </div>

    </div>

    <!-- Button -->
    <div class="text-center mt-5">
        <a href="booking.php" class="btn btn-primary px-4 py-2">Book Now</a>
    </div>

</div>

</body>
</html>