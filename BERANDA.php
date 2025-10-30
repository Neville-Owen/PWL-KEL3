<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify - Beranda</title>
  <link rel="stylesheet" href="beranda.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="welcome">
        Selamat Datang, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!
      </div>
      <div class="user-info">
        <span>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>
    
    <div class="content">
      <h2>Dashboard Questify</h2>
      <p>Anda berhasil login ke aplikasi Questify.</p>
      <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    </div>
  </div>
</body>
</html>