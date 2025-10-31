<?php
require_once 'config.php';

$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

if ($isLoggedIn) {
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT fullname, username, email, is_active FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();
        
        if (!$user || $user['is_active'] != 1) {
            session_unset();
            session_destroy();
            $isLoggedIn = false;
        } else {
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
        }
    } catch (PDOException $e) {
        error_log("Beranda Error: " . $e->getMessage());
    }
}
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
    <?php if ($isLoggedIn): ?>
      <div class="header">
        <div class="welcome">
          Selamat Datang, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!
        </div>
        <div class="user-info">
          <span class="username-display">@<?php echo htmlspecialchars($_SESSION['username']); ?></span>
          <a href="logout.php" class="logout-btn">Logout</a>
        </div>
      </div>
      
      <div class="content">
        <div class="dashboard-section">
          <h2>Dashboard Questify</h2>
          <p>Anda berhasil login ke aplikasi Questify.</p>
        </div>
        
        <div class="user-profile">
          <h3>Informasi Akun</h3>
          <div class="profile-item">
            <span class="label">Nama Lengkap:</span>
            <span class="value"><?php echo htmlspecialchars($_SESSION['fullname']); ?></span>
          </div>
          <div class="profile-item">
            <span class="label">Username:</span>
            <span class="value"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
          </div>
          <div class="profile-item">
            <span class="label">Email:</span>
            <span class="value"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="guest-container">
        <div class="logo-section">
          <h1 class="app-title">QUESTIFY</h1>
          <p class="app-subtitle">Selamat Datang di Aplikasi Questify</p>
        </div>
        
        <div class="auth-prompt">
          <h2>Akses Terbatas</h2>
          <p>Silakan login terlebih dahulu untuk mengakses halaman ini.</p>
          
          <div class="auth-buttons">
            <a href="login.php" class="btn btn-login">Login</a>
            <span class="separator">atau</span>
            <a href="register.php" class="btn btn-register">Register</a>
          </div>
          
          <div class="info-box">
            <p>Belum punya akun? Daftar sekarang dan nikmati fitur lengkap Questify!</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>