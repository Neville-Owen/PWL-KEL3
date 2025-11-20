<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Login</title>
    <link rel="stylesheet" href="../styles/login.CSS">
</head>
<body>
    <!-- Back Button -->
    <a href="../index.php" class="back-button">Back</a>

    <div class="login-container">
        <!-- Title Section -->
        <div class="login-title">
            <h1>LOGIN</h1>
            <p class="login-subtitle">Masuk ke akun Anda</p>
        </div>
        
        <!-- Tabs -->
        <div class="tabs">
            <a href="login.php" class="active">Login</a>
            <a href="register.php">Register</a>
        </div>
        
        <form action="../be/be-login.php" method="POST">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required>
            
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
            
            <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
            
            <button type="submit" name="login">Login</button>
        </form>
        
        <p>Belum punya akun? <a href="register.php">Register</a></p>
    </div>
</body>
</html>