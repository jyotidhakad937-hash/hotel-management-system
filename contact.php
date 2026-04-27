<?php include 'common/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    :root {
        --hotel-gold: #d4af37; /* Luxury Gold Color */
        --hotel-dark: #2c3e50;
    }
    body { font-family: 'Poppins', sans-serif; background-color: #fdfdfd; }

    /* Header Section */
    .contact-header {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/hotel_contact_bg.jpg'); 
        background-size: cover;
        background-position: center;
        padding: 120px 0;
        color: white;
        text-align: center;
    }
    .contact-header h1 { font-weight: 600; letter-spacing: 2px; text-transform: uppercase; }

    /* Info Cards */
    .info-box {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: 0.3s;
        height: 100%;
    }
    .info-box:hover { transform: translateY(-10px); }
    .info-box i { font-size: 40px; color: var(--hotel-gold); margin-bottom: 15px; }

    /* Form Styling */
    .contact-form-card {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #eee;
    }
    .form-control:focus {
        border-color: var(--hotel-gold);
        box-shadow: 0 0 10px rgba(212, 175, 55, 0.1);
    }
    .btn-hotel {
        background-color: var(--hotel-gold);
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }
    .btn-hotel:hover {
        background-color: #b8962d;
        box-shadow: 0 5px 15px rgba(184, 150, 45, 0.4);
    }
</style>

<section class="contact-header">
    <div class="container">
        <h1>Get In Touch</h1>
        <p>Experience world-class hospitality. We are here to assist you 24/7.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-box">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Our Location</h4>
                    <p>123 Luxury Avenue, Paradise Beach, Goa, India</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="bi bi-telephone"></i>
                    <h4>Call Us</h4>
                    <p>+91 98765 43210 <br> +91 12345 67890</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="bi bi-envelope"></i>
                    <h4>Email Us</h4>
                    <p>info@luxuryhotel.com <br> support@luxuryhotel.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="contact-form-card">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form action="php/contact.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="john@example.com" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Phone</label>
                                <input type="text"  class="form-control" name="phone">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" rows="5" placeholder="Tell us how we can help..."></textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" name="submit" class="btn btn-hotel w-100">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="h-100 rounded-3 overflow-hidden shadow">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509374!2d144.9537353153166!3d-37.81031257975171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d123456789!2sHotel!5e0!3m2!1sen!2sin!4v1625647000000!5m2!1sen!2sin" 
                        width="100%" height="100%" style="border:0; min-height: 400px;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'common/footer.php'; ?>