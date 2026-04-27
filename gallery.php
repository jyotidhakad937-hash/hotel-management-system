<?php 
include 'common/header.php'; 
include 'common/config.php';
$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM images");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

$rooms = mysqli_query($conn,"SELECT * FROM images LIMIT $offset, $limit");
?>

<style>
    /* 1. Hero Section Design */
    .back_re {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/gallery-bg.jpg'); /* Background image path check karein */
        background-size: cover;
        background-position: center;
        padding: 120px 0 80px;
        text-align: center;
    }

    .back_re h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 5px;
        margin: 0;
    }

    /* 2. Gallery Grid Styling */
    .gallery-section {
        padding: 80px 0;
        background-color: #fdfdfd;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 5px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        background: #fff;
        height: 400px; /* Badi images ke liye height */
    }

    .gallery-img {
        width: 100%;
        height: 86%;
        /* object-fit: cover; */
        transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    /* 3. Professional Hover Effect */
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(212, 175, 55, 0.85); /* Gold Overlay */
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .gallery-overlay i {
        color: #fff;
        font-size: 2.5rem;
        transform: scale(0.5);
        transition: all 0.4s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-item:hover .gallery-overlay i {
        transform: scale(1);
    }

    .gallery-item:hover .gallery-img {
        transform: scale(1.1);
    }

    /* Section Label */
    .section-label {
        color: #d4af37;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        text-align: center;
    }
    .container-flex{
      overflow: hidden;
    }
</style>

<div class="back_re">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="title">
               <h2>Our Gallery</h2>
            </div>
         </div>
      </div>
   </div>
</div>

<section class="gallery-section">
   <div class="container-flex">
      <span class="section-label">Luxury Moments</span>
      <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif; font-size: 2.5rem;">Visual Journey of Our Hotel</h2>
      
      <div class="row g-4"> 
<?php
// pagination wali query use ho rahi hai
$images = $rooms;

if($images && mysqli_num_rows($images) > 0) {
   while($row = mysqli_fetch_assoc($images)){
?> 
   <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="gallery-item">
         <img src="admin/uploads/<?php echo $row['image']; ?>" 
              alt="Hotel Image" 
              class="gallery-img"/>
         
         <div class="gallery-overlay">
            <i class="fa fa-search-plus"></i>
         </div>
      </div>
   </div>
<?php 
   }
} else {
   echo "<div class='col-12 text-center'><p class='text-muted'>No images found in the gallery.</p></div>";
}
?>
</div>
</section>
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
</div>
<?php include 'common/footer.php'; ?>