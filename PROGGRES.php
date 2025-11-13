<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify - Progress</title>

  <!-- Google Font - Kdam Thmor Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="PROGGRES.CSS">
</head>

<body>
  <header>
    <nav>
      <div class="logo">
        <div class="logo-container">
          <!-- Ganti src dengan path logo Anda -->
          <img src="gambar/logo.png" alt="Logo Questify" id="logoImage">
        </div>
      </div>
      <ul>
        <li><a href="BERANDA.php">Beranda</a></li>
        <li><a href="MISI.php">Misi</a></li>
        <li><a href="PROGGRES.html">Progress</a></li>
        <li><a href="support.html">Bantuan</a></li>
        <li><a href="register">register</a></li>
        <li><a href="register">logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Progress</h1>

    <!-- Progress Bars Section -->
    <div class="progress-section">
      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="ips" style="width: 0%;">IPS</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="bahasa_inggris" style="width: 0%;">Bahasa Inggris</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="mtk" style="width: 0%;">MTK</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="ipa" style="width: 0%;">IPA</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="b_indonesia" style="width: 0%;">Bahasa Indonesia</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="ipas" style="width: 0%;">IPAS</div>
        </div>
      </div>
    </div>

    <!-- Terselesaikan Section -->
    <div class="task-section">
      <h2>Terselesaikan</h2>

      <div class="task-card" data-subject="ips">
        <div class="task-info">
          <h3>Mudah</h3>
          <p>Mengerjakan latihan soal yang tertera pada buku paket</p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>
      </div>

      <div class="task-card" data-subject="ipa">
        <div class="task-info">
          <h3>Mudah</h3>
          <p>Rangkum tentang 3 hukum Newton dan berikan contohnya</p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>
      </div>

      <div class="task-card" data-subject="mtk">
        <div class="task-info">
          <h3>Sulit</h3>
          <p>Mengerjakan paralel 1 - 10</p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>      
      </div>

      <!-- Tambahan tugas baru untuk bar kosong -->
      <div class="task-card" data-subject="bahasa_inggris">
        <div class="task-info">
          <h3>Sedang</h3>
          <p>Mengerjakan latihan listening dari bab 2 dan membuat ringkasan kosakata baru.</p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>
      </div>

      <div class="task-card" data-subject="b_indonesia">
        <div class="task-info">
          <h3>Mudah</h3>
          <p>Membuat ringkasan teks eksposisi halaman 15 dari buku paket Bahasa Indonesia.</p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>
      </div>

      <div class="task-card" data-subject="ipas">
        <div class="task-info">
          <h3>Sedang</h3>
          <p>Menjelaskan proses fotosintesis melalui skema dan contoh dalam kehidupan sehari-hari.</p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>
      </div>
    </div>

    <!-- Riwayat Section -->
    <div class="task-section">
      <h2>Riwayat</h2>

      <div class="task-card">
        <div class="task-info">
          <h3>Sedang</h3>
          <p>Mengerjakan 5 soal dari buku paket Sejarah Indonesia</p>
        </div>
        <div class="task-actions">
          <button class="btn-delete">Hapus</button>
          <button class="btn-edit">✏️</button>
          <button class="menu-dots">⋮</button>
        </div>
      </div>

      <div class="task-card">
        <div class="task-info">
          <h3>Mudah</h3>
          <p>Mengamati tiga fenomena fisika dalam kehidupan</p>
        </div>
        <div class="task-actions">
          <button class="btn-delete">Hapus</button>
          <button class="btn-edit">✏️</button>
          <button class="menu-dots">⋮</button>
        </div>
      </div>

      <div class="task-card">
        <div class="task-info">
          <h3>Sulit</h3>
          <p>Mengerjakan paralel 1 - 10</p>
        </div>
        <div class="task-actions">
          <button class="btn-delete">Hapus</button>
          <button class="btn-edit">✏️</button>
          <button class="menu-dots">⋮</button>
        </div>
      </div>
    </div>
  </main>

  <!-- JavaScript -->
  <script src="PROGGRES.JS"></script>
</body>
</html>
