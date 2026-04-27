<?php
include "common/config.php";
include 'common/header.php';

if(!isset($_GET['id'])){
    echo "Post not found";
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$blog = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM blog WHERE id='$id'"));

if(!$blog){
    echo "Invalid Post";
    exit;
}
?>
    <title><?php echo $blog['tittle']; ?> | Luxury Blog</title>
   
    <style>
        :root {
            --hotel-gold: #bfa37e;
            --hotel-dark: #1c1c1c;
        }
        body { 
            background: #fff; 
            font-family: 'Poppins', sans-serif; 
            color: #333;
            line-height: 1.8;
        }
        /* Hero Section */
        .blog-hero {
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('admin/uploads/<?php echo $blog['image']; ?>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }
        .blog-category {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.9rem;
            color: var(--hotel-gold);
            font-weight: 600;
        }
        .blog-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-top: 15px;
        }
        /* Content Area */
        .content-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .first-letter::first-letter {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            float: left;
            margin-right: 10px;
            line-height: 1;
            color: var(--hotel-gold);
        }
        .blog-text {
            font-family: 'Libre+Baskerville', serif;
            font-size: 1.15rem;
            color: #444;
            text-align: justify;
        }
        /* Quote Style */
        blockquote {
            font-family: 'Playfair Display', serif;
            font-italic: italic;
            font-size: 1.5rem;
            border-left: 3px solid var(--hotel-gold);
            padding-left: 30px;
            margin: 40px 0;
            color: var(--hotel-dark);
        }
        .share-box {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 20px 0;
            margin-top: 50px;
        }
        .btn-gold {
            background: var(--hotel-gold);
            color: white;
            border-radius: 0;
            padding: 12px 30px;
            border: none;
            transition: 0.3s;
        }
        .btn-gold:hover {
            background: var(--hotel-dark);
            color: white;
        }
    </style>
</head>

<body>

<header class="blog-hero">
    <div class="container">
        <span class="blog-category">Travel & Lifestyle</span>
        <h1 class="blog-title"><?php echo $blog['tittle']; ?></h1>
        <div class="mt-3 small">
            <i class="bi bi-person"></i> By Editorial Team &nbsp; | &nbsp; 
            <i class="bi bi-clock"></i> 5 Min Read
        </div>
    </div>
</header>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 content-container">
            
            <article class="blog-text first-letter">
                <?php echo $blog['description']; ?>
            </article>

            <div class="share-box d-flex justify-content-between align-items-center">
                <div class="tags">
                    <span class="badge bg-light text-dark border">#LuxuryTravel</span>
                    <span class="badge bg-light text-dark border">#Hospitality</span>
                </div>
                
            </div>

            <div class="bg-light p-5 text-center mt-5">
                <h3 class="blog-title" style="font-size: 2rem;">Experience the Luxury Yourself</h3>
                <p class="mb-4">Book your stay at our premium suites and enjoy world-class hospitality.</p>
                <a href="room.php">
                <button  class="btn btn-gold">BOOK A ROOM</button></a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include 'common/footer.php'; ?>