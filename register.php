<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    $errors = [];

    if (empty($fullname)) {
        $errors[] = 'Nama lengkap harus diisi';
    }

    if (empty($email)) {
        $errors[] = 'Email harus diisi';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid';
    }

    if (empty($username)) {
        $errors[] = 'Username harus diisi';
    } elseif (strlen($username) < 3) {
        $errors[] = 'Username minimal 3 karakter';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = 'Username hanya boleh berisi huruf, angka, dan underscore';
    }

    if (empty($password)) {
        $errors[] = 'Password harus diisi';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password minimal 6 karakter';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Konfirmasi password tidak cocok';
    }

    if (!empty($errors)) {
        $error = implode(', ', $errors);
    } else {
        try {
            $pdo = getDBConnection();
            
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = 'Username sudah digunakan';
            } else {
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = 'Email sudah terdaftar';
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    $stmt = $pdo->prepare("
                        INSERT INTO users (fullname, username, email, password) 
                        VALUES (?, ?, ?, ?)
                    ");
                    
                    if ($stmt->execute([$fullname, $username, $email, $hashedPassword])) {
                        $userId = $pdo->lastInsertId();
                        
                        $_SESSION['user_id'] = $userId;
                        $_SESSION['username'] = $username;
                        $_SESSION['fullname'] = $fullname;
                        $_SESSION['email'] = $email;
                        $_SESSION['logged_in'] = true;
                        
                        header('Location: BERANDA.php');
                        exit;
                    } else {
                        $error = 'Gagal melakukan registrasi';
                    }
                }
            }
        } catch (PDOException $e) {
            error_log("Registration Error: " . $e->getMessage());
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
  <title>Questify - RegisterPage</title>
  <link rel="stylesheet" href="register.CSS">
  <link rel="stylesheet" href="message.css">
</head>
<body class="fade-in">
<header>
    <div class="tabs">
      <a href="login.php" class="nav-link login transition-link">Login</a>
      <a href="register.php" class="nav-link register active">Register</a>
    </div>
</header>  
<div class="page-content">
  <div class="body2">
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
      
      <form method="POST" action="register.php">
        <div class="username">
          <label for="fullname">Nama Lengkap</label>
          <input type="text" id="fullname" name="fullname" placeholder="John Doe" value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>" required>
        </div>
        
        <div class="username">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="example@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </div>
        
        <div class="username">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Neville" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
        </div>
        
        <div class="password">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="•••••" required>
        </div>
        
        <div class="password">
          <label for="confirmPassword">Konfirmasi Password</label>
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="•••••" required>
        </div>

        <button type="submit">Register</button>
      </form>
      
      <div class="back">
        <a href="BERANDA.php"><--Back</a>
      </div>
    </div>
    <div class="imgR">
      <img src="gambar/register.png" alt="">
    </div>
  </div>
</div>
</body>
</html>