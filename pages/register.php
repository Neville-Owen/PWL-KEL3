<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Register</title>
    <link rel="stylesheet" href="../styles/register.CSS">
</head>
<body>
    <!-- Back Button -->
    <a href="login.php" class="back-button">Back</a>

    <div class="register-container">
        <!-- Title Section -->
        <div class="register-title">
            <h1>REGISTER</h1>
            <p class="register-subtitle">Buat akun baru untuk memulai</p>
        </div>
        
        <!-- Tabs untuk Login/Register -->
        <div class="tabs">
            <a href="login.php">Login</a>
            <a href="register.php" class="active">Register</a>
        </div>
        
        <form method="POST" action="../be/be-register.php">
            <label>Nama lengkap</label>
            <input type="text" name="fullname" placeholder="Nama Lengkap" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <label>Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="confirmPassword" placeholder="Konfirmasi Password" required>

            <button type="submit" name="register">Daftar</button>
        </form>
        
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>