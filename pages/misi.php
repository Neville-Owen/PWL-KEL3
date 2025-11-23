<?php
session_start();

// Initialize user data if not exists
if (!isset($_SESSION['userData'])) {
    $_SESSION['userData'] = [
        'name' => 'User',
        'exp' => 0,
        'point' => 0,
        'rank' => 'Novice',
        'completedCount' => [
            'general' => 3,
            'easy' => 3,
            'medium' => 3
        ]
    ];
}

$userData = $_SESSION['userData'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify</title>
  <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="gambar/logo.png" alt="Logo" class="logo-img">
    </div>
    <nav>
      <a href="#">Beranda</a>
      <a href="#">Misi</a>
      <a href="PROGGRES.h">Progress</a>
      <a href="#">Bantuan</a>
    </nav>
  </header>
 
  <main>
    <section class="profile-card">
      <div class="profile-info">
        <div class="avatar">
          <img src="gambar/Profile-removebg-preview (1).png" alt="User Avatar">
        </div>
        <div class="details">
          <p><strong>Nama:</strong> <?php echo htmlspecialchars($userData['name']); ?></p>
          <p><strong>Rank:</strong> <?php echo htmlspecialchars($userData['rank']); ?></p>
          <p><strong>Exp:</strong> <?php echo $userData['exp']; ?>/100 Exp</p>
          <p><strong>Point:</strong> <?php echo $userData['point']; ?> point</p>
        </div>
        <div class="rank-icon">
          <img id="rankImage" src="gambar/novice1.png" alt="Novice">
        </div>
      </div>
    </section>
 
    <!-- Bagian Umum -->
    <section class="missions">
      <h2>Umum</h2>
      <div id="generalMissions">
        <div class="mission">
          <p>menulis ringkasan tentang materi yang disampaikan di kelas</p>
          <span class="reward">+100 exp & 150 p</span>
          <button class="btn">selesai</button>
        </div>
        <div class="mission">
          <p>menonton 3 video edukasi</p>
          <span class="reward">+50 exp & 200 p</span>
          <button class="btn">selesai</button>
        </div>
        <div class="mission">
          <p>Membaca buku 3 halaman</p>
          <span class="reward">+50 exp & 100 p</span>
          <button class="btn">selesai</button>
        </div>
      </div>
      <div class="character">
        <img src="gambar/Ksatria Hitam.png" alt="Karakter Ksatria">
      </div>
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
      <div id="easyMissions">
        <div class="mission">
          <p>menghafal 5 flora dan 5 fauna yang terancam punah</p>
          <span class="reward">+25 exp & 50 p</span>
          <button class="btn">selesai</button>
        </div>
        <div class="mission">
          <p>mengetahui apa saja iklim yang ada di dunia</p>
          <span class="reward">+25 exp & 70 p</span>
          <button class="btn">selesai</button>
        </div>
        <div class="mission">
          <p>menghafal 5 sila Pancasila</p>
          <span class="reward">+50 exp & 100 p</span>
          <button class="btn">selesai</button>
        </div>
      </div>
 
      <h3>Sedang</h3>
      <div id="mediumMissions">
        <div class="mission">
          <p>mengetahui semua bentuk kerja sama ekonomi antar negara</p>
          <span class="reward">+75 exp & 100 p</span>
          <button class="btn">selesai</button>
        </div>
        <div class="mission">
          <p>mengetahui 5 letak astronomis berbagai negara di dunia</p>
          <span class="reward">+100 exp & 200 p</span>
          <button class="btn">selesai</button>
        </div>
        <div class="mission">
          <p>melihat 3 video tentang materi astronomis dan geografis</p>
          <span class="reward">+120 exp & 200 p</span>
          <button class="btn">selesai</button>
        </div>
      </div>
      <div class="character">
        <img src="gambar/wizard.png" alt="Karakter Penyihir">
      </div>
    </section>
  </main>
 
  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div>
        <h4>Kelompok</h4>
        <p>Nama anggota<br>Nama anggota<br>Nama anggota</p>
      </div>
      <div>
        <h4>Bantuan</h4>
        <p>FAQ<br>Kontak<br>Dukungan</p>
      </div>
      <div>
        <h4>Komunitas</h4>
        <p>Forum<br>Discord<br>Events</p>
      </div>
      <div>
        <h4>Navigasi</h4>
        <p>Beranda<br>Progress<br>Masuk</p>
      </div>
    </div>
    <p class="copyright">Copyright © 2025 QUESTIFY</p>
  </footer>

  <script src="MISI.js"></script>
</body>
</html>
