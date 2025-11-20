<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Register</title>
    <link rel="stylesheet" href="../styles/register.CSS">
</head>
<body>
    <div class="register-container">
        <!-- Tabs untuk Login/Register -->
        <div class="tabs">
            <a href="login.php">Login</a>
            <a href="register.php" class="active">Register</a>
        </div>
        
        <form method="POST" action="../be/be-register.php">
            <label>Masukkan Nama Lengkap :</label>
            <input type="text" name="fullname" placeholder="Masukkan Nama Lengkap Mu!" required>

            <label>Masukkan Email :</label>
            <input type="email" name="email" placeholder="Masukkan Email Mu!" required>

            <label>Masukkan Username :</label>
            <input type="text" name="username" placeholder="Masukkan Username Mu!" required>

            <label>Masukkan Password :</label>
            <input type="password" name="password" placeholder="Masukkan Password Mu!" required>

            <label>Konfirmasi Password :</label>
            <input type="password" name="confirmPassword" placeholder="Konfirmasi Password Mu!" required>

            <button type="submit" name="register">Daftar</button>
        </form>
        
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>