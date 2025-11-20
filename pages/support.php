<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
$userName = htmlspecialchars($user['name'] ?? 'User');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Bantuan</title>
    <link rel="stylesheet" href="../styles/support.css">
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-wrapper">
        <!-- Navbar -->
        <div class="navbar">
            <div class="logo">
                <div class="logo-icon">
                    <img src="../gambar/logo.png" alt="Questify Logo">
                </div>
                <span class="logo-text">QUESTIFY</span>
            </div>
            <ul class="nav-links">
                <li><a href="beranda.php">Beranda</a></li>
                <li><a href="misi.php">Misi</a></li>
                <li><a href="proggres.php">Progress</a></li>
                <li><a href="bantuan.php">Bantuan</a></li>
            </ul>
            <!-- User Info dengan Logout Button -->
            <div class="user-info">
                <span class="username-display">Halo, <span id="user-name"><?= $userName ?></span>!</span>
                <a href="../be/be-logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <h1>
            Support Quest - Kami siap <br>
            membantu!
        </h1>

        <div class="container">
            <input type="text" id="feedback" placeholder="Silahkan umpan balik">
            
            <button id="kirim-btn">Kirim</button>
        </div>

        <div class="overlay" id="overlay">
            <div class="overlay-box">
                <img src="../gambar/logo.png" alt="Questify Logo"> 
                <br> 
                Terimakasih telah memberi <br>
                umpan balik kepada kami, kami <br>
                akan segera menyelesaikannya!
            </div>
        </div>
    </div>

    <script src="../script/support.js"></script>
</body>
</html>