<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify - RegisterPage</title>
  <link rel="stylesheet" href="register.CSS">
</head>
<body class="fade-in">
<header>
    <div class="tabs">
      <a href="login.HTML" class="nav-link login transition-link">Login</a>
      <a href="register.HTML" class="nav-link register active">Register</a>
    </div>
</header>  
<div class="page-content">
  <div class="body2">
    <div class="form">
      <div class="username">
        <label for="fullname">Nama Lengkap</label>
        <input type="text" id="fullname" placeholder="John Doe">
      </div>
      
      <div class="username">
        <label for="email">Email</label>
        <input type="text" id="email" placeholder="example@email.com">
      </div>
      
      <div class="username">
        <label for="username">Username</label>
        <input type="text" id="username" placeholder="Neville">
      </div>
      
      <div class="password">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="•••••">
      </div>
      
      <div class="password">
        <label for="confirmPassword">Konfirmasi Password</label>
        <input type="password" id="confirmPassword" placeholder="•••••">
      </div>

      <button type="submit" id="registerBtn">Register</button>
      
      <div class="back">
        <a href="BERANDA.HTML"><--Back</a>
      </div>
    </div>
    <div class="imgR">
      <img src="gambar/register.png" alt="">
    </div>
  </div>
</div>
<script src="register.js"></script>
</body>
</html>