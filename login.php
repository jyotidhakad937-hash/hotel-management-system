<?php include 'common/header.php'; ?>
<style>
body{
background:#f4f6f9;
}

.login-box{
max-width:420px;
margin:90px auto;
background:#fff;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.login-title{
text-align:center;
margin-bottom:25px;
font-weight:600;
}

.btn-login{
background:#007bff;
border:none;
}

.btn-login:hover{
background:#0056b3;
}
</style>

</head>
<body>

<div class="container">

<div class="login-box">

<h3 class="login-title">Login Account</h3>

<form action="php/login.php" method="POST">

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" placeholder="Enter email" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" placeholder="Enter password" required>
</div>

<button type="submit" name="login" class="btn btn-login w-100 text-white">
Login
</button>

<div class="text-center mt-3">
Don't have account? <a href="register.php">Register</a>
</div>

</form>

</div>

</div>
<?php include 'common/footer.php'; ?>