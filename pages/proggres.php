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

// Ambil progress per subject
$subjects = array('bahasa_inggris', 'bahasa_indonesia', 'ipas', 'matematika', 'pendidikan_agama', 'pjok', 'seni_budaya', 'pkn');
$progress_data = array();

foreach ($subjects as $subject) {
    $stmt_prog = $connection->prepare("SELECT current_progress FROM subject_progress WHERE user_id = ? AND subject = ?");
    $stmt_prog->bind_param("is", $user_id, $subject);
    $stmt_prog->execute();
    $prog_result = $stmt_prog->get_result();
    
    if ($prog_result->num_rows > 0) {
        $progress_data[$subject] = $prog_result->fetch_assoc()['current_progress'];
    } else {
        $progress_data[$subject] = 0;
    }
}

// Ambil tugas pending
$stmt_tasks = $connection->prepare("SELECT id, subject, task_name, difficulty, weight FROM tasks WHERE user_id = ? AND status = 'pending' ORDER BY created_at DESC");
$stmt_tasks->bind_param("i", $user_id);
$stmt_tasks->execute();
$tasks_result = $stmt_tasks->get_result();

// Ambil tugas completed
$stmt_completed = $connection->prepare("SELECT id, task_name, difficulty, weight, completed_at FROM tasks WHERE user_id = ? AND status = 'completed' ORDER BY completed_at DESC LIMIT 10");
$stmt_completed->bind_param("i", $user_id);
$stmt_completed->execute();
$completed_result = $stmt_completed->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questify - Progress</title>
  <link rel="stylesheet" href="../styles/PROGGRES.CSS">
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
      <div class="user-info">
        <span class="username-display">Halo, <span id="user-name"><?= $userName ?></span>!</span>
        <a href="../be/be-logout.php" class="logout-btn">Logout</a>
      </div>
    </div>
 
    <main>
      <?php if (isset($_SESSIuccesON['ss_message'])): ?>
        <div class="alert-success"><?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
      <?php endif; ?>
      
      <?php if (isset($_SESSION['rank_up_message'])): ?>
        <div class="alert-rankup"><?= $_SESSION['rank_up_message'] ?></div>
        <?php unset($_SESSION['rank_up_message']); ?>
      <?php endif; ?>
      
      <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert-error"><?= $_SESSION['error_message'] ?></div>
        <?php unset($_SESSION['error_message']); ?>
      <?php endif; ?>
      
      <section class="profile-card">
        <div class="profile-info">
          <div class="avatar">
            <img src="../gambar/Profile-removebg-preview (1).png" alt="User Avatar">
          </div>
          <div class="details">
            <p><strong>Nama:</strong> <span id="profile-name"><?= $userName ?></span></p>
            <p><strong>Rank:</strong> <?= $rank ?></p>
            <p><strong>Exp:</strong> <?= $exp ?>/<?= $exp_needed ?> Exp</p>
            <p><strong>Point:</strong> <?= $points ?> point</p>
          </div>
          <div class="rank-icon">
            <img src="../gambar/novice.png" alt="<?= $rank ?>">
          </div>
        </div>
      </section>
 
      <!-- Progress Bars -->
      <section class="progress-section">
        <h2>Progress Mata Pelajaran</h2>
        
        <div class="progress-item">
          <h3 class="subject-label">Bahasa Inggris</h3>
          <div class="progress-bar-container" data-subject="bahasa_inggris">
            <div class="progress-bar" data-subject="bahasa_inggris" style="width: <?= $progress_data['bahasa_inggris'] ?>%">
              <?= round($progress_data['bahasa_inggris']) ?>%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">Bahasa Indonesia</h3>
          <div class="progress-bar-container" data-subject="bahasa_indonesia">
            <div class="progress-bar" data-subject="bahasa_indonesia" style="width: <?= $progress_data['bahasa_indonesia'] ?>%">
              <?= round($progress_data['bahasa_indonesia']) ?>%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">IPAS</h3>
          <div class="progress-bar-container" data-subject="ipas">
            <div class="progress-bar" data-subject="ipas" style="width: <?= $progress_data['ipas'] ?>%">
              <?= round($progress_data['ipas']) ?>%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">Matematika</h3>
          <div class="progress-bar-container" data-subject="matematika">
            <div class="progress-bar" data-subject="matematika" style="width: 0%">
              0%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">Pendidikan Agama</h3>
          <div class="progress-bar-container" data-subject="pendidikan_agama">
            <div class="progress-bar" data-subject="pendidikan_agama" style="width: 0%">
              0%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">PJOK</h3>
          <div class="progress-bar-container" data-subject="pjok">
            <div class="progress-bar" data-subject="pjok" style="width: 0%">
              0%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">Seni Budaya</h3>
          <div class="progress-bar-container" data-subject="seni_budaya">
            <div class="progress-bar" data-subject="seni_budaya" style="width: 0%">
              0%
            </div>
          </div>
        </div>
        
        <div class="progress-item">
          <h3 class="subject-label">PKN</h3>
          <div class="progress-bar-container" data-subject="pkn">
            <div class="progress-bar" data-subject="pkn" style="width: 0%">
              0%
            </div>
          </div>
        </div>
      </section>
 
      <!-- Tugas Pending -->
      <section class="task-section">
        <h2>Tugas Aktif</h2>
        <?php if ($tasks_result->num_rows > 0): ?>
          <?php while ($task = $tasks_result->fetch_assoc()): ?>
            <div class="task-card" data-task-id="<?= $task['id'] ?>">
              <div class="task-info">
                <h3><?= htmlspecialchars($task['task_name']) ?></h3>
                <p>Mata Pelajaran: <?= ucwords(str_replace('_', ' ', $task['subject'])) ?> | Tingkat: <?= $task['difficulty'] ?> | Bobot: <?= $task['weight'] ?>%</p>
              </div>
              <div class="task-actions">
                <button type="button" class="btn-edit" onclick="openEditModal(<?= $task['id'] ?>, '<?= htmlspecialchars($task['task_name'], ENT_QUOTES) ?>', '<?= $task['difficulty'] ?>', <?= $task['weight'] ?>)">Edit</button>
                <form method="POST" action="../be/be-complete-task.php" class="form-inline">
                  <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                  <button type="submit" class="btn-select">Selesai</button>
                </form>
                <form method="POST" action="../be/be-delete-task.php" class="form-inline" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                  <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                  <button type="submit" class="btn-delete">Hapus</button>
                </form>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="no-tasks">Belum ada tugas aktif. Klik progress bar untuk menambah tugas!</p>
        <?php endif; ?>
      </section>
      
      <!-- Tugas Selesai -->
      <section class="task-section">
        <h2>Tugas yang Telah Selesai</h2>
        <?php if ($completed_result->num_rows > 0): ?>
          <?php while ($completed = $completed_result->fetch_assoc()): ?>
            <div class="task-card completed">
              <div class="task-info">
                <h3><?= htmlspecialchars($completed['task_name']) ?></h3>
                <p>Tingkat: <?= $completed['difficulty'] ?> | Bobot: <?= $completed['weight'] ?>% | Selesai: <?= date('d/m/Y H:i', strtotime($completed['completed_at'])) ?></p>
              </div>
              <div class="task-actions">
                <form method="POST" action="../be/be-delete-task.php" class="form-inline" onsubmit="return confirm('Yakin ingin menghapus tugas ini dari riwayat?')">
                  <input type="hidden" name="task_id" value="<?= $completed['id'] ?>">
                  <button type="submit" class="btn-delete">Hapus</button>
                </form>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="no-tasks">Belum ada tugas yang diselesaikan.</p>
        <?php endif; ?>
      </section>
    </main>
  </div>
  
  <!-- Modal Tambah Tugas -->
  <div id="taskModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Tambah Tugas Baru</h2>
      <form method="POST" action="../be/be-add-task.php" id="addTaskForm">
        <input type="hidden" name="subject" id="modalSubject">
        
        <div class="form-group">
          <label for="taskName">Nama Tugas:</label>
          <input type="text" id="taskName" name="task_name" required>
        </div>
        
        <div class="form-group">
          <label for="difficulty">Tingkat Kesulitan:</label>
          <select id="difficulty" name="difficulty" required>
            <option value="">-- Pilih Tingkat --</option>
            <option value="Mudah">Mudah (+50 EXP)</option>
            <option value="Sedang">Sedang (+100 EXP)</option>
            <option value="Sulit">Sulit (+200 EXP)</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="weight">Bobot Progress (%):</label>
          <input type="number" id="weight" name="weight" min="1" max="100" required>
          <small>Nilai antara 1-100. Semakin tinggi bobot, semakin besar kontribusi ke progress.</small>
        </div>
        
        <div class="form-actions">
          <button type="submit" class="btn-submit">Tambahkan</button>
          <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Modal Edit Tugas -->
  <div id="editTaskModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeEditModal()">&times;</span>
      <h2>Edit Tugas</h2>
      <form method="POST" action="../be/be-edit-task.php" id="editTaskForm">
        <input type="hidden" name="task_id" id="editTaskId">
        
        <div class="form-group">
          <label for="editTaskName">Nama Tugas:</label>
          <input type="text" id="editTaskName" name="task_name" required>
        </div>
        
        <div class="form-group">
          <label for="editDifficulty">Tingkat Kesulitan:</label>
          <select id="editDifficulty" name="difficulty" required>
            <option value="">-- Pilih Tingkat --</option>
            <option value="Mudah">Mudah (+50 EXP)</option>
            <option value="Sedang">Sedang (+100 EXP)</option>
            <option value="Sulit">Sulit (+200 EXP)</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="editWeight">Bobot Progress (%):</label>
          <input type="number" id="editWeight" name="weight" min="1" max="100" required>
          <small>Nilai antara 1-100. Semakin tinggi bobot, semakin besar kontribusi ke progress.</small>
        </div>
        
        <div class="form-actions">
          <button type="submit" class="btn-submit">Simpan Perubahan</button>
          <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
        </div>
      </form>
    </div>
  </div>
  
  <script src="../script/PROGGRES.JS"></script>
</body>
</html>