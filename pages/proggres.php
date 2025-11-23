<?php
session_start();

// Initialize progress data if not exists
if (!isset($_SESSION['progressData'])) {
    $_SESSION['progressData'] = [
        'ips' => 0,
        'bahasa_inggris' => 0,
        'mtk' => 0,
        'ipa' => 0,
        'b_indonesia' => 0,
        'ipas' => 0
    ];
}

$progressData = $_SESSION['progressData'];

// Sample completed tasks
$completedTasks = [
    [
        'subject' => 'ips',
        'difficulty' => 'Mudah',
        'description' => 'Mengerjakan latihan soal yang tertera pada buku paket'
    ],
    [
        'subject' => 'ipa',
        'difficulty' => 'Mudah',
        'description' => 'Rangkum tentang 3 hukum Newton dan berikan contohnya'
    ],
    [
        'subject' => 'mtk',
        'difficulty' => 'Sulit',
        'description' => 'Mengerjakan paralel 1 - 10'
    ],
    [
        'subject' => 'bahasa_inggris',
        'difficulty' => 'Sedang',
        'description' => 'Mengerjakan latihan listening dari bab 2 dan membuat ringkasan kosakata baru.'
    ],
    [
        'subject' => 'b_indonesia',
        'difficulty' => 'Mudah',
        'description' => 'Membuat ringkasan teks eksposisi halaman 15 dari buku paket Bahasa Indonesia.'
    ],
    [
        'subject' => 'ipas',
        'difficulty' => 'Sedang',
        'description' => 'Menjelaskan proses fotosintesis melalui skema dan contoh dalam kehidupan sehari-hari.'
    ]
];

// Sample history tasks
$historyTasks = [
    [
        'difficulty' => 'Sedang',
        'description' => 'Mengerjakan 5 soal dari buku paket Sejarah Indonesia'
    ],
    [
        'difficulty' => 'Mudah',
        'description' => 'Mengamati tiga fenomena fisika dalam kehidupan'
    ],
    [
        'difficulty' => 'Sulit',
        'description' => 'Mengerjakan paralel 1 - 10'
    ]
];
?>
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
          <img src="gambar/logo.png" alt="Logo Questify" id="logoImage">
        </div>
      </div>
      <ul>
        <li><a href="index.php">Beranda</a></li>
        <li><a href="index.php">Misi</a></li>
        <li><a href="progress.php">Progress</a></li>
        <li><a href="support.html">Bantuan</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Progress</h1>

    <!-- Progress Bars Section -->
    <div class="progress-section">
      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="ips" style="width: <?php echo $progressData['ips']; ?>%;">IPS</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="bahasa_inggris" style="width: <?php echo $progressData['bahasa_inggris']; ?>%;">Bahasa Inggris</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="mtk" style="width: <?php echo $progressData['mtk']; ?>%;">MTK</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="ipa" style="width: <?php echo $progressData['ipa']; ?>%;">IPA</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="b_indonesia" style="width: <?php echo $progressData['b_indonesia']; ?>%;">Bahasa Indonesia</div>
        </div>
      </div>

      <div class="progress-item">
        <div class="progress-bar-container">
          <div class="progress-bar" data-subject="ipas" style="width: <?php echo $progressData['ipas']; ?>%;">IPAS</div>
        </div>
      </div>
    </div>

    <!-- Terselesaikan Section -->
    <div class="task-section">
      <h2>Terselesaikan</h2>

      <?php foreach ($completedTasks as $task): ?>
      <div class="task-card" data-subject="<?php echo htmlspecialchars($task['subject']); ?>">
        <div class="task-info">
          <h3><?php echo htmlspecialchars($task['difficulty']); ?></h3>
          <p><?php echo htmlspecialchars($task['description']); ?></p>
        </div>
        <div class="task-actions">
          <button class="btn-select">Selected</button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Riwayat Section -->
    <div class="task-section">
      <h2>Riwayat</h2>

      <?php foreach ($historyTasks as $task): ?>
      <div class="task-card">
        <div class="task-info">
          <h3><?php echo htmlspecialchars($task['difficulty']); ?></h3>
          <p><?php echo htmlspecialchars($task['description']); ?></p>
        </div>
        <div class="task-actions">
          <button class="btn-delete">Hapus</button>
          <button class="btn-edit">✏️</button>
          <button class="menu-dots">⋮</button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- JavaScript -->
  <script src="PROGGRES.JS"></script>
</body>
</html>
