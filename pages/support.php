<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="support.css">
</head>
<body>
    <header>
        <nav>
          <div class="logo"><img src="gambar/logo.png" alt="Logo Questify"></div>
          <div class="navHeader"></div>
          <ul>
                <li><a href="beranda.php">Beranda</a></li>
                <li><a href="misi.php">Misi</a></li>
                <li><a href="progress.php">Progress</a></li>
                <li><a href="support.php">Bantuan</a></li>
                <li><a href="../be/logout.php">Logout</a></li>
          </ul>
        </nav>
      </header>

      <h1>
        Support Quest - Kami siap <br>
        membantu!
      </h1>

      <div class="container">
        <input type="text" id="feedback" placeholder="silahkan umpan balik">
        
        <button onclick="kirim()">Kirim</button>
      </div>

      <div class="overlay" id="overlay">
        <div class="overlay-box"><img src="gambar/logo.png"> <br> Terimakasih telah memberi <br>
        umpan balik kepada kami, kami <br>
        akan segera menyelesaikannya!</div>
      </div>

<script>
function kirim() {
  const input = document.getElementById('feedback').value.trim();
  const overlay = document.getElementById('overlay');

  if (input === "") {
    alert("umpan balik kosong");
  } else {
    overlay.style.display = "flex";
    setTimeout(() => {
      overlay.style.display = "none";
      document.getElementById('feedback').value = "";
    }, 2000);
  }
}
</script>
</body>
</html>

