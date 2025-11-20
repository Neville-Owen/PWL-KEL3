<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Login</title>
    <link rel="stylesheet" href="../styles/login.CSS">
</head>
<body>
    <div class="login-container">
        <div class="tabs">
            <a href="login.php" class="active">Login</a>
            <a href="register.php">Register</a>
        </div>
        
        <form action="../be/be-login.php" method="POST">
            <label>Masukkan Email :</label>
            <input type="email" name="email" placeholder="Masukkan Email Mu!" required>
            
            <label>Masukkan Password :</label>
            <input type="password" name="password" placeholder="Masukkan Password Mu!" required>
            
            <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
            
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>