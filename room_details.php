<?php
include "common/config.php";
include 'common/header.php';

if(!isset($_GET['id'])){ echo "Room not found"; exit; }

$id = mysqli_real_escape_string($conn, $_GET['id']);

$room_query = "SELECT r.*, AVG(rev.rating) as avg_rating, COUNT(rev.id) as total_reviews 
               FROM rooms r 
               LEFT JOIN reviews rev ON r.id = rev.room_id 
               WHERE r.id='$id' GROUP BY r.id";
$room = mysqli_fetch_assoc(mysqli_query($conn, $room_query));

if(!$room){ echo "Invalid Room"; exit; }


if(isset($_POST['submit_review'])){
    $name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $rating = (int)$_POST['rating'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $insert = mysqli_query($conn, "INSERT INTO reviews (room_id, user_name, rating, message) VALUES ('$id', '$name', '$rating', '$message')");
    if($insert){
        echo "<script>alert('Review submitted!'); window.location.href='room_details.php?id=$id';</script>";
    }
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root { --gold: #d4af37; --dark: #1a1a1a; }

    .main-display img { width: 100%; height: 500px; object-fit: cover; border-radius: 4px; }
    .thumb-container { display: flex; gap: 10px; margin-top: 15px; flex-wrap: wrap; }
    .thumb-img { width: 100px; height: 70px; object-fit: cover; cursor: pointer; opacity: 0.6; transition: 0.3s; border: 2px solid #eee; border-radius: 4px; }
    .thumb-img:hover, .thumb-img.active { opacity: 1; border-color: var(--gold); transform: scale(1.05); }

    /* Sticky Info Box */
    .info-box { position: sticky; top: 20px; }
    .price-tag { font-size: 2.2rem; font-weight: 800; color: var(--dark); }
    .price-tag span { font-size: 1rem; color: #777; font-weight: 400; }

    /* Amenities & Specs */
    .spec-item { border: 1px solid #eee; padding: 15px; text-align: center; border-radius: 8px; background: #fff; }
    .spec-item i { font-size: 1.5rem; color: var(--gold); margin-bottom: 8px; display: block; }
    
    .amenity-badge { background: #fdfaf0; color: #444; padding: 10px 18px; border-radius: 50px; font-size: 0.9rem; border: 1px solid #f1e6bc; margin: 5px; display: inline-block; }

    /* Star Input Fix */
    .star-input { direction: rtl; display: inline-block; }
    .star-input input { display: none; }
    .star-input label { font-size: 35px; color: #ddd; cursor: pointer; transition: 0.2s; }
    .star-input label:hover, .star-input label:hover ~ label, .star-input input:checked ~ label { color: var(--gold); }

    .btn-book { background: var(--dark); color: #fff; padding: 18px; border-radius: 0; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: 0.4s; border: none; }
    .btn-book:hover { background: var(--gold); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(212,175,55,0.3); }
</style>

<div class="container mt-5 mb-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <div class="main-display">
                <img src="admin/uploads/<?php echo $room['image']; ?>" id="mainImg" class="shadow">
            </div>
            
            <div class="thumb-container">
                <img src="admin/uploads/<?php echo $room['image']; ?>" class="thumb-img active" onclick="changeImg(this.src, this)">
                
                <?php
                // Gallery table se extra images nikalna
                $gallery_q = mysqli_query($conn, "SELECT * FROM room_gallery WHERE room_id = '$id'");
                while($g_row = mysqli_fetch_assoc($gallery_q)){
                    echo '<img src="admin/uploads/gallery/'.$g_row['image_name'].'" class="thumb-img" onclick="changeImg(this.src, this)">';
                }
                ?>
            </div>

            <div class="mt-5">
                <h3 class="fw-bold" style="font-family: 'Playfair Display', serif;">About This Room</h3>
                <hr style="width: 50px; height: 3px; background: var(--gold); border: none; opacity: 1;">
                <p class="text-muted lh-lg" style="font-size: 1.1rem;">
                    <?php echo $room['description']; ?>
                </p>
            </div>

            <div class="row g-3 mt-4">
                <div class="col-4">
                    <div class="spec-item shadow-sm">
                        <i class="fa fa-maximize"></i>
                        <small class="text-muted d-block">Size</small>
                        <strong>450 sqft</strong>
                    </div>
                </div>
                <div class="col-4">
                    <div class="spec-item shadow-sm">
                        <i class="fa fa-users"></i>
                        <small class="text-muted d-block">Capacity</small>
                        <strong>2 Adults</strong>
                    </div>
                </div>
                <div class="col-4">
                    <div class="spec-item shadow-sm">
                        <i class="fa fa-bed"></i>
                        <small class="text-muted d-block">Bed</small>
                        <strong>King Size</strong>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-5 border-top">
                <h4 class="fw-bold mb-4">Guest Feedback (<?php echo $room['total_reviews']; ?>)</h4>
                <?php
                $reviews_res = mysqli_query($conn, "SELECT * FROM reviews WHERE room_id='$id' ORDER BY id DESC");
                if(mysqli_num_rows($reviews_res) > 0){
                    while($rev = mysqli_fetch_assoc($reviews_res)){ ?>
                        <div class="review-card py-4 border-bottom">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <?php echo strtoupper($rev['user_name'][0]); ?>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?php echo $rev['user_name']; ?></h6>
                                    <small class="text-muted"><?php echo date('M d, Y', strtotime($rev['created_at'])); ?></small>
                                </div>
                            </div>
                            <div class="star-rating-display small mb-2" style="color:var(--gold)">
                                <?php for($i=1; $i<=5; $i++){ echo ($i <= $rev['rating']) ? '<i class="fa fa-star"></i>' : '<i class="fa-regular fa-star"></i>'; } ?>
                            </div>
                            <p class="text-muted"><?php echo $rev['message']; ?></p>
                        </div>
                <?php } } else { echo "<p class='alert alert-light'>No reviews yet. Be the first one!</p>"; } ?>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="info-box">
                <div class="card border-0 shadow-lg p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="h3 fw-bold mb-0"><?php echo $room['name']; ?></h1>
                        <div class="text-end">
                            <span class="badge bg-success mb-1">Available</span>
                            <div class="text-warning small">
                                <i class="fa fa-star"></i> <strong><?php echo ($room['avg_rating'] > 0) ? number_format($room['avg_rating'], 1) : "5.0"; ?></strong>
                            </div>
                        </div>
                    </div>

                    <div class="price-tag mb-4">
                        ₹<?php echo number_format($room['price']); ?> <span>/ per night</span>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 small text-uppercase">Exclusive Amenities:</h6>
                        <span class="amenity-badge"><i class="fa fa-wifi me-2"></i>Ultra WiFi</span>
                        <span class="amenity-badge"><i class="fa fa-coffee me-2"></i>Mini Bar</span>
                        <span class="amenity-badge"><i class="fa fa-snowflake me-2"></i>Climate Control</span>
                    </div>

                    <div class="d-grid mb-4">
                        <a href="book_room.php?id=<?php echo $room['id']; ?>" class="btn btn-book">
                            Reserve This Room <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    </div>

                    <div class="bg-light p-4 rounded mt-2 border">
                        <h5 class="fw-bold mb-3">Rate Your Experience</h5>
                        <form action="" method="POST">
                            <div class="text-center mb-2">
                                <div class="star-input">
                                    <input type="radio" name="rating" value="5" id="s5" required><label for="s5">★</label>
                                    <input type="radio" name="rating" value="4" id="s4"><label for="s4">★</label>
                                    <input type="radio" name="rating" value="3" id="s3"><label for="s3">★</label>
                                    <input type="radio" name="rating" value="2" id="s2"><label for="s2">★</label>
                                    <input type="radio" name="rating" value="1" id="s1"><label for="s1">★</label>
                                </div>
                            </div>
                            <input type="text" name="user_name" class="form-control mb-3 border-0 shadow-sm" placeholder="Your Name" required>
                            <textarea name="message" class="form-control mb-3 border-0 shadow-sm" rows="3" placeholder="How was your stay?"></textarea>
                            <button type="submit" name="submit_review" class="btn btn-dark w-100 fw-bold">Post Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImg(src, el) {
        document.getElementById('mainImg').src = src;
        document.querySelectorAll('.thumb-img').forEach(img => img.classList.remove('active'));
        el.classList.add('active');
    }
</script>

<?php include 'common/footer.php'; ?>