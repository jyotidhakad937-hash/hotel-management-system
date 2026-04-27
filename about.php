<?php 
include 'common/header.php'; 
include 'common/config.php';
$limit = 9; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM about");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

$rooms = mysqli_query($conn,"SELECT * FROM about LIMIT $offset, $limit");
?> 


<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap');

    .back_re {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/about-banner.jpg'); /* Banner image yaha dalein */
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        text-align: center;
        color: #fff;
    }

    .back_re h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        letter-spacing: 2px;
    }

    .about-section {
        padding: 100px 0;
        background: #fff;
    }

    .hotel-label {
        color: #d4af37; /* Gold Color */
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: 600;
        font-size: 0.9rem;
        display: block;
        margin-bottom: 15px;
    }

    .about-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: #1a1a1a;
        line-height: 1.2;
        margin-bottom: 30px;
    }

    .about-text {
        font-family: 'Poppins', sans-serif;
        font-size: 1.05rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 35px;
    }

    /* Image Effect */
    .about-img-container {
        position: relative;
        padding: 20px;
    }

    /* Background decorative box */
    .about-img-container::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80%;
        height: 80%;
        border: 2px solid #d4af37;
        z-index: 0;
    }

    .about_img {
        position: relative;
        z-index: 1;
        box-shadow: 20px 20px 60px rgba(0,0,0,0.15);
        transition: transform 0.5s ease;
    }

    .about_img:hover {
        transform: translate(10px, -10px);
    }

    .read_more_btn {
        background: #1a1a1a;
        color: #fff;
        padding: 15px 40px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        letter-spacing: 1px;
        transition: 0.3s;
        border: 1px solid #1a1a1a;
    }

    .read_more_btn:hover {
        background: transparent;
        color: #1a1a1a;
    }
    .about-section{
      overflow: hidden;
    }
</style>

<div class="back_re">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="title">
               <h2>About Our Resort</h2>
            </div>
         </div>
      </div>
   </div>
</div>

<section class="about-section">
  <div class="container-flex"> 


  
   <?php 
   // IMPORTANT: pagination wali query use ho rahi hai
   $result = $rooms;

   if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
   ?>
   <div class="row align-items-center"> 
      
      <div class="col-lg-6 col-md-12 mb-5 mb-lg-0">
         <div class="titlepage pe-lg-5">
            <span class="hotel-label">A Tradition of Luxury</span>
            <h3 class="about-title">Experience the Best <br> Hospitality in Town</h3>
            <div class="about-text">
               <?php echo $row['description']; ?>
            </div>
            <a class="read_more_btn" href="contact.php">Contact Us Now</a>
         </div>
      </div>

      <div class="col-lg-6 col-md-12">
         <div class="about-img-container">
            <div class="about_img">
               <img src="admin/uploads/<?php echo $row['image']; ?>" 
                    alt="About Image" 
                    class="img-fluid w-100" 
                    style="object-fit: cover; min-height: 400px;"/>
            </div>
         </div>
      </div>

   </div>
   <?php 
      }
   } else {
      echo "<div class='col-md-12 text-center'><p>No Content Found</p></div>";
   }
   ?>
</div>   <div class="d-flex justify-content-center mt-5">
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
</section>

<?php include 'common/footer.php'; ?>