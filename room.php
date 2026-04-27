<?php 
include 'common/header.php'; 
include 'common/config.php'; 

$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM rooms");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

$rooms = mysqli_query($conn,"SELECT * FROM rooms LIMIT $offset, $limit");
?> 

<style>
    /* Premium Typography */
    .back_re {
        background: #615e5e;
        color: #fff;
        padding: 60px 0;
        margin-bottom: 50px;
        
    }
    .back_re h2 {
        font-family: 'Playfair Display', serif;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Room Card Styling */
    .room-card {
        transition: all 0.4s ease;
        border-radius: 0; /* Square edges look more premium for hotels */
        overflow: hidden;
        border: 1px solid #eee;
    }
    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }

    /* Image Quality & Size */
    .room-img-wrapper {
        position: relative;
        height: 280px; /* Increased height */
        overflow: hidden;
    }
    .room-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .room-card:hover .room-img {
        transform: scale(1.1);
    }

    /* Price Tag Overlay */
    .price-tag {
        position: absolute;
        bottom: 0;
        left: 0;
        background: #d4af37; /* Gold */
        color: #fff;
        padding: 7px 15px;
        font-weight: bold;
        font-size: 1.1rem;
    }

    /* Content Styling */
    .card-body {
        padding: 25px;
    }
    .room-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: #222;
        margin-bottom: 15px;
    }
    .room-desc {
        font-size: 0.95rem;
        line-height: 1.6;
        height: 50px; /* Fixed height for alignment */
        overflow: hidden;
    }

    /* Action Buttons */
    .btn-details {
        border-radius: 0;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        padding: 10px 20px;
    }
    .btn-book {
        border-radius: 0;
        background: #1a1a1a;
        border-color: #1a1a1a;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        padding: 10px 20px;
    }
    .btn-book:hover {
        background: #d4af37;
        border-color: #d4af37;
    }
    .container-flex{
      overflow: hidden;
    }
    
</style>

<div class="back_re">
   <div class="container">
      <h2 class="text-center">Our Luxury Rooms</h2>
      <p class="text-center text-muted" style="color: #aaa !important;">Experience world-class hospitality in our handpicked suites</p>
   </div>
</div>

<div class="container-flex mb-5">
   <div class="row g-4">

   <?php
   // IMPORTANT: Yahi query use hogi (LIMIT wali)
   while($row = mysqli_fetch_assoc($rooms)){
   ?> 

      <div class="col-lg-4 col-md-6 col-sm-12">
         <div class="card shadow-sm room-card h-100">

            <div class="room-img-wrapper">
               <img src="admin/uploads/<?php echo $row['image']; ?>" class="room-img" alt="Room Image">
               <div class="price-tag">
                  ₹<?php echo number_format($row['price']); ?> <small>/ Night</small>
               </div>
            </div>

            <div class="card-body">
               <h5 class="room-title">
                  <?php echo $row['name']; ?>
               </h5>

               <p class="room-desc text-muted">
                  <?php echo substr($row['description'],0,90); ?>...
               </p>

               <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                  <a href="room_details.php?id=<?php echo $row['id']; ?>" 
                     class="btn btn-outline-dark btn-details">
                     Details
                  </a>

                
               </div>
            </div>

         </div>
      </div>

   <?php } ?>

   </div>
</div>
    
</div>
<div class="d-flex justify-content-center mt-5">
<ul class="pagination">

    <!-- Previous -->
    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
        <a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a>
    </li>

    <!-- Page Numbers -->
    <?php for($i=1; $i <= $total_pages; $i++){ ?>
        <li class="page-item <?php if($i == $page){ echo 'active'; } ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>">
                <?php echo $i; ?>
            </a>
        </li>
    <?php } ?>

    <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a>
    </li>

</ul>

</div><?php include 'common/footer.php'; ?>