<?php 
include 'common/header.php';
include 'common/config.php'; 
$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM blog");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);

$rooms = mysqli_query($conn,"SELECT * FROM blog LIMIT $offset, $limit");
?>


<style>
    /* 1. Header Section */
    .back_re {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/about-banner.jpg');
        padding: 80px 0;
        text-align: center;
        color: #fff;
        margin-bottom: 60px;
    }
    .back_re h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    /* 2. Blog Card Styling */
    .blog_box {
        background: #fff;
        border-radius: 0; /* Hotel style sharp edges */
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        height: 100%;
        border: 1px solid #eee;
    }
    .blog_box:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    /* 3. Image Section with Date Badge */
    .blog_img {
        position: relative;
        overflow: hidden;
    }
    .blog_img img {
        transition: transform 0.8s ease;
    }
    .blog_box:hover .blog_img img {
        transform: scale(1.1);
    }

    /* Professional Date Overlay (If you have a date column, else it's decorative) */
    .blog_date {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #d4af37; /* Gold */
        color: #fff;
        padding: 5px 15px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
        text-transform: uppercase;
    }

    /* 4. Blog Content */
    .blog_content {
        padding: 25px;
    }
    .blog_category {
        color: #d4af37;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 10px;
    }
    .blog_content h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        color: #222;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    .blog_content p {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    /* 5. Read More Link */
    .read_btn {
        font-weight: 700;
        color: #1a1a1a;
        text-decoration: none;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #d4af37;
        transition: 0.3s;
    }
    .read_btn:hover {
        color: #d4af37;
    }
    .container-flex{
      overflow: hidden;
    }
</style>

<div class="back_re">
   <div class="container">
      <h2>Latest News & Stories</h2>
   </div>
</div>

<div class="blog-section mb-5">
   <div class="container-flex">
      <div class="row g-4"> 
         <?php 
   // IMPORTANT: pagination wali query use ho rahi hai
      $result = $rooms;


   if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
   ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="blog_box">
                  
                  <div class="blog_img">
                     <div class="blog_date">Trending</div> <img src="admin/uploads/<?php echo $row['image']; ?>" 
                          alt="blog" 
                          style="width:100%; height:260px; object-fit:cover;" />
                  </div>

                  <div class="blog_content">
                     <span class="blog_category"><?php echo $row['tittle']; ?></span>
                     
                     <h3><?php echo $row['name']; ?></h3>
                     
                     <p><?php echo substr($row['description'], 0, 110); ?>...</p>
                     
                     <a href="blog_details.php?id=<?php echo $row['id']; ?>" class="read_btn">
                        Read Experience &rarr;
                     </a>
                  </div>

               </div>
            </div>
         <?php 
                } 
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted'>No blogs posted yet.</p></div>";
            }
         ?>
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
</div>
<?php include 'common/footer.php'; ?>