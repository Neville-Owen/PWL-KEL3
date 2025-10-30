<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username/email dan password harus diisi';
    } else {
        try {
            $pdo = getDBConnection();
            
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as attempts 
                FROM login_attempts 
                WHERE ip_address = ? 
                AND attempt_time > DATE_SUB(NOW(), INTERVAL 15 MINUTE)
                AND success = 0
            ");
            $stmt->execute([$ip_address]);
            $attempts = $stmt->fetch()['attempts'];
            
            if ($attempts >= 5) {
                $error = 'Terlalu banyak percobaan login. Coba lagi dalam 15 menit.';
            } else {
                $stmt = $pdo->prepare("
                    SELECT id, fullname, username, email, password, is_active 
                    FROM users 
                    WHERE (username = ? OR email = ?) AND is_active = 1
                ");
                $stmt->execute([$username, $username]);
                $user = $stmt->fetch();
                
                if (!$user) {
                    $stmt = $pdo->prepare("
                        INSERT INTO login_attempts (username_or_email, ip_address, success) 
                        VALUES (?, ?, 0)
                    ");
                    $stmt->execute([$username, $ip_address]);
                    
                    $error = 'Username/email atau password salah';
                } elseif (!password_verify($password, $user['password'])) {
                    $stmt = $pdo->prepare("
                        INSERT INTO login_attempts (username_or_email, ip_address, success) 
                        VALUES (?, ?, 0)
                    ");
                    $stmt->execute([$username, $ip_address]);
                    
                    $error = 'Username/email atau password salah';
                } else {
                    $stmt = $pdo->prepare("
                        INSERT INTO login_attempts (username_or_email, ip_address, success) 
                        VALUES (?, ?, 1)
                    ");
                    $stmt->execute([$username, $ip_address]);
                    
                    $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                    $stmt->execute([$user['id']]);
                    
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['fullname'] = $user['fullname'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['logged_in'] = true;
                    
                    $session_token = bin2hex(random_bytes(32));
                    $expires_at = date('Y-m-d H:i:s', time() + SESSION_LIFETIME);
                    
                    $stmt = $pdo->prepare("
                        INSERT INTO sessions (user_id, session_token, ip_address, user_agent, expires_at) 
                        VALUES (?, ?, ?, ?, ?)
                    ");
                    $stmt->execute([
                        $user['id'],
                        $session_token,
                        $ip_address,
                        $_SERVER['HTTP_USER_AGENT'] ?? '',
                        $expires_at
                    ]);
                    
                    header('Location: BERANDA.php');
                    exit;
                }
            }
        } catch (PDOException $e) {
            error_log("Login Error: " . $e->getMessage());
            $error = 'Terjadi kesalahan. Silakan coba lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify - LoginPage</title>
  <link rel="stylesheet" href="login.CSS">
  <link rel="stylesheet" href="message.css">
</head>
<body class="fade-in">
<header>
    <div class="tabs">
      <a href="login.php" class="nav-link login active">Login</a>
      <a href="register.php" class="nav-link register transition-link">Register</a>
    </div>
</header>  
<div class="page-content">
  <div class="body2">
    <div class="imgR">
      <img src="gambar/login.png" alt="">
    </div>
    <div class="form">
      <?php if ($error): ?>
        <div class="message-box error">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>
      
      <?php if ($success): ?>
        <div class="message-box success">
          <?php echo htmlspecialchars($success); ?>
        </div>
      <?php endif; ?>
      
      <form method="POST" action="login.php">
        <div class="username">
          <label for="username">Username atau Email</label>
          <input type="text" id="username" name="username" placeholder="Neville atau email@example.com" required>
        </div>
        <div class="password">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="•••••" required>
          <a href="forgot_password.php" class="forgot">Lupa Password?</a>
        </div>

        <button type="submit">Login</button>
      </form>
      
      <div class="back">
        <a href="BERANDA.php"><--Back</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>