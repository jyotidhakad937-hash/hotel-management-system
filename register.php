<?php include 'common/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f4f7f6; /* Light clean background */
        min-height: 100vh;
    }

    /* Form Card Container */
    .register-container {
        margin-top: 80px;
        margin-bottom: 80px;
    }

    .register-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    /* Header Styling */
    .register-header {
        background: #d4af37; /* Premium Gold */
        color: white;
        padding: 30px;
        text-align: center;
    }

    .register-header h3 {
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Form Styling */
    .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #d4af37;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.1);
        outline: none;
    }

    /* Button Styling */
    .btn-create {
        background: #d4af37;
        border: none;
        color: white;
        padding: 14px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        margin-top: 10px;
        transition: 0.3s;
    }

    .btn-create:hover {
        background: #b8962d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    .login-text {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #777;
    }

    .login-text a {
        color: #d4af37;
        text-decoration: none;
        font-weight: 600;
    }

    /* Profile Photo Placeholder */
    .custom-file-label {
        font-size: 13px;
        color: #888;
    }
    .back_re {
        background: #443939;
        color: rgb(255, 255, 255);
        padding: 60px 0;
        margin-bottom: 50px;
        height: 300px;
}
b, strong {
    font-weight: bolder;
    color: aliceblue;
}
</style>
 <div class="back_re">
   <div class="container">
      <h2 class="text-center"><b>REGISTER NOW</b></h2>
      <p class="text-center text-muted" style="color: #aaa !important;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe porro maxime consectetur aliquid libero, reiciendis vero unde sit ea soluta. Dignissimos odit autem dolore omnis aliquam est perspiciatis beatae dolorem?</p>
   </div>
</div>
<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card register-card">
                <div class="register-header">
                    <h3>Join Us</h3>
                    <p class="mb-0 opacity-75">Create your luxury guest account</p>
                </div>
                
                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="php/register.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="john@example.com" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="+91 00000 00000" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="c_password" placeholder="••••••••" required>
                            </div>

                            <!-- <div class="col-12 mb-4">
                                <label class="form-label">Upload Profile Photo</label>
                                <input type="file" class="form-control" name="profile_pic" accept="image/*">
                            </div> -->

                            <div class="col-12">
                                <button type="submit" name="register" class="btn btn-create">Create Account</button>
                                <div class="login-text">
                                    Already have an account? <a href="login.php">Login Here</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'common/footer.php'; ?>