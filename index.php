     <?php
session_start();
if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
 include 'common/header.php';
 include 'common/config.php'; ?>

 <section class="banner_main">
    <?php 
    $sql = "SELECT * FROM front";
    $result = mysqli_query($conn, $sql);
    ?>
    
    <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php 
            $i = 0;
            foreach($result as $row){
                $active = ($i == 0) ? 'active' : '';
                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="'.$active.'"></li>';
                $i++;
            }
            ?>
        </ol>

        <div class="carousel-inner">
            <?php 
            mysqli_data_seek($result, 0); // Pointer ko wapas start par laane ke liye
            $first = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $activeClass = $first ? 'active' : '';
                $first = false;
            ?>
                <div class="carousel-item <?php echo $activeClass; ?>">
                    <img class="second-slide" src="admin/uploads/<?php echo $row['image']; ?>" alt="Hotel Slide" style="width: 100%; height: 800px;">
            

                    
                    </div>
                     <?php 
                           }
                   ?>

            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
<div class="booking_ocline">
<div class="container">
<div class="row">
<div class="col-md-5">

<div class="book_room">
<h1>Book a Room Online</h1>

<form class="book_now" action="php/booking.php" method="POST">

<div class="row">

<div class="col-md-12">
<span>Arrival</span>
<img class="date_cua" src="images/date.png">
<input class="online_book" type="date" name="arrival" required>
</div>

<div class="col-md-12">
<span>Departure</span>
<img class="date_cua" src="images/date.png">
<input class="online_book" type="date" name="departure" required>
</div>

<div class="col-md-12">
<button type="submit" name="book" class="book_btn">Book Now</button>
</div>

</div>

</form>

</div>
</div>
</div>
</div>
</div>
      </section>
      <style>
    /* Section Styling */
    .about-section {
        padding: 100px 0;
        background-color: #fff;
    }

    /* Image Styling: Frame Effect */
    .image-container {
        position: relative;
        padding: 20px;
    }

    /* Background decorative box (Gold/Premium look) */
    .image-container::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 80%;
        height: 80%;
        border: 10px solid #d4af37; /* Gold border */
        z-index: 0;
        border-radius: 10px;
    }

    .about-img-wrapper {
        position: relative;
        z-index: 1;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .about-img-wrapper img {
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        width: 100%;
        height: auto;
        display: block;
    }

    /* Hover effect to make it interactive */
    .image-container:hover img {
        transform: scale(1.05);
    }

    /* Typography fixes */
    .hotel-subtitle {
        color: #d4af37;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 10px;
    }

    .about-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 25px;
    }

    .description-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }
    div {
 
  overflow: hidden;
}
</style>

<section class="about-section">
    <div class="container-flex">
         <?php 
        $sql = "SELECT * FROM about LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <div class="row align-items-center mb-5">
            <div class="col-lg-5 col-md-12 mb-5 mb-lg-0">
                <div class="titlepage">
                    <span class="hotel-subtitle">Since 1995</span>
                    <h2 class="about-title">Our Heritage & <br>Luxury Lifestyle</h2>
                    <p class="description-text">
                        <?php echo $row['description']; ?>
                    </p>
                    <a class="btn btn-outline-dark px-4 py-2 fw-bold" href="about.php">LEARN MORE</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="image-container">
                    <div class="about-img-wrapper">
                        <img src="admin/uploads/<?php echo $row['image']; ?>" 
                             alt="Luxury Suite" 
                             class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <?php 
            }
        } 
        ?>
    </div>
</section>
   
      <!-- end about -->
      <!-- our_room -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --gold: #d4af37;
        --dark-blue: #1a2b48;
    }

    .our_room {
        background-color: #f8f9fa;
        padding: 100px 0;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--dark-blue);
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .section-title::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--gold);
    }

    /* Professional Room Card */
    .room-card {
        border: none;
        border-radius: 0; /* Square edges look more premium in hotels */
        overflow: hidden;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
    }

    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    /* Image Styling */
    .room-img-container {
        position: relative;
        height: 300px; /* Badi images ke liye height badha di */
        overflow: hidden;
    }

    .room-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .room-card:hover .room-img {
        transform: scale(1.1);
    }

    /* Price Badge Overlay */
    .price-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--gold);
        color: white;
        padding: 8px 15px;
        font-weight: 600;
        font-size: 0.9rem;
        z-index: 2;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
    }

    /* Card Body */
    .card-body {
        padding: 25px;
        text-align: center;
    }

    .room-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        color: var(--dark-blue);
        margin-bottom: 15px;
    }

    .room-features {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
        color: #888;
        font-size: 0.85rem;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .btn-book {
        background: var(--dark-blue);
        color: #fff;
        border-radius: 0;
        padding: 10px 25px;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        transition: 0.3s;
        border: none;
    }

    .btn-book:hover {
        background: var(--gold);
        color: white;
    }
</style>

<div class="our_room">
    <div class="container-flex">

        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2 class="section-title">Luxury Accommodation</h2>
                <p class="text-muted">Stay in the heart of the city with world-class amenities</p>
            </div>
        </div>

        <div class="row">
            <?php
            $rooms = mysqli_query($conn,"SELECT * FROM rooms LIMIT 3");
            while($row = mysqli_fetch_assoc($rooms)){
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card room-card">
                    
                    <div class="room-img-container">
                        <div class="price-badge">
                            Starting from ₹<?php echo isset($row['price']) ? $row['price'] : '199'; ?> / Night
                        </div>
                        
                        <img src="admin/uploads/<?php echo $row['image']; ?>" 
                             class="room-img" 
                             alt="Luxury Room">
                    </div>

                    <div class="card-body">
                        <h5 class="room-name"><?php echo $row['name']; ?></h5>
                        
                        <p class="text-muted small">
                            <?php echo substr($row['description'], 0, 100); ?>...
                        </p>

                        <div class="room-features">
                            <span><i class="fa fa-wifi"></i> WiFi</span>
                            <span><i class="fa fa-tv"></i> TV</span>
                            <span><i class="fa fa-coffee"></i> Breakfast</span>
                        </div>

                        <a href="book_room.php?id=<?php echo $row['id']; ?>" class="btn btn-book">
                            Book Now &nbsp; <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>

                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>  <!-- end our_room -->
      <!-- gallery -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --gold: #d4af37;
    }

    .gallery-section {
        padding: 80px 0;
        background-color: #fff;
    }

    .gallery-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: #1a2b48;
        margin-bottom: 10px;
    }

    /* Professional Gallery Card */
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 0px; /* Modern hotels use clean sharp or very slight radius */
        margin-bottom: 30px;
        cursor: pointer;
        height: 280px; /* Uniform height */
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    /* Dark Overlay with Icon */
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 43, 72, 0.7); /* Dark Blue Overlay */
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .gallery-overlay i {
        color: #fff;
        font-size: 2rem;
        transform: translateY(20px);
        transition: all 0.4s ease;
        border: 2px solid var(--gold);
        padding: 15px;
        border-radius: 50%;
    }

    /* Hover Effects */
    .gallery-item:hover .gallery-img {
        transform: scale(1.15);
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-item:hover .gallery-overlay i {
        transform: translateY(0);
        background: var(--gold);
    }

    /* Filter Buttons (Optional but Professional) */
    .gallery-filter .btn {
        border: none;
        background: transparent;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #666;
        margin: 0 10px;
    }

    .gallery-filter .btn.active {
        color: var(--gold);
        border-bottom: 2px solid var(--gold);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    :root {
        --gold: #d4af37;
        --dark-blue: #1a2b48;
    }

    .gallery-section {
        padding: 100px 0; /* Increased padding for breathing space */
        background-color: #fdfdfd; /* Very light grey for contrast */
    }

    .gallery-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem; /* Larger Title */
        color: var(--dark-blue);
        margin-bottom: 15px;
        font-weight: 700;
    }

    /* Professional Large Gallery Card */
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 4px; /* Very slight radius for modern touch */
        margin-bottom: 30px;
        cursor: pointer;
        
        /* IMAGE SIZE CONFIGURATION */
        height: 400px; /* INCREASED HEIGHT FOR LARGER IMAGES */
        
        box-shadow: 0 15px 35px rgba(0,0,0,0.1); /* Soft Shadow for depth */
        transition: all 0.5s ease;
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        
        /* PIXEL PERFECT SETTINGS */
        object-fit: cover; /* Important: maintains aspect ratio without stretching */
        object-position: center; /* Keeps important part centered */
        
        transition: transform 0.8s cubic-bezier(0.2, 1, 0.3, 1);
        filter: brightness(95%); /* Slight dim for better overlay contrast */
    }

    /* Dark Overlay with Icon */
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 43, 72, 0.85); /* Darker Blue Overlay */
        display: flex;
        flex-direction: column; /* Icon and text stack vertically */
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.5s ease;
        z-index: 2;
    }

    .gallery-overlay i {
        color: #fff;
        font-size: 2.5rem; /* Larger Icon */
        transform: translateY(30px);
        transition: all 0.5s ease 0.1s; /* Slight delay for effect */
        border: 2px solid rgba(255,255,255,0.3);
        padding: 20px;
        border-radius: 50%;
        margin-bottom: 15px;
    }
    
    .overlay-text {
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.8rem;
        font-weight: 600;
        transform: translateY(30px);
        transition: all 0.5s ease 0.2s;
        font-family: 'Poppins', sans-serif;
    }

    /* Hover Effects */
    .gallery-item:hover {
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        transform: translateY(-5px);
    }

    .gallery-item:hover .gallery-img {
        transform: scale(1.1) rotate(1deg); /* Slight rotation adds dynamic feel */
        filter: brightness(100%);
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-item:hover .gallery-overlay i,
    .gallery-item:hover .overlay-text {
        transform: translateY(0);
        border-color: var(--gold);
        color: var(--gold);
    }

</style>

<section class="gallery-section">
    <div class="container-flex">

        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <span style="color: var(--gold); text-transform: uppercase; letter-spacing: 4px; font-weight: bold; font-size: 0.85rem; display: block; margin-bottom: 10px;">Our Visual Story</span>
                <h2 class="gallery-title">Hotel Moments</h2>
                <div style="width: 60px; height: 3px; background: var(--gold); margin: 0 auto; border-radius: 2px;"></div>
            </div>
        </div>

        <div class="row g-4"> <?php
        // PROFESSIONAL TIP: Limit the results to maintain quality page load, 
        // or ensure your admin uploads high-res images.
        $images = mysqli_query($conn, "SELECT * FROM images ORDER BY id DESC LIMIT 3"); 
        
        if ($images && mysqli_num_rows($images) > 0) {
            while($row = mysqli_fetch_assoc($images)){
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="gallery-item shadow">
                    <img src="admin/uploads/<?php echo $row['image'];?>" 
                         class="gallery-img" 
                         alt="Luxury Hotel Gallery">
                    
                    <div class="gallery-overlay">
                        <i class="fa fa-expand-alt"></i>
                        <span class="overlay-text">View Full Image</span>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo "<div class='col-12 text-center text-muted'>No images found in gallery.</div>";
        }
        ?>

        </div>
    </div>
</section>
      <!-- end gallery -->
      <!-- blog -->
      <div  class="blog">
         <div class="container-flex">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Blog</h2>
                     <p>Lorem Ipsum available, but the majority have suffered </p>
                  </div>
               </div>
            </div>
            <div class="row">
         <?php
            $rooms = mysqli_query($conn, "SELECT * FROM blog LIMIT 3");
            
            // Loop yahan se shuru hoga taaki har item ko apna column mile
            while($row = mysqli_fetch_assoc($rooms)){
         ?>
            <div class="col-md-4 col-sm-6 mb-4">
               <div class="blog_box">
                  <div class="blog_img">
                     <figure>
                        <img src="admin/uploads/<?php echo $row['image']; ?>" alt="blog-image" style="width:100%; height:250px; object-fit:cover;"/>
                     </figure>
                  </div>
                  <div class="blog_room">
                     <h3><?php echo $row['name']; ?></h3>
                     <span style="color: #ff0000; font-weight: bold;"><?php echo $row['tittle']; ?></span>
                     <p><?php echo substr($row['description'], 0, 100); ?>...</p>
                  </div>
               </div>
            </div>
         <?php } // Loop yahan khatam hoga ?>
      </div>
   </div>
         </div>
      </div>
      <!-- end blog -->
      <!--  contact -->
      <div class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact Us</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <form action="php/contacts.php" id="request" class="main_form" method="POST">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Name" type="type" name="name"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="type" name="email"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="phone" name="phone">                          
                        </div>
                        <div class="col-md-12">
                           <textarea class="textarea" placeholder="Message" type="message" name="message">Message</textarea>
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn" name="submit">Send</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
       <?php include 'common/footer.php'; ?>
     