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
  <title>Questify - Misi</title>
  <link rel="stylesheet" href="../styles/MISI.CSS">
  <script defer src="../script/MISI.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
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
        <li><a href="support.php">Bantuan</a></li>
      </ul>
      <!-- User Info dengan Logout Button -->
      <div class="user-info">
        <span class="username-display">Halo, <?= htmlspecialchars($user['name'] ?? 'User'); ?>!</span>
        <a href="../be/be-logout.php" class="logout-btn">Logout</a>
      </div>
    </div>
 
    <main>
      <section class="profile-card">
        <div class="profile-info">
          <div class="avatar">
            <img src="../gambar/Profile-removebg-preview (1).png" alt="User Avatar">
          </div>
          <div class="details">
            <p><strong>Nama:</strong> <?= htmlspecialchars($user['name'] ?? 'User'); ?></p>
            <p><strong>Rank:</strong> Novice</p>
            <p><strong>Exp:</strong> 0/100 Exp</p>
            <p><strong>Point:</strong> 0 point</p>
          </div>
          <div class="rank-icon">
            <img src="../gambar/novice.png" alt="Novice">
          </div>
        </div>
      </section>
 
      <!-- Bagian Umum -->
      <section class="missions">
        <h2>Umum</h2>
        <div class="mission"><p>menulis ringkasan tentang materi yang disampaikan di kelas</p><span class="reward">+100 exp & 150 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>menonton 3 video edukasi </p><span class="reward">+50 exp & 200 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>Membaca buku 3 halaman</p><span class="reward">+50 exp & 100 p</span><button class="btn">selesai</button></div>
        <div class="character"><img src="../gambar/Ksatria Hitam.png" alt="Karakter Ksatria"></div>
      </section>
 
      <!-- Bagian Kategori -->
      <section class="kategori">
        <h2>Kategori</h2>
        <div class="category-buttons">
          <button>IPS</button>
          <button>Bahasa Inggris</button>
          <button>MTK</button>
          <button>IPA</button>
          <button>PPKN</button>
          <button>Bahasa Indonesia</button>
        </div>
 
        <h3>Mudah</h3>
        <div class="mission"><p>menghafal 5 flora dan 5 fauna yang terancam punah</p><span class="reward">+25 exp & 50 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>mengetahui apa saja iklim yang ada di dunia</p><span class="reward">+25 exp & 70 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>menghafal 5 sila Pancasila</p><span class="reward">+50 exp & 100 p</span><button class="btn">selesai</button></div>
 
        <h3>Sedang</h3>
        <div class="mission"><p>mengetahui semua bentuk kerja sama ekonomi antar negara</p><span class="reward">+75 exp & 100 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>mengetahui 5 letak astronomis berbagai negara di dunia</p><span class="reward">+100 exp & 200 p</span><button class="btn">selesai</button></div>
        <div class="mission"><p>melihat 3 video tentang materi astronomis dan geografis</p><span class="reward">+120 exp & 200 p</span><button class="btn">selesai</button></div>
        <div class="character"><img src="../gambar/wizard.png" alt="Karakter Penyihir"></div>
      </section>
    </main>
 
    <!-- Footer -->
    <footer>
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
            <li><a href="#">Masalah Lain</a></li>
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
            <li><a href="proggres.php">Progress</a></li>
            <li><a href="bantuan.php">Bantuan</a></li>
          </ul>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>Copyright © 2025 QUESTIFY</p>
      </div>
    </footer>
  </div>
</body>
</html>