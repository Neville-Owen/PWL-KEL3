<?php
session_start();
if (!isset($_SESSION['user'])) { 
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questify - Beranda</title>
    <link rel="stylesheet" href="../styles/BERANDA.CSS">
</head>
<body>
    <div class="container">
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
                <span class="username-display">Halo, <?= htmlspecialchars($user['name'] ?? 'User'); ?>!</span>
                <a href="../be/be-logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <!-- Header Section -->
        <div class="header">
            <img src="../gambar/homepage1.png" alt="Questify Logo" class="quest-logo">
            <h1 class="welcome">SELAMAT DATANG DI QUESTIFY</h1>
            <p class="subtitle">TEMPAT DIMANA KAMU BISA MEMBANGUN KEBIASAAN YANG BAIK</p>
            <div class="scroll-indicator">
                <div class="scroll-arrow">⌄</div>
            </div>
        </div>

        <!-- About Section -->
        <div class="section">
            <div class="section-icon">
                <img src="../gambar/homepage2.png" alt="Knights">
            </div>
            <h2>TENTANG QUESTIFY</h2>
            <p>Questify adalah platform to-do list revolusioner yang mengubah tugas membosanmu jadi petualangan pixel yang seru! Dengan sistem gamifikasi yang menyenangkan, setiap task yang kamu selesaikan akan memberikan XP untuk naik level dan point. Rasakan sensasi bermain game sambil tetap produktif dengan visual pixel art yang nostalgia dan charming.</p>
            
            <div class="scroll-indicator">
                <div class="scroll-arrow">⌄</div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="section">
            <h2>MISI PETUALANGAN KAMU SEDANG MENANTI!</h2>
            
            <div class="characters">
                <div class="character">
                    <img src="../gambar/levelup.png" alt="Level Up Character" class="character-image">
                    <p class="character-description">Ubah tugas membosankanmu jadi petualangan seru. Naik level produktivitas di dunia pixel yang menggemaskan!</p>
                </div>
                
                <div class="character">
                    <img src="../gambar/gamechar.png" alt="Game Character" class="character-image">
                    <p class="character-description">Dari tugas biasa jadi petualangan pixel. Selesaikan, kumpulkan, taklukkan!</p>
                </div>
                
                <div class="character">
                    <img src="../gambar/knight.png" alt="Knight Character" class="character-image">
                    <p class="character-description">RPG produktivitas mu menanti. Kalahkan tugas, raih XP, buka pencapaian dengan gaya retro pixel.</p>
                </div>
            </div>
            
            <div class="scroll-indicator">
                <div class="scroll-arrow">⌄</div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <h2 class="cta-title">AYO BERGABUNG DALAM DUNIA PIXEL MU!</h2>
            <a href="register.php" class="cta-button">Ready player one?</a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <div class="footer-column">
                    <h3 class="footer-title">Kelompok</h3>
                    <ul class="footer-links">
        
                        <li><a href="#">Felix Yonathan</a></li>
                        <li><a href="#">Leonardo Agustin</a></li>
                        <li><a href="#">Neville Quen Clay</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Bantuan</h3>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Laporan Bug</a></li>
                        <li><a href="#">masalah lain</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Komunitas</h3>
                    <ul class="footer-links">
                        <li><a href="#">Teams</a></li>
                        <li><a href="#">GitHub</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-title">Navigasi</h3>
                    <ul class="footer-links">
                        <li><a href="beranda.php">Beranda</a></li>
                        <li><a href="misi.php">Misi</a></li>
                        <li><a href="progress.php">Progres</a></li>
                        <li><a href="bantuan.php">Bantuan</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>Copyright (© 2025 QUESTIFY)</p>
            </div>
        </div>
    </div>
</body>
</html>