<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$user_id = $user['id'];
$userName = htmlspecialchars($user['name'] ?? 'User');

// Ambil stats user
$stmt_stats = $connection->prepare("SELECT rank_name, exp, points FROM user_stats WHERE user_id = ?");
$stmt_stats->bind_param("i", $user_id);
$stmt_stats->execute();
$stats_result = $stmt_stats->get_result();

if ($stats_result->num_rows > 0) {
    $stats = $stats_result->fetch_assoc();
    $rank = $stats['rank_name'];
    $exp = $stats['exp'];
    $points = $stats['points'];
} else {
    $rank = 'Novice';
    $exp = 0;
    $points = 0;
}

// Hitung exp untuk next rank
$exp_needed = 500;
if ($exp >= 10000) $exp_needed = 15000;
elseif ($exp >= 5000) $exp_needed = 10000;
elseif ($exp >= 3000) $exp_needed = 5000;
elseif ($exp >= 1500) $exp_needed = 3000;
elseif ($exp >= 500) $exp_needed = 1500;

// Tentukan gambar rank
$rank_image = 'novice.png';
if ($rank == 'Grandmaster') $rank_image = 'grandmaster.png';
elseif ($rank == 'Master') $rank_image = 'master.png';
elseif ($rank == 'Expert') $rank_image = 'expert.png';
elseif ($rank == 'Skilled') $rank_image = 'skilled.png';
elseif ($rank == 'Apprentice') $rank_image = 'apprentice.png';

// Ambil tugas pending user
$stmt_tasks = $connection->prepare("SELECT id, subject, task_name, difficulty, weight FROM tasks WHERE user_id = ? AND status = 'pending' ORDER BY created_at DESC");
$stmt_tasks->bind_param("i", $user_id);
$stmt_tasks->execute();
$tasks_result = $stmt_tasks->get_result();

// Kelompokkan tugas berdasarkan subject dan difficulty
$tasks_by_category = array();
while ($task = $tasks_result->fetch_assoc()) {
    $subject = $task['subject'];
    $difficulty = $task['difficulty'];
    
    if (!isset($tasks_by_category[$subject])) {
        $tasks_by_category[$subject] = array(
            'Mudah' => array(),
            'Sedang' => array(),
            'Sulit' => array()
        );
    }
    
    $tasks_by_category[$subject][$difficulty][] = $task;
}

// Mapping nama subject untuk display
$subject_names = array(
    'bahasa_inggris' => 'Bahasa Inggris',
    'bahasa_indonesia' => 'Bahasa Indonesia',
    'ipas' => 'IPAS',
    'matematika' => 'Matematika',
    'pendidikan_agama' => 'Pendidikan Agama',
    'pjok' => 'PJOK',
    'seni_budaya' => 'Seni Budaya',
    'pkn' => 'PKN'
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify - Misi</title>
  <link rel="stylesheet" href="../styles/MISI.CSS">
  <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
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
      <div class="user-info">
        <span class="username-display">Halo, <?= $userName ?>!</span>
        <a href="../be/be-logout.php" class="logout-btn">Logout</a>
      </div>
    </div>
 
    <main>
      <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert-success"><?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
      <?php endif; ?>
      
      <?php if (isset($_SESSION['rank_up_message'])): ?>
        <div class="alert-rankup"><?= $_SESSION['rank_up_message'] ?></div>
        <?php unset($_SESSION['rank_up_message']); ?>
      <?php endif; ?>
      
      <section class="profile-card">
        <div class="profile-info">
          <div class="avatar">
            <img src="../gambar/Profile-removebg-preview (1).png" alt="User Avatar">
          </div>
          <div class="details">
            <p><strong>Nama:</strong> <?= $userName ?></p>
            <p><strong>Rank:</strong> <?= $rank ?></p>
            <p><strong>Exp:</strong> <?= $exp ?>/<?= $exp_needed ?> Exp</p>
            <p><strong>Point:</strong> <?= $points ?> point</p>
          </div>
          <div class="rank-icon">
            <img src="../gambar/<?= $rank_image ?>" alt="<?= $rank ?>">
          </div>
        </div>
      </section>
 
      <section class="kategori">
        <h2>Kategori Mata Pelajaran</h2>
        <div class="category-buttons">
          <?php foreach ($subject_names as $subject_key => $subject_name): ?>
            <button class="category-btn" data-category="<?= $subject_key ?>"><?= $subject_name ?></button>
          <?php endforeach; ?>
        </div>
 
        <?php if (empty($tasks_by_category)): ?>
          <div class="no-missions">
            <p>Belum ada tugas yang ditambahkan. Silakan buat tugas di halaman Progress!</p>
            <a href="proggres.php" class="btn-goto-progress">Buat Tugas</a>
          </div>
        <?php else: ?>
          <?php foreach ($tasks_by_category as $subject => $difficulties): ?>
            <div class="category-section" data-category="<?= $subject ?>">
              <h2 class="category-title"><?= $subject_names[$subject] ?></h2>
              
              <?php foreach ($difficulties as $difficulty => $tasks): ?>
                <?php if (!empty($tasks)): ?>
                  <h3><?= $difficulty ?></h3>
                  <?php foreach ($tasks as $task): ?>
                    <?php
                    // Hitung reward
                    $exp_base = array('Mudah' => 50, 'Sedang' => 100, 'Sulit' => 200);
                    $points_base = array('Mudah' => 75, 'Sedang' => 150, 'Sulit' => 300);
                    
                    $exp_reward = round($exp_base[$difficulty] * ($task['weight'] / 10));
                    $points_reward = round($points_base[$difficulty] * ($task['weight'] / 10));
                    ?>
                    <div class="mission">
                      <p><?= htmlspecialchars($task['task_name']) ?></p>
                      <span class="reward">+<?= $exp_reward ?> exp & <?= $points_reward ?> p</span>
                      <form method="POST" action="../be/be-complete-task.php" class="mission-form">
                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                        <button type="submit" class="btn">selesai</button>
                      </form>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              <?php endforeach; ?>
              
              <div class="character">
                <img src="../gambar/wizard.png" alt="Karakter Penyihir">
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </section>
    </main>
 
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
            <li><a href="support.php">Bantuan</a></li>
          </ul>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>Copyright © 2025 QUESTIFY</p>
      </div>
    </footer>
  </div>
  <script src="../script/MISI.JS"></script>
</body>
</html>